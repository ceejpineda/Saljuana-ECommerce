<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product');
        $this->load->model('Category');
        $this->load->model('Cart');
    }

    public function index()
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
            $data['count'] = count($products);
            $data['products'] = $products_info;
            $data['categories'] = $category_count;
            $pages = ceil(count($products)/10);
            $paged_products = array_slice($products_info, 0, 10); 
            $data['products'] = $paged_products;
            $data['pages'] = $pages;
            $data['count'] = $this->Cart->get_count();
            $this->load->view('products/categories', $data);
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
        $data['count'] = count($products);
        $pages = ceil(count($products)/10);
		$page_number = $this->input->post('page')-1;
		$paged_products = array_slice($products_info, $page_number*10, 10); 
		$data['products'] = $paged_products;
		$data['pages'] = $pages;
        $this->load->view('partials/categorized', $data);
    }


}
