function editar_estado(id, usuario, rol, nombres, apellidos){
    limpiar_validaciones();
    document.querySelector('#ID_USUARIO').value = id;
    document.querySelector('#USUARIO').value = usuario;
    document.querySelector('#ID_ROL').value = rol;
    document.querySelector('#NOMBRES').value = nombres;
    document.querySelector('#APELLIDOS').value = apellidos;
    submit_form();
}
function limpiar(){
    document.querySelector('#ID_USUARIO').value = '';
    document.querySelector('#NOMBRES').value = '';
    document.querySelector('#APELLIDOS').value = '';
    document.querySelector('#USUARIO').value = '';
    document.querySelector('#CONTRASENIA').value = '';
    document.querySelector('#CONFIRMAR_CONTRASENIA').value = '';
    
    $("#btn_submit").attr('disabled', 'disabled');
    limpiar_validaciones();
}