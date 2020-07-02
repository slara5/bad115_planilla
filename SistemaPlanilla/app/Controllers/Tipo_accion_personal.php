<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Response;
use App\Models\TipoAccionPersonalModel;
use App\Models\EmpleadosModel;

class Tipo_accion_personal extends BaseController
{

	protected function data_vista($operacion = '', $exito = false, $tipo_accion_personal = [], $termino = '')
	{
		$tipo_accion_personal  = ($tipo_accion_personal == []) ? (new TipoAccionPersonalModel())->get() : $tipo_accion_personal;

		$data = [
            'tipo_accion_personal'    => $tipo_accion_personal,
            'empleados'     => (new EmpleadosModel())->get(),
            'empleadosModel'=> new EmpleadosModel(),
			'operacion'		=> $operacion,
			'exito' 		=> $exito,
			'nombre_obj'    => 'Tipo Accion Personal',
			'termino'       => $termino,
			'url_guardar'	=> base_url() . '/tipo_accion_personal/guardar',
			'url_eliminar'  => base_url() . '/tipo_accion_personal/eliminar',
			'url_buscar'    => base_url() . '/tipo_accion_personal/buscar',
		];
		return crear_head('Tipo Accion Personal')
			. crear_body(
				view('tipo_accion_personal/tipo_accion_personal', $data),               //main
				'',                                           //sidebar
				crear_breadcrumb('Tipo Accion Personal', crear_ruta_breadcrumb('Tipo_accion_personal')),   //breadcrumb
				['tipo_accion_personal/tipo_accion_personal.js']
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
                'DESCRIPCION'   => 'required|string',
			])) {
				(new TipoAccionPersonalModel())->save([
                    'ID_TIPO' => $this->request->getVar('ID_TIPO'),
                    'DESCRIPCION' => $this->request->getVar('DESCRIPCION'),
				]);
				$exito = true;
			}
			return $this->data_vista('guardar', $exito);
		}
		return redirect()->to(base_url() . '/tipo_accion_personal');
	}

	public function eliminar()
	{
		if ($this->request->getMethod() == 'post') {
			$exito = false;
			if ($this->validate([
				'ID_TIPO'   => 'required|numeric'
			])) {
				(new TipoAccionPersonalModel())->where('ID_TIPO', $this->request->getVar('ID_TIPO'))->delete();
				$exito = true;
			}
			return $this->data_vista('eliminar', $exito);
		}
		return redirect()->to(base_url() . '/tipo_accion_personal');
	}

	public function buscar()
	{
		if ($this->request->getMethod() == 'post') {
			$exito = false;
			$tipo_acciones_buscadas = [];
			$termino = '';
			if ($this->validate([
				'termino'   => 'required|string'
			])) {
                
                $termino = trim($this->request->getVar('termino'));

				if ($termino != '') {
                    $tipo_acciones_buscadas = (new TipoAccionPersonalModel())
                    ->like('DESCRIPCION', $termino)
                    ->findAll();
				}
				$exito = (count($tipo_acciones_buscadas) == 0) ? false : true;
			}
			return $this->data_vista('buscar', $exito, $tipo_acciones_buscadas, $termino);
		}
		return redirect()->to(base_url() . '/tipo_accion_personal');
	}
}
