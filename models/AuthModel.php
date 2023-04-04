<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class AuthModel extends CI_Model {
	
	private $login = 'sys_users';

	function get_user($username, $password) {
		
		$user_pass = $this->hash($password);

		$this ->db-> select('sys_users.user_id, sys_users.role_id,  sys_users.name, sys_users.user_name, sys_users.user_status, sys_users.user_type, sys_users.last_logged_in');
           $this ->db-> from('sys_users');
           $this ->db-> where('sys_users.user_name', $username);
           $this ->db-> where('sys_users.user_password', $user_pass);
           $this ->db-> where('sys_users.user_status', 1);
           $this ->db-> limit(1);

           $query = $this->db->get();

             if($query->num_rows() == 1)
             {
               return $query->result();
             }
             else
             {
               return false;
             }
	}


	public function hash ( $string )
     {
       return hash ('sha512', $string . config_item('encryption_key'));
     }
	
}

/* End of file authmodel.php */
/* Location: ./application/models/authmodel.php */