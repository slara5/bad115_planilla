<?php

date_default_timezone_set ('America/El_Salvador');
setlocale(LC_TIME, 'es_SV');

function crear_plantilla($main = ''){
    return crear_head().crear_body($main);
}

function crear_head(
    $titulo = 'Sin Backup',
    $estilos    = []
){
    $datos = [
        'titulo' => $titulo,
        'estilos'=> $estilos,
    ];
    return view('plantilla/head', $datos);
}

function crear_body(
        $main = '',
        $sidebar = '',
        $breadcrumb = '',
        $scripts = [],
        $navbar = '',
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
        'scripts'    => $scripts,
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
    $usuario = [],
    $menus = []
){
    if(count($usuario) == 0){
        $usuario = [
            'nombre' => session()->get('NOMBRES') .' '. session()->get('APELLIDOS'),
            'img'    => 'user2-160x160.jpg',
            'url'    => base_url()
        ];
    }
    if(count($menus) == 0){
        $menus = [
            [
                'nombre'   => 'Empresa',
                'url'      => base_url(),
                'icono'    => 'fas fa-building',
                'submenus' => [
                    [
                        'nombre'   => 'Datos Empresa',
                        'url'      => base_url()
                    ],
                    [
                        'nombre'   => 'Divisiones',
                        'url'      => base_url()
                    ]
                ]
            ],
            [
                'nombre'   => 'Planilla',
                'url'      => base_url(),
                'icono'    => 'fas fa-copy',
                'submenus' => [
                    [
                        'nombre'   => 'Boleta de pago',
                        'url'      => base_url()
                    ],
                    [
                        'nombre'   => 'ISSS, AFP',
                        'url'      => base_url()
                    ],
                ]
            ],
            [
                'nombre'   => 'Empleados',
                'url'      => base_url(),
                'icono'    => 'fas fa-address-card',
                'submenus' => [
                    [
                        'nombre'   => 'Datos Empleados',
                        'url'      => base_url()
                    ],
                    [
                        'nombre'   => 'Nuevo Empleado',
                        'url'      => base_url()
                    ],
                ]
            ],
            [
                'nombre'   => 'Usuario',
                'url'      => base_url(),
                'icono'    => 'fas fa-users-cog',
                'submenus' => [
                    [
                        'nombre'   => 'Roles Y permisos',
                        'url'      => base_url()
                    ],
                    [
                        'nombre'   => 'Activar y desactivar',
                        'url'      => base_url()
                    ],
                ]
            ]
            ];
    }
    $datos = [
        'usuario' => $usuario,
        'menus'  => $menus
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

