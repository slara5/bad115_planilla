<?php namespace App\Models;

use CodeIgniter\Model;

class TiposContratacionModel extends Model
{
    protected $table      = 'TIPOS_CONTRATACION';
    protected $primaryKey = 'ID_TIPO_CONTRATACION';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['NOMBRE_CONTRATACION'];


    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}