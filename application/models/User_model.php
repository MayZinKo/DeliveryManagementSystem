<?php
class User_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	    $this->load->database();
	}
	function get_user($user_id)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('id',$user_id);
		$query=$this->db->get();
		return $query->row_array();
	}
}
