<?php namespace App\Models;

use CodeIgniter\Model;

class MunicipioModel extends Model
{
    protected $table      = 'MUNICIPIOS';
    protected $primaryKey = 'ID_MUNICIPIO';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['ID_DEPARTAMENTO', 'NOMBRE_MUNICIPIO'];


    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}