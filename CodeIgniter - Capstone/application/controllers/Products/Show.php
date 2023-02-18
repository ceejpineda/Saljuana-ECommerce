<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Show extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product');
    }

    public function index($id)
    {
        if($this->session->userdata('is_admin') != 1)
        {
            redirect('/');
        }
        else
        {
            $product = $this->Product->load_product_info($id);
            $directory = $product['img_url'];

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
            $this->load->view('products/show', $product);
        }
    }
}
