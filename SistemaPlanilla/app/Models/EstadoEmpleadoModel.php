<?php namespace App\Models;

use CodeIgniter\Model;

class EstadoEmpleadoModel extends Model
{
    protected $table      = 'ESTADO_EMPLEADOS';
    protected $primaryKey = 'ID_ESTADO';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['NOMBRE_ESTADO', 'AFECTA_CALCULO'];


    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}