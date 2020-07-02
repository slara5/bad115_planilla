<?php namespace App\Models;

use CodeIgniter\Model;

class EmpresaModel extends Model
{
    protected $table      = 'EMPRESA';
    protected $primaryKey = 'ID_EMPRESA';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['ID_TABLA','ID_PERIOCIDAD','NOMBRE_EMPRESA',
    'PORCENTAJE_ISSS','NIT_EMPRESA','NUMERO_AFP_PATRONAL','PORCENTAJE_INSAFORP',
    'LIMITE_ISSS','NUMERO_EMP_MAX_INSAFORP','SALARIO_MINIMO'];


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

    function get_periodicidad($id){
        return ($this->find($id))['ID_PERIOCIDAD'];
    }

    function buscar($termino){ //busqueda de ids, retorno ids en formato string
        $movimiento = $this->select('ID_EMPRESA')
                ->like('NOMBRE_EMPRESA', $termino)
                ->findAll();
        $id_string = (count($movimiento) != 0)? []:['0'];
        for ($i=0; $i < count($movimiento); $i++) { 
            $id_string[count($id_string)] = strval($movimiento[$i]['ID_EMPRESA']);
        }
        return $id_string;
    }
}