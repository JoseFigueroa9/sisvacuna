<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Vaccine;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class VaccinesController extends Component
{

    use WithPagination;
    use WithFileUploads;

    public $name, $description, $stock, $alerts, $categoryid, $search, $selected_id, $pageTitle, $componentName;
    private $pagination = 5;

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componentName = 'Vacunas';
        $this->categoryid = 'Elegir';
    }

    public function render()
    {
        if(strlen($this->search) > 0)
            $vaccines = Vaccine::join('categories as c','c.id','vaccines.category_id')
                ->select('vaccines.*','c.name as category')
                ->where('vaccines.name', 'like', '%' . $this->search . '%')
                ->orWhere('c.name', 'like', '%' . $this->search . '%')
                ->orderBy('vaccines.name', 'asc')
                ->paginate($this->pagination);
        else
            $vaccines = Vaccine::join('categories as c','c.id','vaccines.category_id')
                ->select('vaccines.*','c.name as category')
                ->orderBy('vaccines.name', 'asc')
                ->paginate($this->pagination);


        return view('livewire.vaccines.component', [
            'data' => $vaccines,
            'categories' => Category::orderBy('name', 'asc')->get()
        ])
        ->extends('layouts.theme.app')
        ->section('content');

    }

    public function Store()
    {
        $rules = [
            'name' => 'required|unique:vaccines|min:3',
            'description' => 'required',
            'stock' => 'required',
            'alerts' => 'required',
            'categoryid' => 'required|not_in:Elegir'
        ];

        $messages = [
            'name.required' => 'Nombre de la vacuna requerida',
            'name.unique' => 'Ya existe nombre de la vacuna',
            'name.min' => 'El nombre de la vacuna debe tener al menos 3 caracteres',
            'description.required' => 'Descripción de la vacuna es requerida',
            'stock.required' => 'El stock es requerido',
            'alerts.required' => 'Ingresa el valor mínimo de existencias',
            'categoryid.not_in' => 'Elige un nombre de categoría diferente a Elegir'
        ];

        $this->validate($rules, $messages);

        $vaccine = Vaccine::create([
            'name' => $this->name,
            'description' => $this->description,
            'stock' => $this->stock,
            'alerts' => $this->alerts,
            'category_id' => $this->categoryid
        ]);

/*         if($this->image)
        {
            $customFileName = uniqid() . '_.' . $this->image->extension();
            $this->image->storeAs('public/vaccines', $customFileName);
            $vaccine->image = $customFileName;
            $vaccine->save();
        } */

        $this->resetUI();
        $this->emit('vaccine-added', 'Vacuna Registrada');
    }

    public function Edit(Vaccine $vaccine)
    {
        $this->selected_id = $vaccine->id;
        $this->name = $vaccine->name;
        $this->description = $vaccine->description;
        $this->stock = $vaccine->stock;
        $this->alerts = $vaccine->alerts;
        $this->categoryid = $vaccine->category_id;

        $this->emit('modal-show', 'Show modal!');
    }

    public function Update()
    {
        $rules = [
            'name' => "required|min:3|unique:vaccines,name,{$this->selected_id}",
            'description' => 'required',
            'stock' => 'required',
            'alerts' => 'required',
            'categoryid' => 'required|not_in:Elegir'
        ];

        $messages = [
            'name.required' => 'Nombre de la vacuna requerida',
            'name.unique' => 'Ya existe nombre de la vacuna',
            'name.min' => 'El nombre de la vacuna debe tener al menos 3 caracteres',
            'description.required' => 'Descripción de la vacuna es requerida',
            'stock.required' => 'El stock es requerido',
            'alerts.required' => 'Ingresa el valor mínimo de existencias',
            'categoryid.not_in' => 'Elige un nombre de categoría diferente a Elegir'
        ];

        $this->validate($rules, $messages);

        $vaccine = Vaccine::find($this->selected_id);

        $vaccine -> update([
            'name' => $this->name,
            'description' => $this->description,
            'stock' => $this->stock,
            'alerts' => $this->alerts,
            'category_id' => $this->categoryid
        ]);

/*         if($this->image)
        {
            $customFileName = uniqid() . '_.' . $this->image->extension();
            $this->image->storeAs('public/vaccines', $customFileName);
            $imageTemp = $vaccine->image; //imagen temporal
            $vaccine->image = $customFileName;
            $vaccine->save();

            if($imageTemp != null)
            {
                if(file_exists('storage/vaccines/' .$imageTemp)){
                    unlink('storage/vaccines/' .$imageTemp);
                }
            }
        } */

        $this->resetUI();
        $this->emit('vaccine-updated', 'Vacuna Actualizada');
    }


    public function resetUI()
    {
        $this->name = '';
        $this->description = '';
        $this->stock = '';
        $this->alerts = '';
        $this->search = '';
        $this->categoryid = 'Elegir';
        $this->selected_id = 0;
        $this->resetValidation();
        $this->resetPage();
    }

    protected $listeners = ['deleteRow' => 'Destroy'];

    public function Destroy(Vaccine $vaccine){
        
        /* $imageTemp = $vaccine->image; */
        $vaccine->delete();

        /* if($imageTemp != null){
            if(file_exists('storage/vaccines/' .$imageTemp)){
                unlink('storage/vaccines/' .$imageTemp);
            }
        } */

        $this->resetUI();
        $this->emit('vaccine-deleted', 'Vacuna Eliminada');
    }

}
