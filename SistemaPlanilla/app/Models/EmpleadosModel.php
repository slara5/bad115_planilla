<?php namespace App\Models;

use CodeIgniter\Model;

class EmpleadosModel extends Model
{
    protected $table      = 'EMPLEADOS';
    protected $primaryKey = 'ID_EMPLEADO';

    protected $returnType     = 'array';

    protected $allowedFields = ['ID_SUB_SECCION', 'ID_ESTADO', 'ID_ESTADO_CIVIL', 
                                'ID_AFP', 'ID_PUESTO', 'ID_GENERO','ID_TIPO_CONTRATACION',
                                'ID_MUNICIPIO', 'ID_PROFESION_OFICIO',
                                'CODIGO_EMPLEADO', 'NOMBRE_PRIMERO', 'NOMBRE_SEGUNDO',
                                'APELLIDO_PATERNO', 'APELLIDO_MATERNO', 'FECHA_NACIMIENTO',
                                'DIRECCION', 'NUMERO_DOCUMENTO', 'FECHA_EXPEDICION', 
                                'NIT', 'NUP', 'NUMERO_ISSS', 'FECHA_INGRESO', 
                                'FECHA_CONTRATACION', 'SALARIO', 'CORREO_ELECTRONICO_INSTITUCIONAL',
                                'CORREO_ELECTRONICO_PERSONAL', 'TELEFONO', 'TELEFONO_MOVIL',
                                'NIVEL_ESTUDIOS', 'ID_EMPLEADO_JEFE', 'FECHA_RETIRO', 
                                'HORARIO_TRABAJO', 'ID_USUARIO_CREO_EMPLEADO', 'FECHA_HORA_CREACION_EMPLEADO'];


    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    function get($id = ''){
        if($id == '' || $id == []){
            return $this->findAll();
        }else if(is_array($id)){
            return $this->find($id);
        }else{
            return [$this->find($id)];
        }
    }

    function get_last_empleado(){
        return $this->orderBy('FECHA_HORA_CREACION_EMPLEADO', 'desc')->first();
    }
}