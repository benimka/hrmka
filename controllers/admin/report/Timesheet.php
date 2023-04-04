<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Timesheet extends CI_Controller {

	public function __construct()
 	{
   		parent::__construct();
			$this->load->helper(array('form', 'url', 'inflector','file'));
			$this->load->library(array('session','form_validation','upload','toastr','apps'));
			$this->load->model(array('users_mdl','msg_mdl','attendance_mdl','myleave_mdl','timesheet_mdl'));
 	}


	public function index()
	{
		if($this->session->userdata('logged_in'))
		   	{
				$session_data   			= $this->session->userdata('logged_in');
				$data['name'] 				= $session_data['name'];
				$data['user_name'] 			= $session_data['user_name'];
				$data['user_status'] 		= $session_data['user_status'];
				$data['datelogin'] 			= $session_data['datelogin'];
				$data['user_type'] 			= $session_data['user_type'];
				$data['role_id'] 			= $session_data['role_id'];
				$data['user_id'] 			= $session_data['user_id'];
				$data['title']       		= 'Timesheet Report';
				$data['master']        		= 'report';
				$data['pic'] 				= $session_data['pic'];
				$id 						= $this->uri->segment(2);
				$data['getdata']			= $this->attendance_mdl->GetData();
				$data['employees']   		= $this->attendance_mdl->getemployees();
				$data['locations']   		= $this->attendance_mdl->getlocation();
				$data['shift']       		= $this->attendance_mdl->getshift();
				
	            $this->load->view('default/header', $data);
			  	$this->load->view('backend/timesheet/report', $data);
			  	$this->load->view('default/footer', $data);
		        

				
			}else{
				redirect('login', 'refresh');
			}
	}


	public function timesheet_rpt()
	{
		if($this->session->userdata('logged_in'))
        {
          $session_data      = $this->session->userdata('logged_in');
          $data['name']      = $session_data['name'];
          $data['user_id']   = $session_data['user_id'];
          $data['user_name']   = $session_data['user_name'];
          $id                  = $session_data['company_code'];
          $data['user_status'] = $session_data['user_status'];
          $data['employee_code'] = $session_data['employee_code'];
          $data['pic']       = $session_data['pic'];
          $data['user_type']   = $session_data['user_type'];
          $data['role_id']   = $session_data['role_id'];
          $data['company_id']  = $session_data['company_id'];
          $data['department']  = $session_data['department'];
          $data['title']       = 'Timesheet';
          $data['aktif']       = 'active treeview';

          $bulan    =  $_GET['query'];
          $loc    	=  $_GET['loc'];
          $shift    =  $_GET['shift'];
          $div    	=  $_GET['dep']; 

        $bln = substr($bulan,5);
        $thn = substr($bulan,0,4);

        $tanggal = cal_days_in_month(CAL_GREGORIAN, $bln, $thn);

        $this->db->query("DELETE FROM mod_detail_shift WHERE date_format(date,'%Y-%m')='".$bulan."'");

        for($i=1; $i<$tanggal+1; $i++) {
          
            $item = array(
                'id'          => 1,
                'date'        => $hr = $thn."-".$bln."-".$i
               );

             $this->attendance_mdl->save_detailshift($item);
         }


        $html = "";
        $contents = $this->timesheet_mdl->get_timesheet($bulan,$loc,$shift,$div);
        $cuti     = $this->timesheet_mdl->get_cuti($bulan,$loc,$div);
        
        if (!empty($contents)){
          foreach($contents as $key => $row) {
              foreach($row as $field => $value) {
                    $recNew[$field][] = $value;
                }
          }
          $html .="<table id='listtimesheet' class='table table-bordered table-hover'>";
          $html .= "<thead>\n";
            $html .= "<tr>\n";
          foreach ($recNew as $key => $values)
          {
              $html .= "\t<td>" . $key . "</td>\n" ;
          }
            $html .= "</tr>\n";
          $html .= "</thead>";

          foreach ($contents as $key => $valuesx)
          {
              $html .= "<tr>\n";
                foreach ($valuesx as $cell) 
                {
                  //$html .= "\t<td>" . $cell . "</td>\n";
                            
                            if($cell == 'C,H'){$html .= "\t<td>" . "C" . "</td>\n";}elseif($cell == 'H,C'){$html .= "\t<td>" . "C" . "</td>\n";}else{
                            $html .= "\t<td>" . $cell . "</td>\n"; }
                }
              $html .= "</tr>\n";
          }
          $html .= "</table>";
        } else {
          $html .= "No Data to display";
        }

		$data['bulan'] = $bulan;
		$data['html'] = $html;

		$data['headerts'] = $this->timesheet_mdl->get_timesheet_1($bulan);
		$this->load->view('backend/timesheet/timesheet_table', $data);

      }else{
        redirect('login', 'refresh');
      }
	}


	public function timesheet_excel()
	{
		   $bulan    =  $_GET['query'];
      $loc    =  $_GET['loc'];
      $shift    =  $_GET['shift'];
      $div      = $_GET['dep'];

          $bln = substr($bulan,5);
          $thn = substr($bulan,0,4);

          $tanggal = cal_days_in_month(CAL_GREGORIAN, $bln, $thn);

          $this->db->query("DELETE FROM mod_detail_shift WHERE date_format(date,'%Y-%m')='".$bulan."'");

          for($i=1; $i<$tanggal+1; $i++) {
              $item = array(
          'id'          => 1,
          'date'          => $hr = $thn."-".$bln."-".$i
        );

        $this->attendance_mdl->save_detailshift($item);
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
                                'size' => (11)
                            ),
                            'alignment' => array(
                                'horizontal' =>
                                    PHPExcel_Style_Alignment::HORIZONTAL_LEFT
                            )
            );
            $InfoSaldo  = array(
                            'font' => array(
                                'italic' => (true),
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
                            PHPExcel_Style_Alignment::HORIZONTAL_CENTER
                    )
            );
        /* -----
        *   SET PROPERTY
        --------------*/
            $this->excel->setActiveSheetIndex(0);
            $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
            $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
            $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
            $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
            $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
            $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
            $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
            $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(5);
            $this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(5);
            $this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(5);
            $this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(5);
            $this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(5);
            $this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(5);
            $this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(5);
            $this->excel->getActiveSheet()->getColumnDimension('O')->setWidth(5);
            $this->excel->getActiveSheet()->getColumnDimension('P')->setWidth(5);
            $this->excel->getActiveSheet()->getColumnDimension('Q')->setWidth(5);
            $this->excel->getActiveSheet()->getColumnDimension('R')->setWidth(5);
            $this->excel->getActiveSheet()->getColumnDimension('S')->setWidth(5);
            $this->excel->getActiveSheet()->getColumnDimension('T')->setWidth(5);
            $this->excel->getActiveSheet()->getColumnDimension('U')->setWidth(5);
            $this->excel->getActiveSheet()->getColumnDimension('V')->setWidth(5);
            $this->excel->getActiveSheet()->getColumnDimension('W')->setWidth(5);
            $this->excel->getActiveSheet()->getColumnDimension('X')->setWidth(5);
            $this->excel->getActiveSheet()->getColumnDimension('Y')->setWidth(5);
            $this->excel->getActiveSheet()->getColumnDimension('Z')->setWidth(5);
            $this->excel->getActiveSheet()->getColumnDimension('AA')->setWidth(5);
            $this->excel->getActiveSheet()->getColumnDimension('AB')->setWidth(5);
            $this->excel->getActiveSheet()->getColumnDimension('AC')->setWidth(5);
            $this->excel->getActiveSheet()->getColumnDimension('AD')->setWidth(5);
            $this->excel->getActiveSheet()->getColumnDimension('AE')->setWidth(5);
            $this->excel->getActiveSheet()->getColumnDimension('AF')->setWidth(5);
            $this->excel->getActiveSheet()->getColumnDimension('AG')->setWidth(5);
            $this->excel->getActiveSheet()->getColumnDimension('AH')->setWidth(5);
            $this->excel->getActiveSheet()->getColumnDimension('AI')->setWidth(5);
            $this->excel->getActiveSheet()->getColumnDimension('AJ')->setWidth(5);
            $this->excel->getActiveSheet()->getColumnDimension('AK')->setWidth(5);
            $this->excel->getActiveSheet()->getColumnDimension('AL')->setWidth(5);
            $this->excel->getActiveSheet()->getColumnDimension('AM')->setWidth(5);
            $this->excel->getActiveSheet()->freezePane('A6');


            $this->excel->getActiveSheet()->getStyle("A")->applyFromArray($InfoStyle);
            $this->excel->getActiveSheet()->getStyle("B")->applyFromArray($InfoStyle);
            $this->excel->getActiveSheet()->getStyle("C")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("D")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("E")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("F")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("G")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("H")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("I")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("J")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("K")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("L")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("M")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("N")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("O")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("P")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("Q")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("R")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("S")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("T")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("U")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("V")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("W")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("X")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("Y")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("Z")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("AA")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("AB")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("AC")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("AD")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("AE")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("AF")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("AG")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("AI")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("AJ")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("AK")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("AL")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("AM")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("A1:A3")->applyFromArray($HeaderStyle);
            $this->excel->getActiveSheet()->getStyle("A4:AL4")->applyFromArray($HeaderStyle);
            $this->excel->getActiveSheet()->getStyle('H4:P4')->getNumberFormat()->setFormatCode('#0');

            /* -----
        *   HEADER
        --------------*/
            $Row    = 1;
            $Coas   = "EMPTY";
            $Col    = "A";
            # -------------
             # -------------
            $this->excel->getActiveSheet()->setTitle('Timesheet Report');
            # -------------
            $this->excel->getActiveSheet()->setCellValue('A' . $Row, 'PERIODE : ' . ''. date('F Y', strtotime($bulan)) .''); $Row++;
            $this->excel->getActiveSheet()->setCellValue('A' . $Row, 'TIMESHEET REPORT'); $Row++;
            $this->excel->getActiveSheet()->setCellValue('A' . $Row, 'PT. MAHAMERU KENCANA ABADI'); $Row++;
            $this->excel->getActiveSheet()->setCellValue('A' . $Row, ''); $Row++;

            $this->excel->getActiveSheet()->getStyle("A".$Row.":AM".$Row)->applyFromArray($TitleStyle);
            $this->excel->getActiveSheet()->getStyle("C".$Row.":AM".$Row)->applyFromArray($Center);


      $contents = $this->timesheet_mdl->get_timesheet($bulan,$loc,$shift,$div);
      $cuti     = $this->timesheet_mdl->get_cuti($bulan,$loc,$div);

      if (!empty($contents)){
        foreach($contents as $key => $row) {
            foreach($row as $field => $value) {
                  $recNew[$field][] = $value;
              }
        }

        foreach ($recNew as $key => $values)
        {
          $this->excel->getActiveSheet()->setCellValue($Col . $Row, $key ); $Col++;

        }  $Row++;


        foreach ($contents as $key => $valuesx)
        {
            $Col            = "A";
              $Start          = "B" . $Row;

              foreach ($valuesx as $cell)
              {
                 if($cell == 'C,H'){ 
                    $cell = "C"; 
                }elseif($cell == 'H,C'){
                    $cell = "C"; 
                }
                 $this->excel->getActiveSheet()->setCellValue($Col . $Row, $cell );
                 $Col++;

              }  $Row++;

        }

        $this->excel->getActiveSheet()->setCellValue('A' . $Row, ''); $Row++;
         $this->excel->getActiveSheet()->setCellValue('A' . $Row, 'LIST OF EMPTY ABSENT'); $Row++;
         $this->excel->getActiveSheet()->setCellValue('A' . $Row, ''); $Row++;

         $query_excel = $this->db->query("SELECT employee_name, timelog, location_name, department_name
                                                        FROM mod_employee a
                                                          LEFT JOIN (
                                                            SELECT pin, timelog FROM mod_absen 
                                                            WHERE DATE_FORMAT(timelog, '%Y-%m') >= '$bulan'
                                                          ) b ON a.pin = b.pin
                                                        INNER JOIN mod_location l ON l.location_id = a.location
                                                        INNER JOIN mod_department d ON d.department_code = a.department_code
                                                        WHERE timelog IS NULL AND mod_status_code <= 'ST002'")->result_array();
         foreach ($query_excel as $key => $values_excel) {

              $Col            = "A";

              $this->excel->getActiveSheet()->setCellValue($Col . $Row, $values_excel['employee_name']); $Col++;
              $this->excel->getActiveSheet()->setCellValue($Col . $Row, $values_excel['location_name']); $Col++;
              $this->excel->getActiveSheet()->setCellValue($Col . $Row, $values_excel['department_name']); $Col++; $Row++;

         }    


      } else {
        $html .= "No Data to display";
      }


            # -------------
            $this->excel->setActiveSheetIndex(0);
            # -------------
            $filename   = 'Timesheet_report.xls';
            # -------------
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'.$filename.'"');
            header('Cache-Control: max-age=0');
            # -------------
            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
            # -------------
            $objWriter->save('php://output');
	}
}
