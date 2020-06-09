<?php namespace App\Models;

use CodeIgniter\Model;

class PresupuestosModel extends Model
{
    protected $table      = 'PRESUPUESTOS';
    protected $primaryKey = 'ID_PRESUPUESTO';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['ID_DEPARTAMENTO_EMPRESA','ANIO','MES','MONTO_PRESUPUESTOANUAL'];


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