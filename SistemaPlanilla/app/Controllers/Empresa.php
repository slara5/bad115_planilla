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

        $periodicidad     = (new PeriodicidadPlanillaModel())->get();
        $tabla = (new TablaRentaModel())->get();
        $empresa          = $empresa;

		$data = [
			'tablas'               => $tabla,
			'tablaModel'          => new TablaRentaModel(), 
			'periodicidades'               => $periodicidad,
            'periodicidadModel'          => new PeriodicidadPlanillaModel(),
			'empresas'       => $empresa,
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
				'ID_TABLA'   => 'required',
				'ID_PERIOCIDAD'   => 'required',
				'NOMBRE_EMPRESA'   => 'required',
				'PORCENTAJE_ISSS'   => 'required',
				'NIT_EMPRESA'   => 'required',
				'NUMERO_AFP_PATRONAL'   => 'required',
				'PORCENTAJE_INSAFORP'   => 'required',
				'LIMITE_ISSS'   => 'required',
				'NUMERO_EMP_MAX_INSAFORP'   => 'required',
				'SALARIO_MINIMO'   => 'required',
				
				
			])) {
				(new EmpresaModel())->save([
					'ID_EMPRESA' => $this->request->getVar('ID_EMPRESA'),
					'ID_TABLA' => $this->request->getVar('ID_TABLA'),
					'ID_PERIOCIDAD' => $this->request->getVar('ID_PERIOCIDAD'),
					'NOMBRE_EMPRESA' => $this->request->getVar('NOMBRE_EMPRESA'),
					'PORCENTAJE_ISSS' => $this->request->getVar('PORCENTAJE_ISSS'),
					'NIT_EMPRESA' => $this->request->getVar('NIT_EMPRESA'),
					'NUMERO_AFP_PATRONAL' => $this->request->getVar('NUMERO_AFP_PATRONAL'),
					'PORCENTAJE_INSAFORP' => $this->request->getVar('PORCENTAJE_INSAFORP'),
					'LIMITE_ISSS' => $this->request->getVar('LIMITE_ISSS'),
					'NUMERO_EMP_MAX_INSAFORP' => $this->request->getVar('NUMERO_EMP_MAX_INSAFORP'),
					'SALARIO_MINIMO' => $this->request->getVar('SALARIO_MINIMO')
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
				(new EmpresaModel())->where('ID_EMPRESA', $this->request->getVar('ID_EMPRESA'))->delete();
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
			$empresa_buscada = [];
			$termino = '';
			if ($this->validate([
				'termino'   => 'required|string'
			])) {
				$termino = trim($this->request->getVar('termino'));
				if ($termino != '') {
					$empresa_buscada = (new EmpresaModel())
						->like('NOMBRE_EMPRESA', $termino)
						->findAll();
				}
				$exito = (count($empresa_buscada) == 0) ? false : true;
			}
			return $this->data_vista('buscar', $exito, $empresa_buscada, $termino);
		}
		return redirect()->to(base_url() . '/empresa');
	}
   
}