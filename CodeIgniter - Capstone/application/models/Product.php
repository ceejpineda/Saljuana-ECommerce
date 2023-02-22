<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Model
{
    function load_all_products()
    {
        $query = "SELECT products.id, category_name, product_name ,img_url, price, description, category_id 
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
        $values = array($this->security->xss_clean($id));
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
        if($post['sort_by'] == 0){
            $this->db->order_by('price', 'ASC');
        }else if($post['sort_by'] == 1){
            $this->db->order_by('price', 'DESC');
        }else if($post['sort_by'] == 2){
            $this->db->order_by('qty_sold', 'DESC');
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    function search_admin_products($post)
    {
        $this->db->select('products.*, category_name');
        $this->db->from('Products');
        $this->db->join('Categories', 'Products.category_id = Categories.id');
        $this->db->like('product_name', $post['admin_search']);
        $this->db->or_like('products.id', $post['admin_search']);
        $this->db->or_like('category_name', $post['admin_search']);
        $query = $this->db->get();
        return $query->result_array();
    }

    function load_similar($id)
    {
        $query = "SELECT * FROM products WHERE category_id = ? ORDER BY id DESC";
        $value = array($id);
        return $this->db->query($query, $value)->result_array();
    }

    function get_edit_data($id)
    {
        $query = "SELECT products.*, category_name FROM products
                    JOIN categories
                    ON products.category_id = categories.id 
                    WHERE products.id = ?";
        $value = array($id);
        return $this->db->query($query, $value)->row_array();
    }

    function delete_by_id($id)
    {
        $query = "DELETE FROM products 
                    WHERE id = ?";
        $values = array($id);

        return $this->db->query($query, $values);
    }

    function edit_product($post)
    {
        $query = "UPDATE products SET
                    product_name = ?,
                    category_id = ?,
                    price = ?,
                    `description` = ?,
                    inventory_count = ?,
                    updated_at = NOW()
                    WHERE id = ?";
        $values = array(
                $post['product_name'], $post['category_id'],
                $post['product_price'], $post['product_desc'],
                $post['product_qty'], $post['product_edit_id']
        );
        return $this->db->query($query, $values);
    }

}