<?php namespace App\Models;

use CodeIgniter\Model;

class PermisosModel extends Model
{
	protected $table 			= 'PERMISOS';
	protected $primaryKey 		= 'ID_PERMISO';
	protected $returnType 		= 'array';

	protected $allowedFields 	= ['ID_ROL',
									'ID_MENU'];

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