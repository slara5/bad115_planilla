<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Response;
use App\Models\GenerosModel;

class Generos extends BaseController
{

	protected function data_vista($operacion = '', $exito = false, $generos = [], $termino = '')
	{
		$generos  = ($generos == []) ? (new GenerosModel())->get() : $generos;

		$data = [
			'generos'       => $generos,
			'operacion'		=> $operacion,
			'exito' 		=> $exito,
			'nombre_obj'    => 'Género',
			'termino'       => $termino,
			'url_guardar'	=> base_url() . '/generos/guardar',
			'url_eliminar'  => base_url() . '/generos/eliminar',
			'url_buscar'    => base_url() . '/generos/buscar',
		];
		return crear_head('Géneros')
			. crear_body(
				view('generos/generos', $data),               //main
				'',                                           //sidebar
				crear_breadcrumb('Géneros', crear_ruta_breadcrumb('Generos')),   //breadcrumb
				['generos/generos.js']
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
				'ID_GENERO'   => 'required|numeric'
			])) {
				(new GenerosModel())->where('ID_GENERO', $this->request->getVar('ID_GENERO'))->delete();
				$exito = true;
			}
			return $this->data_vista('eliminar', $exito);
		}
		return redirect()->to(base_url() . '/generos');
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
					$generos_buscados = (new GenerosModel())
						->like('DESCRIPCION_GENERO', $termino)
						->findAll();
				}
				$exito = (count($generos_buscados) == 0) ? false : true;
			}
			return $this->data_vista('buscar', $exito, $generos_buscados, $termino);
		}
		return redirect()->to(base_url() . '/generos');
	}
}
