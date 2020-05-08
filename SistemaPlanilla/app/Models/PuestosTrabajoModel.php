<?php namespace App\Models;

use CodeIgniter\Model;

class PuestosTrabajoModel extends Model
{
    protected $table      = 'PUESTOS_TRABAJO';
    protected $primaryKey = 'ID_PUESTO';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['DESCRIPCION_PUESTO','SALARIO_MIN','SALARIO_MAX'];


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