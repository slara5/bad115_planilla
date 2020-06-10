<?php namespace App\Models;

use CodeIgniter\Model;

class UsuariosModel extends Model
{
	protected $table 			= 'USUARIOS';
	protected $primaryKey 		= 'ID_USUARIO';
	protected $returnType 		= 'array';

	protected $allowedFields 	= ['ID_ROL',
									'USUARIO',
									'CONTRASENIA',
									'NOMBRES',
									'APELLIDOS',
									'ACTIVO',
									'FECHA_HORA_CREACION'];

	protected $validationRules 		= [];
	protected $validationMessages 	= [];
	protected $skipValidation		= false;

	protected $beforeInsert 		= ['encriptar'];
	protected $beforeUpdate			= ['encriptar'];
	

	protected function encriptar(array $data)
	{
		if(isset($data['data']['CONTRASENIA']))
			$data['data']['CONTRASENIA'] = password_hash($data['data']['CONTRASENIA'], PASSWORD_BCRYPT);
		return $data;
	}

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