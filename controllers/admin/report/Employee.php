<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {

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
				$data['title']       		= 'Employee Report';
				$data['master']        		= 'master';
				$data['pic'] 				= $session_data['pic'];
				$id 						= $this->uri->segment(2);
				$data['company']			= $this->employee_mdl->GetCompany();

				$this->load->view('default/header', $data);
			  	$this->load->view('report/employee/report', $data);
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
				//$data['tickethold']     = $this->ticket_mdl->tickethold($usertype);

				$stage 			= $_GET['stage'];
				$age 			= $_GET['age'];
				$status 		= $_GET['status'];
		        $company_code 	= $_GET['company_code'];

				$data['report'] = $this->employee_mdl->export_rpt($stage,$age,$status,$company_code);

		    	$this->load->view('report/employee/rpt', $data);

			}else{
				redirect('login', 'refresh');
		}
	}


	public function excel()
	{
		$stage 			= $_GET['stage'];
		$age 			= $_GET['age'];
		$status 		= $_GET['status'];
        $company_code 	= $_GET['company_code'];


		//$data = array( 'title' => 'Report',
		 	           //'report' => $this->employee_mdl->export_rpt($stage,$age,$status));

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
            $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
            $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
            $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
            $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
            $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
            $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
            $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
            $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
            $this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
            $this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
            $this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(30);
            $this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
            $this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
            $this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
            $this->excel->getActiveSheet()->getColumnDimension('O')->setWidth(30);
            $this->excel->getActiveSheet()->getColumnDimension('P')->setWidth(20);
            $this->excel->getActiveSheet()->getColumnDimension('Q')->setWidth(20);
            $this->excel->getActiveSheet()->getColumnDimension('R')->setWidth(90);
            $this->excel->getActiveSheet()->getColumnDimension('S')->setWidth(20);
            $this->excel->getActiveSheet()->getColumnDimension('T')->setWidth(20);
            $this->excel->getActiveSheet()->getColumnDimension('U')->setWidth(30);
            $this->excel->getActiveSheet()->getColumnDimension('V')->setWidth(30);
            $this->excel->getActiveSheet()->getColumnDimension('W')->setWidth(30);
            $this->excel->getActiveSheet()->getColumnDimension('X')->setWidth(30);
            $this->excel->getActiveSheet()->getColumnDimension('Y')->setWidth(30);
            $this->excel->getActiveSheet()->getColumnDimension('Z')->setWidth(30);
	        $this->excel->getActiveSheet()->getColumnDimension('AA')->setWidth(50);
            $this->excel->getActiveSheet()->getColumnDimension('AB')->setWidth(50);
            $this->excel->getActiveSheet()->getColumnDimension('AC')->setWidth(50);
            $this->excel->getActiveSheet()->getColumnDimension('AD')->setWidth(50);
            $this->excel->getActiveSheet()->getColumnDimension('AE')->setWidth(50);
            $this->excel->getActiveSheet()->freezePane('A4');
            $this->excel->getActiveSheet()->getStyle("A")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("K")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("J")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("L")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("M")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("N")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("O")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("P")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("Q")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("V")->applyFromArray($Right);
            $this->excel->getActiveSheet()->getStyle("X")->applyFromArray($Right);
            $this->excel->getActiveSheet()->getStyle("Y")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("Z")->applyFromArray($Right);
	        $this->excel->getActiveSheet()->getStyle("AA")->applyFromArray($Right);
            $this->excel->getActiveSheet()->getStyle("AB")->applyFromArray($Right);
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
            $this->excel->getActiveSheet()->setTitle('Employee Report');
            # -------------
            $this->excel->getActiveSheet()->setCellValue('A' . $Row, "MAHAMERU KENCANA ABADI GROUP"); $Row++;
            $this->excel->getActiveSheet()->setCellValue('A' . $Row, 'Employee Report'); $Row++;

            $this->excel->getActiveSheet()->getStyle("A".$Row.":AD".$Row)->applyFromArray($TitleStyle);
            $this->excel->getActiveSheet()->getStyle("A".$Row.":AD".$Row)->applyFromArray($Center);
      			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Employee ID'); $Col++;
      			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Number Contract'); $Col++;
      			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Company Name'); $Col++;
                $this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Employee Name'); $Col++;
      			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Department Name'); $Col++;
      			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Position Name'); $Col++;
      			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Level'); $Col++;
      			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Location'); $Col++;
      			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Place Birth'); $Col++;
      			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Sex'); $Col++;
      			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Birth Date'); $Col++;
      			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Age'); $Col++;
      			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Date Of Hire'); $Col++;
      			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Date Cut Off'); $Col++;
      			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Married Status'); $Col++;
      			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'NPWP'); $Col++;
      			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Religion'); $Col++;
      			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Status'); $Col++;
      			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Address'); $Col++;
                $this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Address 2'); $Col++;
      			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'City'); $Col++;
      			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Phone'); $Col++;
      			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Bank Account Name'); $Col++;
      			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Bank Account Number'); $Col++;
      			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Bank Name'); $Col++;
      			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Social ID'); $Col++;
      			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'BPJS Kesehatan'); $Col++;
      			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'BPJS Ketenagakerjaan'); $Col++;
                $this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Emergency contact'); $Col++;
                $this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Heir / Ahli waris'); $Col++;
                $this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Domicili'); $Col++;$Row++;

            $query = $this->employee_mdl->export_rpt($stage,$age,$status,$company_code);

            foreach ($query as $key => $value) {

                $Col            = "A";
                $Start          = "G" . $Row;
                $Start2         = "K" . $Row;

                $this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['employee_code']); $Col++;
				$this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['number_contract']); $Col++;
                $this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['company_name']); $Col++;
				$this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['employee_name']); $Col++;
                $this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['department_name']); $Col++;
				$this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['position_name']); $Col++;
				$this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['level_name']); $Col++;
				$this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['location_name']); $Col++;
				$this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['place_birth']); $Col++;
				$this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['sex']); $Col++;
				$this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['birth_date']); $Col++;
				$this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['age']); $Col++;
				$this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['date_of_hire']); $Col++;
				$this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['date_cut_off']); $Col++;
				$this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['status_married']); $Col++;
				$this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['npwp']); $Col++;
				$this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['religion']); $Col++;
				$this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['mod_status_name']); $Col++;
				$this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['address']); $Col++;
                $this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['address_2']); $Col++;
				$this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['city']); $Col++;
				$this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['phone']); $Col++;
				$this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['bank_account_name']); $Col++;
				$this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['bank_account_no']); $Col++;
				$this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['bank_name']); $Col++;
				$this->excel->getActiveSheet()->setCellValue($Col . $Row, "'".$value['socialid']); $Col++;
				$this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['bpjs_kesehatan']); $Col++;
				$this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['bpjs_ketenagakerjaan']); $Col++;
				$this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['emergency_contact']); $Col++;
				$this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['heir']); $Col++;
                $this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['address_2']); $Col++;$Row++;
                # -------------

	        }

            # -------------
            $this->excel->setActiveSheetIndex(0);
            # -------------
            $filename   = 'employee_report.xls';
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
