<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Buying_station_model extends CI_Model
{
 /**
     * This function is used to get the station listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function stationListingCount($searchText = '')
    {
        $this->db->select('BaseTbl.bs_id, BaseTbl.bs_name, BaseTbl.bs_parish , BaseTbl.bs_createdby, subcounties.subcounty_name');
        $this->db->from('buying_station as BaseTbl');
        $this->db->join('subcounties', 'BaseTbl.subcounty_id = subcounties.subcounty_id','inner');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.bs_name  LIKE '%".$searchText."%'
                            OR  subcounties.subcounty_name  LIKE '%".$searchText."%'
                            OR  BaseTbl.bs_parish  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        // $this->db->where('BaseTbl.roleId !=', 1);
        $query = $this->db->get();
        
        return count($query->result());
    }
 

    function stationListing($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.bs_id, BaseTbl.bs_name, BaseTbl.bs_parish, BaseTbl.bs_createdby, subcounties.subcounty_name');
        $this->db->from('buying_station as BaseTbl');
        $this->db->join('subcounties', 'BaseTbl.subcounty_id = subcounties.subcounty_id','inner');
        
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.bs_name  LIKE '%".$searchText."%'
                            OR  subcounties.subcounty_name  LIKE '%".$searchText."%'
                            OR  BaseTbl.bs_parish  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        // $this->db->where('BaseTbl.roleId !=', 1);
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }  




 /**
     * This function is used to add new buying station to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewStation($stationInfo)
    {
        $this->db->trans_start();
        $this->db->insert('buying_station', $stationInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }

    /**
     * This function used to get buying_station information by id
     * @param number $stationId : This is station id
     * @return array $result : This is station information
     */
    function getStationInfo($stationId)
    {
        $this->db->select('bs_id, bs_name, bs_parish, bs_createdby, subcounties.subcounty_name, subcounties.subcounty_id');
        $this->db->from('buying_station');
        $this->db->join('subcounties', 'buying_station.subcounty_id = subcounties.subcounty_id','inner');
        
        $this->db->where('bs_id', $stationId);
        $query = $this->db->get();
        return $query->result();
    }

      /**
     * This function is used to get the user roles information
     * @return array $result : This is result of the query
     */
    function getStationSubcounties()
    {
        $this->db->select('subcounty_id, subcounty_name, subcounty_id');
        $this->db->from('subcounties');
        // $this->db->where('roleId !=', 1);
        $query = $this->db->get();        
        return $query->result();
    }

     /**
     * This function is used to update the buying station information
     * @param array $stationInfo : This is buying station updated information
     * @param number $stationId : This is station id
     */
    function editStation($stationInfo, $stationId)
    {
        $this->db->where('bs_id', $stationId);
        $this->db->update('buying_station', $stationInfo);
        
        return TRUE;
    }

    /**
     * This function is used to delete the buying station information
     * @param number $stationId : This is buying station id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteStation($stationId, $stationInfo)
    {
        $this->db->where('bs_id', $stationId);
        $this->db->update('buying_station', $stationInfo);
        
        return $this->db->affected_rows();
    }

}
