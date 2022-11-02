<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Patient;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class PatientsController extends Component
{
    
    use WithPagination;
    use WithFileUploads;

    public $name, $lastname, $dni, $phone, $email, $date_birth, $gender, $father_fullname, $father_dni, $mother_fullname, $mother_dni, $search, $selected_id, $pageTitle, $componentName;

    private $pagination = 5;

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componentName = 'Pacientes';
    }

    public function render()
    {
        if(strlen($this->search) > 0)
            $data = Patient::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('lastname', 'like', '%' . $this->search . '%')
            ->orWhere('dni', 'like', '%' . $this->search . '%')
            ->orWhere('father_dni', 'like', '%' . $this->search . '%')
            ->orWhere('mother_dni', 'like', '%' . $this->search . '%')
            ->paginate($this->pagination);
        else
            $data = Patient::orderBy('id','desc')->paginate($this->pagination);


        return view('livewire.patient.patients', ['patients' => $data])
        ->extends('layouts.theme.app')
        ->section('content');

        /* return view('livewire.patient.patients'); */
    }

    public function Edit($id)
    {
        $record = Patient::find($id, ['id','name','lastname','dni','phone','email','date_birth','gender','father_fullname','father_dni','mother_fullname','mother_dni']);
        $this->name = $record->name;
        $this->selected_id = $record->id;
        $this->lastname = $record->lastname;
        $this->dni = $record->dni;
        $this->phone = $record->phone;
        $this->email = $record->email;
        $this->date_birth = $record->date_birth;
        $this->gender = $record->gender;
        $this->father_fullname = $record->father_fullname;
        $this->father_dni = $record->father_dni;
        $this->mother_fullname = $record->mother_fullname;
        $this->mother_dni = $record->mother_dni;

        $this->emit('modal-show', 'Show modal!');
    }

    public function Store()
    {
        $rules = [
            'name' => 'required|min:3',
            'lastname' => 'required|min:3',
            'dni' => 'required|unique:patients',
            'phone' => 'required|min:9 ',
            'email' => 'required',
            'date_birth' => 'required',
            'gender' => 'required',
            'father_fullname' => 'required|min:5',
            'father_dni' => 'required',
            'mother_fullname' => 'required|min:5',
            'mother_dni' => 'required'
        ];

        $messages = [
            'name.required' => 'Nombre de paciente es requerido',
            'name.min' => 'El nombre debe de tener al menos 3 caracteres',
            'lastname.required' => 'Apellido de paciente es requerido',
            'lastname.min' => 'El apellido debe de tener al menos 3 caracteres',
            'dni.required' => 'El DNI es requerido',
            'dni.unique' => 'Ya existe un paciente con este DNI',
            'phone.required' => 'El teléfono es requerido',
            'phone.min' => 'El teléfono debe de tener los 9 dígitos',
            'email.required' => 'El email es requerido',
            'date_birth.required' => 'La fecha de nacimiento es requerida',
            'gender.required' => 'El sexo es requerido',
            'father_fullname.required' => 'El nombre del padre es requerido',
            'father_fullname.min' => 'El nombre del padre debe tener al menos 5 caracteres',
            'father_dni.required' => 'El DNI del padre es requerido',
            'mother_fullname.required' => 'El nombre de la madre es requerido',
            'mother_fullname.min' => 'El nombre de la madre debe tener al menos 5 caracteres',
            'mother_dni.required' => 'El DNI de la madre es requerido',
        ];

        $this->validate($rules, $messages);

        $patient = Patient::create([
            'name' => $this->name,
            'lastname' => $this->lastname,
            'dni' => $this->dni,
            'phone' => $this->phone,
            'email' => $this->email,
            'date_birth' => $this->date_birth,
            'gender' => $this->gender,
            'father_fullname' => $this->father_fullname,
            'father_dni' => $this->father_dni,
            'mother_fullname' => $this->mother_fullname,
            'mother_dni' => $this->mother_dni
        ]);
        
        $this->resetUI();
        $this->emit('patient-added','Paciente Registrado');
    }

    public function Update()
    {
        $rules = [
            'name' => 'required|min:3',
            'lastname' => 'required|min:3',
            'dni' => "required|unique:patients,dni,{$this->selected_id}",
            'phone' => 'required|min:9 ',
            'email' => 'required',
            'date_birth' => 'required',
            'gender' => 'required',
            'father_fullname' => 'required|min:5',
            'father_dni' => 'required',
            'mother_fullname' => 'required|min:5',
            'mother_dni' => 'required'
        ];

        $messages = [
            'name.required' => 'Nombre de paciente es requerido',
            'name.min' => 'El nombre debe de tener al menos 3 caracteres',
            'lastname.required' => 'Apellido de paciente es requerido',
            'lastname.min' => 'El apellido debe de tener al menos 3 caracteres',
            'dni.required' => 'El DNI es requerido',
            'dni.unique' => 'Ya existe un paciente con este DNI',
            'phone.required' => 'El teléfono es requerido',
            'phone.min' => 'El teléfono debe de tener los 9 dígitos',
            'email.required' => 'El email es requerido',
            'date_birth.required' => 'La fecha de nacimiento es requerida',
            'gender.required' => 'El sexo es requerido',
            'father_fullname.required' => 'El nombre del padre es requerido',
            'father_fullname.min' => 'El nombre del padre debe tener al menos 5 caracteres',
            'father_dni.required' => 'El DNI del padre es requerido',
            'mother_fullname.required' => 'El nombre de la madre es requerido',
            'mother_fullname.min' => 'El nombre de la madre debe tener al menos 5 caracteres',
            'mother_dni.required' => 'El DNI de la madre es requerido',
        ];

        $this->validate($rules, $messages);

        $patient = Patient::find($this->selected_id);
        $patient->update([
            'name' => $this->name,
            'lastname' => $this->lastname,
            'dni' => $this->dni,
            'phone' => $this->phone,
            'email' => $this->email,
            'date_birth' => $this->date_birth,
            'gender' => $this->gender,
            'father_fullname' => $this->father_fullname,
            'father_dni' => $this->father_dni,
            'mother_fullname' => $this->mother_fullname,
            'mother_dni' => $this->mother_dni
        ]);

        $this->resetUI();
        $this->emit('patient-updated','Paciente Actualizado');


    }

    public function resetUI()
    {
        $this->name='';
        $this->lastname='';
        $this->dni='';
        $this->phone='';
        $this->email='';
        $this->date_birth='';
        $this->gender='';
        $this->father_fullname='';
        $this->father_dni='';
        $this->mother_fullname='';
        $this->mother_dni='';
        $this->search='';
        $this->selected_id=0;
        $this->resetValidation();
        $this->resetPage();
    }

    protected $listeners = [
        'deleteRow' => 'Destroy'
    ];

    public function Destroy(Patient $patient)
    {
        /*se puede poner en el argumento Destro($id)  y poner la linea 209 como parámetro, pero es lo mismo, igual funciona
        solo usé esta forma porque nos ayuda a codificar menos y renderizamos el sistema*/
        //$patient = Patient::find($id);
        /* este dd ayuda a verificar si se elimina o no un registro, manda una especie de consola para confirmar que se está
        realizando muy bien la acción*/
        //dd($patient);
        $patient->delete();

        $this->resetUI();
        $this->emit('patient-deleted','Paciente Eliminado');
    }

}
