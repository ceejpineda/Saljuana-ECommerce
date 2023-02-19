<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Model
{
    function load_all_products()
    {
        $query = "SELECT products.id, category_name, product_name ,img_url, price, description 
                    FROM products
                    JOIN categories 
                    ON categories.id = products.category_id;";
        return $this->db->query($query)->result_array();
    }

    function load_all_products_admin()
    {
        $query = "SELECT * FROM products";
        return $this->db->query($query)->result_array();
    }

    function load_product_info($id)
    {
        $query = "SELECT products.* , category_name FROM PRODUCTS
                    JOIN CATEGORIES on categories.id = products.category_id
                    WHERE products.id = ?";
        $values = array(
                    $this->security->xss_clean($id)
                    );
        return $this->db->query($query, $values)->row_array();
    }

    function add_product($product)
    {
        $query = "INSERT INTO products(`category_id`, `product_name`, img_url, price, description, inventory_count)
            VALUES(?, ?, ?, ?, ?, ?);";
        $values = array(
            (int)$product['category_id'],
            $product['product_name'],
            $product['dir'],
            $product['product_price'],
            $product['product_desc'],
            $product['product_qty']
        );

        return $this->db->query($query, $values);
    }

    function search($post)
    {
        $this->db->select('*');
        $this->db->from('Products');
        $this->db->like('product_name', $post['product_name']);
        if(isset($post['categories'])){
            $this->db->where_in('category_id', $post['categories']);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

}