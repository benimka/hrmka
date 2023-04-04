<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leave extends CI_Controller {

	public function __construct()
 	{
   		parent::__construct();
			$this->load->helper(array('form', 'url', 'inflector','file'));
			$this->load->library(array('session','form_validation','upload','toastr','apps'));
			$this->load->model(array('users_mdl','company_mdl','msg_mdl','announcements_mdl','annualleave_mdl'));
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
				$data['title']       = 'Leave Report';

		    	$this->load->view('default/header', $data);
			  	$this->load->view('report/leave/report', $data);
			  	$this->load->view('default/footer', $data);

			}else{
				redirect('login', 'refresh');
			}
	}


	public function rpt()
	{
		if($this->session->userdata('logged_in'))
		   	{

			    $session_data   		= $this->session->userdata('logged_in');
			    $data['name'] 			= $session_data['name'];
			    $data['user_name'] 	    = $session_data['user_name'];
				$data['user_status']    = $session_data['user_status'];
				$data['pic']    		= $session_data['pic'];
				$data['role_id'] 		= $session_data['role_id'];
				$data['user_type'] 	    = $session_data['user_type'];
	            $data['department']     = $session_data['department'];
	            $data['title']    		= 'Leave Report';
				$usertype 				= $session_data['user_id'];
				$date1 					= $_GET['date1'];
				$date2 					= $_GET['date2'];
				$employee_code 			= $_GET['employee_code'];
				$data['report'] 		= $this->annualleave_mdl->reporting($date1, $date2, $employee_code);

		    	$this->load->view('report/leave/rpt', $data);
			}else{
				redirect('login', 'refresh');
		}
	}


	public function excel()
	{
		$datex = date('d-m-Y' , strtotime($_GET['date1']));
        $dates = date('d-m-Y' , strtotime($_GET['date2']));


        $date1 = date('Y-m-d' , strtotime($_GET['date1']));
        $date2 = date('Y-m-d' , strtotime($_GET['date2']));

        $employee_code      = $_GET['employee_code'];

        $period = 'PERIODE';

        $query = $this->db->query("SELECT * FROM mod_company WHERE company_code ='$company_code'");

        foreach ($query->result_array() as $row){}

        $a = $row['inisial'];

        if($a == NULL){
            $data = array( 'title' => "Report_ALL",
                       'report' => $this->annualleave_mdl->reporting($date1, $date2, $employee_code));
        }else{
            $data = array( 'title' => $row['inisial'],
                       'report' => $this->annualleave_mdl->reporting($date1, $date2, $employee_code));
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
                                'italic' => (true),
                                'size' => (12)
                            ),
                            'alignment' => array(
                                'horizontal' =>
                                    PHPExcel_Style_Alignment::HORIZONTAL_RIGHT
                            )
            );
            $Left = array(
                    'alignment' => array(
                        'horizontal' =>
                            PHPExcel_Style_Alignment::HORIZONTAL_LEFT
                    )
            );
            $Center = array(
                    'alignment' => array(
                        'horizontal' =>
                            PHPExcel_Style_Alignment::HORIZONTAL_CENTER
                    )
            );
            $Right = array(
                'alignment' => array(
                    'horizontal' =>
                        PHPExcel_Style_Alignment::HORIZONTAL_RIGHT
                )
        );
        /* -----
        *   SET PROPERTY
        --------------*/
            $this->excel->setActiveSheetIndex(0);
            $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(40);
            $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
            $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
            $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
            $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
            $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
            $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
            $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
            $this->excel->getActiveSheet()->freezePane('A5');
            $this->excel->getActiveSheet()->getStyle("A")->applyFromArray($Left);
            $this->excel->getActiveSheet()->getStyle("B")->applyFromArray($Left);
            $this->excel->getActiveSheet()->getStyle("D")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("E")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("F")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("G")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("H")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("A4")->applyFromArray($InfoStyle);
            $this->excel->getActiveSheet()->getStyle("A1:A3")->applyFromArray($HeaderStyle);
        /* -----
        *   HEADER
        --------------*/
            $Row    = 1;
            $Coas   = "EMPTY";
            $Col    = "A";
            # -------------
             # -------------
            $this->excel->getActiveSheet()->setTitle('Detail Leave Report');
            # -------------
            $this->excel->getActiveSheet()->setCellValue('A' . $Row, $a); $Row++;
            $this->excel->getActiveSheet()->setCellValue('A' . $Row, 'Annualve Report'); $Row++;
            $this->excel->getActiveSheet()->setCellValue('A' . $Row, 'PERIODE : ' . ''. $datex .''  . " - " . ''. $dates .''); $Row++;

            $this->excel->getActiveSheet()->getStyle("A".$Row.":Z".$Row)->applyFromArray($TitleStyle);
            $this->excel->getActiveSheet()->getStyle("A".$Row.":Z".$Row)->applyFromArray($Center);
            $this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Name'); $Col++;
            $this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Type'); $Col++;
            $this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Description'); $Col++;
            $this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Start'); $Col++;
            $this->excel->getActiveSheet()->setCellValue($Col . $Row, 'End'); $Col++;
            $this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Saldo start'); $Col++;
            $this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Total leave'); $Col++;
            $this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Current leave'); $Col++; $Row++;

            $query = $this->annualleave_mdl->reporting($date1, $date2, $employee_code);

            foreach ($query as $key => $value) {

                $Col            = "A";
                $Start          = "G" . $Row;
                $Start2         = "K" . $Row;

                $this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['employee_name']); $Col++;
                $this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['type_cuty_name']); $Col++;
                $this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['annual_leave_description']); $Col++;
                $this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['date_start']); $Col++;
                $this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['date_end']); $Col++;
                $this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['balance']); $Col++;
                if($value['jml'] > 60){
                    $this->excel->getActiveSheet()->setCellValue($Col . $Row, "3 Bulan"); $Col++;
                } else {
                    $this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['jml']); $Col++;
                }

                $this->excel->getActiveSheet()->setCellValue($Col . $Row, $x = $value['balance']-$value['jml']); $Col++; $Row++;
                # -------------

            }


            // $querys = $this->annualleave_mdl->reporting_reportbersama($date1, $date2, $employee_code);

            // foreach ($querys as $key => $values) {

            //     $Col            = "A";
            //     $Start          = "G" . $Row;
            //     $Start2         = "K" . $Row;

            //     $this->excel->getActiveSheet()->setCellValue($Col . $Row, $values['employee_name']); $Col++;
            //     $this->excel->getActiveSheet()->setCellValue($Col . $Row, $values['type_cuty_name']); $Col++;
            //     $this->excel->getActiveSheet()->setCellValue($Col . $Row, $values['annual_leave_description']); $Col++;
            //     $this->excel->getActiveSheet()->setCellValue($Col . $Row, $values['date_start']); $Col++;
            //     $this->excel->getActiveSheet()->setCellValue($Col . $Row, $values['date_end']); $Col++;
            //     $this->excel->getActiveSheet()->setCellValue($Col . $Row, $values['jml']); $Col++;
            //     $this->excel->getActiveSheet()->setCellValue($Col . $Row, $values['balance']); $Col++; $Row++;
            //     # -------------

            // }


           

            # -------------
            $this->excel->setActiveSheetIndex(0);
            # -------------
            $filename   = 'leave_report.xls';
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
