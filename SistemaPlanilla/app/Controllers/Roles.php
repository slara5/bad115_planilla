<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Response;
use App\Models\RolesModel;
use App\Models\MenusModel;


class Roles extends BaseController
{
    protected $nombre_clase = 'roles';

    public function index()
    {
        $roles = new RolesModel();

        $datos= $roles->paginate(10);
       
        $data = [
            'roles' =>$datos,
            'paginador'=>$roles->pager
        ];
        return crear_plantilla(view('roles/roles', $data));
    }

    public function view($par ='')
    {
        $roles = new RolesModel();
        $menus = new MenusModel();
        $datos = $roles->paginate(10);
        if ($par==''){
            $data = [
                'roles' => $datos
            ];

            return view('roles/busqueda', $data);


        }else{

            $datos = $roles->like('NOMBRE_ROL',strtoupper($par))->paginate(10);
            $data['roles'] = $datos;
            return view('roles/busqueda', $data);
        }


    }
    public function delete($id = NULL)
    {
        $roles = new RolesModel();
        $roles->delete($id);
        $data = [
            'roles' => $roles->get()
        ];
        return view('roles/busqueda', $data);
    }


    //--------------------------------------------------------------------
    public function nuevo()
    {
        (new RolesModel())->save([
            'ID_ROL' => strtoupper($this->request->getVar('ID_ROL')),
            'NOMBRE_ROL' =>strtoupper( $this->request->getVar('NOMBRE_ROL'))
        ]);
        $roles = new RolesModel();
        $data = [
           'roles' => $roles->get()
       ];
   
       
      return view('roles/busqueda', $data);
    }

}
