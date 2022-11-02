@include('common.modalHead')

<div class="row">
    <div class="col-sm-6 col-md-4">
        <div class="form-group">
            <label>Nombres</label>
            <input type="text" wire:model.lazy="name" class="form-control" placeholder="Ej: Carlos Estefano">
            @error('name') <span class="text-danger er">{{ $message }}</span>@enderror 
        </div>
    </div>

    <div class="col-sm-6 col-md-4">
        <div class="form-group">
            <label>Apellidos</label>
            <input type="text" wire:model.lazy="lastname" class="form-control" placeholder="Ej: Ramirez Ventura">
            @error('lastname') <span class="text-danger er">{{ $message }}</span>@enderror 
        </div>
    </div>

    <div class="col-sm-6 col-md-4">
        <div class="form-group">
            <label>DNI</label>
            <input type="text" wire:model.lazy="dni" class="form-control" placeholder="Ej: 77788899">
            @error('dni') <span class="text-danger er">{{ $message }}</span>@enderror 
        </div>
    </div>

    <div class="col-sm-6 col-md-4">
        <div class="form-group">
            <label>Teléfono</label>
            <input type="tel" wire:model.lazy="phone" class="form-control" placeholder="Ej: 999999999">
            @error('phone') <span class="text-danger er">{{ $message }}</span>@enderror 
        </div>
    </div>

    <div class="col-sm-6 col-md-4">
        <div class="form-group">
            <label>E-mail</label>
            <input type="email" wire:model.lazy="email" class="form-control" placeholder="Ej: ejemplo@gmail.com">
            @error('email') <span class="text-danger er">{{ $message }}</span>@enderror 
        </div>
    </div>

    <div class="col-sm-6 col-md-4">
        <div class="form-group">
            <label>Fecha Nacimiento</label>
            <input type="date" wire:model.lazy="date_birth" class="form-control">
            @error('date_birth') <span class="text-danger er">{{ $message }}</span>@enderror 
        </div>
    </div>

    <div class="col-sm-6 col-md-4">
        <div class="form-group">
            <label>Sexo</label>
            <input type="text" wire:model.lazy="gender" class="form-control" placeholder="Ej: Masculino">
            @error('gender') <span class="text-danger er">{{ $message }}</span>@enderror 
        </div>
    </div>

    <div class="col-sm-6 col-md-4">
        <div class="form-group">
            <label>Nombre Padre</label>
            <input type="text" wire:model.lazy="father_fullname" class="form-control" placeholder="Ej: Jorge Ramirez">
            @error('father_fullname') <span class="text-danger er">{{ $message }}</span>@enderror 
        </div>
    </div>

    <div class="col-sm-6 col-md-4">
        <div class="form-group">
            <label>DNI Padre</label>
            <input type="text" wire:model.lazy="father_dni" class="form-control" placeholder="Ej: 66677788">
            @error('father_dni') <span class="text-danger er">{{ $message }}</span>@enderror 
        </div>
    </div>

    <div class="col-sm-6 col-md-4">
        <div class="form-group">
            <label>Nombre Madre</label>
            <input type="text" wire:model.lazy="mother_fullname" class="form-control" placeholder="Ej: Zoyla Ventura">
            @error('mother_fullname') <span class="text-danger er">{{ $message }}</span>@enderror 
        </div>
    </div>

    <div class="col-sm-6 col-md-4">
        <div class="form-group">
            <label>DNI Madre</label>
            <input type="text" wire:model.lazy="mother_dni" class="form-control" placeholder="Ej: 66677788">
            @error('mother_dni') <span class="text-danger er">{{ $message }}</span>@enderror 
        </div>
    </div>
    
</div>

@include('common.modalFooter')