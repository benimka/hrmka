<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Announcements extends CI_Controller {

	public function __construct()
 	{
   		parent::__construct();
			$this->load->helper(array('form', 'url', 'inflector','file'));
			$this->load->library(array('session','form_validation','upload','toastr','apps'));
			$this->load->model(array('users_mdl','company_mdl','msg_mdl','announcements_mdl'));
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
				$data['title']       		= 'Announcements';
				$data['master']        		= 'master';
				$data['pic'] 				= $session_data['pic'];
				$id 						= $this->uri->segment(2);
				$data['getdata']			= $this->announcements_mdl->GetData();
				$data['actions']			= $this->announcements_mdl->actions();

				$userInfo = $this->users_mdl->user_info($id); 

		        if($userInfo=="")
		        {
		            $this->load->view('backend/notfound', $data);
		        } else {
		            $this->load->view('default/header', $data);
				  	$this->load->view('backend/announcements/index', $data);
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
				$data['pic'] 				= $session_data['pic'];
				$id 						= $this->uri->segment(2);
				$data['getdata']			= $this->announcements_mdl->GetData();
				$data['actions']			= $this->announcements_mdl->actions();
				$data['title']       		= 'Add announcements';
				$data['master']        		= 'master';

				$this->load->view('default/header', $data);
			  	$this->load->view('backend/announcements/add', $data);
			  	$this->load->view('default/footer', $data);
			}else{
				redirect('login', 'refresh');
			}
	}

	
	public function edit()
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
				$data['pic'] 				= $session_data['pic'];
				$id 						= $this->uri->segment(4);
				$data['getedit']            = $this->announcements_mdl->edit($id);
				$data['actions']			= $this->announcements_mdl->actions();
				$data['title']       		= 'Edit announcements';
				$data['master']        		= 'master';

				$this->load->view('default/header', $data);
			  	$this->load->view('backend/announcements/edit', $data);
			  	$this->load->view('default/footer', $data);
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

						$config['upload_path']      	= './document';
						$config['file_name']     	    = $this->input->post('name');
				       	$config['allowed_types']        = 'gif|jpg|jpeg|png|iso|dmg|zip|rar|doc|docx|xls|xlsx|ppt|pptx|csv|ods|odt|odp|pdf|rtf|sxc|sxi|txt';
						$config['max_size']             = 5000000;

						$this->load->library('upload');
				 		$this->upload->initialize($config);

						if ( ! $this->upload->do_upload('userfile')){ 

							$data 					= $this->upload->data();
							$xx   					= $data['file_name']['file_name'];
							$name    				= $this->input->post('name');
							$url    				= $this->input->post('url');
							$status   			    = $this->input->post('status');
							$date1 				    = date_create($this->input->post('date'));
							$tgl 				    = date_format($date1, "Y-m-d");

							$item = array(
								'name' 	    		=> $name,
								'url'		        => $url,
								'fillename'			=> "",
								'status'		    => $status,
								'date_upload'	    => $tgl
							);
							
							$this->announcements_mdl->save($item);

							$this->load->library('user_agent');
							$logs   = array (
								"log_date"=>date("Y-m-d"),
								"log_description"=>"add announcements (".$this->input->post('name').")",
								"user_id"=> $session_data['user_id'],
								"browser" => $this->agent->browser(),
								"ip" =>  $this->input->ip_address(),
								"platform" => $this->agent->platform(),
								"created"=>date("Y-m-d H:i:s"),
								"modified"=>date("Y-m-d H:i:s")
								);
							# -------------------------
							$this->db->insert("sys_logs", $logs);

							
							$this->session->set_flashdata('msg', 'Successfully');
							redirect('admin/announcements');

						}else{

							$data 					= $this->upload->data();
							$xx   					= $data['file_name'];
							$name    				= $this->input->post('name');
							$url    				= $this->input->post('url');
							$status   			    = $this->input->post('status');
				            $date1 				    = date_create($this->input->post('date'));
							$tgl 				    = date_format($date1, "Y-m-d");

							$item = array(
								'name' 	    		=> $name,
								'url'		        => $url,
								'fillename'			=> $xx,
								'status'		    => $status,
								'date_upload'	    => $tgl
							);
							
							$this->announcements_mdl->save($item);

							$this->load->library('user_agent');
							$logs   = array (
								"log_date"=>date("Y-m-d"),
								"log_description"=>"add announcements (".$this->input->post('name').")",
								"user_id"=> $session_data['user_id'],
								"browser" => $this->agent->browser(),
								"ip" =>  $this->input->ip_address(),
								"platform" => $this->agent->platform(),
								"created"=>date("Y-m-d H:i:s"),
								"modified"=>date("Y-m-d H:i:s")
								);
							# -------------------------
							$this->db->insert("sys_logs", $logs);

							
							$this->session->set_flashdata('msg', 'Successfully');
							redirect('admin/announcements');

						}
				}else {

						$config['upload_path']      	= './document';
						$config['file_name']     	    = $this->input->post('name');
						$config['allowed_types']        = 'gif|jpg|jpeg|png|iso|dmg|zip|rar|doc|docx|xls|xlsx|ppt|pptx|csv|ods|odt|odp|pdf|rtf|sxc|sxi|txt';
						$config['max_size']             = 5000000;

						$this->load->library('upload');
						$this->upload->initialize($config);

						if ( ! $this->upload->do_upload('userfile')){ //echo "Tidak Diganti"; exit();
 
							$data 					= $this->upload->data();
							$xx   					= $data['file_name']['file_name'];
							$name    				= $this->input->post('name');
							$url    				= $this->input->post('url');
							$status   			    = $this->input->post('status');
							$date1 				    = date_create($this->input->post('date'));
							$tgl 				    = date_format($date1, "Y-m-d");

							if($url !=""){ 

								$item = array(
									'name' 	    		=> $name,
									'url'		        => $url,
									'fillename'			=> "",
									'status'		    => $status,
									'date_upload'	    => $tgl
								);
								

								$primary = array (
									'id'          => $this->input->post('id')
								);

								$this->announcements_mdl->update($primary,$item);
							} else { 
								$item = array(
									'name' 	    		=> $name,
									'status'		    => $status,
									'url'		        => "",
									'date_upload'	    => $tgl
								);
								

								$primary = array (
									'id'          => $this->input->post('id')
								);

								$this->announcements_mdl->update($primary,$item);
							}

							

							$this->load->library('user_agent');
							$logs   = array (
								"log_date"=>date("Y-m-d"),
								"log_description"=>"edit announcements (".$this->input->post('name').")",
								"user_id"=> $session_data['user_id'],
								"browser" => $this->agent->browser(),
								"ip" =>  $this->input->ip_address(),
								"platform" => $this->agent->platform(),
								"created"=>date("Y-m-d H:i:s"),
								"modified"=>date("Y-m-d H:i:s")
								);
							# -------------------------
							$this->db->insert("sys_logs", $logs);

							
							$this->session->set_flashdata('msg', 'Successfully');
							redirect('admin/announcements');

						} else { 



							$data 					= $this->upload->data();
							$xx   					= $data['file_name'];
							$name    				= $this->input->post('name');
							$url    				= $this->input->post('url');
							$status   			    = $this->input->post('status');
				            $date1 				    = date_create($this->input->post('date'));
							$tgl 				    = date_format($date1, "Y-m-d");

							$item = array(
								'name' 	    		=> $name,
								'url'		        => "",
								'fillename'			=> $xx,
								'status'		    => $status,
								'date_upload'	    => $tgl
							);
								

							$primary = array (
								'id'          => $this->input->post('id')
							);

							$this->announcements_mdl->update($primary,$item);

							$this->load->library('user_agent');
							$logs   = array (
								"log_date"=>date("Y-m-d"),
								"log_description"=>"edit announcements (".$this->input->post('name').")",
								"user_id"=> $session_data['user_id'],
								"browser" => $this->agent->browser(),
								"ip" =>  $this->input->ip_address(),
								"platform" => $this->agent->platform(),
								"created"=>date("Y-m-d H:i:s"),
								"modified"=>date("Y-m-d H:i:s")
								);
							# -------------------------
							$this->db->insert("sys_logs", $logs);

							
							$this->session->set_flashdata('msg', 'Successfully');
							redirect('admin/announcements');
						}

				}
				
			}else{
				redirect('login', 'refresh');
			}
	}


  	public function status()
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
				$data['getdata']			= $this->company_mdl->get($id);
				$data['title']       		= 'company';

				$this->load->view('default/header', $data);
			  	$this->load->view('backend/company/status', $data);
			  	$this->load->view('default/footer', $data);
			}else{
				redirect('login', 'refresh');
			}
	}


	public function listData()
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
				$data['role_id'] 			= $session_data['role_id'];
				$data['user_id'] 			= $session_data['user_id'];
				$data['module']				= $this->users_mdl->getmodule();
				$data['viewmodule']			= $this->users_mdl->viewmodule();
				$data['getCommissaris']		= $this->company_mdl->getCommissaris($id);
				$data['getDocument']		= $this->company_mdl->getDocument($id);
				$data['getCompany'] 		= $this->company_mdl->get($id);
				$data['getRuls']			= $this->company_mdl->getRuls();
				$data['title']       		= 'company';
				$data['active_menu']        = 'master';

				$this->load->view('default/header', $data);
			  	$this->load->view('backend/company/listData', $data);
			  	$this->load->view('default/footer', $data);
			}else{
				redirect('login', 'refresh');
			}
	}


	public function save_document()
	{
		if($this->session->userdata('logged_in'))
		   	{
				$session_data   			= $this->session->userdata('logged_in');
				$data['name'] 				= $session_data['name'];
				$data['user_name'] 			= $session_data['user_name'];
				$data['user_status'] 		= $session_data['user_status'];
				$data['datelogin'] 			= $session_data['datelogin'];
				$data['user_type'] 			= $session_data['user_type'];
				$data['user_id'] 			= $session_data['user_id'];
				$data['role_id'] 			= $session_data['role_id'];
				$data['module']				= $this->users_mdl->getmodule();
				$data['title']       		= 'company';
				$data['aktif']        		= 'active treeview';

				$uploadPath = './document/';
		        $config['upload_path'] = $uploadPath;
				$config['file_name']     = $this->input->post('employee_code');
		        $config['allowed_types'] = 'jpg|png|jpeg|bmp|pdf';
		        $config['max_size']      = '0';
		        $config['overwrite']     = FALSE;

		        $this->load->library('upload', $config);
			    $this->upload->initialize($config);

				$datax 					= $this->input->post('xdata');
				$company_id 			= $datax[0];
				$document_type 	    	= $datax[1];
				$document_name	    	= $datax[2];
				$document_year	    	= $datax[3];
				$file	    			= $datax[4];


				$file_size              = filesize($file);

				$exp = date_create($datax[5]);
				$dateexp = date_format($exp, "Y-m-d");

				$this->db->query("INSERT INTO mod_document (company_id, document_type, document_name, document_year, document_size, document_upload, document_ex) 
					values ('$company_id','$document_type','$document_name','$document_year','$file_size', '$file','$dateexp'); ");
				
			}else{
				redirect('login', 'refresh');
			}
	}


	public function do_upload(){ 

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
				$data['title']       		= 'company';
				$data['aktif']        		= 'active treeview';
				$created_up					= date("Y-m-d H:i:s");
				$users                      = $session_data['user_id'];
				$created_count				= date("Y-m");

				$qSelect = $this->db->query("SELECT COUNT(*) AS jml_upload 
											 FROM mod_document 
											 WHERE DATE_FORMAT(created, '%Y-%m') = '".$created_count."' AND user_id ='".$users."'");

				foreach ($qSelect->result_array() as $row){}

				$countUpload = $row['jml_upload'] + 1;

				$config['upload_path']      = './document';
				$config['file_name']     	= $this->input->post('document_name')."_".$created_up;
				$config['allowed_types']    = 'gif|jpg|jpeg|png|iso|dmg|zip|rar|doc|docx|xls|xlsx|ppt|pptx|csv|ods|odt|odp|pdf|rtf|sxc|sxi|txt';
				$config['max_size']             = 5000000;

				$this->load->library('upload');
				$this->upload->initialize($config); 

				 if($this->upload->do_upload("userfile")){
					$data = array('upload_data' => $this->upload->data()); 

					$document_type = $this->input->post('document_type');
					$document_type1 = $this->input->post('document_type1');
					$document_type2 = $this->input->post('document_type2');
					$document_type3 = $this->input->post('document_type3');
					$document_type4 = $this->input->post('document_type4');
					$document_type5 = $this->input->post('document_type5');
					$document_type6 = $this->input->post('document_type6');
					$document_type7 = $this->input->post('document_type7');
					$document_type8 = $this->input->post('document_type8');
					$document_type9 = $this->input->post('document_type9');
					$document_type10 = $this->input->post('document_type10');

					$document_types = array($document_type,$document_type1,$document_type2,$document_type3,$document_type4,$document_type5,$document_type6,$document_type7,$document_type8,$document_type9,$document_type10);

					$var_document = array_filter($document_types, 'is_numeric');

					$var_type = end($var_document);

					$company_id		= $this->input->post('company_id');					
					$document_name  = $this->input->post('document_name');

					$years 			= date_create($this->input->post('document_year'));
					$document_year	= date_format($years, "Y-m-d");

					$image          = $data['upload_data']['file_name']; 
					$file_size      = $data['upload_data']['file_size'];

					if($this->input->post('yes') == 1){

						$kode 				= $this->input->post('date_ex');
						$lenght         	= '+'.$kode.' year';
						$years 				= date_create($this->input->post('document_year'));
						$document_year		= date_format($years, "Y-m-d");
						$document_expired   = date('Y-m-d', strtotime($lenght, strtotime( $document_year )));
						$document_status 	= 1;

					} elseif($this->input->post('yes') == 2) {
						$kode = 0;
						$document_status = 4;
						$dateexp 		 = "0000-00-00";
					}

					

					$document_date  = date("Y-m-d");
					$startdate 		= date_create($document_date);
					$datestart 		= date_format($startdate, "Y-m-d");

					$created		= date("Y-m-d H:i:s");
					$users          = $session_data['user_id'];

					$result= $this->company_mdl->simpan_upload($company_id,$var_type,$document_name,$document_year,$file_size,$image,$document_expired,$kode,$document_status,$datestart,$countUpload,$created,$users);
					echo json_decode($result);


					$this->load->library('user_agent');
					$logs   = array (
						"log_date"=>date("Y-m-d"),
						"log_description"=>"Add document (".$this->input->post('document_name').")",
						"user_id"=> $session_data['user_id'],
						"browser" => $this->agent->browser(),
						"ip" =>  $this->input->ip_address(),
						"platform" => $this->agent->platform(),
						"created"=>date("Y-m-d H:i:s"),
						"modified"=>date("Y-m-d H:i:s")
						);
					# -------------------------
					$this->db->insert("sys_logs", $logs);
;
				}

	   		}else{
				redirect('login', 'refresh');
		}
	}

	public function link()
	{
		unlink("document/".$group_picture);
	}


	public function unites()
	{
		$com_ex         = '2023-01-27'; 
        $kode 			= '4';
        $lenght         = '+'.$kode.' year';
		$exp 			= date_create($com_ex);
		$dateexp 		= date_format($exp, "Y-m-d");
		$expireds       = date('Y-m-d', strtotime($lenght, strtotime( $dateexp )));

		var_dump($expireds);exit();
	}



	public function do_edit(){

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
				$data['title']       		= 'company';
				$data['aktif']        		= 'active treeview';
				$created_up					= date("Y-m-d H:i:s");

				$document_type	= $this->input->post('document_type');

					// Jika type dokumen tidak dirubah
					if($document_type == 0){

						$document_id	= $this->input->post('document_id');
						$document_name	= $this->input->post('document_name');
						$document_year	= $this->input->post('document_year');
						$document_st	= $this->input->post('doc_status');
						$document_up	= $data['upload_data']['file_name'];
						$document_size  = $data['upload_data']['file_size'];
						$date_ex  		= $this->input->post('ex'); 
						$exp 			= date_create($date_ex);
						$dateexp 		= date_format($exp, "Y-m-d");
						$created		= date("Y-m-d H:i:s");
						$users          = $session_data['user_id'];


						// jika not expired

						if($this->input->post('doc_status') == 4){

							$years 				= date_create($this->input->post('document_year'));
							$document_year		= date_format($years, "Y-m-d");

							$this->db->query("UPDATE mod_document SET 
												document_name = '$document_name',
												document_year = '$document_year',
						                        document_status = '$document_st',
						                        document_ex = '0000-00-00',
						                        expired  = 0,
						                        modified = '$created',
						                        user_id = '$users'
						                        WHERE  document_id ='".$document_id."' ");

						}elseif($this->input->post('doc_status') == 3){

							$years 				= date_create($this->input->post('document_year'));
							$document_year		= date_format($years, "Y-m-d");

							$this->db->query("UPDATE mod_document SET 
												document_name = '$document_name',
												document_year = '$document_year',
						                        document_status = '$document_st',
						                        expired  = 3,
						                        modified = '$created',
						                        user_id = '$users'
						                        WHERE  document_id ='".$document_id."' ");

						} else {

							$kode 				= $this->input->post('date_ex');
							$lenght         	= '+'.$kode.' year';
							$years 				= date_create($this->input->post('document_year'));
							$document_year		= date_format($years, "Y-m-d");
							$document_expired   = date('Y-m-d', strtotime($lenght, strtotime( $document_year )));

							$this->db->query("UPDATE mod_document SET 
												document_name = '$document_name',
												document_year = '$document_year',
												document_status = '$document_st',
												document_ex = '$document_expired',
												expired  = '$kode',
												modified = '$created',
												user_id = '$users'
												WHERE  document_id ='".$document_id."' ");

						}

						if($this->input->post('doc_status') == 1){
							$xx = 'Active';
						}

						if($this->input->post('doc_status') == 2){
							$xx = 'In active';
						}

						if($this->input->post('doc_status') == 3){
							$xx = 'Expired';
						}

						if($this->input->post('doc_status') == 4){
							$xx = 'Not expired';
						}


						$this->load->library('user_agent');
						$logs   = array (
							"log_date"=>date("Y-m-d"),
							"log_description"=>"Edit document (".$this->input->post('document_name').") (".$xx.")",
							"user_id"=> $session_data['user_id'],
							"browser" => $this->agent->browser(),
							"ip" =>  $this->input->ip_address(),
							"platform" => $this->agent->platform(),
							"created"=>date("Y-m-d H:i:s"),
							"modified"=>date("Y-m-d H:i:s")
							);
						# -------------------------
						$this->db->insert("sys_logs", $logs);
						

						$ids = $this->input->post('company_ids');

						$this->apps->set_notification(1, "Document has ben update");
						redirect('admin/company/listData/'.$ids);

					} else {

						$document_type = $this->input->post('document_type');
						$document_type1 = $this->input->post('document_type1');
						$document_type2 = $this->input->post('document_type2');
						$document_type3 = $this->input->post('document_type3');
						$document_type4 = $this->input->post('document_type4');
						$document_type5 = $this->input->post('document_type5');
						$document_type6 = $this->input->post('document_type6');
						$document_type7 = $this->input->post('document_type7');
						$document_type8 = $this->input->post('document_type8');
						$document_type9 = $this->input->post('document_type9');
						$document_type10 = $this->input->post('document_type10');

						$document_types = array($document_type,$document_type1,$document_type2,$document_type3,$document_type4,$document_type5,$document_type6,$document_type7,$document_type8,$document_type9,$document_type10);

						$var_document = array_filter($document_types, 'is_numeric');

						$var_type = end($var_document);


						$document_id	= $this->input->post('document_id');
						$document_name	= $this->input->post('document_name');
						$document_year	= $this->input->post('document_year');
						$document_st	= $this->input->post('doc_status');
						$document_up	= $data['upload_data']['file_name'];
						$document_size  = $data['upload_data']['file_size'];
						$date_ex  		= $this->input->post('ex'); 
						$exp 			= date_create($date_ex);
						$dateexp 		= date_format($exp, "Y-m-d");
						$created		= date("Y-m-d H:i:s");
						$users          = $session_data['user_id'];

						if($this->input->post('doc_status') == 4){
						
									$this->db->query("UPDATE mod_document SET 
											document_type = '$var_type',
											document_year = '$document_year',
					                        document_status = '$document_st',
					                        document_ex = '0000-00-00',
					                        modified = '$created',
					                        user_id = '$users'
					                        WHERE  document_id ='".$document_id."' ");

						}elseif($this->input->post('doc_status') == 3){
						
									$this->db->query("UPDATE mod_document SET 
											document_type = '$var_type',
											document_year = '$document_year',
					                        document_status = '$document_st',
					                        modified = '$created',
					                        user_id = '$users'
					                        WHERE  document_id ='".$document_id."' ");

						} else {
									$years 				= date_create($this->input->post('document_year'));
									$document_year		= date_format($years, "Y-m-d");

									$this->db->query("UPDATE mod_document SET 
											document_type = '$var_type',
											document_year = '$document_year',
					                        document_status = '$document_st',
					                        document_ex = '$dateexp',
					                        modified = '$created',
					                        user_id = '$users'
					                        WHERE  document_id ='".$document_id."' ");

						}

						if($this->input->post('doc_status') == 1){
							$xx = 'Active';
						}

						if($this->input->post('doc_status') == 2){
							$xx = 'In active';
						}

						if($this->input->post('doc_status') == 3){
							$xx = 'Expired';
						}

						if($this->input->post('doc_status') == 4){
							$xx = 'Not expired';
						}

					$this->load->library('user_agent');
					$logs   = array (
						"log_date"=>date("Y-m-d"),
						"log_description"=>"Edit document (".$this->input->post('document_name').") (".$xx.")",
						"user_id"=> $session_data['user_id'],
						"browser" => $this->agent->browser(),
						"ip" =>  $this->input->ip_address(),
						"platform" => $this->agent->platform(),
						"created"=>date("Y-m-d H:i:s"),
						"modified"=>date("Y-m-d H:i:s")
						);
					# -------------------------
					$this->db->insert("sys_logs", $logs);

						$ids = $this->input->post('company_ids');
						
						$this->apps->set_notification(1, "Document has ben update");
						
						redirect('admin/company/listData/'.$ids);

					}



	   		}else{
				redirect('login', 'refresh');
		}
	}



	public function do_edit_dashboard(){ 

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
				$data['title']       		= 'company';
				$data['aktif']        		= 'active treeview';
				$created_up					= date("Y-m-d H:i:s");

				$config['upload_path']      = './document';
				$config['file_name']     	= $this->input->post('document_name')."_".$created_up;
				$config['allowed_types']        = 'gif|jpg|jpeg|png|iso|dmg|zip|rar|doc|docx|xls|xlsx|ppt|pptx|csv|ods|odt|odp|pdf|rtf|sxc|sxi|txt';
				$config['max_size']             = 50000000;

				if($this->input->post('doc_status') != 4){


					$kode 				= $this->input->post('date_ex');
					$lenght         	= '+'.$kode.' year';
					$years 				= date_create($this->input->post('years'));
					$document_year		= date_format($years, "Y-m-d");
					$document_expired   = date('Y-m-d', strtotime($lenght, strtotime( $document_year )));


					$document_id	= $this->input->post('id');
					$document_st	= $this->input->post('doc_status');

					$modified		= date("Y-m-d H:i:s");
					$users          = $session_data['user_id'];
					
					$this->db->query("UPDATE mod_document SET 
	                        document_status = '$document_st',
	                        document_ex = '$document_expired',
	                        expired  = '$kode',
	                        modified = '$modified',
	                        user_id = '$users'
	                        WHERE  document_id ='".$document_id."' ");

				} elseif($this->input->post('doc_status') == 4){

					$document_id	= $this->input->post('id');
					$document_st	= $this->input->post('doc_status');


					$modified		= date("Y-m-d H:i:s");
					$users          = $session_data['user_id'];
					
					$this->db->query("UPDATE mod_document SET 
	                        document_status = 4,
	                        document_ex = '0000-00-00',
	                        modified = '$modified',
	                        user_id = '$users'
	                        WHERE  document_id ='".$document_id."' ");
				}

				$this->apps->set_notification(1, "Document has ben update");
						
				redirect('dashboard/');
				

	   		}else{
				redirect('login', 'refresh');
		}
	}


	public function save_com(){
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
				$data['title']       		= 'company';
				$data['aktif']        		= 'active treeview';

				$company_id		= $this->input->post('company_id');
				$com_name 		= $this->input->post('com_name');
				$com_title	    = $this->input->post('com_title');
				$com_year 		= $this->input->post('com_year'); 
	            $com_ex         = $this->input->post('com_ex'); 
	            $kode 			= $this->input->post('lenght_of_service');
	            $lenght         = '+'.$kode.' year';
				$exp 			= date_create($com_ex);
				$dateexp 		= date_format($exp, "Y-m-d");
				$expireds       = date('Y-m-d', strtotime($lenght, strtotime( $dateexp )));
				$created		= date("Y-m-d H:i:s");
				$users          = $session_data['user_id'];
				$presentage     = str_replace(",", "", $this->input->post('presentage'));

				$result= $this->company_mdl->simpan_com($company_id,$com_name,$com_title,$dateexp,$expireds,$presentage,$kode,$created,$users);
				echo json_decode($result);

				$this->load->library('user_agent');
				$logs   = array (
					"log_date"=>date("Y-m-d"),
					"log_description"=>"Add Commissaris & Management (".$this->input->post('com_name').")",
					"user_id"=> $session_data['user_id'],
					"browser" => $this->agent->browser(),
					"ip" =>  $this->input->ip_address(),
					"platform" => $this->agent->platform(),
					"created"=>date("Y-m-d H:i:s"),
					"modified"=>date("Y-m-d H:i:s")
					);
				# -------------------------
				$this->db->insert("sys_logs", $logs);

	   		}else{
				redirect('login', 'refresh');
		}
	}


	public function edit_com(){

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
				$data['title']       		= 'company';
				$data['aktif']        		= 'active treeview';

				$commissaris_id	= $this->input->post('comis_id');
				$company_id		= $this->input->post('company_id');
				$com_name 		= $this->input->post('com_name');
				$com_title	    = $this->input->post('com_title');
				$com_year 		= $this->input->post('date_coms'); 
				$presentage     = str_replace(",", "", $this->input->post('presentage'));
				$kode 			= $this->input->post('lenght_of_services');
	            $lenght         = '+'.$kode.' year';
				$exp 			= date_create($com_year);
				$dateexp 		= date_format($exp, "Y-m-d");
				$expireds       = date('Y-m-d', strtotime($lenght, strtotime( $dateexp )));

				$created		= date("Y-m-d H:i:s");
				$users          = $session_data['user_id'];

				$this->db->query("UPDATE mod_commissaris SET 
                            commissaris_name = '$com_name',
                            commissaris_title = '$com_title',
                            commissaris_year = '$dateexp',
                            commissaris_ex = '$expireds',
                            presentage = '$presentage',
                            lenght_of_service = '$kode',
                            modified = '$created',
                            user_id = '$users'
                            WHERE  commissaris_id ='".$commissaris_id."' ");


				$this->load->library('user_agent');
				$logs   = array (
					"log_date"=>date("Y-m-d"),
					"log_description"=>"Edit Commissaris & Management (".$this->input->post('com_name').")",
					"user_id"=> $session_data['user_id'],
					"browser" => $this->agent->browser(),
					"ip" =>  $this->input->ip_address(),
					"platform" => $this->agent->platform(),
					"created"=>date("Y-m-d H:i:s"),
					"modified"=>date("Y-m-d H:i:s")
					);
				# -------------------------
				$this->db->insert("sys_logs", $logs);

				$uri = $this->input->post('uri');
				$this->apps->set_notification(1, "Commissaris & Management has ben update");
				redirect('admin/company/listData/'.$uri);

	   		}else{
				redirect('login', 'refresh');
		}
	}



	public function edits($id)
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
				$data['role_id'] 			= $session_data['role_id'];
				$data['user_id'] 			= $session_data['user_id'];
				$data['module']				= $this->users_mdl->getmodule();
				$data['viewmodule']			= $this->users_mdl->viewmodule();
				$data['getdata']			= $this->company_mdl->get($id);
				$data['title']       		= 'company';
				$data['getDocument']		= $this->company_mdl->getDocumentUpdate($id);

				$this->load->view('default/header', $data);
			  	$this->load->view('backend/company/edits', $data);
			  	$this->load->view('default/footer', $data);
			}else{
				redirect('login', 'refresh');
			}
	}


}
