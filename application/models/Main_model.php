<?php
class Main_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	    $this->load->database();
	}
	function get_all_township()
	{
		$this->db->select('*');
		$this->db->from('township');
		$query=$this->db->get();
		return $query->result();
	}
	function get_all_item_category()
	{
		$this->db->select('*');
		$this->db->from('item_category');
		$query=$this->db->get();
		return $query->result();
	}
	function get_township($township_id)
	{
		$this->db->select('*');
		$this->db->from('township');
		$this->db->where('id',$township_id);
		$query=$this->db->get();
		return $query->row_array();
	}
	function get_customer($customer_id)
	{
		$this->db->select('*,customer.id as customer_id');
		$this->db->from('customer');
		$this->db->join('township',"township.id =customer.township_id");
		$this->db->join('drop_point',"drop_point.id =customer.drop_point_id");
		$this->db->where('customer.id',$customer_id);
		$query=$this->db->get();
		return $query->row_array();
	}

	function get_courier($courier_id)
	{
		$this->db->select('*');
		$this->db->from('courier');
		$this->db->where('id',$courier_id);
		$this->db->where('deleted',0);
		$query=$this->db->get();
		return $query->row_array(); 
	}
	function get_invoice($customer_id)
	{
		$this->db->select('*');
		$this->db->from('invoice');
		$this->db->where('start_customer_id',$customer_id);
		$query=$this->db->get();
		return $query->row_array();
	}
}
