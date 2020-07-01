

function editar_estado(id, nombre){
    limpiar_validaciones();
    document.querySelector('#ID_TIPO_MOVIMIENTO').value = id;
    document.querySelector('#NOMBRE_TIPO_MOVIMIENTO').value = nombre;
    submit_form();
}
function limpiar(){
    document.querySelector('#ID_TIPO_MOVIMIENTO').value = '';
    document.querySelector('#NOMBRE_TIPO_MOVIMIENTO').value = '';
    $("#btn_submit").attr('disabled', 'disabled');
    limpiar_validaciones();
}

function borrar(ID_TIPO_MOVIMIENTO, nombre, ruta){

    var self = this;
    Swal.fire({
      title: 'Desea eliminar '+nombre+'?',
      text: "Se eliminará permanentemente!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, borrar!',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if(result.value) {
        $.ajax({
          type: 'post',
          url: ruta,
          data: {ID_TIPO_MOVIMIENTO:ID_TIPO_MOVIMIENTO},
          success:function(){
            Swal.fire(
              'Eliminando',
              'Registro Eliminado',
              'success'
            );
          },
          error:function(){
            Swal.fire(
              'Eliminando',
              'Error al eliminar',
              'error'
            )
          },
        });
      }
    });
}

/*
$(document).on("click","tr td #delete",function(){ 
  alert("hola");
});
*/
