<script>
    $('.tblscroll').nicescroll({
        cursoscolor: "#515365",
        cursorwidth: "30px",
        background: "rgba(20,20,20,0.3)",
        cursorborder: "0px",
        cursorborderradius:3
    })

function Confirm(id,eventName,text){
    console.log(eventName);
    // if(products > 0){
    // swal('NO SE PUEDE ELIMINAR EL PRODUCTO PORQUE TIENE VALORES RELACIONADOS')
    // return;
    // }

    swal({
    title: 'CONFIRMAR',
    text: text,
    type: 'warning',
    showCancelButton: true,
    cancelButtonText: 'Cerrar',
    cancelButtonColor: '#fff',
    confirmButtonColor: '#3B3F5C',
    confirmButtonText: 'Aceptar'
    }).then(function(result){
    if(result.value){
    window.livewire.emit(eventName,id)
    swal.close()
    }
    })
    }

</script>