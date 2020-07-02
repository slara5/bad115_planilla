<?php namespace App\Models;

use CodeIgniter\Model;

class TipoAccionPersonalModel extends Model
{
	protected $table 			= 'TIPO_ACCION_PERSONAL';
	protected $primaryKey 		= 'ID_TIPO';
	protected $returnType 		= 'array';

	protected $allowedFields 	= ['DESCRIPCION'];

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

    function get_descripcion($id){
        $tipo = $this->find($id);
        return $tipo['DESCRIPCION'];
    }

    function buscar($termino){ //busqueda de ids, retorno ids en formato string
        $tipos = $this->select('ID_TIPO')
                ->like('DESCRIPCION', $termino)
                ->findAll();
        $id_string = (count($tipos) != 0)? []:['0'];;
        for ($i=0; $i < count($tipos); $i++) { 
            $id_string[count($id_string)] = strval($tipos[$i]['ID_TIPO']);
        }
        return $id_string;
    }
}