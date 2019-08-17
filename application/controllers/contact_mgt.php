<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Komuntu Oscar
 */
class Contact_mgt extends BaseController
{
    
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('contact_mgt_model');
        //$this->loadViews("manageContacts");
        $this->isLoggedIn();   
    }
    
    /**
     * This function used to load the first screen of the buying contact
     */
    public function index()
    {
        $this->global['pageTitle'] = 'Manage Contacts';
    }

  
    /**
     * This function is used to load the contact list
     */
    function contactListing()
    {
      if($this->isAbleToAccessContacts() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('contact_mgt_model');
        
            $searchText = $this->input->post('searchText');
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->contact_mgt_model->contactListingCount($searchText); 
            
			$returns = $this->paginationCompress ( "contactListing/", $count, 5 );
            
            $data['contactRecords'] = $this->contact_mgt_model->contactListing($searchText, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'contacts'; 
            
            $this->loadViews("manageContacts", $this->global, $data, NULL); 
       }
    }

  

    
/**
     * This function is used to edit the user information
     */
    function editcontact()
    {
        if($this->isAbleToAccessBuyingcontacts() == TRUE)
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
                $this->editOldBuyingcontact($contactId);
            }
            else
            {*/
                $contactId = $this->input->post('contactId');
                $bs_name = $this->input->post('bs_name');
                $bs_subcounty = $this->input->post('subcounty');
                $bs_parish = $this->input->post('bs_parish'); 
                
                               
                
                $contactInfo = array('bs_name'=>$bs_name, 'subcounty_id'=>$bs_subcounty, 'bs_parish'=> $bs_parish);
                
                $result = $this->contact_mgt_model->editcontact($contactInfo, $contactId);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Buying contact updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Buying contact update failed');
                }
                
                redirect('contactListing');
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