<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model
{

    function get_user_by_email($email)
    { 
        $query = "SELECT * FROM Users WHERE email=?";
        return $this->db->query($query, $email)->row_array();
    }

    function create_user($user)
    {
        $query = "INSERT INTO users (first_name, last_name, email, password, salt) VALUES (?,?,?,?,?)";
        $salt = bin2hex(openssl_random_pseudo_bytes(22)); 
        $values = array(
            $user['first_name'], 
            $user['last_name'], 
            $user['email'], 
            md5($user["password"] . '' . $salt),
            $salt,
        ); 
        
        return $this->db->query($query, $values);
    }

    function validate_registration($email)
    {
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');        
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
        if(!$this->form_validation->run()) {
            return validation_errors();
        }
        else if($this->get_user_by_email($email)) {
            return "Email already taken.";
        }
    }

    function validate_signin_form() {
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
    
        if(!$this->form_validation->run()) {
            return validation_errors();
        } 
        else {
            return "success";
        }
    }

    function validate_signin_match($user, $password) 
    {
        $hashed_password = md5($password.''.$user['salt']);


        if($user && $user['password'] == $hashed_password) {
            return "success";
        }
        else {
            return "Incorrect email/password.";
        }
    }
}
?>