<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

use Livewire\WithFileUploads;//trait
use Livewire\WithPagination;

class CategoriesController extends Component
{
    
    use WithFileUploads;
    use WithPagination;
    
    public $name, $search, $description, $selected_id, $pageTitle, $componentName;
    private $pagination = 3;

    public function mount(){
        $this->pageTitle = 'Listado';
        $this->componentName = 'Categorías';
    }

    /* MÉTODO PARA LA PAGINACIÓN - LIVEWIRE */
    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    /* MÉTODO PARA EL BUSCADOR Y RETORNAR MEDIANTE SU NOMBRE Y LA VISTA DE CATEGORÍAS */
    public function render()
    {
        if(strlen($this->search) > 0){
            $data = Category::where('name', 'like', '%'.$this->search.'%')->paginate($this->pagination);
        }else{
            $data = Category::orderBy('id','desc')->paginate($this->pagination);
        }

        return view('livewire.category.categories', ['categories' => $data])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function Edit($id)
    {
        $record = Category::find($id, ['id','name','description']);
        $this->name = $record->name;
        $this->selected_id = $record->id;
        $this->description = $record->description;

        $this->emit('show-modal', 'show modal!');
    }

    public function Store()
    {
        $rules = [
            'name' => 'required|unique:categories|min:3'
        ];

        $messages = [
            'name.required' => 'Nombre de categoría es requerido',
            'name.unique' => 'Ya existe el nombre de la categoría',
            'name.min' => 'El nombre de categoría debe tener al menos 3 caracteres'
        ];

        $this->validate($rules, $messages);

        $category = Category::create([
            'name' => $this->name,
            'description' => $this->description
        ]);

        /* $customFileName;
        if($this->image)
        {
            $customFileName = uniqid() . '_.' . $this->image->extension();
            $this->image->storeAs('public/categorias', $customFileName);
            $category->image = $customFileName;
            $category->save();
        } */

        
        $this->resetUI();
        $this->emit('category-added', 'Categoría Registrada');

    }

    public function Update()
    {
        $rules = [
            'name' => "required|min:3|unique:categories,name,{$this->selected_id}"
        ];

        $messages = [
            'name.required' => 'Nombre de categoría requerido',
            'name.min' => 'El nombre de categoría debe tener al menos 3 caracteres',
            'name.unique' => 'El nombre de categoría ya existe'
        ];

        $this->validate($rules, $messages);

        $category = Category::find($this->selected_id);
        $category->update([
            'name' => $this->name,
            'description' => $this->description
        ]);

        /* if($this->image)
        {
            $customFileName = uniqid() . '_.' . $this->image->extension();
            $this->image->storeAs('public/categories',$customFileName);
            $imageName = $category->image;

            $category->image = $customFileName;
            $category->save();

            if($imageName != null){
                if(file_exists('storage/categories' . $imageName)){
                    unlink('storage/categories' . $imageName);
                }
            }
        } */

        $this->resetUI();
        $this->emit('category-updated', 'Categoría Actualizada');
    }
    

    public function resetUI()
    {
        $this->name = '';
        $this->description = '';
        $this->search = '';
        $this->selected_id = 0;
        $this->resetValidation();
        $this->resetPage();
    }

    protected $listeners = [
        'deleteRow' => 'Destroy'
    ];

    public function Destroy(Category $category){

        //dd($category);
        $category->delete();

        /* if($imageName!=null){
            unlink('storage/categories/'.$imageName);
        } */

        $this->resetUI();
        $this->emit('category-deleted', 'Categoría Eliminada');
    }
    
}
