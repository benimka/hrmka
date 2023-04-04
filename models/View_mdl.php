<?php

class View_mdl extends CI_Model{

    public function __construct(){
        parent::__construct();
    }


    public function getRules()
      {
        if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');
            $id       = $session_data['company_code'];
            $kode     = $session_data['user_id'];
            $data     = array();
            $query    = "SELECT sys_users.name, sys_modules.module_name, sys_modules.module_path, sys_modules.module_slug, sys_modules.module_level, sys_modules.module_parent,
                        sys_modules.module_id, sys_modules.order, sys_modules.symbol, sys_modules.module_child
                        FROM sys_users
                        INNER JOIN sys_roles ON sys_users.role_id = sys_roles.role_id
                        INNER JOIN sys_rules ON sys_roles.role_id = sys_rules.role_id
                        INNER JOIN sys_modules ON sys_rules.module_id = sys_modules.module_id
                        WHERE sys_users.user_id='".$kode."' AND sys_modules.module_level = '3' AND sys_modules.module_parent ='10' ORDER BY sys_modules.order ASC ";
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



    public function getDocument($id)
    {
        $data       = array();

        $query      .= "SELECT mod_document.company_id, mod_document.document_id, mod_document.document_type, mod_document.document_name, mod_document.document_year, mod_document.document_size, mod_document.document_upload, 
        mod_document.document_date as document_date,
        mod_document.document_ex as document_ex,
        mod_document_type.type_name, mod_company.company_name,
        mod_document.document_status, mod_document_type.parent_type
                        FROM mod_document
                        INNER JOIN mod_document_type ON mod_document.document_type = mod_document_type.type_id
                        INNER JOIN mod_company ON mod_document.company_id = mod_company.company_id
                        WHERE mod_company.slug ='$id' AND mod_document.document_status != 2 ORDER BY mod_document.document_id DESC ";
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



    public function search($id)
    {
        $data       = array();

        $query      .= "SELECT mod_document.company_id, mod_document.document_id, mod_document.document_type, mod_document.document_name, mod_document.document_year, mod_document.document_size, mod_document.document_upload, 
        mod_document.document_date as document_date,
        mod_document.document_ex as document_ex,
        mod_document_type.type_name, mod_company.company_name,
        mod_document.document_status
                        FROM mod_document
                        INNER JOIN mod_document_type ON mod_document.document_type = mod_document_type.type_id
                        INNER JOIN mod_company ON mod_document.company_id = mod_company.company_id
                        WHERE mod_document.document_id ='$id'  ORDER BY mod_document.document_id DESC ";
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



    public function getCommissaris($id)
    {
        $data       = array();
        $query      = "SELECT mod_commissaris.commissaris_id, mod_commissaris.company_id, mod_commissaris.commissaris_name, mod_commissaris.commissaris_title, mod_commissaris.commissaris_year, date_format(mod_commissaris.commissaris_ex, '%d-%m-%Y') as commissaris_ex, mod_commissaris.user_id, mod_commissaris.created, mod_commissaris.modified, mod_company.company_name
                       FROM mod_commissaris 
                       INNER JOIN mod_company ON mod_commissaris.company_id = mod_company.company_id
                       WHERE mod_company.slug ='$id' ORDER BY mod_commissaris.commissaris_id DESC ";
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


    public function getUpload()
    {
        $data       = array();
        $year       = date('Y');
        $query      = "SELECT mod_document.document_id, sys_users.name, mod_document.created, mod_document.document_name, 
                      mod_document.document_size,
                      mod_company.company_name
                      FROM mod_document
                      INNER JOIN mod_company ON mod_document.company_id = mod_company.company_id
                      INNER JOIN sys_users ON mod_document.user_id = sys_users.user_id
                      WHERE YEAR(mod_document.created) ='".$year."'
                      GROUP BY mod_document.document_id ";

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



    public function getDownload()
    {
        $data       = array();
        $query      = "SELECT sys_users.name, mod_document.document_name, 
                       sys_logs.created, sys_logs.browser, mod_document.document_size, sys_logs.log_description,
                       mod_company.company_name
                       FROM sys_logs
                       INNER JOIN sys_users ON sys_logs.user_id = sys_users.user_id
                       INNER JOIN mod_document ON sys_logs.log_document_id = mod_document.document_id
                       INNER JOIN mod_company ON mod_document.company_id = mod_company.company_id
                       GROUP BY sys_logs.created, sys_logs.log_document_id ";
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


    public function get_data()
    {
        $data       = array();
        $last_year  = date('Y')-1;

        $query = "SELECT * FROM mod_document";

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


    public function gethistories($id)
    {
        $data       = array();

        $query      .= "SELECT  date_format(sys_logs.created, '%Y-%m-%d') as created, sys_logs.status_log, sys_users.name, sys_logs.log_description, 
                        sys_logs.email, mod_document.document_name,mod_company.company_name
                        FROM sys_logs 
                        INNER JOIN mod_document ON sys_logs.log_document_id = mod_document.document_id
                        INNER JOIN mod_company ON mod_document.company_id = mod_company.company_id
                        INNER JOIN sys_users ON sys_logs.user_id = sys_users.user_id
                        WHERE sys_logs.log_document_id ='".$id."'";
                        
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

    public function getReport1($date1,$date2)
    {
        $data       = array();
        $year       = date('Y');
        $query      .= "SELECT mod_document.document_id, mod_document.document_size, mod_document.document_name, mod_company.company_name, date_format(sys_logs.created, '%Y-%m-%d') as created, sys_logs.status_log, sys_users.name, sys_logs.log_description, 
                        sys_logs.email, mod_document.document_name,mod_company.company_name
                        FROM sys_logs 
                        INNER JOIN mod_document ON sys_logs.log_document_id = mod_document.document_id
                        INNER JOIN mod_company ON mod_document.company_id = mod_company.company_id
                        INNER JOIN sys_users ON sys_logs.user_id = sys_users.user_id
                        WHERE mod_document.document_date >='".$date1."' AND mod_document.document_date <='".$date2."' ";

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
    
    public function getReport2($date1,$date2,$exp)
    {
        $data           = array();
        $year           = date('Y');
        $params         = date('Y-m-d');
        $enampuluh      = mktime(0,0,0,date("n"),date("j")+60,date("Y"));
        $akhir          = date("Y-m-d", $enampuluh);
    
        if($exp != 4){
            $query      = "SELECT mod_document.document_id, sys_users.name, mod_document.document_date,mod_document.document_ex, mod_document.document_name, 
            mod_document.document_size,
            mod_company.company_name
            FROM mod_document
            INNER JOIN mod_company ON mod_document.company_id = mod_company.company_id
            INNER JOIN sys_users ON mod_document.user_id = sys_users.user_id
            WHERE mod_document.document_date >='".$date1."' AND mod_document.document_date <='".$date2."' AND mod_document.document_status = '".$exp."'
            GROUP BY mod_document.document_id ";
        } else {
           $query      = "SELECT mod_document.document_id, sys_users.name, mod_document.document_date,mod_document.document_ex, mod_document.document_name, 
                      mod_document.document_size,
                      mod_company.company_name
                      FROM mod_document
                      INNER JOIN mod_company ON mod_document.company_id = mod_company.company_id
                      INNER JOIN sys_users ON mod_document.user_id = sys_users.user_id
                      WHERE mod_document.document_ex >='".$params."' AND document_ex <= '$akhir' 
                      GROUP BY mod_document.document_id ";
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


    public function getPresentageReport($date1,$date2)
    {
        $data           = array();
    
        $query          = "SELECT mod_commissaris.commissaris_name, mod_commissaris.commissaris_year, 
                           mod_company.company_name, mod_commissaris.presentage
                        FROM mod_commissaris
                        INNER JOIN mod_title ON mod_commissaris.commissaris_title = mod_title.id
                        INNER JOIN mod_company ON mod_commissaris.company_id = mod_company.company_id
                        WHERE mod_commissaris.commissaris_year >='".$date1."' AND mod_commissaris.commissaris_year <='".$date2."'
                        GROUP BY mod_commissaris.commissaris_id ";
       
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



    public function getDirectorsReport($date1,$date2)
    {
        $data           = array();
    
        $query          = "SELECT mod_commissaris.commissaris_name, mod_commissaris.commissaris_year, 
                           mod_company.company_name, mod_commissaris.presentage
                        FROM mod_commissaris
                        INNER JOIN mod_title ON mod_commissaris.commissaris_title = mod_title.id
                        INNER JOIN mod_company ON mod_commissaris.company_id = mod_company.company_id
                        WHERE mod_commissaris.commissaris_year >='".$date1."' AND mod_commissaris.commissaris_year <='".$date2."'
                        GROUP BY mod_commissaris.commissaris_id ";
       
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
