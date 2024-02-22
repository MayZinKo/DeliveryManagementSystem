<?php
class Login_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	    $this->load->database();
	}
	function check($post_return)
	{
		$email=$post_return["email"];
		$password=$post_return["password"];

		$this->db->select('*,user.id as user_id');
		$this->db->from('user');
		$this->db->join('role',"role.id =user.role_id");
		$this->db->where('email',$email);
		$this->db->where('password',$password);
		$this->db->where('deleted',0);
		
		$query=$this->db->get();
		return $query->row_array();
	}
	function match_email($email)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('email',$email);
		$query=$this->db->get();
		return $query->row_array();
	}
}
