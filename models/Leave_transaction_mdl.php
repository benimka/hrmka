<?php

class Leave_transaction_mdl extends CI_Model{

    public function __construct(){
        parent::__construct();
    }


    public function save($item){
      $this->db->insert('mod_date',$item);
    }

    public function delete($id){
        $this->db->query("delete  from mod_bank where bank_id='$id'");
    }

    public function update($primary,$data)
    {
      $this->db->where($primary);
      $this->db->update('mod_bank',$data);
    }


    public function getalldata($filter)
    {
        if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');
            $data       = array(); 
            $y          = date('Y');
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
                          mod_type_cuty.type_cuty_name,
                          mod_employee.employee_code,
                          mod_employee.email,
                          mod_company.company_name
                          FROM mod_annual_leave
                          INNER JOIN mod_employee ON mod_annual_leave.employee_code = mod_employee.employee_code
                          INNER JOIN mod_company ON mod_employee.company_code = mod_company.company_code
                          INNER JOIN mod_type_cuty ON mod_annual_leave.type_cuty_id = mod_type_cuty.type_cuty_id ";
                         

            if($filter == NULL){
                $query .= "WHERE mod_employee.mod_status_code !='ST004' 
                           GROUP BY mod_annual_leave.annual_leave_code 
                           ORDER BY mod_annual_leave.annual_leave_date DESC";
            } 

            if($filter != NULL){
                $query .= "WHERE mod_annual_leave.approved ='".$filter."' 
                           GROUP BY mod_annual_leave.annual_leave_code 
                           ORDER BY mod_annual_leave.annual_leave_date DESC";
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


    public function getdata($filter,$codes)
    {
        if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');
            $data       = array(); 
            $y          = date('Y');
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
                          mod_type_cuty.type_cuty_name,
                          mod_employee.employee_code,
                          mod_employee.email,
                          mod_company.company_name
                          FROM mod_annual_leave
                          INNER JOIN mod_employee ON mod_annual_leave.employee_code = mod_employee.employee_code
                          INNER JOIN mod_company ON mod_employee.company_code = mod_company.company_code
                          INNER JOIN mod_type_cuty ON mod_annual_leave.type_cuty_id = mod_type_cuty.type_cuty_id ";

            if($filter == NULL AND $codes == NULL){
                $query .= "WHERE mod_employee.parent ='".$session_data['employee_code']."' 
                           GROUP BY mod_annual_leave.annual_leave_code ORDER BY mod_annual_leave.annual_leave_date DESC ";
            } 

            if($filter != NULL){
                $query .= "WHERE mod_annual_leave.approved ='".$filter."' AND
                           mod_employee.parent ='".$session_data['employee_code']."' 
                           GROUP BY mod_annual_leave.annual_leave_code ORDER BY mod_annual_leave.annual_leave_date DESC ";
            }

            if($codes != NULL){
                $query .= "WHERE mod_annual_leave.annual_leave_code ='".$codes."'
                           GROUP BY mod_annual_leave.annual_leave_code ORDER BY mod_annual_leave.annual_leave_date DESC ";
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

    public function getedit($id)
    {
        $data       = array();
        $query      = "SELECT * FROM mod_bank where bank_id='$id' ";

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
                    where sys_users.user_id='$kode' AND sys_module.module_level ='3' AND sys_module.module_parent='22' ORDER BY sys_module.module_order ASC ";
                    
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
}
