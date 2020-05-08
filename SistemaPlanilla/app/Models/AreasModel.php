<?php namespace App\Models;

use CodeIgniter\Model;

class AreasModel extends Model
{
    protected $table      = 'AREAS';
    protected $primaryKey = 'IDAREA';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['ID_DEPARTAMENTO_EMPRESA','NOMBRE_AREA'];


    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}