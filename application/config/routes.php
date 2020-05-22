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
| class or method name character, so it requires translation.product/search
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['register'] = 'register';

$route['login'] = 'login';
$route['login/reset_password'] = 'login/reset_password';
$route['login/set_password'] = 'login/set_password';

$route['dashboard'] = 'product';
$route['product/{id}'] = 'product/detail/$1';
$route['product/sell'] = 'product/sell';
$route['product/sell_post']['post'] = 'product/sell_post';
//$route['product/send_comment']['post'] = 'product/send_comment';
$route['product/buy'] = 'product/buy';
$route['product/buy/:num'] = 'product/buyProduct/$1';
$route['paypal/success'] = 'product/paymentSuccess';
$route['paypal/fail'] = 'product/paymentFail';

$route['product/add_to_cart/:num']['post'] = 'cart/update';
$route['product/add_to_cart/:num'] = 'cart/add_to_cart/$1';
$route['cart/checkout'] = 'cart/checkout';
$route['cart/invoice'] = 'cart/invoice';
$route['cart/continue_shop'] = 'cart/continue_shop';

$route['user'] = 'user';
$route['user/profile'] = 'user/profile';
$route['user/profile/post']['post'] = 'user/update_profile';
$route['user/logout'] = 'user/logout';

$route['ajax/search_auto_completion'] = 'product/search_auto_completion';

