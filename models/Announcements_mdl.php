<?php

class Announcements_mdl extends CI_Model{

    public function __construct(){
        parent::__construct();
    }


    public function save($item){
        
      $this->db->insert('mod_announcements',$item);
    }

    public function delete($id){
        $this->db->query("delete  from mod_announcements where id='$id'");
    }

    public function update($primary,$item)
    {   //echo "<pre>"; var_dump($primary,$item);exit();
        $this->db->where($primary);
        $this->db->update('mod_announcements',$item);
    }

    public function getdata()
    {
        $data       = array();
        $query      = "SELECT * FROM mod_announcements ";
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


    public function edit($id)
    {
        if ($this->session->userdata('logged_in'))
          {
              $session_data                   = $this->session->userdata('logged_in');
              $user_id                        = $session_data['user_id'];
              $role_id                        = $session_data['role_id'];
              $company_code                   = $session_data['company_code'];

                $query      = "SELECT * FROM mod_announcements WHERE id ='$id'  ";

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
