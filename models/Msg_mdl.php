<?php

class Msg_mdl extends CI_Model{
	
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
                        WHERE sys_users.user_id='".$kode."' AND sys_modules.module_level = '3' AND sys_modules.module_parent ='1' ORDER BY sys_modules.order ASC ";

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

    public function get_download(){
    	if ($this->session->userdata('logged_in'))
    		{
	    		$session_data 		  	= $this->session->userdata('logged_in');
	    		$company_code 			= $session_data['company_code'];
	    		$year = date('Y');
	    		$date = date('Y-m-d');
	    		
		      	$Q 						= $this->db->query("SELECT * FROM sys_logs WHERE year(created) ='$year' AND log_document_id !='0' AND log_date <='$date' GROUP BY created, log_document_id ");
				    $jml    				= $Q->num_rows();
				    return $jml;

			} else {
				redirect('login', 'refresh');
			}
      }



    public function get_upload(){
    	if ($this->session->userdata('logged_in'))
    		{
	    		$session_data 		  	= $this->session->userdata('logged_in');
	    		$company_code 			= $session_data['company_code'];
	    		$year = date('Y');
	    		$date = date('Y-m-d'); 
	    		
		      	$Q 						= $this->db->query("SELECT * FROM mod_document WHERE year(created) ='$year' GROUP BY created ");
				$jml    				= $Q->num_rows();
				return $jml;

			} else {
				redirect('login', 'refresh');
			}
      }


    public function getExpired()
    {
    	  $data           = array();
    	  $params         = date('Y-m-d');
        $enampuluh      = mktime(0,0,0,date("n"),date("j")+60,date("Y"));
        $akhir          = date("Y-m-d", $enampuluh);

        $query      = "SELECT mod_document.*, mod_company.company_name, mod_document_type.type_name
        			   FROM mod_document
        			   INNER JOIN mod_company ON mod_document.company_id = mod_company.company_id
                       INNER JOIN mod_document_type ON mod_document.document_type = mod_document_type.type_id
        			   WHERE document_ex <= '$akhir' AND document_status !=4 ORDER BY document_ex ASC ";

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



    public function getMostUpload()
    {
    	  $data           = array();
    	  $params         = date('Y-m-d');
        $enampuluh      = mktime(0,0,0,date("n"),date("j")+60,date("Y"));
        $akhir          = date("Y-m-d", $enampuluh);

        $query      = "SELECT MAX(mod_document.count_upload) AS jml_upload, sys_users.name
                      FROM mod_document 
                      INNER JOIN sys_users ON mod_document.user_id = sys_users.user_id
                      WHERE mod_document.count_upload > 1
                      GROUP BY mod_document.user_id
                      ORDER BY mod_document.created ASC LIMIT 3 ";

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



    public function getMostDwonload()
    {
        $data           = array();
        $params         = date('Y-m-d');
        $enampuluh      = mktime(0,0,0,date("n"),date("j")+60,date("Y"));
        $akhir          = date("Y-m-d", $enampuluh);

        $query      = "SELECT sys_users.name, COUNT(*) AS jml_download
                        FROM mod_document
                        INNER JOIN sys_logs ON mod_document.document_id = sys_logs.log_document_id
                        INNER JOIN sys_users ON sys_logs.user_id = sys_users.user_id
                        GROUP BY sys_users.user_id
                        ORDER BY sys_logs.created DESC LIMIT 3 ";

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


    public function getSendEmail()
    {
        $data           = array();
        $params         = date('Y-m-d');
        $enampuluh      = mktime(0,0,0,date("n"),date("j")+60,date("Y"));
        $akhir          = date("Y-m-d", $enampuluh);

        $query      = "SELECT sys_logs.*, sys_users.name
                        FROM sys_logs 
                        INNER JOIN sys_users ON sys_logs.user_id = sys_users.user_id 
                        WHERE status_log =3";

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