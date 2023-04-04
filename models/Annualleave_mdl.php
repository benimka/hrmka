<?php

class Annualleave_mdl extends CI_Model{

    public function __construct(){
        parent::__construct();
    }

    public function posting($item){
      $this->db->insert('mod_leave_posting',$item);
    }

    public function save($item){
      $this->db->insert('mod_annual_leave',$item);
    }


    public function savedetail($item){
      $this->db->insert('mod_detail_annual_leave',$item);
    }

    public function savecutibersama($item){
      $this->db->insert('mod_annual_leave_all',$item);
      $this->db->insert('mod_detail_annual_leave_all',$item);
    }

    public function save_log($item){
      $this->db->insert('detail_log_cuti',$item);
    }


    public function updated($item,$data1)
    {
        $this->db->where($data1);
        $this->db->update('mod_employee',$item);
    }


    public function ubahmod($item,$data1)
    {
        $this->db->where($data1);
        $this->db->update('mod_employee',$item);
    }

    public function ubah($item,$data1)
    {
        $this->db->where($data1);
        $this->db->update('mod_annual_leave',$item);
    }

    public function delete($id){
      $this->db->query("delete  from mod_employee where employee_id='$id'");
    }


    public function getcutilist()
    {
        if ($this->session->userdata('logged_in'))
            {
                $session_data                   = $this->session->userdata('logged_in');
                $user_id                        = $session_data['user_id'];
                $role_id                        = $session_data['role_id'];
                $code                           = $session_data['employee_code'];

                $data       = array();

                $tanggal    = date('Y-m-d');

                $query      = "SELECT mod_employee.employee_name, mod_type_cuty.type_cuty_name, mod_detail_annual_leave.jml, mod_detail_annual_leave.annual_leave_description, mod_department.department_name, mod_detail_annual_leave.date_start, mod_detail_annual_leave.date_end
                               FROM mod_detail_annual_leave
                               INNER JOIN mod_employee ON mod_detail_annual_leave.employee_code = mod_employee.employee_code
                               INNER JOIN mod_type_cuty ON mod_detail_annual_leave.type_cuty_id = mod_type_cuty.type_cuty_id
                               INNER JOIN mod_department ON mod_employee.department_code = mod_department.department_code
                               WHERE mod_detail_annual_leave.date_start <='$tanggal' AND mod_detail_annual_leave.date_end >='$tanggal' GROUP BY mod_detail_annual_leave.annual_leave_code ";

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


    public function reporting_reportbersama($date1, $date2, $employee_code){
         if ($this->session->userdata('logged_in'))
          {
              $session_data                   = $this->session->userdata('logged_in');
              $user_id                        = $session_data['user_id'];
              $role_id                        = $session_data['role_id'];
              $code                           = $session_data['employee_code'];

              $data       = array();

              $query      = "SELECT mod_detail_annual_leave_all.annual_leave_description, date_format(mod_detail_annual_leave_all.date_start, '%d-%m-%Y') as date_start,
                        date_format(mod_detail_annual_leave_all.date_end, '%d-%m-%Y') as date_end, mod_detail_annual_leave_all.jml, mod_employee.employee_name,
                        mod_detail_annual_leave_all.annual_leave_id, mod_detail_annual_leave_all.approved, mod_detail_annual_leave_all.minus, mod_detail_annual_leave_all.balance,
                        mod_detail_annual_leave_all.annual_leave_code, mod_employee.params_cuti, mod_type_cuty.type_cuty_name
                        FROM mod_detail_annual_leave_all
                        INNER JOIN mod_employee ON mod_detail_annual_leave_all.employee_code = mod_employee.employee_code
                        INNER JOIN mod_company ON mod_employee.company_code = mod_company.company_code
                        INNER JOIN mod_type_cuty ON mod_detail_annual_leave_all.type_cuty_id = mod_type_cuty.type_cuty_id ";

                  if($employee_code =='all'){
                    if($role_id == 4){
                      $query .= "WHERE mod_employee.parent='$code' AND mod_detail_annual_leave_all.annual_leave_date >='$date1'
                                 AND mod_detail_annual_leave_all.annual_leave_date <='$date2' ";
                    } else {
                      $query .= "WHERE mod_detail_annual_leave_all.annual_leave_date >='$date1'
                                 AND mod_detail_annual_leave_all.annual_leave_date <='$date2' ";
                    }


                  }elseif($employee_code !='all'){

                    $query .= "WHERE mod_detail_annual_leave_all.annual_leave_date >='$date1'
                               AND mod_detail_annual_leave_all.annual_leave_date <='$date2'
                               AND mod_employee.employee_code='$employee_code'
                               GROUP BY mod_detail_annual_leave_all.annual_leave_code ";

                  }else{

                      $query .= "WHERE mod_detail_annual_leave_all.annual_leave_date >='$date1' AND mod_detail_annual_leave_all.annual_leave_date <='$date2'  ";
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


    public function reporting($date1, $date2, $employee_code)
    {
        if ($this->session->userdata('logged_in'))
          {
              $session_data                   = $this->session->userdata('logged_in');
              $user_id                        = $session_data['user_id'];
              $role_id                        = $session_data['role_id'];
              $code                           = $session_data['employee_code'];

              $data       = array();

              $query      = "SELECT mod_detail_annual_leave.annual_leave_description, 
                             mod_detail_annual_leave.date_start as date_start,
                             mod_detail_annual_leave.date_end as date_end, 
                             mod_detail_annual_leave.jml, mod_employee.employee_name,
                             mod_detail_annual_leave.annual_leave_id, mod_detail_annual_leave.approved, 
                             mod_detail_annual_leave.minus, mod_detail_annual_leave.balance,
                             mod_detail_annual_leave.annual_leave_code, mod_employee.params_cuti, 
                             mod_type_cuty.type_cuty_name
                        FROM mod_detail_annual_leave
                        INNER JOIN mod_employee ON mod_detail_annual_leave.employee_code = mod_employee.employee_code
                        INNER JOIN mod_company ON mod_employee.company_code = mod_company.company_code
                        INNER JOIN mod_type_cuty ON mod_detail_annual_leave.type_cuty_id = mod_type_cuty.type_cuty_id ";

                  if($role_id == 10){

                      $query .= "WHERE mod_employee.employee_code='$code' AND mod_detail_annual_leave.date_start >='$date1'
                                 AND mod_detail_annual_leave.date_end <='$date2'
                                 GROUP BY mod_detail_annual_leave.annual_leave_code 
                                 ORDER BY mod_detail_annual_leave.date_start DESC ";

                  } elseif($role_id == 4) {

                    if($employee_code ==''){

                          $query .= "WHERE mod_employee.parent='$code' AND mod_detail_annual_leave.date_start >='$date1'
                                 AND mod_detail_annual_leave.date_end <='$date2'
                                 GROUP BY mod_detail_annual_leave.annual_leave_code 
                                 ORDER BY mod_detail_annual_leave.date_start DESC ";

                        } else {

                          $query .= "WHERE mod_employee.employee_code='$employee_code' AND 
                                     mod_detail_annual_leave.date_start >='$date1'
                                     AND mod_detail_annual_leave.date_end <='$date2'
                                     GROUP BY mod_detail_annual_leave.annual_leave_code 
                                     ORDER BY mod_detail_annual_leave.date_start DESC ";

                        }

                  } else {

                        if($employee_code ==''){

                            $query .= "WHERE mod_detail_annual_leave.date_start >='$date1'
                                   AND mod_detail_annual_leave.date_end <='$date2'
                                   GROUP BY mod_detail_annual_leave.annual_leave_code 
                                   ORDER BY mod_detail_annual_leave.date_start DESC ";

                          } else {

                            $query .= "WHERE mod_employee.employee_code='$employee_code' AND 
                                       mod_detail_annual_leave.date_start >='$date1'
                                       AND mod_detail_annual_leave.date_end <='$date2'
                                       GROUP BY mod_detail_annual_leave.annual_leave_code 
                                       ORDER BY mod_detail_annual_leave.date_start DESC ";

                          }

                  }

                  // echo "<pre>";
                  // var_dump($query);
                  // exit();

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



    public function reporting_sum($date1, $date2, $employee_code)
    {
        if ($this->session->userdata('logged_in'))
          {
              $session_data                   = $this->session->userdata('logged_in');
              $user_id                        = $session_data['user_id'];
              $role_id                        = $session_data['role_id'];
              $code                           = $session_data['employee_code'];

              $data       = array();


              if($role_id == "10"){


                $query      = "SELECT SUM(mod_detail_annual_leave.jml) AS jml, mod_employee.employee_name
                                FROM mod_detail_annual_leave
                                INNER JOIN mod_employee ON mod_detail_annual_leave.employee_code = mod_employee.employee_code
                                WHERE mod_employee.employee_code ='".$code."' AND mod_detail_annual_leave.annual_leave_date >='$date1' AND mod_detail_annual_leave.annual_leave_date <='$date2' GROUP BY mod_detail_annual_leave.employee_code ";

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


                  $query      = "SELECT SUM(jml) AS jml, mod_detail_annual_leave.employee_code, mod_employee.employee_name
                                 FROM mod_detail_annual_leave
                                 INNER JOIN mod_employee ON mod_detail_annual_leave.employee_code = mod_employee.employee_code ";

                  if($employee_code =='all'){
                      $query .= "WHERE mod_detail_annual_leave.annual_leave_date >='$date1'
                                 AND mod_detail_annual_leave.annual_leave_date <='$date2' GROUP BY employee_code";

                  }elseif($employee_code !='all'){

                    $query .= "WHERE mod_detail_annual_leave.annual_leave_date >='$date1'
                               AND mod_detail_annual_leave.annual_leave_date <='$date2'
                               AND mod_employee.employee_code='$employee_code'";

                  }else{

                      $query .= "WHERE mod_detail_annual_leave.annual_leave_date >='$date1' AND mod_detail_annual_leave.annual_leave_date <='$date2' GROUP BY employee_code";
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

         } else {
             redirect('login', 'refresh');
         }
    }



    public function listing($id)
    {
      if ($this->session->userdata('logged_in'))
          {
              $session_data   = $this->session->userdata('logged_in');
              $user_id        = $session_data['user_id'];
              $data           = array();
              $query          = "SELECT mod_employee.*, mod_company.company_name, mod_department.department_name, mod_employee_status.mod_status_name
                                 FROM mod_employee
                                 INNER JOIN mod_company ON mod_employee.company_code = mod_company.company_code
                                 INNER JOIN mod_department ON mod_employee.department_code = mod_department.department_code
                                 INNER JOIN mod_employee_status ON mod_employee.mod_status_code = mod_employee_status.mod_status_code ";

              $Q              = $this->db->query($query);
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


    public function export($id)
    {
      if ($this->session->userdata('logged_in'))
          {
              $session_data                   = $this->session->userdata('logged_in');
              $user_id                        = $session_data['user_id'];
              $data       = array();
              $query      = "SELECT mod_employee.*, mod_company.company_name, mod_department.department_name, mod_employee_status.mod_status_name
                             FROM mod_employee
                             INNER JOIN mod_company ON mod_employee.company_code = mod_company.company_code
                             INNER JOIN mod_department ON mod_employee.department_code = mod_department.department_code
                             INNER JOIN mod_employee_status ON mod_employee.mod_status_code = mod_employee_status.mod_status_code
                             WHERE mod_employee.company_code = '$id' ";

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


    public function edit($id)
    {
        $data       = array();
        $query      = "SELECT mod_employee.*, mod_company.company_name,mod_company.company_code, mod_department.department_name, mod_department.department_code, mod_employee_status.mod_status_name, mod_employee_status.mod_status_code, mod_position.position_code, mod_position.position_name,mod_bank.bank_id, mod_bank.bank_name
                       FROM mod_employee
                       INNER JOIN mod_company ON mod_employee.company_code = mod_company.company_code
                       INNER JOIN mod_department ON mod_employee.department_code = mod_department.department_code
                       INNER JOIN mod_employee_status ON mod_employee.mod_status_code = mod_employee_status.mod_status_code
                       INNER JOIN mod_position ON mod_employee.position_code = mod_position.position_code
                       INNER JOIN mod_bank ON mod_employee.bank_id = mod_bank.bank_id
                       WHERE mod_employee.employee_id='$id' ";
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


    public function gethires()
    {
      if ($this->session->userdata('logged_in'))
          {
              $session_data                   = $this->session->userdata('logged_in');
              $id                             = $session_data['employee_code'];
              $data       = array();
              $query      = "SELECT date_of_hire FROM mod_employee WHERE employee_code = '$id' ";

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


    public function balance()
    {
         if ($this->session->userdata('logged_in'))
          {
              $session_data                   = $this->session->userdata('logged_in');
              $id                             = $session_data['employee_code'];
              $data       = array();
              $query      = "SELECT * FROM mod_annual_leave WHERE employee_code = '$id' ";

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


    public function getallminus()
    {
      if ($this->session->userdata('logged_in'))
       {
           $session_data                   = $this->session->userdata('logged_in');
           $id                             = $session_data['employee_code'];

           $data       = array();
           $query      = "SELECT * FROM mod_employee WHERE employee_code = '$id' ";

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

    public function getminus($a)
    {
         if ($this->session->userdata('logged_in'))
          {
              $session_data                   = $this->session->userdata('logged_in');
              $id                             = $session_data['employee_code'];
              $data       = array();
              $query      = "SELECT * FROM mod_employee WHERE employee_code = '$a' ";
              //echo $query;exit();
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


    public function getminusemployee($a)
    {
         if ($this->session->userdata('logged_in'))
          {
              $session_data                   = $this->session->userdata('logged_in');
              $id                             = $session_data['employee_code'];
              $data       = array();
              $query      = "SELECT * FROM mod_employee WHERE employee_code = '$id' ";
              //echo $query;exit();
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


    public function getdate()
    {
      if ($this->session->userdata('logged_in'))
          {
              $session_data                   = $this->session->userdata('logged_in');
              $id                             = $session_data['employee_code'];
              $data       = array();
              $query      = "SELECT DATE_FORMAT(tgl, '%d-%m-%Y') as tgl FROM mod_date ";

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


    public function getsisa()
    {
        if ($this->session->userdata('logged_in'))
          {
              $session_data                   = $this->session->userdata('logged_in');
              $id                             = $session_data['employee_code'];
              $data       = array();
              $query      = "SELECT params_cuti, advance_total FROM mod_employee WHERE employee_code = '$id' ";
              //echo $query;exit();
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


    public function getcuti()
    {
      if ($this->session->userdata('logged_in'))
          {
              $session_data                   = $this->session->userdata('logged_in');
              $kelamin                        = $session_data['sex'];

              $xx  = $this->gethire();

              foreach ($xx as $key => $value) {
                $x = $value['date_of_hire'];
              }

              $cuti         = $this->apps->get_saldo();
              $start_date1  = new DateTime($x);
              $end_date2    = date_create();
              $interval1    = $start_date1->diff($end_date2);

              if($kelamin == "M"){
                /* jika sisa cuti lebih kecil sama dengan 0 */
                if($cuti <= 0){
                    /* jika sisa cuti lebih kecil sama dengan 0 dan belum 1 tahun kerja */
                    if($interval1->days < 365){
                        $query = "SELECT * FROM mod_type_cuty WHERE cuty_alias !='F' AND type_cuty_id IN ('1','9','10','11','12','13') ";

                    /* jika sisa cuti lebih kecil sama dengan 0 dan sudah 1 tahun kerja */
                    }else{
                        $query = "SELECT * FROM mod_type_cuty WHERE cuty_alias !='F' AND type_cuty_id !='8'";
                    }

                /* jika saldo cuti masih ada */
                } else {
                    
                    $query  = "SELECT * FROM mod_type_cuty WHERE cuty_alias !='F' AND type_cuty_id !='2' AND display !='7' AND display !='90' ";

                }



              }else{

                if($cuti <= 0){

                    //Jika belum 1 tahun kerja untuk perempuan
                    if($interval1->days < 365){
                          $query = "SELECT * FROM mod_type_cuty WHERE cuty_alias !='M' AND type_cuty_id IN ('1','10','11','12','13')";
                    }else{
                          $query = "SELECT * FROM mod_type_cuty WHERE cuty_alias !='M' AND type_cuty_id !='8'";
                    }

                } else {

                    $query  = "SELECT * FROM mod_type_cuty ";

                }


              }

              $Q                              = $this->db->query($query);
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

    public function myleave()
    {
      if ($this->session->userdata('logged_in'))
          {
              $session_data                   = $this->session->userdata('logged_in');
              $kelamin                        = $session_data['sex'];
              $user_type                      = $session_data['user_type'];
              $role_id                        = $session_data['role_id'];
              $company_code                   = $session_data['company_code'];
              $employee_code                  = $session_data['employee_code'];

              $query = "SELECT mod_annual_leave.annual_leave_description,
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
                        WHERE mod_annual_leave.employee_code ='$employee_code' AND year(mod_annual_leave.date_start) ='2022' GROUP BY mod_annual_leave.annual_leave_code ORDER BY mod_annual_leave.annual_leave_date ASC ";

                       //echo "<pre>"; var_dump($query);exit();

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


    public function myleave_all()
    {
      if ($this->session->userdata('logged_in'))
          {
              $session_data                   = $this->session->userdata('logged_in');
              $kelamin                        = $session_data['sex'];
              $user_type                      = $session_data['user_type'];
              $role_id                        = $session_data['role_id'];
              $company_code                   = $session_data['company_code'];
              $employee_code                  = $session_data['employee_code'];

              $query = "SELECT mod_detail_annual_leave_all.annual_leave_description,
                        date_format(mod_detail_annual_leave_all.date_start, '%d-%m-%Y') as date_start,
                        date_format(mod_detail_annual_leave_all.date_end, '%d-%m-%Y') as date_end,
                        mod_detail_annual_leave_all.jml,
                        mod_employee.employee_name,
                        mod_detail_annual_leave_all.annual_leave_id,
                        mod_detail_annual_leave_all.approved,
                        mod_employee.params_cuti,
                        mod_detail_annual_leave_all.annual_leave_code,
                        date_format(mod_detail_annual_leave_all.annual_leave_date, '%d-%m-%Y') as tgl,
                        mod_detail_annual_leave_all.type_cuty_id,
                        mod_detail_annual_leave_all.approved_by,
                        mod_type_cuty.type_cuty_name
                        FROM mod_detail_annual_leave_all
                        INNER JOIN mod_employee ON mod_detail_annual_leave_all.employee_code = mod_employee.employee_code
                        INNER JOIN mod_company ON mod_employee.company_code = mod_company.company_code
                        INNER JOIN mod_type_cuty ON mod_detail_annual_leave_all.type_cuty_id = mod_type_cuty.type_cuty_id
                        WHERE mod_detail_annual_leave_all.employee_code ='$employee_code' ORDER BY mod_detail_annual_leave_all.annual_leave_date DESC ";
              //var_dump($query);exit();
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


    public function listcuti()
    {
      if ($this->session->userdata('logged_in'))
          {
              $session_data                   = $this->session->userdata('logged_in');
              $kelamin                        = $session_data['sex'];
              $user_type                      = $session_data['user_type'];
              $role_id                        = $session_data['role_id'];
              $company_code                   = $session_data['company_code'];
              $employee_code                  = $session_data['employee_code'];

              $query = "SELECT mod_annual_leave.annual_leave_description, date_format(mod_annual_leave.date_start, '%d-%m-%Y') as date_start,
                        date_format(mod_annual_leave.date_end, '%d-%m-%Y') as date_end, mod_annual_leave.jml, mod_employee.employee_name,
                        mod_annual_leave.annual_leave_id, mod_annual_leave.approved, mod_annual_leave.minus, mod_annual_leave.balance,
                        mod_annual_leave.annual_leave_code, mod_annual_leave.annual_leave_date as tgl, mod_employee.parent,
                        mod_annual_leave.type_cuty_id,
                        mod_type_cuty.type_cuty_name,
			   mod_annual_leave.approved_by
                        FROM mod_annual_leave
                        INNER JOIN mod_employee ON mod_annual_leave.employee_code = mod_employee.employee_code
                        INNER JOIN mod_company ON mod_employee.company_code = mod_company.company_code
                        INNER JOIN mod_type_cuty ON mod_annual_leave.type_cuty_id = mod_type_cuty.type_cuty_id ";

              if($role_id =="4" OR $role_id == "1"){
                  $query .= "WHERE mod_employee.parent='$employee_code' GROUP BY mod_annual_leave.annual_leave_code ORDER BY annual_leave_code DESC ";
              }elseif($role_id =="3"){
                 $query .= "GROUP BY mod_annual_leave.annual_leave_code ORDER BY annual_leave_code DESC ";
              }elseif($role_id =="6"){
                $query .= "WHERE mod_company.company_code ='$company_code' ";
              }elseif($role_id =="10"){
                  $query .= "WHERE mod_annual_leave.employee_code='$employee_code' GROUP BY mod_annual_leave.annual_leave_code ORDER BY annual_leave_code DESC ";
              }else{
                  $query .= "WHERE mod_annual_leave.employee_code !='$employee_code' GROUP BY mod_annual_leave.annual_leave_code ORDER BY annual_leave_code DESC ";
              }


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


    public function listcuti_all()
    {
      if ($this->session->userdata('logged_in'))
          {
              $session_data                   = $this->session->userdata('logged_in');
              $kelamin                        = $session_data['sex'];
              $user_type                      = $session_data['user_type'];
              $role_id                        = $session_data['role_id'];
              $company_code                   = $session_data['company_code'];
              $employee_code                  = $session_data['employee_code'];

              $query = "SELECT mod_detail_annual_leave_all.annual_leave_description,
                        date_format(mod_detail_annual_leave_all.date_start, '%d-%m-%Y') as date_start,
                        date_format(mod_detail_annual_leave_all.date_end, '%d-%m-%Y') as date_end,
                        mod_detail_annual_leave_all.jml, mod_employee.employee_name,
                        mod_detail_annual_leave_all.annual_leave_id,
                        mod_detail_annual_leave_all.approved,
                        mod_detail_annual_leave_all.minus,
                        mod_detail_annual_leave_all.balance,
                        mod_detail_annual_leave_all.annual_leave_code,
                        mod_detail_annual_leave_all.annual_leave_date as tgl,
                        mod_employee.parent,
                        mod_detail_annual_leave_all.type_cuty_id
                        ,mod_type_cuty.type_cuty_name
                        FROM mod_detail_annual_leave_all
                        INNER JOIN mod_employee ON mod_detail_annual_leave_all.employee_code = mod_employee.employee_code
                        INNER JOIN mod_company ON mod_employee.company_code = mod_company.company_code
                        INNER JOIN mod_type_cuty ON mod_detail_annual_leave_all.type_cuty_id = mod_type_cuty.type_cuty_id ";

              if($role_id =="4" OR $role_id == "1"){
                  $query .= "WHERE mod_employee.parent='$employee_code' GROUP BY mod_employee.employee_name ";
              }elseif($role_id =="3"){
                 $query .= "ORDER BY mod_detail_annual_leave_all.annual_leave_date DESC ";
              }elseif($role_id =="6"){
                $query .= "WHERE mod_company.company_code ='$company_code' ";
              }elseif($role_id =="10"){
                  $query .= "WHERE mod_detail_annual_leave_all.employee_code='$employee_code' ";
              }else{
                  $query .= "WHERE mod_detail_annual_leave_all.employee_code !='$employee_code' ";
              }
                //var_dump($query);exit();

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


    public function listcutiall()
    {
      if ($this->session->userdata('logged_in'))
          {
              $session_data                   = $this->session->userdata('logged_in');
              $kelamin                        = $session_data['sex'];
              $user_type                      = $session_data['user_type'];
              $role_id                        = $session_data['role_id'];
              $user_id                        = $session_data['user_id'];
              $company_code                   = $session_data['company_code'];
              $employee_code                  = $session_data['employee_code'];

              $query = "SELECT mod_annual_leave.annual_leave_description, date_format(mod_annual_leave.date_start, '%d-%m-%Y') as date_start,
                        date_format(mod_annual_leave.date_end, '%d-%m-%Y') as date_end, mod_annual_leave.jml, mod_employee.employee_name,
                        mod_employee.employee_code,
                        mod_annual_leave.annual_leave_id, mod_annual_leave.approved, mod_annual_leave.minus, mod_annual_leave.balance,
                        mod_annual_leave.annual_leave_code, mod_annual_leave.annual_leave_date as tgl, mod_employee.parent,
                        mod_annual_leave.type_cuty_id, mod_annual_leave.approved_by, mod_type_cuty.type_cuty_name
                        FROM mod_annual_leave
                        INNER JOIN mod_employee ON mod_annual_leave.employee_code = mod_employee.employee_code
                        INNER JOIN mod_company ON mod_employee.company_code = mod_company.company_code
                        INNER JOIN mod_type_cuty ON mod_annual_leave.type_cuty_id = mod_type_cuty.type_cuty_id ";

               if($role_id =="3"){
                  $query .= "WHERE mod_company.company_code ='$company_code'
                        GROUP BY mod_annual_leave.annual_leave_code ORDER BY annual_leave_id ASC ";
               }elseif($role_id =="10"){
                  $query .= "WHERE mod_annual_leave.employee_code ='$employee_code' ORDER BY annual_leave_id ASC ";
               }else{
                  $query .= "GROUP BY mod_annual_leave.annual_leave_code ORDER BY annual_leave_id DESC ";
               }  
              //var_dump($query);exit();
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


    public function listcutibersama()
    {
      if ($this->session->userdata('logged_in'))
          {
              $session_data                   = $this->session->userdata('logged_in');
              $kelamin                        = $session_data['sex'];
              $user_type                      = $session_data['user_type'];
              $role_id                        = $session_data['role_id'];
              $company_code                   = $session_data['company_code'];
              $employee_code                  = $session_data['employee_code'];

              $query = "SELECT mod_annual_leave_all.annual_leave_description, date_format(mod_annual_leave_all.date_start, '%d-%m-%Y') as date_start,
                        date_format(mod_annual_leave_all.date_end, '%d-%m-%Y') as date_end, mod_annual_leave_all.jml, mod_employee.employee_name,
                        mod_annual_leave_all.annual_leave_id, mod_annual_leave_all.approved, mod_annual_leave_all.minus, mod_annual_leave_all.balance,
                        mod_annual_leave_all.annual_leave_code, mod_annual_leave_all.annual_leave_date as tgl, mod_employee.parent,
                        mod_annual_leave_all.type_cuty_id, mod_annual_leave_all.approved_by, mod_type_cuty.type_cuty_name
                        FROM mod_annual_leave_all
                        INNER JOIN mod_employee ON mod_annual_leave_all.employee_code = mod_employee.employee_code
                        INNER JOIN mod_company ON mod_employee.company_code = mod_company.company_code
                        INNER JOIN mod_type_cuty ON mod_annual_leave_all.type_cuty_id = mod_type_cuty.type_cuty_id
                        WHERE mod_employee.status = 'ST001' GROUP BY mod_employee.employee_name ";

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


    public function cekparams($j)
    {
        $query  = "SELECT params_cuti FROM mod_employee WHERE employee_code ='$j' ";
        $Q      = $this->db->query($query);
        if ($Q->num_rows() > 0){
          foreach ($Q->result_array() as $row){
            $data[] = $row;
          }
        }
        return $data;
    }


    public function l($j,$x)
    {
        $query  = "SELECT jml FROM mod_detail_annual_leave WHERE employee_code ='$j' AND annual_leave_code ='$x' ";
        $Q      = $this->db->query($query);
        if ($Q->num_rows() > 0){
          foreach ($Q->result_array() as $row){
            $data[] = $row;
          }
        }
        return $data;
    }



    public function GetTotals($kode)
    {
      $query = "SELECT COUNT(mod_annual_leave.jml) AS jml
                FROM mod_annual_leave
                WHERE annual_leave_code ='$kode' ";

      $Q      = $this->db->query($query);
      if ($Q->num_rows() > 0){
        foreach ($Q->result_array() as $row){
          $data[] = $row;
        }
      }
      return $data;

    }

    
    public function getlistcuti($kode)
    {
      $query = "SELECT mod_annual_leave.annual_leave_description, mod_annual_leave.date_start, mod_annual_leave.date_end,
                COUNT(mod_annual_leave.jml) AS jml, mod_employee.employee_name, mod_annual_leave.annual_leave_id, mod_company.company_name,
                mod_type_cuty.type_cuty_name, mod_employee.employee_code, mod_type_cuty.type_cuty_id, sys_users.user_name,
                mod_annual_leave.annual_leave_code, mod_annual_leave.approved, mod_employee.email
                FROM mod_annual_leave
                INNER JOIN mod_employee ON mod_annual_leave.employee_code = mod_employee.employee_code
                INNER JOIN mod_company ON mod_employee.company_code = mod_company.company_code
                INNER JOIN mod_type_cuty ON mod_annual_leave.type_cuty_id = mod_type_cuty.type_cuty_id
                INNER JOIN sys_users ON mod_annual_leave.employee_code = sys_users.employee_code
                WHERE mod_annual_leave.annual_leave_code ='$kode' ";

      $Q      = $this->db->query($query);
      if ($Q->num_rows() > 0){
        foreach ($Q->result_array() as $row){
          $data[] = $row;
        }
      }
      return $data;

    }

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

    public function karyawan_edit($item1,$item){
        $this->db->where($item1);
        $this->db->update('karyawan',$item);
    }

    public function updpass2($item1,$ubah){
        $this->db->where($item1);
        $this->db->update('m_karyawan',$ubah);
    }


    public function cekflag()
    {
      if ($this->session->userdata('logged_in'))
          {
              $session_data                   = $this->session->userdata('logged_in');
              $employee_code                  = $session_data['employee_code'];

              $query = " SELECT flag FROM mod_employee WHERE employee_code='$employee_code' ";

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


    public function residual()
    {
      if ($this->session->userdata('logged_in'))
          {
              $session_data                   = $this->session->userdata('logged_in');
              $kelamin                        = $session_data['sex'];
              $user_type                      = $session_data['user_type'];
              $role_id                        = $session_data['role_id'];
              $company_code                   = $session_data['company_code'];
              $employee_code                  = $session_data['employee_code'];

              $query = "SELECT * FROM mod_employee ";
              if($role_id < 10){
                $query .= "WHERE mod_status_code !='ST004' AND mod_status_code !='ST005' ";
              }else{
                $query .= "WHERE employee_code =='$employee_code' ";
              }

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


    public function getjml()
    {
        if ($this->session->userdata('logged_in'))
          {
              $session_data                   = $this->session->userdata('logged_in');
              $kelamin                        = $session_data['sex'];
              $user_type                      = $session_data['user_type'];
              $role_id                        = $session_data['role_id'];
              $company_code                   = $session_data['company_code'];
              $employee_code                  = $session_data['employee_code'];

              $query = "SELECT SUM(params_cuti+params_cuti_last_year) as saldo_cuti FROM mod_employee WHERE employee_code ='$employee_code' ";

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


    public function getsertifikat()
    {
        if ($this->session->userdata('logged_in'))
          {
              $session_data                   = $this->session->userdata('logged_in');
              $kelamin                        = $session_data['sex'];
              $user_type                      = $session_data['user_type'];
              $role_id                        = $session_data['role_id'];
              $company_code                   = $session_data['company_code'];
              $employee_code                  = $session_data['employee_code'];

              $query = "SELECT * FROM mod_training_certificate WHERE employee_code ='$employee_code' ";

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



    public function getdokumen()
    {
        if ($this->session->userdata('logged_in'))
          {
              $session_data                   = $this->session->userdata('logged_in');
              $kelamin                        = $session_data['sex'];
              $user_type                      = $session_data['user_type'];
              $role_id                        = $session_data['role_id'];
              $company_code                   = $session_data['company_code'];
              $employee_code                  = $session_data['employee_code'];

              $query = "SELECT * FROM mod_document_employee WHERE employee_code ='$employee_code' ";

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


    public function getstatus()
    {
        if ($this->session->userdata('logged_in'))
          {
              $session_data                   = $this->session->userdata('logged_in');
              $kelamin                        = $session_data['sex'];
              $user_type                      = $session_data['user_type'];
              $role_id                        = $session_data['role_id'];
              $company_code                   = $session_data['company_code'];
              $employee_code                  = $session_data['employee_code'];

              $query = "SELECT  mod_employee_status.mod_status_name
                        FROM mod_employee
                        INNER JOIN mod_employee_status ON mod_employee.mod_status_code = mod_employee_status.mod_status_code
                        WHERE mod_employee.employee_code ='$employee_code' ";

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


    public function getkontrak()
    {
        if ($this->session->userdata('logged_in'))
          {
              $session_data                   = $this->session->userdata('logged_in');
              $kelamin                        = $session_data['sex'];
              $user_type                      = $session_data['user_type'];
              $role_id                        = $session_data['role_id'];
              $company_code                   = $session_data['company_code'];
              $employee_code                  = $session_data['employee_code'];

              $query = "SELECT  *
                        FROM mod_employee
                        WHERE employee_code ='$employee_code' ";

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


    public function getparam()
    {
      if ($this->session->userdata('logged_in'))
          {
              $session_data                   = $this->session->userdata('logged_in');
              $id                             = $session_data['employee_code'];
              $data       = array();
              $query      = "SELECT * FROM mod_params ";

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


    public function saved($item){
      $this->db->insert('mod_cuti_bersama',$item);
    }

    public function edit_cuti_bersama($item,$data1)
    {   //echo "<pre>";var_dump($item,$data1);exit();
        $this->db->where($data1);
        $this->db->update('mod_cuti_bersama',$item);
    }

    public function delete_cuti_bersama($id){
      $this->db->query("DELETE FROM mod_cuti_bersama WHERE id='$id'");
    }


    public function GetEdit($id)
    {
        if ($this->session->userdata('logged_in'))
          {
              $session_data                   = $this->session->userdata('logged_in');
              $kelamin                        = $session_data['sex'];
              $user_type                      = $session_data['user_type'];
              $role_id                        = $session_data['role_id'];
              $company_code                   = $session_data['company_code'];
              $employee_code                  = $session_data['employee_code'];

              $query = "SELECT * FROM mod_cuti_bersama WHERE id='$id'";

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



    public function GetEdit2($id)
    {
        if ($this->session->userdata('logged_in'))
          {
              $session_data                   = $this->session->userdata('logged_in');
              $kelamin                        = $session_data['sex'];
              $user_type                      = $session_data['user_type'];
              $role_id                        = $session_data['role_id'];
              $company_code                   = $session_data['company_code'];
              $employee_code                  = $session_data['employee_code'];

              $query = "SELECT * FROM mod_params WHERE id='$id'";

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


    public function get_cuti_bersama()
    {
        if ($this->session->userdata('logged_in'))
          {
              $session_data                   = $this->session->userdata('logged_in');
              $kelamin                        = $session_data['sex'];
              $user_type                      = $session_data['user_type'];
              $role_id                        = $session_data['role_id'];
              $company_code                   = $session_data['company_code'];
              $employee_code                  = $session_data['employee_code'];

              $query = "SELECT * FROM mod_cuti_bersama ";

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


    public function get_var_cuti()
    {
        if ($this->session->userdata('logged_in'))
          {
              $session_data                   = $this->session->userdata('logged_in');
              $kelamin                        = $session_data['sex'];
              $user_type                      = $session_data['user_type'];
              $role_id                        = $session_data['role_id'];
              $company_code                   = $session_data['company_code'];
              $employee_code                  = $session_data['employee_code'];

              $query = "SELECT total FROM mod_cuti_bersama WHERE status ='1' ";

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
    ///MOD PARAMS

    public function save_param($item){
      $this->db->insert('mod_params',$item);
    }

    public function edit_param($item,$data)
    {
        $this->db->where($data);
        $this->db->update('mod_params',$item);
    }

    public function delete_param($id){
      $this->db->query("DELETE FROM mod_params WHERE id='$id'");
    }

    public function get_param()
    {
        if ($this->session->userdata('logged_in'))
          {
              $session_data                   = $this->session->userdata('logged_in');
              $kelamin                        = $session_data['sex'];
              $user_type                      = $session_data['user_type'];
              $role_id                        = $session_data['role_id'];
              $company_code                   = $session_data['company_code'];
              $employee_code                  = $session_data['employee_code'];

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


    public function get_var_param()
    {
        if ($this->session->userdata('logged_in'))
          {
              $session_data                   = $this->session->userdata('logged_in');
              $kelamin                        = $session_data['sex'];
              $user_type                      = $session_data['user_type'];
              $role_id                        = $session_data['role_id'];
              $company_code                   = $session_data['company_code'];
              $employee_code                  = $session_data['employee_code'];

              $query = "SELECT param_month FROM mod_params ORDER BY year DESC LIMIT 1 ";

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


    // Date
    public function save_tgl($item){
      $this->db->insert('mod_date',$item);
    }

    public function edit_tgl($item,$data1)
    {
        $this->db->where($data1);
        $this->db->update('mod_date',$item);
    }

    public function delete_tgl($id){
      $this->db->query("DELETE FROM mod_date WHERE id='$id'");
    }


    public function get_tgl()
    {
        if ($this->session->userdata('logged_in'))
          {
              $session_data                   = $this->session->userdata('logged_in');
              $kelamin                        = $session_data['sex'];
              $user_type                      = $session_data['user_type'];
              $role_id                        = $session_data['role_id'];
              $company_code                   = $session_data['company_code'];
              $employee_code                  = $session_data['employee_code'];
              $y                              = date('Y');
              $query = "SELECT * FROM mod_date WHERE  YEAR(tgl) >='$y' ";

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


    public function GetEditTgl($id){
      if ($this->session->userdata('logged_in'))
          {
              $session_data                   = $this->session->userdata('logged_in');
              $kelamin                        = $session_data['sex'];
              $user_type                      = $session_data['user_type'];
              $role_id                        = $session_data['role_id'];
              $company_code                   = $session_data['company_code'];
              $employee_code                  = $session_data['employee_code'];
              $y                              = date('Y');
              $query = "SELECT * FROM mod_date WHERE  id ='$id' ";

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


    public function cty()
    {
        if ($this->session->userdata('logged_in'))
          {
              $session_data                   = $this->session->userdata('logged_in');
              $kelamin                        = $session_data['sex'];
              $user_type                      = $session_data['user_type'];
              $role_id                        = $session_data['role_id'];
              $company_code                   = $session_data['company_code'];
              $employee_code                  = $session_data['employee_code'];

              $query = "SELECT advance_total FROM mod_employee WHERE employee_code ='". $employee_code ."' ";

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



    public function shifting()
    {
        if ($this->session->userdata('logged_in'))
          {
              $session_data                   = $this->session->userdata('logged_in');
              $kelamin                        = $session_data['sex'];
              $user_type                      = $session_data['user_type'];
              $role_id                        = $session_data['role_id'];
              $company_code                   = $session_data['company_code'];
              $employee_code                  = $session_data['employee_code'];

              $query = "SELECT mod_employee.shift_code
                        FROM mod_employee
                        INNER JOIN mod_shift ON mod_employee.shift_code = mod_shift.shift_code
                        WHERE mod_employee.employee_code ='". $employee_code ."' ";

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



    public function getemail()
    {
        if ($this->session->userdata('logged_in'))
          {
              $session_data                   = $this->session->userdata('logged_in');
              $kelamin                        = $session_data['sex'];
              $user_type                      = $session_data['user_type'];
              $role_id                        = $session_data['role_id'];
              $company_code                   = $session_data['company_code'];
              $employee_code                  = $session_data['employee_code'];

              $query = "SELECT * FROM mod_email_redirect_leave ";

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


    public function shift_auto() {
        $q = $this->db->query("SELECT MAX(RIGHT(shift_code,2)) AS idmax FROM mod_shift ");
        $kd = "";

        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->idmax)+1;
                $kd = sprintf("%03s", $tmp);
            }
        }else{
            $kd = "01";
        }
        $kar = "SH";

        return $kar.$kd;
   }


   public function save_shift($item)
   {
      $this->db->insert('mod_shift',$item);
   }


   public function save_detail_shift($item)
   {
      $this->db->insert('mod_detail_shift_work',$item);
   }


   public function save_detailshift($item)
   {
      $this->db->insert('mod_detail_shift',$item);
   }


  public function save_upd($item,$data)
  {
      $this->db->where($data);
      $this->db->update('mod_shift',$item);
  }


  public function delete_shift($id){
      $this->db->query("DELETE  FROM mod_shift WHERE shift_code='$id'");
      $this->db->query("DELETE  FROM mod_detail_shift_work WHERE shift_code='$id'");
  }



  public function getdatacutibersama()
  {
    if ($this->session->userdata('logged_in'))
        {
            $session_data                   = $this->session->userdata('logged_in');
            $kelamin                        = $session_data['sex'];
            $user_type                      = $session_data['user_type'];
            $role_id                        = $session_data['role_id'];
            $company_code                   = $session_data['company_code'];
            $employee_code                  = $session_data['employee_code'];

            $query = "SELECT mod_detail_annual_leave_all.annual_leave_description as deskripsi, date_format(mod_detail_annual_leave_all.date_start, '%d-%m-%Y') as date_start
                      FROM mod_detail_annual_leave_all
                      INNER JOIN mod_employee ON mod_detail_annual_leave_all.employee_code = mod_employee.employee_code
                      WHERE mod_detail_annual_leave_all.annual_leave_code ='ALL' ORDER BY  mod_detail_annual_leave_all.annual_leave_code LIMIT 1";

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


  public function GetShift()
    {
        if ($this->session->userdata('logged_in'))
          {
              $session_data                   = $this->session->userdata('logged_in');
              $kelamin                        = $session_data['sex'];
              $user_type                      = $session_data['user_type'];
              $role_id                        = $session_data['role_id'];
              $company_code                   = $session_data['company_code'];
              $employee_code                  = $session_data['employee_code'];

              $query = "SELECT * FROM mod_shift ";

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


    public function GetShiftEdit($id)
    {
        if ($this->session->userdata('logged_in'))
          {
              $session_data                   = $this->session->userdata('logged_in');
              $kelamin                        = $session_data['sex'];
              $user_type                      = $session_data['user_type'];
              $role_id                        = $session_data['role_id'];
              $company_code                   = $session_data['company_code'];
              $employee_code                  = $session_data['employee_code'];

              $query = "SELECT *
                      FROM mod_shift a
                      INNER JOIN mod_detail_shift_work b ON b.shift_code = a.shift_code
                      WHERE a.shift_code='".$id."'";

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


  public function getsjadwal()
  {
    if ($this->session->userdata('logged_in'))
        {
            $session_data                   = $this->session->userdata('logged_in');
            $kelamin                        = $session_data['sex'];
            $user_type                      = $session_data['user_type'];
            $role_id                        = $session_data['role_id'];
            $company_code                   = $session_data['company_code'];
            $employee_code                  = $session_data['employee_code'];
            $tanggal    = date('Y-m-d');

            $query = "SELECT shift_code, shift_name, periode FROM mod_shift ";

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


    public function get_saldo()
    {
        if ($this->session->userdata('logged_in'))
          {
              $session_data                   = $this->session->userdata('logged_in');
              $id                             = $session_data['employee_code'];
              $data       = array();
              $query      = "SELECT SUM(params_cuti+params_cuti_last_year) as saldo FROM mod_employee WHERE employee_code = '$id' ";
              //echo $query;exit();
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


    public function GetDataHoliday()
    {
        if ($this->session->userdata('logged_in'))
          {
              $session_data                   = $this->session->userdata('logged_in');
              $id                             = $session_data['employee_code'];
              // $year                           = date('Y');
              $year                           = 2022;

              $data       = array();
              $query      = "SELECT description, type, date_format(tgl, '%d-%m-%Y') as tgl_cuti FROM mod_date WHERE year(tgl) = '$year' ";
              
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


}
