<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class courier extends MY_Controller 
{
	function __construct()
	{
		parent::__construct(); 
		$this->load->model('courier_model');   
		 $logged_in = $this->session->userdata('user_info');
		if(!$logged_in)
		{	redirect('login');	}
	}
	public function index()
	{
		$logged_in = $this->session->userdata('user_info');
		if($logged_in)
		{	redirect('customer/create', 'refresh');}

		$this->load->view('front_end/login');
	}
	public function view()
	{
		$header_courier=$this->config->item('header_courier');
		$footer=$this->config->item('footer');
		$today_list=$this->config->item('today_list');

		$logged_in = $this->session->userdata('user_info');
		$user_id=$logged_in['user_id'];
		$get_courier_id=$this->courier_model->get_courier_id($user_id);
		$courier_id=$get_courier_id['id'];
		$data['query']=$this->courier_model->get_today_route($courier_id);


		$this->load->view($header_courier);
		$this->load->view($today_list,$data);
		$this->load->view($footer);
	}

}
