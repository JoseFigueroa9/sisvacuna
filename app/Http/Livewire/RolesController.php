<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Livewire\WithPagination;
use App\Models\User;
use DB;

class RolesController extends Component
{

    use WithPagination;

    public $roleName, $search, $componentName, $pageTitle, $selected_id;
    private $pagination = 5;

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componentName = 'Roles';
    }

    public function render()
    {
        if(strlen($this->search) > 0)
            $roles = Role::where('name','like', '%' . $this->search . '%')->paginate($this->pagination);
        else
            $roles = Role::orderBy('name','asc')->paginate($this->pagination);

        return view('livewire.roles.component',[
            'roles' => $roles
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function CreateRole()
    {
        $rules = ['roleName' => 'required|min:3|unique:roles,name'];

        $messages = [ 
            'roleName.required' => 'El nombre del rol es requerido',
            'roleName.unique' => 'El rol ya existe',
            'roleName.min' => 'El rol debe de tener al menos 3 caracteres' 
        ];

        $this->validate($rules, $messages);

        Role::create(['name' => $this->roleName]);
        $this->emit('role-added', 'Se registró el rol con éxito');
        $this->resetUI();
    }

    public function Edit(Role $role)
    {
        //$role = Role::find($id);
        $this->selected_id = $role->id;
        $this->roleName = $role->name;

        $this->emit('show-modal','Show modal');
    }

    public function UpdateRole()
    {
        $rules = ['roleName' => "required|min:3|unique:roles,name, {$this->selected_id}"];

        $messages = [ 
            'roleName.required' => 'El nombre del rol es requerido',
            'roleName.unique' => 'El rol ya existe',
            'roleName.min' => 'El rol debe de tener al menos 3 caracteres' 
        ];

        $this->validate($rules, $messages);

        $role = Role::find($this->selected_id);
        $role->name = $this->roleName;
        $role->save();

        $this->emit('role-updated', 'Se actualizó el rol con éxito');
        $this->resetUI();
    }

    protected $listeners = ['deleteRow' => 'Destroy'];

    public function Destroy($id)
    {
        $permissionsCount = Role::find($id)->permissions->count();
        if($permissionsCount > 0)
        {
            $this->emit('role-error', 'No se puede eliminar el rol porque tiene permisos asociados');
            return;
        }
        Role::find($id)->delete();
        $this->emit('role-deleted', 'Se eliminó el rol con éxito');
    }

    public function AsignarRoles($rolesList)
    {
        if($this->userSelected > 0)
        {
            $user = User::find($this->userSelected);
            if($user){
                $user->syncRoles($rolesList);
                    $this->emit('msg-ok', 'Roles asignados correctament');
                    $this->resetInput();
            }
        }
    }

    public function resetUI()
    {
        $this->roleName = '';
        $this->search = '';
        $this->selected_id = 0;
        $this->resetValidation();
        $this->resetPage();
    }

}
