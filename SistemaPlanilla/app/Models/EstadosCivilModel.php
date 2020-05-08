<?php namespace App\Models;

use CodeIgniter\Model;

class EstadosCivilModel extends Model
{
    protected $table      = 'ESTADOS_CIVIL';
    protected $primaryKey = 'ID_ESTADO_CIVIL';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['NOMBRE_ESTADO_CIVIL'];


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