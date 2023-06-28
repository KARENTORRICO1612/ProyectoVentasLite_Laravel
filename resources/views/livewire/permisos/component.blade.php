<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widger widget-chart-one">
            <div class="widget-heading">
                <h4 class="card-title">
                    <b>{{$componentName}} | {{$pageTitle}} </b>
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
                    <table class="table table-bordered table striped mt-1">
                        <thead class="text-white" style="background: #3B3F5C">
                            <tr>
                                <th class="table-th text-while">ID</th>
                                <th class="table-th text-while text-center">DESCRIPCIÓN</th>
                                <th class="table-th text-while text-center">ACTIONS</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($permisos as $permiso )
                            <tr>
                                <td><h6>{{$permiso->id}}</h6></td>
                                <td>
                                   <h6>{{$permiso->name}}</h6>
                                </td>

                                <td class="text-center">
                                    <a href="javascript:void(0)" 
                                    wire:click="Edit('{{$permiso->id}}')"
                                    class="btn btn-dark mtmobile" title="Editar Registro">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <a href="javascript:void(0)" 
                                    onClick="Confirm('{{$permiso->id}}')"
                                    class="btn btn-dark" title="Eliminar Registro">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$permisos->links()}} 
                </div>
            </div>

        </div>
    </div>

    @include('livewire.permisos.form')
</div>

<script>
    document.addEventListener('DOMContentLoaded',function(){
        window.livewire.on('permiso-added', Msg =>{
            $('#theModal').modal('hide')
            noty(Msg)
        })
        window.livewire.on('permiso-updated', Msg=> {
            $('#theModal').modal('hide')
            noty(Msg)
        })
        window.livewire.on('permiso-deleted', Msg =>{
            noty(Msg)
        })
        window.livewire.on('permiso-exists', Msg =>{
            noty(Msg)
        })
        window.livewire.on('permiso-error', Msg =>{
            noty(Msg)
        })
        window.livewire.on('hide-modal', Msg =>{
            $('#theModal').modal('hide')
        })
        window.livewire.on('show-modal', Msg =>{
            $('#theModal').modal('show')
        })
        // window.livewire.on('hidden.bs.modal',Msg => {
        //     $('.er').css('display','none')
        // })
    });

    function Confirm(id){
            
            swal({
            title: 'CONFIRMAR',
            text: '¿CONFIRMAS ELIMINAR EL REGISTRO?',
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cerrar',
            cancelButtonColor: '#fff',
            confirmButtonColor: '#3B3F5C',
            confirmButtonText: 'Aceptar',
        }).then(function(result){
            if(result.value){
                window.livewire.emit('deleteRow',id)
                swal.close()
            }
          })
        }
</script>