<?php namespace App\Models;

use CodeIgniter\Model;

class DepartamentoModel extends Model
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
}