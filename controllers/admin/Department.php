<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Department extends CI_Controller {

	public function __construct()
 	{
   		parent::__construct();
			$this->load->helper(array('form', 'url', 'inflector','file'));
			$this->load->library(array('session','form_validation','upload','toastr','apps','encrypt'));
			$this->load->model(array('users_mdl','company_mdl','msg_mdl','announcements_mdl','assets_mdl','bank_mdl','department_mdl'));
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
				$data['title']       		= 'List Of Department';
				$data['master']        		= 'master';
				$data['pic'] 				= $session_data['pic'];
				$id 						= $this->uri->segment(2);
				$data['getdata']			= $this->department_mdl->GetData();
				$data['actions']			= $this->department_mdl->actions();
				
				$userInfo = $this->users_mdl->user_info($id); 

		        if($userInfo=="")
		        {   
		            $this->load->view('backend/notfound', $data);
		        } else { 
		            $this->load->view('default/header', $data);
				  	$this->load->view('backend/department/index', $data);
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
				$data['company_code'] 		= $session_data['company_code'];
				$data['user_type'] 			= $session_data['user_type'];
				$data['role_id'] 			= $session_data['role_id'];
				$data['user_id'] 			= $session_data['user_id'];
				$data['pic'] 				= $session_data['pic'];
				$data['getdata']			= $this->department_mdl->GetData();
				$data['title']       		= 'Add Department';
				$data['master']        		= 'master';

				$segment2 					= $this->uri->segment(2);
				$segment3 					= $this->uri->segment(3);
				$data['company']			= $this->input->post('company_code'); 
				$companyCode 				= $this->input->post('company_code'); 
				$data['autoCode']			= $this->department_mdl->GetCode($companyCode);

				$userInfo = $this->users_mdl->user_info($segment2,$segment3); 

		        if($userInfo=="")
		        {   
		            $this->load->view('backend/notfound', $data);
		        } else { 
		            $this->load->view('default/header', $data);
				  	$this->load->view('backend/department/add', $data);
				  	$this->load->view('default/footer', $data);
		        }
			}else{
				redirect('login', 'refresh');
			}
	}

	
	public function edit($numbers)
	{	
		if($this->session->userdata('logged_in'))
		   	{
				$session_data   			= $this->session->userdata('logged_in');
				$data['name'] 				= $session_data['name'];
				$data['user_name'] 			= $session_data['user_name'];
				$data['user_status'] 		= $session_data['user_status'];
				$data['datelogin'] 			= $session_data['datelogin'];
				$data['company_code'] 		= $session_data['company_code'];
				$data['user_type'] 			= $session_data['user_type'];
				$data['role_id'] 			= $session_data['role_id'];
				$data['user_id'] 			= $session_data['user_id'];
				$data['pic'] 				= $session_data['pic'];
				$data['getdata']			= $this->department_mdl->GetData($numbers);
				$data['title']       		= 'Edit Department';
				$data['master']        		= 'master';

				$segment2 					= $this->uri->segment(2);
				$segment3 					= $this->uri->segment(3);

				$userInfo = $this->users_mdl->user_info($segment2,$segment3); 

		        if($userInfo=="")
		        {   
		            $this->load->view('backend/notfound', $data);
		        } else { 
		            $this->load->view('default/header', $data);
				  	$this->load->view('backend/department/edit', $data);
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
				$session_data   		= $this->session->userdata('logged_in');
			    $data['name'] 			= $session_data['name'];
			    $data['user_name'] 	    = $session_data['user_name'];
				$data['user_status']    = $session_data['user_status'];
				$data['user_type'] 	    = $session_data['user_type'];


				if($this->input->post('ids') == 1){

					$item = array (
							'department_code'       => $this->input->post('department_code'),
							'company_code'       	=> $this->input->post('company_code'),
							'department_name'       => $this->input->post('department_name'),
							'department_inisial'    => $this->input->post('department_inisial'),
							'created'				=> date("Y-m-d H:i:s"),
							"users_id" 				=> $session_data['user_id']
							
						);

					$this->department_mdl->save($item);

					$this->load->library('user_agent');
					$logs   = array (
						"log_date"=>date("Y-m-d"),
						"log_description"=>"add Department (".$this->input->post('department_name').")",
						"user_id"=> $session_data['user_id'],
						"browser" => $this->agent->browser(),
						"ip" =>  $this->input->ip_address(),
						"platform" => $this->agent->platform(),
						"created"=>date("Y-m-d H:i:s"),
						"modified"=>date("Y-m-d H:i:s")
						);
					# -------------------------
					$this->db->insert("sys_logs", $logs);

					
					$this->apps->set_notification(1, "Successfully! Data has ben save");
					redirect('admin/department');

				}else {

					$data=array(
			      		
			      		'department_name'       => $this->input->post('department_name'),
			      		"modified"				=> date("Y-m-d H:i:s"),
						"users_id" 				=> $session_data['user_id']
			        );

					
					$primary = array(
						'department_id'  => $this->input->post('department_id')
					);

					$this->department_mdl->update($primary,$data);


					$this->load->library('user_agent');
					$logs   = array (
						"log_date"=>date("Y-m-d"),
						"log_description"=>"edit Department (".$this->input->post('department_name').") (".$this->input->post('company_name').")",
						"user_id"=> $session_data['user_id'],
						"browser" => $this->agent->browser(),
						"ip" =>  $this->input->ip_address(),
						"platform" => $this->agent->platform(),
						"created"=>date("Y-m-d H:i:s"),
						"modified"=>date("Y-m-d H:i:s")
						);
					# -------------------------
					$this->db->insert("sys_logs", $logs);

					$this->apps->set_notification(1, "Successfully! Data has ben update");
					redirect('admin/department');

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
			    $data['name'] 			= $session_data['name'];
			    $data['user_name'] 	    = $session_data['user_name'];
				$data['user_status']    = $session_data['user_status'];
				$data['user_type'] 	    = $session_data['user_type'];

				$segment2 					= $this->uri->segment(2);
				$segment3 					= $this->uri->segment(3);

				$userInfo = $this->users_mdl->user_info($segment2,$segment3); 

		        if($userInfo=="")
		        {   
		            $this->load->view('backend/notfound', $data);
		        } else { 

		        	$this->db->query("DELETE FROM mod_department WHERE department_id ='".$this->uri->segment(4)."'");
		            $this->apps->set_notification(1, "Successfully! Data has ben delete");
					redirect('admin/department');
		        }
				
			}else{
				redirect('login', 'refresh');
			}
	}

}
