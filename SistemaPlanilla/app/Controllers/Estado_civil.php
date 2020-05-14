<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Response;
use App\Models\EstadosCivilModel;

class Estado_civil extends BaseController
{

	protected function data_vista($operacion = '', $exito = false, $estados = [], $termino = '')
	{
		$estados_civil  = ($estados == []) ? (new EstadosCivilModel())->get() : $estados;

		$data = [
			'estados_civil' => $estados_civil,
			'operacion'		=> $operacion,
			'exito' 		=> $exito,
			'nombre_obj'    => 'Estado Civil',
			'termino'       => $termino,
			'url_guardar'	=> base_url() . '/estado_civil/guardar',
			'url_eliminar'  => base_url() . '/estado_civil/eliminar',
			'url_buscar'    => base_url() . '/estado_civil/buscar',
		];
		return crear_head('Estados Civiles')
			. crear_body(
				view('estado_civil/estado_civil', $data),               //main
				'',                                           //sidebar
				crear_breadcrumb('Estados Civiles', crear_ruta_breadcrumb('Estado_civil')),   //breadcrumb
				['estado_civil/estado_civil.js']
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
				'NOMBRE_ESTADO_CIVIL'   => 'required|string'
			])) {
				(new EstadosCivilModel())->save([
					'ID_ESTADO_CIVIL' => $this->request->getVar('ID_ESTADO_CIVIL'),
					'NOMBRE_ESTADO_CIVIL' => $this->request->getVar('NOMBRE_ESTADO_CIVIL')
				]);
				$exito = true;
			}
			return $this->data_vista('guardar', $exito);
		}
		return redirect()->to(base_url() . '/estado_civil');
	}

	public function eliminar()
	{
		if ($this->request->getMethod() == 'post') {
			$exito = false;
			if ($this->validate([
				'ID_ESTADO_CIVIL'   => 'required|numeric'
			])) {
				(new EstadosCivilModel())->where('ID_ESTADO_CIVIL', $this->request->getVar('ID_ESTADO_CIVIL'))->delete();
				$exito = true;
			}
			return $this->data_vista('eliminar', $exito);
		}
		return redirect()->to(base_url() . '/estado_civil');
	}

	public function buscar()
	{
		if ($this->request->getMethod() == 'post') {
			$exito = false;
			$estados_buscados = [];
			$termino = '';
			if ($this->validate([
				'termino'   => 'required|string'
			])) {
				$termino = trim($this->request->getVar('termino'));
				if ($termino != '') {
					$estados_buscados = (new EstadosCivilModel())
						->like('NOMBRE_ESTADO_CIVIL', $termino)
						->findAll();
				}
				$exito = (count($estados_buscados) == 0) ? false : true;
			}
			return $this->data_vista('buscar', $exito, $estados_buscados, $termino);
		}
		return redirect()->to(base_url() . '/estado_civil');
	}
}
