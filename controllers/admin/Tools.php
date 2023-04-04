<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tools extends CI_Controller {

	public function __construct()
 	{
   		parent::__construct();
			$this->load->helper(array('form', 'url', 'inflector','file'));
			$this->load->library(array('session','form_validation','upload','toastr','apps'));
			$this->load->model(array('users_mdl','company_mdl','msg_mdl','tools_mdl','assets_mdl'));
 	}


	public function ipaddress()
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
				$data['title']       		= 'Announcements';
				$data['master']        		= 'master';
				$data['pic'] 				= $session_data['pic'];
				$id 						= $this->uri->segment(2);
				$data['getdata']		  	= $this->tools_mdl->get_ip();

	            $this->load->view('default/header', $data);
			  	$this->load->view('backend/tools/ipaddress', $data);
			  	$this->load->view('default/footer', $data);

				
			}else{
				redirect('login', 'refresh');
			}
	}


	public function update_ip()
	{
		if($this->session->userdata('logged_in'))
		   	{
				$session_data   			= $this->session->userdata('logged_in');
				$data['name'] 				= $session_data['name'];
				$data['user_name'] 			= $session_data['user_name'];
				$data['user_status'] 		= $session_data['user_status'];
				$data['role_id'] 			  = $session_data['role_id'];

				$id 	= $this->input->post('id');
				$ip 	= $this->input->post('ip');
				$device = $this->input->post('device');
				$port   = $this->input->post('port');

				$this->db->query("UPDATE mod_device SET ip = '$ip', device = '$device', port ='$port' WHERE id = '$id' ");

				$this->apps->set_notification(1, "Successfully! Data has ben update");
				redirect('/admin/tools/ipaddress');

			}else{

				redirect('login', 'refresh');

			}
	}


	public function deleteip($id)
	{
		$this->db->query("DELETE FROM mod_device WHERE id ='".$id."'");
		$this->apps->set_notification(1, "Successfully! Data has ben delete");
		redirect('/admin/tools/ipaddress');

	}


	public function save_ip()
	{
		if($this->session->userdata('logged_in'))
		   	{
				$session_data   			= $this->session->userdata('logged_in');
				$data['name'] 				= $session_data['name'];
				$data['user_name'] 			= $session_data['user_name'];

				$item=array(
					'location_id'      => $this->input->post('location_id'),
					'device'      	   => $this->input->post('device'),
					'ip'      		   => $this->input->post('ip'),
					'port'      	   => $this->input->post('port')
		        );

				$this->tools_mdl->save($item);
				$this->apps->set_notification(1, "Successfully! Data has ben save");
				redirect('/admin/tools/ipaddress');

			}else{

				redirect('login', 'refresh');

			}
	}


	public function module()
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
				$data['title']       		= 'Module';
				$data['master']        		= 'master';
				$data['pic'] 				= $session_data['pic'];
				$id 						= $this->uri->segment(2);
				$data['getmodule']			= $this->tools_mdl->getroles();

	            $this->load->view('default/header', $data);
			  	$this->load->view('backend/tools/module', $data);
			  	$this->load->view('default/footer', $data);

				
			}else{
				redirect('login', 'refresh');
			}
	}


	public function settings($id)
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
				$data['title']       		= 'Setting Module';
				$data['master']        		= 'master';
				$data['pic'] 				= $session_data['pic'];
				$data['getmodule']			= $this->tools_mdl->getdatamodule();
				$data['cek']				= $this->tools_mdl->getcek($id);

	            $this->load->view('default/header', $data);
			  	$this->load->view('backend/tools/module_setting', $data);
			  	$this->load->view('default/footer', $data);

				
			}else{
				redirect('login', 'refresh');
		}
	}


	public function update_module()
	{
		if($this->session->userdata('logged_in'))
			{
				$session_data = $this->session->userdata('logged_in');

				$this->db->query("DELETE FROM sys_rule WHERE role_id='".$this->input->post('segment')."'");

				$jml 		  = count($this->input->post('flag'));
				$item 		  = $this->input->post('flag');

				for ($i = 0; $i <$jml; $i++){
				$items = array(
					'role_id'       => $this->input->post('segment'),
					'module_id' 	=> $item[$i]
				);
				$this->tools_mdl->save_rule($items);
				}

				$query    = $this->db->query("SELECT role_name FROM sys_roles WHERE role_id= ('". $this->input->post('segment') ."') ")->result_array();

				foreach ($query as $key => $val) {
				}

				$role_name = $val['role_name'];
				$time = date('Y-m-d H:i:s');
				$this->db->query("INSERT INTO sys_logs (log_date,log_description,user_id,created,modified)
									VALUES ('$time','edit role (".$role_name.")','".$session_data['user_id']."', '$time','$time')");

				$this->apps->set_notification(1, "Successfully! Data has ben update");
				redirect('/admin/tools/module');

			}else{
				redirect('login', 'refresh');
			}
	}


	public function users_setting()
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
				$data['title']       		= 'Setting Users Login';
				$data['master']        		= 'master';
				$data['pic'] 				= $session_data['pic'];
				$data['getmodule']			= $this->tools_mdl->getdatamodule();
				$data['getusers']			= $this->tools_mdl->getusers();

	         $this->load->view('default/header', $data);
			  	$this->load->view('backend/tools/users_setting', $data);
			  	$this->load->view('default/footer', $data);

				
			}else{
				redirect('login', 'refresh');
		}
	}


	public function edit_users()
	{
		if($this->session->userdata('logged_in'))
		   	{
		   		$id  					= $this->uri->segment('4');
				$session_data   		= $this->session->userdata('logged_in');
				$data['name'] 			= $session_data['name'];
				$data['user_name'] 		= $session_data['user_name'];
				$data['user_status'] 	= $session_data['user_status'];
				$data['user_type'] 		= $session_data['user_type'];
				$data['role_id'] 		= $session_data['role_id'];
				$data['company_id'] 	= $session_data['company_id'];
				$data['edit_users']		= $this->tools_mdl->edit_users($id);
				$data['title']        	= 'Edit users login';
				$data['aktif']        	= 'active treeview';

				$this->load->view('default/header', $data);
				$this->load->view('backend/tools/users_edit', $data);
				$this->load->view('default/footer', $data);

			}else{
				redirect('login', 'refresh');
			}
	}


	public function edit_users_login()
	{
		if($this->session->userdata('logged_in'))
 		   	{
 			    $session_data   	 = $this->session->userdata('logged_in');
				 	$pass = $this->input->post("password");

					$query    = $this->db->query("SELECT employee_name FROM mod_employee WHERE employee_code= ('". $this->input->post('employee_code') ."') ")->result_array();

			        foreach ($query as $key => $val) {
			        }

			        $nilai = $val['employee_name'];
				 	//Jika password kosong
				 	if($pass == ""){

				 		$edit1 = array (
							'role_id'   		=> $this->input->post('role_id'),
							'company_code'   	=> $this->input->post('company_code'),
							'department'   		=> $this->input->post('department'),
							'employee_code'   	=> $this->input->post('employee_code'),
							'modified'		    => date("Y-m-d H:i:s")
						);

						$param1 = array(
							'employee_code'   	=> $this->input->post('employee_code')
						);

						$this->tools_mdl->update_p_empty1($edit1,$param1);


						$edit2 = array (
							'status_login'   	=> $this->input->post('status_login')
						);

						$param2 = array(
							'employee_code'   	=> $this->input->post('employee_code')
						);

						$this->tools_mdl->update_p_empty2($edit2,$param2);


						$time = date('Y-m-d H:i:s');
					$this->db->query("INSERT INTO sys_logs (log_date,log_description,user_id,created,modified) VALUES ('$time','Edit login user (".$nilai.") ','".$session_data['user_id']."', '$time','$time')");

						$this->apps->set_notification(1, "Successfully! Data has ben update");
						redirect('/admin/tools/users_setting');

				 	} else {

				 		$pass1 = $this->input->post("password");
				 		$pass2 = $this->input->post("password_r");

				 		if($pass1 != $pass2){
							$this->apps->set_notification(3, "Ops! Password incorrect");
							redirect($_SERVER['HTTP_REFERER']);
				 		}

				 		$edit1 = array (
							'role_id'   		=> $this->input->post('role_id'),
							'company_code'   	=> $this->input->post('company_code'),
							'department'   		=> $this->input->post('department'),
							'employee_code'   	=> $this->input->post('employee_code'),
							'modified'		    => date("Y-m-d H:i:s")
						);

						$param1 = array(
							'employee_code'   	=> $this->input->post('employee_code')
						);

						$this->tools_mdl->update_p_empty1($edit1,$param1);


						$edit2 = array (
							'status_login'   	=> $this->input->post('status_login')
						);

						$param2 = array(
							'employee_code'   	=> $this->input->post('employee_code')
						);

						$this->tools_mdl->update_p_empty2($edit2,$param2);


						$ubah_pass = array (
							'user_password'     => $this->hash($this->input->post("password")),
						);

						$id_pass = array (
							'employee_code' => $this->input->post('employee_code')
						);

						$this->tools_mdl->changes_password($ubah_pass,$id_pass);

						$time = date('Y-m-d H:i:s');
					$this->db->query("INSERT INTO sys_logs (log_date,log_description,user_id,created,modified) VALUES ('$time','Edit login user (".$nilai.") ','".$session_data['user_id']."', '$time','$time')");

						$this->apps->set_notification(1, "Successfully! Data has ben update");
						redirect('/admin/tools/users_setting');

				 	}

				}else{
					redirect('login', 'refresh');
				}
	}


	public function hash ( $string )
   {
       return hash ('sha512', $string . config_item('encryption_key'));
   }


   public function setting_users()
	{
		if($this->session->userdata('logged_in'))
		   	{
		   		$id  					= $this->uri->segment('4');
					$session_data   		= $this->session->userdata('logged_in');
					$data['name'] 			= $session_data['name'];
					$data['user_name'] 		= $session_data['user_name'];
					$data['user_status'] 	= $session_data['user_status'];
					$data['user_type'] 		= $session_data['user_type'];
					$data['role_id'] 		= $session_data['role_id'];
					$data['company_id'] 	= $session_data['company_id'];
					$data['setting_users']	= $this->tools_mdl->setting_users($id);
					$data['title']        	= 'Setting Users';
					$data['aktif']        	= 'active treeview';

					$this->load->view('default/header', $data);
					$this->load->view('backend/tools/users_setting_tpl', $data);
					$this->load->view('default/footer', $data);
			}else{
				redirect('login', 'refresh');
			}
	}


	public function create_users_login()
	 {
 		$item = array (
 			'name'   		    => $this->input->post('name'),
 			'user_name'  		=> $this->input->post('user_name'),
 			'user_password'     => $this->users_mdl->hash($this->input->post("user_password1")),
 			'user_status'   	=> 1,
 			'company_code'   	=> $this->input->post('company_code'),
 			'department'   		=> $this->input->post('department'),
			'role_id'   		=> $this->input->post('role_id'),
			'company_id'   		=> $this->input->post('company_id'),
			'employee_code'   	=> $this->input->post('employee_code'),
			'datelogin'   	    => '0000-00-00 00:00:00',
			'created'		    => date("Y-m-d H:i:s")

		);
		
		$this->tools_mdl->save_users_login($item);
		$this->db->query("UPDATE mod_employee SET status_login = 1 WHERE employee_code ='".$this->input->post('employee_code')."'");
		$this->apps->set_notification(1, "Successfully! Data has ben update");
		redirect('/admin/tools/users_setting');
	 }



}
