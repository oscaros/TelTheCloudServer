<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class farmers_model extends CI_Model
{
/**
     * This function is used to get the farmers listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function farmersListingCount($searchText = '')
    {
        $this->db->select('BaseTbl.farmer_id, BaseTbl.farmer_code');
        $this->db->from('farmers as BaseTbl');
        // $this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.farmer_code  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        // $this->db->where('BaseTbl.roleId !=', 1);
        $query = $this->db->get();
        
        return count($query->result());
    }

    function farmersListing($searchText = '', $page, $segment)
    {
        /* $this->db->select('farmer_id, farmer_detail.farmer_code, geolocation.parish, geolocation.village, telephone,
        first_name, surname, total_farm_size, no_of_plots');
        $this->db->from('farmer_detail');
        $this->db->join('farmers as f', 'f.farmer_code = farmer_detail.farmer_code','inner');
        $this->db->join('geolocation as g', 'g.farmer_code = f.farmer_code','inner'); */
/* 
        $this->db->select('farmers.farmer_code, farmer_id, first_name, surname, total_farm_size, first_name, no_of_plots');
        $this->db->from('farmers');//farmers (farmerId)
        $this->db->join('farmer_detail','farmer_detail.farmer_code = farmers.farmer_id','inner');		
        $this->db->join('geolocation','farmer_detail.farmer_code = geolocation.geo_id','inner');
                    // tbl_usersubscription // farmer_detail */

        $this->db->select(' farmers.farmer_id,
        farmers.farmer_code,
        farmer_detail.total_farm_size,
        farmer_detail.surname,
        farmer_detail.first_name,
        farmer_detail.telephone,
        geolocation.parish,
        geolocation.village');
        $this->db->from('farmer_detail');
        $this->db->join('farmers','farmer_detail.farmer_id = farmers.farmer_id','inner');		
        $this->db->join('geolocation','geolocation.farmer_id = farmers.farmer_id','inner');

   
        if(!empty($searchText)) {
            $likeCriteria = "(farmers.farmer_code  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        // $this->db->where('BaseTbl.roleId !=', 1);
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }  
   /*  BEGIN;
    INSERT INTO users (username, password)
      VALUES('test', 'test');
    INSERT INTO profiles (userid, bio, homepage) 
      VALUES(LAST_INSERT_ID(),'Hello world!', 'http://www.stackoverflow.com');
    COMMIT; */

     /**
     * This function is used to add new buying station to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewFarmer($stationInfo)
    {
        $this->db->trans_start();
        $this->db->insert('farmers', $stationInfo);       
        
        
        $insert_id = $this->db->insert_id();        
        $this->db->trans_complete();       
       
            if ($this->db->trans_status() === FALSE)
            {
                    $this->db->trans_rollback();
            }
            else
            {
                    $this->db->trans_commit();
                    $this-> insertOtherData($insert_id);
            }

         return $insert_id;
    }

  Function insertOtherData($insert_id){
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
    
    $this->db->trans_start();
    $this->db->insert('geolocation', array('subcounty'=>$subcounty, 'parish'=>$parish, 'village'=> $village,
    'coordinates_x'=>$xcoordinates, 'coordinates_y'=>$ycoordinates, 'mapped_by'=>$mappedby, 'added_on' => date('Y-m-d H:i:s'), 
    'added_by'=>$addedby, 'gpx_file_url'=>$gpxfile, 'farmer_id' => $insert_id));

    $this->db->insert('farmer_detail', array('first_name'=>$fname, 'surname'=>$lname, 'telephone'=> $telephone,
    'total_farm_size'=>$totalsize, 'no_of_plots'=>$numberplots, 
    'next_of_kin1'=>$nextofkin, 'next_of_kin1_phone'=>$nextofkinphone, 'farmer_id' => $insert_id)); 
      
    $this->db->trans_complete();       
   
        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
        }
        else
        {
                $this->db->trans_commit();
        }
  }

   /**
     * This function is used to get the farmers information
     * @return array $result : This is result of the query
     */
    function getFarmerInfo($farmerId)
    {
        $this->db->select('farmers.farmer_id,
        farmers.farmer_code,
        farmers.added_on,
        farmers.picture,
        farmer_detail.total_farm_size,
        farmer_detail.no_of_plots,
        farmer_detail.surname,
        farmer_detail.first_name,
        farmer_detail.telephone,
        farmer_detail.next_of_kin1,
        farmer_detail.next_of_kin1_phone,
        geolocation.coordinates_x,
        geolocation.coordinates_y,
        geolocation.subcounty,
        geolocation.parish,
        geolocation.village,
        geolocation.gpx_file_url,
        geolocation.mapped_by,
        geolocation.added_by');
        $this->db->from('farmer_detail');
        $this->db->join('farmers','farmer_detail.farmer_id = farmers.farmer_id','inner');		
        $this->db->join('geolocation','geolocation.farmer_id = farmers.farmer_id','inner');
        $this->db->where('farmers.farmer_id =', $farmerId);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }

    function getFarmerOrganicData( $farmerId ){
      
        $this->db->select('SUM(p.qty_organic) AS organic, SUM(p.qty_other) AS other, m.short_form');
        $this->db->from('purchases AS p');
        $this->db->join('months AS m','p.month_id = m.month_id','inner');
        $this->db->where('p.farmer_id =', $farmerId); 
        $this->db->where('p.added_on >','2017-12-31');
        $this->db->where('p.added_on <','NOW()');  
        $this->db->group_by('m.short_form, p.month_id');
        $this->db->order_by('m.month_id'); 
        $query = $this->db->get(); 
               
        return $query->result();
        
    }

    function getFarmerInOrganicData( $farmerId ){
        /*  $currentMonth = date("n"); */
         $this->db->select('SUM(purchases.quantity) AS other, months.short_form');
         $this->db->from('purchases');
         $this->db->join('months','purchases.month_id = months.month_id','inner');
         $this->db->group_by('months.short_form, purchases.month_id');
         $this->db->order_by('months.month_id');  
         $this->db->where('purchases.farmer_id =', $farmerId);
         $this->db->where('purchases.type =', 'other');
         $this->db->where('purchases.added_on >','2017-12-31');
         $this->db->where('purchases.added_on <','NOW()'); 
         $query = $this->db->get(); 
                
         return $query->result();
     }

     /**
     * This function is used to get the farmers subcounties information
     * @return array $result : This is result of the query
     */
    function getFarmerSubcounties()
    {
        $this->db->select('subcounty_id, subcounty_name');
        $this->db->from('subcounties');
        // $this->db->where('roleId !=', 1);
        $query = $this->db->get();        
        return $query->result();
    }

    function getBuyingStations(){
        $this->db->select('bs_id, bs_name');
        $this->db->from('buying_station');
        // $this->db->where('roleId !=', 1);
        $query = $this->db->get();        
        return $query->result();
    }

    function editFarmer($farmerInfo1, $farmerInfo2, $farmerInfo3, $farmerId){
        $this->db->where('farmer_id', $farmerId);
        $this->db->update('farmers', $farmerInfo1);

        $this->db->where('farmer_id', $farmerId);
        $this->db->update('farmer_detail', $farmerInfo3);
        
        $this->db->where('farmer_id', $farmerId);
        $this->db->update('geolocation', $farmerInfo2);
        
        return TRUE;
    }


}