<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
 	{
   		parent::__construct();
			$this->load->helper(array('form', 'url', 'inflector','file'));
			$this->load->library(array('session','form_validation','upload','toastr','apps'));
			$this->load->model(array('users_mdl','company_mdl','msg_mdl'));
 	}


	public function index()
	{
		if($this->session->userdata('logged_in'))
		   	{
				$session_data   			= $this->session->userdata('logged_in');
				$data['name'] 				= $session_data['name'];
				$data['user_name'] 			= $session_data['user_name'];
				$data['user_status'] 		= $session_data['user_status'];
				$data['datelogin'] 			= $session_data['datelogin'];
				$data['user_type'] 			= $session_data['user_type'];
				$data['role_id'] 			= $session_data['role_id'];
				$data['user_id'] 			= $session_data['user_id'];
				$data['module']				= $this->users_mdl->getmodule();
				$data['viewmodule']			= $this->users_mdl->viewmodule();
				$data['getdata']			= $this->users_mdl->get();
				$data['title']       		= 'company';
				$data['master']        		= 'master';

				$this->load->view('default/header', $data);
			  	$this->load->view('backend/users/index', $data);
			  	$this->load->view('default/footer', $data);
			}else{
				redirect('login', 'refresh');
			}
	}


	public function fsize($file){
    $a = array("B", "KB", "MB", "GB", "TB", "PB");
    $pos = 0;
    $size = filesize($file);
    while ($size >= 1024)
    {
    $size /= 1024;
    $pos++;
    }
    return round ($size,2)." ".$a[$pos];
    }

  	public function add()
	{
		if($this->session->userdata('logged_in'))
		   	{
				$session_data   			= $this->session->userdata('logged_in');
				$data['name'] 				= $session_data['name'];
				$data['user_name'] 			= $session_data['user_name'];
				$data['user_status'] 		= $session_data['user_status'];
				$data['datelogin'] 			= $session_data['datelogin'];
				$data['user_type'] 			= $session_data['user_type'];
				$data['role_id'] 			= $session_data['role_id'];
				$data['module']				= $this->users_mdl->getmodule();
				$data['viewmodule']			= $this->users_mdl->viewmodule();
				$data['title']       		= 'company';

				$this->load->view('default/header', $data);
			  	$this->load->view('backend/users/add', $data);
			  	$this->load->view('default/footer', $data);
			}else{
				redirect('login', 'refresh');
			}
	}


  	public function save()
	{
		if($this->session->userdata('logged_in'))
		   	{
				$session_data   			= $this->session->userdata('logged_in');
				$data['name'] 				= $session_data['name'];
				$data['user_name'] 			= $session_data['user_name'];
				$data['user_status'] 		= $session_data['user_status'];
				$data['datelogin'] 			= $session_data['datelogin'];
				$data['user_type'] 			= $session_data['user_type'];
				$data['role_id'] 			= $session_data['role_id'];
				$data['user_id'] 			= $session_data['user_id'];
				$data['user_id'] 			= $session_data['user_id'];
				$data['module']				= $this->users_mdl->getmodule();
				$data['title']       		= 'company';
				$data['aktif']        		= 'active treeview';

				if($this->input->post('id') == 1){

				$pass1  = $this->input->post('users_password1');
				$pass2  = $this->input->post('users_password2');

				if($pass1 != $pass2)
					{
						$this->apps->set_notification(3, "Passwords do NOT match!");
						redirect('admin/users');
					} else {

						$pass3 = $this->hash($this->input->post('users_password2'));
						$created = date("Y-m-d H:i:s");

						$this->db->query("INSERT INTO sys_users (name, user_name, user_password, user_status, role_id, created) 
					values ('".$this->input->post('name')."','".$this->input->post('user_name')."','".$pass3."','".$this->input->post('user_status')."','".$this->input->post('role_id')."','".$created."'); ");

						$this->apps->set_notification(1, "Users has ben save");
						redirect('admin/users');
					}

			 }elseif($this->input->post('id') == 2){ 

				$pass1  = $this->input->post('users_password1');
				$pass2  = $this->input->post('users_password2');
				$newpas = $this->hash($this->input->post('users_password2'));

				if($pass1 != $pass2)
					{
						$this->apps->set_notification(3, "Passwords do not match!");
						redirect('admin/users');
					} else {

						$pass3  = $this->input->post('users_password2');
						$modified = date("Y-m-d H:i:s");

						if($pass3 == "123"){ 

							$this->db->query("UPDATE sys_users 
										  SET 
										  	name ='".$this->input->post('name')."',
										  	user_name ='".$this->input->post('user_name')."',
										  	user_status ='".$this->input->post('user_status')."',
										  	role_id ='".$this->input->post('role_id')."',
										  	modified = '".$modified."'
		 								  WHERE user_id='".$this->input->post('user_id')."' ");

							$this->apps->set_notification(1, "Users has ben edit");
							redirect('admin/users');

						} else {

							$this->db->query("UPDATE sys_users 
										  SET 
										  	name ='".$this->input->post('name')."',
										  	user_name ='".$this->input->post('user_name')."',
										  	user_password ='".$newpas."',
										  	user_status ='".$this->input->post('user_status')."',
										  	role_id ='".$this->input->post('role_id')."',
										  	modified = '".$modified."'
		 								  WHERE user_id='".$this->input->post('user_id')."' ");

							$this->apps->set_notification(1, "Users has ben edit");
							redirect('admin/users');

						}

						

					}


			 } elseif($this->input->post('id') == 3){

			 	$pass1  = $this->input->post('users_password1');
				$pass2  = $this->input->post('users_password2');
				$newpas = $this->hash($this->input->post('users_password2'));

				if($pass1 != $pass2)
				{
					$this->apps->set_notification(3, "Passwords do not match!");
					redirect($_SERVER['HTTP_REFERER']);
				} else {

					$this->db->query("UPDATE sys_users SET user_password ='".$newpas."' WHERE user_id='".$this->input->post('user_id')."' ");

					$this->apps->set_notification(1, "Password has ben change");
					redirect('admin/users');

				}
			 }
				
			}else{
				redirect('login', 'refresh');
			}
	}


	public function hash ( $string )
    {
       return hash ('sha512', $string . config_item('encryption_key'));
    }

  	public function edit()
	{
		if($this->session->userdata('logged_in'))
		   	{
				$id 						= $this->uri->segment(4);
			    $session_data   			= $this->session->userdata('logged_in');
				$data['name'] 				= $session_data['name'];
				$data['user_name'] 			= $session_data['user_name'];
				$data['user_status'] 		= $session_data['user_status'];
				$data['datelogin'] 			= $session_data['datelogin'];
				$data['user_type'] 			= $session_data['user_type'];
				$data['user_id'] 			= $session_data['user_id'];
				$data['role_id'] 			= $session_data['role_id'];
				$data['module']				= $this->users_mdl->getmodule();
				$data['viewmodule']			= $this->users_mdl->viewmodule();
				$data['getdata']			= $this->users_mdl->get($id);
				$data['title']       		= 'company';

				$this->load->view('default/header', $data);
			  	$this->load->view('backend/users/edit', $data);
			  	$this->load->view('default/footer', $data);
			}else{
				redirect('login', 'refresh');
			}
	}


	public function setting(){
		if($this->session->userdata('logged_in'))
		   	{
				$id 						= $this->uri->segment(4);
			    $session_data   			= $this->session->userdata('logged_in');
				$data['name'] 				= $session_data['name'];
				$data['user_name'] 			= $session_data['user_name'];
				$data['user_status'] 		= $session_data['user_status'];
				$data['datelogin'] 			= $session_data['datelogin'];
				$data['user_type'] 			= $session_data['user_type'];
				$data['user_id'] 			= $session_data['user_id'];
				$data['role_id'] 			= $session_data['role_id'];
				$data['module']				= $this->users_mdl->getmodule();
				$data['viewmodule']			= $this->users_mdl->viewmodule();
				$data['getdata']			= $this->users_mdl->get($id);
				$data['title']       		= 'company';

				$this->load->view('default/header', $data);
			  	$this->load->view('backend/users/setting', $data);
			  	$this->load->view('default/footer', $data);
			}else{
				redirect('login', 'refresh');
			}

	}


}
