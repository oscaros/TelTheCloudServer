<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Komuntu Oscar
 */
class Farmers extends BaseController
{
    
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('farmers_model');
        $this->isLoggedIn();   
    }
    
    /**
     * This function used to load the first screen of the buying station
     */
    public function index()
    {
        $this->global['pageTitle'] = 'ICAM : Farmers';
        //$this->global['pageTitle'] = 'ICAM : Buying Stations';
        //$this->stationListing();
    }

  /**
     * This function is used to load the buying station list
     */
    function farmersListing()
    {
        if($this->isAbleToAccessFarmersAndInspections() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
             $this->load->model('farmers_model');
        
            $searchText = $this->input->post('searchText');
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->farmers_model->farmersListingCount($searchText); //

			$returns = $this->paginationCompress ( "farmersListing/", $count, 10 );
            
            $data['farmersRecords'] = $this->farmers_model->farmersListing($searchText, $returns["page"],  $returns["segment"]);
            
            $this->global['pageTitle'] = 'ICAM : Farmers'; 
            
            $this->loadViews("farmers", $this->global, $data, NULL); //$data,
        }
    }


   /**
     * This function is used to load the add new station form
     */
    function addNewFarmer()
    {
        if($this->isAbleToAccessFarmersAndInspections() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('farmers_model');
            $data['subcounties'] = $this->farmers_model-> getFarmerSubcounties();  
            $data['stations'] = $this->farmers_model->getBuyingStations();
            
            $this->global['pageTitle'] = 'ICAM : Add New Farmer';

            $this->loadViews("addNewFarmer", $this->global, $data, NULL);      // 
        }
    }

     /**
     * This function is used to add new user to the system
     */
    function addNewIcamFarmer()
    {
        if($this->isAbleToAccessFarmersAndInspections() == TRUE)
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
                $farmerCode = $this->input->post('farmerCode');
                $bs_station = $this->input->post('buyingstn');

                $subcounty = $this->input->post('subcounty');
                $parish = $this->input->post('parish');
                $village = $this->input->post('village');
                $xcoordinates = $this->input->post('xcoordinates');
                $ycoordinates = $this->input->post('ycoordinates');
                $mappedby = $this->input->post('mappedby');
                $addedby = $this->input->post('addedby');
                $gpxfile = $this->input->post('gpxfile');

                $fname = $this->input->post('fname');
                $lname = $this->input->post('lname');
                $telephone = $this->input->post('telephone');
                $totalsize = $this->input->post('totalsize');
                $numberplots = $this->input->post('numberplots');
                $nextofkin = $this->input->post('nextofkin');
                $nextofkinphone = $this->input->post('nextofkinphone');
                $excess_delivery_target = $this->input->post('target');

                
                $stationInfo = array('farmer_code'=>$farmerCode, 'bs_id' => $bs_station, 'excess_delivery_target' => $excess_delivery_target,'excess_delivery_balance' => $excess_delivery_target, 'added_on'=>date('Y-m-d H:i:s'));

                $this-> upload_file();      
                $this->load->model('farmers_model');
                $result = $this->farmers_model->addNewFarmer($stationInfo);
                
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New Farmer added successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Farmer creation failed');
                }
                
                redirect('addNewFarmer');
           // }
        }
    }

    public function upload_file()
        {
            if($this->input->post('submit')){
            
                //Check whether user upload picture
                if(!empty($_FILES['gpxfile'])){
                    $config['upload_path'] = './uploads/gpxfiles/';
                    // $config['allowed_types'] = 'png|PNG|JPG|jpg|jpeg|gif';
                    $config['allowed_types'] = '*';
                    // $config['file_name'] = $_FILES['gpxfile'];
                    $config['max_size']             = 1024;
                    
                    //Load upload library and initialize configuration
                    $this->load->library('upload',$config);
                    $this->upload->initialize($config);
                    
                    if($this->upload->do_upload('gpxfile')){
                        $gg=var_dump($this->upload->data());
                        $uploadData = $this->upload->data();
                        $gpxfile = $uploadData['file_name'];
                        $this->session->set_flashdata('success', 'User data have been added successfully.');
                    }else{
                        $gpxfile = '';
                        $this->session->set_flashdata('error', $this->upload->display_errors());                        
                    }
                }else{
                    $gpxfile = '';
                    $this->session->set_flashdata('error', $this->upload->display_errors());                    
                }        
           
        }       
      
       }

       function viewAfarmer( $farmerId = NULL ){
             if($this->isAbleToAccessFarmersAndInspections() == TRUE )
              {
                  $this->loadThis();
              }
              else
              { 
                if($farmerId == null)
                  {
                      redirect('farmersListing');
                  }                
                  // load data about existing stations
                  $data['farmerInfo'] = $this->farmers_model->getFarmerInfo($farmerId); 
                  $data['organicData'] = $this->farmers_model->getFarmerOrganicData($farmerId);
                  //$data['inorganicData'] = $this->farmers_model->getFarmerInOrganicData($farmerId);
                  // Load some subounties
                 // $data['subcounties'] = $this->farmers_model->getStationSubcounties();  
                  $this->global['pageTitle'] = 'ICAM : Farmer Profile';                
                  $this->loadViews("viewSelectedFarmer",  $this->global, $data, NULL );
              }
          }

         
      /**
     * This function is used load bstation edit information
     * @param number $stationId : Optional : This is user id
     */
    function editOldfarmers($farmerId = NULL)
    {
        if($this->isAbleToAccessFarmersAndInspections() == TRUE /* || $farmerId == 1 */)
        {
            $this->loadThis();
        }
        else
        {
            if($farmerId == null)
            {
                redirect('farmerListing');
            }
            
            // load data about existing stations
            $data['farmerInfo'] = $this->farmers_model->getFarmerInfo($farmerId);
            // Load some subounties
            $data['subcounties'] = $this->farmers_model->getFarmerSubcounties(); 
            $this->global['pageTitle'] = 'ICAM : Edit Existing Farmer';
            
            $this->loadViews("editOldfarmers", $this->global, $data, NULL);
        }
    }
    
/**
     * This function is used to edit the user information
     */
    function editFarmer()
    {
        if($this->isAbleToAccessFarmersAndInspections() == TRUE)
        {
            $this->loadThis();
        }
        else
        {         
            $farmerCode = $this->input->post('farmerCode');
            $farmerId = $this->input->post('farmerId');
            $subcounty = $this->input->post('subcounty');
            $parish = $this->input->post('parish');
            $village = $this->input->post('village');
            $xcoordinates = $this->input->post('xcoordinates');
            $ycoordinates = $this->input->post('ycoordinates');
            $mappedby = $this->input->post('mappedby');
            $addedby = $this->input->post('addedby');
            $gpxfile = $this->input->post('gpxfile');

            $fname = $this->input->post('fname');
            $lname = $this->input->post('lname');
            $telephone = $this->input->post('telephone');
            $totalsize = $this->input->post('totalsize');
            $numberplots = $this->input->post('numberplots');
            $nextofkin = $this->input->post('nextofkin');
            $nextofkinphone = $this->input->post('nextofkinphone');                          
                
                $farmerInfo1 = array(
                'farmer_code'=>$farmerCode);      
                $farmerInfo2 = array(
                'subcounty'=>$subcounty, 
                'parish'=> $parish,
                'village'=>$village, 
                'coordinates_x'=>$xcoordinates, 
                'coordinates_y'=> $ycoordinates,
                'mapped_by'=>$mappedby, 
                'added_by'=>$addedby, 
                'gpx_file_url'=> $gpxfile); 
                $farmerInfo3 = array(
                'first_name'=>$fname, 
                'surname'=> $lname,
                'telephone'=>$telephone, 
                'total_farm_size'=>$totalsize, 
                'no_of_plots'=> $numberplots,
                'next_of_kin1'=>$nextofkin, 
                'next_of_kin1_phone'=> $nextofkinphone);             
                $result = $this->farmers_model->editFarmer($farmerInfo1, $farmerInfo2, $farmerInfo3, $farmerId);                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Farmer record updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Farmer update failed');
                }
                
                redirect('farmerListing');
           // }
        }
    }
        
 }

?>