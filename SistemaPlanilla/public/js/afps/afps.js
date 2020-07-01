function editar_estado(id, nombre,porcentaje_l,porcentaje_p,limite,){
    limpiar_validaciones();
    document.querySelector('#ID_AFP').value = id;
    document.querySelector('#NOMBRE_AFP').value = nombre;
    document.querySelector('#PORCENTAJE_LABORAL').value = porcentaje_l;
    document.querySelector('#PORCENTAJE_PATRONAL').value = porcentaje_p;
    document.querySelector('#LIMITE_MAXIMO_AFP').value = limite;
    submit_form();
}
function limpiar(){
    document.querySelector('#ID_AFP').value = "";
    document.querySelector('#NOMBRE_AFP').value ="" ;
    document.querySelector('#PORCENTAJE_LABORAL').value = "";
    document.querySelector('#PORCENTAJE_PATRONAL').value ="";
    document.querySelector('#LIMITE_MAXIMO_AFP').value = "";
    $("#btn_submit").attr('disabled', 'disabled');
    limpiar_validaciones();
}