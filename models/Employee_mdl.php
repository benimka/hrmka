<?php

class Employee_mdl extends CI_Model{

    public function __construct(){
        parent::__construct();
    }

    
    public function save($item){ 
   
        $this->db->insert('mod_employee',$item);
    }


    public function update_employee($primary,$data)
    {     
        $this->db->where($primary);
        $this->db->update('mod_employee',$data);
    }


    public function delete($id){
        $this->db->query("delete  from mod_employee where department_id='$id'");
    }


    public function update($primary,$data)
    {
        $this->db->where($primary);
        $this->db->update('mod_employee',$data);
    }


    public function save_assets($item)
    {
        $this->db->insert('mod_detail_assets',$item);
    }


    public function save_experience($item)
    {
        $this->db->insert('mod_experience',$item);
    }


    public function save_education($item)
    {
        $this->db->insert('mod_education',$item);
    }


    public function active_leave($data1,$item)
    {
      $this->db->where($item);
      $this->db->update('mod_employee',$data1);
    }


    public function getdata($numbers = NULL, $filter = NULL)
    {
        $data       = array(); 

        /*
            Filter is null
        */

        if($filter == NULL)
            
        
        {
            $query      = "SELECT mod_employee.*, mod_company.company_name, mod_department.department_name, mod_employee_status.mod_status_name, mod_company.company_code
                             FROM mod_employee
                             INNER JOIN mod_company ON mod_employee.company_code = mod_company.company_code
                             INNER JOIN mod_department ON mod_employee.department_code = mod_department.department_code
                             INNER JOIN mod_employee_status ON mod_employee.mod_status_code = mod_employee_status.mod_status_code ";
        } else {
            $query      = "SELECT mod_employee.*, mod_company.company_name, mod_department.department_name, mod_employee_status.mod_status_name, mod_company.company_code
                             FROM mod_employee
                             INNER JOIN mod_company ON mod_employee.company_code = mod_company.company_code
                             INNER JOIN mod_department ON mod_employee.department_code = mod_department.department_code
                             INNER JOIN mod_employee_status ON mod_employee.mod_status_code = mod_employee_status.mod_status_code 
                             WHERE mod_company.company_code ='".$filter."'";
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


    public function getedit($numbers)
    {
        $data       = array(); 

        /*
            Filter is null
        */            
        
        $query      = "SELECT mod_employee.*, mod_company.company_name, mod_department.department_name, mod_employee_status.mod_status_name, mod_company.company_code
                             FROM mod_employee
                             INNER JOIN mod_company ON mod_employee.company_code = mod_company.company_code
                             INNER JOIN mod_department ON mod_employee.department_code = mod_department.department_code
                             INNER JOIN mod_employee_status ON mod_employee.mod_status_code = mod_employee_status.mod_status_code 
                             WHERE mod_employee.employee_code ='".$numbers."'";
        
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


    public function GetCompany()
    {
        $data       = array(); 
        $query      = "SELECT * FROM mod_company ";
        
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


    public function actions()
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
                        where sys_users.user_id='$kode' AND sys_module.module_level ='3' AND sys_module.module_parent='18' ORDER BY sys_module.module_order ASC ";
                        
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


    public function GetCode($companyCode) {
      
        if ($this->session->userdata('logged_in'))
            {
                $session_data = $this->session->userdata('logged_in');
                $user_id      = $session_data['user_id'];
                $data         = array();
                $thn          = date("Y");
                $bln          = date("m");
                $tgl          = date("d");
                $sub_thn      = substr($thn,2);

                $session_data = $this->session->userdata('logged_in');
                $user_id      = $session_data['user_id'];
                $data         = array();
                $thn          = date("Y");
                $bln          = date("m");
                $tgl          = date("d");
                $sub_thn      = substr($thn,2);

                $querys = $this->db->query("SELECT inisial FROM mod_company WHERE company_code='$companyCode'");

                foreach ($querys->result() as $row)
                {
                    $row->inisial;
                }

                $q = $this->db->query("SELECT MAX(RIGHT(employee_code,3)) AS idmax FROM mod_employee WHERE company_code='$companyCode' ");

                    $kd = "";

                    if($q->num_rows()>0){
                        foreach($q->result() as $k){
                            $tmp = ((int)$k->idmax)+1;
                            $kd = sprintf("%03s", $tmp);
                        }
                    }else{
                        $kd = "001";
                    }
                    $kar = "$row->inisial-ID";

                    return $kar.$kd;

            } else {
                redirect('login', 'refresh');
        }

   }


   public function getdokumen($numbers)
    {
        $data       = array();
        $query      = "SELECT * FROM mod_document_employee WHERE employee_code='$numbers' ";

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


    public function getinsurance($numbers)
    {
        $data       = array();
        $query      = "SELECT * FROM mod_insurance WHERE employee_code='$numbers' ";

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


    public function getassets($numbers)
    {
        $data       = array();
        $query      = "SELECT * FROM mod_detail_assets WHERE employee_code='$numbers' ";

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


    public function getasset()
    {

        if($this->session->userdata('logged_in'))
            {
                $session_data = $this->session->userdata('logged_in');
                $id       = $session_data['company_code'];
                $parent   = $session_data['parent'];
                $role_id  = $session_data['role_id'];

                $data       = array();
                $query      = "SELECT mod_master_assets.*, mod_company.company_name
                               FROM mod_master_assets
                               INNER JOIN mod_company ON mod_master_assets.company_code = mod_company.company_code ";

                if($role_id == "3" || $role_id =="1"){

                }else{
                    $query .= "WHERE mod_company.company_code='$id' ";
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

            }else{
                redirect('login', 'refresh');
            }
    }



    public function getListAssets($number)
    {
        $data       = array();
        $query      = "SELECT mod_employee.*, mod_detail_assets.id as kodeassets, mod_detail_assets.date_assets, mod_detail_assets.sum, mod_master_assets.*
                       FROM mod_employee
                       INNER JOIN mod_detail_assets ON mod_employee.employee_code = mod_detail_assets.employee_code
                       INNER JOIN mod_master_assets ON mod_detail_assets.item_code = mod_master_assets.item_code
                       WHERE mod_employee.employee_code='$number' GROUP BY mod_detail_assets.item_code ";

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


    public function getexperience($number)
    {
        $data       = array();
        $query      = "SELECT * FROM mod_experience WHERE employee_code='$number' ";
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
    }


    public function geteducation($number)
    {
        $data       = array();
        $query      = "SELECT * FROM mod_education WHERE employee_code='$number' ";
        
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


    public function getsertifikat($number)
    {
        $data       = array();
        $query      = "SELECT * FROM mod_training_certificate WHERE employee_code='$number' ";

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


    public function export_rpt($stage,$age,$status,$company_code)
    {  
      if ($this->session->userdata('logged_in'))
          {
              $session_data                   = $this->session->userdata('logged_in');
              $user_id                        = $session_data['user_id'];
              $data       = array();

              $query      = "SELECT mod_employee.*, mod_location.location_name, mod_company.company_name, mod_department.department_name, mod_employee_status.mod_status_name, mod_position.position_name, mod_bank.bank_name, mod_level.level_name
                                 FROM mod_employee
                                 LEFT JOIN mod_company ON mod_employee.company_code = mod_company.company_code
                                 LEFT JOIN mod_department ON mod_employee.department_code = mod_department.department_code
                                 LEFT JOIN mod_employee_status ON mod_employee.mod_status_code = mod_employee_status.mod_status_code
                                 LEFT JOIN mod_education ON mod_employee.employee_code = mod_education.employee_code
                                 LEFT JOIN mod_location ON mod_employee.location = mod_location.location_id
                                 LEFT JOIN mod_position ON mod_employee.position_code = mod_position.position_code
                                 LEFT JOIN mod_bank ON mod_employee.bank_id = mod_bank.bank_id
                                 LEFT JOIN mod_level ON mod_employee.level = mod_level.level
                                 WHERE mod_employee.dum !='1' AND mod_employee.company_code NOT LIKE 'TTK%' ";


              if ( isset ( $stage ) ) { 
                if ( $stage != "") {
                  if( $stage != "all" AND !empty($stage))
                  {
                    $query      .= "AND mod_education.stage LIKE '%$stage%' ";
                  }
                }
              }


              if ( isset ( $status ) ) { 
                if ( $status != "") {
                  if( $status != "all" AND !empty($status))
                  {
                    $query      .= "AND mod_employee.mod_status_code ='".$status."' ";
                  }
                }
              }


              if ( isset ( $company_code ) ) { 
                if ( $company_code != "") {
                  if( $company_code != "all" AND !empty($company_code))
                  {
                    $query      .= "AND mod_employee.company_code ='".$company_code."' ";
                  }
                }
              }


              if ( isset ( $age ) ) { 
                if ( $age != "") {
                  if( $age != "all" AND !empty($age))
                  { 
                    if($age == "30"){
                        $query      .= "AND mod_employee.age >='30' AND mod_employee.age <=55 ";
                    } else {
                        $query      .= "AND mod_employee.age >='20' AND mod_employee.age <=29 ";
                    }
                    
                  }
                }
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

         } else {
             redirect('login', 'refresh');
         }
    }


    public function rpt_insurance($company_code)
    {
        $data = array();
        $session_data   = $this->session->userdata('logged_in');
        $query          = "SELECT mod_insurance.insurance_name, mod_insurance.membership, 
                            mod_insurance.date_of_birth, mod_insurance.ins_sex, mod_insurance.maternit, 
                            mod_company.company_name, mod_bank.bank_name, mod_employee.bank_account_no, 
                            mod_employee.bank_account_name,
                            mod_employee.company_code
                           FROM mod_insurance
                           INNER JOIN mod_employee ON mod_insurance.employee_code = mod_employee.employee_code
                           INNER JOIN mod_company ON mod_employee.company_code = mod_company.company_code
                           INNER JOIN mod_bank ON mod_employee.bank_id = mod_bank.bank_id ";


          if($company_code == "all"){
              $query  .= "ORDER BY mod_insurance.employee_code ";
          }else{
              $query     .= "WHERE mod_company.company_code='$company_code' ORDER BY mod_insurance.employee_code ";
          }

        $Q    = $this->db->query($query);
        if ($Q->num_rows() > 0){
          foreach ($Q->result_array() as $row){
            $data[] = $row;
          }
        }
        return $data;
    }


    public function mutation_rpt($date1,$date2,$company_code)
    {
        $data = array();
        $session_data   = $this->session->userdata('logged_in');
        $query          = "SELECT mod_mutation.*,
                            mod_location.location_name,
                            mod_company.company_name,
                            mod_department.department_name,
                            mod_employee_status.mod_status_name,
                            mod_position.position_name,
                            mod_bank.bank_name,
                            mod_level.level_name
                          FROM mod_mutation
                          INNER JOIN mod_company ON mod_mutation.company_code = mod_company.company_code
                          INNER JOIN mod_department ON mod_mutation.department_code = mod_department.department_code
                          INNER JOIN mod_employee_status ON mod_mutation.mod_status_code = mod_employee_status.mod_status_code
                          INNER JOIN mod_location ON mod_mutation.location = mod_location.location_id
                          INNER JOIN mod_position ON mod_mutation.position_code = mod_position.position_code
                          INNER JOIN mod_bank ON mod_mutation.bank_id = mod_bank.bank_id
                          INNER JOIN mod_level ON mod_mutation.level = mod_level.level ";

          if($company_code == "all"){

              $query .= "WHERE mod_mutation.mutation_date >='$date1' AND mod_mutation.mutation_date <='$date2'";

          }else{

              $string = $company_code;
              $sub_string = substr($string, 0, -4);
              $query .= "WHERE mod_mutation.company_code LIKE '%$sub_string%' ";

          }

        $Q    = $this->db->query($query);
        if ($Q->num_rows() > 0){
          foreach ($Q->result_array() as $row){
            $data[] = $row;
          }
        }
        return $data;
    }

}
