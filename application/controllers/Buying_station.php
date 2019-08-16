<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Komuntu Oscar
 */
class Buying_station extends BaseController
{
    
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('buying_station_model');
        $this->isLoggedIn();   
    }
    
    /**
     * This function used to load the first screen of the buying station
     */
    public function index()
    {
        $this->global['pageTitle'] = 'ICAM : Buying Stations';
        //$this->global['pageTitle'] = 'ICAM : Buying Stations';
        //$this->stationListing();
    }

  
    /**
     * This function is used to load the buying station list
     */
    function stationListing()
    {
        if($this->isAbleToAccessBuyingStations() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('buying_station_model');
        
            $searchText = $this->input->post('searchText');
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->buying_station_model->stationListingCount($searchText); 
            
			$returns = $this->paginationCompress ( "stationListing/", $count, 5 );
            
            $data['stationRecords'] = $this->buying_station_model->stationListing($searchText, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'ICAM : Buying Stations'; 
            
            $this->loadViews("buyingStations", $this->global, $data, NULL); //$data,
        }
    }

   /**
     * This function is used to load the add new station form
     */
    function addNewStation()
    {
        if($this->isAbleToAccessBuyingStations() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('buying_station_model');
            $data['subs'] = $this->buying_station_model->getStationSubcounties();  
           // $data['subs'] = $this->buying_station_model->getLoginId();
            
            $this->global['pageTitle'] = 'ICAM : Add New Station';

            $this->loadViews("addNewStation", $this->global, $data, NULL);      //
        }
    }

    /**
     * This function is used to add new user to the system
     */
    function addNewBuyingStation()
    {
        if($this->isAbleToAccessBuyingStations() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
           /*  $this->load->library('form_validation');        
           
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addNewStation();
            }
            else
            { */
                $bs_name = $this->input->post('bs_name');
                $bs_subcounty = $this->input->post('subcounty');
                $bs_parish = $this->input->post('bs_parish');
                $bs_addedby = $this->input->post('bs_added');
                
                $stationInfo = array('bs_name'=>$bs_name, 'subcounty_id'=>$bs_subcounty, 'bs_parish'=> $bs_parish,
                                    'bs_createdby'=>$bs_addedby, 'isAssigned'=> '0', 'bs_addedon'=>date('Y-m-d H:i:s'));
                
                $this->load->model('buying_station_model');
                $result = $this->buying_station_model->addNewStation($stationInfo);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New Buying Station added successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Buying station creation failed');
                }
                
                redirect('addNewStation');
           // }
        }
    }


/**
     * This function is used load bstation edit information
     * @param number $stationId : Optional : This is user id
     */
    function editOldBuyingStation($stationId = NULL)
    {
        if($this->isAbleToAccessBuyingStations() == TRUE /* || $stationId == 1 */)
        {
            $this->loadThis();
        }
        else
        {
            if($stationId == null)
            {
                redirect('stationListing');
            }
            
            // load data about existing stations
            $data['stationInfo'] = $this->buying_station_model->getStationInfo($stationId);
            // Load some subounties
            $data['subcounties'] = $this->buying_station_model->getStationSubcounties(); 
            $this->global['pageTitle'] = 'ICAM : Edit Existing Buying Station';
            
            $this->loadViews("editOldBuyingStation", $this->global, $data, NULL);
        }
    }
    
/**
     * This function is used to edit the user information
     */
    function editStation()
    {
        if($this->isAbleToAccessBuyingStations() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            /* $this->load->library('form_validation');            
           
            
            $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('email','Email','trim|required|valid_email|xss_clean|max_length[128]');
            $this->form_validation->set_rules('password','Password','matches[cpassword]|max_length[20]');
            $this->form_validation->set_rules('cpassword','Confirm Password','matches[password]|max_length[20]');
            $this->form_validation->set_rules('role','Role','trim|required|numeric');
            $this->form_validation->set_rules('mobile','Mobile Number','required|min_length[10]|xss_clean');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->editOldBuyingStation($stationId);
            }
            else
            {*/
                $stationId = $this->input->post('stationId');
                $bs_name = $this->input->post('bs_name');
                $bs_subcounty = $this->input->post('subcounty');
                $bs_parish = $this->input->post('bs_parish'); 
                
                               
                
                $stationInfo = array('bs_name'=>$bs_name, 'subcounty_id'=>$bs_subcounty, 'bs_parish'=> $bs_parish);
                
                $result = $this->buying_station_model->editStation($stationInfo, $stationId);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Buying Station updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Buying Station update failed');
                }
                
                redirect('stationListing');
           // }
        }
    }

    function pageNotFound()
    {
        $this->global['pageTitle'] = 'ICAM : 404 - Page Not Found';
        
        $this->loadViews("404", $this->global, NULL, NULL);
    }



}

?>