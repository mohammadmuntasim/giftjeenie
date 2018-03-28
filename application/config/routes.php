<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';

/*frontend*/
$route['wishlist/register'] = 'frontend/wishlist/register';
$route['wishlist/login'] = 'frontend/wishlist/index';
$route['wishlist'] = 'frontend/wishlist/index';
$route['wishlist/logout'] = 'frontend/wishlist/logout';
$route['wishlist/validate_credentials'] = 'frontend/wishlist/validate_credentials';
$route['wishlist/forgot_password'] = 'frontend/wishlist/forgot_password';
$route['wishlist/shared_wishlist'] = 'frontend/wishlist/shared_wishlist';
$route['wishlist/product_wishlist/(:any)'] = 'frontend/wishlist/product_wishlist/$1';
$route['wishlist/product_details/(:any)'] = 'frontend/wishlist/product_details/$1';



/*admin*/
$route['admin'] = 'user/index';
$route['admin/add'] = 'user/add';
$route['admin/update/(:any)'] = 'user/update/$1';
$route['admin/login'] = 'user/index';
$route['admin/logout'] = 'user/logout';
$route['admin/login/validate_credentials'] = 'user/validate_credentials';
$route['admin/forgot_password'] = 'user/forgot_password';

$route['admin/product'] = 'admin_product/index';
$route['admin/product/add'] = 'admin_product/add';
//$route['admin/product/update'] = 'admin_product/update';
$route['admin/product/update/(:any)'] = 'admin_product/update/$1';
$route['admin/products/delete/(:any)'] = 'admin_product/delete/$1';
$route['admin/product/(:any)'] = 'admin_product/index/$1'; //$1 = page number

$route['admin/dailydeals'] = 'admin_dailydeals/index';
$route['admin/dailydeals/brand/add'] = 'admin_dailydeals/brand_add';
$route['admin/dailydeals/brand/(:any)/edit'] = 'admin_dailydeals/brand_update/$1';
$route['admin/dailydeals/brand/(:any)/add_item'] = 'admin_dailydeals/brand_add_item/$1';

$route['admin/trends'] = 'admin_trends/index';
$route['admin/trends/list/add'] = 'admin_trends/list_add';
$route['admin/trends/list/(:any)/edit'] = 'admin_trends/list_update/$1';
$route['admin/trends/list/(:any)/add_item'] = 'admin_trends/list_add_item/$1';




/* End of file routes.php */
/* Location: ./application/config/routes.php */
