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
$route['default_controller'] = 'LoginController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
/******* Login Routes *******/
$route['backend/login'] = 'LoginController/doLogin';
$route['logout'] = 'LoginController/logout';
/******* Dashboard Routes *******/
$route['dashboard'] = 'LoginController/dashboard';
/******* Category Routes *******/
$route['backend/category_type'] = 'CategoryController/index';
$route['backend/add_category_type'] = 'CategoryController/create';
$route['backend/edit_type/(:num)'] = 'CategoryController/edit/$1';
$route['backend/delete_type/(:num)'] = 'CategoryController/delete/$1';
$route['backend/category'] = 'CategoryController/category_index';
$route['backend/add_category'] = 'CategoryController/create_category';
$route['backend/edit_cat/(:num)'] = 'CategoryController/edit_category/$1';
$route['backend/delete_cat/(:num)'] = 'CategoryController/delete_cat/$1';
$route['backend/products'] = 'ProductController/index';
$route['backend/add_product'] = 'ProductController/create';
$route['backend/store_product'] = 'ProductController/store';
$route['backend/delete_product/(:num)'] = 'ProductController/delete/$1';
$route['backend/edit_product/(:num)'] = 'ProductController/edit/$1';
/******* Contact and Enquiry Routes *******/
$route['backend/contacts'] 	= 'CommController/contact_index';
$route['backend/enquiries'] = 'CommController/enquiry_index';
$route['backend/view_enquiry/(:num)'] = 'CommController/view_enquiry/$1';
/******* Profile Routes *******/
$route['backend/profile'] = 'ProfileController/index';
/******* Event Routes *******/
$route['backend/events'] = 'EventController/index';
$route['backend/add_event'] = 'EventController/create';
$route['backend/delete_event/(:num)'] = 'EventController/delete/$1';
$route['backend/edit_event/(:num)'] = 'EventController/edit/$1';
/******* Event Routes *******/
$route['backend/portfolio'] = 'PortfolioController/index';
$route['backend/add_portfolio'] = 'PortfolioController/create';
$route['backend/edit_portfolio/(:num)'] = 'PortfolioController/edit/$1';
$route['backend/delete_portfolio/(:num)'] = 'PortfolioController/delete/$1';
/******* Statistics & Analytics Routes *******/
$route['backend/statistics'] = 'StatisticsController/index';
