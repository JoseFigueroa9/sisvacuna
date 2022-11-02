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
                                <th class="table-th text-white text-center">Nombres</th>
                                <th class="table-th text-white text-center">Apellidos</th>
                                <th class="table-th text-white text-center">DNI</th>
                                <th class="table-th text-white text-center">Teléfono</th>
                                <th class="table-th text-white text-center">E-mail</th>
                                <th class="table-th text-white text-center">Fecha Nacimiento</th>
                                <th class="table-th text-white text-center">Sexo</th>
                                <th class="table-th text-white text-center">Nombre Padre</th>
                                <th class="table-th text-white text-center">DNI Padre</th>
                                <th class="table-th text-white text-center">Nombre Madre</th>
                                <th class="table-th text-white text-center">DNI Madre</th>
                                <th class="table-th text-white text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($patients as $patient)
                                <tr>
                                    <td><h6 class="text-center">{{$patient->name}}</h6></td>
                                    <td><h6 class="text-center">{{$patient->lastname}}</h6></td>
                                    <td><h6 class="text-center">{{$patient->dni}}</h6></td>
                                    <td><h6 class="text-center">{{$patient->phone}}</h6></td>
                                    <td><h6 class="text-center">{{$patient->email}}</h6></td>
                                    <td><h7 class="text-center">{{$patient->date_birth}}</h7></td>
                                    <td><h6 class="text-center">{{$patient->gender}}</h6></td>
                                    <td><h6>{{$patient->father_fullname}}</h6></td>
                                    <td><h6 class="text-center">{{$patient->father_dni}}</h6></td>
                                    <td><h6>{{$patient->mother_fullname}}</h6></td>
                                    <td><h6 class="text-center">{{$patient->mother_dni}}</h6></td>

                                    <td class="text-center">
                                    <a href="javascript:void(0)" wire:click.prevent="Edit({{$patient->id}})" class="btn btn-dark mtmobile" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="javascript:void(0)" onclick="Confirm('{{$patient->id}}')" class="btn btn-dark" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$patients->links()}}
                </div>
            </div>
        </div>
    </div>
    @include('livewire.patient.form')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function(){ 
        
        window.livewire.on('patient-added', msg => {
            $('#theModal').modal('hide')
            noty(msg)
        });
        window.livewire.on('patient-updated', msg => {
            $('#theModal').modal('hide')
            noty(msg)
        });
        window.livewire.on('patient-deleted', msg => {
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