<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

$route['default_controller']        = "Controller_web/index_web";
$route['404_override']              = '';

/***********************************Admin**********************************************/
$route['orden']                     = 'Controller_menu/vista_orden';
$route['pantallas']                 = 'Controller_pantalla/vista_pantalla';
$route['options_menu']              = 'Controller_menu_opciones/vista_menu_opciones';
$route['permissions_roles']         = 'Controller_roles/vista_roles';
$route['users']                     = 'Controller_usuarios/vista_usuario';
$route['menu']                      = 'Controller_menu/vista_menu';
$route['log_of_session']            = 'Controller_bitacora/estado_actividad';
$route['log_of_actions']            = 'Controller_bitacora/mostrar_bitacora';
$route['sistema']                   = 'Controller_home/principal';
$route['login']                     = 'Controller_home/c_login';
$route['close_session']             = 'Controller_home/cerrar';
$route['tema']                      = 'Controller_tema/vista_tema';

/***********************************Periodico**********************************************/
$route['noticia_admin']                      = 'periodico/Controller_noticia/vista_noticia';
$route['edicion_admin']                      = 'periodico/Controller_edicion/vista_edicion';
$route['categoria_admin']                    = 'periodico/Controller_categoria/vista_categoria';
$route['perfiles_admin']                     = 'periodico/Controller_perfiles/vista_perfiles';
$route['carrousel']                          = 'periodico/Controller_carrousel/vista_carrousel';
$route['redes']                              = 'periodico/Controller_redes/vista_redes';
$route['image']                              = 'periodico/Controller_prueba/vista_image';
$route['emprende']                        = 'periodico/Controller_emprende/vista_emprende';

/***********************************Web**********************************************/
$route['inicio'] = 'Controller_web/index_web';
$route['noticias'] = 'Controller_web/vista_noticias';
$route['editorial'] = 'Controller_web/vista_editorial';
$route['noticia'] = 'Controller_web/vista_noticia';
$route['noticia/(:num)'] = 'Controller_web/vista_noticia_p/$1';
$route['perfiles'] = 'Controller_web/vista_perfiles';
$route['perfil'] = 'Controller_web/vista_perfil';
$route['ediciones'] = 'Controller_web/vista_ediciones';
$route['noticias_edicion'] = 'Controller_web/vista_noticias_edicion';
$route['emprendedores'] = 'Controller_web/vista_emprendedores';
$route['emprendedor'] = 'Controller_web/vista_emprendedor';
$route['tendencias'] = 'Controller_web/vista_contador';
$route['edicion'] = 'Controller_web/vista_contador_edi';

/***********************************Imagenes**********************************************/
$route['imagen_subir']                      = 'periodico/Controller_noticia/upload';
$route['imagen_borrar']                      = 'periodico/Controller_noticia/delete';
$route['imagen_obtener']                     = 'periodico/Controller_noticia/obtener_img';


