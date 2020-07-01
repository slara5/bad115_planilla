function editar_estado(
    ID_PRESUPUESTO,
    ID_DEPARTAMENTO_EMPRESA,
    ANIO,
    MES,
    MONTO_PRESUPUESTOANUAL,
    ){
        limpiar_validaciones();
        $('#ID_DEPARTAMENTO_EMPRESA').val(ID_DEPARTAMENTO_EMPRESA);
        $('#ID_DEPARTAMENTO_EMPRESA').trigger('change');
    
        document.querySelector('#ID_PRESUPUESTO').value = ID_PRESUPUESTO; 
        document.querySelector('#ANIO').value = ANIO;
        document.querySelector('#MES').value = MES;
        document.querySelector('#MONTO_PRESUPUESTOANUAL').value = MONTO_PRESUPUESTOANUAL;
        
        submit_form();
    }
    
    
    
    function limpiar(){
        document.querySelector('#ID_PRESUPUESTO').value = '';
        document.querySelector('#ANIO').value = '';
        document.querySelector('#MES').value = '';
        document.querySelector('#MONTO_PRESUPUESTOANUAL').value = '';
    
        $("#btn_submit").attr('disabled', 'disabled');
        limpiar_validaciones();
    }