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

    function create_category($category_name)
    {
        $data = array(
            'category_name' => $category_name
        );

        // Insert the new category into the database
        $this->db->insert('categories', $data);

        // Get the ID of the inserted category
        $category_id = $this->db->insert_id();

        return $category_id;
    }
}