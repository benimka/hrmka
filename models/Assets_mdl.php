<?php

class Assets_mdl extends CI_Model{

    public function __construct(){
        parent::__construct();
    }


    public function save($item)
    {
      $this->db->insert('mod_master_assets',$item);
    }
    

    public function delete($id)
    {
        $this->db->query("DELETE FROM mod_assets WHERE id='$id'");
    }

    public function update($primary,$data)
    {   
        $this->db->where($data);
        $this->db->update('mod_master_assets',$primary);
    }

    public function GetData($numbers= NULL)
    {
        if ($this->session->userdata('logged_in'))
            {  
                $session_data = $this->session->userdata('logged_in');
                $user_id      = $session_data['user_id'];
                $inisial      = $session_data['inisial'];
                $company_code = $session_data['company_code'];
                $data       = array();
                $query      = "SELECT mod_master_assets.*, mod_company.inisial
                               FROM mod_master_assets
                               INNER JOIN mod_company ON mod_master_assets.company_code = mod_company.company_code "; 

                if($numbers == NULL){
                        $query .= "WHERE mod_master_assets.company_code='$company_code' ";
                } else {
                        $query .= "WHERE mod_master_assets.id ='".$numbers."'";
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


    public function auto() {
        if ($this->session->userdata('logged_in'))
            {
                $session_data = $this->session->userdata('logged_in');
                $user_id      = $session_data['user_id'];
                $company_code = $session_data['company_code'];
                $data         = array();

                $thn     = date("Y");
                $bln     = date("m");
                $tgl     = date("d");
                $sub_thn = substr($thn,2);

                $querys = $this->db->query("SELECT inisial FROM mod_company WHERE company_code='$company_code'");

                foreach ($querys->result() as $row)
                {
                     $row->inisial;
                }

                $q = $this->db->query("SELECT MAX(CAST(SUBSTRING(item_code, 1, length(item_code)-6) AS UNSIGNED)) as idmax FROM mod_master_assets WHERE company_code = '$company_code' ");

                $kd = "";

                if($q->num_rows()>0){
                    foreach($q->result() as $k){
                        $tmp = ((int)$k->idmax)+1;
                        $kd = sprintf("%03s", $tmp);
                    }
                }else{
                    $kd = "001";
                }
                $kar = "/ASSET/$row->inisial/$bln/$thn";

                return $kd.$kar;

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
                        where sys_users.user_id='$kode' AND sys_module.module_level ='3' AND sys_module.module_parent='71' ORDER BY sys_module.module_order ASC ";
                        
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



    public function report($date1,$date2,$company_code)
    {
        if ($this->session->userdata('logged_in'))
            {
                $session_data = $this->session->userdata('logged_in');
                $user_id      = $session_data['user_id'];
                $inisial      = $session_data['inisial'];
                $data         = array();

                $query      = "SELECT mod_master_assets.item_name, mod_master_assets.item_code, mod_employee.*, mod_company.*, mod_department.*,mod_position.*, mod_detail_assets.sum
                                FROM mod_detail_assets
                                INNER JOIN mod_master_assets ON mod_detail_assets.item_code = mod_master_assets.item_code
                                INNER JOIN mod_employee ON mod_detail_assets.employee_code = mod_employee.employee_code
                                INNER JOIN mod_company ON mod_employee.company_code = mod_company.company_code
                                INNER JOIN mod_department ON mod_employee.department_code = mod_department.department_code
                                INNER JOIN mod_position ON mod_employee.position_code = mod_position.position_code ";

                if($company_code == "all"){
                    $query  .= "WHERE mod_detail_assets.date_assets >='$date1' AND mod_detail_assets.date_assets <='$date2' GROUP BY mod_detail_assets.date_assets DESC";
                }else{
                    $query  .= "WHERE mod_company.company_code ='$company_code' GROUP BY mod_detail_assets.date_assets DESC";
                }
                // echo "<pre>";var_dump($query);exit();
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
