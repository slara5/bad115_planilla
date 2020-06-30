<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Response;
use App\Models\TelefonosModel;
use App\Models\EmpleadosModel;

class Telefonos extends BaseController
{

	protected function data_vista($operacion = '', $exito = false, $telefonos = [], $termino = '')
	{
		$telefonos  = ($telefonos == []) ? (new TelefonosModel())->get() : $telefonos;

		$data = [
            'telefonos'    => $telefonos,
            'empleados'     => (new EmpleadosModel())->get(),
            'empleadosModel'=> new EmpleadosModel(),
			'operacion'		=> $operacion,
			'exito' 		=> $exito,
			'nombre_obj'    => 'Telefono',
			'termino'       => $termino,
			'url_guardar'	=> base_url() . '/telefonos/guardar',
			'url_eliminar'  => base_url() . '/telefonos/eliminar',
			'url_buscar'    => base_url() . '/telefonos/buscar',
		];
		return crear_head('Telefonos')
			. crear_body(
				view('telefonos/telefonos', $data),               //main
				'',                                           //sidebar
				crear_breadcrumb('Telefonos', crear_ruta_breadcrumb('Telefonos')),   //breadcrumb
				['telefonos/telefonos.js']  //js
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
                'TELEFONO'   => 'required|string',
                'TIPO_TELEFONO'   => 'required|string',
			])) {
				(new TelefonosModel())->save([
					'ID_TELEFONO' => $this->request->getVar('ID_TELEFONO'),
                    'ID_EMPLEADO' => $this->request->getVar('ID_EMPLEADO'),
                    'TELEFONO' => $this->request->getVar('TELEFONO'),
                    'TIPO_TELEFONO' => $this->request->getVar('TIPO_TELEFONO'),
                    'DESDE_FECHA_TELEFONO' => date('Y-m-d'),
				]);
				$exito = true;
			}
			return $this->data_vista('guardar', $exito);
		}
		return redirect()->to(base_url() . '/telefonos');
	}

	public function eliminar()
	{
		if ($this->request->getMethod() == 'post') {
			$exito = false;
			if ($this->validate([
				'ID_TELEFONO'   => 'required|numeric'
			])) {
				(new TelefonosModel())->where('ID_TELEFONO', $this->request->getVar('ID_TELEFONO'))->delete();
				$exito = true;
			}
			return $this->data_vista('eliminar', $exito);
		}
		return redirect()->to(base_url() . '/telefonos');
	}

	public function buscar()
	{
		if ($this->request->getMethod() == 'post') {
			$exito = false;
			$telefonos_buscados = [];
			$termino = '';
			if ($this->validate([
				'termino'   => 'required|string'
			])) {
                
                $termino = trim($this->request->getVar('termino'));
                

				if ($termino != '') {
                    $array_empleados = (new EmpleadosModel())->buscar($termino);
                    if(count($array_empleados) != 0){
                        $telefonos_buscados = (new TelefonosModel())
                        ->whereIn('ID_EMPLEADO', $array_empleados )
                        ->orLike('TELEFONO', $termino)
                        ->orLike('TIPO_TELEFONO', $termino)
						->findAll();
                    }else{
                        $telefonos_buscados = (new TelefonosModel())
                        ->orLike('TELEFONO', $termino)
                        ->orLike('TIPO_TELEFONO', $termino)
						->findAll();
                    }
                    
				}
				$exito = (count($telefonos_buscados) == 0) ? false : true;
			}
			return $this->data_vista('buscar', $exito, $telefonos_buscados, $termino);
		}
		return redirect()->to(base_url() . '/telefonos');
	}
}
