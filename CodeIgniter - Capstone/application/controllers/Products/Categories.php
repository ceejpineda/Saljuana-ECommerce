<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product');
    }
    
    public function index()
    {
        if($this->session->userdata('is_admin') != 1)
        {
            redirect('/');
        }
        else
        {
            $products = $this->Product->load_all_products();

            $products_info = array();

            foreach($products as $product)
            {
                $directory = $product['img_url'];
                $url = scandir($directory);
                $file = $url[2];
                $product['url'] = $directory . '/' . $file;
                $products_info[] = $product;
            }
            $data['products'] = $products_info;
            $this->load->view('products/categories', $data);
        }
    }


}
