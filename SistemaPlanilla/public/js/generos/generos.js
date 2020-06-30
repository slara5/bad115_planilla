function editar_estado(id, nombre){
    document.querySelector('#ID_GENERO').value = id;
    document.querySelector('#DESCRIPCION_GENERO').value = nombre;
    submit_form();
}
function limpiar(){
    document.querySelector('#ID_GENERO').value = '';
    document.querySelector('#DESCRIPCION_GENERO').value = '';
    $("#btn_submit").attr('disabled', 'disabled');
}


function eliminar(id_genero){
    document.querySelector('#id_eliminar').value = id_genero;
}
