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

    function add()
    {
        
    }

}