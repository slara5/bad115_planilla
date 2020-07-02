<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Response;
use App\Models\RangoComisionModel;
use App\Models\EmpresaModel;

class RangoComision extends BaseController
{

	protected function data_vista($operacion = '', $exito = false, $rangos = [], $termino = '')
	{
		$rangos  = ($rangos == []) ? (new RangoComisionModel())->get() : $rangos;

        $empresa              = (new EmpresaModel())->get();
        $rangos          = $rangos;

		$data = [
            'empresas'               => $empresa,
            'empresaModel'          => new EmpresaModel(),
			'rangos'       => $rangos,
			'operacion'		=> $operacion,
			'exito' 		=> $exito,
			'nombre_obj'    => 'Rango de Comisión',
			'termino'       => $termino,
			'url_guardar'	=> base_url() . '/rangoComision/guardar',
			'url_eliminar'  => base_url() . '/rangoComision/eliminar',
			'url_buscar'    => base_url() . '/rangoComision/buscar',
		];
		return crear_head('Rangos de Comisión')
			. crear_body(
				view('rangos/rangoComision', $data),               //main
				'',                                           //sidebar
				crear_breadcrumb('Rangos de Comisión', crear_ruta_breadcrumb('RangoComision')),   //breadcrumb
				['rangos/rangoComision.js']
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
				'ID_EMPRESA'   => 'required',
                'DESDE_MONTO'   => 'required',
                'HASTA_MONTO'   => 'required',
                'PORCENTAJE_COMISION'   => 'required',
			])) {
				(new RangoComisionModel())->save([
					'ID_RANGO' => $this->request->getVar('ID_RANGO'),
					'ID_EMPRESA' => $this->request->getVar('ID_EMPRESA'),
					'DESDE_MONTO' => $this->request->getVar('DESDE_MONTO'),
					'HASTA_MONTO' => $this->request->getVar('HASTA_MONTO'),
					'PORCENTAJE_COMISION' => $this->request->getVar('PORCENTAJE_COMISION')
				]);
				$exito = true;
			}
			return $this->data_vista('guardar', $exito);
		}
		return redirect()->to(base_url() . '/rangoComision');
	}

	public function eliminar()
	{
		if ($this->request->getMethod() == 'post') {
			$exito = false;
			if ($this->validate([
				'ID_RANGO'   => 'required|numeric'
			])) {
				(new RangoComisionModel())->where('ID_RANGO', $this->request->getVar('ID_RANGO'))->delete();
				$exito = true;
			}
			return $this->data_vista('eliminar', $exito);
		}
		return redirect()->to(base_url() . '/rangoComision');
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
					$array_tabla = (new EmpresaModel())->buscar($termino);

                    $detalles_buscados = (new RangoComisionModel())
                    ->orWhereIn('ID_EMPRESA', $array_tabla )
                    ->findAll();
				}
				$exito = (count($detalles_buscados) == 0) ? false : true;
			}
			return $this->data_vista('buscar', $exito, $detalles_buscados, $termino);
		}
		return redirect()->to(base_url() . '/rangoComision');
	}
}
