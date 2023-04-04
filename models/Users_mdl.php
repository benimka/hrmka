<?php
Class Users_mdl extends CI_Model
{

  public function save($item){
        $this->db->insert('sys_users',$item);
  }


  public function simpanmod($items){
        $this->db->insert('sys_rule',$items);
  }

  public function update($item,$data)
  {
      $this->db->where($data);
      $this->db->update('sys_users',$item);
  }


  public function frm_edit($item,$data)
  {
      $this->db->where($item);
      $this->db->update('sys_users',$data);
  }


  public function updated($item,$data)
  {
      $this->db->where($data);
      $this->db->update('mod_employee',$item);
  }

  public function ubah($edit,$param)
  {
      $this->db->where($param);
      $this->db->update('mod_employee',$edit);
  }


  public function ubah1($edit1,$param1)
  {
      $this->db->where($param1);
      $this->db->update('sys_users',$edit1);
  }


  public function ubah2($edit2,$param2)
  {
      $this->db->where($param2);
      $this->db->update('mod_employee',$edit2);
  }


  public function updprofile($item,$data)
  {
        $this->db->where($data);
        $this->db->update('mod_employee',$item);
  }


  public function deletemodul($cek){
        $this->db->query("DELETE FROM sys_rule WHERE role_id='$cek'");
  }

  public function clock_in($absen){
    $this->db->insert('mod_absen',$absen);
 }


public function edit_employee($item_data)
{ 
    $this->db->insert('mod_employee_update',$item_data);
}



public function carimanager()
  {
      if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');
            $id     = $session_data['company_code'];
            $code   = $session_data['employee_code'];
            $parent = $session_data['parent'];
            $data   = array();

            $querys = $this->db->query("SELECT parent FROM mod_employee WHERE company_code='$id' AND employee_code ='$code' ");

            foreach ($querys->result() as $row)
            {
               $row->parent;
            }

            $query  = "SELECT email FROM mod_employee WHERE employee_code ='$row->parent' ";

            $Q = $this->db->query($query);

            if ($Q->num_rows() > 0){
                foreach ($Q->result_array() as $row){
                    $data[] = $row;
                }
            }
            return $data;
        }else{
            redirect('login', 'refresh');
        }
  }


public function clock_out($pin,$auto,$user_name,$day_name,$date,$timelog,$date_import,$status_in,$status,$note){
    $data = array(
        'pin' => $pin,
        'auto' => $auto,
        'user_name' => $user_name,
        'day_name' => $day_name,
        'date' => $date,
        'timelog' => $timelog,
        'date_import' => $date_import,
        'status_in' => $status_in,
        'status'  => $status,
        'noted' => $note
    );  

    $result= $this->db->insert('mod_absen',$data);
    return $result;
}


public function get_saldo($id){
if ($this->session->userdata('logged_in'))
    {
        $session_data           = $this->session->userdata('logged_in');
        $company_code           = $session_data['company_code'];
        $year = date('Y');
        $date = date('Y-m-d'); 
        
        $Q                      = $this->db->query("SELECT params_cuti+params_cuti_last_year AS saldo 
                                                        FROM mod_employee 
                                                        WHERE employee_code ='".$id."'");
        $jml                    = $Q->num_rows();
        return $jml;

    } else {
        redirect('login', 'refresh');
    }
}


// public function get_saldo($id){ 
//     if ($this->session->userdata('logged_in'))
//         {
//             $session_data 		  	= $this->session->userdata('logged_in');
//             $company_code 			= $session_data['company_code'];
//             $year = date('Y');
//             $date = date('Y-m-d');
            
//             $query 					= $this->db->query("SELECT params_cuti+params_cuti_last_year AS saldo 
//                                                         FROM mod_employee 
//                                                         WHERE employee_code ='".$id."' ");

//             $Q          = $this->db->query($query); 
//             if ($Q->num_rows() > 0)
//                 {
//                     foreach ($Q->result_array() as $row)
//                     {
//                         $data[] = $row;
//                     }
//                 }
//         return $data;

//         } else {
//             redirect('login', 'refresh');
//         }
// }

public function updateumur($id)
    {
        if($this->session->userdata('logged_in')) {
                $session_data = $this->session->userdata('logged_in');
                $kode     = $session_data['user_id'];
                $data     = array();
                
                $qSelect = $this->db->query("SELECT birth_date FROM mod_employee WHERE employee_code ='".$id."'");
                foreach ($qSelect->result_array() as $row){}

                $birthDt1 = date_create($row['birth_date']);
                $birthDt2 = date_format($birthDt1, "Y-m-d");
                $birthDt = new dateTime($birthDt2);

                $today = new DateTime('today');
                $y = $today->diff($birthDt)->y;
                $m = $today->diff($birthDt)->m;
                $d = $today->diff($birthDt)->d;
                $xy = $y." tahun ".$m." bulan ".$d." hari";
                $umur = $y;

                $this->db->query("UPDATE mod_employee SET age = '".$xy."', ages ='".$umur."' WHERE employee_code ='".$id."' ");

            }else{
                redirect('login', 'refresh');
            }
    }

    public function updatesaldocuti($id)
    {
        if($this->session->userdata('logged_in')) {
                $session_data = $this->session->userdata('logged_in');
                $kode     = $session_data['user_id'];
                $data     = array();
                
                $qSelect = $this->db->query("SELECT log_cuti, params_cuti FROM mod_employee WHERE employee_code ='".$id."'");
                foreach ($qSelect->result_array() as $row){}

                $year  = date('Y');
                $month = date('m');

                /*
                    jika login pertama di tahun saat ini dan diatas bulan 3 
                    maka reset params_cuti menjadi 12 dan reset params_cuti_last_year = 0
                */

                if($row['log_cuti'] < $year AND $month > 03){

                    $this->db->query("UPDATE mod_employee 
                                      SET log_cuti = '".$year."', 
                                      params_cuti = 12,
                                      params_cuti_last_year = 0
                                      WHERE employee_code ='".$id."' ");

                } elseif ($row['log_cuti'] < $year and $month <= 02){

                /*
                    jika login pertama di tahun saat ini dan dibawah bulan 3 
                    maka isi params_cuti menjadi 12 dan isi params_cuti_last_year dari sisa cuti tahun kemaren
                */

                    $this->db->query("UPDATE mod_employee 
                                      SET log_cuti = '".$year."', 
                                      params_cuti = 12,
                                      params_cuti_last_year ='".$row['params_cuti']."' 
                                      WHERE employee_code ='".$id."' ");

                }

            }else{
                redirect('login', 'refresh');
            }
    }

     public function cekIn()
     {
        if($this->session->userdata('logged_in'))
            {
                $session_data 		  	= $this->session->userdata('logged_in');
                $pin                    = $session_data['pin'];
                $day                    = date('Y-m-d'); 
                
                $Q 						= $this->db->query("SELECT status_in, date_format(timelog, '%Y-%m-%d') as date 
                                                            FROM mod_absen 
                                                            WHERE pin ='$pin' AND date_format(timelog, '%Y-%m-%d') = '$day' ");
                $jml    				= $Q->num_rows();
                return $jml;

            }else{
                redirect('login', 'refresh');
            }
    }



    public function cekOut()
     {
        if($this->session->userdata('logged_in'))
            {
                $session_data           = $this->session->userdata('logged_in');
                $pin                    = $session_data['pin'];
                $day                    = date('Y-m-d'); 
                
                $Q                      = $this->db->query("SELECT status_in, date_format(timelog, '%Y-%m-%d') as date 
                                                            FROM mod_absen 
                                                            WHERE pin ='$pin' AND date_format(timelog, '%Y-%m-%d') = '$day' AND status_in = '2' ");
                $jml                    = $Q->num_rows();
                return $jml;

            }else{
                redirect('login', 'refresh');
            }
     }


    public function get($id = NULL)
    {
        $data       = array();

        if($id != NULL){
            $query      .= "SELECT sys_users.name, sys_users.user_name, sys_users.created, sys_users.modified,
                            sys_roles.role_name, sys_users.user_status, sys_users.role_id, sys_users.user_id
                            FROM sys_users 
                            INNER JOIN sys_roles ON sys_users.role_id = sys_roles.role_id
                            WHERE sys_users.user_id = '$id' ";
        }else {
            $query      .= "SELECT sys_users.user_id, sys_users.name, sys_users.user_name, sys_users.created, sys_users.modified,
                            sys_roles.role_name, sys_users.user_status
                            FROM sys_users 
                            INNER JOIN sys_roles ON sys_users.role_id = sys_roles.role_id
                            WHERE sys_users.user_id !=1
                            ORDER BY sys_users.user_id DESC ";
        }
        
        $Q          = $this->db->query($query);
            if ($Q->num_rows() > 0)
                {
                    foreach ($Q->result_array() as $row)
                    {
                        $data[] = $row;
                    }
                }
        return $data;
    }

  public function login($user_name, $password)
     {

      $pas = $this->hash($password);

      /*
            Menghindari SQL Injection 
            text input dibuat sebuah variable dalam bentuk array
            lalu di passing ke dalam query

      */

      $cari = $this->db->query("SELECT * FROM sys_users WHERE user_name = ?", array($user_name));

      foreach ($cari->result() as $row)
      {
             $x   =  $row->last_logged_in;
             $xs  =  $row->user_password;
      }

      if($xs != $pas){


        $this->toastr->info('Username or password incorect');

        $data = array();
        $data['user_name'] = $row->user_name;
        $data['name'] = $row->name;
        $data['icon'] = '<i class="ti-alert btn-icon-prepend" style="color:red;"></i>';
        $data['invalid'] = 'Incorect password...';
        $this->load->view('next', $data);


      }else{ 

        if($x == "0000-00-00 00:00:00"){

           $date = date('Y-m-d H:i:s');

           $this->db->query("UPDATE sys_users SET last_logged_in ='".$date."' WHERE user_name='".$user_name."'");

          $data = array(
              'user_name' =>$user_name
          );

          $this->db->insert('ci_sessions',$data);

           $xxx = $this->hash($password);
           $log = 1;
           $this ->db-> select('sys_users.user_id, mod_employee.employee_code, mod_employee.department_code, mod_employee.company_code, mod_employee.pin, sys_users.role_id, mod_employee.pic, sys_users.name, sys_users.user_name, sys_users.user_status, sys_users.user_type, sys_users.last_logged_in');
           $this ->db-> from('sys_users');
           $this->db->join ( "mod_employee", "mod_employee.employee_code = sys_users.employee_code" );
           $this ->db-> where('sys_users.user_name', $user_name);
           $this ->db-> where('sys_users.user_password', $xxx);
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
          

          if($x != "0000-00-00 00:00:00"){
            $this->toastr->info('Please reset your password to proceed with login!');
            redirect("login/reset/".$user_name);
          }


      }


     }

     public function hash ( $string )
     {
       return hash ('sha512', $string . config_item('encryption_key'));
     }

     function cekuser($user_name)
       {
          $this -> db -> select('user_id, user_name, user_password');
          $this -> db -> from('sys_users');
          $this -> db -> where('user_name', $user_name);
          $this -> db -> limit(1);
          $cquery = $this -> db -> get();
          if ($cquery -> num_rows() == 1) {
            return $cquery->result();
          } else {
            return false;
          }
      }


      public function getmodule()
      {
        if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');
            $id       = $session_data['company_code'];
            $kode     = $session_data['user_id'];
            $data     = array();
            $query    = "SELECT sys_users.name, sys_modules.module_name, sys_modules.module_path, sys_modules.module_slug, sys_modules.module_level, sys_modules.module_parent,
                        sys_modules.module_id, sys_modules.order, sys_modules.symbol, sys_modules.module_child,
                        sys_modules.active_link
                        FROM sys_users
                        INNER JOIN sys_roles ON sys_users.role_id = sys_roles.role_id
                        INNER JOIN sys_rules ON sys_roles.role_id = sys_rules.role_id
                        INNER JOIN sys_modules ON sys_rules.module_id = sys_modules.module_id
                        WHERE sys_users.user_id='".$kode."' AND sys_modules.module_id !=10  ORDER BY sys_modules.order ASC ";
                        //var_dump($query);exit();
            $Q = $this->db->query($query);
            if ($Q->num_rows() > 0){
                foreach ($Q->result_array() as $row){
                    $data[] = $row;
                }
            }
            return $data;
        }else{
            redirect('login', 'refresh');
        }
      }



      public function viewmodule()
      {
        if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');
            $id       = $session_data['company_code'];
            $kode     = $session_data['user_id'];
            $data     = array();
            $query    = "SELECT * FROM sys_modules WHERE module_parent = 10 AND module_status = 1 ";
                        
            $Q = $this->db->query($query);
            if ($Q->num_rows() > 0){
                foreach ($Q->result_array() as $row){
                    $data[] = $row;
                }
            }
            return $data;
        }else{
            redirect('login', 'refresh');
        }
      }



      public function countModule(){
      if ($this->session->userdata('logged_in'))
        {
          $session_data         = $this->session->userdata('logged_in');
          $company_code       = $session_data['company_code'];
          $year = date('Y');
          $date = date('Y-m-d');
          
            $Q            = $this->db->query("SELECT * FROM sys_modules WHERE module_parent = 10 AND module_status = 1 ");
        $jml            = $Q->num_rows();
        return $jml;

      } else {
        redirect('login', 'refresh');
      }
      }



      public function getroles()
      {
        if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');
            $id       = $session_data['company_id'];
            $user_id  = $session_data['user_id'];
            $data     = array();
            $query    = "SELECT * from sys_roles ";

            $Q = $this->db->query($query);
            if ($Q->num_rows() > 0){
                foreach ($Q->result_array() as $row){
                    $data[] = $row;
                }
            }
            return $data;
        }else{
            redirect('login', 'refresh');
        }
      }



      public function getdatamodule()
      {
          if($this->session->userdata('logged_in'))
          {
              $session_data = $this->session->userdata('logged_in');
              $id       = $session_data['company_id'];
              $user_id  = $session_data['user_id'];
              $data     = array();
              $query    = "SELECT * from sys_module ";

              $Q = $this->db->query($query);
              if ($Q->num_rows() > 0){
                  foreach ($Q->result_array() as $row){
                      $data[] = $row;
                  }
              }
              return $data;
          }else{
              redirect('login', 'refresh');
          }
      }



      public function getcek($id)
      {
          if($this->session->userdata('logged_in'))
          {
              $session_data = $this->session->userdata('logged_in');
              $user_id  = $session_data['user_id'];
              $data     = array();
              $query    = "SELECT sys_roles.*, sys_rule.module_id as oke, sys_module.module_id
                          from sys_roles
                          inner join sys_rule on sys_roles.role_id = sys_rule.role_id
                          inner join sys_module on sys_rule.module_id = sys_module.module_id
                          where sys_roles.role_id='$id' ";
                          //var_dump($query);exit();
              $Q = $this->db->query($query);
              if ($Q->num_rows() > 0){
                  foreach ($Q->result_array() as $row){
                      $data[] = $row;
                  }
              }
              return $data;
          }else{
              redirect('login', 'refresh');
          }
      }



      public function getdatas()
      {
          if($this->session->userdata('logged_in'))
          {
              $session_data = $this->session->userdata('logged_in');
              $id           = $session_data['employee_code'];
              $data         = array();

              $query    = "SELECT mod_department.department_name, mod_position.position_name, mod_company.company_name, mod_employee.*, mod_location.location_name, mod_bank.bank_name, mod_employee_status.mod_status_name, mod_level.level_name
                           from mod_employee
                           inner join mod_department on mod_employee.department_code = mod_department.department_code
                           inner join mod_position on mod_employee.position_code = mod_position.position_code
                           inner join mod_company on mod_employee.company_code = mod_company.company_code
                           inner join mod_location on mod_employee.location = mod_location.location_id
                           inner join mod_bank on mod_employee.bank_id = mod_bank.bank_id
                           inner join mod_level on mod_employee.level = mod_level.level
                           inner join mod_employee_status on mod_employee.mod_status_code = mod_employee_status.mod_status_code
                           WHERE mod_employee.employee_code='$id' ";
             //echo "<pre>";var_dump($query);exit();
              $Q = $this->db->query($query);
              if ($Q->num_rows() > 0){
                  foreach ($Q->result_array() as $row){
                      $data[] = $row;
                  }
              }
              return $data;
          }else{
              redirect('login', 'refresh');
          }
      }



      public function getquery($id)
      {
          if($this->session->userdata('logged_in'))
          {
              $session_data = $this->session->userdata('logged_in');
              //$id  = $session_data['employee_code'];
              $data     = array();

              $query    = "SELECT mod_division.division_name, mod_position.position_name, mod_company.company_name, mod_employee.*, mod_location.location_name, mod_bank.bank_name, mod_employee_status.mod_status_name, mod_insurance.*
                           from mod_employee
                           inner join mod_division on mod_employee.division_code = mod_division.division_code
                           inner join mod_position on mod_employee.position_code = mod_position.position_code
                           inner join mod_company on mod_employee.company_code = mod_company.company_code
                           inner join mod_location on mod_employee.location = mod_location.location_id
                           inner join mod_bank on mod_employee.bank_id = mod_bank.bank_id
                           inner join mod_employee_status on mod_employee.mod_status_code = mod_employee_status.mod_status_code
                           inner join mod_insurance on mod_employee.employee_code = mod_insurance.employee_code
                           WHERE mod_employee.employee_code='$id' ";
             // echo "<pre>";var_dump($query);exit();
              $Q = $this->db->query($query);
              if ($Q->num_rows() > 0){
                  foreach ($Q->result_array() as $row){
                      $data[] = $row;
                  }
              }
              return $data;
          }else{
              redirect('login', 'refresh');
          }
      }


      public function getparents()
      {
          if($this->session->userdata('logged_in'))
          {
              $session_data = $this->session->userdata('logged_in');
              $id           = $session_data['employee_code'];
              $role_id                        = $session_data['role_id'];
              $company_code                   = $session_data['company_code'];
              $inisial                        = $session_data['inisial'];
              $data     = array();

              $query     = "SELECT mod_employee.employee_name, mod_employee.employee_code
                            FROM mod_employee
                            INNER JOIN mod_position ON mod_position.position_code = mod_employee.position_code ";

              if($role_id < 6 ){
                  $query .= "WHERE mod_position.levels ='1' ";
              }else{
                  $query .= "WHERE mod_position.levels = '1' AND mod_employee.company_code='$company_code' ";
              }

              $Q = $this->db->query($query);
              if ($Q->num_rows() > 0){
                  foreach ($Q->result_array() as $row){
                      $data[] = $row;
                  }
              }
              return $data;
          }else{
              redirect('login', 'refresh');
          }
      }


      public function getdoc()
      {
          if($this->session->userdata('logged_in'))
          {
              $session_data = $this->session->userdata('logged_in');
              $id  = $session_data['employee_code'];
              $data     = array();

              $query    = "SELECT *
                           from mod_document_employee
                           WHERE employee_code='$id' ";
             // echo "<pre>";var_dump($query);exit();
              $Q = $this->db->query($query);
              if ($Q->num_rows() > 0){
                  foreach ($Q->result_array() as $row){
                      $data[] = $row;
                  }
              }
              return $data;
          }else{
              redirect('login', 'refresh');
          }
      }


      public function getinsurance()
        {
          if($this->session->userdata('logged_in'))
            {
                $session_data = $this->session->userdata('logged_in');
                $id           = $session_data['employee_code'];

                $data       = array();
                $query      = "SELECT * FROM mod_insurance WHERE employee_code='$id' ";

                $Q          = $this->db->query($query);
                    if ($Q->num_rows() > 0)
                        {
                          foreach ($Q->result_array() as $row)
                            {
                              $data[] = $row;
                            }
                        }
           return $data;

           }else{
              redirect('login', 'refresh');
          }
        }


    public function getassets()
      {
         if($this->session->userdata('logged_in'))
            {
                $session_data = $this->session->userdata('logged_in');
                $id           = $session_data['employee_code'];

                $data       = array();
                $query      = "SELECT mod_employee.*, mod_detail_assets.*, mod_master_assets.*
                               FROM mod_employee
                               INNER JOIN mod_detail_assets ON mod_employee.employee_code = mod_detail_assets.employee_code
                               INNER JOIN mod_master_assets ON mod_detail_assets.item_code = mod_master_assets.item_code
                               WHERE mod_employee.employee_code='$id' GROUP BY mod_detail_assets.item_code ";

                $Q          = $this->db->query($query);
                    if ($Q->num_rows() > 0)
                        {
                          foreach ($Q->result_array() as $row)
                            {
                              $data[] = $row;
                            }
                        }
                return $data;
          }else{
              redirect('login', 'refresh');
          }
      }


      public function getexperience()
      {
           if($this->session->userdata('logged_in'))
            {
                $session_data = $this->session->userdata('logged_in');
                $id           = $session_data['employee_code'];
                $data       = array();
                $query      = "SELECT * FROM mod_experience WHERE employee_code='$id' ";
                //var_dump($query);exit();
                $Q          = $this->db->query($query);
                    if ($Q->num_rows() > 0)
                        {
                          foreach ($Q->result_array() as $row)
                            {
                              $data[] = $row;
                            }
                        }
              return $data;

        }else{
              redirect('login', 'refresh');
          }

      }



      public function geteducation()
      {
           if($this->session->userdata('logged_in'))
            {
                $session_data = $this->session->userdata('logged_in');
                $id           = $session_data['employee_code'];
                $data       = array();
                $query      = "SELECT * FROM mod_education WHERE employee_code='$id' ";
                //var_dump($query);exit();
                $Q          = $this->db->query($query);
                    if ($Q->num_rows() > 0)
                        {
                          foreach ($Q->result_array() as $row)
                            {
                              $data[] = $row;
                            }
                        }
              return $data;
            }else{
            redirect('login', 'refresh');
        }
      }


      public function getsertifikat()
      {
          if($this->session->userdata('logged_in'))
            {
                $session_data = $this->session->userdata('logged_in');
                $id           = $session_data['employee_code'];
                $data       = array();
                $query      = "SELECT * FROM mod_training_certificate WHERE employee_code='$id' ";
                $Q          = $this->db->query($query);
                    if ($Q->num_rows() > 0)
                        {
                          foreach ($Q->result_array() as $row)
                            {
                              $data[] = $row;
                            }
                        }
              return $data;
            }else{
            redirect('login', 'refresh');
        }
      }

      public function auto() {

          if ($this->session->userdata('logged_in'))
              {
                  $session_data                   = $this->session->userdata('logged_in');
                  $user_id                        = $session_data['user_id'];
                  $role_id                        = $session_data['role_id'];
                  $company_code                   = $session_data['company_code'];
                  $inisial                        = $session_data['inisial'];
                  $data                           = array();

                  if($role_id == "3" || $role_id =="1"){

                      $q  = $this->db->query("SELECT MAX(RIGHT(employee_code,3)) AS idmax FROM mod_employee ");

                      $id = "";
                      $thn     = date("Y");
                      $bln     = date("m");
                      $tgl     = date("d");
                      $sub_thn = substr($thn,2);

                      if($q->num_rows()>0){
                          foreach($q->result() as $k){
                              $tmp = ((int)$k->idmax)+1;
                              $id = sprintf("%03s", $tmp);
                          }
                      }else{
                          $id = "116";
                      }

                      $kar ="7020";

                      return $kar.$id;

                  }else{

                      $q = $this->db->query("SELECT MAX(RIGHT(employee_code,2)) AS idmax FROM mod_employee WHERE company_code='$company_code' ");

                      $kd = "";

                      if($q->num_rows()>0){
                          foreach($q->result() as $k){
                              $tmp = ((int)$k->idmax)+1;
                              $kd = sprintf("%03s", $tmp);
                          }
                      }else{
                          $kd = "001";
                      }
                      $kar = "$inisial-ID";

                      return $kar.$kd;

                  }

                } else {
                   redirect('login', 'refresh');
               }
      }


      public function getusers()
      {
          if($this->session->userdata('logged_in'))
            {
                $session_data = $this->session->userdata('logged_in');
                $id           = $session_data['employee_code'];
                $data       = array();
                $query      = "SELECT mod_employee.*, mod_company.company_name
                               FROM mod_employee
                               INNER JOIN mod_company ON mod_employee.company_code = mod_company.company_code ";

                $Q          = $this->db->query($query);
                    if ($Q->num_rows() > 0)
                        {
                          foreach ($Q->result_array() as $row)
                            {
                              $data[] = $row;
                            }
                        }
              return $data;
            }else{
            redirect('login', 'refresh');
        }
      }


      public function getuser()
      {
          if($this->session->userdata('logged_in'))
            {
                $session_data = $this->session->userdata('logged_in');
                $id           = $session_data['employee_code'];
                $data       = array();
                $query      = "SELECT sys_users.*, mod_company.company_name
                               FROM sys_users
                               INNER JOIN mod_company ON sys_users.company_code = mod_company.company_code ";
                //var_dump($query);exit();
                $Q          = $this->db->query($query);
                    if ($Q->num_rows() > 0)
                        {
                          foreach ($Q->result_array() as $row)
                            {
                              $data[] = $row;
                            }
                        }
              return $data;
            }else{
            redirect('login', 'refresh');
        }
      }

      public function setting_users($id)
      {
          if($this->session->userdata('logged_in'))
            {
                $session_data = $this->session->userdata('logged_in');
                $data       = array();
                $query      = "SELECT mod_company.inisial, mod_company.company_id, mod_employee.*
                               FROM mod_employee
                               INNER JOIN mod_company ON mod_employee.company_code = mod_company.company_code
                               WHERE employee_code='$id' ";

                $Q          = $this->db->query($query);

                    if ($Q->num_rows() > 0)
                        {
                          foreach ($Q->result_array() as $row)
                            {
                              $data[] = $row;
                            }
                        }
              return $data;
            }else{
              redirect('login', 'refresh');
          }
      }

      public function edit_users($id)
      {
          if($this->session->userdata('logged_in'))
            {
                $session_data = $this->session->userdata('logged_in');
                $data         = array();
                $query        = "SELECT sys_users.employee_code, sys_users.user_type, sys_users.role_id, sys_users.user_name as nama, mod_employee.parent,
                                 mod_employee.employee_name, mod_employee.status_login, mod_employee.company_code, mod_company.inisial
                                 FROM sys_users
                                 INNER JOIN mod_employee ON sys_users.employee_code = mod_employee.employee_code
                                 INNER JOIN mod_company ON sys_users.company_code = mod_company.company_code
                                 WHERE sys_users.employee_code='$id' ";
                $Q            =  $this->db->query($query);

                    if ($Q->num_rows() > 0)
                        {
                          foreach ($Q->result_array() as $row)
                            {
                              $data[] = $row;
                            }
                        }

                return $data;

            }else{
              redirect('login', 'refresh');
            }
        }


      public function editusers($a)
      {
          if($this->session->userdata('logged_in'))
            {
                $session_data = $this->session->userdata('logged_in');
                $data         = array();
                $query        = "SELECT sys_users.employee_code, sys_users.user_type, sys_users.role_id, sys_users.user_name, sys_users.name, mod_company.company_name, mod_company.company_code, sys_users.user_type, sys_users.user_id, sys_users.user_status
                                 FROM sys_users
                                 INNER JOIN mod_company ON sys_users.company_code = mod_company.company_code
                                 WHERE sys_users.user_id='$a' ";
                $Q            =  $this->db->query($query);

                    if ($Q->num_rows() > 0)
                        {
                          foreach ($Q->result_array() as $row)
                            {
                              $data[] = $row;
                            }
                        }

                return $data;

            }else{
              redirect('login', 'refresh');
            }
        }



        public function getbirthday()
        {
            $query        = "SELECT * FROM mod_employee WHERE mod_status_code !='ST004' AND company_code NOT LIKE ('TTK%') GROUP BY employee_code";
                $Q        =  $this->db->query($query);

                    if ($Q->num_rows() > 0)
                        {
                          foreach ($Q->result_array() as $row)
                            {
                              $data[] = $row;
                            }
                        }

                return $data;
        }


        public function getbirthdaynow()
        {
        //Rincian ulang tahun setiap bulan (range 30 hari dari hari saat ini)
        //Date  hari ini tampilkan
        //query + 30 hari kedepan
        //SELECT employee_name FROM mod_employee WHERE DATE_FORMAT( birth_date, '%m/%d' ) >= '$params' AND DATE_FORMAT( birth_date, '%m/%d' ) <= '02/14'

        $params         = date('m-d');
        $tigapuluh      = mktime(0,0,0,date("n"),date("j")+30,date("Y"));
        $akhir          = date("m-d", $tigapuluh);

        $data       = array();
              $query      = "SELECT employee_name, DATE_FORMAT(birth_date, '%d') as tanggal, DATE_FORMAT( birth_date, '%m-%d' ) as datasama,
                  MONTHNAME(birth_date) as bulan
                  FROM mod_employee
                  WHERE DATE_FORMAT( birth_date, '%m-%d' ) >= '$params' AND company_code NOT LIKE ('TTK%')
                  AND DATE_FORMAT( birth_date, '%m-%d' ) <= '$akhir' and mod_status_code NOT IN ('ST004','ST006') GROUP BY employee_code ORDER BY DATE_FORMAT( birth_date, '%m-%d' ) ASC ";

        $Q          = $this->db->query($query);

        if ($Q->num_rows() > 0)
          {
            foreach ($Q->result_array() as $row)
              {
                $data[] = $row;
              }
          }
        return $data;
        }

        //untuk select dropdown

        public function get_companyss(){
            $query        = "SELECT * FROM mod_company";
                $Q        =  $this->db->query($query);

                    if ($Q->num_rows() > 0)
                        {
                          foreach ($Q->result_array() as $row)
                            {
                              $data[] = $row;
                            }
                        }

                return $data;
        }
        //untuk select dropdown
        public function get_employeesss($company_code){
            $query        = "SELECT * FROM mod_employee WHERE company_code='$id'";
                $Q        =  $this->db->query($query);

                    if ($Q->num_rows() > 0)
                        {
                          foreach ($Q->result_array() as $row)
                            {
                              $data[] = $row;
                            }
                        }

                return $data;
        }


        function get_company()
        {
            $result = $this->db->get('mod_company')->result();

            $id = array('0');
            $name = array('Select Company');

            for ($i = 0; $i < count($result); $i++)
            {
                array_push($id, $result[$i]->company_code);
                array_push($name, $result[$i]->company_name);
            }
            return array_combine($id, $name);
        }


        function get_employee($id=NULL)
        {
            $result = $this->db->where('company_code', $id)->get('mod_employee')->result();
            $id = array('0');
            $name = array('Select Employee');
            for ($i=0; $i<count($result); $i++)
            {
                array_push($id, $result[$i]->employee_code);
                array_push($name, $result[$i]->employee_name);
            }
            return array_combine($id, $name);
        }


        public function getaps()
        {
          if($this->session->userdata('logged_in'))
              {
                  $session_data = $this->session->userdata('logged_in');
                  $id    = $session_data['company_code'];
                  $data   = array();
                  $query  = "SELECT * FROM mod_aps ORDER BY position ASC ";

                  $Q = $this->db->query($query);

                  if ($Q->num_rows() > 0){
                      foreach ($Q->result_array() as $row){
                          $data[] = $row;
                      }
                  }
                  return $data;
              }else{
                  redirect('login', 'refresh');
              }
        }


        public function getup()
        {
          if($this->session->userdata('logged_in'))
              {
                  $session_data = $this->session->userdata('logged_in');
                  $id    = $session_data['company_code'];
                  $data   = array();
                  $query  = "SELECT mod_aps.app_name, mod_aps.id_aps, mod_panduan.*
                             FROM mod_panduan
                             INNER JOIN mod_aps ON mod_panduan.id_aps = mod_aps.id_aps ";

                  $Q = $this->db->query($query);

                  if ($Q->num_rows() > 0){
                      foreach ($Q->result_array() as $row){
                          $data[] = $row;
                      }
                  }
                  return $data;
              }else{
                  redirect('login', 'refresh');
              }
        }



        public function editup($a)
        {
          if($this->session->userdata('logged_in'))
              {
                  $session_data = $this->session->userdata('logged_in');
                  $id    = $session_data['company_code'];
                  $data   = array();
                  $query  = "SELECT mod_aps.app_name, mod_aps.id_aps, mod_panduan.*
                             FROM mod_panduan
                             INNER JOIN mod_aps ON mod_panduan.id_aps = mod_aps.id_aps
                             WHERE mod_panduan.id='$a'";

                  $Q = $this->db->query($query);

                  if ($Q->num_rows() > 0){
                      foreach ($Q->result_array() as $row){
                          $data[] = $row;
                      }
                  }
                  return $data;
              }else{
                  redirect('login', 'refresh');
              }
        }


        public function saveup($item){
            $this->db->insert('mod_panduan',$item);
        }

        public function updateup($item,$data)
        {
            $this->db->where($data);
            $this->db->update('mod_panduan',$item);
        }


        public function delUp($id){
            $this->db->query("delete  from mod_panduan where id='$id'");
        }


        //////////////////////////////////////////////////////////////////

        public function editapp($a)
        {
          if($this->session->userdata('logged_in'))
              {
                  $session_data = $this->session->userdata('logged_in');
                  $id    = $session_data['company_code'];
                  $data   = array();
                  $query  = "SELECT * FROM mod_aps WHERE id_aps='$a'";

                  $Q = $this->db->query($query);

                  if ($Q->num_rows() > 0){
                      foreach ($Q->result_array() as $row){
                          $data[] = $row;
                      }
                  }
                  return $data;
              }else{
                  redirect('login', 'refresh');
              }
        }


        public function saveapp($item){
            $this->db->insert('mod_aps',$item);
        }

        public function updateapps($item,$data)
        {
            $this->db->where($data);
            $this->db->update('mod_aps',$item);
        }


        public function delaps($id){
            $this->db->query("delete  from mod_aps where id_aps='$id'");
        }


        public function configurasi(){
          $query        = "SELECT * FROM setting";
          $Q        =  $this->db->query($query);

            if ($Q->num_rows() > 0)
                {
                  foreach ($Q->result_array() as $row)
                    {
                      $data[] = $row;
                    }
                }
            return $data;
        }


        public function get_email()
        {
            $data       = array();
            $query      = "SELECT user_name FROM sys_users ";
            $Q          = $this->db->query($query);
                if ($Q->num_rows() > 0)
                    {
                      foreach ($Q->result_array() as $row)
                        {
                          $data[] = $row;
                        }
                    }
          return $data;
        }


        public function save_version($item){
          $this->db->insert('mod_versions',$item);
        }

        public function getversions(){
        $query        = "SELECT mod_versions.version_id, mod_versions.version, mod_versions.subject, DATE_FORMAT(mod_versions.created, '%d-%m-%Y') AS created, sys_users.name
                        FROM mod_versions
                        INNER JOIN sys_users ON mod_versions.users_id = sys_users.user_id ORDER BY version DESC ";
            $Q        =  $this->db->query($query);

                if ($Q->num_rows() > 0)
                    {
                      foreach ($Q->result_array() as $row)
                        {
                          $data[] = $row;
                        }
                    }

            return $data;
        }


        public function viewslog($date1,$date2)
        {
            if($this->session->userdata('logged_in'))
            {
                $session_data = $this->session->userdata('logged_in');

                $data     = array();
                $query    = "SELECT sys_logs.*, sys_users.name
                             FROM sys_logs
                             INNER JOIN sys_users ON sys_logs.user_id = sys_users.user_id
                             WHERE  sys_logs.log_date >='".$date1."' AND sys_logs.log_date <= '".$date2."' ";

                $Q = $this->db->query($query);
                if ($Q->num_rows() > 0){
                    foreach ($Q->result_array() as $row){
                        $data[] = $row;
                    }
                }
                return $data;
            }else{
                redirect('login', 'refresh');
            }
        }


        public function get_emails()
        {
            $data       = array();
            $query      = "SELECT user_name FROM sys_users WHERE type != 'staff' ";
            $Q          = $this->db->query($query);
                if ($Q->num_rows() > 0)
                    {
                      foreach ($Q->result_array() as $row)
                        {
                          $data[] = $row;
                        }
                    }
          return $data;
        }


      public function get_verion()
      {
          if ($this->session->userdata('logged_in'))
            {
                $session_data                   = $this->session->userdata('logged_in');
                $kelamin                        = $session_data['sex'];
                $user_type                      = $session_data['user_type'];
                $role_id                        = $session_data['role_id'];
                $company_code                   = $session_data['company_code'];
                $employee_code                  = $session_data['employee_code'];
  
                $query = "SELECT version FROM mod_versions ";
  
                $Q      = $this->db->query($query);
                if ($Q->num_rows() > 0){
                  foreach ($Q->result_array() as $row){
                    $data[] = $row;
                  }
                }
                return $data;
  
          } else {
              redirect('login', 'refresh');
          }
      }

      public function get_modules_parent ( )
      {
            if ($this->session->userdata('logged_in'))
                {
                    $session_data                   = $this->session->userdata('logged_in');
                    $data     = array();
                    $query    = "SELECT sys_users.name, sys_module.*
                                FROM sys_users 
                                INNER JOIN sys_roles ON sys_users.role_id = sys_roles.role_id 
                                INNER JOIN sys_rule ON sys_roles.role_id = sys_rule.role_id 
                                INNER JOIN sys_module ON sys_rule.module_id = sys_module.module_id 
                                WHERE sys_users.user_id='".$session_data['user_id']."' AND sys_users.role_id='".$session_data['role_id']."' AND  sys_module.module_level = 1
                                ORDER BY sys_module.module_order ASC ";
                                
                    $Q = $this->db->query($query);
                    if ($Q->num_rows() > 0){
                        foreach ($Q->result_array() as $row){
                            $data[] = $row;
                        }
                    }
                    return $data;
                    
                } else {
                    redirect('login', 'refresh');
                }
      }

      public function get_modules_childs ( )
      {
            if ($this->session->userdata('logged_in'))
                {
                    $session_data                   = $this->session->userdata('logged_in');
                    $data     = array();
                    $query    = "SELECT sys_users.name, sys_module.*
                                FROM sys_users 
                                INNER JOIN sys_roles ON sys_users.role_id = sys_roles.role_id 
                                INNER JOIN sys_rule ON sys_roles.role_id = sys_rule.role_id 
                                INNER JOIN sys_module ON sys_rule.module_id = sys_module.module_id 
                                WHERE sys_users.user_id='".$session_data['user_id']."' AND sys_users.role_id='".$session_data['role_id']."' AND  sys_module.module_level = 2
                                ORDER BY sys_module.module_order ASC ";
                                
                    $Q = $this->db->query($query);
                    if ($Q->num_rows() > 0){
                        foreach ($Q->result_array() as $row){
                            $data[] = $row;
                        }
                    }
                    return $data;
                    
                } else {
                    redirect('login', 'refresh');
                }
      }


      public function get_modules_active ( $uri1 )
      {
            if ($this->session->userdata('logged_in'))
                {
                    $session_data                   = $this->session->userdata('logged_in');
                    $data     = array();
                    $query    = "SELECT sys_users.name, sys_module.*
                                FROM sys_users 
                                INNER JOIN sys_roles ON sys_users.role_id = sys_roles.role_id 
                                INNER JOIN sys_rule ON sys_roles.role_id = sys_rule.role_id 
                                INNER JOIN sys_module ON sys_rule.module_id = sys_module.module_id 
                                WHERE sys_users.module_path='".$uri1."'
                                ORDER BY sys_module.module_order ASC ";
                                
                    $Q = $this->db->query($query);
                    if ($Q->num_rows() > 0){
                        foreach ($Q->result_array() as $row){
                            $data[] = $row;
                        }
                    }
                    return $data;
                    
                } else {
                    redirect('login', 'refresh');
                }
      }



        public function get_modules ( $roles = NULL )
        {
            if ($this->session->userdata('logged_in'))
                {
                    $session_data                   = $this->session->userdata('logged_in');
                    $data     = array();

                    $qSelect = $this->db->query("SELECT *
                    FROM sys_module 
                    WHERE module_path='".$roles."'");

                    foreach ($qSelect->result_array() as $row){}

                    $query    = "SELECT sys_users.name, sys_module . *
                                    FROM sys_users
                                    INNER JOIN sys_roles ON sys_users.role_id = sys_roles.role_id
                                    INNER JOIN sys_rule ON sys_roles.role_id = sys_rule.role_id
                                    INNER JOIN sys_module ON sys_rule.module_id = sys_module.module_id
                                    WHERE sys_module.module_parent = '".$row['module_id']."'
                                    AND sys_users.user_id = '".$session_data['user_id']."' ";
                                //var_dump($query);exit();
                    $Q = $this->db->query($query);
                    if ($Q->num_rows() > 0){
                        foreach ($Q->result_array() as $row){
                            $data[] = $row;
                        }
                    }
                    return $data;
                    
                } else {
                    redirect('login', 'refresh');
                }
        }


      public function user_info ($segment2,$segment3,$segment4) 
      {  
        if ($this->session->userdata('logged_in'))
            {
                $session_data                   = $this->session->userdata('logged_in');
                $data                           = array();

                $parent    = $this->db->query("SELECT module_path, module_id FROM sys_module WHERE module_path = '".$segment2."' ")->row();

                if($segment2 != NULL AND $segment3 == NULL)
                {
                    //echo "Parent";
                    $Q         = $this->db->query("SELECT sys_users.name, sys_module.*
                                FROM sys_users 
                                INNER JOIN sys_roles ON sys_users.role_id = sys_roles.role_id 
                                INNER JOIN sys_rule ON sys_roles.role_id = sys_rule.role_id 
                                INNER JOIN sys_module ON sys_rule.module_id = sys_module.module_id 
                                WHERE sys_users.user_id='".$session_data['user_id']."' 
                                AND sys_module.module_path='".$segment2."'");
                }

                if($segment2 != NULL AND $segment3 != NULL AND $segment4 == NULL)
                {
                    //echo "function";
                    $Q         = $this->db->query("SELECT sys_users.name, sys_module.*
                                FROM sys_users 
                                INNER JOIN sys_roles ON sys_users.role_id = sys_roles.role_id 
                                INNER JOIN sys_rule ON sys_roles.role_id = sys_rule.role_id 
                                INNER JOIN sys_module ON sys_rule.module_id = sys_module.module_id 
                                WHERE sys_users.user_id='".$session_data['user_id']."' 
                                AND sys_module.module_parent='".$parent->module_id."' AND sys_module.module_level = 3 ");
                }

                if($segment2 != NULL AND $segment3 != NULL AND $segment4 != NULL)
                {
                   //echo "params";
                } 

                              

                $jml                    = $Q->num_rows();

                return $jml;
                
            } else {
                redirect('login', 'refresh');
            }
    }


    public function gethire()
    {
      if ($this->session->userdata('logged_in'))
          {
              $session_data                   = $this->session->userdata('logged_in');

              $data       = array();
              $query      = "SELECT * FROM mod_employee WHERE employee_code = '".$session_data['employee_code']."' ";

              $Q          = $this->db->query($query);
                  if ($Q->num_rows() > 0)
                      {
                        foreach ($Q->result_array() as $row)
                          {
                            $data[] = $row;
                          }
                      }
             return $data;

         } else {
             redirect('login', 'refresh');
         }
    }




    public function get_param()
    {
        if ($this->session->userdata('logged_in'))
          {
              $session_data                   = $this->session->userdata('logged_in');

              $query = "SELECT * FROM mod_params ";

              $Q      = $this->db->query($query);
              if ($Q->num_rows() > 0){
                foreach ($Q->result_array() as $row){
                  $data[] = $row;
                }
              }
              return $data;

        } else {
            redirect('login', 'refresh');
        }
    }


    public function get_email_parents()
    {
         if ($this->session->userdata('logged_in'))
          {
            $session_data                   = $this->session->userdata('logged_in');

            $data   = array();

            $querys = $this->db->query("SELECT parent FROM mod_employee 
                                        WHERE employee_code ='".$session_data['employee_code']."' ");

            foreach ($querys->result() as $row)
            {
                $row->parent;
            }

            $query  = "SELECT email FROM mod_employee WHERE employee_code ='".$row->parent."' ";

                $Q = $this->db->query($query);

            if ($Q->num_rows() > 0){
                foreach ($Q->result_array() as $row){
                    $data[] = $row;
                }
            }
            return $data;

        } else {
            redirect('login', 'refresh');
        }
    } 


    public function getemail()
    {
         if ($this->session->userdata('logged_in'))
          {
            $session_data                   = $this->session->userdata('logged_in');

            $data   = array();

            $query = "SELECT * FROM mod_email_redirect_leave ";

            $Q = $this->db->query($query);

            if ($Q->num_rows() > 0){
                foreach ($Q->result_array() as $row){
                    $data[] = $row;
                }
            }
            return $data;

        } else {
            redirect('login', 'refresh');
        }
    }

}


?>
