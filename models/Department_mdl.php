<?php

class Department_mdl extends CI_Model{

    public function __construct(){
        parent::__construct();
    }

    
    public function save($item){ 
        $this->db->insert('mod_department',$item);
    }


    public function delete($id){
        $this->db->query("delete  from mod_department where department_id='$id'");
    }


    public function update($primary,$data)
    {
        $this->db->where($primary);
        $this->db->update('mod_department',$data);
    }


    public function getdata($numbers = NULL)
    {
        $data       = array(); 
        if($numbers == NULL)
        {
            $query      = "SELECT mod_company.company_name, mod_department.*
                           FROM mod_department
                           INNER JOIN mod_company ON mod_department.company_code = mod_company.company_code";
        } else {
            $query      = "SELECT mod_company.company_name, mod_department.*
                           FROM mod_department
                           INNER JOIN mod_company ON mod_department.company_code = mod_company.company_code
                           WHERE mod_department.department_id ='".$numbers."'";
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

                $querys       = $this->db->query("SELECT inisial FROM mod_company WHERE company_code='$companyCode'");

                foreach ($querys->result() as $row)
                {
                    $row->inisial;
                }


                $q = $this->db->query("SELECT MAX(RIGHT(department_code,3)) AS idmax FROM mod_department WHERE company_code='$companyCode' ");

                    $kd = "";

                    if($q->num_rows()>0){
                        foreach($q->result() as $k){
                            $tmp = ((int)$k->idmax)+1;
                            $kd = sprintf("%03s", $tmp);
                        }
                    }else{
                        $kd = "001";
                    }
                    $kar = "$row->inisial-DEV";

                    return $kar.$kd;

            } else {
                redirect('login', 'refresh');
        }

   }





}
