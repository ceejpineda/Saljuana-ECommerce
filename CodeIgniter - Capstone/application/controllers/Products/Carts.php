<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carts extends CI_Controller 
{
    public function index()
    {
        if($this->session->userdata('is_admin') != 1)
        {
            redirect('/');
        }
        else
        {
            $this->load->view('products/carts');
        }
    }


}