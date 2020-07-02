<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

use App\Models\PlanillasModel;
use App\Models\DetallesPlanillasModel;
use App\Models\PeriodicidadPlanillaModel;
use App\Models\EmpresaModel;
use App\Models\EstatusPlanillasModel;
use App\Models\EmpleadosModel;
use App\Models\TiposContratacionModel;

function crear_ruta_breadcrumb($clase, $metodo = 'index'){
    $ruta_clase = [
        [
            'nombre' => 'Dashboard',
            'url'    => base_url().'/dashboard', 
        ],
        [
            'nombre' => ucwords(str_replace('_',' ',$clase)),
            'url'    => base_url().'/'.strtolower($clase), 
        ],
    ];
    $ruta_metodo = [
        'nombre' => ucfirst($metodo),
        'url'    => base_url().'/'.strtolower($clase).'/'.strtolower($metodo), 
    ];
    $ruta = [];
    if($metodo != 'index'){
        array_push($ruta_clase, $ruta_metodo);
    }
    $ruta = $ruta_clase;
    return $ruta;
}

function crear_excel($cod_planilla, $p_rango){
    $planilla_codigo = $cod_planilla;
    $id_planilla = (new PlanillasModel())->get_id_planilla_by_codigo($planilla_codigo);
    $planilla = ((new PlanillasModel())->get($id_planilla))[0];
    $detalles_planillas = (new DetallesPlanillasModel())->get_destalles($id_planilla);
    $periodo_nombre = (new PeriodicidadPlanillaModel())->get_descripcion((new EmpresaModel)->get_periodicidad(1));
    $rango = $p_rango;	
    

    $excel = new Spreadsheet(); 
    $excel->getProperties()
            ->setCreator("Sin Backup: grupo 09 Bad115");
    
    $nombreDelDocumento ="Planilla_".$planilla['CODIGO'];
    $hoja = $excel->getActiveSheet();

    $hoja->setTitle($planilla['CODIGO']);


    $styleArray = [
/*         'font' => [
            'bold' => true,
        ], */
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
        ],
        'borders' => [
            'top' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            ],
            'bottom' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            ],
            'left' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            ],
            'right' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            ],
        ],
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'startColor' => [
                'argb' => 'b3b7bb',
            ]
        ],
    ];
    
            
    $hoja->setCellValueByColumnAndRow(1, 1, "PLANILLA ".$periodo_nombre.": ".$rango);
    //imprimiendo los encabezados de planilla
    $hoja->setCellValueByColumnAndRow(1, 3, "Código Planilla");
    $hoja->setCellValueByColumnAndRow(2, 3, "Fecha Inicio");
    $hoja->setCellValueByColumnAndRow(3, 3, "Fecha Fin");
    $hoja->setCellValueByColumnAndRow(4, 3, "Estado");

    //imprimiendo el registro de planilla
    $hoja->setCellValueByColumnAndRow(1, 4, $planilla['CODIGO']);
    $hoja->setCellValueByColumnAndRow(2, 4, $planilla['DESDE_FECHA']);
    $hoja->setCellValueByColumnAndRow(3, 4, $planilla['HASTA_FECHA']);
    $hoja->setCellValueByColumnAndRow(4, 4, (new EstatusPlanillasModel())->get_nombre((new PlanillasModel())->get_estatus($id_planilla)));

    $hoja->setCellValueByColumnAndRow(1, 6, "DETALLE DE PLANILLA: ".$planilla['CODIGO']);
    //imprimiendo los encabezados de detalle planilla
    $hoja->setCellValueByColumnAndRow(1, 8, "Empleado");
    $hoja->setCellValueByColumnAndRow(2, 8, "Contratación");
    $hoja->setCellValueByColumnAndRow(3, 8, "Salario Ordinario");
    $hoja->setCellValueByColumnAndRow(4, 8, "Horas diarias");
    $hoja->setCellValueByColumnAndRow(5, 8, "Días Laborados");
    $hoja->setCellValueByColumnAndRow(6, 8, "Seguro Social");
    $hoja->setCellValueByColumnAndRow(7, 8, "AFP");
    $hoja->setCellValueByColumnAndRow(8, 8, "Renta");
    $hoja->setCellValueByColumnAndRow(9, 8, "Salario Liquido");
    //imprimiendo el registro de planilla
    for ($i=0; $i < count($detalles_planillas); $i++) { 
        $hoja->setCellValueByColumnAndRow(1,$i + 9, (new EmpleadosModel)->get_nombre_compleado($detalles_planillas[$i]['ID_EMPLEADO']));
        $hoja->setCellValueByColumnAndRow(2,$i + 9, (new TiposContratacionModel)->get_nombre($detalles_planillas[$i]['ID_TIPO_CONTRATACION_DETALLE']));
        $hoja->setCellValueByColumnAndRow(3,$i + 9, $detalles_planillas[$i]['SALARIO_ORDINARIO_DETALLE']);
        $hoja->setCellValueByColumnAndRow(4,$i + 9, $detalles_planillas[$i]['HORAS_DIARIAS']);
        $hoja->setCellValueByColumnAndRow(5,$i + 9, $detalles_planillas[$i]['DIAS_LABORADOS']);
        $hoja->setCellValueByColumnAndRow(6,$i + 9, $detalles_planillas[$i]['SEGURO_SOCIAL']);
        $hoja->setCellValueByColumnAndRow(7,$i + 9, $detalles_planillas[$i]['AFP']);
        $hoja->setCellValueByColumnAndRow(8,$i + 9, $detalles_planillas[$i]['RENTA']);
        $hoja->setCellValueByColumnAndRow(9,$i + 9, $detalles_planillas[$i]['SALARIO_LIQUIDO_DETALLE']);
    }
    
    
    $hoja = iterar_celdas('A', 'D', 3, 4, $hoja, $styleArray);
    $hoja = iterar_celdas('A', 'I', 8, 12, $hoja, $styleArray);

    //iterando el excel para dar auto width
    foreach(range('A','Z') as $columnID) {
        $excel->getActiveSheet()->getColumnDimension($columnID)
            ->setAutoSize(true);
    }

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $nombreDelDocumento . '"');
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($excel);
    $writer->save('php://output');
    exit; 
}

function iterar_celdas($c1, $c2, $f1, $f2, $hoja, $estilos){
    for ($i = $c1; $i <=  $c2; $i++) {
        for ($j = $f1; $j <= $f2; $j++){
           $hoja->getStyle($i.strval($j))->applyFromArray($estilos);
        }
    }
    return $hoja;

}

