<?php

class Tools_mdl extends CI_Model{

    public function __construct(){
        parent::__construct();
    }

    public function update($item,$data)
    {
        $this->db->where($data);
        $this->db->update('mod_device',$item);
    }


    public function save($item){
      $this->db->insert('mod_device',$item);
    }

    public function get_ip()
    {
        if ($this->session->userdata('logged_in'))
          {
              $session_data                   = $this->session->userdata('logged_in');
              $user_id                        = $session_data['user_id'];
              $role_id                        = $session_data['role_id'];
              $company_code                   = $session_data['company_code'];

                $query      = "SELECT mod_device.device, mod_device.ip, mod_device.port, mod_location.location_name, mod_device.id
                               FROM mod_device
                               LEFT JOIN mod_location ON mod_device.location_id = mod_location.location_id GROUP BY id ";

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


    public function getlocation()
    {
        if ($this->session->userdata('logged_in'))
          {
              $session_data                   = $this->session->userdata('logged_in');
              $user_id                        = $session_data['user_id'];
              $role_id                        = $session_data['role_id'];
              $company_code                   = $session_data['company_code'];

                $query      = "SELECT * FROM mod_location  ";

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


    public function get_ip_users($loc)
    {
        if ($this->session->userdata('logged_in'))
          {
              $session_data                   = $this->session->userdata('logged_in');
              $locations                      = $session_data['location'];
              $employee_code                  = $session_data['employee_code'];
              $role_id                        = $session_data['role_id'];

              $query      = "SELECT ip FROM mod_device WHERE location_id ='$loc' ";


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


    public function get_ip_users_login()
    {
        if ($this->session->userdata('logged_in'))
          {
              $session_data                   = $this->session->userdata('logged_in');
              $locations                      = $session_data['location'];
              $employee_code                  = $session_data['employee_code'];
              $role_id                        = $session_data['role_id'];

              $query      = "SELECT ip FROM mod_device ";


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
                 // var_dump($query);exit();
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


  public function save_rule($items)
  {
      $this->db->insert('sys_rule',$items);
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


    public function update_p_empty1($edit1,$param1)
    {
      $this->db->where($param1);
      $this->db->update('sys_users',$edit1);
    }


    public function update_p_empty2($edit2,$param2)
    {
        $this->db->where($param2);
        $this->db->update('mod_employee',$edit2);
    }


    public function changes_password($ubah_pass,$id_pass)
    {
        $this->db->where($id_pass);
        $this->db->update('sys_users',$ubah_pass);
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


    public function save_users_login($item){
        $this->db->insert('sys_users',$item);
    }

    public function save_setting($item,$where)
    {
      $this->db->where($where);
      $this->db->update('setting',$item);
    }

    public function get_count(){
        if ($this->session->userdata('logged_in'))
          {
            $session_data 		  	= $this->session->userdata('logged_in');
            $company_code 			= $session_data['company_code'];
  
              $Q 						= $this->db->query("SELECT  mod_annual_leave.approved
                                    FROM mod_annual_leave 
                                    INNER JOIN mod_employee ON mod_annual_leave.employee_code = mod_employee.employee_code
                                    INNER JOIN mod_company ON mod_employee.company_code = mod_company.company_code
                                      WHERE mod_annual_leave.approved='0' AND mod_company.company_code='$company_code' ");
          $jml    				= $Q->num_rows();
          return $jml;
  
        } else {
          redirect('login', 'refresh');
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
          $query    = "SELECT sys_users.name, sys_module.module_name, sys_module.module_path, sys_module.slug, sys_module.module_level, sys_module.module_parent,
                      sys_module.module_id, sys_module.module_order, sys_module.icon, sys_module.slug
                      from sys_users
                      inner join sys_roles on sys_users.role_id = sys_roles.role_id
                      inner join sys_rule on sys_roles.role_id = sys_rule.role_id
                      inner join sys_module on sys_rule.module_id = sys_module.module_id
                      where sys_users.user_id='$kode' ORDER BY sys_module.module_order ASC ";
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

    public function getversions(){
      $query        = "SELECT mod_versions.version_id, mod_versions.version, mod_versions.subject, DATE_FORMAT(mod_versions.created, '%d-%m-%Y') AS created, sys_users.name
                      FROM mod_versions
                      INNER JOIN sys_users ON mod_versions.users_id = sys_users.user_id ";
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

    public function getdata($numbers = NULL)
    {
        $data       = array(); 
        if($numbers == NULL)
        {
            $query      = "SELECT * FROM mod_company ";
        } else {
            $query      = "SELECT * FROM mod_company WHERE company_id ='".$numbers."' ";
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

    public function save_version($item){
      $this->db->insert('mod_versions',$item);
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

}