<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontend extends CI_Controller {

	public function index()
	{

		
		// $data=array('fk_lang_id'=>1);
		
		// $response=$this->link->hits('get-home-page-data',$data);
		// print_r($response);die;
		// $data['topbanner']=json_decode($response,TRUE);
		// print_r($data['topbanner']);die();
		$this->load->view('frontend/home');
	}

	public function product_details()
	{
		$this->load->view('frontend/product');
	}
}
