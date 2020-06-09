<?php namespace App\Models;

use CodeIgniter\Model;

class EmpresaModel extends Model
{
    protected $table      = 'EMPRESA';
    protected $primaryKey = 'ID_EMPRESA';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['ID_TABLA','ID_PERIODICIDAD','NOMBRE_EMPRESA',
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
}