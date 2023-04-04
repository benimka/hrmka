<?php

class Bank_mdl extends CI_Model{

    public function __construct(){
        parent::__construct();
    }


    public function save($item){
      $this->db->insert('mod_bank',$item);
    }

    public function delete($id){
        $this->db->query("delete  from mod_bank where bank_id='$id'");
    }

    public function update($primary,$data)
  {
      $this->db->where($primary);
      $this->db->update('mod_bank',$data);
  }

    public function getdata($numbers = NULL)
    {
        $data       = array(); 
        if($numbers == NULL)
        {
            $query      = "SELECT * FROM mod_bank ";
        } else {
            $query      = "SELECT * FROM mod_bank WHERE bank_id ='".$numbers."' ";
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
                        where sys_users.user_id='$kode' AND sys_module.module_level ='3' AND sys_module.module_parent='46' ORDER BY sys_module.module_order ASC ";
                        
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
