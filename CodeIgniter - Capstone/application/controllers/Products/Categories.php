<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product');
        $this->load->model('Category');
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

            $category_count = $this->Category->load_all_category_count();

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
            $data['categories'] = $category_count;
            $this->load->view('products/categories', $data);
        }
    }

    public function get_categories_name() 
    {
        $result = $this->Category->load_all_category_name();
        foreach ($result as $row) {
            $categories[] = [$row['id'],$row['category_name']];
        }
        echo json_encode($categories);
    }

    public function filter()
    {
        $post = $this->input->post(NULL, TRUE);
        $products = $this->Product->search($post);
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
        $this->load->view('partials/categorized', $data);
    }


}
