<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Komuntu Oscar
 */
class Inspection extends BaseController
{
   
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        // $this->load->model('inspection_model');
        $this->isLoggedIn();   
    }
    
    /**
     * This function used to load the first screen of the buying station
     */
    public function index()
    {
        $this->global['pageTitle'] = 'ICAM : Inspection';
        //$this->global['pageTitle'] = 'ICAM : Buying Stations';
        //$this->stationListing();
    }

    public function inspection()
    {
        $this->global['pageTitle'] = 'ICAM : Inspection';
        //$this->global['pageTitle'] = 'ICAM : Buying Stations';
        $this->inspectionListing();
    }

    function inspectionListing()
    {
        if($this->isAbleToAccessFarmersAndInspections()/* isAdmin() */ == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            // $this->load->model('inspection_model');
        
            $searchText = $this->input->post('searchText');
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            // $count = $this->inspection_model->farmersListingCount($searchText); //

			// $returns = $this->paginationCompress ( "inspectionListing/", $count, 10 );
            
            // $data['farmersRecords'] = $this->farmers_model->farmersListing($searchText, $returns["page"],  $returns["segment"]);
            
            $this->global['pageTitle'] = 'ICAM : Inspected Farmers Listing'; 
            
            $this->loadViews("inspection", $this->global, /* $data, */ NULL); //$data,
        }
    }

    function addNewInspection(){
      if($this->isAbleToAccessFarmersAndInspections() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('inspection_model');
            // $data['subcounties'] = $this->inspection_model-> getFarmerSubcounties();  
           // $data['subs'] = $this->buying_station_model->getLoginId();
            
            $this->global['pageTitle'] = 'ICAM : Add New Inspection Entry';
            $this->loadViews("addNewInspection", $this->global, /* $data, */ NULL);      // 
        }  
    }

  

}
?>