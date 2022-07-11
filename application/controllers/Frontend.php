<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontend extends CI_Controller {

	public function index()
	{
		$data=array('fk_lang_id'=>1);
		$curl=$this->link->hits('get-home-page-data',$data);
		$curl = json_decode($curl,true);
		$data['slider'] = $curl['slider'];
		$data['product_data'] = $curl['product_data'];
		$data['popular'] = $curl['popular'];
		$data['featured'] = $curl['featured'];
		$data['best_selling'] = $curl['best_selling'];
		
		$this->load->view('frontend/home',$data);
	}

	public function product_details()
	{
		$this->load->view('frontend/product');
	}
}
