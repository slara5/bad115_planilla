<?php namespace App\Models;

use CodeIgniter\Model;

class AreasModel extends Model
{
    protected $table      = 'AREAS';
    protected $primaryKey = 'IDAREA';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['ID_DEPARTAMENTO_EMPRESA','NOMBRE_AREA'];


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