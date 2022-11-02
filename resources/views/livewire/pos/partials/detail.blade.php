<div class="connect-sorting">
    <div class="connect-sorting-content">
        <div class="card simple-title-task ui-sortable-handle">
            <div class="card-body">
            
            @if($total > 0)

            <div class="table-responsive tblscroll" style="max-height: 650px; overflow:hidden;">
                <table class="table table-bordered table-striped mt-1">
                    <thead class="text-white" style="background: #3b3f5c">
                        <tr>
                            <th class="table-th text-left text-white">Nombre y Apellido</th>
                            <th class="table-th text-left text-white">DNI</th>
                            <th class="table-th text-left text-white">Teléfono</th>
                            <th class="table-th text-left text-white">Sexo</th>
                            <th class="table-th text-left text-white">Padre o Madre</th>
                            <th class="table-th text-left text-white">Vacuna</th>
                            <th width="13%" class="table-th text-left text-white">Cantidad</th>
                            <th class="table-th text-left text-white">Fecha</th>
                            <th class="table-th text-left text-white">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart as $item)
                            
                        
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><h6>{{$item->name}}</h6></td>
                            <td>
                                <input type="number" id="r{{$item->id}}" wire:change="updateQty({{$item->id}}, $('#r' + {{$item->id}}).val() )" style="font-size: 1rem!important" class="form-control text-center" value="{{$item->quantity}}">
                            </td>
                            <td></td>
                            <td class="text-center">
                                <button onclick="Confirm('{{$item->id}}', 'removeItem', '¿Confirmas Eliminar el registro?')" class="btn btn-dark mbmobile">
                                    <i class="fas fa-trash-alt">

                                    </i>
                                </button>
                                <button wire:click.prevent="decreaseQty({{$item->id}})" class="btn btn-dark mbmobile">
                                    <i class="fas fa-minus">
                                </button>
                                <button wire:click.prevent="increaseQty({{$item->id}})" class="btn btn-dark mbmobile">
                                    <i class="fas fa-minus">
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
                            
            @else
            <h5 class="text-center text-muted">Agrega vacuna a la Ficha</h5>
            @endif

            <div wire:loading.inline wire:target="saveSale">
                <h4 class="text-danger text-center">Guardando Ficha...</h4>
            </div>

            </div>
        </div>
    </div>
</div>