<?php namespace App\Models;

use CodeIgniter\Model;

class AfpsModel extends Model
{
    protected $table      = 'AFPS';
    protected $primaryKey = 'ID_AFP';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'NOMBRE_AFP',
    'PORCENTAJE_LABORAL',
    'PORCENTAJE_PATRONAL',
    'LIMITE_MAXIMO_AFP'
];


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