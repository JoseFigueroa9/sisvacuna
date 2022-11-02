@include('common.modalHead')

<div class="row">
    <div class="col-sm-12">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <span class="fas fa-edit">

                    </span>
                </span>
            </div>
            <input type="text" wire:model.lazy="name" class="form-control" placeholder="Ej: Toxoides">
        </div>
        @error('name') <span class="text-danger er">{{ $message }}</span> @enderror
    </div>
</div>

<div class="row">
    <div class="col-sm-12 mt-3">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <span class="fas fa-edit">

                    </span>
                </span>
            </div>
                <input type="text" wire:model.lazy="description" class="form-control" placeholder="Ej: Utilizan una forma debilitada...">
                @error('description') <span class="text-danger er">{{ $message }}</span> @enderror
        </div>
    </div>
</div>

@include('common.modalFooter')