function editar_estado(id, id_empleado, direccion){
    limpiar_validaciones();
    $('#ID_EMPLEADO').val(id_empleado);
    $('#ID_EMPLEADO').trigger('change');
    
    document.querySelector('#ID_DOMICILIO').value = id;
    document.querySelector('#ID_EMPLEADO').value = id_empleado;
    document.querySelector('#DIRECCION').value = direccion;
    submit_form();
}
function limpiar(){
    document.querySelector('#ID_DOMICILIO').value = '';
    // document.querySelector('#ID_EMPLEADO').value = '';
    document.querySelector('#DIRECCION').value = '';

    $("#btn_submit").attr('disabled', 'disabled');
    limpiar_validaciones();
}


function eliminar(id_domicilio){
    document.querySelector('#id_eliminar').value = id_domicilio;
}
