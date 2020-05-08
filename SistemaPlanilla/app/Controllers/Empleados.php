<?php namespace App\Controllers;

use CodeIgniter\HTTP\Response;
use App\Models\EmpleadosModel;



class Empleados extends BaseController
{
	public function index()
	{
        $empleados = new EmpleadosModel();
        $data = [
            'empleados' => $empleados->get()
        ];
        return crear_plantilla(view('empleados/empleados', $data));
	}

	//--------------------------------------------------------------------
	public function nuevo(){
        
        return crear_plantilla(view('empleados/nuevo'));
    }
}
