<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Response;
use App\Models\EmpresaModel;
use App\Models\PeriodicidadPlanillaModel;
use App\Models\TablaRentaModel;

class Empresa extends BaseController
{
    protected function data_vista($operacion = '', $exito = false, $empresa = [], $termino = '')
	{
		$empresa  = ($empresa == []) ? (new EmpresaModel())->get() : $empresa;

        $periodicidad_planilla     = (new PeriodicidadPlanillaModel())->get();
        $tabla_renta = (new TablaRentaModel())->get();
        $empresa          = $empresa;

		$data = [
			'empresa'       => $empresa,
			'operacion'		=> $operacion,
			'exito' 		=> $exito,
			'nombre_obj'    => 'Empresa',
			'termino'       => $termino,
			'url_guardar'	=> base_url() . '/empresa/guardar',
			'url_eliminar'  => base_url() . '/empresa/eliminar',
			'url_buscar'    => base_url() . '/empresa/buscar',
		];
		return crear_head('Empresa')
			. crear_body(
				view('empresa/datosEmpresa/empresa', $data),               //main
				'',                                           //sidebar
				crear_breadcrumb('Empresa', crear_ruta_breadcrumb('Empresa')),   //breadcrumb
				['empresa/empresa.js']
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
				'DESCRIPCION_GENERO'   => 'required|string'
			])) {
				(new GenerosModel())->save([
					'ID_GENERO' => $this->request->getVar('ID_GENERO'),
					'DESCRIPCION_GENERO' => $this->request->getVar('DESCRIPCION_GENERO')
				]);
				$exito = true;
			}
			return $this->data_vista('guardar', $exito);
		}
		return redirect()->to(base_url() . '/generos');
	}

	public function eliminar()
	{
		if ($this->request->getMethod() == 'post') {
			$exito = false;
			if ($this->validate([
				'ID_EMPRESA'   => 'required|numeric'
			])) {
				(new GenerosModel())->where('ID_EMPRESA', $this->request->getVar('ID_EMPRESA'))->delete();
				$exito = true;
			}
			return $this->data_vista('eliminar', $exito);
		}
		return redirect()->to(base_url() . '/empresa');
	}

	public function buscar()
	{
		if ($this->request->getMethod() == 'post') {
			$exito = false;
			$generos_buscados = [];
			$termino = '';
			if ($this->validate([
				'termino'   => 'required|string'
			])) {
				$termino = trim($this->request->getVar('termino'));
				if ($termino != '') {
					$generos_buscados = (new EmpresaModel())
						->like('DESCRIPCION_GENERO', $termino)
						->findAll();
				}
				$exito = (count($empresa_buscada) == 0) ? false : true;
			}
			return $this->data_vista('buscar', $exito, $empresa_buscada, $termino);
		}
		return redirect()->to(base_url() . '/empresa');
	}
   
}