<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product');
    }
    public function index()
    {
        if($this->session->userdata('is_admin') != 1)
        {
            redirect('/');
        }
        else
        {
            $this->load->view('dashboard/products');
        }
    }

    public function process_add() {
        // Load the file uploading library
        if (!empty($_FILES['product_img_file']['name'][0])) {
            $files = $_FILES['product_img_file'];
            $errors = array();
            $success = array();
        
            $config['upload_path'] = FCPATH . 'assets/uploads/';
            $config['allowed_types'] = 'png|jpg|jpeg';
            $config['max_size'] = '2048'; // 2MB
            $config['encrypt_name'] = TRUE;
        
            $this->load->library('upload', $config);
        
            foreach ($files['name'] as $key => $value) {
                $_FILES['product_img_file[]']['name'] = $files['name'][$key];
                $_FILES['product_img_file[]']['type'] = $files['type'][$key];
                $_FILES['product_img_file[]']['tmp_name'] = $files['tmp_name'][$key];
                $_FILES['product_img_file[]']['error'] = $files['error'][$key];
                $_FILES['product_img_file[]']['size'] = $files['size'][$key];
        
                if (!$this->upload->do_upload('product_img_file[]')) {
                    // File upload failed
                    $errors[] = $this->upload->display_errors();
                } else {
                    // File upload succeeded, get the file path
                    $file_data = $this->upload->data();
                    $file_path = 'assets/uploads/' . $file_data['file_name'];
                    // do something with $file_path
                    $success[] = $file_path;
                }
            }
        
            if (!empty($errors)) {
                echo implode("<br>", $errors);
            } else {
                echo "Files uploaded successfully!";
                print_r($success);
            }
        } else {
            // No files were uploaded
            echo "You did not select a file to upload.";
        }
      }




}
