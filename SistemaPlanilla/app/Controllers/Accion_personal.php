<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Response;
use App\Models\AccionPersonalModel;
use App\Models\TipoAccionPersonalModel;
use App\Models\EmpleadosModel;

class Accion_personal extends BaseController
{

	protected function data_vista($operacion = '', $exito = false, $accion_personal = [], $termino = '')
	{
		$accion_personal  = ($accion_personal == []) ? (new AccionPersonalModel())->get() : $accion_personal;

		$data = [
            'accion_personal'    => $accion_personal,
            'empleados'     => (new EmpleadosModel())->get(),
            'empleadosModel'=> new EmpleadosModel(),
            'tipoAccionModel'=> new TipoAccionPersonalModel(),
            'tipo_accion'   => (new TipoAccionPersonalModel())->get(),
			'operacion'		=> $operacion,
			'exito' 		=> $exito,
			'nombre_obj'    => 'Accion Personal',
			'termino'       => $termino,
			'url_guardar'	=> base_url() . '/accion_personal/guardar',
			'url_eliminar'  => base_url() . '/accion_personal/eliminar',
			'url_buscar'    => base_url() . '/accion_personal/buscar',
		];
		return crear_head('Accion Personal')
			. crear_body(
				view('accion_personal/accion_personal', $data),               //main
				'',                                           //sidebar
				crear_breadcrumb('Accion Personal', crear_ruta_breadcrumb('Accion_personal')),   //breadcrumb
				['accion_personal/accion_personal.js']
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
                'FECHA_ACCION'   => 'valid_date[Y-m-d]',
                'DIAS_APLICAR'   => 'required|numeric',

			])) {
				(new AccionPersonalModel())->save([
					'ID_ACCION' => $this->request->getVar('ID_ACCION'),
                    'ID_TIPO' => $this->request->getVar('ID_TIPO'),
                    'ID_EMPLEADO' => $this->request->getVar('ID_EMPLEADO'),
                    'FECHA_ACCION' => $this->request->getVar('FECHA_ACCION'),
                    'DIAS_APLICAR' => $this->request->getVar('DIAS_APLICAR'),
                    'DESCUENTA_DIAS' => $this->request->getVar('DESCUENTA_DIAS'),
				]);
				$exito = true;
			}
			return $this->data_vista('guardar', $exito);
		}
		return redirect()->to(base_url() . '/accion_personal');
	}

	public function eliminar()
	{
		if ($this->request->getMethod() == 'post') {
			$exito = false;
			if ($this->validate([
				'ID_ACCION'   => 'required|numeric'
			])) {
				(new AccionPersonalModel())->where('ID_ACCION', $this->request->getVar('ID_ACCION'))->delete();
				$exito = true;
			}
			return $this->data_vista('eliminar', $exito);
		}
		return redirect()->to(base_url() . '/accion_personal');
	}

	public function buscar()
	{
		if ($this->request->getMethod() == 'post') {
			$exito = false;
			$acciones_buscadas = [];
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
                    $array_tipos = (new TipoAccionPersonalModel())->buscar($termino);

                    $acciones_buscadas = (new AccionPersonalModel())
                    ->orWhereIn('ID_EMPLEADO', $array_empleados )
                    ->orWhereIn('ID_TIPO', $array_tipos )
                    ->orWhere('DESCUENTA_DIAS', $afecta)
                    ->orWhere('DIAS_APLICAR', $termino)
                    ->findAll();
                    
				}
				$exito = (count($acciones_buscadas) == 0) ? false : true;
			}
			return $this->data_vista('buscar', $exito, $acciones_buscadas, $termino);
		}
		return redirect()->to(base_url() . '/accion_personal');
	}
}
