function editar_estado(id, id_empleado, telefono, tipo){

    $('#ID_EMPLEADO').val(id_empleado);
    $('#ID_EMPLEADO').trigger('change');

    document.querySelector('#ID_TELEFONO').value = id;
    document.querySelector('#ID_EMPLEADO').value = id_empleado;
    document.querySelector('#TELEFONO').value = telefono;
    document.querySelector('#TIPO_TELEFONO').value = tipo;

}
function limpiar(){
    document.querySelector('#ID_TELEFONO').value = '';
    // document.querySelector('#ID_EMPLEADO').value = '';
    document.querySelector('#TELEFONO').value = '';
    document.querySelector('#TIPO_TELEFONO').value = '';

    $("#btn_submit").attr('disabled', 'disabled');
}


function eliminar(id_telefono){
    document.querySelector('#id_eliminar').value = id_telefono;
}
