<?php 
namespace App\Controllers;

use CodeIgniter\HTTP\Response;

use CodeIgniter\Controller;
use App\Models\UsuariosModel;

class Login extends BaseController
{
    public function index()
    {
        if(session()->get('LOGUEADO') == true) {
            return redirect()->to(base_url() . '/dashboard');
        }
        $data = [
            'url' => base_url()
        ];
        return view('login', $data);
    }

    public function inicio() 
    {
        $usuario = $this->request->getPost('USUARIO');
        $contrasenia = $this->request->getPost('CONTRASENIA');

        $user = $this->existe($usuario, $contrasenia);

    	if(isset($user))
        {
            if($user['ACTIVO'] == 1) {
                $this->setUserMethod($user);
                return redirect()->to(base_url() . '/dashboard');
            }
            else {
                session()->setFlashdata('msg_error', 'Usuario inactivo. Contacte al administrador');
            return redirect()->to(base_url() . '/login');
            }
            
        }
        else{
            session()->setFlashdata('msg_error', 'Usuario o Contraseña incorrectos');
            return redirect()->to(base_url() . '/login');
        }
    }

    public function existe(string $usuario, string $contrasenia)
    {
        $user = (new UsuariosModel())->where('USUARIO', $usuario)->first();
        return password_verify($this->request->getPost('CONTRASENIA'), $user['CONTRASENIA']) == true ? $user : NULL;
    }


    private function setUserMethod($user)
    {
    	$data = [
    		'ID_ROL'		=> $user['ID_ROL'],
    		'NOMBRES'		=> $user['NOMBRES'],
    		'APELLIDOS'		=> $user['APELLIDOS'],
    		'USUARIO'		=> $user['USUARIO'],
    		'LOGUEADO'	    => true,
    	];

    	session()->set($data);
    	return true;
    }

    public function logout()
    {
        $data = [
            'ID_ROL',
            'NOMBRES',
            'APELLIDOS',
            'USUARIO',
            'LOGUEADO',
        ];
        session()->remove($data);
        //session()->stop();
        session()->setFlashdata('msg_cierre', 'Ha cerrado sesión exitosamente!');
        return redirect()->to(base_url() . '/login');
    }

}