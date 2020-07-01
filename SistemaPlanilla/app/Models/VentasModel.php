<?php namespace App\Models;

use CodeIgniter\Model;

class UnidadesModel extends Model
{
    protected $table      = 'VENTAS';
    protected $primaryKey = 'ID_COMPROBANTE';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['ID_EMPLEADO','ID_PLANILLA','VALOR_VENTA'];


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