<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Response;
use App\Models\DescuentosProgramadosModel;
use App\Models\IngresosDescuentosModel;
use App\Models\EmpleadosModel;

class Descuentos_programados extends BaseController
{

	protected function data_vista($operacion = '', $exito = false, $descuentos_programados = [], $termino = '')
	{
		$descuentos_programados  = ($descuentos_programados == []) ? (new DescuentosProgramadosModel())->get() : $descuentos_programados;

		$data = [
            'descuentos_programados'  => $descuentos_programados,
            'empleados'     => (new EmpleadosModel())->get(),
            'empleadosModel'=> new EmpleadosModel(),
            'ingresosDescuentosModel'=> new IngresosDescuentosModel(),
            'descuentos'   => (new IngresosDescuentosModel())->get_descuentos(),
			'operacion'		=> $operacion,
			'exito' 		=> $exito,
			'nombre_obj'    => 'Descuento Programado',
			'termino'       => $termino,
			'url_guardar'	=> base_url() . '/descuentos_programados/guardar',
			'url_eliminar'  => base_url() . '/descuentos_programados/eliminar',
			'url_buscar'    => base_url() . '/descuentos_programados/buscar',
		];
		return crear_head('Descuentos Programados')
			. crear_body(
				view('descuentos_programados/descuentos_programados', $data),               //main
				'',                                           //sidebar
				crear_breadcrumb('Descuentos Programados', crear_ruta_breadcrumb('Descuentos_programados')),   //breadcrumb
				['descuentos_programados/descuentos_programados.js']
			);
	}

	public function index()
	{
		return $this->data_vista();
	}

	public function guardar()
	{
        // $this->form_validation->set_message();
		if ($this->request->getMethod() == 'post') {
			$exito = false;
			if ($this->validate([
                'VALOR_CUOTA_DESCUENTO'   => 'required',
                'FECHA_INICIO_DESCUENTO'   => 'valid_date[Y-m-d]',
                'FECHA_FIN_DESCUENTO'   => 'valid_date[Y-m-d]',

			])) {
				(new DescuentosProgramadosModel())->save([
					'ID_MOVIMIENTO_DESCUENTO' => $this->request->getVar('ID_MOVIMIENTO_DESCUENTO'),
                    'ID_EMPLEADO' => $this->request->getVar('ID_EMPLEADO'),
                    'ID_CODIGO' => $this->request->getVar('ID_CODIGO'),
                    'VALOR_CUOTA_DESCUENTO' => $this->request->getVar('VALOR_CUOTA_DESCUENTO'),
                    'FECHA_INICIO_DESCUENTO' => $this->request->getVar('FECHA_INICIO_DESCUENTO'),
                    'FECHA_FIN_DESCUENTO' => $this->request->getVar('FECHA_FIN_DESCUENTO'),
                    'ACTIVO_DESCUENTO' => $this->request->getVar('ACTIVO_DESCUENTO'),
				]);
				$exito = true;
			}
			return $this->data_vista('guardar', $exito);
		}
		return redirect()->to(base_url() . '/descuentos_programados');
	}

	public function eliminar()
	{
		if ($this->request->getMethod() == 'post') {
			$exito = false;
			if ($this->validate([
				'ID_MOVIMIENTO_DESCUENTO'   => 'required|numeric'
			])) {
				(new DescuentosProgramadosModel())->where('ID_MOVIMIENTO_DESCUENTO', $this->request->getVar('ID_MOVIMIENTO_DESCUENTO'))->delete();
				$exito = true;
			}
			return $this->data_vista('eliminar', $exito);
		}
		return redirect()->to(base_url() . '/descuentos_programados');
	}

	public function buscar()
	{
		if ($this->request->getMethod() == 'post') {
			$exito = false;
			$descuentos_buscados = [];
			$termino = '';
			if ($this->validate([
				'termino'   => 'required|string'
			])) {
                
                $termino = trim($this->request->getVar('termino'));
                if(strtolower($termino) == 'si'){
                    $afecta = 1;
                }else if(strtolower($termino) == 'no'){
                    $afecta = 0;
                }else{
                    $afecta = -1;
                }
                // $afecta = (strtolower($termino) == 'si') ? 1 : 0;
                

				if ($termino != '') {
                    $array_empleados = (new EmpleadosModel())->buscar($termino);
                    $array_movs = (new IngresosDescuentosModel())->buscar($termino);

                    $descuentos_buscados = (new DescuentosProgramadosModel())
                    ->orWhereIn('ID_EMPLEADO', $array_empleados )
                    ->orWhereIn('ID_CODIGO', $array_movs )
                    ->orWhere('ACTIVO_DESCUENTO', $afecta)
                    ->findAll();
                    
				}
				$exito = (count($descuentos_buscados) == 0) ? false : true;
			}
			return $this->data_vista('buscar', $exito, $descuentos_buscados, $termino);
		}
		return redirect()->to(base_url() . '/descuentos_programados');
	}
}
