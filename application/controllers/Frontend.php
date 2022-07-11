<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontend extends CI_Controller {

	public function index()
	{
		$data=array('fk_lang_id'=>1);
		$curl=$this->link->hits('get-home-page-data',$data);
		$curl = json_decode($curl,true);
		// echo '<pre>'; print_r($curl); exit;
		$data['slider'] = $curl['slider'];
		$data['product_data'] = $curl['product_data'];
		//print_r($data['product_data']);die();
		$this->load->view('frontend/home',$data);
	}

	public function product_details()
	{
		$this->load->view('frontend/product');
	}
}
