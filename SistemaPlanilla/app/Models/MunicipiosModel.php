<?php namespace App\Models;

use CodeIgniter\Model;

class MunicipiosModel extends Model
{
    protected $table      = 'MUNICIPIOS';
    protected $primaryKey = 'ID_MUNICIPIO';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['ID_DEPARTAMENTO', 'NOMBRE_MUNICIPIO'];


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