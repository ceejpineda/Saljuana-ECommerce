<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Review extends CI_Model
{
    function insert_review($post)
    {
        $query = "INSERT INTO reviews(user_id, product_id, review, rating)
                    VALUES(?, ?, ?, ?)";

        $values = array(
            $this->session->userdata('user_id'),
            $post['product_id'],
            $post['review'],
            $post['rating'],
        );

        return $this->db->query($query, $values);
    }

    function get_review_by_product_id($id)
    {
        $query = "SELECT reviews.*, first_name, last_name
                    FROM reviews
                    JOIN users ON reviews.user_id = users.id
                    WHERE reviews.product_id = ?
                    ORDER BY created_at DESC;";
        $values = array($id);
        return $this->db->query($query, $values)->result_array();
    }
}