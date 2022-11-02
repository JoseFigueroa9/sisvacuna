<div class="row patients layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget">
            <div class="widget-heading">
                <h4 class="card-title text-center"><b>{{$componentName}}</b></h4>
            </div>

            <div class="widget-content">
                <div class="row">
                    <div class="col-sm-12 col-md-3">
                        <div class="row">
                            <div class="col-sm-12">
                                <h6>Elige el paciente</h6>
                                <div class="form-group">
                                    <select class="form-control">
                                        <option value="0">Todos</option>
                                        @foreach($patients as $patient)
                                        <option value="{{$patient->id}}">{{$patient->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <h6>Elige el tipo de reporte</h6>
                                <div class="form-group">
                                    <select class="form-control">
                                        <option value="0">Registrados</option>
                                        <option value="1">Atendidos</option>
                                        
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12 mt-2">
                                <h6>Fecha Desde</h6>
                                <div class="form-group">
                                    <input type="text" wire:model="dateFrom" class="form-control flatpickr" placeholder="Click para elegir">
                                </div>
                            </div>

                            <div class="col-sm-12 mt-2">
                                <h6>Fecha Hasta</h6>
                                <div class="form-group">
                                    <input type="text" wire:model="dateTo" class="form-control flatpickr" placeholder="Click para elegir">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <button wire:click="$refresh" class="btn btn-dark btn-block">
                                    Consultar
                                </button>

                                <a href="{{ url('report/pdf' . '/' . $patientId . '/' . $reportType . '/' . $dateFrom . '/' . $dateTo) }}" class="btn btn-dark btn-block {{count($data) <1 ? 'disabled' : '' }}" target="_blank">Generar PDF</a>

                                <a href="{{ url('report/excel' . '/' . $patientId . '/' . $reportType . '/' . $dateFrom . '/' . $dateTo) }}" class="btn btn-dark btn-block {{count($data) <1 ? 'disabled' : '' }}" target="_blank">Exportar a Excel</a>
                            </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-9">
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
                                            <th class="table-th text-white text-center">Fecha</th>
                                            <th class="table-th text-white text-center" width="50px"></th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if(count($data) < 1)
                                        <tr><td colspan="13"><h5>Sin resultados...</h5></td></tr>
                                            
                                        @endif
                                        @foreach ($data as $d)
                                        <tr>
                                            <td><h6>{{$d -> id}}</h6></td>
                                            <td><h6>{{$d -> name}}</h6></td>
                                            <td><h6>{{$d -> lastname}}</h6></td>
                                            <td><h6>{{$d -> dni}}</h6></td>
                                            <td><h6>{{$d -> phone}}</h6></td>
                                            <td><h6>{{$d -> email}}</h6></td>
                                            <td><h6>{{$d -> date_birth}}</h6></td>
                                            <td><h6>{{$d -> gender}}</h6></td>
                                            <td><h6>{{$d -> father_fullname}}</h6></td>
                                            <td><h6>{{$d -> father_dni}}</h6></td>
                                            <td><h6>{{$d -> mother_fullname}}</h6></td>
                                            <td><h6>{{$d -> mother_dni}}</h6></td>
                                            <td>
                                                <h6>
                                                    {{\Carbon\Carbon::parse($d->created_at)->format('d-m-Y')}}
                                                </h6>
                                            </td>
                                            <td class="text-center" width="50px">
                                                <button wire:click.prevent="getDetails({{$d->id}})" class="btn btn-dark btn-sm">
                                                    <i class="fas fa-list"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
    @include(livewire.reports.patients-detail)
</div>