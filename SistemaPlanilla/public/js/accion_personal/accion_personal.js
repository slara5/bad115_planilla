function editar_estado(id, id_empleado, id_tipo, FECHA_ACCION, DIAS_APLICAR, DESCUENTA_DIAS){
    limpiar_validaciones();

    $('#ID_EMPLEADO').val(id_empleado);
    $('#ID_EMPLEADO').trigger('change');
    $('#ID_TIPO').val(id_tipo);
    $('#ID_TIPO').trigger('change');
    
    document.querySelector('#ID_ACCION').value = id;
    document.querySelector('#ID_TIPO').value = id_tipo;
    document.querySelector('#ID_EMPLEADO').value = id_empleado;
    document.querySelector('#FECHA_ACCION').value = FECHA_ACCION;
    document.querySelector('#DIAS_APLICAR').value = DIAS_APLICAR;
    document.querySelector('#DESCUENTA_DIAS').value = DESCUENTA_DIAS;

    submit_form();
}
function limpiar(){
    document.querySelector('#ID_ACCION').value = '';
    // document.querySelector('#ID_TIPO').value = '';
    // document.querySelector('#ID_EMPLEADO').value = '';
    document.querySelector('#FECHA_ACCION').value = '';
    document.querySelector('#DIAS_APLICAR').value = '';
    // document.querySelector('#DESCUENTA_DIAS').value = '';

    $("#btn_submit").attr('disabled', 'disabled');

    limpiar_validaciones();
}


function eliminar(id_accion){
    document.querySelector('#id_eliminar').value = id_accion;
}
