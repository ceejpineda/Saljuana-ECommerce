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
        $cart_items = $this->Cart->get_user_cart($this->session->userdata('user_id'));
        $sum = 0;
        foreach($cart_items as $key=>$item)
        {
            $cart_items[$key]['total'] = $item['price'] * (float)$item['qty'];
            $sum += $cart_items[$key]['total'];
        }
        $data['items'] = $cart_items;
        $data['sum'] = $sum;
        $data['count'] = $this->Cart->get_count();
        $this->load->view('products/carts', $data);
    }

    public function get_cart_count()
    {
        echo $this->Cart->get_count();
    }

    public function modify_cart_item($id = 0)
    {
        if($id == 0)
        {
            $post = $this->input->post(NULL, TRUE);
            $this->Cart->modify_qty($post);
        }
        else
        {
            $this->Cart->modify_qty($id);
        }

        $cart_items = $this->Cart->get_user_cart($this->session->userdata('user_id'));
        $sum = 0;
        foreach($cart_items as $key=>$item)
        {
            $cart_items[$key]['total'] = ($item['price'] * (float)$item['qty']);
            $sum += $cart_items[$key]['total'];
        }
        $data['items'] = $cart_items;
        $data['sum'] = $sum;
        $data['count'] = $this->Cart->get_count();
        $this->load->view('partials/carts_partial', $data);
    }

    public function add_to_cart()
    {
        $post = $this->input->post(NULL, TRUE);
        $post['user_id'] = $this->session->userdata('user_id');
        //var_dump($post);
        $this->Cart->insert_to_cart_items($post);
        $this->session->set_flashdata('success', 'Item Added to Cart');
    }

    public function finalize_order()
    {
        $this->load->Model('Order');
        $post = $this->input->post(NULL, TRUE);
        var_dump($post);
        return;
        $cart_items = $this->Cart->get_user_cart($this->session->userdata('user_id'));
        //var_dump($cart_items);
        $this->Order->place_order($post, $cart_items);
        $this->load->view('products/success');
    }

}
