<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Response;
use App\Models\UnidadesModel;



class Unidades extends BaseController
{
    protected $nombre_clase = 'unidades';

    public function index()
    {
        $unidades = new UnidadesModel();
        $data = [
            'unidades' => $unidades->get()
        ];
        return crear_plantilla(view('empresa/unidades/unidades', $data));
    }

    public function view($par ='gerencia')
    {
        $unidades = new UnidadesModel();

        $data['unidades'] = $unidades->like('NOMBRE_UNIDAD',strtoupper($par))->findAll();
        return view('empresa/unidades/busqueda', $data);
    }
    public function delete($id = NULL)
    {
        $unidades = new UnidadesModel();
     $unidades->delete($id);
     $data = [
        'unidades' => $unidades->get()
    ];

 return view('empresa/unidades/busqueda', $data);;

  
    }


    //--------------------------------------------------------------------
    public function nuevo()
    {
        $nombre_metodo = 'nuevo';

        $afps               = (new AfpsModel())->get();
        $empleados          = (new EmpleadosModel())->get();
        $estado_empleados   = (new EstadoEmpleadosModel())->get();
        $estados_civil      = (new EstadosCivilModel())->get();
        $generos            = (new GenerosModel())->get();
        $municipios         = (new MunicipiosModel())->get();
        $profesiones        = (new ProfesionesModel())->get();
        $puestos_trabajo    = (new PuestosTrabajoModel())->get();
        $sub_secciones      = (new SubSeccionesModel())->get();
        $tipos_contratacion = (new TiposContratacionModel())->get();

        $exito_guardar = false;
        $post = false;

        if ($this->request->getMethod() == 'post') {
            $post = true;
            if(!$this->validate([
                'nombre_primero'   => 'required|string',
                'nombre_segundo'   => 'string',
                'apellido_paterno'   => 'required',
                'apellido_materno'   => 'required',
                'fecha_nacimiento'   => 'valid_date[d/m/Y]',
                'direccion'   => 'required',
                'numero_documento'   => 'required',
                'fecha_expedicion'   => 'valid_date[d/m/Y]',
                'nit'   => 'required',
                'nup'   => 'required',
                'numero_iss'   => 'required',
                'fecha_ingreso'   => 'valid_date[d/m/Y]',
                'fecha_contratacion'   => 'valid_date[d/m/Y]',
                'salario'   => 'numeric',
                'correo_electronico_personal'   => 'valid_email',
                'correo_electronico_institucional'   => 'valid_email',
                'telefono_movil'   => 'string',
                'telefono'   => 'string',
                'horario_trabajo'   => 'string',

            ])){ //error
                
                $exito_guardar = false;
            }else{ //guardar
                (new EmpleadosModel())->save([
                    'ID_SUB_SECCION'        => $this->request->getVar(strtolower('ID_SUB_SECCION')),
                    'ID_ESTADO'             => $this->request->getVar(strtolower('ID_ESTADO')),
                    'ID_ESTADO_CIVIL'       => $this->request->getVar(strtolower('ID_ESTADO_CIVIL')),
                    'ID_AFP'                => $this->request->getVar(strtolower('ID_AFP')),
                    'ID_PUESTO'             => $this->request->getVar(strtolower('ID_PUESTO')),
                    'ID_GENERO'             => $this->request->getVar(strtolower('ID_GENERO')),
                    'ID_TIPO_CONTRATACION'  => $this->request->getVar(strtolower('ID_TIPO_CONTRATACION')),
                    'ID_MUNICIPIO'          => $this->request->getVar(strtolower('ID_MUNICIPIO')),
                    'ID_PROFESION_OFICIO'   => $this->request->getVar(strtolower('ID_PROFESION_OFICIO')),
                    'CODIGO_EMPLEADO'       => $this->get_codigo_empleado(),
                    'NOMBRE_PRIMERO'        => $this->request->getVar(strtolower('NOMBRE_PRIMERO')),
                    'NOMBRE_SEGUNDO'        => $this->request->getVar(strtolower('NOMBRE_SEGUNDO')),
                    'APELLIDO_PATERNO'      => $this->request->getVar(strtolower('APELLIDO_PATERNO')),
                    'APELLIDO_MATERNO'      => $this->request->getVar(strtolower('APELLIDO_MATERNO')),
                    'FECHA_NACIMIENTO'      => $this->request->getVar(strtolower('FECHA_NACIMIENTO')),
                    'DIRECCION'             => $this->request->getVar(strtolower('DIRECCION')),
                    'NUMERO_DOCUMENTO'      => $this->request->getVar(strtolower('NUMERO_DOCUMENTO')),
                    'FECHA_EXPEDICION'      => $this->request->getVar(strtolower('FECHA_EXPEDICION')),
                    'NIT'                   => $this->request->getVar(strtolower('NIT')),
                    'NUP'                   => $this->request->getVar(strtolower('NUP')),
                    'NUMERO_ISSS'           => $this->request->getVar(strtolower('NUMERO_ISSS')),
                    'FECHA_INGRESO'         => $this->request->getVar(strtolower('FECHA_INGRESO')),
                    'FECHA_CONTRATACION'    => $this->request->getVar(strtolower('FECHA_CONTRATACION')),
                    'SALARIO'               => $this->request->getVar(strtolower('SALARIO')),
                    'CORREO_ELECTRONICO_INSTITUCIONAL' => $this->request->getVar(strtolower('CORREO_ELECTRONICO_INSTITUCIONAL')),
                    'CORREO_ELECTRONICO_PERSONAL'      => $this->request->getVar(strtolower('CORREO_ELECTRONICO_PERSONAL')),
                    'TELEFONO'              => $this->request->getVar(strtolower('TELEFONO')),
                    'TELEFONO_MOVIL'        => $this->request->getVar(strtolower('TELEFONO_MOVIL')),
                    'NIVEL_ESTUDIOS'        => $this->request->getVar(strtolower('NIVEL_ESTUDIOS')),
                    'ID_EMPLEADO_JEFE'      => $this->request->getVar(strtolower('ID_EMPLEADO_JEFE')),
                    'FECHA_RETIRO'          => '',
                    'HORARIO_TRABAJO'       => $this->request->getVar(strtolower('HORARIO_TRABAJO')),
                    'ID_USUARIO_CREO_EMPLEADO'      => 1, 
                    'FECHA_HORA_CREACION_EMPLEADO'  => date('Y-m-d H:i:s'),
                ]);
                $exito_guardar = true;
            }
        }

        $ruta_breadcrumb = [
            [
                'nombre' => 'Dashboard',
                'url'    => base_url().'/dashboard', 
            ],
            [
                'nombre' => ucfirst($this->nombre_clase),
                'url'    => base_url().'/'.$this->nombre_clase, 
            ],
            [
                'nombre' => $nombre_metodo,
                'url'    => base_url().'/'.$this->nombre_clase.'/'.$nombre_metodo, 
            ],
        ];

        $data = [
            'afps'               => $afps,
            'empleados'          => $empleados,
            'estado_empleados'   => $estado_empleados,
            'estados_civil'      => $estados_civil,
            'generos'            => $generos,
            'municipios'         => $municipios,
            'profesiones'        => $profesiones,
            'puestos_trabajo'    => $puestos_trabajo,
            'sub_secciones'      => $sub_secciones,
            'tipos_contratacion' => $tipos_contratacion,
            'cod_empleado'       => $this->get_codigo_empleado(),
            'exito' => $exito_guardar,
            'post'  => $post,
        ];
        return crear_head('Nuevo Empleado')
            .crear_body(
                view('empleados/nuevo', $data),               //main
                '',                                           //sidebar
                crear_breadcrumb('Nuevo Empleado', $ruta_breadcrumb),   //breadcrumb
                ['empleados/nuevo.js']                        //scripts
            );
    }

    protected function get_codigo_empleado(){
        $cod_actual = ((new EmpleadosModel())->get_last_empleado())['CODIGO_EMPLEADO'];
        $cod_empleado = strval(intval($cod_actual) + 1);
        $ceros = ''; 
        for ($i=strlen($cod_empleado); $i < 4; $i++) { 
            $ceros = $ceros.'0';
        }
        return $ceros.$cod_empleado;
    }
}
