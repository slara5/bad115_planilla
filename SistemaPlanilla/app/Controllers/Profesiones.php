<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Response;
use App\Models\ProfesionesModel;



class Profesiones extends BaseController
{
    protected $nombre_clase = 'profesiones';

    public function index()
    {
         $profesiones = new ProfesionesModel();

       $datos= $profesiones->paginate(10);
       
        $data = [
            'profesiones' =>$datos,
            'paginador'=>$profesiones->pager
        
        
        ];
        return crear_plantilla(view('profesiones/profesiones', $data));
    }

    public function view($par ='')
    {
        $profesiones = new ProfesionesModel();
        $datos=$profesiones->paginate(10);
        if ($par==''){

            $data = [
                'profesiones' => $datos
            ];

            return view('profesiones/busqueda', $data);


        }else{

            $datos=$profesiones->like('NOMBRE_PROFESION',strtoupper($par))->paginate(10);


            $data['profesiones'] = $datos;
            return view('/profesiones/busqueda', $data);
        }


    }


    public function delete($id = NULL)
    {
        $profesiones = new ProfesionesModel();
        $profesiones->delete($id);
        $datos=$profesiones->paginate(10);

            $data = [
                'profesiones' => $datos
            ];

            return view('profesiones/busqueda', $data);
    

    }


    //--------------------------------------------------------------------
    public function nuevo()
    {
        (new ProfesionesModel())->save([
            'ID_PROFESION_OFICIO' => strtoupper($this->request->getVar('ID_PROFESION_OFICIO')),
            'NOMBRE_PROFESION' =>strtoupper( $this->request->getVar('NOMBRE_PROFESION')),
            'ES_OFICIO'=>strtoupper( $this->request->getVar('ES_OFICIO'))
        
        
            ]);
            $profesiones = new ProfesionesModel();
            $datos=$profesiones->paginate(10);
                $data = [
                    'profesiones' => $datos
                ];
    
                return view('profesiones/busqueda', $data);
    }



}
