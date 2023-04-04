<?php

class Attendance_mdl extends CI_Model{

    public function __construct(){
        parent::__construct();
    }


    public function save($item)
    { 
      $this->db->insert('mod_shift',$item);
    }


    public function save_detail($item)
    {
        $this->db->insert('mod_detail_shift_work',$item);
    }


    public function save1($item){
      $this->db->insert('mod_annual_leave',$item);
    }


    public function savedetail1($item){
      $this->db->insert('mod_detail_annual_leave',$item);
    }


    public function update($item,$data)
    {
        $this->db->where($data);
        $this->db->update('mod_shift',$item);
    }


    public function save_manual1($item1){
        
        $this->db->insert('mod_absen',$item1);
    }


    public function save_manual2($item2){
        
        $this->db->insert('mod_absen',$item2);
    }


    public function save_shelter($item1){
      $this->db->insert('mod_shelter',$item1);
    }


    public function save_detailshift($item)
    {
        $this->db->insert('mod_detail_shift',$item);
    }

    public function delete($id){
        $this->db->query("delete  from mod_announcements where id='$id'");
    }

    public function getdata()
    {
        $data       = array();
        $query      = "SELECT * FROM mod_shift ";
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


    public function Getannouncements()
    {
        if ($this->session->userdata('logged_in'))
          {
              $session_data                   = $this->session->userdata('logged_in');
              $user_id                        = $session_data['user_id'];
              $role_id                        = $session_data['role_id'];
              $company_code                   = $session_data['company_code'];

                $query      = "SELECT * FROM mod_announcements WHERE status !='9'  ";

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
                        where sys_users.user_id='$kode' AND sys_module.module_level ='3' AND sys_module.module_parent='95' ORDER BY sys_module.module_order ASC ";
                        
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


    public function getedit($shift_code)
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
                      WHERE a.shift_code='".$shift_code."'";

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

   public function getLogic()
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


    public function getemployees()
    {
        if($this->session->userdata('logged_in'))
            {
                $session_data = $this->session->userdata('logged_in');
                $id           = $session_data['inisial'];
                $role_id      = $session_data['role_id'];
                $employee_code= $session_data['employee_code'];
                
                $data           = array();
                if($role_id == 4){
                  $query          = "SELECT employee_code, employee_name, pin FROM mod_employee WHERE dum !='1' AND mod_status_code !='ST005' AND mod_employee.parent='$employee_code' || employee_code = '$employee_code' ";
                } elseif($employee_code == 'GAP-ID001'){
                    $query          = "SELECT employee_code, employee_name, pin FROM mod_employee WHERE dum !='1' AND mod_status_code !='ST005' AND mod_employee.parent='$employee_code' || employee_code = '$employee_code' ";
                }

                else {
                  $query          = "SELECT employee_code, employee_name, pin FROM mod_employee WHERE dum !='1' AND mod_status_code !='ST005'";
                }
                
                $Q              = $this->db->query($query);

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


    public function getlocation()
    {
        $data           = array();
        $query          = "SELECT * FROM mod_location ";
        $Q              = $this->db->query($query);

        if ($Q->num_rows() > 0){
          foreach ($Q->result_array() as $row){
            $data[] = $row;
          }
        }
        return $data;
    }


    public function getshift()
    {
        if($this->session->userdata('logged_in'))
            {
                $session_data = $this->session->userdata('logged_in');
                $id           = $session_data['inisial'];

                $data           = array();
                $query          = "SELECT * FROM mod_shift WHERE status = 0 ";

                $Q              = $this->db->query($query);

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


    public function get_timesheet($bulan,$loc,$shift,$employee_code,$div)
    {

        if($this->session->userdata('logged_in'))
        {
            $session_data        = $this->session->userdata('logged_in');
            $role                = $session_data['role_id'];
            $department_code     = $session_data['department_code']; 
            $pin                 = $session_data['pin'];
            $kode                = $session_data['employee_code'];

            set_time_limit(120);
            ini_set('memory_limit', '256M');

            //Staff Only

            if($role == 10){

                $cuti = "<b style=color:white;background-color:green;padding:5px 8px 5px 8px;>C</b>";
                    $this->db->simple_query("SET SESSION group_concat_max_len = 1000000");
                    $query1 = "
                        SELECT
                            GROUP_CONCAT(
                                CONCAT(
                                    \"GROUP_CONCAT(DISTINCT(CASE
                                    WHEN DATE_FORMAT(s.timelog, '%Y-%m-%d') = '\" ,dt, \"' THEN 'H'
                                    WHEN DATE_FORMAT(cuti.date_long, '%Y-%m-%d') = '\" ,dt, \"' THEN  'C'
                                    WHEN DATE_FORMAT(shelter2.date_shelter, '%Y-%m-%d') = '\" ,dt, \"' THEN  'S'
                                    WHEN DATE_FORMAT(shelter3.date_shelter, '%Y-%m-%d') = '\" ,dt, \"' THEN  'D'
                                    WHEN DATE_FORMAT(shelter4.date_shelter, '%Y-%m-%d') = '\" ,dt, \"' THEN  'A'
                                    ELSE NULL END)) AS '\",date_format(dt,'%d'),\"'\"
                                )
                            ) arrsql

                        FROM
                        (
                            SELECT DISTINCT(a.date) AS dt
                            FROM mod_detail_shift a
                            LEFT JOIN mod_employee r ON r.schedule = a.id
                            WHERE date_format(a.date, '%Y-%m') = '$bulan'
                            ORDER BY a.date
                        ) d
                        ";

                    $Q1     = $this->db->query($query1);
                    if ($Q1->num_rows() > 0){
                        foreach ($Q1->result_array() as $row){
                            $mysql[] = $row;
                        }
                    }


                    $query = "
                    SELECT r.employee_name AS NAME, l.location_name AS LOCATION, d.department_name AS DIVISION,

                        COUNT(Distinct date_format(s.timelog, '%Y-%m-%d')) As Hadir,

                        (   SELECT count(mod_detail_annual_leave.jml) AS total
                            FROM mod_detail_annual_leave
                            LEFT JOIN mod_employee ON mod_detail_annual_leave.employee_code = mod_employee.employee_code
                            WHERE mod_detail_annual_leave.employee_code IN (r.employee_code)
                            AND DATE_FORMAT(mod_detail_annual_leave.date_start, '%Y-%m')='$bulan' AND DATE_FORMAT(mod_detail_annual_leave.date_end, '%Y-%m')='$bulan' AND mod_employee.pin = '". $pin ."'
                        ) as Cuti,

                        (   SELECT count(mod_shelter.pin) AS sakit
                            FROM mod_employee
                            LEFT JOIN mod_shelter ON mod_employee.pin = mod_shelter.pin
                            WHERE mod_shelter.pin IN (s.pin) AND mod_shelter.status ='S'
                            AND DATE_FORMAT(mod_shelter.date_shelter, '%Y-%m')='$bulan' AND mod_employee.pin = '". $pin ."'
                        ) as Sakit,

                        (   SELECT count(mod_shelter.pin) AS dinas
                            FROM mod_employee
                            LEFT JOIN mod_shelter ON mod_employee.pin = mod_shelter.pin
                            WHERE mod_shelter.pin IN (s.pin) AND mod_shelter.status ='D'
                            AND DATE_FORMAT(mod_shelter.date_shelter, '%Y-%m')='$bulan' AND mod_employee.pin = '". $pin ."'
                        ) as Dinas,

                        (   SELECT count(mod_shelter.pin) AS alpha
                            FROM mod_employee
                            LEFT JOIN mod_shelter ON mod_employee.pin = mod_shelter.pin
                            WHERE mod_shelter.pin IN (s.pin) AND mod_shelter.status ='A'
                            AND DATE_FORMAT(mod_shelter.date_shelter, '%Y-%m')='$bulan' AND mod_employee.pin = '". $pin ."'
                        ) as Alpha,

                        " . $mysql[0][arrsql] . "

                            FROM mod_absen s

                            LEFT JOIN mod_employee r ON r.pin = s.pin
                            INNER JOIN mod_location l ON l.location_id = r.location
                            INNER JOIN mod_department d ON d.department_code = r.department_code
                            LEFT JOIN mod_detail_annual_leave cuti ON cuti.employee_code = r.employee_code
                            LEFT JOIN mod_shelter shelter2 ON shelter2.pin = r.pin AND shelter2.status ='S'
                            LEFT JOIN mod_shelter shelter3 ON shelter3.pin = r.pin AND shelter3.status ='D'
                            LEFT JOIN mod_shelter shelter4 ON shelter4.pin = r.pin AND shelter4.status ='A'
                            WHERE date_format(s.timelog, '%Y-%m') = '$bulan' AND r.pin ='". $pin ."'
                            GROUP BY s.pin, MONTH(timelog) ORDER BY r.employee_name ASC
                            ";

                    $Q      = $this->db->query($query);
                    
                    if ($Q->num_rows() > 0){
                        foreach ($Q->result_array() as $row){
                            $data[] = $row;
                        }
                    }

                    return $data;


            } elseif($role == 4) {

                    if($employee_code == ""){

                        $cuti = "<b style=color:white;background-color:green;padding:5px 8px 5px 8px;>C</b>";
                        $this->db->simple_query("SET SESSION group_concat_max_len = 1000000");
                        $query1 = "
                            SELECT
                                GROUP_CONCAT(
                                    CONCAT(
                                        \"GROUP_CONCAT(DISTINCT(CASE
                                        WHEN DATE_FORMAT(s.timelog, '%Y-%m-%d') = '\" ,dt, \"' THEN 'H'
                                        WHEN DATE_FORMAT(cuti.date_long, '%Y-%m-%d') = '\" ,dt, \"' THEN  'C'
                                        WHEN DATE_FORMAT(shelter2.date_shelter, '%Y-%m-%d') = '\" ,dt, \"' THEN  'S'
                                        WHEN DATE_FORMAT(shelter3.date_shelter, '%Y-%m-%d') = '\" ,dt, \"' THEN  'D'
                                        WHEN DATE_FORMAT(shelter4.date_shelter, '%Y-%m-%d') = '\" ,dt, \"' THEN  'A'
                                        ELSE NULL END)) AS '\",date_format(dt,'%d'),\"'\"
                                    )
                                ) arrsql

                            FROM
                            (
                                SELECT DISTINCT(a.date) AS dt
                                FROM mod_detail_shift a
                                LEFT JOIN mod_employee r ON r.schedule = a.id
                                WHERE date_format(a.date, '%Y-%m') = '$bulan'
                                ORDER BY a.date
                            ) d
                            ";

                        $Q1     = $this->db->query($query1);
                        if ($Q1->num_rows() > 0){
                            foreach ($Q1->result_array() as $row){
                                $mysql[] = $row;
                            }
                        }


                        $query = "
                        SELECT  r.employee_name AS NAME, l.location_name AS LOCATION, d.department_name AS DIVISION,

                            COUNT(Distinct date_format(s.timelog, '%Y-%m-%d')) As Hadir,

                            (   SELECT count(mod_detail_annual_leave.jml) AS total
                                FROM mod_detail_annual_leave
                                LEFT JOIN mod_employee ON mod_detail_annual_leave.employee_code = mod_employee.employee_code
                                WHERE mod_detail_annual_leave.employee_code IN (r.employee_code)
                                AND DATE_FORMAT(mod_detail_annual_leave.date_start, '%Y-%m')='$bulan' AND DATE_FORMAT(mod_detail_annual_leave.date_end, '%Y-%m')='$bulan'
                                AND mod_employee.parent = '". $kode ."'
                            ) as Cuti,

                            (   SELECT count(mod_shelter.pin) AS sakit
                                FROM mod_employee
                                LEFT JOIN mod_shelter ON mod_employee.pin = mod_shelter.pin
                                WHERE mod_shelter.pin IN (s.pin) AND mod_shelter.status ='S'
                                AND DATE_FORMAT(mod_shelter.date_shelter, '%Y-%m')='$bulan' AND mod_employee.parent = '". $kode ."'
                            ) as Sakit,

                            (   SELECT count(mod_shelter.pin) AS dinas
                                FROM mod_employee
                                LEFT JOIN mod_shelter ON mod_employee.pin = mod_shelter.pin
                                WHERE mod_shelter.pin IN (s.pin) AND mod_shelter.status ='D'
                                AND DATE_FORMAT(mod_shelter.date_shelter, '%Y-%m')='$bulan' AND mod_employee.parent = '". $kode ."'
                            ) as Dinas,

                            (   SELECT count(mod_shelter.pin) AS alpha
                                FROM mod_employee
                                LEFT JOIN mod_shelter ON mod_employee.pin = mod_shelter.pin
                                WHERE mod_shelter.pin IN (s.pin) AND mod_shelter.status ='A'
                                AND DATE_FORMAT(mod_shelter.date_shelter, '%Y-%m')='$bulan' AND mod_employee.parent = '". $kode ."'
                            ) as Alpha,

                            " . $mysql[0][arrsql] . "

                                FROM mod_absen s

                                LEFT JOIN mod_employee r ON r.pin = s.pin
                                INNER JOIN mod_location l ON l.location_id = r.location
                                INNER JOIN mod_department d ON d.department_code = r.department_code
                                LEFT JOIN mod_detail_annual_leave cuti ON cuti.employee_code = r.employee_code
                                LEFT JOIN mod_shelter shelter2 ON shelter2.pin = r.pin AND shelter2.status ='S'
                                LEFT JOIN mod_shelter shelter3 ON shelter3.pin = r.pin AND shelter3.status ='D'
                                LEFT JOIN mod_shelter shelter4 ON shelter4.pin = r.pin AND shelter4.status ='A'
                                WHERE date_format(s.timelog, '%Y-%m') = '$bulan' AND r.department_code ='".$department_code."'
                                GROUP BY s.pin, MONTH(timelog) ORDER BY r.employee_name ASC
                                ";
                        
                        $Q      = $this->db->query($query);

                        if ($Q->num_rows() > 0){
                            foreach ($Q->result_array() as $row){
                                $data[] = $row;
                            }
                        }

                        return $data;
                    } else {
                        //echo "Perorang";
                        $cuti = "<b style=color:white;background-color:green;padding:5px 8px 5px 8px;>C</b>";
                        $this->db->simple_query("SET SESSION group_concat_max_len = 1000000");
                        $query1 = "
                            SELECT
                                GROUP_CONCAT(
                                    CONCAT(
                                        \"GROUP_CONCAT(DISTINCT(CASE
                                        WHEN DATE_FORMAT(s.timelog, '%Y-%m-%d') = '\" ,dt, \"' THEN 'H'
                                        WHEN DATE_FORMAT(cuti.date_long, '%Y-%m-%d') = '\" ,dt, \"' THEN  'C'
                                        WHEN DATE_FORMAT(shelter2.date_shelter, '%Y-%m-%d') = '\" ,dt, \"' THEN  'S'
                                        WHEN DATE_FORMAT(shelter3.date_shelter, '%Y-%m-%d') = '\" ,dt, \"' THEN  'D'
                                        WHEN DATE_FORMAT(shelter4.date_shelter, '%Y-%m-%d') = '\" ,dt, \"' THEN  'A'
                                        ELSE NULL END)) AS '\",date_format(dt,'%d'),\"'\"
                                    )
                                ) arrsql

                            FROM
                            (
                                SELECT DISTINCT(a.date) AS dt
                                FROM mod_detail_shift a
                                LEFT JOIN mod_employee r ON r.schedule = a.id
                                WHERE date_format(a.date, '%Y-%m') = '$bulan'
                                ORDER BY a.date
                            ) d
                            ";

                        $Q1     = $this->db->query($query1);
                        if ($Q1->num_rows() > 0){
                            foreach ($Q1->result_array() as $row){
                                $mysql[] = $row;
                            }
                        }


                        $query = "
                        SELECT r.employee_name AS NAME, l.location_name AS LOCATION, d.department_name AS DIVISION,

                            COUNT(Distinct date_format(s.timelog, '%Y-%m-%d')) As Hadir,

                            (   SELECT count(mod_detail_annual_leave.jml) AS total
                                FROM mod_detail_annual_leave
                                LEFT JOIN mod_employee ON mod_detail_annual_leave.employee_code = mod_employee.employee_code
                                WHERE mod_detail_annual_leave.employee_code IN (r.employee_code)
                                AND DATE_FORMAT(mod_detail_annual_leave.date_start, '%Y-%m')='$bulan' AND DATE_FORMAT(mod_detail_annual_leave.date_end, '%Y-%m')='$bulan'
                                AND mod_employee.employee_code ='". $employee_code ."'
                            ) as Cuti,

                            (   SELECT count(mod_shelter.pin) AS sakit
                                FROM mod_employee
                                LEFT JOIN mod_shelter ON mod_employee.pin = mod_shelter.pin
                                WHERE mod_shelter.pin IN (s.pin) AND mod_shelter.status ='S'
                                AND DATE_FORMAT(mod_shelter.date_shelter, '%Y-%m')='$bulan' AND mod_employee.employee_code ='". $employee_code ."'
                            ) as Sakit,

                            (   SELECT count(mod_shelter.pin) AS dinas
                                FROM mod_employee
                                LEFT JOIN mod_shelter ON mod_employee.pin = mod_shelter.pin
                                WHERE mod_shelter.pin IN (s.pin) AND mod_shelter.status ='D'
                                AND DATE_FORMAT(mod_shelter.date_shelter, '%Y-%m')='$bulan' AND mod_employee.employee_code ='". $employee_code ."'
                            ) as Dinas,

                            (   SELECT count(mod_shelter.pin) AS alpha
                                FROM mod_employee
                                LEFT JOIN mod_shelter ON mod_employee.pin = mod_shelter.pin
                                WHERE mod_shelter.pin IN (s.pin) AND mod_shelter.status ='A'
                                AND DATE_FORMAT(mod_shelter.date_shelter, '%Y-%m')='$bulan' AND mod_employee.employee_code ='". $employee_code ."'
                            ) as Alpha,

                            " . $mysql[0][arrsql] . "

                                FROM mod_absen s

                                LEFT JOIN mod_employee r ON r.pin = s.pin
                                INNER JOIN mod_location l ON l.location_id = r.location
                                INNER JOIN mod_department d ON d.department_code = r.department_code
                                LEFT JOIN mod_detail_annual_leave cuti ON cuti.employee_code = r.employee_code
                                LEFT JOIN mod_shelter shelter2 ON shelter2.pin = r.pin AND shelter2.status ='S'
                                LEFT JOIN mod_shelter shelter3 ON shelter3.pin = r.pin AND shelter3.status ='D'
                                LEFT JOIN mod_shelter shelter4 ON shelter4.pin = r.pin AND shelter4.status ='A'
                                WHERE date_format(s.timelog, '%Y-%m') = '$bulan' AND r.employee_code ='". $employee_code ."'
                                GROUP BY s.pin, MONTH(timelog) ORDER BY r.employee_name ASC
                                ";

                        $Q      = $this->db->query($query);

                        if ($Q->num_rows() > 0){
                            foreach ($Q->result_array() as $row){
                                $data[] = $row;
                            }
                        }

                        return $data;
                    }



            } else {



                    $cuti = "<b style=color:white;background-color:green;padding:5px 8px 5px 8px;>C</b>";
                    $this->db->simple_query("SET SESSION group_concat_max_len = 1000000");
                    $query1 = "
                        SELECT
                            GROUP_CONCAT(
                                CONCAT(
                                    \"GROUP_CONCAT(DISTINCT(CASE
                                    WHEN DATE_FORMAT(s.timelog, '%Y-%m-%d') = '\" ,dt, \"' THEN 'H'
                                    WHEN DATE_FORMAT(cuti.date_long, '%Y-%m-%d') = '\" ,dt, \"' THEN  'C'
                                    WHEN DATE_FORMAT(shelter2.date_shelter, '%Y-%m-%d') = '\" ,dt, \"' THEN  'S'
                                    WHEN DATE_FORMAT(shelter3.date_shelter, '%Y-%m-%d') = '\" ,dt, \"' THEN  'D'
                                    WHEN DATE_FORMAT(shelter4.date_shelter, '%Y-%m-%d') = '\" ,dt, \"' THEN  'A'
                                    ELSE NULL END)) AS '\",date_format(dt,'%d'),\"'\"
                                )
                            ) arrsql

                        FROM
                        (
                            SELECT DISTINCT(a.date) AS dt
                            FROM mod_detail_shift a
                            LEFT JOIN mod_employee r ON r.schedule = a.id
                            WHERE date_format(a.date, '%Y-%m') = '$bulan'
                            ORDER BY a.date
                        ) d
                        ";

                    $Q1     = $this->db->query($query1);
                    if ($Q1->num_rows() > 0){
                        foreach ($Q1->result_array() as $row){
                            $mysql[] = $row;
                        }
                    }


                    $query = "
                    SELECT r.employee_name AS NAME, l.location_name AS LOCATION, d.department_name AS DIVISION,

                        COUNT(Distinct date_format(s.timelog, '%Y-%m-%d')) As Hadir,

                        (   SELECT count(mod_detail_annual_leave.jml) AS total
                            FROM mod_detail_annual_leave
                            LEFT JOIN mod_employee ON mod_detail_annual_leave.employee_code = mod_employee.employee_code
                            WHERE mod_detail_annual_leave.employee_code IN (r.employee_code)
                            AND DATE_FORMAT(mod_detail_annual_leave.date_start, '%Y-%m')='$bulan' AND DATE_FORMAT(mod_detail_annual_leave.date_end, '%Y-%m')='$bulan'
                        ) as Cuti,

                        (   SELECT count(mod_shelter.pin) AS sakit
                            FROM mod_employee
                            LEFT JOIN mod_shelter ON mod_employee.pin = mod_shelter.pin
                            WHERE mod_shelter.pin IN (s.pin) AND mod_shelter.status ='S'
                            AND DATE_FORMAT(mod_shelter.date_shelter, '%Y-%m')='$bulan'
                        ) as Sakit,

                        (   SELECT count(mod_shelter.pin) AS dinas
                            FROM mod_employee
                            LEFT JOIN mod_shelter ON mod_employee.pin = mod_shelter.pin
                            WHERE mod_shelter.pin IN (s.pin) AND mod_shelter.status ='D'
                            AND DATE_FORMAT(mod_shelter.date_shelter, '%Y-%m')='$bulan'
                        ) as Dinas,

                        (   SELECT count(mod_shelter.pin) AS alpha
                            FROM mod_employee
                            LEFT JOIN mod_shelter ON mod_employee.pin = mod_shelter.pin
                            WHERE mod_shelter.pin IN (s.pin) AND mod_shelter.status ='A'
                            AND DATE_FORMAT(mod_shelter.date_shelter, '%Y-%m')='$bulan'
                        ) as Alpha,

                        " . $mysql[0][arrsql] . "

                            FROM mod_absen s

                            LEFT JOIN mod_employee r ON r.pin = s.pin
                            INNER JOIN mod_location l ON l.location_id = r.location
                            INNER JOIN mod_department d ON d.department_code = r.department_code
                            LEFT JOIN mod_detail_annual_leave cuti ON cuti.employee_code = r.employee_code
                            LEFT JOIN mod_shelter shelter2 ON shelter2.pin = r.pin AND shelter2.status ='S'
                            LEFT JOIN mod_shelter shelter3 ON shelter3.pin = r.pin AND shelter3.status ='D'
                            LEFT JOIN mod_shelter shelter4 ON shelter4.pin = r.pin AND shelter4.status ='A'
                            WHERE date_format(s.timelog, '%Y-%m') = '$bulan' ";

                if ($loc !="")
                    {   
                        $query  .= "AND r.location ='$loc' ";
                    }


                if ($shift !="")
                    { 
                        $query  .= "AND r.shift_code ='$shift'  ";
                    }

                if ($div !="")
                    {   
                        $query  .= "AND r.department_code ='$div' ";
                    }

                $query            .= "GROUP BY s.pin, MONTH(timelog) ORDER BY r.employee_name ASC ";
                // echo "<pre>"; var_dump($query);exit();
                $Q      = $this->db->query($query);
                if ($Q->num_rows() > 0){
                    foreach ($Q->result_array() as $row){
                        $data[] = $row;
                    }
                }

                return $data;

            }


        } else {

            redirect('login', 'refresh');

        }

    }


    public function get_cuti($item,$loc)
    {
        $query2 = $this->db->query(" SELECT mod_detail_annual_leave.employee_code AS total_cuti
                                     FROM mod_detail_annual_leave
                                     INNER JOIN mod_employee ON mod_detail_annual_leave.employee_code = mod_employee.employee_code
                                     WHERE DATE_FORMAT(mod_detail_annual_leave.date_start, '%Y-%m')='$item' ");

        return $query2->num_rows();
    }


    public function get_timesheet_1($item)
    {
        $tanggal = date("Y-m-d", strtotime($tgltimesheet2));
        $tahun =  date("Y", strtotime($tgltimesheet2));
        $bulan = date("m", strtotime($tgltimesheet2));
        $nbulan = date("m", strtotime($tgltimesheet2) - 1);

        $tgl_today = date($tgltimesheet2);
        $tgl1 = date('01', strtotime($tgltimesheet2));

        $tgl2 = date('t', strtotime($tgltimesheet2));

        $rangestart = $tahun . "-" . $bulan . "-" . $tgl1;
        $rangeend = $tahun . "-" . $bulan . "-" . $tgl2;
        $data           = array();

        $query      = "SELECT date_format(date, '%d') as date FROM mod_detail_shift WHERE date_format(date, '%Y-%m') = '$item'  ";
        
        $Q      = $this->db->query($query);
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data[] = $row;
            }
        }
        return $data;
    }


    public function listing($date1, $date2, $pin, $div, $loc)
    {
    if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');
            $id         = $session_data['employee_code'];
            $role_id    = $session_data['role_id'];
            $names      = $session_data['employee_name'];
            $pins       = $session_data['pin'];

            $x = date("Y-m-d", strtotime($date1));
            $y = date("Y-m-d", strtotime($date2));


            if($role_id == '10'){

                $data           = array();
                $query          = "SELECT mod_employee.pin, mod_employee.employee_name, mod_detail_shift_work.shift_in, mod_detail_shift_work.shift_out, mod_department.department_name,
                                    DATE_FORMAT( mod_absen.timelog, '%Y-%m-%d' ) AS DATE, MIN( DATE_FORMAT( mod_absen.timelog, '%H:%i' ) ) AS log_in,
                                    MAX( DATE_FORMAT( mod_absen.timelog, '%H:%i' ) ) AS log_out
                                    FROM mod_absen
                                    INNER JOIN mod_employee ON mod_absen.pin = mod_employee.pin
                                    INNER JOIN mod_department ON mod_employee.department_code = mod_department.department_code
                                    LEFT JOIN mod_detail_shift_work ON mod_employee.shift_code = mod_detail_shift_work.shift_code AND mod_detail_shift_work.day_name = mod_absen.day_name
                                    WHERE date_format(mod_absen.timelog, '%Y-%m-%d') >='$date1' and  date_format(mod_absen.timelog, '%Y-%m-%d') <='$date2' and mod_absen.pin='$pins' GROUP BY pin, DATE( timelog ) ORDER BY timelog ASC ";

                $Q    = $this->db->query($query);

                if ($Q->num_rows() > 0){
                  foreach ($Q->result_array() as $row){
                    $data[] = $row;
                  }
                }

                return $data;

            }elseif($role_id == 4){

              $data           = array();
              $query          = "SELECT mod_employee.pin, mod_employee.employee_name, mod_detail_shift_work.shift_in, mod_detail_shift_work.shift_out, mod_department.department_name,
                                  DATE_FORMAT( mod_absen.timelog, '%Y-%m-%d' ) AS DATE, MIN( DATE_FORMAT( mod_absen.timelog, '%H:%i' ) ) AS log_in,
                                  MAX( DATE_FORMAT( mod_absen.timelog, '%H:%i' ) ) AS log_out
                                  FROM mod_absen
                                  INNER JOIN mod_employee ON mod_absen.pin = mod_employee.pin
                                  INNER JOIN mod_department ON mod_employee.department_code = mod_department.department_code
                                  LEFT JOIN mod_detail_shift_work ON mod_employee.shift_code = mod_detail_shift_work.shift_code AND mod_detail_shift_work.day_name = mod_absen.day_name  ";

              if($pin != ""){
                  $query .= "WHERE date_format(mod_absen.timelog, '%Y-%m-%d') >='$date1' and  date_format(mod_absen.timelog, '%Y-%m-%d') <='$date2' and mod_absen.pin='$pin' GROUP BY pin, DATE( timelog ) ORDER BY timelog ASC ";
              }elseif($department != ""){
                  $query .= "WHERE date_format(mod_absen.timelog, '%Y-%m-%d') >='$date1' and  date_format(mod_absen.timelog, '%Y-%m-%d') <='$date2' GROUP BY pin, DATE( timelog ) ORDER BY timelog ASC ";
              }else{
                  $query .= "WHERE mod_employee.parent='$id' || mod_employee.employee_code= '$id' AND  date_format(mod_absen.timelog, '%Y-%m-%d') >='$date1' and  date_format(mod_absen.timelog, '%Y-%m-%d') <='$date2' GROUP BY pin, DATE( timelog ) ORDER BY timelog ASC ";
              }

              $Q    = $this->db->query($query);

              if ($Q->num_rows() > 0){
                foreach ($Q->result_array() as $row){
                  $data[] = $row;
                }
              }

              return $data;

            }else{

                $data           = array();
                $query          = "SELECT mod_employee.pin, mod_employee.employee_name, mod_detail_shift_work.shift_in, mod_detail_shift_work.shift_out,mod_department.department_name,
                                    DATE_FORMAT( mod_absen.timelog, '%Y-%m-%d' ) AS DATE, MIN( DATE_FORMAT( mod_absen.timelog, '%H:%i' ) ) AS log_in,
                                    MAX( DATE_FORMAT( mod_absen.timelog, '%H:%i' ) ) AS log_out
                                    FROM mod_absen
                                    INNER JOIN mod_employee ON mod_absen.pin = mod_employee.pin
                                    INNER JOIN mod_department ON mod_employee.department_code = mod_department.department_code
                                    LEFT JOIN mod_detail_shift_work ON mod_employee.shift_code = mod_detail_shift_work.shift_code AND mod_detail_shift_work.day_name = mod_absen.day_name 
                                    WHERE date_format(mod_absen.timelog, '%Y-%m-%d') >='$date1' and  date_format(mod_absen.timelog, '%Y-%m-%d') <='$date2' ";

                if($pins =='1248'){

                    if($pin != ""){ 
                        $query .= "AND mod_employee.pin ='$pin' ";
                    } else{ 
                        $query .= "AND mod_employee.parent ='".$id."' ";
                    }

                        $query .= "GROUP BY pin, DATE( timelog ) ORDER BY timelog ASC ";

                    $Q    = $this->db->query($query);

                    if ($Q->num_rows() > 0){
                      foreach ($Q->result_array() as $row){
                        $data[] = $row;
                      }
                    }

                    return $data;

                } else {


                    if($pin != ""){ 
                        $query .= "AND mod_employee.pin ='$pin' ";
                    }

                    if($div != ""){ 
                        $query .= "AND mod_employee.department_code ='$div' GROUP BY pin, DATE( timelog ) ORDER BY timelog ASC ";
                    } 

                    if($loc != ""){ 
                        $query .= "AND mod_employee.location ='$loc' GROUP BY pin, DATE( timelog ) ORDER BY timelog ASC ";
                    }

                    else{ 
                        $query .= "GROUP BY pin, DATE( timelog ) ORDER BY timelog ASC ";
                    }
                    //echo "<pre>";var_dump($query);exit();
                    $Q    = $this->db->query($query);

                    if ($Q->num_rows() > 0){
                      foreach ($Q->result_array() as $row){
                        $data[] = $row;
                      }
                    }

                    return $data;

                }
            }



        }else{
            redirect('login', 'refresh');
        }
    }

}
