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
    public function otp_verify()
    {
    	$otp = $this->input->post('otp');
        $contact_no = $this->input->post('contact_no');
         $this->form_validation->set_rules('contact_no','Contact No', 'trim|required', array('required' => '%s is required.'));
         $this->form_validation->set_rules('otp','Otp', 'trim|required|numeric', array('required' => '%s is required.'));
        if ($this->form_validation->run() == FALSE) {
                $response['status'] = 'failure';
                $response['error'] = array(
                    'contact_no' => strip_tags(form_error('contact_no')),
                    'otp' => strip_tags(form_error('otp')),
                );
            } else {
  				$curl_data=array('contact_no'=>$contact_no,'otp'=>$otp);
		        $curl = $this->link->hits('verify-otp', $curl_data);
		        // echo '<pre>'; print_r($curl); exit;
		        $curl = json_decode($curl, true);
		        if ($curl['status']==1) {
		            if (!empty($curl['data'])) {
		                    $this->session->set_userdata('user_logged_in', @$curl['data']);
		                    $session_data = $this->session->userdata('user_logged_in');
		                    $response['status'] = 'success';
		                    $response['url'] = base_url() . 'Frontend';
		            }
		        } else {
		            $response['status'] = 'failure';
		            $response['error'] = array('otp' => $curl['message'],);
		        }
      		}        
        echo json_encode($response);
    }
    public function login()
	{
		$this->load->view('frontend/login');
	}
	 public function user_login() {
        $this->form_validation->set_rules('contact_no', 'Contact No', 'required|trim', array('required' => 'You must provide a %s',));
        $this->form_validation->set_rules('password', 'Password', 'trim|required', array('required' => 'You must provide a %s',));
        if ($this->form_validation->run() == FALSE) {
            $response['status'] = 'failure';
            $response['error'] = array('contact_no' => strip_tags(form_error('contact_no')), 'password' => strip_tags(form_error('password')),);
        } else {
            // $prevpage = $this->input->post('prevpage');
            $contact_no = $this->input->post('contact_no');
            $password = $this->input->post('password');

            $curl_data = array('contact_no' => $contact_no, 'password' => $password,);
            $curl = $this->link->hits('login-data', $curl_data);
            $curl = json_decode($curl, TRUE);
            if ($curl['status'] == 1) {
                if (@$curl['data']) {
                    $this->session->set_userdata('user_logged_in', @$curl['data']);
            		$session_data = $this->session->userdata('user_logged_in')['op_user_id']; 
                    if(isset($_COOKIE['product_id']))
                    {
                        $url = base_url() . 'Frontend/wishlist_list';            
                        $response['url'] = $url;
                        $response['status'] = 'success';
                    }   
                    else{
                        $url = base_url() . 'Frontend';            
                        $response['url'] = $url;
                        $response['status'] = 'success';
                    }       
            		
                }else{
                    $response['status'] = "failure";
                    $response['error'] = array('password' => 'Incorrect login details');
                }
            } else if($curl['status'] = "failure"){
                if($curl['message']=="Otp Not Verified"){
                    $response['status'] = "failure_1";
                    $response['url']= base_url().'Frontend/verify_otp?contact_no="' . base64_encode($curl['contact_no']) . '"';                    
                }else{
                    $response['status'] = "failure";
                    $response['error'] = array('password' => $curl['message'],);
                }
            } else if($curl['status']=='wrong_username'){
				$response['status']='failure';  
				$response['error'] = array( 
            		'contact_no' =>$curl['message'],
            	); 				
			} else {
		  		$response['status'] = 'failure';
            	$response['error'] = array( 
            		'password' =>$curl['message'],
            	);
		  	}
        }
        echo json_encode($response);
    }

    public function product_details()
	{
		$session_data = $this->session->userdata('user_logged_in');
		$session_data1 = $this->session->userdata('logged_in');
		$user_id = @$session_data['op_user_id'];
		$fk_lang_id = $session_data1['lang_id'];
		$product_id = base64_decode($_GET['id']);
        $curl_data = array('product_id' => $product_id, 'fk_lang_id' => $fk_lang_id,);
      	$curl = $this->link->hits('product-details-on-id',$curl_data);
      
      	$curl = json_decode($curl, true);
      	// echo '<pre>'; print_r($curl); exit;
      	$data['product_details'] = $curl['product_details'];
      	$data['related_product_details'] = $curl['related_product_details'];
      	$data['fk_lang_id'] = $fk_lang_id;

		$this->load->view('frontend/product',$data);
	}

    public function wishlist()
    {
      $product_id=$_POST['product_id'];
      setcookie("product_id",$product_id,time() + (86400 * 30), "/");
      $user_id=$this->session->userdata('user_logged_in')['op_user_id'];
     
      if(empty($user_id))
      {
        $response['url'] = base_url() . 'Frontend/Login';
      }else{
        $curldata=array('product_id'=>$product_id,'user_id'=>$user_id);
        $curl=$this->link->hits('save-wishlist',$curldata);
        $curl = json_decode($curl, true);
        if($curl['status']){
            $response['status']='success';
            $response['message']=$curl['message'];
          }
          else{
            $response['status']='failed';
            $response['message']=$curl['message'];
          }
      }
      
      echo json_encode($response);
    }

    public function addtocart()
    {
      $product_id=$_POST['product_id'];
      setcookie("product_id",$product_id,time() + (86400 * 30), "/");
      $user_id=$this->session->userdata('user_logged_in')['op_user_id'];
     
      if(empty($user_id))
      {
        $response['url'] = base_url() . 'Frontend/Login';
      }else{
        $curldata=array('product_id'=>$product_id,'user_id'=>$user_id);
        $curl=$this->link->hits('add-to-cart',$curldata);
        $curl = json_decode($curl, true);
        if($curl['status']){
            $response['status']='success';
            $response['message']=$curl['message'];
          }
          else{
            $response['status']='failed';
            $response['message']=$curl['message'];
          }
      }
      
      echo json_encode($response);
    }

    public function cart()
    {
        $user_id=$this->session->userdata('user_logged_in')['op_user_id'];  
        $session_data = $this->session->userdata('logged_in');
        $fk_lang_id = $session_data['lang_id'];
        $curldata=array('user_id'=>$user_id,'fk_lang_id'=>$fk_lang_id);
        $curl=$this->link->hits('get-all-user-cart',$curldata); 
        $curl1=json_decode($curl,true);
        // echo '<pre>'; print_r($curl1); exit;
        $data['cart_data']=$curl1['cart_data'];
        $this->load->view('frontend/cart',$data);
    }

    public function wishlist_list()
    {
        $user_id=$this->session->userdata('user_logged_in')['op_user_id'];  
        $curldata=array('user_id'=>$user_id);
        $curl=$this->link->hits('get-all-whislist',$curldata); 
        $curl1=json_decode($curl,true);
        $data['wishlist_data']=$curl1['wishlist_data'];
        $this->load->view('frontend/wishlist',$data);
    }

    public function deletewishlist()
    {
        $user_id=$this->session->userdata('user_logged_in')['op_user_id'];
        $wishlist_id=$_POST['row_id'];
        $curl_data=array('id'=>$wishlist_id,'user_id'=>$user_id);
        $curl=$this->link->hits('delete-whislist',$curl_data); 
        $curl1=json_decode($curl,true);
        if($curl1['status']){
            $response['status']='success';
            $response['message']=$curl1['message'];
          }
          else{
            $response['status']='failed';
            $response['message']=$curl1['message'];
          }
          echo json_encode($response);
    }
    

    public function getwishlist()
    {
        $user_id=$this->session->userdata('user_logged_in')['op_user_id'];  
        $curldata=array('user_id'=>$user_id);
        $curl=$this->link->hits('get-all-whislist',$curldata);  
        $this->load->view('frontend/product',$data);
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

	 public function logout() {
        $this->session->unset_userdata('user_logged_in');
        redirect(base_url() . 'Frontend');
    }
}
