<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Response;
use App\Models\DomiciliosModel;
use App\Models\EmpleadosModel;

class Domicilios extends BaseController
{

	protected function data_vista($operacion = '', $exito = false, $domicilios = [], $termino = '')
	{
		$domicilios  = ($domicilios == []) ? (new DomiciliosModel())->get() : $domicilios;

		$data = [
            'domicilios'    => $domicilios,
            'empleados'     => (new EmpleadosModel())->get(),
            'empleadosModel'=> new EmpleadosModel(),
			'operacion'		=> $operacion,
			'exito' 		=> $exito,
			'nombre_obj'    => 'Domicilio',
			'termino'       => $termino,
			'url_guardar'	=> base_url() . '/domicilios/guardar',
			'url_eliminar'  => base_url() . '/domicilios/eliminar',
			'url_buscar'    => base_url() . '/domicilios/buscar',
		];
		return crear_head('Domicilios')
			. crear_body(
				view('domicilios/domicilios', $data),               //main
				'',                                           //sidebar
				crear_breadcrumb('Domicilios', crear_ruta_breadcrumb('Domicilios')),   //breadcrumb
				['domicilios/domicilios.js']
			);
	}

	public function index()
	{
		return $this->data_vista();
	}

	public function guardar()
	{
        // $this->form_validation->set_message();
		if ($this->request->getMethod() == 'post') {
			$exito = false;
			if ($this->validate([
                'DIRECCION'   => 'required|string',
			])) {
				(new DomiciliosModel())->save([
					'ID_DOMICILIO' => $this->request->getVar('ID_DOMICILIO'),
                    'ID_EMPLEADO' => $this->request->getVar('ID_EMPLEADO'),
                    'DIRECCION' => $this->request->getVar('DIRECCION'),
                    'DESDE_FECHA_DOMICILIO' => date('Y-m-d'),
				]);
				$exito = true;
			}
			return $this->data_vista('guardar', $exito);
		}
		return redirect()->to(base_url() . '/domicilios');
	}

	public function eliminar()
	{
		if ($this->request->getMethod() == 'post') {
			$exito = false;
			if ($this->validate([
				'ID_DOMICILIO'   => 'required|numeric'
			])) {
				(new DomiciliosModel())->where('ID_DOMICILIO', $this->request->getVar('ID_DOMICILIO'))->delete();
				$exito = true;
			}
			return $this->data_vista('eliminar', $exito);
		}
		return redirect()->to(base_url() . '/domicilios');
	}

	public function buscar()
	{
		if ($this->request->getMethod() == 'post') {
			$exito = false;
			$domicilios_buscados = [];
			$termino = '';
			if ($this->validate([
				'termino'   => 'required|string'
			])) {
                
                $termino = trim($this->request->getVar('termino'));
                

				if ($termino != '') {
                    $array_empleados = (new EmpleadosModel())->buscar($termino);
                    if(count($array_empleados) != 0){
                        $domicilios_buscados = (new DomiciliosModel())
                        ->whereIn('ID_EMPLEADO', $array_empleados )
                        ->orLike('DIRECCION', $termino)
						->findAll();
                    }else{
                        $domicilios_buscados = (new DomiciliosModel())
                        ->orLike('DIRECCION', $termino)
						->findAll();
                    }
                    
				}
				$exito = (count($domicilios_buscados) == 0) ? false : true;
			}
			return $this->data_vista('buscar', $exito, $domicilios_buscados, $termino);
		}
		return redirect()->to(base_url() . '/domicilios');
	}
}
