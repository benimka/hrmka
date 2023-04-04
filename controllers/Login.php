<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	 	{
	   		parent::__construct();

    			$this->load->helper(array('form', 'url', 'inflector'));
    			$this->load->library(array('session','form_validation','toastr'));
    			$this->load->model(array('msg_mdl','users_mdl','company_mdl','status_mdl'));
	 	}


		public function index()
		{
		 $this->load->view('login');
		}


	  public function authCheck()
	  {
	  		$user_name = $this->input->post('user_name');
	  		$sQl = $this->db->query("SELECT user_name, name FROM sys_users WHERE user_name = ?", array($user_name));

	      foreach ($sQl->result() as $row){}

	      if($row->user_name == $user_name){
	      	$data = array();
	      	$data['user_name'] = $row->user_name;
	      	$data['name'] = $row->name;
	      	$this->load->view('next', $data);
	      }else{
	      	$data = array();
	      	$data['invalid'] = "Couldn't find your DSM Account";
	      	$this->load->view('login', $data);
	      }
	      
	  }


  public function next()
  {
  		$this->load->view('next');
  }


	public function logout($user_name)
	 {
			$this->db->query("UPDATE sys_users SET last_logged_in ='0000-00-00 00:00:00' WHERE user_name='".$user_name."'");
      $this->session->unset_userdata('logged_in');
			$uri = '../index.php';
		  redirect($uri);
	 }

	 public function reset()
	 {

	 	$user_name = $this->uri->segment(3);
	 	$query = $this->db->query("SELECT * FROM sys_users WHERE user_name ='$user_name' ");

	    foreach ($query->result() as $row)
	    {
	       $x = array();
	       $x['name']  =  $row->user_name;

	    }

	 	$this->toastr->info('User active. Please reset your password to proceed with login');
	 	$this->load->view('reset', $x);
	 }


	 public function resets()
	 { 
	 	$user = $this->input->post('user_name');
	 	$xxx  = $this->hash($this->input->post('user_password'));
	 	$cek  = $this->db->query("SELECT user_password FROM sys_users WHERE user_name ='$user' ");

	 	foreach ($cek->result() as $row)
	    {
	       $row->user_password;
	    }

	    if($xxx == $row->user_password){
			
				$this->db->query("UPDATE sys_users SET last_logged_in ='0000-00-00 00:00:00' WHERE user_name ='$user' ");
				redirect('login', 'refresh');

	    }else{

	    	$this->toastr->warning('Password Invalid');
	    	$redirect = redirect($_SERVER['HTTP_REFERER']);
	    	
	    }
	 }


	 public function hash ( $string )
     {
       return hash ('sha512', $string . config_item('encryption_key'));
     }


   public function cek(){
   		if($this->session->userdata('logged_in'))
	   	{
		    	$session_data   			= $this->session->userdata('logged_in');
		    	$user_name      	    	= $session_data['user_name'];
		    	$sess      	    	        = $session_data['datelogin'];

		    	$select = $this->db->query("SELECT * FROM sys_users WHERE user_name = '$user_name' ")->row();

		        $waktu = $select->datelogin;
		        if($sess != $waktu){
		            $this->session->unset_userdata('logged_in');
    				redirect('login', 'refresh');
		        }else{

		        }


		}else{
			redirect('login', 'refresh');
		}

   }


     public function cek_session()
     {
			$x = "0000-00-00 00:00:00";
			$updated[] = array(
				'user_name'		=> $user,
				'datelogin' 	=> $x
			);
			$this->db->update_batch('sys_users', $updated, 'user_name');
     }


     public function out()
     {

     		if($this->session->userdata('logged_in'))
		   	{
			    	$session_data   			= $this->session->userdata('logged_in');
			    	$user_name      	    	= $session_data['user_name'];

			    	$upd[] = array(
									'user_name' => $user_name,
									'datelogin'=> '0000-00-00 00:00:00'
							);

					$this->db->update_batch('sys_users',$upd,'user_name');
					redirect('login', 'refresh');
			}

     }

}

?>
