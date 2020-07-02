<?php namespace App\Models;

use CodeIgniter\Model;

class TelefonosModel extends Model
{
	protected $table 			= 'TELEFONOS';
	protected $primaryKey 		= 'ID_TELEFONO';
	protected $returnType 		= 'array';

	protected $allowedFields 	= ['ID_EMPLEADO', 'TELEFONO','TIPO_TELEFONO', 'DESDE_FECHA_TELEFONO'];

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