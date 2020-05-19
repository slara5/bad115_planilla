<?php 
namespace App\Controllers;

use CodeIgniter\HTTP\Response;

class Dashboard extends BaseController
{
	public function __construct()
	{
		if (session()->get('LOGUEADO') === NULL)
		{
			redirect()->to(base_url() . '/login');
		}
	}

	public function index()
	{
		return crear_plantilla(view('index'));
	}

	//--------------------------------------------------------------------
	
}
