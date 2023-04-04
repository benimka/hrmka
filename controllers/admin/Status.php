<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Status extends CI_Controller {

	public function __construct()
 	{
   		parent::__construct();
			$this->load->helper(array('form', 'url', 'inflector'));
			$this->load->library(array('session','form_validation','upload','toastr','pdf','apps'));
			$this->load->model(array('users_mdl','status_mdl','msg_mdl'));
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
				$data['title']       		= 'Status';
				$data['master']        		= 'master';
				$data['pic'] 				= $session_data['pic'];
				$id 						= $this->uri->segment(2);
				$data['getdata']			= $this->status_mdl->getdata();
				$data['actions']			= $this->status_mdl->actions();
				$data['auto']   			= $this->status_mdl->GetCode();
				
				$userInfo = $this->users_mdl->user_info($id); 

		        if($userInfo=="")
		        {   
		            $this->load->view('backend/notfound', $data);
		        } else { 
		            $this->load->view('default/header', $data);
				  	$this->load->view('backend/status/index', $data);
				  	$this->load->view('default/footer', $data);
		        }

			}else{
				redirect('login', 'refresh');
			}
	}


  	public function save()
	{
		if($this->session->userdata('logged_in'))
		   	{
				$session_data   			= $this->session->userdata('logged_in');

				if($this->input->post('ids') == 1){ 

					$item = array (
							'mod_status_code'     => $this->input->post('mod_status_code'),
							'mod_status_name'	  => $this->input->post('mod_status_name')
						);

					$this->status_mdl->save($item);

	    			$this->load->library('user_agent');
					$logs   = array (
						"log_date"			 	=> 	date("Y-m-d"),
						"log_description"		=> 	"Add Status (".$this->input->post('mod_status_name').")",
						"user_id"				=> 	$session_data['user_id'],
						"browser" 				=> 	$this->agent->browser(),
						"ip" 					=>  $this->input->ip_address(),
						"platform" 				=> 	$this->agent->platform(),
						"created"				=>	date("Y-m-d H:i:s"),
						"modified"				=>	date("Y-m-d H:i:s")
						);
					# -------------------------
					$this->db->insert("sys_logs", $logs);

					$this->apps->set_notification(1, "Status name has been save");
					redirect('admin/status/');

				} else {

					$item = array (
							'mod_status_name'		=> $this->input->post('doc_mod_status_name')
						);

					$primary = array (
							'mod_status_code'        => $this->input->post('doc_mod_status_code')
					);

					$this->status_mdl->edit($primary,$item);

	    			$this->load->library('user_agent');
					$logs   = array (
						"log_date"=>date("Y-m-d"),
						"log_description"=>"Update status (".$this->input->post('doc_name').")",
						"user_id"=> $session_data['user_id'],
						"browser" => $this->agent->browser(),
						"ip" =>  $this->input->ip_address(),
						"platform" => $this->agent->platform(),
						"created"=>date("Y-m-d H:i:s"),
						"modified"=>date("Y-m-d H:i:s")
						);
					# -------------------------
					$this->db->insert("sys_logs", $logs);

					$this->apps->set_notification(1, "Position name has been update");
					redirect('admin/status/');

				}
				
				
			}else{
				redirect('login', 'refresh');
			}
	}


	public function delete()
	{ 
		if($this->session->userdata('logged_in'))
		   	{
				$session_data   		= $this->session->userdata('logged_in');

				$this->db->query("DELETE FROM mod_employee_status WHERE mod_status_code ='".$this->uri->segment(4)."'");
	            $this->apps->set_notification(1, "Successfully! Status has ben delete");
				redirect('admin/status');
				
			}else{
				redirect('login', 'refresh');
			}
	}


}
