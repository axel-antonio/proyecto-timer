<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Ciber';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['Ciber/iniciar_sesion'] = 'Ciber/iniciar_sesion';
$route['Ciber/finalizar_sesion'] = 'Ciber/finalizar_sesion';
$route['Ciber/agregar_maquina'] = 'Ciber/agregar_maquina'; // Ruta para agregar una máquina
$route['Ciber/actualizar_estado'] = 'Ciber/actualizar_estado';
$route['Ciber/actualizar_nota_mensaje'] = 'Ciber/actualizar_nota_mensaje';
$route['Ciber/eliminar_maquina'] = 'Ciber/eliminar_maquina';


// New routes for login
$route['login'] = 'login/index';
$route['login/authenticate'] = 'login/authenticate';
$route['logout'] = 'login/logout';