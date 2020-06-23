<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Response;
use App\Models\TiposMovimientoModel;

class Tipos_movimiento extends BaseController
{

	protected function data_vista($operacion = '', $exito = false, $tipos_movimiento = [], $termino = '')
	{
		$tipos_movimiento  = ($tipos_movimiento == []) ? (new TiposMovimientoModel())->get() : $tipos_movimiento;

		$data = [
			'tipos_movimiento'	=> $tipos_movimiento,
			'operacion'			=> $operacion,
			'exito' 			=> $exito,
			'nombre_obj'    	=> 'Tipo de Movimiento',
			'termino'       	=> $termino,
			'url_guardar'		=> base_url() . '/tipos_movimiento/guardar',
			'url_eliminar'  	=> base_url() . '/tipos_movimiento/eliminar',
			'url_buscar'    	=> base_url() . '/tipos_movimiento/buscar',
		];
		return crear_head('Tipos de Movimiento')
			. crear_body(
				view('tipos_movimiento/tipos_movimiento', $data),               //main
				'',                                           //sidebar
				crear_breadcrumb('Tipos de Movimiento', crear_ruta_breadcrumb('tipos_movimiento')),   //breadcrumb
				['tipos_movimiento/tipos_movimiento.js']
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
				'NOMBRE_TIPO_MOVIMIENTO'   => 'required|string'
			])) {
				(new TiposMovimientoModel())->save([
					'ID_TIPO_MOVIMIENTO' => $this->request->getVar('ID_TIPO_MOVIMIENTO'),
					'NOMBRE_TIPO_MOVIMIENTO' => $this->request->getVar('NOMBRE_TIPO_MOVIMIENTO')
				]);
				$exito = true;
			}
			return $this->data_vista('guardar', $exito);
		}
		return redirect()->to(base_url() . '/tipos_movimiento');
	}

	public function eliminar()
	{
		if ($this->request->getMethod() == 'post') {
			$exito = false;
			if ($this->validate([
				'ID_TIPO_MOVIMIENTO'   => 'required|numeric'
			])) {
				(new TiposMovimientoModel())->where('ID_TIPO_MOVIMIENTO', $this->request->getVar('ID_TIPO_MOVIMIENTO'))->delete();
				$exito = true;
			}
			return $this->data_vista('eliminar', $exito);
		}
		return redirect()->to(base_url() . '/tipos_movimiento');
	}

	public function buscar()
	{
		if ($this->request->getMethod() == 'post') {
			$exito = false;
			$tipos_movimiento_buscados = [];
			$termino = '';
			if ($this->validate([
				'termino'   => 'required|string'
			])) {
				$termino = trim($this->request->getVar('termino'));
				if ($termino != '') {
					$tipos_movimiento_buscados = (new TiposMovimientoModel())
						->like('NOMBRE_TIPO_MOVIMIENTO', $termino)
						->findAll();
				}
				$exito = (count($tipos_movimiento_buscados) == 0) ? false : true;
			}
			return $this->data_vista('buscar', $exito, $tipos_movimiento_buscados, $termino);
		}
		return redirect()->to(base_url() . '/tipos_movimiento');
	}

	public function print(){
		$this->request->getVar('ID_TIPO_MOVIMIENTO');
		return redirect()->to(base_url() . '/dashboard');
	}

}

