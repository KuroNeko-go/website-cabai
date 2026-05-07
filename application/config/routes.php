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
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// =============================================
// FRONTEND ROUTES (Public)
// =============================================
$route[''] = 'home/index';
$route['home'] = 'home/index';
$route['cabai'] = 'cabai/index';
$route['cabai/detail/(:num)'] = 'cabai/detail/$1';
$route['bibit'] = 'bibit/index';
$route['bibit/detail/(:num)'] = 'bibit/detail/$1';
$route['bibit/kategori/(:num)'] = 'bibit/kategori/$1';
$route['cart'] = 'cart/index';
$route['cart/checkout'] = 'cart/checkout';
$route['cart/process'] = 'cart/process';
$route['cart/success'] = 'cart/success';
$route['cart/remove/(:num)'] = 'cart/remove/$1';

// Cart API
$route['cart/add'] = 'cart/add';
$route['cart/update'] = 'cart/update';
$route['cart/get_cart'] = 'cart/get_cart';

// =============================================
// BACKEND ROUTES (Admin)
// =============================================
$route['auth/login'] = 'auth/login';
$route['auth/do_login'] = 'auth/do_login';
$route['auth/register'] = 'auth/register';
$route['auth/do_register'] = 'auth/do_register';
$route['auth/logout'] = 'auth/logout';
$route['auth/forgot_password'] = 'auth/forgot_password';
$route['auth/do_forgot_password'] = 'auth/do_forgot_password';

// Admin Cabai
$route['admin_cabai'] = 'admin_cabai/index';
$route['admin_cabai/create'] = 'admin_cabai/create';
$route['admin_cabai/store'] = 'admin_cabai/store';
$route['admin_cabai/edit/(:num)'] = 'admin_cabai/edit/$1';
$route['admin_cabai/update/(:num)'] = 'admin_cabai/update/$1';
$route['admin_cabai/delete/(:num)'] = 'admin_cabai/delete/$1';

// Admin Bibit
$route['admin_bibit'] = 'admin_bibit/index';
$route['admin_bibit/create'] = 'admin_bibit/create';
$route['admin_bibit/store'] = 'admin_bibit/store';
$route['admin_bibit/edit/(:num)'] = 'admin_bibit/edit/$1';
$route['admin_bibit/update/(:num)'] = 'admin_bibit/update/$1';
$route['admin_bibit/delete/(:num)'] = 'admin_bibit/delete/$1';

// Admin Transaksi
$route['admin_transaksi'] = 'admin_transaksi/index';
$route['admin_transaksi/detail/(:num)'] = 'admin_transaksi/detail/$1';
$route['admin_transaksi/update_status/(:num)/(:any)'] = 'admin_transaksi/update_status/$1/$2';
