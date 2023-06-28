{{-- @include('common.modalHead') --}}

<div wire:ignore.self class="modal fade" id="theModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white">
                    <b>PRUEBA DE TOTALES</b>
                </h5>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
                <h6 class="text-center text-warning" wire:loading>POR FAVOR ESPERE</h6>
            </div>
            <div class="modal-body">


                <div class="row">

                    <div class="col-sm-12 col-md-8">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" wire:model.lazy="name" class="form-control"
                                placeholder="ej: Curso Laravel">
                            @error('name') <span class="text-danger er">{{$message}}</span>@enderror
                        </div>
                    </div>
                </div>

                
            </div>
        </div>
    </div>
</div>