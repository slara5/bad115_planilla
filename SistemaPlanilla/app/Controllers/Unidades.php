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

    public function view($par ='')
    {
        $unidades = new UnidadesModel();
        if ($par==''){

            $data = [
                'unidades' => $unidades->get()
            ];

            return view('empresa/unidades/busqueda', $data);


        }else{


            $data['unidades'] = $unidades->like('NOMBRE_UNIDAD',strtoupper($par))->findAll();
            return view('empresa/unidades/busqueda', $data);
        }


    }
    public function delete($id = NULL)
    {
        $unidades = new UnidadesModel();
     $unidades->delete($id);
     $data = [
        'unidades' => $unidades->get()
    ];

    
   return view('empresa/unidades/busqueda', $data);
    }


    //--------------------------------------------------------------------
    public function nuevo()
    {
        (new UnidadesModel())->save([
            'ID_UNIDAD' => strtoupper($this->request->getVar('ID_UNIDAD')),
            'NOMBRE_UNIDAD' =>strtoupper( $this->request->getVar('NOMBRE_UNIDAD'))
        ]);
        $unidades = new UnidadesModel();
        $data = [
           'unidades' => $unidades->get()->order_by('ID_UNIDAD')
       ];
   
       
      return view('empresa/unidades/busqueda', $data);
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
