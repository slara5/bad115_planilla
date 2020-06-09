<?php namespace App\Models;

use CodeIgniter\Model;

class TablaRentaModel extends Model
{
    protected $table      = 'TABLA_RENTA';
    protected $primaryKey = 'ID_TABLA';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['NOMBRE_TABLA'];


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