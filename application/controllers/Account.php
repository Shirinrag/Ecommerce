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

	 public function user_register(){
            $user_name = $this->input->post('user_name');            
            $email = $this->input->post('email');
            $contact_no = $this->input->post('contact_no');
            $password = $this->input->post('password');

            $this->form_validation->set_rules('first_name','First Name', 'trim|required|alpha', array('required' => '%s is required.'));
            $this->form_validation->set_rules('email','Email', 'trim|valid_email', array('required' => '%s is required.'));
            $this->form_validation->set_rules('contact_no','Contact No', 'trim|required', array('required' => '%s is required.'));
            $this->form_validation->set_rules('password','Password', 'trim|required', array('required' => '%s is required.'));
            if ($this->form_validation->run() == FALSE) {
                $response['status'] = 'failure';
                $response['error'] = array(
                    'user_name' => strip_tags(form_error('user_name')),            
                    'email' => strip_tags(form_error('email')),
                    'contact_no' => strip_tags(form_error('contact_no')),
                    'password' => strip_tags(form_error('password')),
                );
            } else {
                $curl_data = array(
                    'user_name'=>$user_name,
                    'email'=>$email,
                    'contact_no'=>$contact_no,
                    'password'=>$password
                );
                $curl = $this->link->hits('register_data',$curl_data);
                echo '<pre>'; print_r($curl); exit;

                $curl = json_decode($curl, TRUE);
                if($curl['status']){
                    $response['status']='success';
                    $response['message']=$curl['message'];
                } else {
                    $response['status'] = 'failure';
                    $response['error'] = array(
                     'email' => $curl['message'], 
                    );
                }
            } 
        echo json_encode($response);
    }
}
