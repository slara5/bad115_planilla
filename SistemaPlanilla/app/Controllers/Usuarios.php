<?php 
namespace App\Controllers;

use CodeIgniter\HTTP\Response;

use App\Models\UsuariosModel;
use App\Models\RolesModel;

class Usuarios extends BaseController
{
	protected $nombre_clase = 'usuarios';

	public function index()
	{
		$usuarios = new UsuariosModel();

		$ruta_breadcrumb = [
            [
                'nombre' => 'Dashboard',
                'url'    => base_url().'/dashboard', 
            ],
            [
                'nombre' => ucfirst($this->nombre_clase),
                'url'    => base_url().'/'.$this->nombre_clase, 
            ],
        ];

		$data = [
			'usuarios' => $usuarios->get()
		];

		return crear_head('Lista de Usuarios')
            .crear_body(
                view('usuarios/usuarios', $data),               //main
                '',                                           //sidebar
                crear_breadcrumb('Lista de Usuarios', $ruta_breadcrumb),   //breadcrumb
                ['usuarios.js']                        //scripts
            );
	}
	
}