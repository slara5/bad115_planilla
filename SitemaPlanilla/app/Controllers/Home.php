<?php namespace App\Controllers;

use CodeIgniter\HTTP\Response;

class Home extends BaseController
{
	public function index()
	{
		return view('index');
	}

	//--------------------------------------------------------------------
	
}
