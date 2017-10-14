<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Company_rating_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get company_rating by rating_id
     */
    function get_company_rating($rating_id)
    {
        return $this->db->get_where('company_rating',array('rating_id'=>$rating_id))->row_array();
    }
        
    /*
     * Get all company_rating
     */
    function get_all_company_rating()
    {
        $this->db->order_by('rating_id', 'desc');
        return $this->db->get('company_rating')->result_array();
    }
        
    /*
     * function to add new company_rating
     */
    function add_company_rating($params)
    {
        $this->db->insert('company_rating',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update company_rating
     */
    function update_company_rating($rating_id,$params)
    {
        $this->db->where('rating_id',$rating_id);
        return $this->db->update('company_rating',$params);
    }
    
    /*
     * function to delete company_rating
     */
    function delete_company_rating($rating_id)
    {
        return $this->db->delete('company_rating',array('rating_id'=>$rating_id));
    }
}