<?php
class Courier_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	    $this->load->database();
	}
	function get_today_route($courier_id)
	{
		$this->db->select('*,drop_point.latitude,drop_point.longitude,customer.name as customer_name');
		$this->db->from('assign');
		$this->db->join('customer',"customer.id =assign.customer_id");
		$this->db->join('drop_point',"drop_point.id =customer.drop_point_id");
		$this->db->join('township',"township.id =customer.township_id");
		$this->db->where('assign.courier_id',$courier_id);
		$this->db->where('customer.done_status',0);
		$query=$this->db->get();
		return $query->result_array();
	}
	function get_courier_id($user_id)
	{
		$this->db->select('id');
		$this->db->from('courier');
		$this->db->where('user_id',$user_id);
		$this->db->where('deleted',0);
		$query=$this->db->get();
		return $query->row_array(); 
	}

	function get_courier_markers($courier_id)
	{
		$this->db->select('drop_point.latitude,drop_point.longitude,customer.name as description');
		$this->db->from('assign');
		$this->db->join('customer',"customer.id =assign.customer_id");
		$this->db->join('drop_point',"drop_point.id =customer.drop_point_id");
		$this->db->where('customer.done_status',0);
		$this->db->where('assign.courier_id',$courier_id);
		$query=$this->db->get();
		return $query->result_array();
	}

	function get_courier_by_township($township_id)
	{
		$this->db->select('*,courier.id as courier_id');
		$this->db->from('user');
		$this->db->join('courier',"courier.user_id =user.id");
		$this->db->where('courier.township_id',$township_id);
		$query=$this->db->get();
		return $query->result_array();
	}

	function count_courier_assign($courier_id)
	{
		$this->db->select('*');
		$this->db->from('assign');
		$this->db->join('customer',"customer.id =assign.customer_id");
		$this->db->where('assign.courier_id',$courier_id);
		$this->db->where('customer.done_status',0);
		$this->db->where('assign.deleted',0);
		$query=$this->db->get();
		return $query->num_rows(); 
	}

}
