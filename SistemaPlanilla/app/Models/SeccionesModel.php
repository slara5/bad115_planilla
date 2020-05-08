<?php namespace App\Models;

use CodeIgniter\Model;

class SeccionesModel extends Model
{
    protected $table      = 'SECCIONES';
    protected $primaryKey = 'ID_SECCION';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['NOMBRE_SECCION','IDAREA'];


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