<?php 
namespace App\Controllers;

use CodeIgniter\HTTP\Response;

use App\Models\UsuariosModel;
use App\Models\RolesModel;

class Usuarios extends BaseController
{
    
    protected function data_vista($operacion = '', $exito = false, $usuarios = [], $termino = '')
    {
        $usuarios = ($usuarios == [])? (new UsuariosModel())->get() : $usuarios;

        $roles = (new RolesModel())->get();

        $data = [
            'roles'         => $roles,
            'rolesModel'    => new RolesModel(),
            'usuarios'      => $usuarios,
            'usuariosModel' => new UsuariosModel(),
            'operacion'     => $operacion,
            'exito'         => $exito,
            'nombre_obj'    => 'Usuario',
            'termino'       => $termino,
            'url_guardar'   => base_url() . '/usuarios/guardar',
            'url_eliminar'   => base_url() . '/usuarios/eliminar',
            'url_buscar'   => base_url() . '/usuarios/buscar',
        ];

        return crear_head('Usuarios')
            . crear_body( 
                view('usuarios/usuarios', $data),
                '',
                crear_breadcrumb('Usuarios', crear_ruta_breadcrumb('Usuarios')),
                ['usuarios/usuarios.js']
            );
    }

	public function index()
	{
		return $this->data_vista();
	}

    public function guardar()
    {
        if ($this->request->getMethod() == 'post') {
            $exito = false;
            if ($this->validate([
                'NOMBRES'               => 'required|string',
                'APELLIDOS'             => 'required|string',
                'USUARIO'               => 'required|string',
                'CONTRASENIA'           => 'required|string',
                'CONFIRMAR_CONTRASENIA' => 'matches[CONTRASENIA]',

            ])) { 
                (new UsuariosModel())->save([
                    'ID_USUARIO'            => $this->request->getvar('ID_USUARIO'),
                    'ID_ROL'                => $this->request->getVar('ID_ROL'),
                    'USUARIO'               => $this->request->getVar('USUARIO'),
                    'CONTRASENIA'           => $this->request->getVar('CONTRASENIA'),
                    'NOMBRES'               => $this->request->getVar('NOMBRES'),
                    'APELLIDOS'             => $this->request->getVar('APELLIDOS'),
                    'ACTIVO'                => 1,
                    'FECHA_HORA_CREACION'   => date('Y-m-d H:i:s'),
                    
                ]);
                $exito = true;
            }
            return $this->data_vista('guardar', $exito);
        }

        return redirect()->to(base_url() . '/usuarios');
    }

    public function eliminar()
    {
        if($this->request->getMethod = 'post')
        {
            $exito = false;
            if($this->validate([
                'ID_USUARIO'    => 'required|numeric'
            ])){
                $db = \Config\Database::connect();
                $usuario = $this->request->getVar("ID_USUARIO");

                $activo = (new UsuariosModel())->where('ID_USUARIO', $usuario)->first();

                if($activo["ACTIVO"] == 1) {
                    $db->query("UPDATE USUARIOS SET ACTIVO = 0 WHERE USUARIOS.ID_USUARIO = ".$db->escape($usuario));
                } else {
                    $db->query("UPDATE USUARIOS SET ACTIVO = 1 WHERE USUARIOS.ID_USUARIO = ".$db->escape($usuario));
                }
                
                $exito = true;
            }
            return $this->data_vista('eliminar', $exito);
        }
        return redirect()->to(base_url() . '/usuarios');
    }

    public function buscar()
    {
        if($this->request->getMethod() == 'post')
        {
            $exito = false;
            $usuarios_buscados = [];
            $termino = '';
            if($this->validate([
                'termino'   => 'required|string'
            ])) {
                $termino = trim($this->request->getVar('termino'));
                if($termino != ''){
                    $usuarios_buscados = (new UsuariosModel())
                                            ->like('USUARIO', $termino)
                                            ->orLike('NOMBRES', $termino)
                                            ->orLike('APELLIDOS', $termino)
                                            ->orLike('ACTIVO', $termino)
                                            ->findAll();
                }
                $exito = (count($usuarios_buscados) == 0)? false : true;
            }
            return $this->data_vista('buscar', $exito, $usuarios_buscados, $termino);
        }
        return redirect()->to(base_url() . '/usuarios');
    }
	
}