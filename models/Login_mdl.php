<?php
Class Login_mdl extends CI_Model
{
  function login($user_name, $user_password)
     {
       $this ->db-> select('user_id, name, user_name, user_status, user_type');
       $this ->db-> from('users');
       $this ->db-> where('user_name', $user_name);
       $this ->db-> where('user_password', MD5($user_password));
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


     function cekuser($email)
       {
          $this -> db -> select('nik, email, password');
          $this -> db -> from('karyawan');
          $this -> db -> where('email', $email);
          $this -> db -> limit(1);
          $cquery = $this -> db -> get();
          if ($cquery -> num_rows() == 1) {
            return $cquery->result();
          } else {
            return false;
          }
      }
}
?>
