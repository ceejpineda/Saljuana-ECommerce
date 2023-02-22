<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reviews extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Review');
    }

    public function post_review()
    {
        $post = $this->input->post(NULL, TRUE);
        if(!isset($post['rating'])){
            $post['rating'] = 0;
        }
        $this->Review->insert_review($post);
        var_dump($post);
    }
}