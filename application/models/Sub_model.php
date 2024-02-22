<?php
class Sub_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	    $this->load->database();
	}
	function insert_invoice($customer_id)
	{
		$invoice_num=uniqid();
		$invoice_arr = array('invoice_num' =>$invoice_num , 'start_customer_id' =>$customer_id);
		$this->db->insert('invoice',$invoice_arr);
	}
	

}
