<?php namespace App\Models;

use CodeIgniter\Model;

class DepartamentosModel extends Model
{
    protected $table      = 'DEPARTAMENTOS';
    protected $primaryKey = 'ID_DEPARTAMENTO';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['NOMBRE_DEPARTAMENTO'];


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