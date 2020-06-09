<?php namespace App\Models;

use CodeIgniter\Model;

class PeriodicidadPlanillaModel extends Model
{
    protected $table      = 'PERIODICIDAD_PLANILLA';
    protected $primaryKey = 'ID_PERIODICIDAD';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['NOMBRE_PERIODICIDAD','PLANILLAS_POR_MES'];


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