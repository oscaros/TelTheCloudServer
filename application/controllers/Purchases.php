<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (purchasesController)
 * User Class to control all user related operations.
 * @author : Komuntu Oscar
 */
class Purchases extends BaseController
{
       /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('purchases_model');
        $this->isLoggedIn();   
    }
     /**
     * This function used to load the first screen of the buying station
     */
    public function index()
    {
        $this->global['pageTitle'] = 'ICAM : Purchases';
        //$this->global['pageTitle'] = 'ICAM : Buying Stations';
     }

    function pageNotFound()
    {
        $this->global['pageTitle'] = 'ICAM : 404 - Page Not Found';        
        $this->loadViews("404", $this->global, NULL, NULL);
    }

    /* this function is used to get farmers code according to thier respective buying stations*/
    public function farmerCodes(){
        // POST data
        $postData = $this->input->post();      
        //load model
        $this->load->model('purchases_model');      
        // get data
        $data = $this->purchases_model->getFarmerCodes($postData);      
        echo json_encode($data);
       }

       /* this function is used to get subcounty for a respective buying station*/
    public function getSubcounty(){
        // POST data
        $postData2 = $this->input->post();      
        //load model
        $this->load->model('purchases_model');      
        // get data
        $data = $this->purchases_model->getSubcounty($postData2);      
        echo json_encode($data);
       }

    public function getAdvanceID(){
        // POST data
       $postData3 = $this->input->post();      
       //load model
       $this->load->model('purchases_model');      
       // get data
       $data = $this->purchases_model->getAdvanceID($postData3);      
       echo json_encode($data);
    }

	 /*public function getPurchaserID(){
        // POST data
		$purchaser = $this->input->post('buyer');
       //$postData3 = $this->input->post();      
       //load model
       $this->load->model('purchases_model');      
       // get data
       $data = $this->purchases_model->getPurchaserID($purchaser);      
       echo json_encode($data);
    }*/
	
   public function getSupplyTarget(){
        // POST data
        $postData4 = $this->input->post();      
        //load model
        $this->load->model('purchases_model');      
        // get data
        $data = $this->purchases_model->getSupplyTarget($postData4);      
        echo json_encode($data);
    }   
      

    /**
     * This function is used to load the buying station list
     */
    function purchaseListing()
    {
        if($this->isAbleToAccessPurchases() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('purchases_model');        
            $searchText = $this->input->post('searchText');
            $name= $this->name;

            $data['searchText'] = $searchText; 
            $data['count'] = $this->purchases_model->purchaseListingCount($searchText, $name);           
            $this->load->library('pagination');            
            $count = $this->purchases_model->purchaseListingCount($searchText, $name); 

			$returns = $this->paginationCompress ( "purchaseListing/", $count, 500 );            
            $data['purchaseRecords'] = $this->purchases_model->purchaseListing($searchText, $returns["page"], $returns["segment"], $name);            
            
           
            $this->global['pageTitle'] = 'ICAM : Purchases';             
            $this->loadViews("purchases", $this->global,  $data , NULL); //$data,
        }
		
	}

    /**
     * This function is used to load the add new purchase form
     */
    function addNewPurchase()
    {
        if($this->isAbleToAccessPurchases() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('purchases_model');
            $data['buyStatn'] = $this->purchases_model->getBuyingStations();  
            $data['buyer'] = $this->purchases_model->getBuyers();   
            
            $name1= $this->name;
            $data['getCurrentBuyingStation'] = $this->purchases_model->getCurrentBuyingStation($name1);
   
            $this->global['pageTitle'] = 'ICAM : Add New Purchase';
            $this->loadViews("addNewPurchase", $this->global, $data, NULL);     
        }
    }   
    
    function addNewCocoaPurchase()
    {
        if($this->isAbleToAccessPurchases() == TRUE)
        {
            $this->loadThis();
        }
        else
        {           
                $qty = $this->input->post('Quantity');  
                $unitCost = $this->input->post('unitCost');
                $unitcost = str_replace(',', '', $unitCost);
                $amount1 = $this->input->post('amount');
                $amount = str_replace(',', '', $amount1);
                $buyingstation = $this->input->post('buyingStation');
                $farmerCode = $this->input->post('farmerCode');
                $moisture = $this->input->post('moisture');
                $type = $this->input->post('type');
                $purchaser = $this->input->post('buyer');
                $month = $this->input->post('month');
                $unit = "Kg";
                $subcountyID = $this->input->post('subcounty');
                $isadvance = $this->input->post('isadvance');
                $advanceID = $this->input->post('advanceID');
                $currentAdvAmount= $this->input->post('currentAdvanceAmount');
                $currentAdvanceAmount = str_replace(',', '', $currentAdvAmount);   
                $newExcess = $this->input-> post('new_excess');   
                $tag = $this->input-> post('tags'); 
                $tags = strtoupper($tag); 
                $nameIfNotregistered = $this->input->post('famerNameIfNotRegistered');

                $date = date_parse($month);
                $monthid = $date['month'];

                if($type == "organic"){
                    $purchaseInfo = array('farmer_id'=>$farmerCode, 'qty_organic'=>$qty, 'unit_cost'=>$unitcost, 'amount'=>$amount, 'bs_id'=>$buyingstation, 'moisture'=>$moisture, 
                    'type'=>$type, 'pa_id'=>$purchaser, 'month'=>$month, 'unit' => $unit, 'month_id' => $monthid, 'subcounty_id' => $subcountyID, 'advance_id'=> $advanceID, 'isForAdvance'=> $isadvance, 'tags'=>$tags, 'amount_not_paid'=>$amount, 'added_on'=>date('Y-m-d H:i:s'));
                    

                    $updateAdvance = ($currentAdvanceAmount - $amount);
                    $updateExcessDelivery = $newExcess;
                
                    if($isadvance == 1){
                        $this->load->model('purchases_model');
                        $result = $this->purchases_model->addNewPurchaseWithUpdates($purchaseInfo, $updateAdvance, $advanceID, $updateExcessDelivery, $farmerCode);
                            if($result > 0){
                                $this->session->set_flashdata('success', 'New Purchase added successfully');
                            }
                            else{
                                $this->session->set_flashdata('error', 'Purchase creation failed');
                            }                
                            redirect('addNewPurchase');
                    }else{
                        $this->load->model('purchases_model');
                        $result = $this->purchases_model->addNewPurchase($purchaseInfo, $farmerCode, $updateExcessDelivery);
                            if($result > 0){
                                $this->session->set_flashdata('success', 'New Purchase added successfully');
                            }
                            else{
                                $this->session->set_flashdata('error', 'Purchase creation failed');
                            }                
                            redirect('addNewPurchase');
                    }
                      
                } else{
                    $purchaseInfo = array('farmer_id'=>$farmerCode, 'qty_other'=>$qty, 'unit_cost'=>$unitcost, 'amount'=>$amount, 'bs_id'=>$buyingstation, 'moisture'=>$moisture, 'farmer_name_if_not_registered'=>$nameIfNotregistered,
                    'type'=>$type, 'pa_id'=>$purchaser, 'month'=>$month, 'unit' => $unit, 'month_id' => $monthid, 'subcounty_id' => $subcountyID, 'advance_id'=> $advanceID, 'isForAdvance'=> $isadvance, 'tags'=>$tags, 'amount_not_paid'=>$amount, 'added_on'=>date('Y-m-d H:i:s'));
                    
                    $updateAdvance = ($currentAdvanceAmount - $amount);
                    $updateExcessDelivery = $newExcess;
                    
                    if($isadvance == 1){
                        $this->load->model('purchases_model');
                        $result = $this->purchases_model->addNewPurchaseWithUpdates($purchaseInfo, $updateAdvance, $advanceID, $updateExcessDelivery, $farmerCode);
                          if($result > 0){
                                $this->session->set_flashdata('success', 'New Purchase added successfully');
                            }
                            else{
                                $this->session->set_flashdata('error', 'Purchase creation failed');
                            }                
                            redirect('addNewPurchase');
                    }else{
                        $this->load->model('purchases_model');
                        $result = $this->purchases_model->addNewPurchase($purchaseInfo, $farmerCode, $updateExcessDelivery);
                           if($result > 0){
                                $this->session->set_flashdata('success', 'New Purchase added successfully');
                            }
                            else{
                                $this->session->set_flashdata('error', 'Purchase creation failed');
                            }                
                            redirect('addNewPurchase');
                    }
                }
         
        }
    }

    function payFarmer(){
         $this->load->model('purchases_model');        
            $searchText = $this->input->post('searchText');
            $name= $this->name;

            $data['searchText'] = $searchText; 
            $data['count'] = $this->purchases_model->purchaseListingCount($searchText, $name);           
            $this->load->library('pagination');            
            $count = $this->purchases_model->purchaseListingCount($searchText, $name); 

			$returns = $this->paginationCompress ( "purchaseListing/", $count, 500 );            
            $data['purchaseRecords'] = $this->purchases_model->purchaseListing($searchText, $returns["page"], $returns["segment"], $name);            
            $this->global['pageTitle'] = 'ICAM : Pay Farmers';
                
            $this->loadViews("pay", $this->global, $data, NULL);
    }

    function payIcamFarmer(){
        if($this->isAbleToAccessPurchases() == TRUE)
        {
            $this->loadThis();
        }
        else
        {         
            $purchaseId = $this->input->post('purchaseID');
            $amountToBePaid = $this->input->post('amountToBePaid');
            $amount_not_paid = $this->input->post('amount_not_paid');
            $newAmount = ($amount_not_paid - $amountToBePaid);   
            $payCurrentStatus = $this->input->post('payCurrentStatus'); 
            $payNewStatus1 = "paid";
            $payNewStatus2 = "partial";

            if($payCurrentStatus != "paid" and $newAmount == 0){
                //update pay amount, pay balance and status to fully paid
              
                $payNewStatus = $payNewStatus1;  
                $result = $this->purchases_model->payIcamFarmer($purchaseId, $payNewStatus, $newAmount);                
               if($result == true)
               {
                   $this->session->set_flashdata('success', 'Payment to farmer updated successfully');
               }
               else
               {
                   $this->session->set_flashdata('error', 'Payment update failed');
               }
                redirect('purchaseListing');
            } else if($payCurrentStatus != "paid" and $newAmount > 0){
                //update pay amount, pay balance and status to fully paid
                $payNewStatus = $payNewStatus2;  
                $result = $this->purchases_model->payIcamFarmer($purchaseId, $payNewStatus, $newAmount);                
                          
               if($result == true)
               {
                   $this->session->set_flashdata('success', 'Payment to farmer updated successfully');
               }
               else
               {
                   $this->session->set_flashdata('error', 'Payment update failed');
               }
               redirect('purchaseListing');
            }                    
                
                
           
        }
    }

    function editOldPurchase($purchaseId = NULL)
    {
        if($this->isAbleToAccessPurchases() == TRUE /* || $farmerId == 1 */)
        {
            $this->loadThis();
        }
        else
        {
            if($purchaseId == null)
            {
                redirect('purchaseListing');
            }
            
            // load data about existing stations
            $data['purchaseInfo'] = $this->purchases_model->getPurchasesInfo($purchaseId);
            // Load some additional data regarding the purchase
            $data['otherinfo'] = $this->purchases_model->getOtherStationInfo($purchaseId);
            //load all purchasors
            $data['purchasors'] = $this->purchases_model->getOtherPurchasers();
            //load other buying stations
            $data['buyingstn'] = $this->purchases_model->getOtherStations();
            //load other farmer codes 
            $data['farmerCodes'] = $this->purchases_model->getOtherFarmerCodes();
            $this->global['pageTitle'] = 'ICAM : Edit Existing Purchase';
            
            $this->loadViews("editOldPurchase", $this->global,  $data,  NULL);
        }
    }

    function editPurchase()
    {
        if($this->isAbleToAccessPurchases() == TRUE)
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
                $purchaseId = $this->input->post('purchaseId');
                $quantity = $this->input->post('qty');
                $unitcost = $this->input->post('unitcost');
                $amount = $this->input->post('amount');
                $buyingstation = $this->input->post('buyingStation'); //this instead fetches the ID
                $farmerCode = $this->input->post('farmercode'); //this instead fetches the ID
                $moistureLevel = $this->input->post('moisture');
                $type = $this->input->post('type'); 
                $purchaser = $this->input->post('buyer');

                
                if($type == "organic"){
                    $purchaseInfo = array('qty_organic'=>$quantity, 'unit_cost'=>$unitcost, 'amount'=> $amount, 'bs_id'=> $buyingstation, 'farmer_id'=> $farmerCode, 'moisture'=> $moistureLevel, 'type'=> $type, 'pa_id'=> $purchaser);                
                    $result = $this->purchases_model->editPurchase($purchaseInfo, $purchaseId);                
                    if($result == true){
                        $this->session->set_flashdata('success', 'Purchase updated successfully');
                    }else{
                        $this->session->set_flashdata('error', 'Purchase record update failed');
                    }                
                    redirect('purchaseListing');
                }else{
                    $purchaseInfo = array('qty_other'=>$quantity, 'unit_cost'=>$unitcost, 'amount'=> $amount, 'bs_id'=> $buyingstation, 'farmer_id'=> $farmerCode, 'moisture'=> $moistureLevel, 'type'=> $type, 'pa_id'=> $purchaser);                
                    $result = $this->purchases_model->editPurchase($purchaseInfo, $purchaseId);                
                    if($result == true){
                        $this->session->set_flashdata('success', 'Purchase updated successfully');
                    }else{
                        $this->session->set_flashdata('error', 'Purchase record update failed');
                    }                
                    redirect('purchaseListing');
                }
                
           // }
        }
    }

   

}

?>