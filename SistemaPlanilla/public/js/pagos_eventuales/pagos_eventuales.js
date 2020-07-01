function editar_estado(id, id_empleado, id_codigo, id_planilla, valor_pago, fecha_pago, descripcion){
    limpiar_validaciones();

    $('#ID_EMPLEADO').val(id_empleado);
    $('#ID_EMPLEADO').trigger('change');
    $('#ID_CODIGO').val(id_codigo);
    $('#ID_CODIGO').trigger('change');
    $('#ID_PLANILLA').val(id_planilla);
    $('#ID_PLANILLA').trigger('change');
    
    document.querySelector('#ID_TRANSACCION_PAGO').value = id;
    document.querySelector('#ID_EMPLEADO').value = id_empleado;
    document.querySelector('#ID_CODIGO').value = id_codigo;
    document.querySelector('#ID_PLANILLA').value = id_planilla;
    document.querySelector('#VALOR_PAGO').value = valor_pago;
    document.querySelector('#FECHA_PAGO').value = fecha_pago;
    document.querySelector('#DESCRIPCION_PAGO').value = descripcion;

    submit_form();
    
}
function limpiar(){
    document.querySelector('#ID_TRANSACCION_PAGO').value = '';

    document.querySelector('#VALOR_PAGO').value = '';
    document.querySelector('#FECHA_PAGO').value = '';
    document.querySelector('#DESCRIPCION_PAGO').value = '';

    $("#btn_submit").attr('disabled', 'disabled');

    limpiar_validaciones();
}


function eliminar(id_transaccion_pago){
    document.querySelector('#id_eliminar').value = id_transaccion_pago;
}
