function editar_estado(id, id_empleado, id_codigo, valor_cuota_descuento, fecha_inicio, fecha_fin, activo){
    limpiar_validaciones();

    $('#ID_EMPLEADO').val(id_empleado);
    $('#ID_EMPLEADO').trigger('change');
    $('#ID_CODIGO').val(id_codigo);
    $('#ID_CODIGO').trigger('change');
    
    document.querySelector('#ID_MOVIMIENTO_DESCUENTO').value = id;
    document.querySelector('#ID_EMPLEADO').value = id_empleado;
    document.querySelector('#ID_CODIGO').value = id_codigo;
    document.querySelector('#VALOR_CUOTA_DESCUENTO').value = valor_cuota_descuento;
    document.querySelector('#FECHA_INICIO_DESCUENTO').value = fecha_inicio;
    document.querySelector('#FECHA_FIN_DESCUENTO').value = fecha_fin;
    document.querySelector('#ACTIVO_DESCUENTO').value = activo;

    submit_form();
    
}
function limpiar(){
    document.querySelector('#ID_MOVIMIENTO_DESCUENTO').value = '';

    document.querySelector('#VALOR_CUOTA_DESCUENTO').value = '';
    document.querySelector('#FECHA_INICIO_DESCUENTO').value = '';
    document.querySelector('#FECHA_FIN_DESCUENTO').value = '';

    $("#btn_submit").attr('disabled', 'disabled');

    limpiar_validaciones();
}


function eliminar(id_movimiento_descuento){
    document.querySelector('#id_eliminar').value = id_movimiento_descuento;
}
