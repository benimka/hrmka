<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roles extends CI_Controller {

	public function __construct()
 	{
   		parent::__construct();
			$this->load->helper(array('form', 'url', 'inflector','file'));
			$this->load->library(array('session','form_validation','upload','toastr','apps'));
			$this->load->model(array('users_mdl','company_mdl','msg_mdl','roles_mdl'));
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
				$data['getdata']			= $this->roles_mdl->get();
				$data['title']       		= 'company';
				$data['master']        		= 'master';

				$this->load->view('default/header', $data);
			  	$this->load->view('backend/roles/index', $data);
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
				$data['user_id'] 			= $session_data['user_id'];
				$data['module']				= $this->users_mdl->getmodule();
				$data['viewmodule']			= $this->users_mdl->viewmodule();
				$data['getModule']          = $this->roles_mdl->getsysModule();
				$data['title']       		= 'company';

				$this->load->view('default/header', $data);
			  	$this->load->view('backend/roles/add', $data);
			  	$this->load->view('default/footer', $data);
			}else{
				redirect('login', 'refresh');
			}
	}



	public function save_roles(){

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
				$data['title']       		= 'company';
				$data['aktif']        		= 'active treeview';

				$role_name					= $this->input->post('role_name');
				$role_description 			= $this->input->post('role_description');

				$created		= date("Y-m-d H:i:s");
				$users          = $session_data['user_id'];
				$role_status    = 1;

				$result= $this->roles_mdl->simpan_roles($role_name,$role_status,$role_description,$users,$created);
				echo json_decode($result);

	   		}else{
				redirect('login', 'refresh');
		}
	}


  	public function save()
	{
		if($this->session->userdata('logged_in'))
			{
				$session_data = $this->session->userdata('logged_in');
				$cek 		  = $this->input->post('rols_id');

				$this->roles_mdl->deletemodul($cek);

				$jml 		  = count($this->input->post('role_id'));
				$item 		  = $this->input->post('role_id'); 

				for ($i = 0; $i <$jml; $i++){
				$items = array(
					'role_id'       => $this->input->post('rols_id'),
					'module_id' 	=> $item[$i]
				);
				$this->roles_mdl->simpanmod($items);
				}
				
				$this->apps->set_notification(1, " Roles has ben save");
				redirect('admin/roles');
			}else{
				redirect('login', 'refresh');
			}
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
				$data['role_id'] 			= $session_data['role_id'];
				$data['user_id'] 			= $session_data['user_id'];
				$data['module']				= $this->users_mdl->getmodule();
				$data['viewmodule']			= $this->users_mdl->viewmodule();
				$data['getdata']			= $this->roles_mdl->getNames($id);
				$data['getModule']          = $this->roles_mdl->getsysModule();
				$data['cek']				= $this->roles_mdl->getcek($id);
				$data['title']       		= 'company';

				$this->load->view('default/header', $data);
			  	$this->load->view('backend/roles/edit', $data);
			  	$this->load->view('default/footer', $data);
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
				$data['role_id'] 			= $session_data['role_id'];
				$data['user_id'] 			= $session_data['user_id'];
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
				$data['module']				= $this->users_mdl->getmodule();
				$data['title']       		= 'company';
				$data['aktif']        		= 'active treeview';
				$created_up					= date("Y-m-d H:i:s");

				$config['upload_path']      = './document';
				$config['file_name']     	= $this->input->post('document_name')."_".$created_up;
				$config['allowed_types']    = 'gif|jpg|jpeg|png|iso|dmg|zip|rar|doc|docx|xls|xlsx|ppt|pptx|csv|ods|odt|odp|pdf|rtf|sxc|sxi|txt';
				$config['max_size']             = 5000000;

				$this->load->library('upload');
				$this->upload->initialize($config); 

				 if($this->upload->do_upload("userfile")){
					$data = array('upload_data' => $this->upload->data()); 

					$company_id		= $this->input->post('company_id');
					$document_type	= $this->input->post('document_type');
					$document_name  = $this->input->post('document_name');
					$document_year  = $this->input->post('document_year'); 
					$image          = $data['upload_data']['file_name']; 
					$date_ex  		= $this->input->post('date_ex'); 

					$file_size      = $data['upload_data']['file_size'];

					$exp 			= date_create($date_ex);
					$dateexp 		= date_format($exp, "Y-m-d");

					$document_date  = date("Y-m-d");
					$startdate 		= date_create($document_date);
					$datestart 		= date_format($startdate, "Y-m-d");

					$created		= date("Y-m-d H:i:s");
					$users          = $session_data['user_id'];

					$result= $this->company_mdl->simpan_upload($company_id,$document_type,$document_name,$document_year,$file_size,$image,$dateexp,$datestart,$created,$users);
					echo json_decode($result);
;
				}
	   		}else{
				redirect('login', 'refresh');
		}
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
				$data['module']				= $this->users_mdl->getmodule();
				$data['title']       		= 'company';
				$data['aktif']        		= 'active treeview';
				$created_up					= date("Y-m-d H:i:s");

				$config['upload_path']      = './document';
				$config['file_name']     	= $this->input->post('document_name')."_".$created_up;
				$config['allowed_types']        = 'gif|jpg|jpeg|png|iso|dmg|zip|rar|doc|docx|xls|xlsx|ppt|pptx|csv|ods|odt|odp|pdf|rtf|sxc|sxi|txt';
				$config['max_size']             = 50000000;

				$this->load->library('upload');
				$this->upload->initialize($config); 

				 if($this->upload->do_upload("userfile")){
					$data = array('upload_data' => $this->upload->data()); 

					$document_id	= $this->input->post('id');
					$company_id		= $this->input->post('company_id');
					$document_type	= $this->input->post('type');
					$document_name  = $this->input->post('name');
					$document_year  = $this->input->post('year'); 
					$image          = $data['upload_data']['file_name']; 
					$date_ex  		= $this->input->post('ex'); 

					$file_size      = $data['upload_data']['file_size'];

					$exp 			= date_create($date_ex);
					$dateexp 		= date_format($exp, "Y-m-d");

					$document_date  = date("Y-m-d");
					$startdate 		= date_create($document_date);
					$datestart 		= date_format($startdate, "Y-m-d");

					$created		= date("Y-m-d H:i:s");
					$users          = $session_data['user_id'];

					$this->db->query("UPDATE mod_document SET 
                            document_type = '$document_type',
                            document_name = '$document_name',
                            document_year = '$document_year',
                            document_size = '$file_size',
                            document_name = '$document_name',
                            document_upload = '$image',
                            document_date = '$datestart',
                            document_ex = '$dateexp',
                            modified = '$created',
                            user_id = '$users'
                            WHERE  document_id ='".$document_id."' ");

				} else {
					$data = array('upload_data' => $this->upload->data()); 

					$document_id	= $this->input->post('id');
					$company_id		= $this->input->post('company_id');
					$document_type	= $this->input->post('type');
					$document_name  = $this->input->post('name');
					$document_year  = $this->input->post('year'); 
					$image          = $data['upload_data']['file_name']; 
					$date_ex  		= $this->input->post('ex'); 

					$file_size      = $data['upload_data']['file_size'];

					$exp 			= date_create($date_ex);
					$dateexp 		= date_format($exp, "Y-m-d");

					$document_date  = date("Y-m-d");
					$startdate 		= date_create($document_date);
					$datestart 		= date_format($startdate, "Y-m-d");

					$created		= date("Y-m-d H:i:s");
					$users          = $session_data['user_id'];
					
					$this->db->query("UPDATE mod_document SET 
                            document_type = '$document_type',
                            document_name = '$document_name',
                            document_year = '$document_year',
                            document_name = '$document_name',
                            document_date = '$datestart',
                            document_ex = '$dateexp',
                            modified = '$created',
                            user_id = '$users'
                            WHERE  document_id ='".$document_id."' ");
				}
	   		}else{
				redirect('login', 'refresh');
		}
	}


    public function addDocument($id)
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
				$data['getDocument']		= $this->company_mdl->getDocument($id);
				$data['getCompany'] 		= $this->company_mdl->get($id);
				$data['title']       		= 'company';

				$this->load->view('default/header', $data);
			  	$this->load->view('backend/documents/add', $data);
			  	$this->load->view('default/footer', $data);
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
				$data['module']				= $this->users_mdl->getmodule();
				$data['title']       		= 'company';
				$data['aktif']        		= 'active treeview';

				$company_id		= $this->input->post('company_id');
				$com_name 		= $this->input->post('com_name');
				$com_title	    = $this->input->post('com_title');
				$com_year 		= $this->input->post('com_year'); 
				$com_ex  		= $this->input->post('com_ex'); 

				$exp 			= date_create($com_ex);
				$dateexp 		= date_format($exp, "Y-m-d");

				$created		= date("Y-m-d H:i:s");
				$users          = $session_data['user_id'];

				$result= $this->company_mdl->simpan_com($company_id,$com_name,$com_title,$com_year,$dateexp,$created,$users);
				echo json_decode($result);

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
				$com_year 		= $this->input->post('com_year'); 
				$com_ex  		= $this->input->post('com_ex'); 

				$exp 			= date_create($com_ex);
				$dateexp 		= date_format($exp, "Y-m-d");

				$created		= date("Y-m-d H:i:s");
				$users          = $session_data['user_id'];

				$this->db->query("UPDATE mod_commissaris SET 
                            commissaris_name = '$com_name',
                            commissaris_title = '$com_title',
                            commissaris_year = '$com_year',
                            commissaris_ex = '$dateexp',
                            modified = '$created',
                            user_id = '$users'
                            WHERE  commissaris_id ='".$commissaris_id."' ");

	   		}else{
				redirect('login', 'refresh');
		}
	}


}
