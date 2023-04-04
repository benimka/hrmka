<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leaves_setting extends CI_Controller {

	public function __construct()
 	{
   		parent::__construct();
			$this->load->helper(array('form', 'url', 'inflector','file'));
			$this->load->library(array('session','form_validation','upload','toastr','apps','encrypt'));
			$this->load->model(array('users_mdl','company_mdl','msg_mdl','leaves_setting_mdl'));
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
				$data['title']       		= 'Leave Setting';
				$data['master']        		= 'master';
				$data['pic'] 				= $session_data['pic'];
				$id 						= $this->uri->segment(2);
				$data['getdata']			= $this->leaves_setting_mdl->getdata();
				$data['actions']			= $this->leaves_setting_mdl->actions();
				
				$userInfo = $this->users_mdl->user_info($id); 

		        if($userInfo=="")
		        {   
		            $this->load->view('backend/notfound', $data);
		        } else { 
		            $this->load->view('default/header', $data);
				  	$this->load->view('backend/leave/leave_setting', $data);
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
						'type'      		=> $this->input->post('type'),
						'description'       => $this->input->post('description'),
						'tgl'      			=> $this->input->post('tgl'),
						'created_at'	    => date("Y-m-d H:i:s"),
						'user_id' 			=> $session_data['user_id']
			        );

					$this->leaves_setting_mdl->save($item);

					$this->load->library('user_agent');
					$logs   = array (
						"log_date"=>date("Y-m-d"),
						"log_description"=>"add Leave setting (".$this->input->post('type').")",
						"user_id"=> $session_data['user_id'],
						"browser" => $this->agent->browser(),
						"ip" =>  $this->input->ip_address(),
						"platform" => $this->agent->platform(),
						"created"=>date("Y-m-d H:i:s"),
						"modified"=>date("Y-m-d H:i:s")
						);
					# -------------------------
					$this->db->insert("sys_logs", $logs);

					$this->apps->set_notification(1, "Successfully! Leave setting has ben save");
					redirect('admin/leaves_setting');

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

		        	$this->db->query("DELETE FROM mod_date WHERE id ='".$this->uri->segment(4)."'");
		            $this->apps->set_notification(1, "Successfully! Leave setting has ben delete");
					redirect('admin/leaves_setting');
		        }
				
			}else{
				redirect('login', 'refresh');
			}
	}


	public function update()
	{
		if($this->session->userdata('logged_in'))
		   	{
				$session_data   		= $this->session->userdata('logged_in');
				$doc_type				= $this->input->post('doc_type');
				$doc_tgl 				= $this->input->post('doc_tgl');
				$doc_description		= $this->input->post('doc_description');

		        $this->db->query("UPDATE mod_date
		        					SET 
									tgl  			 = '".$doc_tgl."',
									description      = '".$doc_description."',
									type 			 = '".$doc_type."',
									user_id			 = '".$session_data['user_id']."'
									WHERE id ='".$this->input->post('doc_id')."'
		        					");

				$this->load->library('user_agent');
				$logs   = array (
					"log_date"=>date("Y-m-d"),
					"log_description"=>"update leave setting",
					"user_id"=> $session_data['user_id'],
					"browser" => $this->agent->browser(),
					"ip" =>  $this->input->ip_address(),
					"platform" => $this->agent->platform(),
					"created"=>date("Y-m-d H:i:s"),
					"modified"=>date("Y-m-d H:i:s")
					);
				# -------------------------
				$this->db->insert("sys_logs", $logs);

				$this->apps->set_notification(1, "Successfully! Leave setting has ben update");
				redirect('admin/leaves_setting');

		}else{
				redirect('login', 'refresh');
		}
	}

}
