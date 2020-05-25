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

       $datos= $unidades->paginate(10);
       
        $data = [
            'unidades' =>$datos,
            'paginador'=>$unidades->pager
        
        
        ];
        return crear_plantilla(view('empresa/unidades/unidades', $data));
    }

    public function view($par ='')
    {
        $unidades = new UnidadesModel();
        $datos=$unidades->paginate(10);
        if ($par==''){

            $data = [
                'unidades' => $datos
            ];

            return view('empresa/unidades/busqueda', $data);


        }else{

            $datos=$unidades->like('NOMBRE_UNIDAD',strtoupper($par))->paginate(10);


            $data['unidades'] = $datos;
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
           'unidades' => $unidades->get()
       ];
   
       
      return view('empresa/unidades/busqueda', $data);
    }

}
