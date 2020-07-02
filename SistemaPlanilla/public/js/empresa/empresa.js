function editar_estado(
    ID_EMPRESA,
    ID_TABLA,
    ID_PERIOCIDAD,
    NOMBRE_EMPRESA,
    PORCENTAJE_ISSS,
    NIT_EMPRESA,
    NUMERO_AFP_PATRONAL,
    PORCENTAJE_INSAFORP,
    LIMITE_ISSS,
    NUMERO_EMP_MAX_INSAFORP,
    SALARIO_MINIMO,
    ){

        limpiar_validaciones();
        $('#ID_PERIOCIDAD').val(ID_PERIOCIDAD);
        $('#ID_PERIOCIDAD').trigger('change');
        $('#ID_TABLA').val(ID_TABLA);
        $('#ID_TABLA').trigger('change');

        document.querySelector('#ID_EMPRESA').value = ID_EMPRESA; 
        document.querySelector('#NOMBRE_EMPRESA').value = NOMBRE_EMPRESA;
        document.querySelector('#PORCENTAJE_ISSS').value = PORCENTAJE_ISSS;
        document.querySelector('#NIT_EMPRESA').value = NIT_EMPRESA;
        document.querySelector('#NUMERO_AFP_PATRONAL').value = NUMERO_AFP_PATRONAL; 
        document.querySelector('#PORCENTAJE_INSAFORP').value = PORCENTAJE_INSAFORP;
        document.querySelector('#LIMITE_ISSS').value = LIMITE_ISSS;
        document.querySelector('#NUMERO_EMP_MAX_INSAFORP').value = NUMERO_EMP_MAX_INSAFORP;
        document.querySelector('#SALARIO_MINIMO').value = SALARIO_MINIMO;
        
        submit_form();
    }
    
    
    
    function limpiar(){
        document.querySelector('#ID_EMPRESA').value = '';
        document.querySelector('#NOMBRE_EMPRESA').value = '';
        document.querySelector('#PORCENTAJE_ISSS').value = '';
        document.querySelector('#NIT_EMPRESA').value = '';
        document.querySelector('#NUMERO_AFP_PATRONAL').value = '';
        document.querySelector('#PORCENTAJE_INSAFORP').value = '';
        document.querySelector('#LIMITE_ISSS').value = '';
        document.querySelector('#NUMERO_EMP_MAX_INSAFORP').value = '';
        document.querySelector('#SALARIO_MINIMO').value = '';
    
        $("#btn_submit").attr('disabled', 'disabled');
        limpiar_validaciones();
    }