<?php namespace App\Models;

use CodeIgniter\Model;

class RangoComisionModel extends Model
{
    protected $table      = 'RANGO_COMISION';
    protected $primaryKey = 'ID_RANGO';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['ID_EMPRESA','DESDE_MONTO','HASTA_MONTO','PORCENTAJE_COMISION'];


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