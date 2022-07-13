<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontend extends CI_Controller {

	public function index()
	{
		$session_data = $this->session->userdata('logged_in');
		$curl_data = array('fk_lang_id' =>$session_data['lang_id'],);
		$curl=$this->link->hits('get-home-page-data',$curl_data);
		$curl = json_decode($curl,true);
		// echo '<pre>'; print_r($curl); exit;
		$data['slider'] = $curl['slider'];
		$data['product_data'] = $curl['product_data'];
		$data['popular'] = $curl['popular'];
		$data['featured'] = $curl['featured'];
		$data['best_selling'] = $curl['best_selling'];
		
		$this->load->view('frontend/home',$data);
	}

	public function set_session_data()
	{
		$id = $this->input->post('new_value');
		$curl_data = array('lang_id'=>$id);		
		$this->session->set_userdata('logged_in', @$curl_data);
        $session_data = $this->session->userdata('logged_in');
		echo json_encode($curl_data);
	}
	public function alpha_dash_space($fullname){
        if (! preg_match('/^[a-zA-Z\s]+$/', $fullname)) {
            $this->form_validation->set_message('alpha_dash_space', 'The %s field may only contain alpha characters & White spaces');
            return FALSE;
        } else {
            return TRUE;
        }
    }
	public function product_details()
	{
		$this->load->view('frontend/product');
	}

	public function login()
	{
		$this->load->view('frontend/login');
	}

	public function registration()
	{
		$this->load->view('frontend/register');
	}
	public function user_register(){
            $user_name = $this->input->post('user_name');            
            $email = $this->input->post('email');
            $contact_no = $this->input->post('contact_no');
            $password = $this->input->post('password');

            $this->form_validation->set_rules('user_name','User Name', 'trim|required|callback_alpha_dash_space', array('required' => '%s is required.'));
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
                $curl = json_decode($curl, TRUE);
                if($curl['status']==true){
                    $response['status']='success';
                    $response['message']=$curl['message'];
                    $response['url']= base_url().'Frontend/verify_otp?contact_no="' . base64_encode($curl['contact_no']) . '"';
                } else {
                    $response['status'] = 'failure';
                    $response['error'] = array(
                     'contact_no' => $curl['message'], 
                    );
                }
            } 
        echo json_encode($response);
    }

    public function verify_otp()
    {
    	$response['contact_no']= base64_decode($_GET['contact_no']);
    	$this->load->view('frontend/verify_otp',$response);
    }
    public function address_book()
	{
		$this->load->view('frontend/address_book');
	}
	public function change_password()
	{
		$this->load->view('frontend/change_password');
	}
     
	
    public function my_account()
	{
		$this->load->view('frontend/my-account');
	}
}
