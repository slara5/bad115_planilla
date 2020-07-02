<?php namespace App\Models;

use CodeIgniter\Model;

class TiposContratacionModel extends Model
{
    protected $table      = 'TIPOS_CONTRATACION';
    protected $primaryKey = 'ID_TIPO_CONTRATACION';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['NOMBRE_CONTRATACION'];


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

    function get_nombre($id){
        return ($this->find($id))['NOMBRE_CONTRATACION'];
    }
}