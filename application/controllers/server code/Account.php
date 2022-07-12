<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

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
}
