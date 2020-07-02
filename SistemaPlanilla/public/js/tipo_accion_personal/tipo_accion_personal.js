function editar_estado(id, DESCRIPCION){
    limpiar_validaciones();
    document.querySelector('#ID_TIPO').value = id;
    document.querySelector('#DESCRIPCION').value = DESCRIPCION;
    submit_form();
}
function limpiar(){
    document.querySelector('#ID_TIPO').value = '';
    document.querySelector('#DESCRIPCION').value = '';

    $("#btn_submit").attr('disabled', 'disabled');
    limpiar_validaciones();
}

function eliminar(id_tipo){
    document.querySelector('#id_eliminar').value = id_tipo;
}
