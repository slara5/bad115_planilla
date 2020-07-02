<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Response;
use App\Models\PeriodicidadPlanillaModel;

class Periodicidades extends BaseController
{

	protected function data_vista($operacion = '', $exito = false, $periodicidades = [], $termino = '')
	{
		$periodicidades  = ($periodicidades == []) ? (new PeriodicidadPlanillaModel())->get() : $periodicidades;

		$data = [
			'periodicidades'       => $periodicidades,
			'operacion'		=> $operacion,
			'exito' 		=> $exito,
			'nombre_obj'    => 'Periodicidad',
			'termino'       => $termino,
			'url_guardar'	=> base_url() . '/periodicidades/guardar',
			'url_eliminar'  => base_url() . '/periodicidades/eliminar',
			'url_buscar'    => base_url() . '/periodicidades/buscar',
		];
		return crear_head('Periodicidades')
			. crear_body(
				view('periodicidades/periodicidades', $data),               //main
				'',                                           //sidebar
				crear_breadcrumb('Periodicidades', crear_ruta_breadcrumb('Periodicidades')),   //breadcrumb
				['periodicidades/periodicidades.js']
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
                'DESC_PERIOCIDAD'   => 'required|string',
                'PLANILLAS_POR_MES'   => 'required',
			])) {
				(new PeriodicidadPlanillaModel())->save([
					'ID_PERIOCIDAD' => $this->request->getVar('ID_PERIOCIDAD'),
                    'DESC_PERIOCIDAD' => $this->request->getVar('DESC_PERIOCIDAD'),
                    'PLANILLAS_POR_MES' => $this->request->getVar('PLANILLAS_POR_MES'),
				]);
				$exito = true;
			}
			return $this->data_vista('guardar', $exito);
		}
		return redirect()->to(base_url() . '/periodicidades');
	}

	public function eliminar()
	{
		if ($this->request->getMethod() == 'post') {
			$exito = false;
			if ($this->validate([
				'ID_PERIOCIDAD'   => 'required|numeric'
			])) {
				(new PeriodicidadPlanillaModel())->where('ID_PERIOCIDAD', $this->request->getVar('ID_PERIOCIDAD'))->delete();
				$exito = true;
			}
			return $this->data_vista('eliminar', $exito);
		}
		return redirect()->to(base_url() . '/periodicidades');
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
					$periodicidades_buscados = (new PeriodicidadPlanillaModel())
						->like('DESC_PERIOCIDAD', $termino)
						->findAll();
				}
				$exito = (count($periodicidades_buscados) == 0) ? false : true;
			}
			return $this->data_vista('buscar', $exito, $periodicidades_buscados, $termino);
		}
		return redirect()->to(base_url() . '/periodicidades');
	}
}