<?php namespace App\Models;

use CodeIgniter\Model;

class ProfesionesModel extends Model
{
    protected $table      = 'PROFESIONES';
    protected $primaryKey = 'ID_PROFESION_OFICIO';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['NOMBRE_PROFESION','ES_OFICIO'];


    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}