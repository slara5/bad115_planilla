<?php namespace App\Models;

use CodeIgniter\Model;

class PagosEventualesModel extends Model
{
	protected $table 			= 'PAGOS_EVENTUALES';
	protected $primaryKey 		= 'ID_TRANSACCION_PAGO';
	protected $returnType 		= 'array';

    protected $allowedFields 	= ['ID_EMPLEADO', 'ID_CODIGO', 'ID_PLANILLA', 'VALOR_PAGO', 
                                    'FECHA_PAGO', 'DESCRIPCION__PAGO'];

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