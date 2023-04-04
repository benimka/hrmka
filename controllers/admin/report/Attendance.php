<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance extends CI_Controller {

	public function __construct()
 	{
   		parent::__construct();
			$this->load->helper(array('form', 'url', 'inflector','file'));
			$this->load->library(array('session','form_validation','upload','toastr','apps'));
			$this->load->model(array('users_mdl','company_mdl','msg_mdl','attendance_mdl','assets_mdl'));
 	}


	public function index()
	{  
		if($this->session->userdata('logged_in'))
		   	{
			    $session_data   	 = $this->session->userdata('logged_in');
			    $data['name'] 		 = $session_data['name'];
			    $data['user_id'] 	 = $session_data['user_id'];
			    $data['user_name'] 	 = $session_data['user_name'];
                $id                  = $session_data['company_code'];
				$data['user_status'] = $session_data['user_status'];
				$data['pic']    	 = $session_data['pic'];
				$data['user_type'] 	 = $session_data['user_type'];
				$data['role_id'] 	 = $session_data['role_id'];
				$data['company_id']  = $session_data['company_id'];
				$data['title']       = 'Attendance Report';

		    	$this->load->view('default/header', $data);
			  	$this->load->view('report/attendance/report', $data);
			  	$this->load->view('default/footer', $data);

			}else{
				redirect('login', 'refresh');
			}
	}


	public function rpt(){
        if($this->session->userdata('logged_in'))
            {
                $session_data                 = $this->session->userdata('logged_in');
                $data['name']                 = $session_data['name'];
                $data['user_name']        = $session_data['user_name'];
                $data['user_status']      = $session_data['user_status'];
                $data['pic']                  = $session_data['pic'];
                $data['role_id']              = $session_data['role_id'];
                $data['user_type']        = $session_data['user_type'];
                $data['department']       = $session_data['department'];
                $usertype                       = $session_data['user_id'];

                $date1    = date('Y-m-d' , strtotime($_GET['date1']));
                $date2    = date('Y-m-d' , strtotime($_GET['date2']));
                $pin      = $_GET['pin'];
                $div      = $_GET['div'];
                $loc      = $_GET['loc'];
                $locfg    = $_GET['locfg']; 
                $check    = $_GET['check'];

              if($check == 1){

                        $this->insert_finger_print($locfg);
                        $this->db->query("DELETE FROM mod_absen WHERE timelog='0000-00-00 00:00:00'");
                        $data['report'] = $this->attendance_mdl->listing($date1, $date2, $pin, $div, $loc);
                        $this->load->view('report/attendance/rpt', $data);

                } else {
                   
                    $data['report'] = $this->attendance_mdl->listing($date1, $date2, $pin, $div, $loc);
                    $this->load->view('report/attendance/rpt', $data);

                }

            }else{
                redirect('login', 'refresh');
        }
    }


	public function excel()
	{
		$date1 = date('Y-m-d' , strtotime($_GET['date1']));
        $date2 = date('Y-m-d' , strtotime($_GET['date2']));
        $pin    = $_GET['pin'];
        $div    = $_GET['div'];
        $loc    = $_GET['loc'];

        $period = 'PERIODE';

        $locfg    = $_GET['locfg']; 
        $check    = $_GET['check'];

        if($check == 1){

        $this->insert_finger_print($locfg);

        $this->db->query("DELETE FROM mod_absen WHERE timelog='0000-00-00 00:00:00'");

        } 

        /* -----
        *   LOAD LIBRARY
        --------------*/
            $this->load->library('excel');
        /* -----
        *   CREATE STYLE FOR EXCEL
        --------------*/
            $TitleStyle = array(
                            'font' => array(
                                'bold' => (true),
                                'size' => (12)
                            )
            );
            $HeaderStyle = array(
                            'font' => array(
                                'bold' => (true),
                                'size' => (12)
                            ),
                            'alignment' => array(
                                'horizontal' =>
                                    PHPExcel_Style_Alignment::HORIZONTAL_LEFT
                            )
            );
            $InfoStyle  = array(
                            'font' => array(
                                'bold' => (true),
                                'size' => (12)
                            ),
                            'alignment' => array(
                                'horizontal' =>
                                    PHPExcel_Style_Alignment::HORIZONTAL_LEFT
                            )
            );
            $InfoSaldo  = array(
                            'font' => array(
                                'bold' => (true),
                                'size' => (12)
                            ),
                            'alignment' => array(
                                'horizontal' =>
                                    PHPExcel_Style_Alignment::HORIZONTAL_RIGHT
                            )
            );
            $Center = array(
                    'alignment' => array(
                        'horizontal' =>
                            PHPExcel_Style_Alignment::HORIZONTAL_LEFT
                    )
            );
        /* -----
        *   SET PROPERTY
        --------------*/
            $this->excel->setActiveSheetIndex(0);
            $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(40);
            $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
            $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
            $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
            $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
            $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
            $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
            $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
            $this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
            $this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(70);
            $this->excel->getActiveSheet()->freezePane('A5');
            $this->excel->getActiveSheet()->getStyle('D')->getNumberFormat()->setFormatCode('#,##0.00');
            $this->excel->getActiveSheet()->getStyle('E')->getNumberFormat()->setFormatCode('#,##0');
            $this->excel->getActiveSheet()->getStyle('F')->getNumberFormat()->setFormatCode('#,##0');
            $this->excel->getActiveSheet()->getStyle("A")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("B")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("D")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("A4")->applyFromArray($InfoStyle);
            $this->excel->getActiveSheet()->getStyle("F4")->applyFromArray($InfoSaldo);
            $this->excel->getActiveSheet()->getStyle("A1:A3")->applyFromArray($HeaderStyle);
        /* -----
        *   HEADER
        --------------*/
            $Row    = 1;
            $Coas   = "EMPTY";
            $Col    = "A";
            # -------------
             # -------------
            $this->excel->getActiveSheet()->setTitle('Attendance Report');
            # -------------
            $this->excel->getActiveSheet()->setCellValue('A' . $Row, $a); $Row++;
            $this->excel->getActiveSheet()->setCellValue('A' . $Row, 'Attendance Report'); $Row++;
            $this->excel->getActiveSheet()->setCellValue('A' . $Row, 'PERIODE : ' . ''. $date1 .''  . " - " . ''. $date2 .''); $Row++;

            $this->excel->getActiveSheet()->getStyle("A".$Row.":Z".$Row)->applyFromArray($TitleStyle);
            $this->excel->getActiveSheet()->getStyle("A".$Row.":Z".$Row)->applyFromArray($Center);
                $this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Name'); $Col++;
                $this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Department'); $Col++;
            $this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Date'); $Col++;
                $this->excel->getActiveSheet()->setCellValue($Col . $Row, 'On Duty'); $Col++;
                $this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Off Duty'); $Col++;
                $this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Clock In'); $Col++;
                $this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Clock Out'); $Col++;
                $this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Early'); $Col++;
                $this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Late'); $Col++;
                $this->excel->getActiveSheet()->setCellValue($Col . $Row, 'OT Time'); $Col++;
                $this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Total OT'); $Col++;
                $this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Note'); $Col++;$Row++;

            $check  = $_GET['check'];
            $locfg  = $_GET['locfg'];

            
            $this->db->query("DELETE FROM mod_absen WHERE timelog='0000-00-00 00:00:00'");
            
           $query = $this->attendance_mdl->listing($date1, $date2, $pin, $div, $loc);

            foreach ($query as $key => $value) {

                $Col            = "A";
                $Start          = "G" . $Row;
                $Start2         = "K" . $Row;

                $this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['employee_name']); $Col++;
                $this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['department_name']); $Col++;
                $this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['DATE']); $Col++;
                $this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['shift_in']); $Col++;
                $this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['shift_out']); $Col++;
                $this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['log_in']); $Col++;
                $this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['log_out']); $Col++;

                $jam_tetap = $value['shift_in'];
                $jam_masuk = $value['log_in'];
                $datetime1 = strtotime($jam_tetap);
                $datetime2 = strtotime($jam_masuk);



                $interval  = abs($datetime1 - $datetime2);
                $minutes   = round($interval / 60);

                if($jam_masuk < '08:00:00'){

                    $v = sprintf("%02d:%02d:00",   floor($minutes/60), $minutes%60);
                    $this->excel->getActiveSheet()->setCellValue($Col . $Row, $v); $Col++;

                } else {
                    $this->excel->getActiveSheet()->setCellValue($Col . $Row, "-"); $Col++;
                }

                if($jam_masuk > '08:30:00'){

                    $v = sprintf("%02d:%02d:00",   floor($minutes/60), $minutes%60);
                    $this->excel->getActiveSheet()->setCellValue($Col . $Row, $v); $Col++;

                }else{
                    $this->excel->getActiveSheet()->setCellValue($Col . $Row, "-"); $Col++;
                }


                $jam_tetap = '18:00:00';
                $jam_pulang = $value['log_out'];
                $jam_masuk = $value['log_in'];
                $datetime11 = strtotime($jam_tetap);
                $datetime22 = strtotime($jam_pulang);

                $intervals  = abs($datetime22 - $datetime11);
                $minutess   = round($intervals / 60);

                if($jam_pulang > '19:00:00' AND $jam_masuk < '08:00:00'){
                    $vs = sprintf("%02d:%02d:00",   floor($minutess/60), $minutess%60);
                    $this->excel->getActiveSheet()->setCellValue($Col . $Row, $vs); $Col++;
                }else{
                    $this->excel->getActiveSheet()->setCellValue($Col . $Row, "-"); $Col++;
                }

                $this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['noted']); $Col++;$Row++;
                # -------------

            }

            # -------------
            $this->excel->setActiveSheetIndex(0);
            # -------------
            $filename   = 'attendance_report.xls';
            # -------------
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'.$filename.'"');
            header('Cache-Control: max-age=0');
            # -------------
            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
            # -------------
            $objWriter->save('php://output');
	}


    public function insert_finger_print($locfg)
    { 
        
        $query_top = $this->db->query("SELECT ip, port FROM mod_device WHERE location_id='".$locfg."'");
        foreach ($query_top->result() as $row_top) {
        $ipnya = $row_top->ip;
        $portnya = $row_top->port;

        $IP= $ipnya;
        $Key="0";
        if($IP=="") $IP= $ipnya;
        if($Key=="") $Key="0";


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
        $data  = " ".$data;
        $hasil = "";
        $awal  = strpos($data,$p1);

        if($awal!=""){

            $akhir=strpos(strstr($data,$p1),$p2);

        if($akhir!=""){

            $hasil=substr($data,$awal+strlen($p1),$akhir-strlen($p1));
            }
        }

        return $hasil;
    }

}
