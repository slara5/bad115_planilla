<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Response;
use App\Models\PresupuestosModel;
use App\Models\DepartamentosEmpresaModel;

class Presupuestos extends BaseController
{

	protected function data_vista($operacion = '', $exito = false, $presupuestos = [], $termino = '')
	{
		$presupuestos  = ($presupuestos == []) ? (new PresupuestosModel())->get() : $presupuestos;

        $departamento              = (new DepartamentosEmpresaModel())->get();
        $presupuestos          = $presupuestos;

		$data = [
            'departamentos'               => $departamento,
            'departamentoModel'          => new DepartamentosEmpresaModel(),
			'presupuestos'       => $presupuestos,
			'operacion'		=> $operacion,
			'exito' 		=> $exito,
			'nombre_obj'    => 'Presupuesto Dep.',
			'termino'       => $termino,
			'url_guardar'	=> base_url() . '/presupuestos/guardar',
			'url_eliminar'  => base_url() . '/presupuestos/eliminar',
			'url_buscar'    => base_url() . '/presupuestos/buscar',
		];
		return crear_head('Presupuesto Dep.')
			. crear_body(
				view('presupuestos/presupuestos', $data),               //main
				'',                                           //sidebar
				crear_breadcrumb('Presupuesto Dep.', crear_ruta_breadcrumb('presupuestos')),   //breadcrumb
				['presupuestos/presupuestos.js']
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
				'ID_DEPARTAMENTO_EMPRESA'   => 'required',
                'ANIO'   => 'required',
                'MES'   => 'required',
                'MONTO_PRESUPUESTOANUAL'   => 'required',
			])) {
				(new PresupuestosModel())->save([
					'ID_PRESUPUESTO' => $this->request->getVar('ID_PRESUPUESTO'),
					'ID_DEPARTAMENTO_EMPRESA' => $this->request->getVar('ID_DEPARTAMENTO_EMPRESA'),
					'ANIO' => $this->request->getVar('ANIO'),
					'MES' => $this->request->getVar('MES'),
					'MONTO_PRESUPUESTOANUAL' => $this->request->getVar('MONTO_PRESUPUESTOANUAL')
				]);
				$exito = true;
			}
			return $this->data_vista('guardar', $exito);
		}
		return redirect()->to(base_url() . '/presupuestos');
	}

	public function eliminar()
	{
		if ($this->request->getMethod() == 'post') {
			$exito = false;
			if ($this->validate([
				'ID_PRESUPUESTO'   => 'required|numeric'
			])) {
				(new PresupuestosModel())->where('ID_PRESUPUESTO', $this->request->getVar('ID_PRESUPUESTO'))->delete();
				$exito = true;
			}
			return $this->data_vista('eliminar', $exito);
		}
		return redirect()->to(base_url() . '/presupuestos');
	}

	public function buscar()
	{
		if ($this->request->getMethod() == 'post') {
			$exito = false;
			$detalles_buscados = [];
			$termino = '';
			if ($this->validate([
				'termino'   => 'required|string'
			])) {
				$termino = trim($this->request->getVar('termino'));
                

				if ($termino != '') {
                    $array_presupuestos = (new DepartamentosEmpresaModel())->buscar($termino);

                    $detalles_buscados = (new PresupuestosModel())
                    ->orWhereIn('ID_DEPARTAMENTO_EMPRESA', $array_presupuestos )
					->orLike('ANIO', $termino)
					->orLike('MES', $termino)
                    ->findAll();
                    
				}
				$exito = (count($detalles_buscados) == 0) ? false : true;
			}
			return $this->data_vista('buscar', $exito, $detalles_buscados, $termino);
		}
		return redirect()->to(base_url() . '/presupuestos');
	}
}
