@include('common.modalHead')

<div class="row">
    <div class="col-sm-6 col-md-4">
        <div class="form-group">
            <label>Nombres</label>
            <input type="text" wire:model.lazy="name" class="form-control" placeholder="Ej: Luis Manuel">
            @error('name') <span class="text-danger er">{{ $message }}</span>@enderror 
        </div>
    </div>

    <div class="col-sm-6 col-md-4">
        <div class="form-group">
            <label>Apellidos</label>
            <input type="text" wire:model.lazy="lastname" class="form-control" placeholder="Ej: Ayala Ortiz">
            @error('lastname') <span class="text-danger er">{{ $message }}</span>@enderror 
        </div>
    </div>

    <div class="col-sm-6 col-md-4">
        <div class="form-group">
            <label>DNI</label>
            <input type="text" wire:model.lazy="dni" class="form-control" placeholder="Ej: 99887766">
            @error('dni') <span class="text-danger er">{{ $message }}</span>@enderror 
        </div>
    </div>

    <div class="col-sm-6 col-md-4">
        <div class="form-group">
            <label>Teléfono</label>
            <input type="tel" wire:model.lazy="phone" class="form-control" placeholder="Ej: 987456241" maxlength="9">
            @error('phone') <span class="text-danger er">{{ $message }}</span>@enderror 
        </div>
    </div>

    <div class="col-sm-12 col-md-8">
        <div class="form-group">
            <label>Fecha Nacimiento</label>
            <input type="date" wire:model.lazy="date_birth" class="form-control">
            @error('date_birth') <span class="text-danger er">{{ $message }}</span>@enderror 
        </div>
    </div>

    <div class="col-sm-6 col-md-4">
        <div class="form-group">
            <label>E-mail</label>
            <input type="email" wire:model.lazy="email" class="form-control" placeholder="Ej: layala20@gmail.com">
            @error('email') <span class="text-danger er">{{ $message }}</span>@enderror 
        </div>
    </div>

    <div class="col-sm-6 col-md-4">
        <div class="form-group">
            <label>Contraseña</label>
            <input type="password" wire:model.lazy="password" class="form-control">
            @error('password') <span class="text-danger er">{{ $message }}</span>@enderror 
        </div>
    </div>

    <div class="col-sm-6 col-md-4">
        <div class="form-group">
            <label>Estado</label>
            <select wire:model.lazy="status" class="form-control">
                <option value="Elegir" selected>Elegir</option>
                <option value="Active" selected>Activo</option>
                <option value="Locked" selected>Bloqueado</option>
            </select>
            @error('status') <span class="text-danger er">{{ $message }}</span>@enderror 
        </div>
    </div>

    <div class="col-sm-6 col-md-4">
        <div class="form-group">
            <label>Asignar Rol</label>
            <select wire:model.lazy="profile" class="form-control">
                <option value="Elegir" selected>Elegir</option>
                @foreach($roles as $role)
                    <option value="{{$role->name}}" selected>{{$role->name}}</option> 
                @endforeach
            </select>
            @error('profile') <span class="text-danger er">{{ $message }}</span>@enderror 
        </div>
    </div>
    
</div>

@include('common.modalFooter')