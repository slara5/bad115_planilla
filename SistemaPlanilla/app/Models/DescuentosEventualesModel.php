<?php namespace App\Models;

use CodeIgniter\Model;

class DescuentosEventualesModel extends Model
{
	protected $table 			= 'DESCUENTOS_EVENTUALES';
	protected $primaryKey 		= 'ID_TRANSACCION_DESCUENTO';
	protected $returnType 		= 'array';

    protected $allowedFields 	= ['ID_EMPLEADO', 'ID_CODIGO', 'ID_PLANILLA', 'VALOR_DESCUENTO', 
                                    'FECHA_DESCUENTO', 'DESCRIPCION_DESCUENTO'];

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