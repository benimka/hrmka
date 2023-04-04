<?php
Class Roles_mdl extends CI_Model
{

  public function save($item){
        $this->db->insert('sys_users',$item);
  }


  public function simpanmod($items){
        $this->db->insert('sys_rules',$items);
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


 public function simpan_roles($role_name,$role_status,$role_description,$users,$created){
      $data = array(
              'role_name' => $role_name,
              'role_status'    => $role_status,
              'role_description' => $role_description,
              'user_id' => $users,
              'created' => $created
          );  
      $result= $this->db->insert('sys_roles',$data);
      return $result;
  }


  public function deletemodul($cek){
        $this->db->query("delete  from sys_rules where role_id='$cek'");
    }


  public function get($id = NULL)
      {
          $data       = array();

          if($id != NULL){
              $query      .= "SELECT * FROM sys_roles WHERE role_id = '$id' ";
          }else {
              $query      .= "SELECT * FROM sys_roles
                              ORDER BY role_id DESC ";
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


      public function getNames($id)
      {
          $data       = array();

         $query      .= "SELECT * FROM sys_roles WHERE role_id = '$id' ";
          
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




      public function getsysModule()
      {
          $data       = array();

          // $query      .= "SELECT sys_modules.module_name, sys_modules.module_level, sys_modules.module_path, sys_modules.module_id, sys_modules.module_parent
          //                 FROM sys_roles
          //                 INNER JOIN sys_rules ON sys_roles.role_id = sys_rules.role_id
          //                 INNER JOIN sys_modules ON sys_rules.module_id = sys_modules.module_id
          //                 ORDER BY sys_modules.module_id ASC ";


           $query      .= "SELECT * FROM sys_modules WHERE module_link = 0 ";
          
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
           $this ->db-> select('sys_users.user_id, sys_users.role_id,  sys_users.name, sys_users.user_name, sys_users.user_status, sys_users.user_type, sys_users.last_logged_in');
           $this ->db-> from('sys_users');
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
                        sys_modules.module_id, sys_modules.order, sys_modules.symbol, sys_modules.module_child
                        FROM sys_users
                        INNER JOIN sys_roles ON sys_users.role_id = sys_roles.role_id
                        INNER JOIN sys_rules ON sys_roles.role_id = sys_rules.role_id
                        INNER JOIN sys_modules ON sys_rules.module_id = sys_modules.module_id
                        WHERE sys_users.user_id='".$kode."' AND sys_modules.module_id !=10  ORDER BY sys_modules.order ASC ";
                        
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
            $query    = "SELECT * FROM sys_modules WHERE module_parent = 10 AND module_status =1 ";
                        
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
              $query    = "SELECT sys_roles.*, sys_rules.module_id AS oke, 
                          sys_modules.module_id 
                          FROM sys_roles 
                          INNER JOIN sys_rules ON sys_roles.role_id = sys_rules.role_id 
                          INNER JOIN sys_modules ON sys_rules.module_id = sys_modules.module_id 
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
              $id  = $session_data['employee_code'];
              $data     = array();

              $query    = "SELECT mod_division.division_name, mod_position.position_name, mod_company.company_name, mod_employee.*, mod_location.location_name, mod_bank.bank_name, mod_employee_status.mod_status_name
                           from mod_employee
                           inner join mod_division on mod_employee.division_code = mod_division.division_code
                           inner join mod_position on mod_employee.position_code = mod_position.position_code
                           inner join mod_company on mod_employee.company_code = mod_company.company_code
                           inner join mod_location on mod_employee.location = mod_location.location_id
                           inner join mod_bank on mod_employee.bank_id = mod_bank.bank_id
                           inner join mod_employee_status on mod_employee.mod_status_code = mod_employee_status.mod_status_code
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
            $query        = "SELECT * FROM mod_employee";
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



        // public function getaps()
        // {
        //   if($this->session->userdata('logged_in'))
        //       {
        //           $session_data = $this->session->userdata('logged_in');
        //           $id    = $session_data['company_code'];
        //           $data   = array();
        //           $query  = "SELECT * FROM mod_aps ";

        //           $Q = $this->db->query($query);

        //           if ($Q->num_rows() > 0){
        //               foreach ($Q->result_array() as $row){
        //                   $data[] = $row;
        //               }
        //           }
        //           return $data;
        //       }else{
        //           redirect('login', 'refresh');
        //       }
        // }

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
          $query        = "SELECT * FROM mod_setting";
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


    }
?>
