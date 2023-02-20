<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Model 
{
    function get_all_orders()
    {
        $query = "SELECT orders.*, first_name, last_name FROM orders
                    JOIN users ON orders.user_id = users.id";
        return $this->db->query($query)->result_array();
    }

    function place_order($post, $items)
    {
        $total_amount = 0;
        foreach ($items as $item) {
            $total_amount += $item['price'] * $item['qty'];
        }

        $address_info = array(
            'shipping' => array(
            'first_name_ship' => $post['first_name_ship'],
            'last_name_ship' => $post['last_name_ship'],
            'address_ship' => $post['address_ship'],
            'address2_ship' => $post['address2_ship'],
            'city_ship' => $post['city_ship'],
            'state_ship' => $post['state_ship'],
            'zipcode_ship' => $post['zipcode_ship'],),

            'billing' => array(
            'first_name_bill' => $post['first_name_bill'],
            'last_name_bill' => $post['last_name_bill'],
            'address_bill' => $post['address_bill'],
            'address2_bill' => $post['address2_bill'],
            'city_bill' => $post['city_bill'],
            'state_bill' => $post['state_bill'],
            'zipcode_bill' => $post['zipcode_bill'],)
        );

        $order_data = array(
            'user_id' => $this->session->userdata('user_id'),
            'total_amount' => $total_amount,
            'address' => json_encode($address_info),
            'status' => 'pending',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        );

        $this->db->insert('orders', $order_data);
        $order_id = $this->db->insert_id();

        foreach ($items as $item) {
            $item_data = array(
                'user_id' => $this->session->userdata('user_id'),
                'order_id' => $order_id,
                'product_id' => $item['product_id'],
                'qty' => $item['qty'],
                'name_when_ordered' => $item['product_name'],
                'price_when_ordered' => $item['price'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            );
            $this->db->insert('order_items', $item_data);
        }
        $this->db->where('user_id', $user_info['user_id']);
        $this->db->delete('cart');
    }
}