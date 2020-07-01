<?php namespace App\Models;

use CodeIgniter\Model;

class AguinaldosModel extends Model
{
	protected $table 			= 'AGUINALDOS';
	protected $primaryKey 		= 'ID_AGUINALDO';
	protected $returnType 		= 'array';

    protected $allowedFields 	= ['ID_EMPLEADO', 'EJERCICIO', 'FECHA_CALCULO_AGUINALDO', 
                                    'ANIOS_TRABAJO','DIAS_AGUINALDO', 'TOTAL_AGUINALDO',
                                    'BONIFICACION_AGUINALDO', 'RENTA_AGUINALDO',
                                    'TOTAL_PAGAR_AGUINALDO'];

	protected $validationRules 		= [];
	protected $validationMessages 	= [];
	protected $skipValidation		= false;
	
	function get($id = ''){
        if($id == '' || $id == []){
            return $this->findAll();
        }else if(is_array($id)){
            return $this->find($id);
        }else{
            return [$this->find($id)];
        }
    }
    function get_ejercicio($id){
        $planilla = $this->find($id);
        return $planilla['EJERCICIO'];
    }
    

}