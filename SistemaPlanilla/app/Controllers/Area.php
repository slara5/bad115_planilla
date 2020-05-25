<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Response;
use App\Models\AreasModel;
use App\Models\DepartamentosEmpresaModel;


class Area extends BaseController
{
    protected $nombre_clase = 'Area';

    public function index()
    {
         $area = new AreasModel();
         $depto_empresa = new DepartamentosEmpresaModel();

       $datos= $area->paginate(10);
       $lista_u=$depto_empresa->findAll();

       
        $data = [
            'areas' =>$datos,
            'paginador'=>$area->pager,
            'depto_empresa'=>$depto_empresa,
            'lista_u'=>$lista_u

        
        
        ];
        return crear_plantilla(view('empresa/Area/area', $data));
    }

        public function view($par ='')
    {
        $areas = new AreasModel();
        $depto_empresa = new DepartamentosEmpresaModel();
        $lista_unidades=$depto_empresa->findAll();

      $datos= $areas->paginate(10);
        if ($par==''){

            $data = [
                'areas' =>$datos,
                'depto_empresa'=>$depto_empresa,
                'lista_u'=>$lista_unidades
            ];

            return view('empresa/Area/busqueda', $data);


        }else{

            $datos=$areas->like('NOMBRE_AREA',strtoupper($par))->paginate(5);
            $data = [
                'areas' =>$datos,
                'depto_empresa'=>$depto_empresa,
                'lista_u'=>$lista_unidades
            ];

            return view('empresa/Area/busqueda', $data);
        }
    }


    public function nuevo()
    {

        (new AreasModel())->save([
            'IDAREA' => strtoupper($this->request->getVar('IDAREA')),
            'ID_DEPARTAMENTO_EMPRESA' => strtoupper($this->request->getVar('ID_DEPARTAMENTO_EMPRESA')),
            'NOMBRE_AREA' =>strtoupper( $this->request->getVar('NOMBRE_AREA'))
        ]);



        $areas = new AreasModel();
        $depto_empresa = new DepartamentosEmpresaModel();
        $lista_u=$depto_empresa->findAll();

      $datos= $areas->paginate(10);


      
       $data = [
           'areas' =>$datos,
           'paginador'=>$areas->pager,
           'depto_empresa'=>$depto_empresa,
           'lista_u'=>$lista_u

       
       
       ];

       return view('empresa/Area/busqueda', $data);
    }

    public function delete($id = NULL)
    {
        $areas = new AreasModel();
        $depto_empresa = new DepartamentosEmpresaModel();
        $lista_u=$depto_empresa->findAll();
        $areas->where('IDAREA',$id)->delete();

      $datos= $areas->paginate(10);


      
       $data = [
           'areas' =>$datos,
           'paginador'=>$areas->pager,
           'depto_empresa'=>$depto_empresa,
           'lista_u'=>$lista_u

       
       
       ];  
        
       return view('empresa/Area/busqueda', $data);
        }



  

}
