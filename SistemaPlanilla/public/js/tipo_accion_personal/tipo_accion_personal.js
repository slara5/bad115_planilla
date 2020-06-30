function editar_estado(id, DESCRIPCION){
    document.querySelector('#ID_TIPO').value = id;
    document.querySelector('#DESCRIPCION').value = DESCRIPCION;
}
function limpiar(){
    document.querySelector('#ID_TIPO').value = '';
    document.querySelector('#DESCRIPCION').value = '';

    $("#btn_submit").attr('disabled', 'disabled');
}

function eliminar(id_tipo){
    document.querySelector('#id_eliminar').value = id_tipo;
}
