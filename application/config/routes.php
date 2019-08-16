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
$route['stations'] = "buying_station";
$route['Buying_station'] = 'Buying_station/stationListing';
$route['addNewStation'] = "Buying_station/addNewStation";

$route['addNewBuyingStation'] = "Buying_station/addNewBuyingStation";

$route['editOldBuyingStation'] = "Buying_station/editOldBuyingStation";
// route to display details of a particular buying station
$route['editOldBuyingStation/(:num)'] = "Buying_station/editOldBuyingStation/$1";
// route to edit buying station function
$route['editStation'] = "Buying_station/editStation";
// route to display list of all buying stations after performing an edit
$route['stationListing'] = 'Buying_station/stationListing';
$route['stationListing/(:num)'] = "Buying_station/stationListing/$1";

// route to all farmers display
$route['farmers'] = "farmers/farmersListing";
$route['farmersListing/(:num)'] = "farmers/farmersListing/$1";
// route to add new farmer
$route['addNewFarmer'] = "farmers/addNewfarmer";
$route['addNewIcamFarmer'] = "farmers/addNewIcamFarmer";
// route to edit farmers by id
$route['editOldfarmers/(:num)'] = "farmers/editOldfarmers/$1";
$route['editFarmer'] = "farmers/editFarmer";
// route to view details of a selected farmer
$route['viewSelectfarmer'] = "Farmers/viewAfarmer";
$route['viewSelectfarmer/(:num)'] = "farmers/viewAfarmer/$1";

$route['inspection'] = "inspection/inspection";
// route to add new inspection
$route['addNewInspection'] = "inspection/addNewInspection";

// route to display all purchases
$route['purchaseListing'] = "purchases/purchaseListing";
$route['purchaseListing/(:num)'] = "purchases/purchaseListing/$1";
// rote to add new purchase
$route['addNewPurchase'] = "purchases/addNewPurchase";
$route['addNewCocoaPurchase'] = "purchases/addNewCocoaPurchase";
$route['editOldPurchase/(:num)'] = "purchases/editOldPurchase/$1";
// route to edit purchase function
$route['editPurchase'] = "purchases/editPurchase";
$route['payFarmer'] = 'purchases/payFarmer';
$route['payIcamFarmer/(:num)'] = 'purchases/payIcamFarmer/$1';

$route['notification'] = "notification";

//routes for advances
$route['advances'] = "advances/advanceListing";
$route['advanceListing'] = "advances/advanceListing";
$route['addNewAdvance'] = "advances/addNewAdvance";
$route['addNewCocoaAdvance'] = "advances/addNewCocoaAdvance";
$route['viewSelectAdvance/(:num)'] = "advances/viewSelectAdvance/$1";

//routes for allocations
$route['allocationsListing'] = "allocations/allocationsListing";
$route['addNewPurchaser'] = "allocations/addNewPurchaser";
$route['addNewSchedule'] = "allocations/addNewSchedule";
$route['addNewCocoaPurchaser'] = 'allocations/addNewCocoaPurchaser';
$route['addNewPurchaserSchedule'] = 'allocations/addNewPurchaserSchedule';






/* End of file routes.php */
/* Location: ./application/config/routes.php */