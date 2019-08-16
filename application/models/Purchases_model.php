<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class purchases_model extends CI_Model
{
 /**
     * This function is used to get the purchase listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function purchaseListingCount($searchText = '', $name)
    {
        $this->db->select('purchases.purchase_id,purchases.pa_id,purchases.payStatus,purchases.amount_not_paid,purchases.unit_cost,purchases.type,purchases.qty_organic,purchases.qty_other,purchases.amount,
        farmer_detail.surname,farmer_detail.first_name,farmers.farmer_id,purchases.farmer_id,purchases.added_on,
        purchase_agents.name AS purchaser_name,buying_station.bs_name,months.short_form,
        farmers.farmer_code');

          $this->db->from('purchases');
          $this->db->join('purchase_agents','purchases.pa_id = purchase_agents.pa_id','inner');		
          $this->db->join('months','purchases.month_id = months.month_id','inner');
          $this->db->join('farmers','purchases.farmer_id = farmers.farmer_id','inner');		
          $this->db->join('farmer_detail','farmer_detail.farmer_id = farmers.farmer_id','inner');
          $this->db->join('buying_station','purchases.bs_id = buying_station.bs_id','inner');
          $this->db->join('tbl_users','purchase_agents.userId = tbl_users.userId','inner');
          //$this->db->where('purchases.added_on BETWEEN DATE_SUB(NOW(), INTERVAL 15 HOUR) AND NOW()');
          //
		  $this->db->where('tbl_users.is_purchaser', 1);
          $this->db->where('tbl_users.name', $name);

        if(!empty($searchText)) {
            $likeCriteria = "(purchase_id  LIKE '%".$searchText."%'
                            OR  unit_cost  LIKE '%".$searchText."%'
                            OR  farmers.farmer_code  LIKE '%".$searchText."%'
                            OR  surname  LIKE '%".$searchText."%'
                            OR  first_name  LIKE '%".$searchText."%'
                            OR  bs_name  LIKE '%".$searchText."%'
                            OR  purchase_agents.name  LIKE '%".$searchText."%'
                            OR  purchases.type  LIKE '%".$searchText."%'
                            OR  purchases.payStatus  LIKE '%".$searchText."%'
                            OR  purchases.added_on  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        
        $query = $this->db->get();
        
        return count($query->result());
		
    }

    function purchaseListing($searchText = '', $page, $segment, $name)
    {
       $this->db->select('purchases.purchase_id,
	                      purchases.pa_id,purchases.payStatus,
						  purchases.amount_not_paid,
						  purchases.unit_cost,
						  purchases.type,
						  purchases.qty_organic,
						  purchases.qty_other,
						  purchases.amount,
						  farmer_detail.surname,
						  farmer_detail.first_name,
						  farmers.farmer_code,
						  buying_station.bs_name,
						  purchases.purchased_by,
						  purchases.added_on
						  ');
						  
						  /*
						  farmer_detail.surname,
						  farmer_detail.first_name,
						  farmers.farmer_id,
						  purchases.farmer_id,
						  purchases.added_on,
						  purchase_agents.name AS purchaser_name,
						  buying_station.bs_name,
						  months.short_form,
						  */
		
		 //$this->db->select('purchases.purchase_id,purchases.pa_id,purchases.payStatus,purchases.amount_not_paid,purchases.unit_cost,purchases.type,purchases.qty_organic,purchases.qty_other,purchases.amount');

          $this->db->from('purchases');
          //$this->db->join('purchase_agents','purchases.pa_id = purchase_agents.pa_id','inner');		
          //$this->db->join('months','purchases.month_id = months.month_id','inner');
          $this->db->join('farmers','purchases.farmer_id = farmers.farmer_id','inner');		
          $this->db->join('farmer_detail','farmer_detail.farmer_id = farmers.farmer_id','inner');
          $this->db->join('buying_station','purchases.bs_id = buying_station.bs_id','inner');
          //$this->db->join('tbl_users','purchase_agents.userId = tbl_users.userId','inner');
          //$this->db->where('purchases.added_on BETWEEN DATE_SUB(NOW(), INTERVAL 1 DAY) AND NOW()');
          //$this->db->where('purchases.added_on BETWEEN DATE_SUB(NOW(), INTERVAL 15 HOUR) AND NOW()');
         
          //$this->db->where('tbl_users.is_purchaser', 1);
          //$this->db->where('tbl_users.name', $name);

        if(!empty($searchText)) {
            $likeCriteria = "(purchase_id  LIKE '%".$searchText."%'
                            OR  unit_cost  LIKE '%".$searchText."%'
                            OR  farmers.farmer_code  LIKE '%".$searchText."%'
                            OR  surname  LIKE '%".$searchText."%'
                            OR  first_name  LIKE '%".$searchText."%'
                            OR  bs_name  LIKE '%".$searchText."%'
                            OR  purchase_agents.name  LIKE '%".$searchText."%'
                            OR  purchases.type  LIKE '%".$searchText."%'
                            OR  purchases.payStatus  LIKE '%".$searchText."%'
                            OR  purchases.added_on  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }

        // $this->db->where('BaseTbl.roleId !=', 1);
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();
		
//ob_start();
   //var_dump($result);
   //$result = ob_get_contents(); //or ob_get_clean()
   
   
   //echo '<pre>', print_r($result), '</pre>';
   
   
        
        return $result;
    } 

    //this retrives all buying stations
    function getBuyingStations(){        
        $this->db->select('bs_id, bs_name, bs_parish, bs_createdby');
        $this->db->from('buying_station');
        $query = $this->db->get();
        return $query->result();
    }

    function getBuyers(){        
        $this->db->select('pa_id, name');
        $this->db->from('purchase_agents');
        $query = $this->db->get();
        return $query->result();
    }

     /* this function is used to get farmers code according to thier respective buying stations*/
     function getFarmerCodes($postData){
 
        $response = array();
       
        if($postData['buyingStationID'] ){
       
         // Select record
         $this->db->select('farmers.farmer_id, farmers.farmer_code, farmer_detail.surname,
         farmer_detail.first_name');
         //$this->db->from('farmers');
         $this->db->join('buying_station','farmers.bs_id = buying_station.bs_id','inner');
         $this->db->join('farmer_detail','farmer_detail.farmer_id = farmers.farmer_id','inner');
         $this->db->where('buying_station.bs_id', $postData['buyingStationID']);
         $q = $this->db->get('farmers');
         $response = $q->result_array();
       
        }
        return $response;
    }

    

     /* this function is used to get a subounty according for a respective buying station */
     function getSubcounty($postData2){
 
        $response = array();
       
        if($postData2['buyingStationID2'] ){
       
         // Select record
         $this->db->select('buying_station.bs_name,
         subcounties.subcounty_id,
         subcounties.subcounty_name');
         //$this->db->from('farmers');
         $this->db->join('subcounties','buying_station.subcounty_id = subcounties.subcounty_id','inner');
         $this->db->where('buying_station.bs_id', $postData2['buyingStationID2']);
         $q = $this->db->get('buying_station');
         $response = $q->result_array();
       
        }
        return $response;
    }

    function getCurrentBuyingStation($name1){
        $this->db->select('b1.bs_name,
        purchase_agents.name,
        agents_assigned.pa_id,
        agents_assigned.bs_id,
        tbl_users.mobile,
        tbl_users.is_purchaser');
        $this->db->from('purchase_agents');
        $this->db->join('tbl_users','purchase_agents.userId = tbl_users.userId','inner');
        $this->db->join('agents_assigned','agents_assigned.pa_id = purchase_agents.pa_id','inner');
        $this->db->join('buying_station AS b1','agents_assigned.bs_id = b1.bs_id','inner');
        $this->db->join('buying_station AS b2','purchase_agents.bs_id = b2.bs_id','inner');
        
         $this->db->where('tbl_users.is_purchaser =', 1);
        $this->db->where('purchase_agents.is_assigned =', 1);
        $this->db->where('tbl_users.name =', $name1); 
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }

     function addNewPurchase($purchaseInfo, $farmerCode, $updateExcessDelivery)
    {
        $this->db->trans_start();
        $this->db->insert('purchases', $purchaseInfo);  
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
        
        $this->db->where('farmer_id', $farmerCode);
        $this->db->set('excess_delivery_balance', $updateExcessDelivery, FALSE);
        $this->db->update('farmers');

       // $insert_id = $this->db->insert_id();        
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

    function addNewPurchaseWithUpdates($purchaseInfo, $updateAdvance, $advanceID, $updateExcessDelivery, $farmerCode)
    {
        $this->db->trans_start();
        $this->db->insert('purchases', $purchaseInfo);   
        
        $this->db->where('advance_id', $advanceID);
        $this->db->set('current_advance_amount', $updateAdvance, FALSE);
        $this->db->update('advances');

        $this->db->where('farmer_id', $farmerCode);
        $this->db->set('excess_delivery_balance', $updateExcessDelivery, FALSE);
        $this->db->update('farmers');
        
        
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
         //return $insert_id;
         return TRUE;
    }


    function payIcamFarmer($purchaseId, $payNewStatus, $newAmount){
        /* $this->db->where('purchase_id', $Info1);
        $this->db->update('purchases', $info2); */

        $this->db->where('purchase_id', $purchaseId);
        $this->db->set('payStatus', $payNewStatus);
        $this->db->update('purchases');

        $this->db->where('purchase_id', $purchaseId);
        $this->db->set('amount_not_paid ', $newAmount);
        $this->db->update('purchases');


        return TRUE;
    }

     /**
     * This function is used to get the purchase information
     * @return array $result : This is result of the query
     */
    function getPurchasesInfo($purchaseId)
    {
        $this->db->select('*');
        $this->db->from('purchases');
        $this->db->where('purchases.purchase_id =', $purchaseId);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
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
    
    function getOtherFarmerCodes(){
        $this->db->select('*');
        $this ->db->from('farmers');
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

    function getAdvanceID($postData3){
 
        $response = array();
       
        if($postData3['farmerID'] ){
       
         // Select record
         $this->db->select('advances.amount, advances.date_added,
         advances.date_advanced,
         advances.advanced_by,
         advances.current_advance_amount,
         advances.advance_id');
          $this->db->where('advances.advance_id', $postData3['farmerID']);
         $q = $this->db->get('advances');
         $response = $q->result_array();
       
        }
        return $response;
    }
	
	  /* function getPurchaserID($purchaser){
 
        //$response = array();
       
        /*if($purchaser['name'] ){
       
         // Select record
         $this->db->select('purchase_agents.pa_id, purchase_agents.official_role');
          $this->db->where('purchase_agents.name', $purchaser['name']);
         $q = $this->db->get('purchase_agents');
         $response = $q->result_array();
       
        }*/
		 //echo '<pre>', print_r("Hooray"), '</pre>';
		
        //return $response;
    //}

    function getSupplyTarget($postData4){
 
        $response = array();
       
        if($postData4['farmerID2'] ){
       
         // Select record
         $this->db->select('farmers.excess_delivery_target, farmers.excess_delivery_balance');
          $this->db->where('farmers.farmer_id', $postData4['farmerID2']);
         $q = $this->db->get('farmers');
         $response = $q->result_array();
       
        }
        return $response;
    }

}