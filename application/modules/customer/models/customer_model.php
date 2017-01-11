<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Customer_model extends Custom_Model
{
    protected $logs;
    
    function __construct()
    {
        parent::__construct();
        $this->logs = new Log_lib();
        $this->com = new Components();
        $this->com = $this->com->get_id('customer');
        $this->tableName = 'customer';
    }
    
    protected $field = array('id', 'first_name', 'last_name', 'type', 'address', 'shipping_address', 'phone1', 'phone2',
                             'fax', 'email', 'password', 'website', 'city', 'region', 'zip', 'notes', 'image', 'status',
                             'created', 'updated', 'deleted');
    protected $com;
    
    function get_last($limit, $offset=null)
    {
        $this->db->select($this->field);
        $this->db->from($this->tableName); 
        $this->db->where('deleted', $this->deleted);
        $this->db->order_by('id', 'desc'); 
        $this->db->limit($limit, $offset);
        return $this->db->get(); 
    }
    
    function search($cat=null,$publish=null)
    {   
        $this->db->select($this->field);
        $this->db->from($this->tableName); 
        $this->db->where('deleted', $this->deleted);
        $this->cek_null_string($cat, 'category');
        $this->cek_null_string($publish, 'publish');
        
        $this->db->order_by('name', 'asc'); 
        return $this->db->get(); 
    }

}

?>