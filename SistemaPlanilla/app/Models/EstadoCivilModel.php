<?php namespace App\Models;

use CodeIgniter\Model;

class EstadoCivilModel extends Model
{
    protected $table      = 'ESTADOS_CIVIL';
    protected $primaryKey = 'ID_ESTADO_CIVIL';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['NOMBRE_ESTADO_CIVIL'];


    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}