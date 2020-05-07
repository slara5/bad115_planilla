<?php namespace App\Controllers;

use CodeIgniter\HTTP\Response;

class Dashboard extends BaseController
{
	public function index()
	{
		return crear_plantilla(view('index'));
	}

	//--------------------------------------------------------------------
	
}
