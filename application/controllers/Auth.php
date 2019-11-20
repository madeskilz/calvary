<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        redirect("auth/login");
    }
    public function login()
    {
        if ($this->uri->uri_string() == 'auth/login')
            show_404();
        isLoggedIn();
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            $this->auth();
        }
        $p["title"] = "Portal Login";
        $p["active"] = "home";
        $this->load->view('home/login', $p);
    }
    private function auth()
    {
        $email    = cleanit($this->input->post('email'));
        $password = md5(cleanit($this->input->post('password')));
        $validate = $this->login_model->validate($email, $password);
        if ($validate->num_rows() > 0) {
            $data  = $validate->row_array();
            $user_id  = $data['user_id'];
            $email = $data['user_email'];
            $level = $data['user_level'];
            $active  = $data['active'];
            $sesdata = array(
                'user_id'  => $user_id,
                'email'     => $email,
                'level'     => $level,
                'active'     => $active,
                'logged_in' => TRUE
            );
            $this->session->set_userdata($sesdata);
            isLoggedIn();
        } else {
            $this->session->set_flashdata('error_msg', 'Username or Password is Wrong');
            redirect('login');
        }
    }
    function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}
