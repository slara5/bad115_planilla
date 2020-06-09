<?php namespace App\Models;

use CodeIgniter\Model;

class DetallesTablaRentaModel extends Model
{
    protected $table      = 'DETALLES_TABLA_RENTA';
    protected $primaryKey = 'ID_RANGO_RENTA';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['ID_TABLA','DESDE_MONTO_INGRESOS','HASTA_MONTO_INGRESOS',
    'PORCENTAJE_RENTA_TABLA','VALOR_FIJO_RENTA_TABLA'];


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