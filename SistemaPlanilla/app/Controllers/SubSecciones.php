<?php 
namespace App\Controllers;

use CodeIgniter\HTTP\Response;
use App\Models\SeccionesModel;
use App\Models\SubSeccionesModel;


class SubSecciones extends BaseController{
    protected $nombre_clase = 'SubSecciones';

    public function index()
    {
         $secciones = new SeccionesModel();
         $subsecciones = new SubSeccionesModel();

        

       $datos= $subsecciones->paginate(10);
       $lista_s=$secciones->findAll();
           


       
        $data = [
            'subsecciones' =>$datos,
            'paginador'=>$subsecciones->pager,
            'secciones'=>$secciones,
            'lista_s'=>$lista_s
        
        
        ];
        return crear_plantilla(view('empresa/subsecciones/subsecciones', $data));
    }


    public function view($par ='')
    {

            $secciones = new SeccionesModel();
            $subsecciones = new SubSeccionesModel();
          $datos= $subsecciones->paginate(10);
          $lista_s=$secciones->findAll();
        if ($par==''){
   
          
           $data = [
               'subsecciones' =>$datos,
               'paginador'=>$subsecciones->pager,
               'secciones'=>$secciones,
               'lista_s'=>$lista_s
           
           
           ];
           return view('empresa/subsecciones/busqueda', $data);

        }else{

            $datos=$subsecciones->like('NOMBRE_SUB_SECCION',strtoupper($par))->paginate(10);
            $data = [
                'subsecciones' =>$datos,
                'paginador'=>$subsecciones->pager,
                'secciones'=>$secciones,
                'lista_s'=>$lista_s
            
            
            ];
            return view('empresa/subsecciones/busqueda', $data);
        }
    }


 
 
               public function nuevo()
    {

        (new SubSeccionesModel())->save([
            'ID_SUB_SECCION' => strtoupper($this->request->getVar('ID_SUB_SECCION')),
            'ID_SECCION' => strtoupper($this->request->getVar('ID_SECCION')),
            'NOMBRE_SUB_SECCION' =>strtoupper( $this->request->getVar('NOMBRE_SUB_SECCION'))
        ]);



        $secciones = new SeccionesModel();
        $subsecciones = new SubSeccionesModel();

       

      $datos= $subsecciones->paginate(10);
      $lista_s=$secciones->findAll();
          


      
       $data = [
           'subsecciones' =>$datos,
           'paginador'=>$subsecciones->pager,
           'secciones'=>$secciones,
           'lista_s'=>$lista_s
       
       
       ];
      return view('empresa/subsecciones/busqueda', $data);


    }


    public function delete($id = NULL)
    {
        $subsecciones = new SubSeccionesModel();
       
        $subsecciones->where('ID_SUB_SECCION',$id)->delete();
        $secciones = new SeccionesModel();


       

      $datos= $subsecciones->paginate(10);
      $lista_s=$secciones->findAll();
          


      
       $data = [
           'subsecciones' =>$datos,
           'paginador'=>$subsecciones->pager,
           'secciones'=>$secciones,
           'lista_s'=>$lista_s];


      return view('empresa/subsecciones/busqueda', $data);

       
               }

}