<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontend extends CI_Controller {

	public function index()
	{
		$this->load->view('frontend/home');
	}

	public function product_details()
	{
		$this->load->view('frontend/product');
	}
}
