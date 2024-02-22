<?php
class Assign_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	    $this->load->database();
	}
	function check_already_assign($customer_id)
	{
		$this->db->select('*');
		$this->db->from('assign');
		$this->db->where('customer_id',$customer_id);

	
		$this->db->where('deleted',0);
		$query=$this->db->get();
		return $query->row_array();
	}
	function insert($assign_data_arr)
	{
		$this->db->insert('assign',$assign_data_arr);
		return $this->db->insert_id();
	}
	
	function update($assign_data_arr,$assign_id)
	{
		$this->db->where('id', $assign_id);	
		$this->db->update('assign',$assign_data_arr);
	}
	function get_assign_data($assign_id)
	{
		$this->db->select('*');
		$this->db->from('assign');
		$this->db->join('customer',"customer.id =assign.customer_id");
		$this->db->join('drop_point',"drop_point.id =customer.drop_point_id");
		$this->db->join('courier',"courier.id =assign.courier_id");
		$this->db->where('assign.id',$assign_id);
		$this->db->where('customer.done_status',0);
		$this->db->where('assign.deleted',0);

		$query=$this->db->get();
		return $query->row_array();
	}
	function check_assign($customer_id)
	{
		$this->db->select('*');
		$this->db->from('assign');
		$this->db->join('customer',"customer.id =assign.customer_id");
		$this->db->join('drop_point',"drop_point.id =customer.drop_point_id");
		$this->db->join('courier',"courier.id =assign.courier_id");
		$this->db->where('assign.customer_id',$customer_id);
		$this->db->where('customer.done_status',0);
		$this->db->where('assign.deleted',0);
		$this->db->where('courier.deleted',0);
		$query=$this->db->get();
		return $query->row_array();
	}
	function add_township_get_assign($township_id)
	{
		$this->db->select('drop_point.latitude,drop_point.longitude,customer.name as customer_name,courier.marker_img');
		$this->db->from('assign');
		$this->db->join('customer',"customer.id =assign.customer_id");
		$this->db->join('drop_point',"drop_point.id =customer.drop_point_id");
		$this->db->join('courier',"courier.id =assign.courier_id");

		$this->db->where('courier.township_id',$township_id);
		$this->db->where('customer.done_status',0);
		$this->db->where('assign.deleted',0);
		$this->db->where('courier.deleted',0);
		$query=$this->db->get();
		return $query->result_array();
	}
	
}
