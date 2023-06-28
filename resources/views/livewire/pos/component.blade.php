<div>
  <style></style>

  <div class="row layout-top-spacing">
    <div class="col-sm-12 col-md-8">
        <!--DETALLES-->
        @include('livewire.pos.partials.detail')
  </div>

  <div class="col-sm-12 col-md-4">
     <!--TOTAL-->
     @include('livewire.pos.partials.total')

     <!--DENOMINATIONS-->
     @include('livewire.pos.partials.coins')


     @include('livewire.pos.scripts.scan')
  </div>
  
</div>

<script></script>


@include('livewire.pos.scripts.shortcuts')
@include('livewire.pos.scripts.events')
@include('livewire.pos.scripts.general')
@include('livewire.pos.scripts.scan')

