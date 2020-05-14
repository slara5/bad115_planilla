<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Response;
use App\Models\TiposContratacionModel;

class Tipos_contratacion extends BaseController
{

	protected function data_vista($operacion = '', $exito = false, $tipos = [], $termino = '')
	{
		$tipos_contratacion  = ($tipos == []) ? (new TiposContratacionModel())->get() : $tipos;

		$data = [
			'tipos_contratacion' => $tipos_contratacion,
			'operacion'		=> $operacion,
			'exito' 		=> $exito,
			'nombre_obj'    => 'Tipo Contratación',
			'termino'       => $termino,
			'url_guardar'	=> base_url() . '/tipos_contratacion/guardar',
			'url_eliminar'  => base_url() . '/tipos_contratacion/eliminar',
			'url_buscar'    => base_url() . '/tipos_contratacion/buscar',
		];
		return crear_head('Tipos Contratación')
			. crear_body(
				view('tipos_contratacion/tipos_contratacion', $data),               //main
				'',                                           //sidebar
				crear_breadcrumb('Tipos Contratación', crear_ruta_breadcrumb('Tipos_contratacion')),   //breadcrumb
				['tipos_contratacion/tipos_contratacion.js']
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
				'NOMBRE_CONTRATACION'   => 'required|string'
			])) {
				(new TiposContratacionModel())->save([
					'ID_TIPO_CONTRATACION' => $this->request->getVar('ID_TIPO_CONTRATACION'),
					'NOMBRE_CONTRATACION' => $this->request->getVar('NOMBRE_CONTRATACION')
				]);
				$exito = true;
			}
			return $this->data_vista('guardar', $exito);
		}
		return redirect()->to(base_url() . '/tipos_contratacion');
	}

	public function eliminar()
	{
		if ($this->request->getMethod() == 'post') {
			$exito = false;
			if ($this->validate([
				'ID_TIPO_CONTRATACION'   => 'required|numeric'
			])) {
				(new TiposContratacionModel())->where('ID_TIPO_CONTRATACION', $this->request->getVar('ID_TIPO_CONTRATACION'))->delete();
				$exito = true;
			}
			return $this->data_vista('eliminar', $exito);
		}
		return redirect()->to(base_url() . '/tipos_contratacion');
	}

	public function buscar()
	{
		if ($this->request->getMethod() == 'post') {
			$exito = false;
			$termino = '';
			$tipos_contratacion = [];
			if ($this->validate([
				'termino'   => 'required|string'
			])) {
				$termino = trim($this->request->getVar('termino'));
				if ($termino != '') {
					$tipos_contratacion = (new TiposContratacionModel())
						->like('NOMBRE_CONTRATACION', $termino)
						->findAll();
				}
				$exito = (count($tipos_contratacion) == 0) ? false : true;
			}
			return $this->data_vista('buscar', $exito, $tipos_contratacion, $termino);
		}
		return redirect()->to(base_url() . '/tipos_contratacion');
	}
}
