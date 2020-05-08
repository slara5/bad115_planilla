<?php namespace App\Models;

use CodeIgniter\Model;

class SeccionesModel extends Model
{
    protected $table      = 'SECCIONES';
    protected $primaryKey = 'ID_SECCION';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['NOMBRE_SECCION','IDAREA'];


    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}