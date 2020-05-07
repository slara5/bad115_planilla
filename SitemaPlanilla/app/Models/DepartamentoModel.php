<?php namespace App\Models;

use CodeIgniter\Model;

class DepartamentoModel extends Model
{
    protected $table      = 'DEPARTAMENTOS';
    protected $primaryKey = 'ID_DEPARTAMENTO';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['NOMBRE_DEPARTAMENTO'];


    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}