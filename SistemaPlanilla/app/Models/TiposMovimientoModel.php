<?php namespace App\Models;

use CodeIgniter\Model;

class TiposMovimientoModel extends Model
{
    protected $table      = 'TIPOS_MOVIMIENTO';
    protected $primaryKey = 'ID_TIPO_MOVIMIENTO';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['NOMBRE_TIPO_MOVIMIENTO'];


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