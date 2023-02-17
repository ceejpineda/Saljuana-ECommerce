<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landing extends CI_Controller {

	public function index()
	{
		$this->load->view('landing');
	}

	public function login_admin()
	{
		$this->load->view('users/admin');
	}

	public function login_page()
	{
		$this->load->view('users/login');
	}

	public function register_page()
	{
		$this->load->view('users/register');
	}


}

?>