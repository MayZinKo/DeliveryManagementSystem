<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Phil Sturgeon
 * @link		http://philsturgeon.co.uk/code/
*/

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';

class Login extends REST_Controller
{
	function __construct()
    {

        parent::__construct();
        $this->methods['user_get']['limit'] = 500; //500 requests per hour per user/key
        $this->methods['user_post']['limit'] = 100; //100 requests per hour per user/key
        $this->methods['user_delete']['limit'] = 50; //50 requests per hour per user/key
		$this->load->helper('security');
		$this->load->library('form_validation');
		$this->load->model('login_model');
		$this->load->model('user_model');
    }
	
		function login_check_post()
		{
			$response = array("error" => FALSE);

			if ($this->post('email') != null && $this->post('password')!= null) 
			{
					$email=$this->post('email');
					$password=md5($this->post('password'));

				

					$this->form_validation->set_rules('email','email','trim|required|callback_email_check');
					$this->form_validation->set_rules('password','password','trim|required|alpha_numeric_spaces');
					if($this->form_validation->run() == FALSE)
					{$response = array("error" => 'VALIDATION',"success"=>FALSE);}
					else
					{
						$email_password = array('email' => $email,'password' =>$password );
						$user = $this->login_model->check($email_password);
					    if ($user) 
					    {
						        $response["success"] = TRUE;
										$user_info = $this->user_model->get_user($user['user_id']);
										$response["user_data"] = $user_info;
						        $this->response($response, 200);
					    } 
					    else 
					    {
					    	$response["result"] = $user;
					        $response["success"] = FALSE;
					        $response["error_msg"] = "Login credentials are wrong. Please try again!";
					    }
					     
					}
				/* ----------TESTING POSTMAN----------- */
					// $email_password = array('email' => $email,'password' =>$password );
					// $response["result"] = $email_password;
				/* ----------TESTING POSTMAN----------- */
			} 
			else 
			{

			    // required post params is missing
			    $response["error"] = TRUE;
			    $response["error_msg"] = "Required parameters email or password is missing!";
			   	$this->response($response, 403);
			}
			
			echo json_encode($response);
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

		

}
