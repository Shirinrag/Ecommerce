<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class alogin extends CI_Controller {

	function __construct(){
		parent::__construct();
        $company_setting =  $this->model->getData('company_setting',array());
        $glob['company'] = $company_setting;
        $this->load->vars($glob);
	}

	function index()
	{
		$data['status'] = '';
		$data['msg'] = '';
		$this->load->view('admin/login',$data);
	}

	function validate_login(){
		$jsonObj = $_POST['jsonObj']; 
        $array_data = json_decode($jsonObj,true); 
        $array_entity = $array_data['login'];
		$user_id = $array_entity['user_id'];
		$password = $array_entity['password'];
		$user_data=$this->model->getData('admin_user',array('email_address' => $user_id,'password' => md5($password)));
		if(isset($user_data) && !empty($user_data)){
			$newdata = array(
				'op_user_id'=>$user_data[0]['admin_id'],
				'user_id'=>$user_data[0]['email_address'],
				'user_name'=>$user_data[0]['full_name'],
				'user_role'=>$user_data[0]['level'],
				'is_admin_logged_in'=>TRUE
			);
			$this->session->set_userdata($newdata);
			$data['status'] = '1';
			$data['msg'] = '<strong>Well done!</strong> You have logged in successfully. Please wait while we are redirecting you on dashboard.';
		}
		else{
			$data['status'] = '0';
			$data['msg'] = '<strong>Oh snap!</strong> The email address or password you entered is incorrect. Please try again.';
		}
		echo json_encode($data);
	}

}