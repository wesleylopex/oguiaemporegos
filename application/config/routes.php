<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
| URI contains no data. In the above example, the 'welcome' class
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

$route['default_controller'] = 'home';

$route['inicio'] = 'home/index';

$route['termos-de-uso'] = 'terms';
$route['termos'] = 'terms';

$route['vagas-de-emprego'] = 'jobs';
$route['vagas-de-emprego/pesquisar'] = 'jobs';

$route['vaga-de-emprego/(:any)'] = 'job/index/$1';

$route['cadastro'] = 'candidates/signup/signup';
$route['entrar'] = 'candidates/login';

$route['candidatos/interesses'] = 'candidates/profile/interests';

$route['imprimir'] = 'candidates/profile/printProfile';
$route['imprimir/(:any)'] = 'candidates/profile/printProfile/index/$1';

$route['empresas/cadastro'] = 'companies/signup/signup';
$route['empresas/entrar'] = 'companies/login';

$route['esqueceu-senha'] = 'forgotPassword/home/index';
$route['esqueceu-senha/email-enviado'] = 'forgotPassword/email/sent';
$route['esqueceu-senha/nova-senha'] = 'forgotPassword/newPassword';

$route['404_override'] = 'home/error';

$route['(:any)'] = function ($param) {
  $reserved = ['companies', 'admin', 'candidates'];

  if (in_array($param, $reserved)) {
    return $param;
  }

  return 'companies/profile/home/index/' . $param;
};

$route['translate_uri_dashes'] = FALSE;