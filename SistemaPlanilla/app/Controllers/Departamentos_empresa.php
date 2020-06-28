<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\DepartamentosEmpresaModel;
use App\Models\UnidadesModel;

class Departamentos_empresa extends BaseController{

    public function index()
    {
         $depto_empresa = new DepartamentosEmpresaModel();
         $unidades= new UnidadesModel();

       $datos= $depto_empresa->paginate(10);

       $lista_unidades=$unidades->findAll();
       
        $data = [
            'depto_empresa' =>$datos,
            'unidades'=>$unidades,
            'paginador'=>$depto_empresa->pager,
            'lista_u'=>$lista_unidades
        
        ];
        return crear_plantilla(view('empresa/depto_empresa/depto_empresa', $data));
 
    }
    public function view($par ='')
    {
        $depto_empresa = new DepartamentosEmpresaModel();
        $unidades= new UnidadesModel();
        $lista_unidades=$unidades->findAll();

      $datos= $depto_empresa->paginate(10);
        if ($par==''){

            $data = [
                'depto_empresa' =>$datos,
                'unidades'=>$unidades,
                'lista_u'=>$lista_unidades
            ];

            return view('empresa/depto_empresa/busqueda', $data);


        }else{

            $datos=$depto_empresa->like('NOMBRE_DEPARTAMENTO_EMPRESA',strtoupper($par))->paginate(5);
            $data = [
                'depto_empresa' =>$datos,
                'unidades'=>$unidades,
                'lista_u'=>$lista_unidades
            ];

            return view('empresa/depto_empresa/busqueda', $data);
        }
    }

    public function delete($id = NULL)
    {
        $depto_empresa = new DepartamentosEmpresaModel();
        $unidades= new UnidadesModel();
        $depto_empresa->where('ID_DEPARTAMENTO_EMPRESA',$id)->delete();
        $datos= $depto_empresa->paginate(10);
        $lista_unidades=$unidades->findAll();

   
        $data = [
        'depto_empresa' =>$datos,
        'unidades'=>$unidades,
        'paginador'=>$depto_empresa->pager,
        'lista_u'=>$lista_unidades
    
            ];  

     return view('empresa/depto_empresa/busqueda', $data);
        
        
        }


        public function nuevo()
        {

            (new DepartamentosEmpresaModel())->save([
                'ID_DEPARTAMENTO_EMPRESA' => strtoupper($this->request->getVar('ID_DEPARTAMENTO_EMPRESA')),
                'ID_UNIDAD' => strtoupper($this->request->getVar('ID_UNIDAD')),
                'NOMBRE_DEPARTAMENTO_EMPRESA' =>strtoupper( $this->request->getVar('NOMBRE_DEPARTAMENTO_EMPRESA')),
                'CODIGO_CENTRO_COSTO' => $this->request->getVar('CODIGO_CENTRO_COSTO')
            ]);

            $depto_empresa = new DepartamentosEmpresaModel();
            $unidades= new UnidadesModel();
            $lista_unidades=$unidades->findAll();
    
          $datos= $depto_empresa->paginate(10);
                $data = [
                    'depto_empresa' =>$datos,
                    'unidades'=>$unidades,
                    'lista_u'=>$lista_unidades
                ];
    
                return view('empresa/depto_empresa/busqueda', $data);
           
        }





}