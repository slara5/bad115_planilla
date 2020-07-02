<?php namespace App\Models;

use CodeIgniter\Model;

class DepartamentosEmpresaModel extends Model
{
    protected $table      = 'DEPARTAMENTOS_EMPRESA';
    protected $primaryKey = 'ID_DEPARTAMENTO_EMPRESA';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['ID_UNIDAD',
    'NOMBRE_DEPARTAMENTO_EMPRESA',	
    'CODIGO_CENTRO_COSTO'];


    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;


    function get($id = ''){
        if($id == '' || $id == []){
            return $this->findAll();
        }else if(is_array($id)){
            return $this->find($id);
        }else{
            return [$this->find($id)];
        }
    }

    function get_nombre_departamento($id){
        $movimiento = $this->find($id);
        return $movimiento['NOMBRE_DEPARTAMENTO_EMPRESA'];
    }
    
    function buscar($termino){ //busqueda de ids, retorno ids en formato string
        $movimiento = $this->select('ID_DEPARTAMENTO_EMPRESA')
                ->like('NOMBRE_DEPARTAMENTO_EMPRESA', $termino)
                ->findAll();
        $id_string = (count($movimiento) != 0)? []:['0'];
        for ($i=0; $i < count($movimiento); $i++) { 
            $id_string[count($id_string)] = strval($movimiento[$i]['ID_DEPARTAMENTO_EMPRESA']);
        }
        return $id_string;
    }
}