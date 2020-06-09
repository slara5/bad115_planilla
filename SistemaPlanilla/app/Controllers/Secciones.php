<?php 
namespace App\Controllers;

use CodeIgniter\HTTP\Response;
use App\Models\SeccionesModel;
use App\Models\AreasModel;


class Secciones extends BaseController{
    protected $nombre_clase = 'Secciones';

    public function index()
    {
         $secciones = new SeccionesModel();
         $area = new AreasModel();

        

       $datos= $secciones->paginate(10);
       $lista_a=$area->findAll();
           


       
        $data = [
            'secciones' =>$datos,
            'paginador'=>$secciones->pager,
            'area'=>$area,
            'lista_a'=>$lista_a
        
        
        ];
        return crear_plantilla(view('empresa/Secciones/secciones', $data));
    }


    public function view($par ='')
    {
        $areas = new AreasModel();
        $secciones = new SeccionesModel();
       
        $lista_a=$areas->findAll();

        $datos= $secciones->paginate(10);
        if ($par==''){

            $data = [
                'secciones' =>$datos,
                'paginador'=>$secciones->pager,
                'area'=>$areas,
                'lista_a'=>$lista_a
            
            
            ];
            return view('empresa/Secciones/busqueda', $data);


        }else{

            $datos=$secciones->like('NOMBRE_SECCION',strtoupper($par))->paginate(10);
            $data = [
                'secciones' =>$datos,
                'paginador'=>$secciones->pager,
                'area'=>$areas,
                'lista_a'=>$lista_a
            
            
            ];
            return view('empresa/Secciones/busqueda', $data);
        }
    }



    public function delete($id = NULL)
    {
        $areas = new AreasModel();
     
        $lista_a=$areas->findAll();
        $secciones = new SeccionesModel();
        $secciones->where('ID_SECCION',$id)->delete();

        $datos= $secciones->paginate(10);
            $data = [
                'secciones' =>$datos,
                'paginador'=>$secciones->pager,
                'area'=>$areas,
                'lista_a'=>$lista_a
            
            
            ];
            return view('empresa/Secciones/busqueda', $data);

               }

 
 
               public function nuevo()
    {

        (new SeccionesModel())->save([
            'ID_SECCION' => strtoupper($this->request->getVar('ID_SECCION')),
            'IDAREA' => strtoupper($this->request->getVar('IDAREA')),
            'NOMBRE_SECCION' =>strtoupper( $this->request->getVar('NOMBRE_SECCION'))
        ]);



        $areas = new AreasModel();
       $secciones= new SeccionesModel();
        $lista_a=$areas->findAll();

      $datos= $secciones->paginate(10);
      $data = [
          'secciones' =>$datos,
          'paginador'=>$secciones->pager,
          'area'=>$areas,
          'lista_a'=>$lista_a
      
      
      ];
      return view('empresa/Secciones/busqueda', $data);


    }

}