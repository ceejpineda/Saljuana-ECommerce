<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Order');
    }
    public function index()
    {
        if($this->session->userdata('is_admin') != 1)
        {
            redirect('/');
        }
        else
        {
            $data = $this->Order->get_all_orders();
            foreach($data as $key=>$order)
            {
                $address = json_decode($order['address'], true);
                $data[$key]['billing'] = implode(', ',$address['billing']);
                $data[$key]['shipping'] = implode(', ',$address['shipping']);

            }
            $info['orders'] = $data;
            $this->load->view('dashboard/orders', $info);
        }
    }

    public function do_search()
    {
        $post = $this->input->post(NULL,TRUE);
        $data = $this->Order->search_admin_order($post);
        foreach($data as $key=>$order)
        {
            $address = json_decode($order['address'], true);
            $data[$key]['billing'] = implode(', ',$address['billing']);
            $data[$key]['shipping'] = implode(', ',$address['shipping']);

        }
        $info['orders'] = $data;
        $this->load->view('partials/admin_orders', $info);
    }

    public function show($id)
    {
        $data = $this->Order->get_order($id);
        $address = json_decode($data['address'], true);
        $data['shipping'] = $address['shipping'];
        $data['billing'] = $address['billing'];
        //var_dump($data);
        $this->load->view('dashboard/show_admin', $data);
    }


}
