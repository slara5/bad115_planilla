<?php

date_default_timezone_set ('America/El_Salvador');
setlocale(LC_TIME, 'es_SV');

function crear_plantilla($main = ''){
    return crear_head().crear_body($main);
}

function crear_head(
    $titulo = 'Sin Backup'
){
    $datos = [
        'titulo' => $titulo,
    ];
    return view('plantilla/head', $datos);
}

function crear_body(
        $main = '',
        $navbar = '',
        $breadcrumb = '',
        $sidebar = '',
        $footer = ''
    ){
    $navbar = ($navbar == '') ? crear_navbar() : $navbar;
    $breadcrumb = ($breadcrumb == '') ? crear_breadcrumb() : $breadcrumb;
    $sidebar = ($sidebar == '') ? crear_sidebar() : $sidebar;
    $main = ($main == '') ? '<h1>Sin Contenido</h1>' : $main;
    $footer = ($footer == '') ? crear_footer() : $footer; 

    $datos = [
        'navbar'     => $navbar,
        'breadcrumb' => $breadcrumb,
        'sidebar'    => $sidebar,
        'main'       => $main,
        'footer'     => $footer,
    ];
    return view('plantilla/body', $datos);
}

function crear_navbar(
    $enlaces = [],
    $fecha = ''
){
    if($fecha == ''){
        $fecha = date("d") . "/" . date("m") . "/" . date("Y") . "   ".date("H:i:s");  ;
    }
    if(count($enlaces) == 0){
        $enlaces = [[
            'nombre' => 'Casa',
            'url' => base_url()
        ]];
    }
    $datos = [
        'enlaces' => $enlaces,
        'fecha' => $fecha,
    ];
    return view('plantilla/navbar', $datos);
}

function crear_breadcrumb(
    $titulo  = 'Dashboard',
    $ruta = []
){
    if(count($ruta) == 0){
        $ruta = [[
                'nombre' => 'Dashboard',
                'url' => base_url()
            ],[
                'nombre' => 'Casa',
                'url' => base_url()
            ]];
    }
    $datos = [
        'titulo' => $titulo,
        'ruta' => $ruta,
    ];
    return view('plantilla/breadcrumb', $datos);
}

function crear_sidebar(
    $usuario = []

){
    $datos = [
        'usuario' => $usuario,
        
    ];
    return view('plantilla/sidebar', $datos);
}

function crear_footer(
    $grupo = 'Sin Backup',
    $materia = 'BAD115'

){
    $datos = [
        'grupo' => $grupo,
        'materia' => $materia
        
    ];
    return view('plantilla/footer', $datos);
}

