function editar_estado(
    ID_CODIGO,
    ID_TIPO_MOVIMIENTO,
    NOMBRE_CONCEPTO,
    APLICA_SEGURO,
    APLICA_AFP,
    APLICA_SEGURO,
    TIPO,
    PREFIJO,
    ){
        limpiar_validaciones();
        $('#ID_TIPO_MOVIMIENTO').val(ID_TIPO_MOVIMIENTO);
        $('#ID_TIPO_MOVIMIENTO').trigger('change');
    
        document.querySelector('#ID_CODIGO').value = ID_CODIGO; 
        document.querySelector('#NOMBRE_CONCEPTO').value = NOMBRE_CONCEPTO;
        document.querySelector('#APLICA_SEGURO').value = APLICA_SEGURO;
        document.querySelector('#APLICA_AFP').value = APLICA_AFP;
        document.querySelector('#APLICA_RENTA').value = APLICA_RENTA;
        document.querySelector('#TIPO').value = TIPO;
        document.querySelector('#PREFIJO').value = PREFIJO;
        
        submit_form();
    }
    
    
    
    function limpiar(){
        document.querySelector('#ID_CODIGO').value = '';
        document.querySelector('#NOMBRE_CONCEPTO').value = '';
        document.querySelector('#APLICA_SEGURO').value = '';
        document.querySelector('#APLICA_AFP').value = '';
        document.querySelector('#APLICA_RENTA').value = '';
        document.querySelector('#TIPO').value = '';
        document.querySelector('#PREFIJO').value = '';
    
        $("#btn_submit").attr('disabled', 'disabled');
        limpiar_validaciones();
    }