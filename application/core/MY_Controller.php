<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Controller extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}
	public function validation($post_arr)
	{
		foreach ($post_arr as $result) 
		{
			if($result=='phone' || $result=='township_id')
			$this->form_validation->set_rules($result,$result,'trim|required|numeric');

			elseif($result=='description' || $result=='quarter') 
			$this->form_validation->set_rules($result,$result,'trim|alpha_numeric_spaces');

			elseif ($result=='email') 
			$this->form_validation->set_rules($result,$result,'trim|required|callback_email_check');
		
			elseif ($result=='latitude' || $result=='longitude') 
			$this->form_validation->set_rules($result,$result,'trim|required');	

			else
			$this->form_validation->set_rules($result,$result,'trim|required|alpha_numeric_spaces');

		}
		 if($this->form_validation->run() == FALSE)return false;
		 else return true;

	}
   
   	public function email_check($email)
    {
    	$check_res =$this->login_model->match_email($email);

            if ($check_res)
            {
                return TRUE;
            }
            else
            {
            	$this->form_validation->set_message('email_check', 'Not match with your Email');
                return FALSE;
            }
    }

	public function post($post_arr)
	{
		
		foreach ($post_arr as $result) 
		{
			$post_res[$result]=$this->input->post($result);
		}
		return $post_res;
	}
	public function check_role($check_res)
	{
		
		if($check_res['role_id']==2){
			redirect('customer/create');
		}									
		
		elseif($check_res['role_id']==3){
			redirect('courier/view');
		}
		
	}

}
