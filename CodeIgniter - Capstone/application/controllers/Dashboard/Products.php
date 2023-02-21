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
            $pages = ceil(count($products)/5);
            $paged_products = array_slice($products, 0, 5);
            $data['products'] = $paged_products;
            $data['pages'] = $pages;
            //$data['products'] = $products;
            $this->load->view('dashboard/products', $data);
        }
    }

    public function index_html()
    {
        if($this->session->userdata('is_admin') != 1)
        {
            redirect('/');
        }
        else
        {
            $products = $this->Product->load_all_products_admin();
            $data['products'] = $products;
            $this->load->view('partials/admin_products', $data);
        }
    }

    public function do_search()
    {
        $post = $this->input->post(NULL, TRUE);
        $products = $this->Product->search_admin_products($post);
        $products_info = array();

        foreach($products as $product)
        {
            $directory = $product['img_url'];
            if(isset($directory)) $url = scandir($directory);
            $file = $url[2];
            $product['url'] = $directory . '/' . $file;
            $products_info[] = $product;
        }
        //$data['products'] = $products_info;
        $pages = ceil(count($products)/5);
		$page_number = $this->input->post('page')-1;
		$paged_products = array_slice($products_info, $page_number*5, 5); 
		$data['products'] = $paged_products;
		$data['pages'] = $pages;
        //var_dump($data);
        $this->load->view('partials/admin_products', $data);
    }

    public function process_add() {
        $post = $this->input->post(NULL, TRUE);

        if (!empty($_FILES['product_img_file']['name'][0])) {
            // Files were uploaded, so process them

            $folder_name = $post['product_name'];

            //FCPATH is the root of CodeIgniter
            $upload_path = FCPATH . 'assets/uploads/' . $folder_name . '/';
            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = 'png|jpg|jpeg';
            $config['max_size'] = '2048'; // 2MB
            $config['remove_spaces'] = TRUE;
            $this->load->library('upload', $config);
            /* Create directory if it does not exist
                If it is already created, meaning there is a Duplicate Named Product*/
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, true);
            }else{
                echo "Duplicate Item";
                return;
            }
        
            $files_data = array();
            for ($i = 0; $i < count($_FILES['product_img_file']['name']); $i++) {
                $_FILES['file']['name'] = $i.'.jpg';
                $_FILES['file']['type'] = $_FILES['product_img_file']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['product_img_file']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['product_img_file']['error'][$i];
                $_FILES['file']['size'] = $_FILES['product_img_file']['size'][$i];
                if ($this->input->post('main_image') == $i) {
                    // This file is selected as the main image
                    $new_file_name = 'main.jpg';
                    $main_image_index = $i;
                } else {
                    // This file is not selected as the main image
                    $new_file_name = 'sub' . $i . '.' . pathinfo($_FILES['product_img_file']['name'][$i], PATHINFO_EXTENSION);
                }
        
                // Upload the file
                $config['file_name'] = $new_file_name;
                $this->upload->initialize($config);
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
            $products = $this->Product->load_all_products_admin();
            $data['products'] = $products;
            $this->index();
        } else {
            // No files were uploaded
            echo "You did not select any files to upload.";
        }
      }

    public function delete($id)
    {
        $this->Product->delete_by_id($id);
        $products = $this->Product->load_all_products_admin();
        $data['products'] = $products;
        $this->load->view('partials/admin_products', $data);

    }

    public function edit_data($id)
    {
        echo json_encode($this->Product->get_edit_data($id));
    }



}
