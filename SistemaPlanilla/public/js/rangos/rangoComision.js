function editar_estado(
    ID_RANGO,
    ID_EMPRESA,
    DESDE_MONTO,
    HASTA_MONTO,
    PORCENTAJE_COMISION,
    ){
        limpiar_validaciones();
        $('#ID_EMPRESA').val(ID_EMPRESA);
        $('#ID_EMPRESA').trigger('change');
    
        document.querySelector('#ID_RANGO').value = ID_RANGO; 
        document.querySelector('#DESDE_MONTO').value = DESDE_MONTO;
        document.querySelector('#HASTA_MONTO').value = HASTA_MONTO;
        document.querySelector('#PORCENTAJE_COMISION').value = PORCENTAJE_COMISION;
        
        submit_form();
    }
    
    
    
    function limpiar(){
        document.querySelector('#ID_RANGO').value = '';
        document.querySelector('#DESDE_MONTO').value = '';
        document.querySelector('#HASTA_MONTO').value = '';
        document.querySelector('#PORCENTAJE_COMISION').value = '';
    
        $("#btn_submit").attr('disabled', 'disabled');
        limpiar_validaciones();
    }