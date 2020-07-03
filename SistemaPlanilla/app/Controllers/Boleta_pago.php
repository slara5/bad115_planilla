<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Response;
use App\Models\VistaBoletaModel;
use CodeIgniter\Database\Query;
use App\Models\EmpleadosModel;


class Boleta_pago extends BaseController
{
    protected $nombre_clase = 'boleta';

    public function index()
    {


        
  $empleados=new EmpleadosModel();

  $datos=$empleados->select("CONCAT(NOMBRE_PRIMERO,' ', NOMBRE_SEGUNDO,' ' ,APELLIDO_PATERNO,' ',APELLIDO_MATERNO) as 'nombre_c',NUMERO_DOCUMENTO,CODIGO")
  ->join('planillas', 'planillas.ID_PLANILLA =ID_PLANILLA')->where('codigo','ME-202008')->get();

      $data = [
        'boletas' =>$datos,
    ];
        return crear_plantilla(view('boleta/boleta',$data));
    }

    public function view($par ='')
    {
        $empleados=new EmpleadosModel();
  
        if ($par==''){

            return view('boleta/resultado_import');


        }else{

            $datos=$empleados->select("CONCAT(NOMBRE_PRIMERO,' ', NOMBRE_SEGUNDO,' ' ,APELLIDO_PATERNO,' ',APELLIDO_MATERNO) as 'nombre_c',NUMERO_DOCUMENTO,CODIGO")
            ->join('planillas', 'planillas.ID_PLANILLA =ID_PLANILLA')->where('codigo',$par)->get();
          
                $data = [
                  'boletas' =>$datos,
              ];
                  return view('boleta/tabla_boleta',$data);
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
           'unidades' => $unidades->get()
       ];
   
       
      return view('empresa/unidades/busqueda', $data);
    }

}
