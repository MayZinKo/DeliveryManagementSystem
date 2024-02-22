<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assign extends MY_Controller 
{
	function __construct()
	{
		parent::__construct(); 
		$this->load->model('main_model');   
		$this->load->model('courier_model');  
		$this->load->model('assign_model'); 
		$logged_in = $this->session->userdata('user_info');
		if(!$logged_in)
		{	redirect('login');	}
	}
	public function index()
	{
		$this->load->view('front_end/login');//Error Need to change
	}
	public function view($status='',$customer_id,$courier_id='')
	{

		$this->breadcrumbs->push('Un-Assign List',"customer/browse/".$status);
		$this->breadcrumbs->push('Assign',"assign/view/".$status."/".$customer_id);

		$header=$this->config->item('header');
		$footer=$this->config->item('footer');

		$data['customer_data']=$this->main_model->get_customer($customer_id);
		$township_id=$data['customer_data']['township_id'];
		$data['township_data']=$this->main_model->get_township($data['customer_data']['township_id']);
		$courier_data=$this->courier_model->get_courier_by_township($data['customer_data']['township_id']);

		if($courier_id)
		{
			$assign=$this->config->item('assign_courier');
			$data['courier_markers']=$this->courier_model->get_courier_markers($courier_id);
			$data['courier_res']=$this->main_model->get_courier($courier_id);	
			$data['routedata']=json_encode($data['courier_markers']);
			
		}
		elseif($courier_id=='0')
		{
			
			$assign=$this->config->item('assign_courier_all_route');
			 $add_township_get_assign=$this->assign_model->add_township_get_assign($township_id);
			$data['all_route']=json_encode($add_township_get_assign);	
		}		
		else
		{
			$assign=$this->config->item('assign');	
			
		}

		$this->load->view($header);

		foreach ($courier_data as $key) 
		{
			$count=$this->courier_model->count_courier_assign($key['courier_id']);
			$key['count_assign']=$count;
			$courier_info[]=$key;
		}
		
		$check_assign =$this->assign_model->check_assign($customer_id);
		if($check_assign)
		{
			$data['check_assign']= $check_assign;
		}
		$data['status']=$status;
		$data['courier_data']=$courier_info;
		
		$this->load->view($assign,$data);
		$this->load->view($footer);
	}

	function testing($township_id)
	{
		$data=$this->assign_model->add_township_get_assign($township_id);
		echo "<pre>";
		var_dump($data);
	}
	function assign_ajax()
	{
		$courier_id=$_POST['courier_id'];
		$customer_type=$_POST['customer_type'];
		$customer_id=$_POST['customer_id'];
		$township_id=$_POST['township_id'];

		if($customer_type=="s")
		{
			$assign_id =$this->start_customer_assign($courier_id,$customer_id);
		}
		elseif($customer_type=="e")
		{
			$assign_id =$this->start_customer_assign($courier_id,$customer_id);
		}

		// $get_assign_data =$this->assign_model->get_assign_data($assign_id);
		// $courier_id=$get_assign_data['courier_id'];
		// $count=$this->courier_model->count_courier_assign($courier_id);
		// $get_assign_data['count_assign']=$count;
			
		$courier_data=$this->courier_model->get_courier_by_township($township_id);
		
		foreach ($courier_data as $key) 
		{
			$count=$this->courier_model->count_courier_assign($key['courier_id']);
			$key['count_assign']=$count;
			$courier_info[]=$key;
		}

		$get_assign_data['courier_data']=json_encode($courier_info);
		

		$ajax_return=json_encode($get_assign_data);
		echo $ajax_return;
	}
	function start_customer_assign($courier_id,$customer_id)
	{
		$check_already_assign =$this->assign_model->check_already_assign($customer_id);
		$timestamp= date('Y-m-d h:i:s A', time());
			$assign_data_arr = array('courier_id'=> $courier_id,
				'customer_id' => $customer_id,'timestamp'=>$timestamp);
		if(!$check_already_assign)
		{
			$assign_id=$this->assign_model->insert($assign_data_arr);
		}
		else
		{
			$assign_id=$check_already_assign['id'];
			$this->assign_model->update($assign_data_arr,$assign_id);
		}
		return $assign_id;
	}
}
















