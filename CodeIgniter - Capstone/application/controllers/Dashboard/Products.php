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
            $products = $this->Product->load_all_products_admin();
            $data['products'] = $products;
            $this->load->view('dashboard/products', $data);
        }
    }

    public function process_add() {
        $post = $this->input->post(NULL, TRUE);
        var_dump($post);

        if (!empty($_FILES['product_img_file']['name'][0])) {
            // Files were uploaded, so process them

            $folder_name = $post['product_name'];

            //FCPATH is the root of CodeIgniter
            $upload_path = FCPATH . 'assets/uploads/' . $folder_name . '/';
            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = 'png|jpg|jpeg';
            $config['max_size'] = '2048'; // 2MB
            $config['encrypt_name'] = TRUE;
            $config['remove_spaces'] = TRUE;
        
            /* Create directory if it does not exist
                If it is already created, meaning there is a Duplicate Named Product*/
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, true);
            }else{
                echo "Duplicate Item";
                return;
            }
        
            $this->load->library('upload', $config);
        
            $files_data = array();
            for ($i = 0; $i < count($_FILES['product_img_file']['name']); $i++) {
                $_FILES['file']['name'] = $_FILES['product_img_file']['name'][$i];
                $_FILES['file']['type'] = $_FILES['product_img_file']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['product_img_file']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['product_img_file']['error'][$i];
                $_FILES['file']['size'] = $_FILES['product_img_file']['size'][$i];
                if ($this->input->post('main_image') == $i) {
                    // This file is selected as the main image
                    $new_file_name = '0.jpg';
                    $main_image_index = $file_counter;
                } else {
                    // This file is not selected as the main image
                    $new_file_name = $file_counter . '.' . pathinfo($_FILES['product_img_file']['name'][$i], PATHINFO_EXTENSION);
                }
        
                // Upload the file
                $this->upload->initialize($config);
                $this->upload->file_name_override = $new_file_name;
                if (!$this->upload->do_upload('file')) {
                    // File upload failed
                    $error = $this->upload->display_errors();
                    echo $error;
                } else {
                    // File upload succeeded, get the file path
                    $file_data = $this->upload->data();
                    $file_path = 'assets/uploads/' . $folder_name . '/';
                    $files_data[] = $file_path;
                }
            }
            
            /* When files are successfully uploaded the directory and details of the product
                Would be saved in the Database. (Lessens the error checking and querying in database)*/
            $post['dir'] = $file_path;
            $this->Product->add_product($post);
            redirect('dashboard/products');
            
        } else {
            // No files were uploaded
            echo "You did not select any files to upload.";
        }
      }




}
