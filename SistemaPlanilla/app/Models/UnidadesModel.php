<?php namespace App\Models;

use CodeIgniter\Model;

class UnidadesModel extends Model
{
    protected $table      = 'UNIDADES';
    protected $primaryKey = 'ID_UNIDAD';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['NOMBRE_UNIDAD'];


    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}