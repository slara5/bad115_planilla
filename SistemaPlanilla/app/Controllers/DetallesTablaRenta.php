<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Response;
use App\Models\DetallesTablaRentaModel;
use App\Models\TablaRentaModel;

class DetallesTablaRenta extends BaseController
{

	protected function data_vista($operacion = '', $exito = false, $detalles = [], $termino = '')
	{
		$detalles  = ($detalles == []) ? (new DetallesTablaRentaModel())->get() : $detalles;

        $tabla               = (new TablaRentaModel())->get();
        $detalles          = $detalles;

		$data = [
            'tablas'               => $tabla,
            'tablaModel'          => new TablaRentaModel(),
			'detalles'       => $detalles,
			'operacion'		=> $operacion,
			'exito' 		=> $exito,
			'nombre_obj'    => 'Detalle Tabla Renta',
			'termino'       => $termino,
			'url_guardar'	=> base_url() . '/detallesTablaRenta/guardar',
			'url_eliminar'  => base_url() . '/detallesTablaRenta/eliminar',
			'url_buscar'    => base_url() . '/detallesTablaRenta/buscar',
		];
		return crear_head('Detalles Tabla Renta')
			. crear_body(
				view('renta/detallesTablaRenta/detallesTablaRenta', $data),               //main
				'',                                           //sidebar
				crear_breadcrumb('Detalles Tabla Renta', crear_ruta_breadcrumb('DetallesTablaRenta')),   //breadcrumb
				['tablaRenta/detallesTablaRenta.js']
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
                'DESDE_MONTO_INGRESOS'   => 'required',
                'HASTA_MONTO_INGRESOS'   => 'required',
                'PORCENTAJE_RENTA_TABLA'   => 'required',
                'VALOR_FIJO_RENTA_TABLA'   => 'required',
			])) {
				(new DetallesTablaRentaModel())->save([
					'ID_RANGO_RENTA' => $this->request->getVar('ID_RANGO_RENTA'),
					'ID_TABLA' => $this->request->getVar('ID_TABLA'),
					'DESDE_MONTO_INGRESOS' => $this->request->getVar('DESDE_MONTO_INGRESOS'),
					'HASTA_MONTO_INGRESOS' => $this->request->getVar('HASTA_MONTO_INGRESOS'),
					'PORCENTAJE_RENTA_TABLA' => $this->request->getVar('PORCENTAJE_RENTA_TABLA'),
					'VALOR_FIJO_RENTA_TABLA' => $this->request->getVar('VALOR_FIJO_RENTA_TABLA')
				]);
				$exito = true;
			}
			return $this->data_vista('guardar', $exito);
		}
		return redirect()->to(base_url() . '/detallesTablaRenta');
	}

	public function eliminar()
	{
		if ($this->request->getMethod() == 'post') {
			$exito = false;
			if ($this->validate([
				'ID_RANGO_RENTA'   => 'required|numeric'
			])) {
				(new detallesTablaRentaModel())->where('ID_RANGO_RENTA', $this->request->getVar('ID_RANGO_RENTA'))->delete();
				$exito = true;
			}
			return $this->data_vista('eliminar', $exito);
		}
		return redirect()->to(base_url() . '/detallesTablaRenta');
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
					$array_tabla = (new TablaRentaModel())->buscar($termino);

                    $detalles_buscados = (new DetallesTablaRentaModel())
                    ->orWhereIn('ID_TABLA', $array_tabla )
                    ->findAll();
				}
				$exito = (count($detalles_buscados) == 0) ? false : true;
			}
			return $this->data_vista('buscar', $exito, $detalles_buscados, $termino);
		}
		return redirect()->to(base_url() . '/detallesTablaRenta');
	}
}
