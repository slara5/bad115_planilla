<?php namespace App\Models;

use CodeIgniter\Model;

class DomiciliosModel extends Model
{
	protected $table 			= 'DOMICILIOS';
	protected $primaryKey 		= 'ID_DOMICILIO';
	protected $returnType 		= 'array';

	protected $allowedFields 	= ['ID_EMPLEADO', 'DIRECCION', 'DESDE_FECHA_DOMICILIO'];

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