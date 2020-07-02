<?php namespace App\Models;

use CodeIgniter\Model;

class PeriodicidadPlanillaModel extends Model
{
    protected $table      = 'PERIOCIDAD_PLANILLA';
    protected $primaryKey = 'ID_PERIOCIDAD';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['DESC_PERIOCIDAD','PLANILLAS_POR_MES'];


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

    function get_descripcion($id){
        return ($this->find($id))['DESC_PERIOCIDAD'];
    }
}