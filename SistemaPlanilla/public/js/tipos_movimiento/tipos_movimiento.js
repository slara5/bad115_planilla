function editar_estado(id, nombre){
    document.querySelector('#ID_TIPO_MOVIMIENTO').value = id;
    document.querySelector('#NOMBRE_TIPO_MOVIMIENTO').value = nombre;
    submit_form();
}
function limpiar(){
    document.querySelector('#ID_TIPO_MOVIMIENTO').value = '';
    document.querySelector('#NOMBRE_TIPO_MOVIMIENTO').value = '';
    $("#btn_submit").attr('disabled', 'disabled');
}