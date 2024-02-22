<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Customer extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
	    $this->load->model('main_model');
	    $this->load->model('customer_model');
	    $this->load->model('assign_model');
	    $this->load->model('sub_model');
	    $this->load->model('order_model');
	    ini_set('date.timezone', 'Asia/Rangoon');
	   	$logged_in = $this->session->userdata('user_info');
		if(!$logged_in)
		{	redirect('login');	}
	}
	public function index()
	{
		$this->browse('unassign');
	}
	public function create()
	{
		$header=$this->config->item('header');
		$footer=$this->config->item('footer');
		$create=$this->config->item('create');

		$data['page_label_1']="Create";
		$data['page_label_2']="Start Customer";
		$data['township']=$this->main_model->get_all_township();

		$this->load->view($header);

		$this->load->view($create,$data);
		$this->load->view($footer);
	}
	public function save()
	{
		$status=isset($_POST['status'])?$_POST['status']:'start';
		$township_id_post=$_POST['township_id'];
		$township_arr=explode(",",$township_id_post);
		$township_id=$township_arr[0];
		$user_type='s';
		$status='start';
		// if($status=='start')	$user_type='s';
		// elseif($status=='end')  $user_type='e';

		$latitude='latitude';$longitude='longitude';
		$lat_long_arr= array($latitude,$longitude);

		$val_lat_long=$this->validation($lat_long_arr);
	
		$name='name';$phone='phone';$home_num='home_no';
		$street='street';$road='road';$quarter='quarter';
		$post_arr = array($name,$phone,$home_num,$street,$road,$quarter);
		$val_res=$this->validation($post_arr);
		
		if($val_res && $val_lat_long)
		{
			/* ***********For latitude longitude*********** */
			$lat_long_return=$this->post($lat_long_arr);
			$drop_point_id=$this->customer_model->insert_drop_in($lat_long_return);
			/* ***********For latitude longitude*********** */

			$post_return=$this->post($post_arr);

			$post_return['drop_point_id']=$drop_point_id;

			$post_return['township_id']=$township_id;
			$post_return['customer_type']=$user_type;
			$post_return['timestamp']= date('Y-m-d h:i:s A', time());

			$start_customer_id=$this->customer_model->insert($post_return);	
			$this->sub_model->insert_invoice($start_customer_id);	
			redirect('Customer/browse/start_unassign');
		}
		$this->create($status);
	}
	public function update()
	{
		
		$customer_id='customer_id';

		$check_hidden_field = array($customer_id);
		$val_check_hidden=$this->validation($check_hidden_field);

		$name='name';$phone='phone';$home_num='home_no';$township_id='township_id';
		$street='street';$road='road';$quarter='quarter';
		$post_arr = array($name,$phone,$home_num,$township_id,$street,$road,$quarter);
		$val_res=$this->validation($post_arr);
		if($val_res && $val_check_hidden)
		{
			$hidden_field_return=$this->post($check_hidden_field);
			$customer_id=$hidden_field_return['customer_id'];
			$post_return=$this->post($post_arr);

			$this->customer_model->update($post_return,$customer_id);		
		}
		$view_status=$this->input->post('view_status');

		if($view_status=='end_customer_list')
		{
			$start_customer_id=$this->input->post('start_customer_id');
			$this->end_list($start_customer_id);
		}
		elseif($view_status=='end_unassign')
		{
			$this->browse($view_status);
		}
		elseif($view_status=='unassign') 
		{
			$this->browse($view_status);
		}
		else
		{
			$this->browse('start_unassign');
		}
		
	}
	public function browse($status='')
	{
		$header=$this->config->item('header');
		$footer=$this->config->item('footer');
		
		$this->load->view($header);
		$data['township']=$this->main_model->get_all_township();
		
		if($status=='start_unassign')
		{
			$data['page_label_1']="Un-Assign List";
			$data['page_label_2']="Start Customer";
			$start='s';
			$data['query']=$this->customer_model->unassign($start);
			$view_on=$this->config->item('start_unassign');
		}
		elseif ($status=='start_pending') 
		{
			$data['page_label_1']="Pending List";
			$data['page_label_2']="Start Customer";
			$data['status']='start';
			$start='s';
			//$data['query']=$this->customer_model->pending($start);

			$start_pending=$this->customer_model->pending($start);
			
			for($i=0;$i<count($start_pending);$i++) 
			{		
				$result=$start_pending[$i];
				
				$customer_id=$result['customer_id'];
				$get_invoice_arr=$this->main_model->get_invoice($customer_id);
				$invoice_id=$get_invoice_arr["id"];
				$check_invoice_res=$this->order_model->check_invoice($invoice_id);
				if($check_invoice_res)
				{
					$status=1;
					$start_pending[$i]['order_status']=1;
				}
				else
				{
					$start_pending[$i]['order_status']=0;
				}	
			}
			
			$data['query']=$start_pending;
			// echo "<pre>";
			// var_dump($data['query']);


			$view_on=$this->config->item('start_pending');
		}
		elseif ($status=='end_unassign')
		{
			$data['page_label_1']="Un-Assign List";
			$data['page_label_2']="End Customer";
			$start='e';
			$data['query']=$this->customer_model->unassign($start);
			$view_on=$this->config->item('end_unassign');
		}
		elseif ($status=='end_pending')
		{
			$data['page_label_1']="Pending List";
			$data['page_label_2']="End Customer";
			$start='e';
			$data['query']=$this->customer_model->pending($start);
			$view_on=$this->config->item('end_pending');
		}
		elseif($status=='unassign')
		{
			$data['page_label_2']="Un-Assign List";
			$start='s';
			$data['start_unassign']=$this->customer_model->unassign($start);
			$end='e';
			$data['end_unassign']=$this->customer_model->unassign($end);
			$view_on=$this->config->item('unassign2');
		}
		elseif($status=='pending')
		{
			$data['page_label_2']="Pending List";
			$start='s';
			$start_pending=$this->customer_model->pending($start);
			
			for($i=0;$i<count($start_pending);$i++) 
			{		
				$result=$start_pending[$i];
				
				$customer_id=$result['customer_id'];
				$get_invoice_arr=$this->main_model->get_invoice($customer_id);
				$invoice_id=$get_invoice_arr["id"];
				$check_invoice_res=$this->order_model->check_invoice($invoice_id);
				if($check_invoice_res)
				{
					$status=1;
					$start_pending[$i]['order_status']=1;
				}
				else
				{
					$start_pending[$i]['order_status']=0;
				}	
			}
			
			$data['start_pending']=$start_pending;
			$end='e';
			$data['end_pending']=$this->customer_model->pending($end);
			$view_on=$this->config->item('pending2');
		}
		// echo "<pre>";
		// var_dump($data['start_pending']);
	    $this->load->view($view_on,$data);
		$this->load->view($footer);
	}
	public function start_unassign()
	{
		return $this->customer_model->start_unassign();
	}
	public function end_assign()
	{
		return $this->customer_model->end_unassign();
	}
	public function end_list($status='',$customer_id)
	{
		if ($status=='start_pending') 
		{
			$this->breadcrumbs->push('Pending List',"customer/browse/".$status);
			$this->breadcrumbs->push('Assign & Item Add',"order/view/".$status."/".$customer_id);
			$this->breadcrumbs->push('Detail',"customer/end_list/".$status."/".$customer_id);
		}
		else
		{
			$this->breadcrumbs->push('Pending List',"customer/browse/".$status);
			$this->breadcrumbs->push('Detail',"customer/end_list/".$status."/".$customer_id);
		}
		

		$header=$this->config->item('header');
		$footer=$this->config->item('footer');
		$view_on=$this->config->item('end_customer_list');
		
		$this->load->view($header);

		$check_assign =$this->assign_model->check_assign($customer_id);
		if($check_assign)
		{
			$data['check_assign']= $check_assign;
		}
		


		$data['start_customer_data']=$this->main_model->get_customer($customer_id);
		$data['township']=$this->main_model->get_all_township();

		$invoice_data=$this->main_model->get_invoice($customer_id);
		$invoice_id=$invoice_data['id'];

		$end_customer_data=$this->order_model->end_customer_list_by_invoice($invoice_id);
		for($i=0;$i<count($end_customer_data);$i++) 
		{
			$result=$end_customer_data[$i];
			$customer_id=$result['customer_id'];
			$check_assign =$this->assign_model->check_assign($customer_id);
			if($check_assign)
			{
				$status=1;
				$end_customer_data[$i]['check_assign']=1;
			}
			else
			{
				$end_customer_data[$i]['check_assign']=0;
			}	
		}
		
		$data['end_customer_data']=$end_customer_data;
		// echo "<pre>";
		// var_dump($data['end_customer_data']);
		$this->load->view($view_on,$data);
		$this->load->view($footer);
	}
	public function done_process($status,$customer_id)
	{
		$this->customer_model->add_done_status($customer_id);
		redirect('customer/browse/'.$status, 'refresh');
	}
	public function complete_list($status)
	{
		$header=$this->config->item('header');
		$footer=$this->config->item('footer');
		$view_on=$this->config->item('complete_list');
		$this->load->view($header);
		if ($status=='start_complete')
		{
			$customer_type='s';
		}
		elseif ($status=='end_complete') 
		{
			$customer_type='e';
		}
		$data['page_label_1']="Start Customers";
		$data['page_label_2']="Complete List";
		$data['query']=$this->customer_model->get_complete_customer($customer_type);
		
		$this->load->view($view_on,$data);
		$this->load->view($footer);
		
	}
}
