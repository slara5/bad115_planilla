<?php namespace App\Models;

use CodeIgniter\Model;

class GenerosModel extends Model
{
    protected $table      = 'GENEROS';
    protected $primaryKey = 'ID_GENERO';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['DESCRIPCION_GENERO'];


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