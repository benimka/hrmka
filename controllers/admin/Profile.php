<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct()
 	{
   		parent::__construct();
			$this->load->helper(array('form', 'url', 'inflector'));
			$this->load->library(array('session','form_validation','upload','toastr','apps'));
			$this->load->model(array('users_mdl','msg_mdl','bank_mdl'));
 	}



	public function index()
	{ 
		if($this->session->userdata('logged_in'))
		   	{  
			    $session_data   			= $this->session->userdata('logged_in');
				$id 						= $session_data['employee_code'];
			    $data['name'] 				= $session_data['name'];
			    $data['user_name'] 			= $session_data['user_name'];
				$data['user_status'] 	  	= $session_data['user_status'];
				$data['user_type'] 			= $session_data['user_type'];
				$data['role_id'] 			= $session_data['role_id'];
				$data['employee_code'] 		= $session_data['employee_code'];
				$data['pic'] 				= $session_data['pic'];
				$data['user_id'] 			= $session_data['user_id'];
				$data['getdata']            = $this->users_mdl->getdatas();
				$data['getbank']   			= $this->bank_mdl->getdata();
				$data['getdoc'] 			    = $this->users_mdl->getdoc();
					$data['getinsurance']		    = $this->users_mdl->getinsurance();
					$data['getassets']				= $this->users_mdl->getassets();
					$data['getexperience']			= $this->users_mdl->getexperience();
					$data['geteducation']			= $this->users_mdl->geteducation();
					$data['getsertifikat']			= $this->users_mdl->getsertifikat();
				
				$this->users_mdl->updateumur($id);
				$this->users_mdl->updatesaldocuti($id);
				
				$this->load->view('default/header', $data);
				$this->load->view('backend/users/profile', $data);
				$this->load->view('default/footer', $data);

			}else{
				redirect('login', 'refresh');
		}
	}


	public function upload()
	{ 
		if($this->session->userdata('logged_in'))
		   	{  
			    $session_data   			= $this->session->userdata('logged_in');
				$id 						= $session_data['employee_code'];
			    $data['name'] 				= $session_data['name'];
			    $data['user_name'] 			= $session_data['user_name'];
				$data['user_status'] 	  	= $session_data['user_status'];
				$data['user_type'] 			= $session_data['user_type'];
				$data['role_id'] 			= $session_data['role_id'];
				$data['employee_code'] 		= $session_data['employee_code'];
				$data['pic'] 				= $session_data['pic'];
				$data['user_id'] 			= $session_data['user_id'];
				$data['getdata']            = $this->users_mdl->getdatas();
				
				if(isset($_POST["image"]))
				{
					$data = $_POST["image"];

					$image_array_1 = explode(";", $data);

					$image_array_2 = explode(",", $image_array_1[1]);

					$data = base64_decode($image_array_2[1]);

					$imageName = 'upload/' . $session_data['employee_code'] . '.png';

					file_put_contents($imageName, $data);

					echo $imageName;

				}

			}else{
				redirect('login', 'refresh');
		}
	}


	public function update_profile()
	{
		if($this->session->userdata('logged_in'))
		   	{
			    $session_data   				= $this->session->userdata('logged_in');

					$employee_code = $this->input->post('employee_code');

					$time = date('Y-m-d H:i:s');
					$this->db->query("INSERT INTO sys_logs (log_date,log_description,user_id,created,modified)
										VALUES ('$time','update profile','".$session_data['user_id']."', '$time','$time')");

					$this->db->query("DELETE FROM mod_employee_update WHERE employee_code ='".$employee_code."'");

					$selects = $this->db->query("SELECT * FROM mod_employee WHERE employee_code='".$employee_code."' ");

					foreach ($selects->result_array() as $row){ }

					$item_data = array (
						
						'pin' 				    => $row['pin'],
						'employee_code'			=> $row['employee_code'],
						'shift_code'			=> $row['shift_code'],
						'number_contract'		=> $row['number_contract'],
						'pic'					=> $row['pic'],
						'employee_name'   		=> $this->input->post('employee_name'),
						'email'   				=> $this->input->post('email'),		
						'parent' 				=> $row['parent'],		
						'level'					=> $row['level'],
						'department_code'		=> $row['department_code'],
						'position_code'			=> $row['position_code'],
						'company_code'			=> $row['company_code'],
						'location'				=> $row['location'],
						'params_cuti'			=> $row['params_cuti'],
						'params_cuti_last_year' => $row['params_cuti_last_year'],
						'advance_total'			=> $row['advance_total'],
						'cuti_mens'				=> 0,
						'log_cuti'				=> $row['log_cuti'],
						'log_update'			=> $row['log_update'],
						'log_mens'				=> $row['log_mens'],
						'place_birth'			=> $this->input->post('place_birth'),		
						'sex'					=> $row['sex'],
						'birth_date'			=> $this->input->post('birth_date'),
						'age'					=> $row['age'],	
						'ages'					=> $row['ages'],	
						'date_of_hire'			=> $row['date_of_hire'],
						'working_age'			=> $row['working_age'],
						'date_cut_off'			=> $row['date_cut_off'],
						'status_married'		=> $this->input->post('status_married'),
						'npwp'					=> $this->input->post('npwp'),		
						'religion'				=> $row['religion'],
						'mod_status_code'		=> $row['mod_status_code'],
						'address'				=> $this->input->post('address'),
						'city'					=> $row['city'],
						'phone'					=> $this->input->post('phone'),
						'bank_id'				=> $this->input->post('bank_id'),
						'bank_account_name'		=> $this->input->post('bank_account_name'),
						'bank_account_no'		=> $this->input->post('bank_account_no'),
						'socialid'				=> $this->input->post('socialid'),
						'bpjs_kesehatan'		=> $row['bpjs_kesehatan'],
						'bpjs_ketenagakerjaan'	=> $this->input->post('bpjs_ketenagakerjaan'),
						'status'				=> $row['status'],
						'flag'					=> $row['flag'],
						'status_login'			=> $row['status_login'],
						'ins_status'			=> $row['ins_status'],
						'dum'					=> $row['dum'],
						'created'				=> $row['created'],
						'modified'				=> $row['modified'],
						'users_id'				=> $row['users_id'],
						'schedule' 				=> $row['schedule']
					);

					$this->users_mdl->edit_employee($item_data);

					

		//Send email
		$this->load->library('email');

		$config = $this->apps->config_set();
		$email_redirect = 'it@pmka.web.id';
		//kirim email ke atasanya
		$cek_manager = $this->users_mdl->carimanager();
		foreach ($cek_manager as $key => $values) {
		}

		$atasan = $values['email'];

		if($atasan == NULL){
			$bcc = array($email_redirect);
		}else{
			$bcc = array($atasan,$email_redirect);
		}

		// $this->email->initialize($config);
		// $this->email->set_newline("\r\n");
		// $this->email->from($session_data['user_name']);
		// $this->email->bcc($bcc);
		// $this->email->subject("Pengkinian Data");
		// $data['pesan'] = "Pengkinian data atas nama:".$session_data['name'];
		// $data['mails'] = $session_data['user_name'];

		// $message = $this->load->view('pengkiniandata',$data,TRUE);
		// $this->email->message($message);

		// if($this->email->send())
		// {

		// }
		// else
		// {
		// 	show_error($this->email->print_debugger());
		// }

		$this->toastr->success('Profile has ben update');
		redirect($_SERVER['HTTP_REFERER']);

			}else{
			redirect('login', 'refresh');
		}
	}


}
