<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Show extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product');
        $this->load->model('Cart');

    }

    public function index($id)
    {
        $product = $this->Product->load_product_info($id);
        $directory = $product['img_url'];
        $similar = $this->Product->load_similar($product['category_id']);
        $similar = array_slice($similar, 0, 6);

        $product_url = array();

        $urls = scandir($directory);

        foreach($urls as $k=>$url){
            if ($k < 2) continue;
            if ($k == 2)
            {
                $product['main_img'] = $directory . '/' . $url;
                continue;
            }
            $product_url[]= $directory . '/' . $url;
        }
        $product['urls'] = $product_url;
        $product['similar'] = $similar;
        $product['count'] = $this->Cart->get_count();
        $this->load->view('products/show', $product);
    }
}
