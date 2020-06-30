<?php namespace App\Models;

use CodeIgniter\Model;

class AccionPersonalModel extends Model
{
	protected $table 			= 'ACCION_PERSONAL';
	protected $primaryKey 		= 'ID_ACCION';
	protected $returnType 		= 'array';

	protected $allowedFields 	= ['ID_TIPO', 'ID_EMPLEADO', 'FECHA_ACCION','DIAS_APLICAR', 'DESCUENTA_DIAS'];

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