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
		if($this->session->has_userdata('user_id')){
			redirect('/products/categories');
		}else{
			$this->load->view('users/login');
		}
	}

	public function register_page()
	{
		$this->load->view('users/register');
	}

}

?>