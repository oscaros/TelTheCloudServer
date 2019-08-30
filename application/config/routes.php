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

$route['default_controller'] = "login";
$route['404_override'] = 'error';


/*********** USER DEFINED ROUTES *******************/

$route['loginMe'] = 'login/loginMe';
$route['dashboard'] = 'user';
$route['logout'] = 'user/logout';
$route['userListing'] = 'user/userListing';
$route['userListing/(:num)'] = "user/userListing/$1";
$route['addNew'] = "user/addNew";

$route['addNewUser'] = "user/addNewUser";
$route['editOld'] = "user/editOld";
$route['editOld/(:num)'] = "user/editOld/$1";
$route['editUser'] = "user/editUser";
$route['deleteUser'] = "user/deleteUser";
$route['loadChangePass'] = "user/loadChangePass";
$route['changePassword'] = "user/changePassword";
$route['pageNotFound'] = "user/pageNotFound";
$route['checkEmailExists'] = "user/checkEmailExists";

$route['forgotPassword'] = "login/forgotPassword";
$route['resetPasswordUser'] = "login/resetPasswordUser";
$route['resetPasswordConfirmUser'] = "login/resetPasswordConfirmUser";
$route['resetPasswordConfirmUser/(:any)'] = "login/resetPasswordConfirmUser/$1";
$route['resetPasswordConfirmUser/(:any)/(:any)'] = "login/resetPasswordConfirmUser/$1/$2";
$route['createPasswordUser'] = "login/createPasswordUser";


// therefore stations is any route nane and buying ststion is the name of the main class got the controller inchardge
//$route['contacts'] = "Contact_mgt";
$route['contactListing'] = 'contact_mgt/contactListing';
$route['contactListing/(:num)'] = "contact_mgt/contactListing/$1";

// route to all farmers display
$route['users'] = "user/userListing";


//routes for advances
$route['advances'] = "advances/advanceListing";
$route['advanceListing'] = "advances/advanceListing";
$route['addNewAdvance'] = "advances/addNewAdvance";
$route['addNewCocoaAdvance'] = "advances/addNewCocoaAdvance";
$route['viewSelectAdvance/(:num)'] = "advances/viewSelectAdvance/$1";


$route['api'] = 'api/users/';
$route['user'] = 'api/users/';
//api/users
$route['api/users'] = 'api/users/users/';
$route['api/users/format/json'] = 'api/users/users/format/json';
$route['api/users/format/xml'] = 'api/users/users/format/xml';
$route['api/users/format/html'] = 'api/users/users/format/html';
$route['api/users/format/csv'] = 'api/users/users/format/csv';
$route['api/users.json'] = 'api/users/users.json';
$route['api/users.xml'] = 'api/users/users.xml';
$route['api/users.html'] = 'api/users/users.html';
$route['api/users.csv'] = 'api/users/users.csv';
//api/users/1
$route['api/users/id/(:num)'] = 'api/users/users/id/$1';
//$route['api/users/id/(:any)'] = 'api/users/users/id/$1';
$route['api/users/id/(:num)/format/json'] = 'api/users/users/id/$1/format/json';
$route['api/users/id/(:num)/format/xml'] = 'api/users/users/id/$1/format/xml';
$route['api/users/id/(:num)/format/html'] = 'api/users/users/id/$1/format/html';
$route['api/users/id/(:num)/format/csv'] = 'api/users/users/id/$1/format/csv';
$route['api/users/id/(:num).json'] = 'api/users/users/id/$1.json';
$route['api/users/id/(:num).xml'] = 'api/users/users/id/$1.xml';
$route['api/users/id/(:num).html'] = 'api/users/users/id/$1.html';
$route['api/users/id/(:num).csv'] = 'api/users/users/id/$1.csv';






/* End of file routes.php */
/* Location: ./application/config/routes.php */