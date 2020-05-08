<?php namespace App\Models;

use CodeIgniter\Model;

class SubSeccionesModel extends Model
{
    protected $table      = 'SUB_SECCIONES';
    protected $primaryKey = 'ID_SUB_SECCION';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['ID_SECCION','NOMBRE_SUB_SECCION'];


    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}