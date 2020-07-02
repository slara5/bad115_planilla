function editar_estado(id, descripcion, numPlanillas){
    document.querySelector('#ID_PERIOCIDAD').value = id;
    document.querySelector('#DESC_PERIOCIDAD').value = descripcion;
    document.querySelector('#PLANILLAS_POR_MES').value = numPlanillas;
    submit_form();
}
function limpiar(){
    document.querySelector('#ID_PERIOCIDAD').value = '';
    document.querySelector('#DESC_PERIOCIDAD').value = '';
    document.querySelector('#PLANILLAS_POR_MES').value = '';
    $("#btn_submit").attr('disabled', 'disabled');
}