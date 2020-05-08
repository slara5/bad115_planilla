<?php namespace App\Models;

use CodeIgniter\Model;

class EstadoEmpleadosModel extends Model
{
    protected $table      = 'ESTADO_EMPLEADOS';
    protected $primaryKey = 'ID_ESTADO';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['NOMBRE_ESTADO', 'AFECTA_CALCULO'];


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