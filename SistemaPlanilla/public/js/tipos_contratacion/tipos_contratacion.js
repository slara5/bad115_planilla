function editar_estado(id, nombre){
    limpiar_validaciones();
    document.querySelector('#ID_TIPO_CONTRATACION').value = id;
    document.querySelector('#NOMBRE_CONTRATACION').value = nombre;
    submit_form();
}
function limpiar(){
    document.querySelector('#ID_TIPO_CONTRATACION').value = '';
    document.querySelector('#NOMBRE_CONTRATACION').value = '';
    $("#btn_submit").attr('disabled', 'disabled');
    limpiar_validaciones();
}

function eliminar(id_tipo){
    document.querySelector('#id_eliminar').value = id_tipo;
}
