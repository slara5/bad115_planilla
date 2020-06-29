<?php namespace App\Models;

use CodeIgniter\Model;

class IngresosDescuentosModel extends Model
{
	protected $table 			= 'CATALOGO_INGRESOS_DESCUENTOS';
	protected $primaryKey 		= 'ID_CODIGO';
	protected $returnType 		= 'array';

	protected $allowedFields 	= ['ID_TIPO_MOVIMIENTO',
									'NOMBRE_CONCEPTO',
									'APLICA_SEGURO',
									'APLICA_AFP',
									'APLICA_RENTA',
									'TIPO',
									'PREFIJO'];

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