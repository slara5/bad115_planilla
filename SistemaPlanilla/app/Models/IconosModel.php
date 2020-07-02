<?php namespace App\Models;

use CodeIgniter\Model;

class IconosModel extends Model
{
	protected $table 			= 'ICONOS';
	protected $primaryKey 		= 'ID_ICONO';
	protected $returnType 		= 'array';

	protected $allowedFields 	= ['NOMBRE_ICONO'];

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