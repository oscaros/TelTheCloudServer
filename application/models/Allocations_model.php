<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class allocations_model extends CI_Model
{
 /**
     * This function is used to get the purchase listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function allocationsListingCount($searchText = '')
    {
        $this->db->select('weighing_scales.scale_number,agents_assigned.assigned_by,agents_assigned.assigned_on,
        buying_station.bs_name,agents_assigned.purchaser_name, agents_assigned.official_role, agents_assigned.telephone, agents_assigned.a_id');

          $this->db->from('agents_assigned');
          $this->db->join('weighing_scales',' agents_assigned.scale_id = weighing_scales.scale_id','inner');		
          $this->db->join('buying_station','agents_assigned.bs_id = buying_station.bs_id','inner');
          $this->db->order_by('agents_assigned.assigned_on', 'ASC');

        if(!empty($searchText)) {
            $likeCriteria = "(weighing_scales.scale_number  LIKE '%".$searchText."%'
                            OR  agents_assigned.assigned_by  LIKE '%".$searchText."%'
                            OR  buying_station.bs_name  LIKE '%".$searchText."%'
                            OR  agents_assigned.purchaser_name  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        
        $query = $this->db->get();
        
        return count($query->result());
    }

    function allocationsListing($searchText = '', $page, $segment)
    {
        $this->db->select('weighing_scales.scale_number,agents_assigned.assigned_by,agents_assigned.assigned_on,
        buying_station.bs_name,agents_assigned.purchaser_name, agents_assigned.official_role, agents_assigned.telephone,agents_assigned.a_id');

          $this->db->from('agents_assigned');
          $this->db->join('weighing_scales',' agents_assigned.scale_id = weighing_scales.scale_id','inner');		
          $this->db->join('buying_station','agents_assigned.bs_id = buying_station.bs_id','inner');
          $this->db->order_by('agents_assigned.assigned_on', 'ASC');

        if(!empty($searchText)) {
            $likeCriteria = "(weighing_scales.scale_number  LIKE '%".$searchText."%'
                            OR  agents_assigned.assigned_by  LIKE '%".$searchText."%'
                            OR  buying_station.bs_name  LIKE '%".$searchText."%'
                            OR  agents_assigned.purchaser_name  LIKE '%".$searchText."%')";
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
        $this->db->order_by('bs_name');
        $query = $this->db->get();
        return $query->result();
    }

    function getWeighingScales(){
        $this->db->select('*');
        $this->db->from('weighing_scales');
        $this->db->where('is_assigned', 0);
        $this->db->order_by('scale_number');
        $query = $this->db->get();
        return $query->result();
    }

    function getUsers(){        
        $this->db->select('userId,  tbl_roles.role,
        tbl_roles.roleId,
        tbl_users.email,
        tbl_users.name,
        tbl_users.mobile,
        tbl_users.isDeleted');
        $this->db->from('tbl_users');
        $this->db->join('tbl_roles','tbl_users.roleId = tbl_roles.roleId','inner');
        $this->db->where('tbl_users.isDeleted =', 0);
        $this->db->having('tbl_roles.roleId >', 3);
        $this->db->order_by('tbl_users.name');
        $query = $this->db->get();
        return $query->result();
    }



    function getParticularUsersData($postData5){

     if($postData5['userID'] ){
        $this->db->select('tbl_users.userId, tbl_roles.role,
        tbl_roles.roleId,
        tbl_users.email,
        tbl_users.name,
        tbl_users.mobile,
        tbl_users.isDeleted');
        $this->db->join('tbl_roles','tbl_users.roleId = tbl_roles.roleId','inner');
        $this->db->where('tbl_users.isDeleted', 0);
        $this->db->where('tbl_users.userId', $postData5['userID']);
        $query = $this->db->get('tbl_users');
        $response = $query->result_array();
     }
     return $response;
    }

    function getParticularPurchasersData($postData6){
        if($postData6['purchaserID']){
            $this->db->select('purchase_agents.name, purchase_agents.official_role, purchase_agents.telephone');
            $this->db->where('purchase_agents.pa_id', $postData6['purchaserID']);
            $query = $this->db->get('purchase_agents');
            $response = $query->result_array();
         }
         return $response;
   }

    function getBuyers(){
        $this->db->select('purchase_agents.name,
        purchase_agents.pa_id,
        purchase_agents.userId,
        purchase_agents.telephone');
        $this->db->from('purchase_agents');
        $this->db->where('purchase_agents.is_assigned', 0);
        $this->db->order_by('purchase_agents.name');
        $query = $this->db->get();
        return $query->result();
    }
   
    function addNewCocoaPurchaser($purchaseInfo, $purchasername)
    {
        $this->db->trans_start();
        $this->db->insert('purchase_agents', $purchaseInfo); 

        $this->db->where('userId', $purchasername);
        $this->db->set('is_purchaser', 1, FALSE);
        $this->db->update('tbl_users');
        
        
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

    function addNewPurchaserSchedule($purchaserInfo, $scaleID, $purchaserID, $stationID)
    {
        //$this->db->trans_start();
        $this->db->insert('agents_assigned', $purchaserInfo); 

        $this->db->where('scale_id', $scaleID);
        $this->db->set('is_assigned', 1, FALSE);
        $this->db->update('weighing_scales');

        $this->db->where('pa_id', $purchaserID);
        $this->db->set('bs_id', $stationID, TRUE);
        $this->db->update('purchase_agents');

        $this->db->where('pa_id', $purchaserID);
        $this->db->set('is_assigned', 1, TRUE);
        $this->db->update('purchase_agents');
        
       /*  
        $insert_id = $this->db->insert_id();        
        $this->db->trans_complete();       
       
            if ($this->db->trans_status() === FALSE)
            {
                    $this->db->trans_rollback();
            }
            else
            {
                    $this->db->trans_commit();
            } */
         return $insert_id;
    }

     /**
     * This function is used to get the purchase information
     * @return array $result : This is result of the query
     */
    function getOtherStationInfo($purchaseId)
    {
        $this->db->select('
        purchases.purchase_id,
        purchases.qty_organic,
        purchases.qty_other,
        purchases.unit_cost,
        purchases.amount,
        purchases.type,
        buying_station.bs_id,
        buying_station.bs_name,
        farmers.farmer_id,
        farmers.farmer_code,
        purchase_agents.pa_id,
        purchase_agents.name');
        $this->db->from('purchases');
        $this->db->join('buying_station','purchases.bs_id = buying_station.bs_id','inner');
        $this->db->join('farmers','purchases.farmer_id = farmers.farmer_id','inner');
        $this->db->join('purchase_agents','purchases.pa_id = purchase_agents.pa_id','inner');
        $this->db->where('purchases.purchase_id =', $purchaseId);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }

    function getOtherPurchasers(){
        $this->db->select('*');
        $this ->db->from('purchase_agents');
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }

    function getOtherStations(){
        $this->db->select('*');
        $this ->db->from('buying_station');
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }


    function editPurchase($purchaseInfo, $purchaseId)
    {
        $this->db->where('purchase_id', $purchaseId);
        $this->db->update('purchases', $purchaseInfo);
        
        return TRUE;
    }


}