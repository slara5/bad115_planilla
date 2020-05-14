function editar_estado(id, nombre){
    document.querySelector('#ID_TIPO_CONTRATACION').value = id;
    document.querySelector('#NOMBRE_CONTRATACION').value = nombre;
    submit_form();
}
function limpiar(){
    document.querySelector('#ID_TIPO_CONTRATACION').value = '';
    document.querySelector('#NOMBRE_CONTRATACION').value = '';
    $("#btn_submit").attr('disabled', 'disabled');
}