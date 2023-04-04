<?php

class Myleave_mdl extends CI_Model{

    public function __construct(){
        parent::__construct();
    }


    // public function auto()
    // {
    //     if($this->session->userdata('logged_in'))
    //       {
    //           $session_data = $this->session->userdata('logged_in');

    //           $q = $this->db->query("SELECT MAX(RIGHT(annual_leave_code,7)) AS idmax 
    //                                  FROM mod_annual_leave  ");

    //                 $kd = "";

    //                 if($q->num_rows()>0){
    //                     foreach($q->result() as $k){
    //                         $tmp = ((int)$k->idmax)+1;
    //                         $kd = sprintf("%07s", $tmp);
    //                     }
    //                 }else{
    //                     $kd = "0000001";
    //                 }
    //                 $kar = "AL";
            
    //                 return $kar.$kd;

    //       } else {
    //           redirect('login', 'refresh');
    //       }
    // }


    public function auto() {
      $q = $this->db->query("SELECT MAX(RIGHT(annual_leave_code,3)) AS idmax FROM mod_annual_leave ");
      $kd = "";

      if($q->num_rows()>0){
        foreach($q->result() as $k){
            $tmp = ((int)$k->idmax)+1;
            $kd = sprintf("%03s", $tmp);
        }
      }else{
        $kd = "01";
      }
      $kar = "AL";

      return $kar.$kd;
    }


    public function getdata($numbers = NULL)
    {
        if($this->session->userdata('logged_in'))
          {
              $session_data = $this->session->userdata('logged_in');
              $data       = array(); 
              if($numbers == NULL)
              {
                  $query      = "SELECT mod_annual_leave.annual_leave_description,
                                  mod_annual_leave.date_start as date_start,
                                  mod_annual_leave.date_end as date_end,
                                  mod_annual_leave.jml, 
                                  mod_employee.employee_name,
                                  mod_annual_leave.annual_leave_id,
                                  mod_annual_leave.approved,
                                  mod_annual_leave.minus,
                                  mod_annual_leave.balance,
                                  mod_employee.params_cuti,
                                  mod_annual_leave.annual_leave_code,
                                  mod_annual_leave.annual_leave_date as tgl,
                                  mod_annual_leave.type_cuty_id,
                                  mod_annual_leave.approved_by,
                                  mod_type_cuty.type_cuty_name
                                  FROM mod_annual_leave
                                  INNER JOIN mod_employee ON mod_annual_leave.employee_code = mod_employee.employee_code
                                  INNER JOIN mod_company ON mod_employee.company_code = mod_company.company_code
                                  INNER JOIN mod_type_cuty ON mod_annual_leave.type_cuty_id = mod_type_cuty.type_cuty_id
                                  WHERE mod_annual_leave.employee_code ='".$session_data['employee_code']."' GROUP BY mod_annual_leave.annual_leave_code ORDER BY mod_annual_leave.annual_leave_id DESC";

              } else {

                  $query      = "SELECT mod_annual_leave.annual_leave_description,
                                  mod_annual_leave.date_start as date_start,
                                  mod_annual_leave.date_end as date_end,
                                  mod_annual_leave.jml, 
                                  mod_employee.employee_name,
                                  mod_annual_leave.annual_leave_id,
                                  mod_annual_leave.approved,
                                  mod_annual_leave.minus,
                                  mod_annual_leave.balance,
                                  mod_employee.params_cuti,
                                  mod_annual_leave.annual_leave_code,
                                  mod_annual_leave.annual_leave_date as tgl,
                                  mod_annual_leave.type_cuty_id,
                                  mod_annual_leave.approved_by,
                                  mod_type_cuty.type_cuty_name
                                  FROM mod_annual_leave
                                  INNER JOIN mod_employee ON mod_annual_leave.employee_code = mod_employee.employee_code
                                  INNER JOIN mod_company ON mod_employee.company_code = mod_company.company_code
                                  INNER JOIN mod_type_cuty ON mod_annual_leave.type_cuty_id = mod_type_cuty.type_cuty_id
                                  WHERE mod_annual_leave.employee_code ='".$session_data['employee_code']."' AND year(mod_annual_leave.date_start) ='2022' GROUP BY mod_annual_leave.annual_leave_code ORDER BY mod_annual_leave.annual_leave_id DESC";
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


    public function getcuti()
    {
        if($this->session->userdata('logged_in'))
          {
              $session_data = $this->session->userdata('logged_in');
              $data       = array(); 

              $query      = "SELECT * FROM mod_type_cuty WHERE type_cuty_id !='4' ";

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



    public function getdate()
    {
      if ($this->session->userdata('logged_in'))
          {
              $session_data                   = $this->session->userdata('logged_in');
              $id                             = $session_data['employee_code'];
              $year = date('Y');
              $data       = array();
              $query      = "SELECT DATE_FORMAT(tgl, '%d-%m-%Y') as tgl FROM mod_date WHERE YEAR(tgl) ='$year' ";

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


    public function getdateOf(){
      $year = date('Y');
      $data       = array();
      $query      = "SELECT tgl FROM mod_date WHERE YEAR(tgl) ='$year' ";

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
