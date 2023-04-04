<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leave_transaction extends CI_Controller {

	public function __construct()
 	{
   		parent::__construct();
			$this->load->helper(array('form', 'url', 'inflector','file'));
			$this->load->library(array('session','form_validation','upload','toastr','apps','encrypt'));
			$this->load->model(array('users_mdl','company_mdl','msg_mdl','leave_transaction_mdl'));
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
				$data['title']       		= 'Leave Transaction';
				$data['master']        		= 'master';
				$data['pic'] 				= $session_data['pic'];
				$id 						= $this->uri->segment(2);

				$filter 					= $_GET['query']; 
				$data['filter']				= $_GET['query']; 
				$codes      				= $_GET['cd'];

				$data['getdata']			= $this->leave_transaction_mdl->getdata($filter,$codes);
				$data['actions']			= $this->leave_transaction_mdl->actions();
				
				$userInfo = $this->users_mdl->user_info($id); 

		        if($userInfo=="")
		        {   
		            $this->load->view('backend/notfound', $data);
		        } else { 
		            $this->load->view('default/header', $data);
				  	$this->load->view('backend/leavetransaction/index', $data);
				  	$this->load->view('default/footer', $data);
		        }

				
			}else{
				redirect('login', 'refresh');
			}
	}



	public function all()
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
				$data['title']       		= 'Leave Transaction All';
				$data['master']        		= 'master';
				$data['pic'] 				= $session_data['pic'];
				$id 						= $this->uri->segment(2);

				$filter 					= $_GET['query']; 
				$data['filter']				= $_GET['query']; 

				$data['getdata']			= $this->leave_transaction_mdl->getalldata($filter);
				$data['actions']			= $this->leave_transaction_mdl->actions();
				
				$userInfo = $this->users_mdl->user_info($id); 

		        if($userInfo=="")
		        {   
		            $this->load->view('backend/notfound', $data);
		        } else { 
		            $this->load->view('default/header', $data);
				  	$this->load->view('backend/leavetransaction/all', $data);
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
			    $parent 		 	    = $session_data['user_name'];
				$data['user_status']    = $session_data['user_status'];
				$data['user_type'] 	    = $session_data['user_type'];

				// Approved
				if($this->input->post('approved')== 1){ 
					
					$type  = $this->input->post('doc_type_cuty_id');
					$code  = $this->input->post('doc_annual_leave_code');
					$child = $this->input->post('doc_email');

					/*
						jika cuti advanced
					*/

					if($type == 1){

						$sql = $this->db->query("SELECT advance_total 
											 FROM mod_employee
											 WHERE employee_code ='".$this->input->post('doc_employee_code')."'")->row();

						$saldo = $sql->advance_total-$this->input->post('doc_jml');

						/* 
							update ke advance_total table mod_employee yang sudah dikurangi total cuti yang diambil 
						*/

						$this->db->query("UPDATE mod_employee SET advance_total ='".$saldo."' 
										  WHERE employee_code ='".$this->input->post('doc_employee_code')."'");
					}

					/*
						jika cuti tahunan
					*/

					if($type == 8){ 

						$sql = $this->db->query("SELECT params_cuti, params_cuti_last_year 
											 FROM mod_employee
											 WHERE employee_code ='".$this->input->post('doc_employee_code')."'")->row();

						/* 
							update ke params_cuti_last_year table mod_employee yang sudah dikurangi total cuti yang diambil
						*/

							if($sql->params_cuti_last_year != 0){

								if($this->input->post('doc_jml') <= $sql->params_cuti_last_year){

									$saldo = $sql->params_cuti_last_year-$this->input->post('doc_jml');

									$this->db->query("UPDATE mod_employee 
													 SET params_cuti_last_year ='".$saldo."' 
											         WHERE employee_code ='".$this->input->post('doc_employee_code')."'");

								}


								if($this->input->post('doc_jml') > $sql->params_cuti_last_year ){ 

									$saldo = $this->input->post('doc_jml')-$sql->params_cuti_last_year;

									$saldo_update = $sql->params_cuti-$saldo;

									$this->db->query("UPDATE mod_employee SET params_cuti ='".$saldo_update."', params_cuti_last_year = 0
											  WHERE employee_code ='".$this->input->post('doc_employee_code')."'");

								}

							}

							
							if($sql->params_cuti_last_year <= 0){

								if($this->input->post('doc_jml') <= $sql->params_cuti){

									$saldo = $sql->params_cuti-$this->input->post('doc_jml');
									
									$this->db->query("UPDATE mod_employee 
													 SET params_cuti ='".$saldo."', params_cuti_last_year = 0
											         WHERE employee_code ='".$this->input->post('doc_employee_code')."'");

								}


								if($this->input->post('doc_jml') > $sql->params_cuti ){

									$saldo = $sql->params_cuti-$this->input->post('doc_jml');

									$this->db->query("UPDATE mod_employee SET params_cuti ='".$saldo."', params_cuti_last_year = 0
											  WHERE employee_code ='".$this->input->post('doc_employee_code')."'");

								}

							}
						
					}

					
					/* 
						update mod_annual_leave approved 
					*/

					$this->db->query("UPDATE mod_annual_leave 
									  SET approved =1, 
									  approved_by ='".$session_data['name']."', 
									  note ='".$this->input->post('note')."' 
									  WHERE employee_code ='".$this->input->post('doc_employee_code')."' 
									  AND annual_leave_code ='$code' ");
					/* 
						copy mod_annual_leave ke mod_detail_annual_leave 
					*/

					$move1 = $this->db->query("INSERT INTO mod_detail_annual_leave
												(
													 annual_leave_id,
													 annual_leave_code,
													 type_cuty_id,
													 annual_leave_date,
													 employee_code,
													 date_start,
													 date_end,
													 balance,
													 jml,
													 minus,
													 annual_leave_description,
													 approved,
													 approved_by,
													 note,
													 created,
													 modified,
													 date_long,
													 days

												) SELECT
													annual_leave_id,
													annual_leave_code,
													type_cuty_id,
													annual_leave_date,
													employee_code,
													date_start,
													date_end,
													balance,
													jml,
													minus,
													annual_leave_description,
													approved,
													approved_by,
													note,
													created,
													modified,
													date_long,
													days

												FROM mod_annual_leave
												WHERE annual_leave_code ='".$code."' ");

					/*
						end cuti advanced
					*/
					
					    $this->load->library('email');

						$config = $this->apps->config_set(); 

						$email_redirect = $this->apps->set_email();

						$bcc = array($email_redirect,$child,$parent,'it@pmka.web.id');

						$this->email->initialize($config);
						$this->email->set_newline("\r\n");
						$this->email->from($parent);
						$this->email->bcc($bcc);
						$this->email->subject('Approved');

						$data['id']    = $code;
						$data['st']  = 'Approved';
						$data['nama']  = $this->input->post('doc_employee_name');
						$data['company']  = $this->input->post('doc_company_name');
						$data['date3'] = $this->input->post('doc_date_start');
						$data['date4'] = $this->input->post('doc_date_end');
						$data['judul'] = $this->input->post('doc_type_cuty_name');
						$data['jml']   = $this->input->post('doc_jml');
						$data['pesan'] = $this->input->post('doc_annual_leave_description');
						$data['emails'] = $parent;

						$message = $this->load->view('backend/leavetransaction/approved',$data,TRUE);
						$this->email->message($message);

						if($this->email->send())
						{

						}
						else
						{
							show_error($this->email->print_debugger());
						}

						$this->load->library('user_agent');
						$logs   = array (
								"log_date"=>date("Y-m-d"),
								"log_description"=>"approved leave (".$this->input->post('doc_employee_name').")",
								"user_id"=> $session_data['user_id'],
								"browser" => $this->agent->browser(),
								"ip" =>  $this->input->ip_address(),
								"platform" => $this->agent->platform(),
								"created"=>date("Y-m-d H:i:s"),
								"modified"=>date("Y-m-d H:i:s")
								);
							# -------------------------
						$this->db->insert("sys_logs", $logs);

					$this->apps->set_notification(1, "Successfully! Leave has ben approved");
					redirect('admin/leave_transaction');

				}

				if($this->input->post('approved')== 6){
					

					$code  = $this->input->post('doc_annual_leave_code');
					$child = $this->input->post('doc_email');

					$this->db->query("UPDATE mod_annual_leave 
										SET approved='6',
											note ='".$this->input->post('note')."'
										WHERE annual_leave_code='".$code."'");
					
					$this->load->library('email');


					$config = $this->apps->config_set(); 

					$email_redirect = $this->apps->set_email();

					$bcc = array($email_redirect,$child,$parent,'it@pmka.web.id');

					$this->email->initialize($config);
					$this->email->set_newline("\r\n");
					$this->email->from($parent);
					$this->email->bcc($bcc);
					$this->email->subject('Not approved');

					$data['id']    		= $this->input->post('doc_annual_leave_code');
					$data['st']    		= 'Not approved';
					$data['nama']  		= $this->input->post('doc_employee_name');
					$data['company']  	= $this->input->post('doc_company_name');
					$data['date3'] 		= $this->input->post('doc_date_start');
					$data['date4'] 		= $this->input->post('doc_date_end');
					$data['judul'] 		= $this->input->post('doc_type_cuty_name');
					$data['jml']   		= $this->input->post('doc_jml');
					$data['pesan'] 		= $this->input->post('note');
					$data['emails'] 	= $parent;

					$message = $this->load->view('backend/leavetransaction/approved',$data,TRUE);
					$this->email->message($message);

					if($this->email->send())
					{

					}
					else
					{
						show_error($this->email->print_debugger());
					}

					$this->load->library('user_agent');
					$logs   = array (
							"log_date"=>date("Y-m-d"),
							"log_description"=>"approved leave (".$this->input->post('doc_employee_name').")",
							"user_id"=> $session_data['user_id'],
							"browser" => $this->agent->browser(),
							"ip" =>  $this->input->ip_address(),
							"platform" => $this->agent->platform(),
							"created"=>date("Y-m-d H:i:s"),
							"modified"=>date("Y-m-d H:i:s")
							);
						# -------------------------
					$this->db->insert("sys_logs", $logs);

					$this->apps->set_notification(1, "Successfully! Leave has ben not approved");
					redirect('admin/leave_transaction');

				}


				if($this->input->post('approved')== 9){
					
					$code  = $this->input->post('doc_annual_leave_code');
					$child = $this->input->post('doc_email');

					$this->db->query("UPDATE mod_annual_leave 
										SET approved='9',
											note ='".$this->input->post('note')."'
										WHERE annual_leave_code='".$code."'");
					
					$this->load->library('email');


					$config = $this->apps->config_set(); 

					$email_redirect = $this->apps->set_email();

					$bcc = array($email_redirect,$child,$parent,'it@pmka.web.id');

					$this->email->initialize($config);
					$this->email->set_newline("\r\n");
					$this->email->from($parent);
					$this->email->bcc($bcc);
					$this->email->subject('Cancel');

					$data['id']    = $this->input->post('doc_annual_leave_code');
					$data['nama']  = $this->input->post('doc_employee_name');
					$data['st']  = 'Cancel';
					$data['company']  = $this->input->post('doc_company_name');
					$data['date3'] = $this->input->post('doc_date_start');
					$data['date4'] = $this->input->post('doc_date_end');
					$data['judul'] = $this->input->post('doc_type_cuty_name');
					$data['jml']   = $this->input->post('doc_jml');
					$data['pesan'] = $this->input->post('note');
					$data['emails'] = $parent;

					$message = $this->load->view('backend/leavetransaction/approved',$data,TRUE);
					$this->email->message($message);

					if($this->email->send())
					{

					}
					else
					{
						show_error($this->email->print_debugger());
					}

					$this->load->library('user_agent');
					$logs   = array (
							"log_date"=>date("Y-m-d"),
							"log_description"=>"approved leave (".$this->input->post('doc_employee_name').")",
							"user_id"=> $session_data['user_id'],
							"browser" => $this->agent->browser(),
							"ip" =>  $this->input->ip_address(),
							"platform" => $this->agent->platform(),
							"created"=>date("Y-m-d H:i:s"),
							"modified"=>date("Y-m-d H:i:s")
							);
						# -------------------------
					$this->db->insert("sys_logs", $logs);

					$this->apps->set_notification(1, "Successfully! Leave has ben cancel");
					redirect('admin/leave_transaction');

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
