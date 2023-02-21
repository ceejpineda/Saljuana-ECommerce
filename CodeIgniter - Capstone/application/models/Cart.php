<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Model 
{
    protected $table = 'cart_items';

    function get_count()
    {   $query = 'SELECT count(*) as count FROM cart_items WHERE user_id = ?';
        $value = array($this->session->userdata('user_id'));
        return $this->db->query($query, $value)->row_array()['count'];
    }

    function insert_to_cart_items($data)
    {
        $existing_cart_item = $this->db->get_where('cart_items', array('user_id' => $data['user_id'], 'product_id' => $data['product_id']))->row();

        if ($existing_cart_item) {
            $new_qty = $existing_cart_item->qty + $data['qty'];
            $this->db->where('id', $existing_cart_item->id);
            $this->db->update('cart_items', array('qty' => $new_qty));
            return $existing_cart_item->id;
        } else {
            $query = "INSERT INTO cart_items(user_id, product_id, qty)
                        VALUES(?, ?, ?);";
            $values = array($data['user_id'], $data['product_id'], $data['qty']);
            $this->db->query($query, $values);

        }
    }

    function get_user_cart($id)
    {
        $query = "SELECT product_id, product_name, price, cart_items.qty
                    FROM cart_items
                    JOIN products ON cart_items.product_id = products.id
                    WHERE cart_items.user_id = ?";
        $value = array($id);

        return $this->db->query($query, $value)->result_array();
    }
}