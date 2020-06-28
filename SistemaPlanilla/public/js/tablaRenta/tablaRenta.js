function editar_estado(id, nombre){
    document.querySelector('#ID_TABLA').value = id;
    document.querySelector('#NOMBRE_TABLA').value = nombre;
    submit_form();
}
function limpiar(){
    document.querySelector('#ID_TABLA').value = '';
    document.querySelector('#NOMBRE_TABLA').value = '';
    $("#btn_submit").attr('disabled', 'disabled');
}