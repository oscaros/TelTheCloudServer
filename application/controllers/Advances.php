<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (purchasesController)
 * User Class to control all user related operations.
 * @author : Komuntu Oscar
 */
class Advances extends BaseController
{
       /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('advances_model');
        $this->isLoggedIn();   
    }
     /**
     * This function used to load the first screen of the buying station
     */
    public function index()
    {
        $this->global['pageTitle'] = 'ICAM : Farmer Advances';
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
    function advanceListing()
    {
        if($this->isAbleToAccessAdvances() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('advances_model');        
            $searchText = $this->input->post('searchText');
            $data['searchText'] = $searchText; 
            $data['count'] = $this->advances_model->advanceListingCount($searchText);           
            $this->load->library('pagination');            
            $count = $this->advances_model->advanceListingCount($searchText); 

			$returns = $this->paginationCompress ( "advanceListing/", $count, 25 );            
            $data['advancesRecords'] = $this->advances_model->advanceListing($searchText, $returns["page"], $returns["segment"]);            
            $this->global['pageTitle'] = 'ICAM : advances';             
            $this->loadViews("advances", $this->global,  $data , NULL); //$data,
        }
		
	}
    
    /**
     * This function is used to load the add new purchase form
     */
    function addNewAdvance()
    {
        if($this->isAbleToAccessAdvances() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('advances_model');
            $data['buyStatn'] = $this->advances_model->getBuyingStations();  
           // $data['buyer'] = $this->advances_model->getBuyers();            
            $this->global['pageTitle'] = 'ICAM : Add New Advance';
            $this->loadViews("addNewAdvance", $this->global,  $data,  NULL);     
        }
    }   
    
    function addNewCocoaAdvance()
    {
        if($this->isAbleToAccessAdvances() == TRUE)
        {
            $this->loadThis();
        }
        else
        {           
                $farmerID = $this->input->post('farmerID');  
                $amount = $this->input->post('amount');
                $date = $this->input->post('date');
                $currentamount = $this->input->post('amount');
                $advancedby = $this->input->post('advancer');


                    $advanceInfo = array('farmer_id'=>$farmerID, 'amount'=>$amount, 
                    'date_advanced'=>$date, 'date_added'=>date('Y-m-d H:i:s'), 'current_advance_amount'=>$currentamount, 
                    'advanced_by'=>$advancedby);
                
                    $this->load->model('advances_model');
                    $result = $this->advances_model->addNewAdvance($advanceInfo);
                
                    if($result > 0){
                        $this->session->set_flashdata('success', 'New Advance added successfully');
                    }
                    else{
                        $this->session->set_flashdata('error', 'Advance creation failedx');
                    }                
                    redirect('addNewAdvance');
                }
            
         }
    

    /* this function is used to get farmers code according to thier respective buying stations*/
    public function farmerCodes(){
        // POST data
        $postData = $this->input->post();      
        //load model
        $this->load->model('advances_model');      
        // get data
        $data = $this->advances_model->getFarmerCodes($postData);      
        echo json_encode($data);
    }

    function viewSelectAdvance( $advanceId = NULL ){
        if($this->isAbleToAccessAdvances() == TRUE )
         {
             $this->loadThis();
         }
         else
         { 
           if($advanceId == null)
             {
                 redirect('advanceListing');
             }                
             $data['advanceInfo'] = $this->advances_model->getAdvanceInfo($advanceId); 
             $data['purchaseData'] = $this->advances_model->getPurchasesFromAdvancesData($advanceId);
             $this->global['pageTitle'] = 'ICAM : Advance Profile';                
             $this->loadViews("viewSelectedAdvance",  $this->global, $data, NULL );
         }
     }





}

?>