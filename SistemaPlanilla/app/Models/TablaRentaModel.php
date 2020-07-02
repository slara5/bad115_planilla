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

    function buscar($termino){ //busqueda de ids, retorno ids en formato string
        $movimiento = $this->select('ID_TABLA')
                ->like('NOMBRE_TABLA', $termino)
                ->findAll();
        $id_string = (count($movimiento) != 0)? []:['0'];
        for ($i=0; $i < count($movimiento); $i++) { 
            $id_string[count($id_string)] = strval($movimiento[$i]['ID_TABLA']);
        }
        return $id_string;
    }
}