<?php namespace App\Models;

use CodeIgniter\Model;

class GeneroModel extends Model
{
    protected $table      = 'GENEROS';
    protected $primaryKey = 'ID_GENERO';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['DESCRIPCION_GENERO'];


    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}