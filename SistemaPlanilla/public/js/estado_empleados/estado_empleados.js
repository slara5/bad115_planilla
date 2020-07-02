function editar_estado(id, nombre, afecta){
    limpiar_validaciones();
    document.querySelector('#ID_ESTADO').value = id;
    document.querySelector('#NOMBRE_ESTADO').value = nombre;
    document.querySelector('#AFECTA_CALCULO').value = afecta;
    submit_form();
}
function limpiar(){
    document.querySelector('#ID_ESTADO').value = '';
    document.querySelector('#NOMBRE_ESTADO').value = '';
    $("#btn_submit").attr('disabled', 'disabled');
    limpiar_validaciones();
}

function eliminar(id_estado_empleado){
    document.querySelector('#id_eliminar').value = id_estado_empleado;
}
