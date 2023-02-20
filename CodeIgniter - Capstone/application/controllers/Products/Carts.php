<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carts extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->Model('Cart');
    }

    public function index()
    {
        if($this->session->userdata('is_admin') != 1)
        {
            redirect('/');
        }
        else
        {
            $cart_items = $this->Cart->get_user_cart($this->session->userdata('user_id'));
            $sum = 0;
            foreach($cart_items as $key=>$item){
                $cart_items[$key]['total'] = number_format(((float)$item['price'] * (float)$item['qty']),2);
                $sum += $cart_items[$key]['total'];
            }
            $data['items'] = $cart_items;
            $data['sum'] = $sum;
            $this->load->view('products/carts', $data);
        }
    }

    public function add_to_cart()
    {
        $post = $this->input->post(NULL, TRUE);
        $post['user_id'] = $this->session->userdata('user_id');
        $this->Cart->insert_to_cart_items($post);
    }

    public function finalize_order()
    {
        echo 'hello';
        $this->load->Model('Order');
        $post = $this->input->post(NULL, TRUE);
        $cart_items = $this->Cart->get_user_cart($this->session->userdata('user_id'));
        var_dump($cart_items);
        $this->Order->place_order($post, $cart_items);
    }

}
