<?php
class Customer_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	    $this->load->database();
	}
	function insert($post_arr)
	{
		$this->db->insert('customer',$post_arr);
		return $this->db->insert_id();
	}
	function update($post_return,$customer_id)
	{
		$this->db->where('customer.id', $customer_id);	
		$this->db->update('customer',$post_return);
	}
	function insert_drop_in($lat_long_return)
	{
		$this->db->insert('drop_point',$lat_long_return);
		return $this->db->insert_id();
	}
	function get_customer($status)
	{
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->join('township',"township.id =customer.township_id");
		$this->db->join('assign',"assign.customer_id =customer.id");
		$this->db->join('courier',"courier.id =assign.courier_id");
		$this->db->join('user',"user.id =courier.user_id");
		$this->db->where('customer.customer_type',$status);
		$this->db->where('customer.done_status',0);
		$query=$this->db->get();
		return $query->result_array();
	}
	function get_complete_customer($status)
	{
		$this->db->select('*,user.name as username,customer.name as customer_name,customer.id as customer_id');
		$this->db->from('customer');
		$this->db->join('township',"township.id =customer.township_id");
		$this->db->join('assign',"assign.customer_id =customer.id");
		$this->db->join('courier',"courier.id =assign.courier_id");
		$this->db->join('user',"user.id =courier.user_id");
		$this->db->where('customer.customer_type',$status);
		$this->db->where('customer.done_status',1);
		$query=$this->db->get();
		return $query->result_array();
	}
	function unassign_check()
	{
		$this->db->select('customer_id');
		$this->db->from('assign');
		$query=$this->db->get();
		$all_assign=$query->result_array();
		
		foreach ($all_assign as $value) 
		{
			$user_id_arr[]=$value['customer_id'];	
		}
		return isset($user_id_arr)?$user_id_arr:null;
	}

	function unassign($status)
	{
		$customer_id=$this->unassign_check();
		$this->db->select('*,customer.id as customer_id');
		$this->db->from('customer');
		$this->db->join('township',"township.id =customer.township_id");
		$this->db->where('customer_type',$status);
		$this->db->where('customer.done_status',0);	
		$this->db->where_not_in('customer.id', $customer_id);
		$query=$this->db->get();
		return $query->result_array();
	}
	function pending($status)
	{
		$this->db->select('*,user.name as username,customer.name as customer_name,customer.id as customer_id');
		$this->db->from('customer');
		$this->db->join('township',"township.id =customer.township_id");
		$this->db->join('assign',"assign.customer_id =customer.id");
		$this->db->join('courier',"courier.id =assign.courier_id");
		$this->db->join('user',"user.id =courier.user_id");
	
		$this->db->where('customer.done_status',0);	
		$this->db->where('customer.customer_type',$status);	
		$query=$this->db->get();
		return $query->result_array();
	}
	function add_done_status($customer_id)
	{
		$done = array('done_status' =>1);
		$this->db->where('customer.id',$customer_id);	
		$this->db->update('customer',$done );
	}


}
