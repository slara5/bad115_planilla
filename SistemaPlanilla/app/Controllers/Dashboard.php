<?php 
namespace App\Controllers;

use CodeIgniter\HTTP\Response;
use App\Models\MenusModel;

class Dashboard extends BaseController
{

	public function index()
	{
		$db = \Config\Database::connect();
        $menus = $db->query("SELECT MENUS.ID_MENU, MENUS.ID_ICONO, MENUS.NOMBRE_MENU FROM menus
			INNER JOIN permisos ON MENUS.ID_MENU = permisos.ID_MENU
			INNER JOIN roles ON permisos.ID_ROL = roles.ID_ROL
			WHERE roles.ID_ROL = 1 AND menus.ID_MENU_PADRE IS NULL");

        $submenus = $db->query("SELECT MENUS.ID_MENU, MENUS.ID_MENU_PADRE, MENUS.NOMBRE_MENU, MENUS.ID_ICONO, MENUS.RUTA_MENU FROM menus
			WHERE MENUS.ID_MENU_PADRE = 1");

		$menus = (new MenusModel())->get();

		return crear_plantilla(view('index', $menus));
	}
	
	//--------------------------------------------------------------------
	
}
