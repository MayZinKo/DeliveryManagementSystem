<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends MY_Controller 
{
	function __construct()
	{
		parent::__construct(); 
		$this->load->model('login_model');   
	}
	public function index()
	{
		$logged_in = $this->session->userdata('user_info');
		//dd($logged_in);

		if($logged_in)
		{$this->check_role($logged_in);}
		//var_dump($this->session->userdata('user_info'));
		$this->load->view('front_end/login');
	}
	public function process()
	{
		$email='email';$password='password';
		$post_arr = array($email,$password);
		$val_res=$this->validation($post_arr);
		if($val_res)
		{
			// $post_return=$this->post($post_arr);
			$email=$this->input->post('email');
			$password=md5($this->input->post('password'));
			$login_data=  array('email' => $email, 'password' =>$password);
			$check_res =$this->login_model->check($login_data);	

			
			if(isset($check_res))
			{	
				if ($check_res['role_id']==1) {
					redirect('login', 'refresh');
				}
				
				$this->session->set_userdata('user_info',$check_res);	
				$logged_in = $this->session->userdata('user_info');
				$this->check_role($logged_in);

				
			}
			else 
			{
				$this->session->set_flashdata('message','<div class="alert alert-danger">Sorry User... Refail Again!</div>');
				$this->index();
			}
		}
		else
		{
			$this->index();
		}
	}
	public function logout()
	{
		$this->session->unset_userdata('user_info');
		$this->session->sess_destroy();	
		$logged_in = $this->session->userdata('user_info');

		redirect('login', 'refresh');
	}
}
