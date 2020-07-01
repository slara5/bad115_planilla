<?php namespace App\Models;

use CodeIgniter\Model;

class PlanillasModel extends Model
{
	protected $table 			= 'PLANILLAS';
	protected $primaryKey 		= 'ID_PLANILLA';
	protected $returnType 		= 'array';

    protected $allowedFields 	= ['ID_ESTATUS', 'ID_PERIOCIDAD', 'CODIGO', 
                                    'DESDE_FECHA','HASTA_FECHA', 'FECHA_PLANILLA',
                                    'FECHA_CIERRE', 'ID_USUARIO_CIERRE'];

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