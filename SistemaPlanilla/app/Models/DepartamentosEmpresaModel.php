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
}