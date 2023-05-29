<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Analytics extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product');
    }

    public function index()
    {
        $result = $this->Product->get_sold_products(0);
        $data['sort'] = 0;
        $data['result'] = $result;
        $this->load->view('dashboard/analytics', $data);
    }

    public function product_api()
    {
        $sort = $this->input->post('sort');
        $result = $this->Product->get_sold_products($sort);
        $data['result'] = $result;
        $data['sort'] = $sort;
        $this->load->view('dashboard/analytics', $data);
    }
}