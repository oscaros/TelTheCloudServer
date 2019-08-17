<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class contact_mgt_model extends CI_Model
{
 /**
     * This function is used to get the contact listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function contactListingCount($searchText = '')
    {
        $this->db->select('BaseTbl.id, BaseTbl.contact_name, BaseTbl.phone_number , BaseTbl.phone_type, BaseTbl.groups, tbl_users.name');
        $this->db->from('contacts as BaseTbl');
        $this->db->join('tbl_users', 'BaseTbl.id = tbl_users.userId','inner');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.phone_number  LIKE '%".$searchText."%'
                            OR  BaseTbl.contact_name LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        // $this->db->where('BaseTbl.roleId !=', 1);
        $query = $this->db->get();
        
        return count($query->result());
    }
 

    function contactListing($searchText = '', $page, $segment)
    {
      
         $this->db->select('BaseTbl.id, BaseTbl.contact_name, BaseTbl.phone_number , BaseTbl.phone_type, BaseTbl.groups, tbl_users.name');
        $this->db->from('contacts as BaseTbl');
        $this->db->join('tbl_users', 'BaseTbl.id = tbl_users.userId','inner');
        //$this->db->join('subcounties', 'BaseTbl.subcounty_id = subcounties.subcounty_id','inner');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.phone_number  LIKE '%".$searchText."%'
                            OR  BaseTbl.contact_name  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        // $this->db->where('BaseTbl.roleId !=', 1);
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;;
    }  



    
    /**
     * This function is used to delete the buying contact information
     * @param number $contactId : This is buying contact id
     * @return boolean $result : TRUE / FALSE
     */
    function deletecontact($contactId, $contactInfo)
    {
        $this->db->where('bs_id', $contactId);
        $this->db->update('buying_contact', $contactInfo);
        
        return $this->db->affected_rows();
    }

}
