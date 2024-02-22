<?php
class Order_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	    $this->load->database();
	}
	function insert($order_res)
	{
		$this->db->insert('order',$order_res);
		return $this->db->insert_id();
	}
	function order_item_insert($order_res)
	{
		$this->db->insert('order_itemcategory',$order_res);
	}
	function check_invoice($invoice_id)
	{
		$this->db->select('*');
		$this->db->from('order');
		$this->db->where('invoice_id',$invoice_id);
		$query=$this->db->get();
		return $query->result_array();
	}
	function count_total_end_user($invoice_id)
	{
		$this->db->select('*');
		$this->db->from('order');
		$this->db->where('invoice_id',$invoice_id);
		$query=$this->db->get();
		return $query->num_rows(); 
	}

	function end_customer_list_by_invoice($invoice_id)
	{
		$this->db->select('*,customer.id as customer_id');
		$this->db->from('order');
		$this->db->join('customer',"customer.id =order.customer_id");
		$this->db->join('township',"township.id =customer.township_id");
		$this->db->where('order.invoice_id',$invoice_id);
		$query=$this->db->get();
		return $query->result_array();
	}
	
}
