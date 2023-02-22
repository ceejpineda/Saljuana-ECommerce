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

    function get_order($id)
    {
        $query = " SELECT orders.*, first_name, last_name FROM orders 
                    JOIN users
                    WHERE orders.id = ?";
        $value = array($this->security->xss_clean($id));
        $data = $this->db->query($query, $value)->row_array();

        $query2 = "SELECT order_items.product_id, order_items.qty, order_items.price_when_ordered,
                        order_items.name_when_ordered
                        FROM orders 
                        JOIN order_items 
                        ON orders.id = order_items.order_id
                        WHERE order_items.order_id = ?
                        ORDER BY product_id ASC";

        $data2 = $this->db->query($query2, $value)->result_array();

        $data['order_items'] =  $data2;
        return $data;
    }

    function update_db_status($post)
    {
        $query = "UPDATE orders SET status = ? WHERE id = ?";
        if($post['admin_orders_status'] == '1')
        {
            $status = 'pending';
        }
        else if($post['admin_orders_status'] == '2')
        {
            $status = 'shipped';
        }
        else if($post['admin_orders_status'] == '3')
        {
            $status = 'cancelled';
        }
        $values = array($status, $post['order_id']);
        return $this->db->query($query, $values);
    }

    function search_admin_order($post)
    {
        $this->db->select('orders.*, first_name, last_name');
        $this->db->from('Orders');
        $this->db->join('Users', 'orders.user_id = users.id');
        if($post['admin_orders_status'] != '0'){
            $this->db->group_start();
            $this->db->like('first_name', $post['admin_orders_search']);
            $this->db->or_like('address', $post['admin_orders_search']);
            $this->db->group_end();
            $this->db->like('status', $post['admin_orders_status']);
        }else{
            $this->db->like('first_name', $post['admin_orders_search']);
            $this->db->or_like('address', $post['admin_orders_search']);
        }
        $query = $this->db->get();
        return $query->result_array();
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
            $product_id = $item['product_id'];
            $product_qty = $item['qty'];
            $this->db->set('qty_sold', 'qty_sold+'.$product_qty, FALSE);
            $this->db->set('inventory_count', 'inventory_count-'.$product_qty, FALSE);
            $this->db->where('id', $product_id);
            $this->db->update('products');
        }
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $this->db->delete('cart_items');
    }
}