<?php
Class Model_login extends CI_Model
{
  function login($email, $password)
     {
       $this ->db-> select('nik, nama, email, level, tglgabung, defaultcuti, sisacuti, iddivisi');
       $this ->db-> from('karyawan');
       $this ->db-> where('email', $email);
       $this ->db-> where('password', MD5($password));
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
