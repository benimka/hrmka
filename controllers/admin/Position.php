<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Position extends CI_Controller {

	public function __construct()
 	{
   		parent::__construct();
			$this->load->helper(array('form', 'url', 'inflector'));
			$this->load->library(array('session','form_validation','upload','toastr','pdf','apps'));
			$this->load->model(array('users_mdl','position_mdl','msg_mdl'));
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
				$data['title']       		= 'Position';
				$data['master']        		= 'master';
				$data['pic'] 				= $session_data['pic'];
				$id 						= $this->uri->segment(2);
				$querys 					= $_GET['query'];
				$data['filter']				= $_GET['query'];
				$data['getcompany']			= $this->position_mdl->getcompany();
				$data['getdepartment']		= $this->position_mdl->getdepartment();
				$data['getdata']			= $this->position_mdl->getdata($querys);
				$data['actions']			= $this->position_mdl->actions();
				
				$userInfo = $this->users_mdl->user_info($id); 

		        if($userInfo=="")
		        {   
		            $this->load->view('backend/notfound', $data);
		        } else { 
		            $this->load->view('default/header', $data);
				  	$this->load->view('backend/position/index', $data);
				  	$this->load->view('default/footer', $data);
		        }

			}else{
				redirect('login', 'refresh');
			}
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
				$data['user_id'] 			= $session_data['user_id'];
				$data['title']       		= 'Position';
				$data['master']        		= 'master';
				$data['pic'] 				= $session_data['pic'];
				$id 						= $this->uri->segment(2);
				$querys 					= $this->input->post('company');
				$data['company']			= $this->input->post('company');
				$data['getcompany']			= $this->position_mdl->getcompany();
				$data['getdata']			= $this->position_mdl->getdata($querys);
				$data['actions']			= $this->position_mdl->actions();
				$data['autoCode']			= $this->position_mdl->GetCode($querys);
				
				$userInfo = $this->users_mdl->user_info($id); 

		        if($userInfo=="")
		        {   
		            $this->load->view('backend/notfound', $data);
		        } else { 
		            $this->load->view('default/header', $data);
				  	$this->load->view('backend/position/add', $data);
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
							'position_code'     => $this->input->post('position_code'),
							'company_code'		=> $this->input->post('company_code'),
							'department_code'	=> $this->input->post('department_code'),
							'position_name'		=> $this->input->post('position_name'),
							'pos_inisial'		=> $this->input->post('pos_inisial'),
							'levels'			=> 1,
							'users_id'		    => $session_data['user_id']
						);

					$this->position_mdl->save($item);

	    			$this->load->library('user_agent');
					$logs   = array (
						"log_date"			 	=> 	date("Y-m-d"),
						"log_description"		=> 	"Add Position (".$this->input->post('doc_name').")",
						"user_id"				=> 	$session_data['user_id'],
						"browser" 				=> 	$this->agent->browser(),
						"ip" 					=>  $this->input->ip_address(),
						"platform" 				=> 	$this->agent->platform(),
						"created"				=>	date("Y-m-d H:i:s"),
						"modified"				=>	date("Y-m-d H:i:s")
						);
					# -------------------------
					$this->db->insert("sys_logs", $logs);

					$this->apps->set_notification(1, "Location name has been save");
					redirect('admin/position/');

				} else {

					$item = array (
							'company_code'		=> $this->input->post('doc_company_code'),
							'department_code'	=> $this->input->post('doc_department_code'),
							'position_name'		=> $this->input->post('doc_position_name'),
							'pos_inisial'		=> $this->input->post('doc_pos_inisial')
						);

					$primary = array (
							'position_code'       => $this->input->post('doc_position_code')
					);

					$this->position_mdl->edit($primary,$item);

	    			$this->load->library('user_agent');
					$logs   = array (
						"log_date"=>date("Y-m-d"),
						"log_description"=>"Update position (".$this->input->post('doc_name').")",
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
					redirect('admin/position/');

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

				$this->db->query("DELETE FROM mod_position WHERE position_id ='".$this->uri->segment(4)."'");
	            $this->apps->set_notification(1, "Successfully! Position has ben delete");
				redirect('admin/position');
				
			}else{
				redirect('login', 'refresh');
			}
	}


}
