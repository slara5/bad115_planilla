<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Response;
use App\Models\TablaRentaModel;

class TablaRenta extends BaseController
{

	protected function data_vista($operacion = '', $exito = false, $tablaRenta = [], $termino = '')
	{
		$tablaRenta  = ($tablaRenta == []) ? (new TablaRentaModel())->get() : $tablaRenta;

		$data = [
			'tablaRenta'       => $tablaRenta,
			'operacion'		=> $operacion,
			'exito' 		=> $exito,
			'nombre_obj'    => 'Tabla Renta',
			'termino'       => $termino,
			'url_guardar'	=> base_url() . '/tablaRenta/guardar',
			'url_eliminar'  => base_url() . '/tablaRenta/eliminar',
			'url_buscar'    => base_url() . '/tablaRenta/buscar',
		];
		return crear_head('TablaRenta')
			. crear_body(
				view('renta/tablaRenta/tablaRenta', $data),               //main
				'',                                           //sidebar
				crear_breadcrumb('TablaRenta', crear_ruta_breadcrumb('TablaRenta')),   //breadcrumb
				['tablaRenta/tablaRenta.js']
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
				'NOMBRE_TABLA'   => 'required|string'
			])) {
				(new TablaRentaModel())->save([
					'ID_TABLA' => $this->request->getVar('ID_TABLA'),
					'NOMBRE_TABLA' => $this->request->getVar('NOMBRE_TABLA')
				]);
				$exito = true;
			}
			return $this->data_vista('guardar', $exito);
		}
		return redirect()->to(base_url() . '/tablaRenta');
	}

	public function eliminar()
	{
		if ($this->request->getMethod() == 'post') {
			$exito = false;
			if ($this->validate([
				'ID_TABLA'   => 'required|numeric'
			])) {
				(new TablaRentaModel())->where('ID_TABLA', $this->request->getVar('ID_TABLA'))->delete();
				$exito = true;
			}
			return $this->data_vista('eliminar', $exito);
		}
		return redirect()->to(base_url() . '/tablaRenta');
	}

	public function buscar()
	{
		if ($this->request->getMethod() == 'post') {
			$exito = false;
			$tablaRenta_buscados = [];
			$termino = '';
			if ($this->validate([
				'termino'   => 'required|string'
			])) {
				$termino = trim($this->request->getVar('termino'));
				if ($termino != '') {
					$tablaRenta_buscados = (new TablaRentaModel())
						->like('NOMBRE_TABLA', $termino)
						->findAll();
				}
				$exito = (count($tablaRenta_buscados) == 0) ? false : true;
			}
			return $this->data_vista('buscar', $exito, $tablaRenta_buscados, $termino);
		}
		return redirect()->to(base_url() . '/tablaRenta');
	}
}