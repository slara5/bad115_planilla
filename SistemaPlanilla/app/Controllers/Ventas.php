<?php namespace App\Controllers;
ini_set('display_errors', 1);
error_reporting(E_ALL);

use CodeIgniter\HTTP\IncomingRequest;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use CodeIgniter\Database\Query;
use App\Models\VentasModel;

class Ventas extends BaseController
{
	public function index()
	{
        $data['_view']='dashboard';
        return crear_plantilla(view('ventas/ventas'),$data);
	}

	public function import()
	{

		if($this->request->getMethod()=='post'){
			$ruta = 'uploads/';
			if(!is_dir($ruta)){
				mkdir($ruta,0755);
			}
			$file = $this->request->getFile('file_excel');
			if (!$file->isValid()){
				throw new RuntimeException($file->getErrorString().'('.$file->getError().')');
			}
			else{
				$name_file = $file->getName();
				$file->move($ruta);
				if ($file->hasMoved())
				{
					

					$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($ruta.$name_file);
				    $spreadsheet = $reader->load($ruta.$name_file);
					$sheet = $spreadsheet->getSheet(0);
					
					$db      = \Config\Database::connect();
					$builder = $db->table('ventas');

					$number_products = 0;
					$imported_products = 0;
					$arr_errors=[];
					$arr_data_produts=[];

					foreach ($sheet->getRowIterator(2) as $row) {
						
                        $idempleado = trim($sheet->getCellByColumnAndRow(1,$row->getRowIndex()));
						$idplan = trim($sheet->getCellByColumnAndRow(2,$row->getRowIndex()));
						$valor = trim($sheet->getCellByColumnAndRow(3,$row->getRowIndex()));
						if($idempleado == '' || $idplan==''|| $valor=='')
							continue;
						
						$data_ventas=['ID_EMPLEADO'=>$idempleado,'ID_PLANILLA'=>$idplan,'VALOR_VENTA'=>$valor];
						$arr_data_produts[]=$data_ventas;
						$number_products++;


						
					}
					$imported_products=$builder->insertBatch($arr_data_produts);
					$data['imported_products']=$imported_products;
					$data['number_products']=$number_products;
					return view('ventas/resultado_import',$data);
				}

			}
		}


	}

	public function list(){
		$ventasModel = new VentasModel();  
		$ventas = $ventastModel->getAll();
		var_dump($ventas);
	}

}
