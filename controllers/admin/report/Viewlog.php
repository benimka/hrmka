<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Viewlog extends CI_Controller {

	public function __construct()
 	{
   		parent::__construct();
			$this->load->helper(array('form', 'url', 'inflector','file'));
			$this->load->library(array('session','form_validation','upload','toastr','apps','encrypt'));
			$this->load->model(array('users_mdl','company_mdl','msg_mdl','announcements_mdl','assets_mdl','bank_mdl','department_mdl','employee_mdl'));
 	}


	public function index()
	{  
		if($this->session->userdata('logged_in'))
		   	{	
				$session_data   			= $this->session->userdata('logged_in');
				$filter 					= $_GET['query'];
				$data['filter']				= $_GET['query'];
				$data['name'] 				= $session_data['name'];
				$data['user_name'] 			= $session_data['user_name'];
				$data['user_status'] 		= $session_data['user_status'];
				$data['datelogin'] 			= $session_data['datelogin'];
				$data['user_type'] 			= $session_data['user_type'];
				$data['role_id'] 			= $session_data['role_id'];
				$data['user_id'] 			= $session_data['user_id'];
				$data['title']       		= 'Viewlog Report';
				$data['master']        		= 'master';
				$data['pic'] 				= $session_data['pic'];
				$id 						= $this->uri->segment(2);
				$data['company']			= $this->employee_mdl->GetCompany();

				$this->load->view('default/header', $data);
			  	$this->load->view('report/viewlog/report', $data);
			  	$this->load->view('default/footer', $data);

				
			}else{
				redirect('login', 'refresh');
			}
	}


	public function rpt(){ 
		if($this->session->userdata('logged_in'))
		   	{
			    $session_data   		= $this->session->userdata('logged_in');
			    $data['name'] 			= $session_data['name'];
			    $data['user_name'] 	    = $session_data['user_name'];
				$data['user_status']    = $session_data['user_status'];
				$data['pic']    		= $session_data['pic'];
				$data['role_id'] 		= $session_data['role_id'];
				$data['company_name']   = $session_data['company_name'];
				$data['user_type'] 	    = $session_data['user_type'];
		        $data['department']     = $session_data['department'];
				$usertype 				= $session_data['user_id'];

                $date1 = date('Y-m-d' , strtotime($_GET['date1']));
                $date2 = date('Y-m-d' , strtotime($_GET['date2']));

				$data['report'] = $this->users_mdl->viewslog($date1, $date2);

		    	$this->load->view('report/viewlog/rpt', $data);

			}else{
				redirect('login', 'refresh');
		}
	}


	public function excel()
	{
		$date1 = date('Y-m-d' , strtotime($_GET['date1']));
        $date2 = date('Y-m-d' , strtotime($_GET['date2']));

        $period = 'PERIODE';

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
            $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
            $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
            $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(55);
            $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
            $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
            $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
            $this->excel->getActiveSheet()->freezePane('A6');
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
            $this->excel->getActiveSheet()->setTitle('Log Report');
            # -------------
            $this->excel->getActiveSheet()->setCellValue('A' . $Row, $a); $Row++;
            $this->excel->getActiveSheet()->setCellValue('A' . $Row, 'Log Report'); $Row++;
            $this->excel->getActiveSheet()->setCellValue('A' . $Row, 'PERIODE : ' . ''. $date1 .''  . " - " . ''. $date2 .''); $Row++;
            $this->excel->getActiveSheet()->setCellValue('A' . $Row, $this->config->item("company")); $Row++;

            $this->excel->getActiveSheet()->getStyle("A".$Row.":Z".$Row)->applyFromArray($TitleStyle);
            $this->excel->getActiveSheet()->getStyle("A".$Row.":Z".$Row)->applyFromArray($Center);
            $this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Name'); $Col++;
            $this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Lod Date'); $Col++;
            $this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Log Description'); $Col++;
            $this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Browser'); $Col++;
            $this->excel->getActiveSheet()->setCellValue($Col . $Row, 'IP'); $Col++;
            $this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Platform'); $Col++;$Row++;

            $query = $this->users_mdl->viewslog($date1, $date2);

            foreach ($query as $key => $value) {

                $Col            = "A";
                $Start          = "G" . $Row;
                $Start2         = "K" . $Row;

                $this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['name']); $Col++;
                $this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['created']); $Col++;
                $this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['log_description']); $Col++;
                $this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['browser']); $Col++;
                $this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['ip']); $Col++;
                $this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['platform']); $Col++;$Row++;
                # -------------

            }

            # -------------
            $this->excel->setActiveSheetIndex(0);
            # -------------
            $filename   = 'view_log.xls';
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
