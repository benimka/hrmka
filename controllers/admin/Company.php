<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends CI_Controller {

	public function __construct()
 	{
   		parent::__construct();
			$this->load->helper(array('form', 'url', 'inflector','file'));
			$this->load->library(array('session','form_validation','upload','toastr','apps','encrypt'));
			$this->load->model(array('users_mdl','company_mdl','msg_mdl','announcements_mdl','assets_mdl','bank_mdl'));
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
				$data['title']       		= 'List Of Company';
				$data['master']        		= 'master';
				$data['pic'] 				= $session_data['pic'];
				$id 						= $this->uri->segment(2);
				$data['getdata']			= $this->company_mdl->GetData();
				$data['actions']			= $this->company_mdl->actions();
				
				$userInfo = $this->users_mdl->user_info($id); 

		        if($userInfo=="")
		        {   
		            $this->load->view('backend/notfound', $data);
		        } else { 
		            $this->load->view('default/header', $data);
				  	$this->load->view('backend/company/index', $data);
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
				$data['getdata']			= $this->announcements_mdl->GetData();
				$data['title']       		= 'Add Company';
				$data['master']        		= 'master';

				$segment2 					= $this->uri->segment(2);
				$segment3 					= $this->uri->segment(3);

				$userInfo = $this->users_mdl->user_info($segment2,$segment3); 

		        if($userInfo=="")
		        {   
		            $this->load->view('backend/notfound', $data);
		        } else { 
		            $this->load->view('default/header', $data);
				  	$this->load->view('backend/company/add', $data);
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
				$data['getdata']			= $this->company_mdl->GetData($numbers);
				$data['title']       		= 'Add Company';
				$data['master']        		= 'master';

				$segment2 					= $this->uri->segment(2);
				$segment3 					= $this->uri->segment(3);

				$userInfo = $this->users_mdl->user_info($segment2,$segment3); 

		        if($userInfo=="")
		        {   
		            $this->load->view('backend/notfound', $data);
		        } else { 
		            $this->load->view('default/header', $data);
				  	$this->load->view('backend/company/edit', $data);
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

					$item=array(
			      		'company_code'       => $this->input->post('company_code'),
			      		'company_name'       => $this->input->post('company_name'),
			      		'inisial'            => $this->input->post('inisial'),
			      		'company_address'    => $this->input->post('company_address'),
			      		'company_phone'      => $this->input->post('company_phone'),
			      		'company_fax'        => $this->input->post('company_fax'),
			      		'company_email'      => $this->input->post('company_email'),
			      		'company_npwp'       => $this->input->post('company_npwp'),
			      		'company_pic'        => $this->input->post('company_pic')
			        );

					$this->company_mdl->save($item);

					$this->load->library('user_agent');
					$logs   = array (
						"log_date"=>date("Y-m-d"),
						"log_description"=>"add company (".$this->input->post('bank_name').")",
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
					redirect('admin/company');

				}else {

					$data=array(
			      		'company_code'       => $this->input->post('company_code'),
			      		'company_name'       => $this->input->post('company_name'),
			      		'inisial'            => $this->input->post('inisial'),
			      		'company_address'    => $this->input->post('company_address'),
			      		'company_phone'      => $this->input->post('company_phone'),
			      		'company_fax'        => $this->input->post('company_fax'),
			      		'company_email'      => $this->input->post('company_email'),
			      		'company_npwp'       => $this->input->post('company_npwp'),
			      		'company_pic'        => $this->input->post('company_pic')
			        );

					
					$primary = array(
						'company_id'  => $this->input->post('company_id')
					);

					$this->company_mdl->update($primary,$data);


					$this->load->library('user_agent');
					$logs   = array (
						"log_date"=>date("Y-m-d"),
						"log_description"=>"edit company (".$this->input->post('company_code').") (".$this->input->post('company_name').")",
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
					redirect('admin/company');

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

		        	$this->db->query("DELETE FROM mod_company WHERE company_id ='".$this->uri->segment(4)."'");
		            $this->apps->set_notification(1, "Successfully! Data has ben delete");
					redirect('admin/company');
		        }
				
			}else{
				redirect('login', 'refresh');
			}
	}

}
