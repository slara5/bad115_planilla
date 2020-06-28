<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Response;
use App\Models\AfpsModel;

class Afps extends BaseController
{

	protected function data_vista($operacion = '', $exito = false, $afps = [], $termino = '')
	{
		$afps  = ($afps == []) ? (new AfpsModel())->get() : $afps;

		$data = [
			'afps'       => $afps,
			'operacion'		=> $operacion,
			'exito' 		=> $exito,
			'nombre_obj'    => 'AFP',
			'termino'       => $termino,
			'url_guardar'	=> base_url() . '/afps/guardar',
			'url_eliminar'  => base_url() . '/afps/eliminar',
			'url_buscar'    => base_url() . '/afps/buscar',
		];
		return crear_head('Afps')
			. crear_body(
				view('afp/afps', $data),               //main
				'',                                           //sidebar
				crear_breadcrumb('Afps', crear_ruta_breadcrumb('Afps')),   //breadcrumb
				['afps/afps.js']
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
                'NOMBRE_AFP'   => 'required',
                'PORCENTAJE_LABORAL'=> 'required',
                'PORCENTAJE_PATRONAL'=> 'required',
                'LIMITE_MAXIMO_AFP'=> 'required',
			])) {
				(new AfpsModel())->save([
					'ID_AFP' => $this->request->getVar('ID_AFP'),
					'NOMBRE_AFP' => $this->request->getVar('NOMBRE_AFP'),
					'PORCENTAJE_LABORAL' => $this->request->getVar('PORCENTAJE_LABORAL'),
					'PORCENTAJE_PATRONAL' => $this->request->getVar('PORCENTAJE_PATRONAL'),
					'LIMITE_MAXIMO_AFP' => $this->request->getVar('LIMITE_MAXIMO_AFP'),
				]);
				$exito = true;
			}
			return $this->data_vista('guardar', $exito);
		}
		return redirect()->to(base_url() . '/afps');
	}

	public function eliminar()
	{
		if ($this->request->getMethod() == 'post') {
			$exito = false;
			if ($this->validate([
				'ID_AFP'   => 'required|numeric'
			])) {
				(new AfpsModel())->where('ID_AFP', $this->request->getVar('ID_AFP'))->delete();
				$exito = true;
			}
			return $this->data_vista('eliminar', $exito);
		}
		return redirect()->to(base_url() . '/afps');
	}

	public function buscar()
	{
		if ($this->request->getMethod() == 'post') {
			$exito = false;
			$afps_buscados = [];
			$termino = '';
			if ($this->validate([
				'termino'   => 'required|string'
			])) {
				$termino = trim($this->request->getVar('termino'));
				if ($termino != '') {
					$afps_buscados = (new AfpsModel())
						->like('NOMBRE_AFP', $termino)
						->findAll();
				}
				$exito = (count($afps_buscados) == 0) ? false : true;
			}
			return $this->data_vista('buscar', $exito, $afps_buscados, $termino);
		}
		return redirect()->to(base_url() . '/afps');
	}
}