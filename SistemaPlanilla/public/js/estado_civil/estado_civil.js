function editar_estado(id, nombre){
    document.querySelector('#ID_ESTADO_CIVIL').value = id;
    document.querySelector('#NOMBRE_ESTADO_CIVIL').value = nombre;
    submit_form();
}
function limpiar(){
    document.querySelector('#ID_ESTADO_CIVIL').value = '';
    document.querySelector('#NOMBRE_ESTADO_CIVIL').value = '';
    $("#btn_submit").attr('disabled', 'disabled');
}

function eliminar(id_estado){
    document.querySelector('#id_eliminar').value = id_estado;
}
