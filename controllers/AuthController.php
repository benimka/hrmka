<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthController extends CI_Controller {

	private $msg;
	private $exp_time = 300; //5 minutes private $exp_time = 3000;
	
    function __construct() {
        parent::__construct();
		$this->load->library('authlibrary');
        $this->load->library('form_validation');
        $this->load->model('authmodel');
    }
	

    private function display_msg($msg) {
        $this->msg .= $msg . nl2br("\n");
    }
	
	function index() {
		$is_logged_in = $this->authlibrary->is_logged_in();
		
		if (!$is_logged_in) {
            redirect('AuthController/login');
        } else {
			$this->load->view('home');
		}
	}
	
	function login() { 
        if ($this->input->post('login')) {
			if(get_cookie('remember')) { 
				$username = get_cookie('user_name');
				$password = get_cookie('user_password'); 
				
				if ($this->authlibrary->login($username, $password) == TRUE) { 
					$this->session->set_flashdata('login', 'You have been successfully logged in');
					$this->session->keep_flashdata('login');					
					redirect('/dashboard');
				} else {
					$errors = $this->authlibrary->get_error_message();
					$this->display_msg($errors);
				}
			} else { 
				$this->form_validation->set_rules('user_name', 'Username', 'trim|required|max_length[100]|xss_clean');
				$this->form_validation->set_rules('user_password', 'Password', 'trim|required|max_length[255]|xss_clean');
				
				if ($this->form_validation->run()) {
					$username = $this->input->post('user_name');
					$password = $this->input->post('user_password');
					$remember = $this->input->post('remember'); 
					
					if($remember) { 
						set_cookie("user_name", $username, $this->exp_time);
						set_cookie("user_password", $password, $this->exp_time);
						set_cookie("remember", $remember, $this->exp_time);
					} else { 
						delete_cookie("user_name");
						delete_cookie("user_password");
						delete_cookie("remember");
					}
					
					if ($this->authlibrary->login($username, $password) == TRUE) {
						$this->session->set_flashdata('login', 'You have been successfully logged in');
						$this->session->keep_flashdata('login');					
						redirect('/');
					} else {
						$errors = $this->authlibrary->get_error_message();
						$this->display_msg($errors);
					}
				}
			}
        }
		
        $data['errors'] = $this->msg;
        $data['msg'] = '';
		
        if ($message = $this->session->flashdata('login')) {
            $data['msg'] = $message;
        }
		
        $this->load->view('login', $data);
    }
	
    function logout() {
        if ($this->authlibrary->is_logged_in()) {
            $this->authlibrary->logout();			
            $this->session->set_flashdata('login', 'You have been successfully logged out');
            $this->session->keep_flashdata('login');
        }
        redirect('/');
    }
}