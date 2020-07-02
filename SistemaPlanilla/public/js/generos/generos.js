function editar_estado(id, nombre){
    limpiar_validaciones();
    document.querySelector('#ID_GENERO').value = id;
    document.querySelector('#DESCRIPCION_GENERO').value = nombre;
    submit_form();
}
function limpiar(){
    document.querySelector('#ID_GENERO').value = '';
    document.querySelector('#DESCRIPCION_GENERO').value = '';
    $("#btn_submit").attr('disabled', 'disabled');
    limpiar_validaciones();
}


function eliminar(id_genero){
    document.querySelector('#id_eliminar').value = id_genero;
}
