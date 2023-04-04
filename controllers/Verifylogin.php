<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Verifylogin extends CI_Controller {

    private $exp_time = 3000000; 


   function __construct(){
       parent::__construct();
       $this->load->library('toastr');
       $this->load->model('users_mdl','',TRUE);

   }

  public function index()
  {
       $this->load->library('form_validation');
       $this->form_validation->set_rules('user_name', 'Email', 'trim|required|xss_clean');
       $this->form_validation->set_rules('user_password', 'Password', 'trim|required|xss_clean|callback_check_database');

       if($this->form_validation->run() == FALSE)
         {    
           $this->load->view('login');
         }
       else
         {  
            $proses = $this->input->post('check');

            if($proses != NULL){

                $ip = $this->input->post('ip');

                $this->insert_finger_print($ip);

                $this->db->query("DELETE FROM mod_absen WHERE timelog='0000-00-00 00:00:00'");

                //Data umur akan selalu diupdate ketika login
                $user_name = $this->input->post('user_name');
                //Update Umur
                $cek_umur = $this->db->query("SELECT birth_date, date_of_hire FROM mod_employee WHERE email ='$user_name'");
                foreach ($cek_umur->result() as $row_umur){}

                $birthDt11 = date_create($row_umur->date_of_hire);
                $birthDt1 = date_create($row_umur->birth_date);
                $birthDt2 = date_format($birthDt1, "Y-m-d");
                $birthDt = new dateTime($birthDt2);


                $birthDt22 = date_format($birthDt11, "Y-m-d");
                $birthDt2 = new dateTime($birthDt22);

                $today = new DateTime('today');
                $y = $today->diff($birthDt)->y;
                $m = $today->diff($birthDt)->m;
                $d = $today->diff($birthDt)->d;
                $xy = $y." tahun ".$m." bulan ".$d." hari";
                $umur = $y;

                $y2 = $today->diff($birthDt2)->y;
                $m2 = $today->diff($birthDt2)->m;
                $d2 = $today->diff($birthDt2)->d;
                $xy2 = $y2." tahun ".$m2." bulan ".$d2." hari";

                $item = array (

                'age'           => $xy,
                'ages'          => $umur,
                'working_age'   => $xy2

                );

                $data = array (
                'email'     => $user_name
                );

                $this->users_mdl->updated($item,$data);
            }

            redirect('dashboard', 'refresh');
         }
 }


     public function check_database($password)
     {
        $user_name = $this->input->post('user_name');

        $username = $this->input->post('user_name');
        $password = $this->input->post('user_password');
        $remember = $this->input->post('remember'); 
        
        if($remember == "on") { 
            set_cookie("user_name", $username, $this->exp_time);
            set_cookie("user_password", $password, $this->exp_time);
            set_cookie("remember", $remember, $this->exp_time);
        } else { 
            delete_cookie("user_name");
            delete_cookie("user_password");
            delete_cookie("remember");
        }

        $result = $this->users_mdl->login($user_name, $password);
       
        if($result)
           {
             $sess_array = array();
             foreach($result as $row)
             {
               $sess_array = array(
                   'user_id'        => $row->user_id,
                   'employee_code'  => $row->employee_code,
                   'pin'            => $row->pin,
                   'pic'            => $row->pic,
                   'user_name'      => $row->user_name,
                   'name'           => $row->name,
                   'user_status'    => $row->user_status,
                   'user_type'      => $row->user_type,
                   'company_code'   => $row->company_code,
                   'department'     => $row->department,
                   'department_code'=> $row->department_code,
                   'company_name'   => $row->company_name,
                   'datelogin'      => $row->datelogin,
                   'parent'         => $row->parent,
                   'role_id'        => $row->role_id,
                   'inisial'        => $row->inisial,
               );
               $this->session->set_userdata('logged_in', $sess_array);
             }
             return TRUE;
           }
           else
           {
             $cresult = $this->users_mdl->cekuser($user_name);
                 if ($cresult) {
                     $this->toastr->warning('Username or Password Invalid');
                  } else {
                     $this->toastr->warning('Username or Password Invalid');
                  }
                 return false;
           }
        }


    public function insert_finger_print($ip)
    { 

    $query_top = $this->db->query("SELECT ip, port FROM mod_device WHERE ip='".$ip."'");
    foreach ($query_top->result() as $row_top) {
    $ipnya = $row_top->ip;
    $portnya = $row_top->port;

      $IP           = $ipnya;
      $Key          = "0";
      if($IP        =="") $IP = $ipnya;
      if($Key       =="") $Key ="0";


        $Connect = fsockopen($IP, $portnya, $errno, $errstr, 1);
            if($Connect){
                $soap_request="<GetAttLog>
                                    <ArgComKey xsi:type=\"xsd:integer\">".$Key."</ArgComKey>
                                    <Arg><PIN xsi:type=\"xsd:integer\">All</PIN></Arg>
                                    <Arg><Name></Name></Arg>
                                </GetAttLog>";

                $newLine="\r\n";
                fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
                fputs($Connect, "Content-Type: text/xml".$newLine);
                fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
                fputs($Connect, $soap_request.$newLine);
                $buffer="";

                while($Response=fgets($Connect, 1024)){
                    $buffer=$buffer.$Response;
                }

            }else echo "Koneksi Gagal";


              $buffer=$this->Parse_Data($buffer,"<GetAttLogResponse>","</GetAttLogResponse>");
              $buffer=explode("\r\n",$buffer);

              for($a=0;$a<count($buffer);$a++)

                {
                  $data=$this->Parse_Data($buffer[$a],"<Row>","</Row>");

                  $pin=$this->Parse_Data($data,"<PIN>","</PIN>");

                  $datetime=$this->Parse_Data($data,"<DateTime>","</DateTime>");

                  $date = date("Y-m-d H:i:s");

                  $hr  = date($datetime,'%Y-%m-%d');

                  $hr1 = date($datetime,'%d');

                  $pins = $hr1;

                  $nameOfDay = date('l', strtotime($datetime));

                  $this->db->query("INSERT IGNORE INTO mod_absen (pin, auto, employee_code, date, day_name,timelog, date_import, clock_in, clock_out, status_in, id, status_out, status, noted) values ('$pin', '', '', '$datetime','$nameOfDay','$datetime', '$date', '$datetime',  '$datetime', '1', '', '', 'H', '')");

                      $this->Parse_data();

            }
        }
    }


    public function Parse_Data($data,$p1,$p2)
    {
        $data=" ".$data;
        $hasil="";
        $awal=strpos($data,$p1);

        if($awal!=""){

            $akhir=strpos(strstr($data,$p1),$p2);

        if($akhir!=""){

            $hasil=substr($data,$awal+strlen($p1),$akhir-strlen($p1));
            }
        }

        return $hasil;
    }


}


?>
