<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class View extends CI_Controller {

	public function __construct()
 	{
   		parent::__construct();
   			$this->load->library('excel');
			$this->load->helper(array('form', 'url', 'inflector'));
			$this->load->library(array('session','form_validation','apps'));
			$this->load->model(array('users_mdl','type_mdl','msg_mdl','view_mdl'));
 	}

	public function index($id = NULL)
	{	
		if($this->session->userdata('logged_in'))
		   	{	
		   		$id 						= $_GET['pages'];
				$session_data   			= $this->session->userdata('logged_in');
				$data['name'] 				= $session_data['name'];
				$data['user_name'] 			= $session_data['user_name'];
				$data['user_id'] 			= $session_data['user_id'];
				$data['user_status'] 		= $session_data['user_status'];
				$data['datelogin'] 			= $session_data['datelogin'];
				$data['user_type'] 			= $session_data['user_type'];
				$data['role_id'] 			= $session_data['role_id'];
				$data['module']				= $this->users_mdl->getmodule();
				$data['viewmodule']			= $this->users_mdl->viewmodule();
				$data['getdata']			= $this->type_mdl->get();
				$data['getCommissaris']		= $this->view_mdl->getCommissaris($id);
				$data['getDocument']		= $this->view_mdl->getDocument($id);
				$data['getRules']			= $this->view_mdl->getRules();
				$data['title']       		= 'company';
				$data['master']        		= 'master';

				$this->load->view('default/header', $data);
			  	$this->load->view('backend/documents/index', $data);
			  	$this->load->view('default/footer', $data);
			}else{
				redirect('login', 'refresh');
			}
	}


	public function search($id = NULL)
	{	
		if($this->session->userdata('logged_in'))
		   	{	
		   		$id 						= $_GET['page'];
				$session_data   			= $this->session->userdata('logged_in');
				$data['name'] 				= $session_data['name'];
				$data['user_name'] 			= $session_data['user_name'];
				$data['user_id'] 			= $session_data['user_id'];
				$data['user_status'] 		= $session_data['user_status'];
				$data['datelogin'] 			= $session_data['datelogin'];
				$data['user_type'] 			= $session_data['user_type'];
				$data['role_id'] 			= $session_data['role_id'];
				$data['module']				= $this->users_mdl->getmodule();
				$data['viewmodule']			= $this->users_mdl->viewmodule();
				$data['getdata']			= $this->type_mdl->get();
				$data['getCommissaris']		= $this->view_mdl->getCommissaris($id);
				$data['getDocument']		= $this->view_mdl->search($id);
				$data['getRules']			= $this->view_mdl->getRules();
				$data['title']       		= 'company';
				$data['master']        		= 'master';

				$this->load->view('default/header', $data);
			  	$this->load->view('backend/documents/search', $data);
			  	$this->load->view('default/footer', $data);
			}else{
				redirect('login', 'refresh');
			}
	}



	public function preview($id)
	{	
		if($this->session->userdata('logged_in'))
		   	{	
				$session_data   			= $this->session->userdata('logged_in');
				$data['name'] 				= $session_data['name'];
				$data['user_name'] 			= $session_data['user_name'];
				$data['user_id'] 			= $session_data['user_id'];
				$data['user_status'] 		= $session_data['user_status'];
				$data['datelogin'] 			= $session_data['datelogin'];
				$data['user_type'] 			= $session_data['user_type'];
				$data['role_id'] 			= $session_data['role_id'];
				$data['module']				= $this->users_mdl->getmodule();
				$data['viewmodule']			= $this->users_mdl->viewmodule();
				$data['getdata']			= $this->type_mdl->get();
				$data['getCommissaris']		= $this->view_mdl->getCommissaris($id);
				$data['getDocument']		= $this->view_mdl->getDocument($id);
				$data['title']       		= 'company';
				$data['master']        		= 'master';

				$qSelect = $this->db->query("SELECT * FROM mod_document WHERE document_id='".$id."'");

				foreach ($qSelect->result_array() as $row){}

				$this->load->helper('download');

				$users = $session_data['user_id'];

				$file = 'document/'.$row['document_upload'];

				$time = date('Y-m-d H:i:s');


				$this->load->library('user_agent');
				$logs   = array (
					"log_date"=>date("Y-m-d"),
					"log_description"=>"Preview",
					"log_document_id" => $id,
					"status_log" => 1,
					"user_id"=> $session_data['user_id'],
					"browser" => $this->agent->browser(),
					"ip" =>  $this->input->ip_address(),
					"platform" => $this->agent->platform(),
					"created"=>date("Y-m-d H:i:s"),
					"modified"=>date("Y-m-d H:i:s")
					);
				# -------------------------
				$this->db->insert("sys_logs", $logs);
            
	            $this->load->view('backend/documents/frame', $data);

			}else{
				redirect('login', 'refresh');
			}
	}



	public function download()
	{	
		if($this->session->userdata('logged_in'))
		   	{	
				$session_data   			= $this->session->userdata('logged_in');
				$data['name'] 				= $session_data['name'];
				$data['user_name'] 			= $session_data['user_name'];
				$data['user_id'] 			= $session_data['user_id'];
				$data['user_status'] 		= $session_data['user_status'];
				$data['datelogin'] 			= $session_data['datelogin'];
				$data['user_type'] 			= $session_data['user_type'];
				$data['role_id'] 			= $session_data['role_id'];
				$data['module']				= $this->users_mdl->getmodule();
				$data['viewmodule']			= $this->users_mdl->viewmodule();
				$data['getdata']			= $this->type_mdl->get();
				$data['getCommissaris']		= $this->view_mdl->getCommissaris($id);
				$data['getDocument']		= $this->view_mdl->getDocument($id);
				$data['title']       		= 'company';
				$data['master']        		= 'master';

				$id = $_GET['id'];
				$des = $_GET['des'];
				$log = $_GET['log'];

				$com_id = $this->input->post('com_id');

				$qSelect = $this->db->query("SELECT * FROM mod_document WHERE document_id='".$id."'");

				foreach ($qSelect->result_array() as $row){}

				$this->load->helper('download');

				$users = $session_data['user_id'];

				$file = 'document/'.$row['document_upload'];

				$time = date('Y-m-d H:i:s');


				$this->load->library('user_agent');
				$logs   = array (
					"log_date"=>date("Y-m-d"),
					"log_description"=> $des,
					"status_log" => $log,
					"log_document_id" => $id,
					"user_id"=> $session_data['user_id'],
					"browser" => $this->agent->browser(),
					"ip" =>  $this->input->ip_address(),
					"platform" => $this->agent->platform(),
					"created"=>date("Y-m-d H:i")
					);
				# -------------------------
				$this->db->insert("sys_logs", $logs);
            
	            force_download($file, NULL);


			}else{
				redirect('login', 'refresh');
			}
	}


	public function totalupload()
	{	
		if($this->session->userdata('logged_in'))
		   	{	
				$session_data   			= $this->session->userdata('logged_in');
				$data['name'] 				= $session_data['name'];
				$data['user_name'] 			= $session_data['user_name'];
				$data['user_id'] 			= $session_data['user_id'];
				$data['user_status'] 		= $session_data['user_status'];
				$data['datelogin'] 			= $session_data['datelogin'];
				$data['user_type'] 			= $session_data['user_type'];
				$data['role_id'] 			= $session_data['role_id'];
				$data['module']				= $this->users_mdl->getmodule();
				$data['viewmodule']			= $this->users_mdl->viewmodule();
				$data['getdata']			= $this->type_mdl->get();
				$data['getCommissaris']		= $this->view_mdl->getCommissaris($id);
				$data['getUpload']			= $this->view_mdl->getUpload();
				$data['title']       		= 'company';
				$data['master']        		= 'master';

				$this->load->view('default/header', $data);
			  	$this->load->view('backend/documents/upload', $data);
			  	$this->load->view('default/footer', $data);

			}else{
				redirect('login', 'refresh');
			}
	}

	public function totaldownload()
	{	
		if($this->session->userdata('logged_in'))
		   	{	
				$session_data   			= $this->session->userdata('logged_in');
				$data['name'] 				= $session_data['name'];
				$data['user_name'] 			= $session_data['user_name'];
				$data['user_id'] 			= $session_data['user_id'];
				$data['user_status'] 		= $session_data['user_status'];
				$data['datelogin'] 			= $session_data['datelogin'];
				$data['user_type'] 			= $session_data['user_type'];
				$data['role_id'] 			= $session_data['role_id'];
				$data['module']				= $this->users_mdl->getmodule();
				$data['viewmodule']			= $this->users_mdl->viewmodule();
				$data['getdata']			= $this->type_mdl->get();
				$data['getCommissaris']		= $this->view_mdl->getCommissaris($id);
				$data['getDocument']		= $this->view_mdl->getDownload();
				$data['title']       		= 'company';
				$data['master']        		= 'master';

				$this->load->view('default/header', $data);
			  	$this->load->view('backend/documents/download', $data);
			  	$this->load->view('default/footer', $data);

			}else{
				redirect('login', 'refresh');
			}
	}


	public function send_toemail()
	{	
		if($this->session->userdata('logged_in'))
		   	{	
				$session_data   			= $this->session->userdata('logged_in');
				$data['name'] 				= $session_data['name'];
				$data['user_name'] 			= $session_data['user_name'];
				$data['user_id'] 			= $session_data['user_id'];
				$data['user_status'] 		= $session_data['user_status'];
				$data['datelogin'] 			= $session_data['datelogin'];
				$data['user_type'] 			= $session_data['user_type'];
				$data['role_id'] 			= $session_data['role_id'];
				$data['module']				= $this->users_mdl->getmodule();
				$data['viewmodule']			= $this->users_mdl->viewmodule();
				$data['getdata']			= $this->type_mdl->get();
				$data['getCommissaris']		= $this->view_mdl->getCommissaris($id);
				$data['getDocument']		= $this->view_mdl->getDocument($id);
				$data['title']       		= 'company';
				$data['master']        		= 'master';
				$this->load->library('email');

				$id 		= $_GET['ids'];
				$doc_name 	= $_GET['doc_name'];
				$files  	= $_GET['file'];
				$to  		= $_GET['to_email'];
				$desc  		= $_GET['desc'];
				$log 		= $_GET['logs'];
				$this->load->library('user_agent');
				$recipients = explode(" ",$to);

				$users = $session_data['user_id'];

				$sends = $session_data['user_name'];

				$file = 'document/'.$files;

				

				$config = $this->apps->config_set();

				$this->email->initialize($config);
				$this->email->set_newline("\r\n");
				$this->email->from($sends);
				$this->email->to($recipients);

				$subject = $doc_name;

				$this->email->subject($subject);
				$data['judul'] 		= 'Test';
				$data['note'] 		= 'HTML test';
				$this->email->attach($file);
				$this->email->message($desc);

				
				
				if($this->email->send())
				{	
					$this->load->library('user_agent');
					$dt = date("Y-m-d");
					$ids 		= $_GET['ids'];
					$doc_name 	= $_GET['doc_name'];
					$files  	= $_GET['file'];
					$to  		= $_GET['to_email'];
					$desc  		= $_GET['desc'];
					$logs 		= $_GET['logs'];
					$sys        = $session_data['user_id'];
					$browser       = $this->agent->browser();
					$ip         = $this->input->ip_address();
					$platform   = $this->agent->platform();
					$created 	= date('Y-m-d H:i:s');
					
					$this->db->query("INSERT INTO sys_logs (log_date, status_log, log_document_id, log_description, email, user_id, browser, ip, platform, created) 
					values ('".$dt."','".$logs."','".$ids."','".$desc."','".$to."', '".$sys."', '".$browser."', '".$ip."', '".$platform."', '".$created."'); ");


					$this->toastr->success("Successfully");
					redirect($_SERVER['HTTP_REFERER']);
				}
				else
				{
					show_error($this->email->print_debugger());
				}


			}else{
				redirect('login', 'refresh');
			}
	}


	public function send_test()
	{
		if($this->session->userdata('logged_in'))
		   	{
			    $session_data   	 = $this->session->userdata('logged_in');
			    $data['name'] 		 = $session_data['name'];
			    $data['user_id'] 	 = $session_data['user_id'];
			    $data['user_name'] 	 = $session_data['user_name'];
				$data['user_status'] = $session_data['user_status'];
				$data['user_type'] 	 = $session_data['user_type'];
				$data['role_id'] 	 = $session_data['role_id'];
				$data['company_id']  = $session_data['company_id'];
				$data['pic'] 		 = $session_data['pic'];
				$data['module']		 = $this->users_mdl->getmodule();

				$bcc = array('it@pmka.web.id');

				$file = base_url('document/Asuransi_PT__MKA1.zip');

				$this->load->library('email');

				$config = $this->apps->config_set();

				$this->email->initialize($config);
				$this->email->set_newline("\r\n");
				$this->email->from('it@pmka.web.id');
				$this->email->to('beni@pmka.web.id');

				$subject = "Test Email From HRMS MAA Staff ";

				$this->email->subject($subject);
				$data['judul'] 		= 'Test';
				$data['note'] 		= 'HTML test';
				$this->email->attach($file);
				//$message 			= $this->load->view('hrm/transaction/test_mail',$data,TRUE);
				$this->email->message('Oke');

				if($this->email->send())
				{
					$this->toastr->success("Successfully");
					redirect($_SERVER['HTTP_REFERER']);
				}
				else
				{
					show_error($this->email->print_debugger());
				}
		}else{
				redirect('login', 'refresh');
		}

	}


	public function histories($id)
	{
		if($this->session->userdata('logged_in'))
		   	{	
				$session_data   			= $this->session->userdata('logged_in');
				$data['name'] 				= $session_data['name'];
				$data['user_name'] 			= $session_data['user_name'];
				$data['user_id'] 			= $session_data['user_id'];
				$data['user_status'] 		= $session_data['user_status'];
				$data['datelogin'] 			= $session_data['datelogin'];
				$data['user_type'] 			= $session_data['user_type'];
				$data['role_id'] 			= $session_data['role_id'];
				$data['module']				= $this->users_mdl->getmodule();
				$data['viewmodule']			= $this->users_mdl->viewmodule();
				$data['getdata']			= $this->type_mdl->get();
				$data['getCommissaris']		= $this->view_mdl->getCommissaris($id);
				$data['gethistories']		= $this->view_mdl->gethistories($id);
				$data['title']       		= 'company';
				$data['master']        		= 'master';
            
	            $this->load->view('backend/documents/histories', $data);

			}else{
				redirect('login', 'refresh');
			}
	}


	public function excel($id)
	{

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
                                'italic' => (true),
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
                            PHPExcel_Style_Alignment::HORIZONTAL_LEFT
                    )
            );
        /* -----
        *   SET PROPERTY
        --------------*/
            $this->excel->setActiveSheetIndex(0);
            $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
            $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
            $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(40);
            $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(70);
            $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(70);
            $this->excel->getActiveSheet()->freezePane('A4');
            $this->excel->getActiveSheet()->getStyle('D')->getNumberFormat()->setFormatCode('#,##0.00');
            $this->excel->getActiveSheet()->getStyle('E')->getNumberFormat()->setFormatCode('#,##0');
            $this->excel->getActiveSheet()->getStyle('F')->getNumberFormat()->setFormatCode('#,##0');
            $this->excel->getActiveSheet()->getStyle("A")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("B")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("D")->applyFromArray($Center);
            //$this->excel->getActiveSheet()->getStyle("A4")->applyFromArray($InfoStyle);
            $this->excel->getActiveSheet()->getStyle("F4")->applyFromArray($InfoSaldo);
            $this->excel->getActiveSheet()->getStyle("A1:A3")->applyFromArray($HeaderStyle);
        /* -----
        *   HEADER
        --------------*/
            $Row    = 1;
            $Coas   = "EMPTY";
            $Col    = "A";

            $query = $this->view_mdl->gethistories($id);

            foreach ($query as $key => $val) {}
            # -------------
             # -------------
            $this->excel->getActiveSheet()->setTitle('Histories');
            # -------------
            // $this->excel->getActiveSheet()->setCellValue('A' . $Row, $a); $Row++;
            $this->excel->getActiveSheet()->setCellValue('A' . $Row, 'Company : '. $val['company_name'] .''); $Row++;
            $this->excel->getActiveSheet()->setCellValue('A' . $Row, 'Document name : '. $val['document_name'] .''); $Row++;

            $this->excel->getActiveSheet()->getStyle("A".$Row.":Z".$Row)->applyFromArray($TitleStyle);
            $this->excel->getActiveSheet()->getStyle("A".$Row.":Z".$Row)->applyFromArray($Center);
			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Datetime Action'); $Col++;
			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Action'); $Col++;
			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'User'); $Col++;
			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Description'); $Col++;
			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Email'); $Col++; $Row++;

            $query = $this->view_mdl->gethistories($id);

            foreach ($query as $key => $value) {
            	
            	$Col            = "A";
                $Start          = "G" . $Row;
                $Start2         = "K" . $Row;
                
                $this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['created']); $Col++;

                if($value['status_log'] == 1){
                	$this->excel->getActiveSheet()->setCellValue($Col . $Row, "Preview"); $Col++;
                }

                if($value['status_log'] == 2){
                	$this->excel->getActiveSheet()->setCellValue($Col . $Row, "Download"); $Col++;
                }

                if($value['status_log'] == 3){
                	$this->excel->getActiveSheet()->setCellValue($Col . $Row, "Send Email"); $Col++;
                }


                
                $this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['name']); $Col++;
                $this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['log_description']); $Col++;
                if($value['status_log'] != 3){
                $this->excel->getActiveSheet()->setCellValue($Col . $Row, "NULL"); $Col++;
                } else {
                $this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['email']); $Col++; 
                }
                $Row++;
                
                # -------------
	            
	        }
        
            # -------------
            $this->excel->setActiveSheetIndex(0);
            # -------------
            $filename   = 'Histories.xls';
            # -------------
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'.$filename.'"');
            header('Cache-Control: max-age=0');
            # -------------            
            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
            # -------------
            $objWriter->save('php://output');
	}

	public function status_report($id = NULL)
	{	
		if($this->session->userdata('logged_in'))
		   	{	
		   		$id 						= $_GET['pages'];
				$session_data   			= $this->session->userdata('logged_in');
				$data['name'] 				= $session_data['name'];
				$data['user_name'] 			= $session_data['user_name'];
				$data['user_id'] 			= $session_data['user_id'];
				$data['user_status'] 		= $session_data['user_status'];
				$data['datelogin'] 			= $session_data['datelogin'];
				$data['user_type'] 			= $session_data['user_type'];
				$data['role_id'] 			= $session_data['role_id'];
				$data['module']				= $this->users_mdl->getmodule();
				$data['viewmodule']			= $this->users_mdl->viewmodule();
				$data['getdata']			= $this->type_mdl->get();
				$data['getCommissaris']		= $this->view_mdl->getCommissaris($id);
				$data['getDocument']		= $this->view_mdl->getDocument($id);
				$data['getRules']			= $this->view_mdl->getRules();
				$data['title']       		= 'company';
				$data['master']        		= 'master';

				$this->load->view('default/header', $data);
			  	$this->load->view('backend/documents/document_expired', $data);
			  	$this->load->view('default/footer', $data);
			}else{
				redirect('login', 'refresh');
			}
	}



	public function activities_report($id = NULL)
	{	
		if($this->session->userdata('logged_in'))
		   	{	
		   		$id 						= $_GET['pages'];
				$session_data   			= $this->session->userdata('logged_in');
				$data['name'] 				= $session_data['name'];
				$data['user_name'] 			= $session_data['user_name'];
				$data['user_id'] 			= $session_data['user_id'];
				$data['user_status'] 		= $session_data['user_status'];
				$data['datelogin'] 			= $session_data['datelogin'];
				$data['user_type'] 			= $session_data['user_type'];
				$data['role_id'] 			= $session_data['role_id'];
				$data['module']				= $this->users_mdl->getmodule();
				$data['viewmodule']			= $this->users_mdl->viewmodule();
				$data['getdata']			= $this->type_mdl->get();
				$data['getCommissaris']		= $this->view_mdl->getCommissaris($id);
				$data['getDocument']		= $this->view_mdl->getDocument($id);
				$data['getRules']			= $this->view_mdl->getRules();
				$data['title']       		= 'company';
				$data['master']        		= 'master';

				$this->load->view('default/header', $data);
			  	$this->load->view('backend/documents/document_report', $data);
			  	$this->load->view('default/footer', $data);
			}else{
				redirect('login', 'refresh');
			}
	}


	public function report1()
	{
		if($this->session->userdata('logged_in'))
		   	{	
				$date1    = date('Y-m-d' , strtotime($_GET['date1']));
                $date2    = date('Y-m-d' , strtotime($_GET['date2']));

				$session_data   			= $this->session->userdata('logged_in');
				$data['name'] 				= $session_data['name'];
				$data['user_name'] 			= $session_data['user_name'];
				$data['user_id'] 			= $session_data['user_id'];
				$data['user_status'] 		= $session_data['user_status'];
				$data['datelogin'] 			= $session_data['datelogin'];
				$data['user_type'] 			= $session_data['user_type'];
				$data['role_id'] 			= $session_data['role_id'];
				$data['module']				= $this->users_mdl->getmodule();
				$data['viewmodule']			= $this->users_mdl->viewmodule();
				$data['getdata']			= $this->type_mdl->get();
				$data['getCommissaris']		= $this->view_mdl->getCommissaris($id);
				$data['getDocument']		= $this->view_mdl->getDocument($id);
				$data['getRules']			= $this->view_mdl->getRules();
				$data['getReport']			= $this->view_mdl->getReport1($date1,$date2);
				$data['title']       		= 'company';
				$data['master']        		= 'master';
				$data['date1']				= date('d-m-Y' , strtotime($_GET['date1']));
				$data['date2']				= date('d-m-Y' , strtotime($_GET['date2']));

			  	$this->load->view('backend/documents/html_report1', $data);

			}else{
				redirect('login', 'refresh');
			}
	}


	public function reportExcel1($id)
	{
		$date1    = date('Y-m-d' , strtotime($_GET['date1']));
		$date2    = date('Y-m-d' , strtotime($_GET['date2']));
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
                                'italic' => (true),
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
                            PHPExcel_Style_Alignment::HORIZONTAL_LEFT
                    )
            );
        /* -----
        *   SET PROPERTY
        --------------*/
            $this->excel->setActiveSheetIndex(0);
            $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
            $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(40);
            $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(40);
            $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(45);
            $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
			$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
			$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
			$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
            $this->excel->getActiveSheet()->freezePane('A4');
            $this->excel->getActiveSheet()->getStyle('D')->getNumberFormat()->setFormatCode('#,##0.00');
            $this->excel->getActiveSheet()->getStyle('E')->getNumberFormat()->setFormatCode('#,##0');
            $this->excel->getActiveSheet()->getStyle('F')->getNumberFormat()->setFormatCode('#,##0');
            $this->excel->getActiveSheet()->getStyle("A")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("B")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("D")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("A1:A3")->applyFromArray($HeaderStyle);
        /* -----
        *   HEADER
        --------------*/
            $Row    = 1;
            $Coas   = "EMPTY";
            $Col    = "A";

            $query = $this->view_mdl->getReport1($date1,$date2);

            foreach ($query as $key => $val) {}

			$dates1    = date('d-m-Y' , strtotime($_GET['date1']));
			$dates2    = date('d-m-Y' , strtotime($_GET['date2']));
            # -------------
             # -------------
            $this->excel->getActiveSheet()->setTitle('Document Report');
            # -------------
            // $this->excel->getActiveSheet()->setCellValue('A' . $Row, $a); $Row++;
            $this->excel->getActiveSheet()->setCellValue('A' . $Row, 'Document Report'); $Row++;
            $this->excel->getActiveSheet()->setCellValue('A' . $Row, 'Date : '. $dates1 .'  to    '. $dates2 .''); $Row++;

            $this->excel->getActiveSheet()->getStyle("A".$Row.":Z".$Row)->applyFromArray($TitleStyle);
            $this->excel->getActiveSheet()->getStyle("A".$Row.":Z".$Row)->applyFromArray($Center);
			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Document Name'); $Col++;
			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Company'); $Col++;
			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Users'); $Col++;
			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Description'); $Col++;
			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Action'); $Col++;
			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Email'); $Col++;
			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Document Size (KB)'); $Col++;
			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Action date'); $Col++; $Row++;
			

            $query = $this->view_mdl->getReport1($date1,$date2);

            foreach ($query as $key => $value) {
            	
            	$Col            = "A";
                $Start          = "G" . $Row;
                $Start2         = "K" . $Row;
          

                $this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['document_name']); $Col++;
                $this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['company_name']); $Col++;
				$this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['name']); $Col++;
				$this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['log_description']); $Col++;
				if($value['status_log'] == 1){
					$this->excel->getActiveSheet()->setCellValue($Col . $Row, "Preview"); $Col++;
				}
				
				if($value['status_log'] == 2){
					$this->excel->getActiveSheet()->setCellValue($Col . $Row, "Download"); $Col++;
				}
				
				if($value['status_log'] == 3){
					$this->excel->getActiveSheet()->setCellValue($Col . $Row, "Send Email"); $Col++;
				}

				if($value['status_log'] != 3){
				$this->excel->getActiveSheet()->setCellValue($Col . $Row, "NULL"); $Col++;
				} else {
				$this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['email']); $Col++; 
				}
				
				$this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['document_size']); $Col++;
				$this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['created']); $Col++;
                $Row++;
                
                # -------------
	            
	        }
        
            # -------------
            $this->excel->setActiveSheetIndex(0);
            # -------------
            $filename   = 'Document Report.xls';
            # -------------
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'.$filename.'"');
            header('Cache-Control: max-age=0');
            # -------------            
            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
            # -------------
            $objWriter->save('php://output');
	}



	public function report2()
	{
		if($this->session->userdata('logged_in'))
		   	{	
				$date1    = date('Y-m-d' , strtotime($_GET['date1']));
                $date2    = date('Y-m-d' , strtotime($_GET['date2']));
				$exp      = $_GET['exp'];

				if($exp == 1){
					$data['exps'] = "Report Document Active";
				} 

				if($exp == 2){
					$data['exps'] = "Report Document Inactive";
				} 

				if($exp == 3){
					$data['exps'] = "Report Document Expired";
				} 

				if($exp == 4){
					$data['exps'] = "Report Document Will Expired";
				} 

				$session_data   			= $this->session->userdata('logged_in');
				$data['name'] 				= $session_data['name'];
				$data['user_name'] 			= $session_data['user_name'];
				$data['user_id'] 			= $session_data['user_id'];
				$data['user_status'] 		= $session_data['user_status'];
				$data['datelogin'] 			= $session_data['datelogin'];
				$data['user_type'] 			= $session_data['user_type'];
				$data['role_id'] 			= $session_data['role_id'];
				$data['module']				= $this->users_mdl->getmodule();
				$data['viewmodule']			= $this->users_mdl->viewmodule();
				$data['getdata']			= $this->type_mdl->get();
				$data['getCommissaris']		= $this->view_mdl->getCommissaris($id);
				$data['getDocument']		= $this->view_mdl->getDocument($id);
				$data['getRules']			= $this->view_mdl->getRules();
				$data['getReport']			= $this->view_mdl->getReport2($date1,$date2,$exp);
				$data['title']       		= 'company';
				$data['master']        		= 'master';
				$data['date1']				= date('d-m-Y' , strtotime($_GET['date1']));
				$data['date2']				= date('d-m-Y' , strtotime($_GET['date2']));

			  	$this->load->view('backend/documents/html_report2', $data);

			}else{
				redirect('login', 'refresh');
			}
	}


	public function reportExcel2()
	{
		$date1    = date('Y-m-d' , strtotime($_GET['date1']));
		$date2    = date('Y-m-d' , strtotime($_GET['date2']));
		$exp      = $_GET['exp'];

		if($exp == 1){
			$exps = "Report Document Active";
		} 

		if($exp == 2){
			$exps = "Report Document Inactive";
		} 

		if($exp == 3){
			$exps = "Report Document Expired";
		} 

		if($exp == 4){
			$exps = "Report Document Will Expired";
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
                                'italic' => (true),
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
                            PHPExcel_Style_Alignment::HORIZONTAL_LEFT
                    )
            );
        /* -----
        *   SET PROPERTY
        --------------*/
            $this->excel->setActiveSheetIndex(0);
            $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
            $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
            $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(40);
            $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
            $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
			$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
            $this->excel->getActiveSheet()->freezePane('A4');
            $this->excel->getActiveSheet()->getStyle('D')->getNumberFormat()->setFormatCode('#,##0.00');
            $this->excel->getActiveSheet()->getStyle('E')->getNumberFormat()->setFormatCode('#,##0');
            $this->excel->getActiveSheet()->getStyle('F')->getNumberFormat()->setFormatCode('#,##0');
            $this->excel->getActiveSheet()->getStyle("A")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("B")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("D")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("A1:A3")->applyFromArray($HeaderStyle);
        /* -----
        *   HEADER
        --------------*/
            $Row    = 1;
            $Coas   = "EMPTY";
            $Col    = "A";

            $query = $this->view_mdl->getReport2($date1,$date2,$exp);

            foreach ($query as $key => $val) {}

			$dates1    = date('d-m-Y' , strtotime($_GET['date1']));
			$dates2    = date('d-m-Y' , strtotime($_GET['date2']));
            # -------------
             # -------------
            $this->excel->getActiveSheet()->setTitle('Document Report');
            $this->excel->getActiveSheet()->setCellValue('A' . $Row, ''. $exps .''); $Row++;
			$this->excel->getActiveSheet()->setCellValue('A' . $Row, 'Date : '. $dates1 .'  to    '. $dates2 .''); $Row++;

            $this->excel->getActiveSheet()->getStyle("A".$Row.":Z".$Row)->applyFromArray($TitleStyle);
            $this->excel->getActiveSheet()->getStyle("A".$Row.":Z".$Row)->applyFromArray($Center);
			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'No'); $Col++;
			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Document name'); $Col++;
			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Company'); $Col++;
			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Date'); $Col++;
			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Expired'); $Col++;
			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Document Size (KB)'); $Col++; $Row++;

            $query = $this->view_mdl->getReport2($date1,$date2,$exp);
			$No = 0;
            foreach ($query as $key => $value) {
			$No++;
            	
            	$Col            = "A";
                $Start          = "G" . $Row;
                $Start2         = "K" . $Row;
				$this->excel->getActiveSheet()->setCellValue($Col . $Row, $No); $Col++;
				$this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['document_name']); $Col++;
                $this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['company_name']); $Col++;
				$this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['document_date']); $Col++;
				$this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['document_ex']); $Col++;
				$this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['document_size']); $Col++;
                $Row++;
                
                # -------------
	            
	        }
        
            # -------------
            $this->excel->setActiveSheetIndex(0);
            # -------------
            $filename   = $exps.'.xls';
            # -------------
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'.$filename.'"');
            header('Cache-Control: max-age=0');
            # -------------            
            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
            # -------------
            $objWriter->save('php://output');
	}



	public function presentage_report($id = NULL)
	{	
		if($this->session->userdata('logged_in'))
		   	{	
		   		$id 						= $_GET['pages'];
				$session_data   			= $this->session->userdata('logged_in');
				$data['name'] 				= $session_data['name'];
				$data['user_name'] 			= $session_data['user_name'];
				$data['user_id'] 			= $session_data['user_id'];
				$data['user_status'] 		= $session_data['user_status'];
				$data['datelogin'] 			= $session_data['datelogin'];
				$data['user_type'] 			= $session_data['user_type'];
				$data['role_id'] 			= $session_data['role_id'];
				$data['module']				= $this->users_mdl->getmodule();
				$data['viewmodule']			= $this->users_mdl->viewmodule();
				$data['getdata']			= $this->type_mdl->get();
				$data['getCommissaris']		= $this->view_mdl->getCommissaris($id);
				$data['getDocument']		= $this->view_mdl->getDocument($id);
				$data['getRules']			= $this->view_mdl->getRules();
				$data['title']       		= 'company';
				$data['master']        		= 'master';

				$this->load->view('default/header', $data);
			  	$this->load->view('backend/documents/presentage_report', $data);
			  	$this->load->view('default/footer', $data);
			}else{
				redirect('login', 'refresh');
			}
	}


	public function presentage_rpt()
	{
		if($this->session->userdata('logged_in'))
		   	{	
				$date1    = date('Y-m-d' , strtotime($_GET['date1']));
                $date2    = date('Y-m-d' , strtotime($_GET['date2']));

				$session_data   			= $this->session->userdata('logged_in');
				$data['name'] 				= $session_data['name'];
				$data['user_name'] 			= $session_data['user_name'];
				$data['user_id'] 			= $session_data['user_id'];
				$data['user_status'] 		= $session_data['user_status'];
				$data['datelogin'] 			= $session_data['datelogin'];
				$data['user_type'] 			= $session_data['user_type'];
				$data['role_id'] 			= $session_data['role_id'];
				$data['getReport']			= $this->view_mdl->getPresentageReport($date1,$date2);
				$data['title']       		= 'Report Presentage of Shareholders';
				$data['master']        		= 'master';
				$data['date1']				= date('d-m-Y' , strtotime($_GET['date1']));
				$data['date2']				= date('d-m-Y' , strtotime($_GET['date2']));

			  	$this->load->view('backend/documents/presentage_rpt', $data);

			}else{
				redirect('login', 'refresh');
			}
	}


	public function presentage_excel()
	{
		$date1    = date('Y-m-d' , strtotime($_GET['date1']));
		$date2    = date('Y-m-d' , strtotime($_GET['date2']));
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
                                'italic' => (true),
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
                            PHPExcel_Style_Alignment::HORIZONTAL_LEFT
                    )
            );
        /* -----
        *   SET PROPERTY
        --------------*/
            $this->excel->setActiveSheetIndex(0);
            $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
            $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(40);
            $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
            $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(60);
            $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
			$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
            $this->excel->getActiveSheet()->freezePane('A4');
            $this->excel->getActiveSheet()->getStyle('F')->getNumberFormat()->setFormatCode('#,##0');
            $this->excel->getActiveSheet()->getStyle("A")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("B")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("D")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("F")->applyFromArray($InfoSaldo);
            $this->excel->getActiveSheet()->getStyle("A1:A3")->applyFromArray($HeaderStyle);
        /* -----
        *   HEADER
        --------------*/
            $Row    = 1;
            $Coas   = "EMPTY";
            $Col    = "A";

            $query = $this->view_mdl->getPresentageReport($date1,$date2);
            $title = "Presentage of Shareholders";
            foreach ($query as $key => $val) {}

			$dates1    = date('d-m-Y' , strtotime($_GET['date1']));
			$dates2    = date('d-m-Y' , strtotime($_GET['date2']));
            # -------------
             # -------------

            $this->excel->getActiveSheet()->setTitle('Presentage of Shareholders');
            $this->excel->getActiveSheet()->setCellValue('A' . $Row, ''. $title .''); $Row++;
			$this->excel->getActiveSheet()->setCellValue('A' . $Row, 'Date : '. $dates1 .'  to    '. $dates2 .''); $Row++;

            $this->excel->getActiveSheet()->getStyle("A".$Row.":Z".$Row)->applyFromArray($TitleStyle);
            $this->excel->getActiveSheet()->getStyle("A".$Row.":Z".$Row)->applyFromArray($Center);
			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'No'); $Col++;
			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Name'); $Col++;
			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Date'); $Col++;
			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Company'); $Col++;
			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Status'); $Col++;
			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Values %'); $Col++; $Row++;


            $query = $this->view_mdl->getPresentageReport($date1,$date2);
			$No = 0;
            foreach ($query as $key => $value) {
			$No++;
            	
            	$Col            = "A";
                $Start          = "G" . $Row;
                $Start2         = "K" . $Row;
				$this->excel->getActiveSheet()->setCellValue($Col . $Row, $No); $Col++;
				$this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['commissaris_name']); $Col++;
                $this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['commissaris_year']); $Col++;
				$this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['company_name']); $Col++;
				$this->excel->getActiveSheet()->setCellValue($Col . $Row, ""); $Col++;
				$this->excel->getActiveSheet()->setCellValue($Col . $Row, number_format($value['presentage'],2)); $Col++;
                $Row++;
                
                # -------------
	            
	        }
        
            # -------------
            $this->excel->setActiveSheetIndex(0);
            # -------------
            # -------------
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Percentage Of Shareholders.xls"');
            header('Cache-Control: max-age=0');
            # -------------            
            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
            # -------------
            $objWriter->save('php://output');
	}



	public function directors_report($id = NULL)
	{	
		if($this->session->userdata('logged_in'))
		   	{	
		   		$id 						= $_GET['pages'];
				$session_data   			= $this->session->userdata('logged_in');
				$data['name'] 				= $session_data['name'];
				$data['user_name'] 			= $session_data['user_name'];
				$data['user_id'] 			= $session_data['user_id'];
				$data['user_status'] 		= $session_data['user_status'];
				$data['datelogin'] 			= $session_data['datelogin'];
				$data['user_type'] 			= $session_data['user_type'];
				$data['role_id'] 			= $session_data['role_id'];
				$data['module']				= $this->users_mdl->getmodule();
				$data['viewmodule']			= $this->users_mdl->viewmodule();
				$data['getdata']			= $this->type_mdl->get();
				$data['getCommissaris']		= $this->view_mdl->getCommissaris($id);
				$data['getDocument']		= $this->view_mdl->getDocument($id);
				$data['getRules']			= $this->view_mdl->getRules();
				$data['title']       		= 'company';
				$data['master']        		= 'master';

				$this->load->view('default/header', $data);
			  	$this->load->view('backend/documents/directors_report', $data);
			  	$this->load->view('default/footer', $data);
			}else{
				redirect('login', 'refresh');
			}
	}


	public function directors_rpt()
	{
		if($this->session->userdata('logged_in'))
		   	{	
				$date1    = date('Y-m-d' , strtotime($_GET['date1']));
                $date2    = date('Y-m-d' , strtotime($_GET['date2']));

				$session_data   			= $this->session->userdata('logged_in');
				$data['name'] 				= $session_data['name'];
				$data['user_name'] 			= $session_data['user_name'];
				$data['user_id'] 			= $session_data['user_id'];
				$data['user_status'] 		= $session_data['user_status'];
				$data['datelogin'] 			= $session_data['datelogin'];
				$data['user_type'] 			= $session_data['user_type'];
				$data['role_id'] 			= $session_data['role_id'];
				$data['getReport']			= $this->view_mdl->getDirectorsReport($date1,$date2);
				$data['title']       		= 'Report Directors & Commissaris';
				$data['date1']				= date('d-m-Y' , strtotime($_GET['date1']));
				$data['date2']				= date('d-m-Y' , strtotime($_GET['date2']));

			  	$this->load->view('backend/documents/directors_rpt', $data);

			}else{
				redirect('login', 'refresh');
			}
	}



	public function directors_excel()
	{
		$date1    = date('Y-m-d' , strtotime($_GET['date1']));
		$date2    = date('Y-m-d' , strtotime($_GET['date2']));
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
                                'italic' => (true),
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
                            PHPExcel_Style_Alignment::HORIZONTAL_LEFT
                    )
            );
        /* -----
        *   SET PROPERTY
        --------------*/
            $this->excel->setActiveSheetIndex(0);
            $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
            $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(40);
            $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
            $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(60);
            $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
			$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
            $this->excel->getActiveSheet()->freezePane('A4');
            $this->excel->getActiveSheet()->getStyle('F')->getNumberFormat()->setFormatCode('#,##0');
            $this->excel->getActiveSheet()->getStyle("A")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("B")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("D")->applyFromArray($Center);
            $this->excel->getActiveSheet()->getStyle("F")->applyFromArray($InfoSaldo);
            $this->excel->getActiveSheet()->getStyle("A1:A3")->applyFromArray($HeaderStyle);
        /* -----
        *   HEADER
        --------------*/
            $Row    = 1;
            $Coas   = "EMPTY";
            $Col    = "A";

            $query = $this->view_mdl->getPresentageReport($date1,$date2);
            $title = "Directors & Commissaris";
            foreach ($query as $key => $val) {}

			$dates1    = date('d-m-Y' , strtotime($_GET['date1']));
			$dates2    = date('d-m-Y' , strtotime($_GET['date2']));
            # -------------
             # -------------

            $this->excel->getActiveSheet()->setTitle('Directors & Commissaris');
            $this->excel->getActiveSheet()->setCellValue('A' . $Row, ''. $title .''); $Row++;
			$this->excel->getActiveSheet()->setCellValue('A' . $Row, 'Date : '. $dates1 .'  to    '. $dates2 .''); $Row++;

            $this->excel->getActiveSheet()->getStyle("A".$Row.":Z".$Row)->applyFromArray($TitleStyle);
            $this->excel->getActiveSheet()->getStyle("A".$Row.":Z".$Row)->applyFromArray($Center);
			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'No'); $Col++;
			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Name'); $Col++;
			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Date'); $Col++;
			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Company'); $Col++;
			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Status'); $Col++; $Row++;


            $query = $this->view_mdl->getPresentageReport($date1,$date2);
			$No = 0;
            foreach ($query as $key => $value) {
			$No++;
            	
            	$Col            = "A";
                $Start          = "G" . $Row;
                $Start2         = "K" . $Row;
				$this->excel->getActiveSheet()->setCellValue($Col . $Row, $No); $Col++;
				$this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['commissaris_name']); $Col++;
                $this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['commissaris_year']); $Col++;
				$this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['company_name']); $Col++;
				$this->excel->getActiveSheet()->setCellValue($Col . $Row, ""); $Col++;
                $Row++;
                
                # -------------
	            
	        }
        
            # -------------
            $this->excel->setActiveSheetIndex(0);
            # -------------
            # -------------
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Directors & Commissaris.xls"');
            header('Cache-Control: max-age=0');
            # -------------            
            $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
            # -------------
            $objWriter->save('php://output');
	}
}
