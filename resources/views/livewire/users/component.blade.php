<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h4 class="card-title">
                    <b>{{$componentName}} | {{$pageTitle}}</b>
                </h4>
                <ul class="tabs tab-pills">
                    <li>
                        <a href="javascript:void(0)" class="tabmenu bg-dark" data-toggle="modal" data-target="#theModal">Agregar</a>
                    </li>
                </ul>
            </div>
            @include('common.searchbox')

            <div class="widget-content">
                <div class="table-responsive">
                    <table class="table table-bordered striped mt-1">
                        <thead class="text-white" style="background: #3b3f5c">
                            <tr>
                                <th class="table-th text-white text-center">Nombre</th>
                                <th class="table-th text-white text-center">Apellido</th>
                                <th class="table-th text-white text-center">DNI</th>
                                <th class="table-th text-white text-center">Teléfono</th>
                                <th class="table-th text-white text-center">Fecha Nacimiento</th>
                                <th class="table-th text-white text-center">E-mail</th>
                                <th class="table-th text-white text-center">Perfil</th>
                                <th class="table-th text-white text-center">Estado</th>
                                <th class="table-th text-white text-center">Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($data as $r)
                            <tr>
                                <td><h6>{{$r->name}}</h6></td>
                                <td><h6>{{$r->lastname}}</h6></td>
                                <td class="text-center"><h6>{{$r->dni}}</h6></td>
                                <td class="text-center"><h6>{{$r->phone}}</h6></td>
                                <td><h6>{{$r->date_birth}}</h6></td>
                                <td><h6>{{$r->email}}</h6></td>
                                <td class="text-center"><h6>{{$r->profile}}</h6></td>
                                <td class="text-center">
                                    <span class="badge {{ $r->status == 'Active' ? 'badge-success' : 'badge-danger' }} text-uppercase">{{$r->status}}</span>
                                </td>

                                <td class="text-center">
                                <a href="javascript:void(0)" wire:click="Edit({{$r->id}})" class="btn btn-dark mtmobile" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="javascript:void(0)" onclick="Confirm('{{$r->id}}')" class="btn btn-dark" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$data->links()}}
                </div>
            </div>
        </div>
    </div>
    @include('livewire.users.form')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        window.livewire.on('user-added', msg => {
            $('#theModal').modal('hide')
            noty(msg)
        })
        window.livewire.on('user-updated', msg => {
            $('#theModal').modal('hide')
            noty(msg)
        })
        window.livewire.on('user-deleted', msg => {
            noty(msg)
        })
        window.livewire.on('hide-modal', msg => {
            $('#theModal').modal('hide')
        })
        window.livewire.on('show-modal', msg => {
            $('#theModal').modal('show')
        })
        window.livewire.on('user-withsales', msg => {
            noty(msg)
        })
    });

    function Confirm(id)
    {
        swal({
            title: 'Confirmar',
            text: '¿Deseas eliminar el registro?',
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cerrar',
            cancelButtonColor: '#fff',
            confirmButtonColor: '#3b3f5c',
            confirmButtonText: 'Aceptar'

        }).then(function(result){
            if(result.value){
                window.livewire.emit('deleteRow',id)
                swal.close()
            }
        })
    }
</script>
