<?php namespace App\Models;

use CodeIgniter\Model;

class MenusModel extends Model
{
	protected $table 			= 'MENUS';
	protected $primaryKey 		= 'ID_MENU';
	protected $returnType 		= 'array';

	protected $allowedFields 	= ['ID_MENU_PADRE',
									'NOMBRE_MENU'];

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