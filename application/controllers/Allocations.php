<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (purchasesController)
 * User Class to control all user related operations.
 * @author : Komuntu Oscar
 */
class Allocations extends BaseController
{
       /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('allocations_model');
        $this->isLoggedIn();   
    }
     /**
     * This function used to load the first screen of the buying station
     */
    public function index()
    {
        $this->global['pageTitle'] = 'ICAM : Allocations';
        //$this->global['pageTitle'] = 'ICAM : Buying Stations';
        //$this->stationListing();
    }

    function pageNotFound()
    {
        $this->global['pageTitle'] = 'ICAM : 404 - Page Not Found';        
        $this->loadViews("404", $this->global, NULL, NULL);
    }
     

    /**
     * This function is used to load the buying station list
     */
    function allocationsListing()
    {
        if($this->isAbleToAccessPurchases() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('allocations_model');        
            $searchText = $this->input->post('searchText');
            $data['searchText'] = $searchText; 
            $data['count'] = $this->allocations_model->allocationsListingCount($searchText);           
            $this->load->library('pagination');            
            $count = $this->allocations_model->allocationsListingCount($searchText); 

			$returns = $this->paginationCompress ( "allocationsListing/", $count, 25 );            
            $data['allocationRecords'] = $this->allocations_model->allocationsListing($searchText, $returns["page"], $returns["segment"]);            
            $this->global['pageTitle'] = 'ICAM : Allocation';             
            $this->loadViews("allocations", $this->global,  $data , NULL); 
        }
		
    }

    
    function addNewPurchaser()
    {
        if($this->isAbleToAccessPurchases() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('allocations_model');             
            $data['users'] = $this->allocations_model->getUsers();            
            $this->global['pageTitle'] = 'ICAM : Add New Purchaser';
            $this->loadViews("addNewPurchaser", $this->global,  $data,  NULL);     
        }
    } 
     
    function getParticularUsersData(){
         // POST data
         $postData5 = $this->input->post();      
         //load model
         $this->load->model('allocations_model');      
         // get data
         $data = $this->allocations_model->getParticularUsersData($postData5);      
         echo json_encode($data); 
    }

    function addNewCocoaPurchaser(){
        if($this->isAbleToAccessPurchases() == TRUE)
        {
            $this->loadThis();
        }
        else
        {           
                $name = $this->input->post('name'); 
                $purchasername = $this->input->post('purchasername');  
                $mobile = $this->input->post('tel');
                $official_role = $this->input->post('role');
                $email = $this->input->post('email');
                $currentUser = $this->input->post('currentUser');

                $purchaserInfo = array('name'=>$name, 'userId'=>$purchasername,'telephone' => $mobile, 'official_role' => $official_role, 'email' => $email, 'added_by' => $currentUser, 'added_on'=>date('Y-m-d H:i:s'));
                
                $this->load->model('allocations_model');
                $result = $this->allocations_model->addNewCocoaPurchaser($purchaserInfo, $purchasername);
                    if($result > 0){
                        $this->session->set_flashdata('success', 'New Cocoa Buyer added successfully');
                    }
                    else{
                        $this->session->set_flashdata('error', 'Purchaser creation failed');
                    }                
                    redirect('addNewPurchaser');
        }
    }

    function addNewSchedule()
    {
        if($this->isAbleToAccessPurchases() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('allocations_model');
            $data['buyStatn'] = $this->allocations_model->getBuyingStations();
            $data['scales'] = $this->allocations_model->getWeighingScales();   
            $data['purchasers'] = $this->allocations_model->getBuyers();            
            $this->global['pageTitle'] = 'ICAM : Add New Schedule';
            $this->loadViews("addNewSchedule", $this->global, $data, NULL);     
        }
    } 

    function getParticularPurchasersData(){
        // POST data
        $postData6 = $this->input->post();      
        //load model
        $this->load->model('allocations_model');      
        // get data
        $data = $this->allocations_model->getParticularPurchasersData($postData6);      
        echo json_encode($data); 
   }

    function addNewPurchaserSchedule(){
        if($this->isAbleToAccessPurchases() == TRUE)
        {
            $this->loadThis();
        }
        else
        { 
            $purchaserID = $this->input->post('purchaser_id'); 
            $stationID = $this->input->post('station_id');  
            $scaleID = $this->input->post('scale');
            $name = $this->input->post('name');
            $registeredBy = $this->input->post('registeredBy');
            $official_role = $this->input->post('official_role');
            $telephone = $this->input->post('telephone');

            $purchaserInfo = array('pa_id '=>$purchaserID, 'bs_id'=>$stationID, 'telephone'=>$telephone, 'official_role'=> $official_role, 'purchaser_name'=>$name, 'scale_id' => $scaleID, 'assigned_by' => $registeredBy, 'assigned_on'=>date('Y-m-d H:i:s'));
            $this->load->model('allocations_model');
            $result = $this->allocations_model->addNewPurchaserSchedule($purchaserInfo, $scaleID, $purchaserID, $stationID);
                if($result > 0){
                    $this->session->set_flashdata('success', 'Purchase Agent Assigned Successfully');
                }
                else{
                    $this->session->set_flashdata('error', 'Purchaser assignment failed');
                }                
                redirect('addNewSchedule');
          }
    }


   

}

?>