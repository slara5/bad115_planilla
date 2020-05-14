<?php

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