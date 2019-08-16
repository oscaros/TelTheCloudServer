<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class advances_model extends CI_Model
{
 /**
     * This function is used to get the purchase listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function advanceListingCount($searchText = '')
    {
        $this->db->select(' farmers.farmer_code, farmer_detail.surname,farmer_detail.first_name,
        advances.advance_id,advances.amount,advances.date_added,advances.date_advanced, advances.current_advance_amount,
        advances.advanced_by');

          $this->db->from('advances');
          $this->db->join('farmers','advances.farmer_id = farmers.farmer_id','inner');		
          $this->db->join('farmer_detail','farmer_detail.farmer_id = farmers.farmer_id','inner');

        if(!empty($searchText)) {
            $likeCriteria = "(farmers.farmer_code  LIKE '%".$searchText."%'
                            OR  farmer_detail.surname  LIKE '%".$searchText."%'
                            OR  farmer_detail.first_name  LIKE '%".$searchText."%'
                            OR  advances.date_advanced  LIKE '%".$searchText."%'
                            OR  advances.advanced_by  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        
        $query = $this->db->get();
        
        return count($query->result());
    }

    function advanceListing($searchText = '', $page, $segment)
    {
        $this->db->select(' farmers.farmer_code, farmer_detail.surname,farmer_detail.first_name,
        advances.advance_id,advances.amount,advances.date_added,advances.date_advanced, advances.current_advance_amount,
        advances.advanced_by');

          $this->db->from('advances');
          $this->db->join('farmers','advances.farmer_id = farmers.farmer_id','inner');		
          $this->db->join('farmer_detail','farmer_detail.farmer_id = farmers.farmer_id','inner');

        if(!empty($searchText)) {
            $likeCriteria = "(farmers.farmer_code  LIKE '%".$searchText."%'
                            OR  farmer_detail.surname  LIKE '%".$searchText."%'
                            OR  farmer_detail.first_name  LIKE '%".$searchText."%'
                            OR  advances.date_advanced  LIKE '%".$searchText."%'
                            OR  advances.advanced_by  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }

        // $this->db->where('BaseTbl.roleId !=', 1);
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    } 

     //this retrives all buying stations
     function getBuyingStations(){        
        $this->db->select('bs_id, bs_name, bs_parish, bs_createdby');
        $this->db->from('buying_station');
        $query = $this->db->get();
        return $query->result();
    }

      /* this function is used to get farmers code according to thier respective buying stations*/
      function getFarmerCodes($postData){
 
        $response = array();
       
        if($postData['buyingStationID'] ){
       
         // Select record
         $this->db->select(' farmers.farmer_code,farmer_detail.surname,farmer_detail.first_name,
         farmers.farmer_id');
         //$this->db->from('farmers');
         $this->db->join('farmer_detail','farmer_detail.farmer_id = farmers.farmer_id','inner');
         $this->db->join('buying_station','farmers.bs_id = buying_station.bs_id','inner');
         $this->db->where('buying_station.bs_id', $postData['buyingStationID']);
         $q = $this->db->get('farmers');
         $response = $q->result_array();
       
        }
        return $response;
    }

    function addNewAdvance($advanceInfo)
    {
        $this->db->trans_start();
        $this->db->insert('advances', $advanceInfo);       
        
        
        $insert_id = $this->db->insert_id();        
        $this->db->trans_complete();       
       
            if ($this->db->trans_status() === FALSE)
            {
                    $this->db->trans_rollback();
            }
            else
            {
                    $this->db->trans_commit();
            }
         return $insert_id;
    }

     /**
     * This function is used to get the advanceinformation
     * @return array $result : This is result of the query
     */
    function getAdvanceInfo($advanceId)
    {
        $this->db->select('farmers.farmer_code,
        farmers.picture,
        farmer_detail.total_farm_size,
        farmer_detail.telephone,
        farmer_detail.next_of_kin1,
        farmer_detail.next_of_kin1_phone,
        farmer_detail.no_of_plots,
        farmer_detail.surname,
        farmer_detail.first_name,
        geolocation.coordinates_x,
        geolocation.coordinates_y,
        geolocation.subcounty,
        geolocation.parish,
        geolocation.village,
        advances.advance_id,
        advances.amount,
        advances.date_added,
        advances.date_advanced,
        advances.current_advance_amount,
        advances.advanced_by');
        $this->db->from('advances');
        $this->db->join('farmers','advances.farmer_id = farmers.farmer_id','inner');		
        $this->db->join('farmer_detail','farmer_detail.farmer_id = farmers.farmer_id','inner');
        $this->db->join('geolocation','geolocation.farmer_id = farmers.farmer_id','inner');
        $this->db->where('advances.advance_id =', $advanceId);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }

    function getPurchasesFromAdvancesData( $advanceId ){
      
        $this->db->select('SUM(p.qty_organic) AS organic, SUM(p.qty_other) AS other, m.short_form');
        $this->db->from('purchases AS p');
        $this->db->join('months AS m','p.month_id = m.month_id','inner');
        $this->db->where('p.farmer_id =', $advanceId); 
        $this->db->where('p.added_on >','2017-12-31');
        $this->db->where('p.added_on <','NOW()');  
        $this->db->group_by('m.short_form, p.month_id');
        $this->db->order_by('m.month_id'); 
        $query = $this->db->get(); 
               
        return $query->result();
        
    }

 
}