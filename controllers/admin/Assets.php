<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assets extends CI_Controller {

	public function __construct()
 	{
   		parent::__construct();
			$this->load->helper(array('form', 'url', 'inflector','file'));
			$this->load->library(array('session','form_validation','upload','toastr','apps'));
			$this->load->model(array('users_mdl','company_mdl','msg_mdl','announcements_mdl','assets_mdl'));
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
				$data['title']       		= 'Announcements';
				$data['master']        		= 'master';
				$data['pic'] 				= $session_data['pic'];
				$id 						= $this->uri->segment(2);
				$data['getdata']			= $this->assets_mdl->GetData();
				$data['actions']			= $this->assets_mdl->actions();

				$userInfo = $this->users_mdl->user_info($id); 

		        if($userInfo=="")
		        {   
		            $this->load->view('backend/notfound', $data);
		        } else { 
		            $this->load->view('default/header', $data);
				  	$this->load->view('backend/assets/index', $data);
				  	$this->load->view('default/footer', $data);
		        }

				
			}else{
				redirect('login', 'refresh');
			}
	}



	public function add()
	{
		if($this->session->userdata('logged_in'))
		   	{
				$session_data   			= $this->session->userdata('logged_in');
				$data['name'] 				= $session_data['name'];
				$data['user_name'] 			= $session_data['user_name'];
				$data['user_status'] 		= $session_data['user_status'];
				$data['datelogin'] 			= $session_data['datelogin'];
				$data['company_code'] 		= $session_data['company_code'];
				$data['user_type'] 			= $session_data['user_type'];
				$data['role_id'] 			= $session_data['role_id'];
				$data['user_id'] 			= $session_data['user_id'];
				$data['pic'] 				= $session_data['pic'];
				$id 						= $this->uri->segment(3);
				$data['auto']				= $this->assets_mdl->auto();
				$data['getdata']			= $this->announcements_mdl->GetData();
				$data['actions']			= $this->announcements_mdl->actions();
				$data['title']       		= 'Add assets';
				$data['master']        		= 'master';

				$userInfo = $this->users_mdl->user_info($id); 

		        if($userInfo=="")
		        {   
		            $this->load->view('backend/notfound', $data);
		        } else { 
		            $this->load->view('default/header', $data);
				  	$this->load->view('backend/assets/add', $data);
				  	$this->load->view('default/footer', $data);
		        }
			}else{
				redirect('login', 'refresh');
			}
	}

	
	public function edit($numbers)
	{
		if($this->session->userdata('logged_in'))
		   	{
			    $session_data   			= $this->session->userdata('logged_in');
				$data['name'] 				= $session_data['name'];
				$data['user_name'] 			= $session_data['user_name'];
				$data['user_status'] 		= $session_data['user_status'];
				$data['datelogin'] 			= $session_data['datelogin'];
				$data['company_code'] 		= $session_data['company_code'];
				$data['user_type'] 			= $session_data['user_type'];
				$data['role_id'] 			= $session_data['role_id'];
				$data['user_id'] 			= $session_data['user_id'];
				$data['pic'] 				= $session_data['pic'];
				$id 						= $this->uri->segment(3);
				$data['auto']				= $this->assets_mdl->auto();
				$data['getdata']			= $this->assets_mdl->GetData($numbers);
				$data['actions']			= $this->assets_mdl->actions();
				$data['title']       		= 'Edit assets';
				$data['master']        		= 'master';
				
				$userInfo = $this->users_mdl->user_info($id); 

		        if($userInfo=="")
		        {   
		            $this->load->view('backend/notfound', $data);
		        } else { 
		            $this->load->view('default/header', $data);
				  	$this->load->view('backend/assets/edit', $data);
				  	$this->load->view('default/footer', $data);
		        }
			}else{
				redirect('login', 'refresh');
			}
			
	}


  	public function save()
	{ 
		if($this->session->userdata('logged_in'))
		   	{
				$session_data   		= $this->session->userdata('logged_in');
			    $data['name'] 			= $session_data['name'];
			    $data['user_name'] 	    = $session_data['user_name'];
				$data['user_status']    = $session_data['user_status'];
				$data['user_type'] 	    = $session_data['user_type'];

				if($this->input->post('ids') == 1){

					$item=array(
			      		'item_code'       => $this->input->post('item_code'),
			      		'item_name'       => $this->input->post('item_name'),
			      		'company_code'    => $this->input->post('company_code'),
			      		'date_buy'        => $this->input->post('date_buy')
			        );

					$this->assets_mdl->save($item);

					$this->load->library('user_agent');
					$logs   = array (
						"log_date"=>date("Y-m-d"),
						"log_description"=>"add assets (".$this->input->post('item_name').")",
						"user_id"=> $session_data['user_id'],
						"browser" => $this->agent->browser(),
						"ip" =>  $this->input->ip_address(),
						"platform" => $this->agent->platform(),
						"created"=>date("Y-m-d H:i:s"),
						"modified"=>date("Y-m-d H:i:s")
						);
					# -------------------------
					$this->db->insert("sys_logs", $logs);

					
					$this->session->set_flashdata('msg', 'data has been save');
					redirect('admin/assets');

				}else {

					$data = array (
							'item_code'       => $this->input->post('item_code'),
							'item_name'       => $this->input->post('item_name'),
							'company_code'    => $this->input->post('company_code'),
							'date_buy'        => $this->input->post('date_buy')
						);

					$primary = array (
						'item_code'			  => $this->input->post('item_code')
					);

				$this->assets_mdl->update($data,$primary);

					$this->load->library('user_agent');
					$logs   = array (
						"log_date"=>date("Y-m-d"),
						"log_description"=>"edit assets (".$this->input->post('item_name').")",
						"user_id"=> $session_data['user_id'],
						"browser" => $this->agent->browser(),
						"ip" =>  $this->input->ip_address(),
						"platform" => $this->agent->platform(),
						"created"=>date("Y-m-d H:i:s"),
						"modified"=>date("Y-m-d H:i:s")
						);
					# -------------------------
					$this->db->insert("sys_logs", $logs);

					$this->session->set_flashdata('msg', 'data has been edit');
					redirect('admin/assets');

				}
				
			}else{
				redirect('login', 'refresh');
			}
	}


	public function delete()
	{ 
		if($this->session->userdata('logged_in'))
		   	{
				$session_data   		= $this->session->userdata('logged_in');
			    $data['name'] 			= $session_data['name'];
			    $data['user_name'] 	    = $session_data['user_name'];
				$data['user_status']    = $session_data['user_status'];
				$data['user_type'] 	    = $session_data['user_type'];

				$id 						= $this->uri->segment(3);
				$params 					= $this->uri->segment(4); 

				$userInfo = $this->users_mdl->user_info($id); 

		        if($userInfo=="")
		        {   
		            $this->load->view('backend/notfound', $data);
		        } else { 

		        	$this->db->query("DELETE FROM mod_master_assets WHERE id ='".$params."'");
		            $this->session->set_flashdata('msg', 'data has been delete');
					redirect('admin/assets');
		        }
				
			}else{
				redirect('login', 'refresh');
			}
	}


	public function report()
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
				$data['title']       = 'Assets Report';

		    	$this->load->view('default/header', $data);
			  	$this->load->view('backend/assets/report', $data);
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
	            $data['title']    		= 'Assets Report';
				$usertype 				= $session_data['user_id'];
				$date1 					= date('Y-m-d' , strtotime($_GET['date1']));
				$date2 					= date('Y-m-d' , strtotime($_GET['date2']));
				$company_code 			= $_GET['company_code'];

				$data['report'] 		= $this->assets_mdl->report($date1, $date2, $company_code);
		    	$this->load->view('backend/assets/rpt', $data);
			}else{
				redirect('login', 'refresh');
		}
	}


	public function excel()
	{
		$date1 = date('Y-m-d' , strtotime($_GET['date1']));
		$date2 = date('Y-m-d' , strtotime($_GET['date2']));
		$company_code = $_GET['company_code'];

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
            $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
            $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
            $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
            $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
            $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
            $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(40);
            $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(40);
            $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
            $this->excel->getActiveSheet()->freezePane('A5');
            $this->excel->getActiveSheet()->getStyle("A")->applyFromArray($Left);
            $this->excel->getActiveSheet()->getStyle("B")->applyFromArray($Left);
			$this->excel->getActiveSheet()->getStyle("D")->applyFromArray($Left);
			$this->excel->getActiveSheet()->getStyle("E")->applyFromArray($Left);
			$this->excel->getActiveSheet()->getStyle("F")->applyFromArray($Left);
			$this->excel->getActiveSheet()->getStyle("G")->applyFromArray($Left);
            $this->excel->getActiveSheet()->getStyle("H")->applyFromArray($Left);
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
            $this->excel->getActiveSheet()->setTitle('Assets Report');
            # -------------
            $this->excel->getActiveSheet()->setCellValue('A' . $Row, $a); $Row++;
            $this->excel->getActiveSheet()->setCellValue('A' . $Row, 'Assets Report'); $Row++;
            $this->excel->getActiveSheet()->setCellValue('A' . $Row, 'PERIODE : ' . ''. $date1 .''  . " - " . ''. $date2 .''); $Row++;

            $this->excel->getActiveSheet()->getStyle("A".$Row.":Z".$Row)->applyFromArray($TitleStyle);
            $this->excel->getActiveSheet()->getStyle("A".$Row.":Z".$Row)->applyFromArray($Center);
			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Employee Code'); $Col++;
			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Name'); $Col++;
			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Company'); $Col++;
			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Department'); $Col++;
			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Position'); $Col++;
            $this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Assets Code'); $Col++;
			$this->excel->getActiveSheet()->setCellValue($Col . $Row, 'Assets Name'); $Col++;$Row++;

            $query = $this->assets_mdl->report($date1, $date2, $company_code);

            foreach ($query as $key => $value) {

            	$Col            = "A";
                $Start          = "G" . $Row;
                $Start2         = "K" . $Row;

                $this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['employee_code']); $Col++;
				$this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['employee_name']); $Col++;
				$this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['company_name']); $Col++;
                $this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['department_name']); $Col++;
				$this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['position_name']); $Col++;
                $this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['item_code']); $Col++;
				$this->excel->getActiveSheet()->setCellValue($Col . $Row, $value['item_name']); $Col++;$Row++;
                # -------------

	        }


	        

            # -------------
            $this->excel->setActiveSheetIndex(0);
            # -------------
            $filename   = 'assets_report.xls';
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
