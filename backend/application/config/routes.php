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
|	https://codeigniter.com/user_guide/general/routing.html
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

$route['default_controller'] = 'empleado';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;

// Rutas para empleado
$route['empleado']['get'] = 'empleado/index';
$route['empleado/(:num)']['get'] = 'empleado/find/$1';
$route['empleado']['reporte'] = 'empleado/reporte/';
$route['empleado']['post'] = 'empleado/index';
$route['empleado/(:num)']['put'] = 'empleado/index/$1';
$route['empleado/(:num)']['delete'] = 'empleado/index/$1';
$route['empleado/(:num)']['buscarCodigo'] = 'empleado/buscarCodigo/$1';
$route['empleado/(:num)']['buscarNombre'] = 'empleado/buscarNombre/$1';
$route['empleado']['guadarImagen'] = 'empleado/guadarImagen/';

// Rutas para regiones
$route['region']['get'] = 'region/index';
$route['region/(:num)']['get'] = 'region/find/$1';
$route['region']['post'] = 'region/index';
$route['region/(:num)']['put'] = 'region/index/$1';
$route['region/(:num)']['delete'] = 'region/index/$1';

// Rutas para provincias
$route['provincia']['get'] = 'provincia/index';
$route['provincia/(:num)']['get'] = 'provincia/find/$1';
$route['provincia']['post'] = 'provincia/index';
$route['provincia/(:num)']['put'] = 'provincia/index/$1';
$route['provincia/(:num)']['delete'] = 'provincia/index/$1';