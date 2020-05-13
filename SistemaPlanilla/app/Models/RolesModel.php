<?php namespace App\Models;

use CodeIgniter\Model;

class RolesModel extends Model
{
	protected $table 			= 'ROLES';
	protected $primaryKey 		= 'ID_ROL';
	protected $returnType 		= 'array';

	protected $allowedFields 	= ['NOMBRE_ROL'];

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