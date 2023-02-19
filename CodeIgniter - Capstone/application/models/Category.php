<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Model
{
    function load_all_category_name()
    {
        $query = "SELECT id, category_name FROM categories";
        return $this->db->query($query)->result_array();
    }

    function load_all_category_count()
    {
        $query = "SELECT categories.id, category_name, COUNT(products.id) as count 
                    FROM categories 
                    LEFT JOIN products ON categories.id = products.category_id 
                    GROUP BY categories.id";
        return $this->db->query($query)->result_array();
    }
}