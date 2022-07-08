<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->library('form_validation');
	}
	public function index()
	{
		$this->load->view('frontend/my-account');
	}

	public function login()
	{
		$this->load->view('frontend/login');
	}

	public function registration()
	{
		$this->load->view('frontend/register');
	}
    public function address_book()
	{
		$this->load->view('frontend/address_book');
	}
	public function change_password()
	{
		$this->load->view('frontend/change_password');
	}

	public function do_registers()
	{
		$this->form_validation->set_rules('','Email','trim|required');
		$this->form_validation->set_message('is_unique','The %s is already taken');

		$this->form_validation->set_rules('telephone','Phone No','trim|required');
		$this->form_validation->set_message('is_unique','The %s is already taken');

		$this->form_validation->set_rules('firstname','First Name','trim|required');
		$this->form_validation->set_message('is_unique','The %s is already taken');

		$this->form_validation->set_rules('lastname','Last Name','trim|required');
		$this->form_validation->set_message('is_unique','The %s is already taken');

		$this->form_validation->set_rules('password','Password','required');
		$this->form_validation->set_rules('confirm','Confirm','required|matches[password]');

		if($this->form_validation->run() == FALSE)
		{
			$errorMsg = $this->form_validation->error_array();
            $msg = array('status' => false, 'message' => $this->_returnSingle($errorMsg));
            echo json_encode($msg);
		}
		else{
			$register_array=array('first_name'=>$this->input->post('first_name'),
			'last_name'=>$this->input->post('last_name'),
			'email'=>$this->input->post('email'),
			'contact_no'=>$this->input->post('contact_no'),
			'device_type'=>'',
			'device_id'=>'',
			'terms_cond'=>'',
			'app_version'=>'',
			'app_build_no'=>'',
			'password'=>$this->input->post('password'),
			);
			print_r($register_array);die();
			$data['curl'] = $this->link->hits('register_data',$register_array);
			echo json_encode($data);
		}
		
	}
}
