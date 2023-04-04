<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
			$this->load->helper(array('form', 'url'));
			$this->load->library(array('session','form_validation','upload','toastr'));
			$this->load->model(array('msg_mdl','users_mdl','ticket_cat_mdl','company_mdl','ticket_mdl','priority_mdl','status_mdl'));
	}
	public function index()
	 {
	 	if($this->session->userdata('logged_in'))
		   	{
			    $session_data   	 = $this->session->userdata('logged_in');
			    $data['name'] 		 = $session_data['name'];
			    $data['user_id'] 	 = $session_data['user_id'];
			    $data['user_name'] 	 = $session_data['user_name'];
			    $data['role_id'] 			= $session_data['role_id'];
				$data['user_status'] = $session_data['user_status'];
				$data['user_type'] 	 = $session_data['user_type'];
				$data['company_id']  = $session_data['company_id'];
				$data['counter']   	  		= $this->msg_mdl->get_count();
				$data['company']	 = $this->company_mdl->getdata();
				$this->load->view('layouts/header', $data);
				$this->load->view('register', $data);
				$this->load->view('layouts/footer', $data);

	   }else{
				redirect('login', 'refresh');
			}
	 }
	 public function save()
	 {
	 	$name 			= $this->input->post('name');
	 	$user_name 		= $this->input->post('user_name');
	 	$user_password 	= $this->users_mdl->hash($this->input->post("user_password"));
	 	$user_type 		= $this->input->post('user_type');
	 	$company_id 	= $this->input->post('company_id');


	 	if($user_type == 4){
	 		$item = array(
				'name' 	    		=> $name,
				'user_name' 	    => $user_name,
				'user_password'		=> $user_password,
				'user_status'		=> 1,
				'user_type'			=> $user_type,
				'role_id'			=> 10,
				'company_code'		=> $company_id,
				'datelogin'         => '0000-00-00 00:00:00',
				'created'		    => date("Y-m-d H:i:s"),
				'type' 				=> 'staff'
			);

		$this->users_mdl->save($item);
		$this->session->set_flashdata('msg', 'Successfully');
		redirect('login/listuser');

	 	}else{

	 		$item = array(
				'name' 	    		=> $name,
				'user_name' 	    => $user_name,
				'user_password'		=> $user_password,
				'user_status'		=> 1,
				'user_type'			=> $user_type,
				'role_id'			=> 1,
				'company_code'		=> $company_id,
				'datelogin'         => '0000-00-00 00:00:00',
				'created'		    => date("Y-m-d H:i:s"),
				'type' 				=> 'admin'
		);

 		$this->users_mdl->save($item);
		$this->session->set_flashdata('msg', 'Successfully');
		redirect('login/listuser');

	 	}
		
	 }


	 public function frm_edit()
	 {
	 	$name 			= $this->input->post('name');
	 	$user_name 		= $this->input->post('user_name');
	 	$pass           = $this->input->post("user_password");
	 	$user_password 	= $this->users_mdl->hash($this->input->post("user_password"));
	 	$user_type 		= $this->input->post('user_type');
	 	$company_id 	= $this->input->post('company_id');
	 	$user_status 	= $this->input->post('user_status');

	 	if($pass ==""){
	 		
	 		if($user_type == 4){

			 		$item = array(
						'name' 	    		=> $name,
						'user_name' 	    => $user_name,
						'user_status'		=> $user_status,
						'user_type'			=> $user_type,
						'role_id'			=> 10,
						'company_code'		=> $company_id,
						'datelogin'         => '0000-00-00 00:00:00',
						'type' 				=> 'staff'
					);

					$data = array(
						'user_id' => $this->input->post('user_id')
					);

					$this->users_mdl->frm_edit($data,$item);
					$this->session->set_flashdata('msg', 'Successfully');
					redirect('login/listuser');

			 	}else{

			 		$item = array(
						'name' 	    		=> $name,
						'user_name' 	    => $user_name,
						'user_status'		=> $user_status,
						'user_type'			=> $user_type,
						'role_id'			=> 1,
						'company_code'		=> $company_id,
						'datelogin'         => '0000-00-00 00:00:00',
						'type' 				=> 'admin'
					);

					$data = array(
						'user_id' => $this->input->post('user_id')
					);

					$this->users_mdl->frm_edit($data,$item);
					$this->session->set_flashdata('msg', 'Successfully');
					redirect('login/listuser');

			 	}

	 	}else{

	 		if($user_type == 4){

		 		$item = array(
					'name' 	    		=> $name,
					'user_name' 	    => $user_name,
					'user_password'		=> $user_password,
					'user_status'		=> $user_status,
					'user_type'			=> $user_type,
					'role_id'			=> 10,
					'company_code'		=> $company_id,
					'datelogin'         => '0000-00-00 00:00:00',
					'type' 				=> 'staff'
				);

				$data = array(
					'user_id' => $this->input->post('user_id')
				);

				$this->users_mdl->frm_edit($data,$item);
				$this->session->set_flashdata('msg', 'Successfully');
				redirect('login/listuser');

		 	}else{

		 		$item = array(
					'name' 	    		=> $name,
					'user_name' 	    => $user_name,
					'user_password'		=> $user_password,
					'user_status'		=> $user_status,
					'user_type'			=> $user_type,
					'role_id'			=> 1,
					'company_code'		=> $company_id,
					'datelogin'         => '0000-00-00 00:00:00',
					'type' 				=> 'admin'
				);

				$data = array(
					'user_id' => $this->input->post('user_id')
				);

				$this->users_mdl->frm_edit($data,$item);
				$this->session->set_flashdata('msg', 'Successfully');
				redirect('login/listuser');
		 	}
	 	}
	 }
	 public function change()
	 {
	 	$name 			= $this->input->post('name');
	 	$user_name 		= $this->input->post('user_name');
	 	$user_password1 = $this->users_mdl->hash($this->input->post("user_password1"));
	 	$user_password2 = $this->users_mdl->hash($this->input->post("user_password2"));
	 	$user_id 	    = $this->input->post('user_id');

	 	if($user_password1 != $user_password2){

	 		$this->session->set_flashdata('msg1', 'Password different!');
			redirect('login/profile');

	 	}else{
	 		$data = array(
				'name' 	    		=> $name,
				'user_name' 	    => $user_name,
				'user_password'		=> $user_password2
		);

		$item = array(
					'user_id'     	=>  $this->input->post('user_id')
				);
		
		$this->users_mdl->update($data,$item);
		$this->session->set_flashdata('msg', 'Successfully');
		redirect('login/profile');
	 	}
		
	 } 

	 public function changetsm()
	 {
	 	$name 			= $this->input->post('name');
	 	$user_name 		= $this->input->post('user_name');
	 	$user_password1 = $this->users_mdl->hash($this->input->post("user_password1"));
	 	$user_password2 = $this->users_mdl->hash($this->input->post("user_password2"));
	 	$user_id 	    = $this->input->post('user_id');

	 	if($user_password1 != $user_password2){
	 		
			$this->toastr->warning('Password different');
			redirect($_SERVER['HTTP_REFERER']);

	 	}else{
	 		$data = array(
				'name' 	    		=> $name,
				'user_name' 	    => $user_name,
				'user_password'		=> $user_password2
			);

			$item = array(
					'user_id'     	=>  $this->input->post('user_id')
				);
		
			$this->users_mdl->update($data,$item);
			$this->toastr->success('Your change password successfully');
			redirect($_SERVER['HTTP_REFERER']);
	 	}
		
	 } 



	 public function create()
	 {
 		$item = array ( 
 			'name'   		    => $this->input->post('name'),
 			'user_name'  		=> $this->input->post('user_name'),
 			'user_password'     => $this->users_mdl->hash($this->input->post("user_password1")),
 			'user_status'   	=> 1,
 			'user_type'   		=> $this->input->post('user_type'),
 			'company_code'   	=> $this->input->post('company_code'),
 			'department'   		=> $this->input->post('department'),
			'role_id'   		=> $this->input->post('role_id'),
			'company_id'   		=> $this->input->post('company_id'),
			'employee_code'   	=> $this->input->post('employee_code'),
			'datelogin'   	    => '0000-00-00 00:00:00',
			'created'		    => date("Y-m-d H:i:s")
			
		);
 		
		$this->users_mdl->save($item);

		$edit = array(
			'status_login' => 1
 		);

		$param = array(
			'employee_code' => $this->input->post('employee_code')
		);

		$this->users_mdl->ubah($edit,$param);
		$this->toastr->success('Your update successfully');
		redirect($_SERVER['HTTP_REFERER']);
	 }


	 public function editcreate()
	 {
	 		$edit1 = array (
				'user_type'   		=> $this->input->post('user_type'),
				'parent'   			=> $this->input->post('parent'),
				'role_id'   		=> $this->input->post('role_id'),
				'company_code'   	=> $this->input->post('company_code'),
				'department'   		=> $this->input->post('department'),
				'employee_code'   	=> $this->input->post('employee_code'),
			);

			$param1 = array(
				'employee_code'   	=> $this->input->post('employee_code')
			);
			
			$this->users_mdl->ubah1($edit1,$param1);

			$edit2 = array (
				'status_login'   	=> $this->input->post('status_login')
			);

			$param2 = array(
				'employee_code'   	=> $this->input->post('employee_code')
			);
			
			$this->users_mdl->ubah2($edit2,$param2);

			$this->toastr->success('Updated Successfully');
			redirect($_SERVER['HTTP_REFERER']);
	 }
}