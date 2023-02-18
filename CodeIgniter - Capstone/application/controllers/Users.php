<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller 
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User');
    }

    public function login()
    {
        $post_data = $this->input->post(NULL, TRUE); 
		$email = $post_data['email'];
        $result = $this->User->validate_signin_form($post_data);
        if($result != 'success') {
            $this->session->set_flashdata('input_errors', $result);
            redirect("login_page");
        } 
        else 
        {
            $email = $this->input->post('email');
            $user = $this->User->get_user_by_email($email);
            
            $result = $this->User->validate_signin_match($user, $this->input->post('password'));
            
            if($result == "success") 
            {
                $this->session->set_userdata(
                    array(
                        'user_id'=>$user['id'], 
                        'first_name'=>$user['first_name'],
                        'is_admin'=>$user['is_admin'])
                    );            
                redirect("dashboard/orders");
            }
            else 
            {
                $this->session->set_flashdata('input_errors', $result);
                redirect("login_page");
            }
        }
    }

    public function register()
    {
        $post = $this->input->post(NULL, TRUE);
		$email = $post['email']; 
        $result = $this->User->validate_registration($email);

		if($result!=null)
        {
            $this->session->set_flashdata('input_errors', $result);
            redirect("register_page");
        }
        else
        {
            $this->User->create_user($post);
            $this->session->set_flashdata('success_message', 'SUCCESSFULLY REGISTERED!');
            redirect("login_page");
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('/');
    }

}

?>