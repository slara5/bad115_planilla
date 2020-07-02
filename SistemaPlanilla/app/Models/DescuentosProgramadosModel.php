<?php namespace App\Models;

use CodeIgniter\Model;

class DescuentosProgramadosModel extends Model
{
	protected $table 			= 'DESCUENTOS_PROGRAMADOS';
	protected $primaryKey 		= 'ID_MOVIMIENTO_DESCUENTO';
	protected $returnType 		= 'array';

    protected $allowedFields 	= ['ID_EMPLEADO', 'ID_CODIGO', 'VALOR_CUOTA_DESCUENTO', 
                                    'FECHA_INICIO_DESCUENTO','FECHA_FIN_DESCUENTO', 'ACTIVO_DESCUENTO'];

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
}