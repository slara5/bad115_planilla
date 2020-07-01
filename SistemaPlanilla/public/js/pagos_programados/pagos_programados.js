function editar_estado(id, id_empleado, id_codigo, valor_cuota_pago, fecha_inicio, fecha_fin, activo){
    limpiar_validaciones();

    $('#ID_EMPLEADO').val(id_empleado);
    $('#ID_EMPLEADO').trigger('change');
    $('#ID_CODIGO').val(id_codigo);
    $('#ID_CODIGO').trigger('change');
    
    document.querySelector('#ID_MOVIMIENTO_PAGO').value = id;
    document.querySelector('#ID_EMPLEADO').value = id_empleado;
    document.querySelector('#ID_CODIGO').value = id_codigo;
    document.querySelector('#VALOR_CUOTA_PAGO').value = valor_cuota_pago;
    document.querySelector('#FECHA_INICIO_PAGO').value = fecha_inicio;
    document.querySelector('#FECHA_FIN_PAGO').value = fecha_fin;
    document.querySelector('#ACTIVO_PAGO').value = activo;

    submit_form();
    
}
function limpiar(){
    document.querySelector('#ID_MOVIMIENTO_PAGO').value = '';

    document.querySelector('#VALOR_CUOTA_PAGO').value = '';
    document.querySelector('#FECHA_INICIO_PAGO').value = '';
    document.querySelector('#FECHA_FIN_PAGO').value = '';

    $("#btn_submit").attr('disabled', 'disabled');

    limpiar_validaciones();
}


function eliminar(id_movimiento_pago){
    document.querySelector('#id_eliminar').value = id_movimiento_pago;
}
