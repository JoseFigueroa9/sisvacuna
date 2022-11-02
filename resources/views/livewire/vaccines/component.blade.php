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
                                <th class="table-th text-white">Nombre</th>
                                <th class="table-th text-white text-center">Descripción</th>
                                <th class="table-th text-white text-center">Categoría</th>
                                <th class="table-th text-white text-center">Stock</th>
                                <th class="table-th text-white text-center">Inv. Min</th>
                                <th class="table-th text-white text-center">Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($data as $vaccine)
                            <tr>
                                <td><h6 class="text-center">{{$vaccine->name}}</h6></td>
                                <td><h6>{{$vaccine->description}}</h6></td>
                                <td><h6 class="text-center">{{$vaccine->category}}</h6></td>
                                <td><h6 class="text-center">{{$vaccine->stock}}</h6></td>
                                <td><h6 class="text-center">{{$vaccine->alerts}}</h6></td>

                                <td class="text-center">
                                <a href="javascript:void(0)" wire:click.prevent="Edit({{$vaccine->id}})" class="btn btn-dark mtmobile" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="javascript:void(0)" onclick="Confirm('{{$vaccine->id}}')" class="btn btn-dark" title="Delete">
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
    @include('livewire.vaccines.form')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function(){ 
        
        window.livewire.on('vaccine-added', msg => {
            $('#theModal').modal('hide')
            noty(msg)
        });
        window.livewire.on('vaccine-updated', msg => {
            $('#theModal').modal('hide')
            noty(msg)

        });
        window.livewire.on('vaccine-deleted', msg => {
            //noty
            noty(msg)
        });
        window.livewire.on('modal-show', msg => {
            $('#theModal').modal('show')
        });
        window.livewire.on('modal-hide', msg => {
            $('#theModal').modal('hide')
        });
        /* $('#theModal').on('hidden.bs.modal', function(e) {
            $('.er').css('display','none')
        }); */

        window.livewire.on('hidden.bs.modal', msg => {
            $('.er').css('display','none')
        });



    });

    function Confirm(id, vaccines)
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