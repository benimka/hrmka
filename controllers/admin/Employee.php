<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {

	public function __construct()
 	{
   		parent::__construct();
			$this->load->helper(array('form', 'url', 'inflector','file'));
			$this->load->library(array('session','form_validation','upload','toastr','apps','encrypt'));
			$this->load->model(array('users_mdl','company_mdl','msg_mdl','announcements_mdl','assets_mdl','bank_mdl','department_mdl','employee_mdl'));
 	}


	public function index()
	{  
		if($this->session->userdata('logged_in'))
		   	{	
				$session_data   			= $this->session->userdata('logged_in');
				$filter 					= $_GET['query'];
				$data['filter']				= $_GET['query'];
				$data['name'] 				= $session_data['name'];
				$data['user_name'] 			= $session_data['user_name'];
				$data['user_status'] 		= $session_data['user_status'];
				$data['datelogin'] 			= $session_data['datelogin'];
				$data['user_type'] 			= $session_data['user_type'];
				$data['role_id'] 			= $session_data['role_id'];
				$data['user_id'] 			= $session_data['user_id'];
				$data['title']       		= 'List Of Employee';
				$data['master']        		= 'master';
				$data['pic'] 				= $session_data['pic'];
				$id 						= $this->uri->segment(2);
				$data['company']			= $this->employee_mdl->GetCompany();
				$data['getdata']			= $this->employee_mdl->getdata($numbers,$filter);
				$data['actions']			= $this->employee_mdl->actions();
				
				$userInfo = $this->users_mdl->user_info($id); 

		        if($userInfo=="")
		        {   
		            $this->load->view('backend/notfound', $data);
		        } else { 
		            $this->load->view('default/header', $data);
				  	$this->load->view('backend/employee/index', $data);
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
				$data['getdata']			= $this->employee_mdl->GetData();
				$data['title']       		= 'Add Employee';
				$data['master']        		= 'master'; 
				$segment2 					= $this->uri->segment(2);
				$segment3 					= $this->uri->segment(3);
				$data['companyCode']		= $this->input->post('company_code'); 
				$companyCode 				= $this->input->post('company_code'); 
				$data['autoCode']			= $this->employee_mdl->GetCode($companyCode);

				$userInfo = $this->users_mdl->user_info($segment2,$segment3); 

		        if($userInfo=="")
		        {   
		            $this->load->view('backend/notfound', $data);
		        } else { 
		            $this->load->view('default/header', $data);
				  	$this->load->view('backend/employee/add', $data);
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
				$data['getdata']			= $this->employee_mdl->getedit($numbers);
				$data['getdokumen']			= $this->employee_mdl->getdokumen($numbers);
				$data['getinsurance']		= $this->employee_mdl->getinsurance($numbers);
				$data['getasset']			= $this->employee_mdl->getasset($numbers);
				$data['getListAssets']		= $this->employee_mdl->getListAssets($numbers);
				$data['getexperience']		= $this->employee_mdl->getexperience($numbers);
				$data['geteducation']		= $this->employee_mdl->geteducation($numbers);
				$data['getsertifikat']		= $this->employee_mdl->getsertifikat($numbers);
				$data['title']       		= 'Edit Employee';
				$data['master']        		= 'master';

				$segment2 					= $this->uri->segment(2);
				$segment3 					= $this->uri->segment(3);

				$userInfo = $this->users_mdl->user_info($segment2,$segment3); 

		        if($userInfo=="")
		        {   
		            $this->load->view('backend/notfound', $data);
		        } else { 
		            $this->load->view('default/header', $data);
				  	$this->load->view('backend/employee/edit', $data);
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

					$birthDt1 = date_create($this->input->post('birth_date'));
					$birthDt2 = date_format($birthDt1, "Y-m-d");
					$birthDt = new dateTime($birthDt2);


					$today = new DateTime('today');
					$y = $today->diff($birthDt)->y;
					$m = $today->diff($birthDt)->m;
					$d = $today->diff($birthDt)->d;
					$xy = $y." tahun ".$m." bulan".$d." hari";


					$hiredate1 = date_create($this->input->post('date_of_hire'));
					$hiredate2  = date_format($hiredate1, "Y-m-d");
					$hiredate = new dateTime($hiredate2);

					$todays = new DateTime('today');
					$y = $todays->diff($hiredate)->y;
					$m = $todays->diff($hiredate)->m;
					$d = $todays->diff($hiredate)->d;
					$xyz = $y." tahun ".$m." bulan ".$d." hari ";


					$item=array(
						'pin'   	        => $this->input->post('pin'),
						'employee_code'   	=> $this->input->post('employee_code'),
						'shift_code'   		=> $this->input->post('shift_code'),
						'number_contract'   => $this->input->post('number_contract'),
						'employee_name'   	=> $this->input->post('employee_name'),
						'department_code'   => $this->input->post('department_code'),
						'email'   			=> $this->input->post('email'),
						'parent'   			=> $this->input->post('parent'),
						'level'   			=> $this->input->post('level'),
						'position_code'   	=> $this->input->post('position_code'),
						'company_code'    	=> $this->input->post('company_code'),
						'location'    		=> $this->input->post('location_id'),
						'place_birth'    	=> $this->input->post('place_birth'),
						'sex'    			=> $this->input->post('sex'),
						'birth_date'    	=> $birthDt2,
						'age'    			=> $xy,
						'date_of_hire'    	=> $hiredate2,
						'working_age'    	=> $xyz,
						'status_married'  	=> $this->input->post('status_married'),
						'npwp'    			=> $this->input->post('npwp'),
						'religion'    		=> $this->input->post('religion'),
						'mod_status_code'  	=> $this->input->post('mod_status_code'),
						'address'    		=> $this->input->post('address'),
						'address_2'    		=> $this->input->post('address_2'),
						'city'    			=> $this->input->post('city'),
						'phone'    			=> $this->input->post('phone'),
						'bank_id'      		=> $this->input->post('bank_id'),
						'bank_account_name'	=> $this->input->post('bank_account_name'),
						'bank_account_no'  	=> $this->input->post('bank_account_no'),
						'socialid'    		=> $this->input->post('socialid'),
						'bpjs_kesehatan'    => $this->input->post('bpjs_kesehatan'),
						'bpjs_ketenagakerjaan'  => $this->input->post('bpjs_ketenagakerjaan'),
						'emergency_contact'  => $this->input->post('emergency_contact'),
						'heir'  			=> $this->input->post('heir'),
						'users_id' 			=> $session_data['user_id']
					);

					

					$this->employee_mdl->save($item);

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
					redirect('admin/employee');

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

	public function delete_doc()
	{

		if($this->session->userdata('logged_in'))
		   	{
				$session_data   			= $this->session->userdata('logged_in');
				$id = $this->uri->segment(4);

				$query    = $this->db->query("SELECT documents_name FROM mod_document_employee WHERE id= ('". $id ."') ")->result_array();

				    foreach ($query as $key => $val) {
				    }

				    $nilai = $val['documents_name'];

					$this->load->library('user_agent');
					$logs   = array (
						"log_date"=>date("Y-m-d"),
						"log_description"=>"delete document (".$nilai.")",
						"user_id"=> $session_data['user_id'],
						"browser" => $this->agent->browser(),
						"ip" =>  $this->input->ip_address(),
						"platform" => $this->agent->platform(),
						"created"=>date("Y-m-d H:i:s"),
						"modified"=>date("Y-m-d H:i:s")
						);
					# -------------------------
					$this->db->insert("sys_logs", $logs);

				
				$this->db->query("DELETE FROM mod_document_employee WHERE id ='".$this->uri->segment(4)."'");
				$this->apps->set_notification(1, "Successfully! Document has ben delete");
				redirect($_SERVER['HTTP_REFERER']);

			}else{
				redirect('login', 'refresh');
			}

	}

	public function save_document()
	{ 
		if($this->session->userdata('logged_in'))
		   	{
				$session_data   		= $this->session->userdata('logged_in');
			    $data['name'] 			= $session_data['name'];
			    $data['user_name'] 	    = $session_data['user_name'];
				$data['user_status']    = $session_data['user_status'];
				$data['user_type'] 	    = $session_data['user_type'];

				$config['upload_path']      = './document';
				$config['file_name']     	= $this->input->post('documents_name');
				$config['allowed_types']    = 'gif|jpg|jpeg|png|iso|dmg|zip|rar|doc|docx|xls|xlsx|ppt|pptx|csv|ods|odt|odp|pdf|rtf|sxc|sxi|txt';
				$config['max_size']             = 5000000;

				$this->load->library('upload');
				$this->upload->initialize($config); 

				 if($this->upload->do_upload("userfile")){
					$data 			= array('upload_data' => $this->upload->data()); 
					$document_file  = $data['upload_data']['file_name'];

					$employee_code		= $this->input->post('employee_code');
					$documents_name 	= $this->input->post('documents_name');
					$file_documents 	= $document_file;
					$documents_expired 	= $this->input->post('documents_expired');

					$save_data   = array (
						"employee_code"		=> $employee_code,
						"documents_name"	=> $documents_name,
						"file_documents"	=> $document_file,
						"documents_expired" => $documents_expired
						);
					# -------------------------
					$this->db->insert("mod_document_employee", $save_data);


					$this->load->library('user_agent');
					$logs   = array (
						"log_date"=>date("Y-m-d"),
						"log_description"=>"save document (".$documents_name.")",
						"user_id"=> $session_data['user_id'],
						"browser" => $this->agent->browser(),
						"ip" =>  $this->input->ip_address(),
						"platform" => $this->agent->platform(),
						"created"=>date("Y-m-d H:i:s"),
						"modified"=>date("Y-m-d H:i:s")
						);
					# -------------------------
					$this->db->insert("sys_logs", $logs);

					$this->apps->set_notification(1, "Successfully! Document has ben save");
					redirect($_SERVER['HTTP_REFERER']);
				}

			}else{
				redirect('login', 'refresh');
			}
	}


	public function edit_document()
	{ 
		if($this->session->userdata('logged_in'))
		   	{
				$session_data   		= $this->session->userdata('logged_in');
			    $data['name'] 			= $session_data['name'];
			    $data['user_name'] 	    = $session_data['user_name'];
				$data['user_status']    = $session_data['user_status'];
				$data['user_type'] 	    = $session_data['user_type'];

				if (empty($_FILES['userfile']['name'])) {

				$employee_code		= $this->input->post('employee_code');
				$documents_name 	= $this->input->post('documents_name');
				$documents_expired 	= $this->input->post('documents_expireds');

				$this->db->query("UPDATE mod_document_employee
	            					SET 
									documents_name  = '".$documents_name."',
									documents_expired = '".$documents_expired."'
									WHERE id = '".$this->input->post('doc_id')."'");


				$this->load->library('user_agent');
				$logs   = array (
					"log_date"=>date("Y-m-d"),
					"log_description"=>"edit document (".$this->input->post('employee_code')."-".$this->input->post('documents_name').")",
					"user_id"=> $session_data['user_id'],
					"browser" => $this->agent->browser(),
					"ip" =>  $this->input->ip_address(),
					"platform" => $this->agent->platform(),
					"created"=>date("Y-m-d H:i:s"),
					"modified"=>date("Y-m-d H:i:s")
					);
				# -------------------------
				$this->db->insert("sys_logs", $logs);

				$this->apps->set_notification(1, "Successfully! Certificate has ben update");
				redirect($_SERVER['HTTP_REFERER']);

				} else {

					$this->db->query("DELETE FROM mod_document_employee WHERE id ='".$this->input->post('doc_id')."'");

					$config['upload_path']      = './document';
					$config['file_name']     	= $this->input->post('documents_name');
					$config['allowed_types']    = 'gif|jpg|jpeg|png|iso|dmg|zip|rar|doc|docx|xls|xlsx|ppt|pptx|csv|ods|odt|odp|pdf|rtf|sxc|sxi|txt';
					$config['max_size']             = 5000000;

					$this->load->library('upload');
					$this->upload->initialize($config); 

					 if($this->upload->do_upload("userfile")){
						$data 			= array('upload_data' => $this->upload->data()); 
						$document_file  = $data['upload_data']['file_name'];

						$employee_code		= $this->input->post('employee_code');
						$documents_name 	= $this->input->post('documents_name');
						$file_documents 	= $document_file;
						$documents_expired 	= $this->input->post('documents_expireds');

						$save_data   = array (
							"employee_code"		=> $employee_code,
							"documents_name"	=> $documents_name,
							"file_documents"	=> $document_file,
							"documents_expired" => $documents_expired
							);
						# -------------------------
						$this->db->insert("mod_document_employee", $save_data);


						$this->load->library('user_agent');
						$logs   = array (
							"log_date"=>date("Y-m-d"),
							"log_description"=>"edit document (".$documents_name.")",
							"user_id"=> $session_data['user_id'],
							"browser" => $this->agent->browser(),
							"ip" =>  $this->input->ip_address(),
							"platform" => $this->agent->platform(),
							"created"=>date("Y-m-d H:i:s"),
							"modified"=>date("Y-m-d H:i:s")
							);
						# -------------------------
						$this->db->insert("sys_logs", $logs);

						$this->apps->set_notification(1, "Successfully! Document has ben update");
						redirect($_SERVER['HTTP_REFERER']);
					}

				}

			}else{
				redirect('login', 'refresh');
			}
	}


	public function save_insurance()
	{ 
		if($this->session->userdata('logged_in'))
		   	{
				$session_data   		= $this->session->userdata('logged_in');
			    $data['name'] 			= $session_data['name'];
			    $data['user_name'] 	    = $session_data['user_name'];
				$data['user_status']    = $session_data['user_status'];
				$data['user_type'] 	    = $session_data['user_type'];

				$save_data   = array (
						"employee_code"		=> $this->input->post('employee_code'),
						"insurance_name"	=> $this->input->post('insurance_name'),
						"membership"		=> $this->input->post('membership'),
						"date_of_birth" 	=> $this->input->post('date_of_birth'),
						"ins_sex" 			=> $this->input->post('ins_sex'),
						"maternit" 			=> $this->input->post('maternit')
				);

				# -------------------------
				$this->db->insert("mod_insurance", $save_data);


				$this->load->library('user_agent');
				$logs   = array (
					"log_date"=>date("Y-m-d"),
					"log_description"=>"save insurance (".$this->input->post('employee_code').") (".$this->input->post('employee_name').")",
					"user_id"=> $session_data['user_id'],
					"browser" => $this->agent->browser(),
					"ip" =>  $this->input->ip_address(),
					"platform" => $this->agent->platform(),
					"created"=>date("Y-m-d H:i:s"),
					"modified"=>date("Y-m-d H:i:s")
					);
				# -------------------------
				$this->db->insert("sys_logs", $logs);

				$this->apps->set_notification(1, "Successfully! Insurance has ben save");
				redirect($_SERVER['HTTP_REFERER']);

			}else{
					
				redirect('login', 'refresh');
			}

	}


	public function update_insurance()
	{
		if($this->session->userdata('logged_in'))
		   	{
				$session_data   		= $this->session->userdata('logged_in');
			    $data['name'] 			= $session_data['name'];
			    $data['user_name'] 	    = $session_data['user_name'];
				$data['user_status']    = $session_data['user_status'];
				$data['user_type'] 	    = $session_data['user_type'];


				$doc_employee_code		= $this->input->post('doc_employee_code');
				$doc_insurance_name 	= $this->input->post('doc_insurance_name');
				$doc_membership			= $this->input->post('doc_membership');
				$doc_date_of_birth	    = $this->input->post('doc_date_of_birth');
				$doc_ins_sex 			= $this->input->post('doc_ins_sex'); 
	            $doc_maternit         	= $this->input->post('doc_maternit');
	            $doc_insurance_id       = $this->input->post('doc_insurance_id');

	            $this->db->query("UPDATE mod_insurance
	            					SET 
									insurance_name  = '".$doc_insurance_name."',
									membership      = '".$doc_membership."',
									date_of_birth 	= '".$doc_date_of_birth."',
									ins_sex			= '".$doc_ins_sex."',
									maternit		= '".$doc_maternit."'
									WHERE insurance_id ='".$doc_insurance_id."'
	            					");

				$this->load->library('user_agent');
				$logs   = array (
					"log_date"=>date("Y-m-d"),
					"log_description"=>"update insurance (".$this->input->post('doc_employee_code').") (".$this->input->post('doc_insurance_name').")",
					"user_id"=> $session_data['user_id'],
					"browser" => $this->agent->browser(),
					"ip" =>  $this->input->ip_address(),
					"platform" => $this->agent->platform(),
					"created"=>date("Y-m-d H:i:s"),
					"modified"=>date("Y-m-d H:i:s")
					);
				# -------------------------
				$this->db->insert("sys_logs", $logs);

				$this->apps->set_notification(1, "Successfully! Insurance has ben update");
				redirect($_SERVER['HTTP_REFERER']);

			}else{
					
				redirect('login', 'refresh');
			}
	}


	public function delete_insurance()
	{
		$this->db->query("DELETE FROM mod_insurance WHERE insurance_id ='".$this->uri->segment(4)."'");

		$this->load->library('user_agent');
		$logs   = array (
			"log_date"=>date("Y-m-d"),
			"log_description"=>"delete insurance",
			"user_id"=> $session_data['user_id'],
			"browser" => $this->agent->browser(),
			"ip" =>  $this->input->ip_address(),
			"platform" => $this->agent->platform(),
			"created"=>date("Y-m-d H:i:s"),
			"modified"=>date("Y-m-d H:i:s")
			);
		# -------------------------
		$this->db->insert("sys_logs", $logs);

		$this->apps->set_notification(1, "Successfully! Insurance has ben delete");
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function save_assets()
	{
		$item = array (
			'employee_code' => $this->input->post('employee_code'),
			'item_code'     => $this->input->post('item_code'),
			'date_assets'   => $this->input->post('date_assets')
		);

		$this->employee_mdl->save_assets($item);

		$this->load->library('user_agent');
		$logs   = array (
			"log_date"=>date("Y-m-d"),
			"log_description"=>"save assets (".$this->input->post('item_code').") (".$this->input->post('employee_code').")",
			"user_id"=> $session_data['user_id'],
			"browser" => $this->agent->browser(),
			"ip" =>  $this->input->ip_address(),
			"platform" => $this->agent->platform(),
			"created"=>date("Y-m-d H:i:s"),
			"modified"=>date("Y-m-d H:i:s")
			);
		# -------------------------
		$this->db->insert("sys_logs", $logs);

		$this->apps->set_notification(1, "Successfully! Assets has ben save");
		redirect($_SERVER['HTTP_REFERER']);
	}


	public function delete_assets()
	{
		$this->db->query("DELETE FROM mod_detail_assets WHERE id ='".$this->uri->segment(4)."'");

		$this->load->library('user_agent');
		$logs   = array (
			"log_date"=>date("Y-m-d"),
			"log_description"=>"delete assets",
			"user_id"=> $session_data['user_id'],
			"browser" => $this->agent->browser(),
			"ip" =>  $this->input->ip_address(),
			"platform" => $this->agent->platform(),
			"created"=>date("Y-m-d H:i:s"),
			"modified"=>date("Y-m-d H:i:s")
			);
		# -------------------------
		$this->db->insert("sys_logs", $logs);

		$this->apps->set_notification(1, "Successfully! Assets has ben delete");
		redirect($_SERVER['HTTP_REFERER']);
	}


	public function update_assets()
	{
		if($this->session->userdata('logged_in'))
		   	{
				$session_data   		= $this->session->userdata('logged_in');
			    $data['name'] 			= $session_data['name'];
			    $data['user_name'] 	    = $session_data['user_name'];
				$data['user_status']    = $session_data['user_status'];
				$data['user_type'] 	    = $session_data['user_type'];

				$doc_assets_id		= $this->input->post('doc_assets_id');
				$doc_assets_code 	= $this->input->post('doc_assets_code');
				$doc_assets_date	= $this->input->post('doc_assets_date');
				$employee_code		= $this->input->post('employee_code');

	            $this->db->query("UPDATE mod_detail_assets
	            					SET 
									item_code  = '".$doc_assets_code."',
									date_assets      = '".$doc_assets_date."'
									WHERE id ='".$doc_assets_id."'");

				$this->load->library('user_agent');
				$logs   = array (
					"log_date"=>date("Y-m-d"),
					"log_description"=>"update Assets (".$this->input->post('doc_assets_code').") (".$this->input->post('employee_code').")",
					"user_id"=> $session_data['user_id'],
					"browser" => $this->agent->browser(),
					"ip" =>  $this->input->ip_address(),
					"platform" => $this->agent->platform(),
					"created"=>date("Y-m-d H:i:s"),
					"modified"=>date("Y-m-d H:i:s")
					);
				# -------------------------
				$this->db->insert("sys_logs", $logs);

				$this->apps->set_notification(1, "Successfully! Assets has ben update");
				redirect($_SERVER['HTTP_REFERER']);

			}else{
					
				redirect('login', 'refresh');
			}
	}


	public function delete_experience()
	{
		$this->db->query("DELETE FROM mod_experience WHERE experience_id ='".$this->uri->segment(4)."'");

		$this->load->library('user_agent');
		$logs   = array (
			"log_date"=>date("Y-m-d"),
			"log_description"=>"delete experience",
			"user_id"=> $session_data['user_id'],
			"browser" => $this->agent->browser(),
			"ip" =>  $this->input->ip_address(),
			"platform" => $this->agent->platform(),
			"created"=>date("Y-m-d H:i:s"),
			"modified"=>date("Y-m-d H:i:s")
			);
		# -------------------------
		$this->db->insert("sys_logs", $logs);

		$this->apps->set_notification(1, "Successfully! Experience has ben delete");
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function save_experience()
	{
		if($this->session->userdata('logged_in'))
		   	{
				$session_data   		= $this->session->userdata('logged_in');
				$item = array (
							'employee_code'   			=> $this->input->post('employee_code'),
							'company'   				=> $this->input->post('company'),
							'start'   					=> $this->input->post('date_start'),
							'end'   					=> $this->input->post('date_end'),
							'jobs'   					=> $this->input->post('jobs'),
							'descriptions_experience'  	=> $this->input->post('descriptions_experience')
						);

				$this->employee_mdl->save_experience($item);

				$this->load->library('user_agent');
				$logs   = array (
					"log_date"=>date("Y-m-d"),
					"log_description"=>"save experience (".$this->input->post('company').") (".$this->input->post('employee_code').")",
					"user_id"=> $session_data['user_id'],
					"browser" => $this->agent->browser(),
					"ip" =>  $this->input->ip_address(),
					"platform" => $this->agent->platform(),
					"created"=>date("Y-m-d H:i:s"),
					"modified"=>date("Y-m-d H:i:s")
					);
				# -------------------------
				$this->db->insert("sys_logs", $logs);

				$this->apps->set_notification(1, "Successfully! Experience has ben save");
				redirect($_SERVER['HTTP_REFERER']);

			}else{
				
			redirect('login', 'refresh');
		}
	}


	public function update_experience()
	{
		if($this->session->userdata('logged_in'))
		   	{
				$session_data   		= $this->session->userdata('logged_in');
			    $data['name'] 			= $session_data['name'];
			    $data['user_name'] 	    = $session_data['user_name'];
				$data['user_status']    = $session_data['user_status'];
				$data['user_type'] 	    = $session_data['user_type'];

				$doc_id 			= $this->input->post('doc_id');
				$doc_company	 	= $this->input->post('doc_company');
				$doc_start			= $this->input->post('doc_start');
				$doc_end 			= $this->input->post('doc_end');
				$doc_jobs			= $this->input->post('doc_jobs');
				$doc_desc			= $this->input->post('doc_desc');

	            $this->db->query("UPDATE mod_experience
	            					SET 
									company  = '".$doc_company."',
									start      = '".$doc_start."',
									end      = '".$doc_end."',
									jobs      = '".$doc_jobs."',
									descriptions_experience      = '".$doc_desc."'
									WHERE experience_id ='".$doc_id."'");

				$this->load->library('user_agent');
				$logs   = array (
					"log_date"=>date("Y-m-d"),
					"log_description"=>"update experience (".$this->input->post('doc_company').") (".$this->input->post('employee_code').")",
					"user_id"=> $session_data['user_id'],
					"browser" => $this->agent->browser(),
					"ip" =>  $this->input->ip_address(),
					"platform" => $this->agent->platform(),
					"created"=>date("Y-m-d H:i:s"),
					"modified"=>date("Y-m-d H:i:s")
					);
				# -------------------------
				$this->db->insert("sys_logs", $logs);

				$this->apps->set_notification(1, "Successfully! experience has ben update");
				redirect($_SERVER['HTTP_REFERER']);

			}else{
					
				redirect('login', 'refresh');
			}
	}


	public function save_education()
	{
		if($this->session->userdata('logged_in'))
		   	{
				$session_data   		= $this->session->userdata('logged_in');
				$item = array (
							'employee_code'   			=> $this->input->post('employee_code'),
							'education'   				=> $this->input->post('education'),
							'stage'   					=> $this->input->post('stage'),
							'start'   					=> $this->input->post('start'),
							'end'   					=> $this->input->post('end'),
							'major'   					=> $this->input->post('major'),
							'description'  				=> $this->input->post('description')
						);

				$this->employee_mdl->save_education($item);

				$this->load->library('user_agent');
				$logs   = array (
					"log_date"=>date("Y-m-d"),
					"log_description"=>"save education (".$this->input->post('education').") (".$this->input->post('employee_code').")",
					"user_id"=> $session_data['user_id'],
					"browser" => $this->agent->browser(),
					"ip" =>  $this->input->ip_address(),
					"platform" => $this->agent->platform(),
					"created"=>date("Y-m-d H:i:s"),
					"modified"=>date("Y-m-d H:i:s")
					);
				# -------------------------
				$this->db->insert("sys_logs", $logs);

				$this->apps->set_notification(1, "Successfully! Experience has ben save");
				redirect($_SERVER['HTTP_REFERER']);

			}else{
				
			redirect('login', 'refresh');
		}
	}


	public function delete_education()
	{
		if($this->session->userdata('logged_in'))
		   	{
				$session_data   		= $this->session->userdata('logged_in');

				$this->db->query("DELETE FROM mod_education WHERE education_id ='".$this->uri->segment(4)."'");

				$this->load->library('user_agent');
				$logs   = array (
					"log_date"=>date("Y-m-d"),
					"log_description"=>"delete education",
					"user_id"=> $session_data['user_id'],
					"browser" => $this->agent->browser(),
					"ip" =>  $this->input->ip_address(),
					"platform" => $this->agent->platform(),
					"created"=>date("Y-m-d H:i:s"),
					"modified"=>date("Y-m-d H:i:s")
					);
				# -------------------------
				$this->db->insert("sys_logs", $logs);

				$this->apps->set_notification(1, "Successfully! Education has ben delete");
				redirect($_SERVER['HTTP_REFERER']);

			}else{
				
			redirect('login', 'refresh');
		}
	}


	public function update_education()
	{
		if($this->session->userdata('logged_in'))
		   	{
				$session_data   		= $this->session->userdata('logged_in');

				$doc_id 			= $this->input->post('doc_id');
				$doc_edu	 		= $this->input->post('doc_edu');
				$doc_stage	 		= $this->input->post('doc_stage');
				$doc_start			= $this->input->post('doc_start');
				$doc_end 			= $this->input->post('doc_end');
				$doc_major			= $this->input->post('doc_major');
				$doc_desc			= $this->input->post('doc_desc');

	            $this->db->query("UPDATE mod_education
	            					SET 
									stage  = '".$doc_stage."',
									education = '".$doc_edu."',
									start      = '".$doc_start."',
									end      = '".$doc_end."',
									major      = '".$doc_major."',
									description      = '".$doc_desc."'
									WHERE education_id ='".$doc_id."'");

	            $this->load->library('user_agent');
				$logs   = array (
					"log_date"=>date("Y-m-d"),
					"log_description"=>"update education (".$this->input->post('doc_edu').") (".$this->input->post('employee_code').")",
					"user_id"=> $session_data['user_id'],
					"browser" => $this->agent->browser(),
					"ip" =>  $this->input->ip_address(),
					"platform" => $this->agent->platform(),
					"created"=>date("Y-m-d H:i:s"),
					"modified"=>date("Y-m-d H:i:s")
					);
				# -------------------------
				$this->db->insert("sys_logs", $logs);

				$this->apps->set_notification(1, "Successfully! Education has ben update");
				redirect($_SERVER['HTTP_REFERER']);

			}else{
				
			redirect('login', 'refresh');
		}
	}


	public function save_certificate()
	{ 
		if($this->session->userdata('logged_in'))
		   	{
				$session_data   		= $this->session->userdata('logged_in');
			    $data['name'] 			= $session_data['name'];
			    $data['user_name'] 	    = $session_data['user_name'];
				$data['user_status']    = $session_data['user_status'];
				$data['user_type'] 	    = $session_data['user_type'];

				$config['upload_path']      = './certificate';
				$config['file_name']     	= $this->input->post('employee_code');
				$config['allowed_types']    = 'gif|jpg|jpeg|png|iso|dmg|zip|rar|doc|docx|xls|xlsx|ppt|pptx|csv|ods|odt|odp|pdf|rtf|sxc|sxi|txt';
				$config['max_size']             = 5000000;

				$this->load->library('upload');
				$this->upload->initialize($config); 

				 if($this->upload->do_upload("userfile")){
					$data 			= array('upload_data' => $this->upload->data()); 
					$document_file  = $data['upload_data']['file_name'];

					$employee_code		= $this->input->post('employee_code');
					$documents_name 	= $this->input->post('name');
					$document_file 		= $document_file;
					$documents_expired 	= $this->input->post('expired');

					$save_data   = array (
						"employee_code"		=> $employee_code,
						"name"				=> $documents_name,
						"date_expired" 		=> $documents_expired,
						"filename"			=> $document_file,
						
						);
					# -------------------------
					$this->db->insert("mod_training_certificate", $save_data);


					$this->load->library('user_agent');
					$logs   = array (
						"log_date"=>date("Y-m-d"),
						"log_description"=>"save certificate (".$this->input->post('employee_code')."-".$this->input->post('name').")",
						"user_id"=> $session_data['user_id'],
						"browser" => $this->agent->browser(),
						"ip" =>  $this->input->ip_address(),
						"platform" => $this->agent->platform(),
						"created"=>date("Y-m-d H:i:s"),
						"modified"=>date("Y-m-d H:i:s")
						);
					# -------------------------
					$this->db->insert("sys_logs", $logs);

					$this->apps->set_notification(1, "Successfully! Certificate has ben save");
					redirect($_SERVER['HTTP_REFERER']);
				}

			}else{
				redirect('login', 'refresh');
			}
	}


	public function update_certificate()
	{ 
		if($this->session->userdata('logged_in'))
		   	{
				$session_data   		= $this->session->userdata('logged_in');
			    $data['name'] 			= $session_data['name'];
			    $data['user_name'] 	    = $session_data['user_name'];
				$data['user_status']    = $session_data['user_status'];
				$data['user_type'] 	    = $session_data['user_type'];

				if (empty($_FILES['userfile']['name'])) {
				
						$employee_code		= $this->input->post('employee_code');
						$documents_name 	= $this->input->post('doc_name');
						$documents_expired 	= $this->input->post('doc_expired');

						$this->db->query("UPDATE mod_training_certificate
	            					SET 
									name  = '".$documents_name."',
									date_expired = '".$documents_expired."'
									WHERE id_training = '".$this->input->post('doc_id')."'");

						# -------------------------

						$this->load->library('user_agent');
						$logs   = array (
							"log_date"=>date("Y-m-d"),
							"log_description"=>"update certificate (".$this->input->post('employee_code')."-".$this->input->post('doc_name').")",
							"user_id"=> $session_data['user_id'],
							"browser" => $this->agent->browser(),
							"ip" =>  $this->input->ip_address(),
							"platform" => $this->agent->platform(),
							"created"=>date("Y-m-d H:i:s"),
							"modified"=>date("Y-m-d H:i:s")
							);
						# -------------------------
						$this->db->insert("sys_logs", $logs);

						$this->apps->set_notification(1, "Successfully! Certificate has ben update");
						redirect($_SERVER['HTTP_REFERER']);
					
				
				} else {

					$this->db->query("DELETE FROM mod_training_certificate WHERE id_training ='".$this->input->post('doc_id')."'");

					$config['upload_path']      = './certificate';
					$config['file_name']     	= $this->input->post('employee_code')."-".$this->input->post('doc_name');
					$config['allowed_types']    = 'gif|jpg|jpeg|png|iso|dmg|zip|rar|doc|docx|xls|xlsx|ppt|pptx|csv|ods|odt|odp|pdf|rtf|sxc|sxi|txt';
					$config['max_size']             = 5000000;

					$this->load->library('upload');
					$this->upload->initialize($config); 

					 if($this->upload->do_upload("userfile")){
						$data 			= array('upload_data' => $this->upload->data()); 
						$document_file  = $data['upload_data']['file_name'];

						$employee_code		= $this->input->post('employee_code');
						$documents_name 	= $this->input->post('doc_name');
						$document_file 		= $document_file;
						$documents_expired 	= $this->input->post('doc_expired');

						$save_data   = array (
							"employee_code"		=> $employee_code,
							"name"				=> $documents_name,
							"date_expired" 		=> $documents_expired,
							"filename"			=> $document_file,
							
							);
						# -------------------------
						$this->db->insert("mod_training_certificate", $save_data);

						$this->load->library('user_agent');
						$logs   = array (
							"log_date"=>date("Y-m-d"),
							"log_description"=>"update certificate (".$this->input->post('employee_code')."-".$this->input->post('doc_name').")",
							"user_id"=> $session_data['user_id'],
							"browser" => $this->agent->browser(),
							"ip" =>  $this->input->ip_address(),
							"platform" => $this->agent->platform(),
							"created"=>date("Y-m-d H:i:s"),
							"modified"=>date("Y-m-d H:i:s")
							);
						# -------------------------
						$this->db->insert("sys_logs", $logs);

						$this->apps->set_notification(1, "Successfully! Certificate has ben update");
						redirect($_SERVER['HTTP_REFERER']);
					}

				}

			}else{
				redirect('login', 'refresh');
			}
	}


	public function delete_certificate()
	{
		if($this->session->userdata('logged_in'))
		   	{
				$session_data   		= $this->session->userdata('logged_in');

				$this->db->query("DELETE FROM mod_training_certificate WHERE id_training ='".$this->uri->segment(4)."'");

				$this->load->library('user_agent');
				$logs   = array (
					"log_date"=>date("Y-m-d"),
					"log_description"=>"delete Certificate",
					"user_id"=> $session_data['user_id'],
					"browser" => $this->agent->browser(),
					"ip" =>  $this->input->ip_address(),
					"platform" => $this->agent->platform(),
					"created"=>date("Y-m-d H:i:s"),
					"modified"=>date("Y-m-d H:i:s")
					);
				# -------------------------
				$this->db->insert("sys_logs", $logs);

				$this->apps->set_notification(1, "Successfully! Certificate has ben delete");
				redirect($_SERVER['HTTP_REFERER']);

			}else{
				
			redirect('login', 'refresh');
		}
	}


	public function active_leave()
	{

		if($this->session->userdata('logged_in'))
				{
					$session_data   				= $this->session->userdata('logged_in');

				$cek = $this->input->post('flag');

				if($cek == 1){

					$item = array (
						'flag' 					=> $this->input->post('flag'),
						'advance_total' 		=> $this->input->post('advance_total')
					);

					$data1 = array (
						'employee_code'			=> $this->input->post('employee_code')
					);

					$query    = $this->db->query("SELECT employee_name
																				FROM mod_employee
																				WHERE employee_code='".$this->input->post('employee_code')."'")->result_array();

	        foreach ($query as $key => $val) {
	        }

	        $nilai = $val['employee_name'];

					$time = date('Y-m-d H:i:s');
					$this->db->query("INSERT INTO sys_logs (log_date,log_description,user_id,created,modified)
														VALUES ('$time','add advance ".$nilai." (".$this->input->post('advance_total').")','".$session_data['user_id']."', '$time','$time')");

				}else{

					$item = array (
						'flag' 					=> $this->input->post('flag')
					);

					$data1 = array (
						'employee_code'			=> $this->input->post('employee_code')
					);

					$query    = $this->db->query("SELECT employee_name
																				FROM mod_employee
																				WHERE employee_code='".$this->input->post('employee_code')."'")->result_array();

	        foreach ($query as $key => $val) {
	        }

	        $nilai = $val['employee_name'];

					$this->db->query("INSERT INTO sys_logs (log_date,log_description,user_id,created,modified)
														VALUES ('$time','add advance ".$nilai." (".$this->input->post('advance_total').")','".$session_data['user_id']."', '$time','$time')");

				}


				$this->employee_mdl->active_leave($item,$data1);
				$this->toastr->success('Your update successfully');
				redirect($_SERVER['HTTP_REFERER']);

			}else{
				redirect('login', 'refresh');
			}
	}


	public function edit_employee()
	{
		if($this->session->userdata('logged_in'))
		   	{
				$session_data   		= $this->session->userdata('logged_in');

				// $number_contract        = $this->input->post('number_contract');
				// $level        			= $this->input->post('level');
				// $department_code        = $this->input->post('department_code');
				// $parent        			= $this->input->post('parent');
				// $position_code       	= $this->input->post('position_code');
				// $location_id	        = $this->input->post('location_id');
				// $date_of_hire       	= $this->input->post('date_of_hire');
				// $mod_status_code        = $this->input->post('mod_status_code');
				// $socialid        		= $this->input->post('socialid');
				// $bank_id		        = $this->input->post('bank_id');
				// $bank_account_name      = $this->input->post('bank_account_name');
				// $bank_account_no        = $this->input->post('bank_account_no');
				// $bpjs_kesehatan        	= $this->input->post('bpjs_kesehatan');
				// $bpjs_ketenagakerjaan	= $this->input->post('bpjs_ketenagakerjaan');
				// $shift_code        		= $this->input->post('shift_code');
				// $pin 			        = $this->input->post('pin');
				// $employee_name 	        = $this->input->post('employee_name');
				// $place_birth        	= $this->input->post('place_birth');
				// $sex        			= $this->input->post('sex');
				// $birth_date        		= $this->input->post('birth_date');
				// $city 			        = $this->input->post('city');
				// $address 		        = $this->input->post('address');
				// $address_2 		        = $this->input->post('address_2');
				// $phone 			        = $this->input->post('phone');
				// $email 			        = $this->input->post('email');
				// $npwp         			= $this->input->post('npwp');
				// $religion 		        = $this->input->post('religion');
				// $heir         			= $this->input->post('heir');
				// $emergency_contact      = $this->input->post('emergency_contact');
				// $params_cuti            = $this->input->post('params_cuti');
				// $params_cuti_last_year  = $this->input->post('params_cuti_last_year');


				$birthDt1 = date_create($this->input->post('birth_date'));
					$birthDt2 = date_format($birthDt1, "Y-m-d");
					$birthDt = new dateTime($birthDt2);


					$today = new DateTime('today');
					$y = $today->diff($birthDt)->y;
					$m = $today->diff($birthDt)->m;
					$d = $today->diff($birthDt)->d;
					$xy = $y." tahun ".$m." bulan".$d." hari";


					$hiredate1 = date_create($this->input->post('date_of_hire'));
					$hiredate2  = date_format($hiredate1, "Y-m-d");
					$hiredate = new dateTime($hiredate2);

					$todays = new DateTime('today');
					$y = $todays->diff($hiredate)->y;
					$m = $todays->diff($hiredate)->m;
					$d = $todays->diff($hiredate)->d;
					$xyz = $y." tahun ".$m." bulan ".$d." hari ";


					$item=array(
						'pin'   	        => $this->input->post('pin'),
						'shift_code'   		=> $this->input->post('shift_code'),
						'number_contract'   => $this->input->post('number_contract'),
						'employee_name'   	=> $this->input->post('employee_name'),
						'department_code'   => $this->input->post('department_code'),
						'email'   			=> $this->input->post('email'),
						'parent'   			=> $this->input->post('parent'),
						'level'   			=> $this->input->post('level'),
						'position_code'   	=> $this->input->post('position_code'),
						'company_code'    	=> $this->input->post('company_code'),
						'location'    		=> $this->input->post('location_id'),
						'place_birth'    	=> $this->input->post('place_birth'),
						'sex'    			=> $this->input->post('sex'),
						'birth_date'    	=> $birthDt2,
						'age'    			=> $xy,
						'date_of_hire'    	=> $hiredate2,
						'working_age'    	=> $xyz,
						'status_married'  	=> $this->input->post('status_married'),
						'npwp'    			=> $this->input->post('npwp'),
						'religion'    		=> $this->input->post('religion'),
						'mod_status_code'  	=> $this->input->post('mod_status_code'),
						'address'    		=> $this->input->post('address'),
						'address_2'    		=> $this->input->post('address_2'),
						'city'    			=> $this->input->post('city'),
						'phone'    			=> $this->input->post('phone'),
						'bank_id'      		=> $this->input->post('bank_id'),
						'bank_account_name'	=> $this->input->post('bank_account_name'),
						'bank_account_no'  	=> $this->input->post('bank_account_no'),
						'socialid'    		=> $this->input->post('socialid'),
						'bpjs_kesehatan'    => $this->input->post('bpjs_kesehatan'),
						'bpjs_ketenagakerjaan'  => $this->input->post('bpjs_ketenagakerjaan'),
						'emergency_contact'  => $this->input->post('emergency_contact'),
						'heir'  			=> $this->input->post('heir'),
						'params_cuti'            => $this->input->post('params_cuti'),
						'params_cuti_last_year' => $this->input->post('params_cuti_last_year'),
						'users_id' 			=> $session_data['user_id']
					);

					$primary = array(
						'employee_code' => $this->input->post('employee_code')
					);

					$this->employee_mdl->update_employee($primary,$item);

					$this->load->library('user_agent');
					$logs   = array (
						"log_date"=>date("Y-m-d"),
						"log_description"=>"Update Empoyee (".$this->input->post('employee_name').")",
						"user_id"=> $session_data['user_id'],
						"browser" => $this->agent->browser(),
						"ip" =>  $this->input->ip_address(),
						"platform" => $this->agent->platform(),
						"created"=>date("Y-m-d H:i:s"),
						"modified"=>date("Y-m-d H:i:s")
						);
					# -------------------------
					$this->db->insert("sys_logs", $logs);

					$this->apps->set_notification(1, "Successfully! Employee has ben update");
					redirect($_SERVER['HTTP_REFERER']);

					$this->employee_mdl->update_employee($primary,$item);

			}else{

				redirect('login', 'refresh');

		}
	}
}
