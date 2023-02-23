<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Stripe\StripeClient;

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
        //var_dump($this->input->post());
        $post = $this->input->post(NULL, TRUE);
        $cart_items = $this->Cart->get_user_cart($this->session->userdata('user_id'));
        if(count($cart_items) == 0){
            echo 'YOU HAVE NO ITEMS TO CHECKOUT';
        }
        $this->Order->place_order($post, $cart_items);
        $this->load->view('products/success');
    }

    public function pay_stripe()
    {
        $amount = (float)$this->Cart->get_total()['total_amount'];
        require_once('application/libraries/stripe-php/init.php');
     
        $stripeSecret = 'sk_test_51MXHo7AKSx4zWvWkAviHRazhgbivg2IDv3T4PbNHeqYyJVKkwfpNlTxwpspFkJjWiQnyXSit9hsCjubPhJjVbGAe00HzedIaRL';
   
        \Stripe\Stripe::setApiKey($stripeSecret);
        
        $stripe = \Stripe\Charge::create ([
                "amount" => $amount * 100,
                "currency" => "usd",
                "source" => $this->input->post('tokenId'),
                "description" => "Payment from Saljuana.ph ."
        ]);
            
            
        $data = array('success' => true, 'data'=> $stripe);
   
        echo json_encode($data);
    }

    public function cart_total()
    {
       echo $this->Cart->get_total()['total_amount'];
    }

    public function order_history()
    {
        $data['count'] = $this->Cart->get_count();
        $this->load->Model('Order');
        $orders = $this->Order->get_history();

        foreach($orders as $key=>$order)
        {
            $address = json_decode($order['address'], true);
            $orders[$key]['billing'] = implode(', ',$address['billing']);
            $orders[$key]['shipping'] = implode(', ',$address['shipping']);

        }
        $data['orders'] = $orders;
        //var_dump($orders);
        $this->load->view('products/history', $data);
    }

}
