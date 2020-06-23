<?php 
namespace App\Controllers;

use CodeIgniter\HTTP\Response;
use App\Models\MenusModel;

class Dashboard extends BaseController
{

	public function index()
	{
		$menus = (new MenusModel())->get();
		return crear_plantilla(view('index', $menus));
	}
	
	//--------------------------------------------------------------------
	
}
