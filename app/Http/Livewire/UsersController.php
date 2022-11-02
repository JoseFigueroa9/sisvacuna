<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\User;
use DB;

class UsersController extends Component
{

    use WithPagination;
    use WithFileUploads;

    public $name, $lastname, $dni, $phone, $date_birth, $email, $status, $password, $search, $componentName, $pageTitle, $selected_id, $profile, $fileLoaded;
    private $pagination = 5;

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componentName = 'Colaboradores';
        $this->status = 'Elegir';
    }

    public function render()
    {
        if(strlen($this->search) > 0)
            $data = User::where('name','like', '%' . $this->search . '%')
            ->orWhere('lastname', 'like', '%' . $this->search . '%')
            ->orWhere('dni', 'like', '%' . $this->search . '%')
            ->orWhere('profile', 'like', '%' . $this->search . '%')
            ->orWhere('status', 'like', '%' . $this->search . '%')
            ->select('*')->orderBy('name','asc')->paginate($this->pagination);
        else
            $data = User::select('*')->orderBy('name','asc')->paginate($this->pagination);
        return view('livewire.users.component', [
            'data' => $data,
            'roles' => Role::orderBy('name','asc')->get()
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function resetUI()
    {
        $this->name='';
        $this->lastname='';
        $this->dni='';
        $this->phone='';
        $this->date_birth='';
        $this->email='';
        $this->password='';
        $this->status='Elegir';
        $this->search='';
        $this->selected_id=0;
        $this->resetValidation();
        $this->resetPage();
    }

    public function Edit(User $user)
    {
        $this->selected_id = $user->id;
        $this->name = $user->name;
        $this->lastname = $user->lastname;
        $this->dni = $user->dni;
        $this->phone = $user->phone;
        $this->date_birth = $user->date_birth;
        $this->email = $user->email;
        $this->password = $user->password;
        $this->profile = $user->profile;
        $this->status = $user->status;

        $this->emit('show-modal', 'Show modal!');
    }

    public function Store()
    {
        $rules = [
            'name' => 'required|min:3',
            'lastname' => 'required|min:3',
            'dni' => 'required',
            'phone' => 'required|min:9 ',
            'date_birth' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:6',
            'profile' => 'required|not_in:Elegir',
            'status' => 'required|not_in:Elegir'
        ];

        $messages = [
            'name.required' => 'Nombre de colaborador es requerido',
            'name.min' => 'El nombre debe de tener al menos 3 caracteres',
            'lastname.required' => 'Apellido de colaborador es requerido',
            'lastname.min' => 'El apellido debe de tener al menos 3 caracteres',
            'dni.required' => 'El DNI es requerido',
            'phone.required' => 'El teléfono es requerido',
            'phone.min' => 'El teléfono debe de tener los 9 dígitos',
            'date_birth.required' => 'La fecha de nacimiento es requerida',
            'email.required' => 'El correo es requerido',
            'email.unique' => 'Ya existe un colaborador con este email',
            'email.email' => 'Ingrese un correo válido',
            'password.required' => 'La contraseña es requerido',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres',
            'profile.required' => 'Seleccione el perfil del colaborador',
            'profile.not_in' => 'Seleccione un perfil distinto a Elegir',
            'status.required' => 'Seleccione el estado del colaborador',
            'status.not_in' => 'Seleccione un estado distinto a Elegir',
        ];

        $this->validate($rules, $messages);

        $user = User::create([
            'name' => $this->name,
            'lastname' => $this->lastname,
            'dni' => $this->dni,
            'phone' => $this->phone,
            'date_birth' => $this->date_birth,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'profile' => $this->profile,
            'status' => $this->status
        ]);
        
        $this->resetUI();
        $this->emit('user-added','Colaborador Registrado');
    }

    public function Update()
    {
        $rules = [
            'email' => "required|email|unique:users,email,{$this->selected_id}",
            'name' => 'required|min:3',
            'lastname' => 'required|min:3',
            'dni' => 'required',
            'phone' => 'required|min:9 ',
            'date_birth' => 'required',
            'password' => 'required|min:6',
            'profile' => 'required|not_in:Elegir',
            'status' => 'required|not_in:Elegir'
        ];

        $messages = [
            'name.required' => 'Nombre de colaborador es requerido',
            'name.min' => 'El nombre debe de tener al menos 3 caracteres',
            'lastname.required' => 'Apellido de colaborador es requerido',
            'lastname.min' => 'El apellido debe de tener al menos 3 caracteres',
            'dni.required' => 'El DNI es requerido',
            'phone.required' => 'El teléfono es requerido',
            'phone.min' => 'El teléfono debe de tener los 9 dígitos',
            'date_birth.required' => 'La fecha de nacimiento es requerida',
            'email.required' => 'El correo es requerido',
            'email.unique' => 'Ya existe un colaborador con este email',
            'email.email' => 'Ingrese un correo válido',
            'password.required' => 'La contraseña es requerido',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres',
            'profile.required' => 'Seleccione el perfil del colaborador',
            'profile.not_in' => 'Seleccione un perfil distinto a Elegir',
            'status.required' => 'Seleccione el estado del colaborador',
            'status.not_in' => 'Seleccione un estado distinto a Elegir',
        ];

        $this->validate($rules, $messages);

        $user = User::find($this->selected_id);
        $user->update([
            'name' => $this->name,
            'lastname' => $this->lastname,
            'dni' => $this->dni,
            'phone' => $this->phone,
            'date_birth' => $this->date_birth,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'profile' => $this->profile,
            'status' => $this->status
        ]);

        $this->resetUI();
        $this->emit('user-updated','Colaborador Actualizado');
    }

    protected $listeners = [
        'deleteRow' => 'Destroy',
        'resetUI' => 'resetUI'
    ];

    public function Destroy(User $user)
    {
        $user->delete();

        $this->resetUI();
        $this->emit('user-deleted','Colaborador Eliminado');
    }
}
