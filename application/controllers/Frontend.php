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

	function set_session_data()
	{
		$id = $this->input->post('new_value');
		$curl_data = array('lang_id'=>$id);		
		$this->session->set_userdata('logged_in', @$curl_data);
        $session_data = $this->session->userdata('logged_in');
		echo json_encode($curl_data);
	}

	public function product_details()
	{
		$this->load->view('frontend/product');
	}
}
