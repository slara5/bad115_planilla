<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Response;
use App\Models\PuestosTrabajoModel;



class Puestos_Trabajo extends BaseController
{
    protected $nombre_clase = 'Puestos_Trabajo';

    public function index()
    {
         $Ptrabajos = new PuestosTrabajoModel();

        

       $datos= $Ptrabajos->paginate(10);
           


       
        $data = [
            'ptrabajos' =>$datos,
            'paginador'=>$Ptrabajos->pager

        
        
        ];
        return crear_plantilla(view('empresa/puestos_trabajo/puestos_trabajo', $data));
    }

    public function view($par ='')
    {


        $Ptrabajos = new PuestosTrabajoModel();
    $datos=$Ptrabajos->paginate(10);
    if ($par==''){

        $data = [
            'ptrabajos' => $datos
        ];

        return view('empresa/puestos_trabajo/busqueda', $data);


    }else{

        $datos=$Ptrabajos->like('DESCRIPCION_PUESTO',strtoupper($par))->paginate(10);


        $data['ptrabajos'] = $datos;
        return view('empresa/puestos_trabajo/busqueda', $data);
    }
}


    public function delete($id = NULL)
    {
        $Ptrabajos = new PuestosTrabajoModel();
        $Ptrabajos->delete($id);
        
        $datos=$Ptrabajos->paginate(10);
        

        $data = [
            'ptrabajos' => $datos
        ];

        return view('empresa/puestos_trabajo/busqueda', $data);

    

    }


    public function nuevo()
    {
        (new PuestosTrabajoModel())->save([
            'ID_PUESTO' => strtoupper($this->request->getVar('ID_PUESTO')),
            'DESCRIPCION_PUESTO' => $this->request->getVar('DESCRIPCION_PUESTO'),
            'SALARIO_MIN'=>$this->request->getVar('SALARIO_MIN'),
            'SALARIO_MAX'=>$this->request->getVar('SALARIO_MAX')
        
        
            ]);
            $Ptrabajos = new PuestosTrabajoModel();
            $datos=$Ptrabajos->paginate(10);
                $data = [
                    'ptrabajos' => $datos
                ];
    
                return view('empresa/puestos_trabajo/busqueda', $data);
    }




    
}