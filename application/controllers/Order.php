<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends MY_Controller 
{
	function __construct()
	{
		parent::__construct(); 
	    $this->load->model('main_model');   
	    $this->load->model('customer_model');
	    $this->load->model('order_model');
	    $logged_in = $this->session->userdata('user_info');
		if(!$logged_in)
		{	redirect('login');	}
	}
	public function index()
	{
		$this->load->view('front_end/login');
	}
	public function view($status='',$customer_id)
	{

		$this->breadcrumbs->push('Pending List',"customer/browse/".$status);
		$this->breadcrumbs->push('Assign & Item Add',"order/view/".$status."/".$customer_id);

		$header=$this->config->item('header');
		$footer=$this->config->item('footer');
		$euser_item_create=$this->config->item('euser_item_create');


		$invoice_data=$this->main_model->get_invoice($customer_id);
		$invoice_id=$invoice_data['id'];
		$invoice_count=$this->order_model->count_total_end_user($invoice_id);

		$data['page_label_1']="End Customer Create";
		$data['page_label_2']=$invoice_count;
		$data['item_category']=$this->main_model->get_all_item_category();
		$data['customer_data']=$this->main_model->get_customer($customer_id);
		$data['status']=$status;
		$data['township']=$this->main_model->get_all_township();
		
		$this->load->view($header);
		$this->load->view($euser_item_create,$data);
		$this->load->view($footer);
	}
	public function save($status)
	{
		//var_dump($status);
		$township_id_post=$_POST['township_id'];
		$township_arr=explode(",",$township_id_post);
		$township_id=$township_arr[0];
		// var_dump($township_arr);
		// die();

		$customer_id=$this->input->post('customer_id');
		
		$invoice_data=$this->main_model->get_invoice($customer_id);
		$invoice_id=$invoice_data['id'];

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

			$user_type='e';
			$post_return=$this->post($post_arr);
			$post_return['township_id']=$township_id;
			$post_return['customer_type']=$user_type;
			$post_return['drop_point_id']=$drop_point_id;
			$post_return['timestamp']= date('Y-m-d h:i:s A', time());

			$end_customer_id=$this->customer_model->insert($post_return);	
			
		
			$timestamp= date('Y-m-d h:i:s A', time());

			$order_res = array('invoice_id' =>$invoice_id,'customer_id'=>$end_customer_id,
				'township_id'=> $township_id, 'timestamp'=>$timestamp);

			$order_id=$this->order_model->insert($order_res);

			$item_category_org_id=$this->input->post('item_category_org');		
			if($item_category_org_id!=null || $item_category_org_id!="")
			{
				if(!empty($_FILES['item_img_org']['name']))
				{	
					$this->load->library('file_upload');
					$img = $this->file_upload->item_category_upload('item_img_org');
				}
				else
				{
					$img =null;
				}
				
				$order_item_arr = array('order_id' =>$order_id ,
					'item_category_id' => $item_category_org_id,'item_image' =>$img );
				$this->order_model->order_item_insert($order_item_arr);
				
			}
		$item_category=$this->input->post('item_category');
			if($item_category!=null || $item_category!="")
			{
				foreach ($item_category as $value) 
				{
					if($value!=null || $value!="")
					{		
						$item_category_arr[] = array('item_category_id' =>  $value);		
					}
				}
				if (!empty($_FILES['userfile']['name']))
				{
					 $this->load->library('file_upload');
					 $img=$this->file_upload->item_category_arr_upload();
				}
				for($i=0; $i<count($item_category_arr); $i++) 
				{
					$item_category_arr[$i]['order_id']= $order_id;
					$item_category_arr[$i]['item_image']=$img[$i];
				}
				
				foreach ($item_category_arr as $item_res) 
				{
					$this->order_model->order_item_insert($item_res);
				}
			}

			
			$this->session->set_flashdata('message', "<div class='alert alert-success'>Success Message!</div>");
			$this->view($status,$customer_id);
		}
		else
		{

			$this->view($status,$customer_id);

		}
 	
		

	}


}
