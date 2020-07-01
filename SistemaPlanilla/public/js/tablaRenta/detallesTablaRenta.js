function editar_estado(
    ID_RANGO_RENTA,
    ID_TABLA,
    DESDE_MONTO_INGRESOS,
    HASTA_MONTO_INGRESOS,
    PORCENTAJE_RENTA_TABLA,
    VALOR_FIJO_RENTA_TABLA,
    ){
        limpiar_validaciones();
        $('#ID_TABLA').val(ID_TABLA);
        $('#ID_TABLA').trigger('change');
    
        document.querySelector('#ID_RANGO_RENTA').value = ID_RANGO_RENTA; 
        document.querySelector('#DESDE_MONTO_INGRESOS').value = DESDE_MONTO_INGRESOS;
        document.querySelector('#HASTA_MONTO_INGRESOS').value = HASTA_MONTO_INGRESOS;
        document.querySelector('#PORCENTAJE_RENTA_TABLA').value = PORCENTAJE_RENTA_TABLA;
        document.querySelector('#VALOR_FIJO_RENTA_TABLA').value = VALOR_FIJO_RENTA_TABLA;
        
        submit_form();
    }
    
    
    
    function limpiar(){
        document.querySelector('#ID_RANGO_RENTA').value = '';
        document.querySelector('#DESDE_MONTO_INGRESOS').value = '';
        document.querySelector('#HASTA_MONTO_INGRESOS').value = '';
        document.querySelector('#PORCENTAJE_RENTA_TABLA').value = '';
        document.querySelector('#VALOR_FIJO_RENTA_TABLA').value = '';
    
        $("#btn_submit").attr('disabled', 'disabled');
        limpiar_validaciones();
    }