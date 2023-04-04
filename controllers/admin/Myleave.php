<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Myleave extends CI_Controller {

	public function __construct()
 	{
   		parent::__construct();
			$this->load->helper(array('form', 'url', 'inflector'));
			$this->load->library(array('session','form_validation','upload','toastr','pdf','apps'));
			$this->load->model(array('users_mdl','location_mdl','msg_mdl','myleave_mdl'));
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
				$data['employee_code'] 		= $session_data['employee_code'];
				$data['title']       		= 'My Leave';
				$data['master']        		= 'transactions';
				$data['pic'] 				= $session_data['pic'];
				$id 						= $this->uri->segment(2);
				$data['getdata']			= $this->myleave_mdl->getdata();
				$data['auto']				= $this->myleave_mdl->auto();
				$data['getcuti']			= $this->myleave_mdl->getcuti();
				
		        $this->load->view('default/header', $data);
			  	$this->load->view('backend/myleave/index', $data);
			  	$this->load->view('default/footer', $data);

			}else{
				redirect('login', 'refresh');
			}
	}


	public function save()
	{
		if($this->session->userdata('logged_in'))
		   	{
				$session_data   			= $this->session->userdata('logged_in');

				if($this->input->post('ids') == 1){

					$cek = $this->db->query("SELECT * 
										FROM mod_type_cuty 
										WHERE type_cuty_id ='".$this->input->post('type_cuty_id')."'")->row();
		
					$jml = $cek->type_cuty_jml; 

					/*  extrak tanggal cuti dari start ke end */

					$date1 		 = date_create($this->input->post('date_start'));
					$date_start1 = date_format($date1, "d-m-Y");
					$date2 		 = date_create($this->input->post('date_end'));
					$date_start2 = date_format($date2, "d-m-Y");
					$jml_cuti    = $this->logic($date_start1, $date_start2,"-");

					/*
						cek jika jumlah cuti yang diinput melebihi jumlah cuti ketentuan perusahaan
					*/

					if($jml_cuti > $jml){
						$this->apps->set_notification(2, "Jumlah cuti yang anda pilih melebihi jumlah cuti yang di sediakan perusahaan");
						redirect($_SERVER['HTTP_REFERER']);
					} 


					/*
						cek jika saldo cuti kurang dari jumlah yang diinput
					*/

					$balance = $this->input->post('balance'); 
					if($balance < $jml_cuti){
						$this->apps->set_notification(2, "Jumlah cuti yang anda pilih melebihi saldo cuti anda, sisa saldo anda adalah ".$balance." hari");
						redirect($_SERVER['HTTP_REFERER']);
					}


					/* 
						cek jika tanggal yang diinput sudah pernah melakukan cuti dan statusnya approved
					*/


					$sql = $this->db->query("SELECT count(*) as sql_jml
										FROM mod_annual_leave 
										WHERE employee_code ='".$this->input->post('employee_code')."'
										AND date_start >= '".$this->input->post('date_start')."' 
										AND date_end <= '".$this->input->post('date_end')."'
										AND approved =1 ")->row();

					$sql_r = $sql->sql_jml;
					

					if($sql_r > 0){
						$this->apps->set_notification(2, "Tanggal cuti yang anda input tidak tersedia, silahkan pilih tanggal yang lain");
						redirect($_SERVER['HTTP_REFERER']);
					}

					/* 
						cari tanggal merah 
					*/

					$querys = $this->myleave_mdl->getdateOf();

					foreach ($querys as $key => $value) {
					$date_off[] = $value['tgl'];
					}
					
					$data_array = implode("','",$date_off);
					
					$querys   = $this->db->query("SELECT * FROM
					(SELECT ADDDATE('1970-01-01',t4.i*10000 + t3.i*1000 + t2.i*100 + t1.i*10 + t0.i) selected_date FROM
					(SELECT 0 i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t0,
					(SELECT 0 i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t1,
					(SELECT 0 i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t2,
					(SELECT 0 i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t3,
					(SELECT 0 i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t4) v
					WHERE selected_date BETWEEN '".$this->input->post('date_start')."' AND '".$this->input->post('date_end')."'
					AND DAYOFWEEK(selected_date) <> 1
					AND DAYOFWEEK(selected_date) <> 7
					AND selected_date NOT IN ('".$data_array."') ");

					foreach ($querys->result() as $rows){

						$dt  = $rows->selected_date;
						$dt1 = strtotime($dt);
						$dt2 = date("l", $dt1);
						$dt3 = strtolower($dt2);
						if(($dt3 == "saturday" ) || ($dt3 == "sunday"))
						{

						}
						else
						{

						}

						$leave   = array (
								"annual_leave_code" 		=> $this->input->post('annual_leave_code'),
								"type_cuty_id" 				=> $this->input->post('type_cuty_id'),
								"annual_leave_date" 		=> date('Y-m-d'),
								"employee_code" 			=> $this->input->post('employee_code'),
								"date_start" 				=> $this->input->post('date_start'),
								"date_end" 					=> $this->input->post('date_end'),
								"balance" 					=> $this->input->post('balance'),
								'jml'       			 	=> $jml_cuti,
								"annual_leave_description" 	=> $this->input->post('annual_leave_description'),
								'created'					=> date("Y-m-d H:i:s"),
								'modified'					=> date("Y-m-d H:i:s"),
								'date_long'					=> $rows->selected_date,
								'days'           			=> $dt3,
								'flag'						=> 1
								);
						# -------------------------
						$this->db->insert("mod_annual_leave", $leave);
						
					} 

					$sqls = $this->db->query("SELECT * FROM mod_type_cuty 
											  WHERE type_cuty_id ='".$this->input->post('type_cuty_id')."'")->row();

					/* Get company name */

					$sqlc = $this->db->query("SELECT mod_company.company_name 
											  FROM mod_employee
											  INNER JOIN mod_company ON mod_employee.company_code = mod_company.company_code
											  WHERE mod_employee.employee_code ='".$this->input->post('employee_code')."'")->row();

					$this->load->library('email');


					/*
						get email parent
					*/

					$eChild = $this->db->query("SELECT parent 
											FROM mod_employee 
											WHERE employee_code ='".$this->input->post('employee_code')."'")->row(); 


					$eParent = $this->db->query("SELECT email 
											FROM mod_employee 
											WHERE employee_code ='".$eChild->parent."'")->row(); 

					$config = $this->apps->config_set(); 

					$email_redirect = $this->apps->set_email();

					$bcc = array($email_redirect,$eParent->email,'it@pmka.web.id');

					$this->email->initialize($config);
					$this->email->set_newline("\r\n");
					$this->email->from($this->input->post('emails'));
					$this->email->bcc($bcc);
					$this->email->subject($sqls->type_cuty_name);

					$data['id']    = $this->input->post('annual_leave_code');
					$data['nama']  = $this->input->post('name_employee');
					$data['company']  = $sqlc->company_name;
					$data['date3'] = $this->input->post('date_start');
					$data['date4'] = $this->input->post('date_end');
					$data['judul'] = $sqls->type_cuty_name;
					$data['jml']   = $jml_cuti;
					$data['pesan'] = $this->input->post('annual_leave_description');
					$data['emails'] = $this->input->post('emails');

					$message = $this->load->view('backend/myleave/email',$data,TRUE);
					$this->email->message($message);

					if($this->email->send())
					{

					}
					else
					{
						show_error($this->email->print_debugger());
					}

					$this->load->library('user_agent');
					$logs   = array (
							"log_date"=>date("Y-m-d"),
							"log_description"=>"add leave (".$this->input->post('employee_code').")",
							"user_id"=> $session_data['user_id'],
							"browser" => $this->agent->browser(),
							"ip" =>  $this->input->ip_address(),
							"platform" => $this->agent->platform(),
							"created"=>date("Y-m-d H:i:s"),
							"modified"=>date("Y-m-d H:i:s")
							);
						# -------------------------
					$this->db->insert("sys_logs", $logs);
			        $this->apps->set_notification(1, "Successfully! Leave has ben save");
					redirect('admin/myleave');


				} else {

					/* UPDATE CUTI */

					$tipe = $this->input->post('doc_type_cuty_id');


					$cek = $this->db->query("SELECT * 
										FROM mod_type_cuty 
										WHERE type_cuty_id ='".$this->input->post('doc_type_cuty_id')."'")->row();
		
					$jml = $cek->type_cuty_jml; 

					/*  extrak tanggal cuti dari start ke end */

					$date1 		 = date_create($this->input->post('doc_date_start'));
					$date_start1 = date_format($date1, "d-m-Y");
					$date2 		 = date_create($this->input->post('doc_date_end'));
					$date_start2 = date_format($date2, "d-m-Y");
					$jml_cuti    = $this->logic($date_start1, $date_start2,"-");

					/*
						cek jika jumlah cuti yang diinput melebihi jumlah cuti ketentuan perusahaan
					*/

					if($jml_cuti > $jml){
						$this->apps->set_notification(2, "Jumlah cuti yang anda pilih melebihi jumlah cuti yang di sediakan perusahaan");
						redirect($_SERVER['HTTP_REFERER']);
					} 


					/*
						cek jika saldo cuti kurang dari jumlah yang diinput
					*/

					$balance = $this->input->post('balance'); 
					if($balance < $jml_cuti){
						$this->apps->set_notification(2, "Jumlah cuti yang anda pilih melebihi saldo cuti anda, sisa saldo anda adalah ".$balance." hari");
						redirect($_SERVER['HTTP_REFERER']);
					}


					/* 
						cek jika tanggal yang diinput sudah pernah melakukan cuti dan statusnya approved
					*/


					$sql = $this->db->query("SELECT count(*) as sql_jml
										FROM mod_annual_leave 
										WHERE employee_code ='".$this->input->post('employee_code')."'
										AND date_start >= '".$this->input->post('doc_date_start')."' 
										AND date_end <= '".$this->input->post('doc_date_end')."'
										AND approved =1 ")->row();

					$sql_r = $sql->sql_jml;
					

					if($sql_r > 0){
						$this->apps->set_notification(2, "Tanggal cuti yang anda input tidak tersedia, silahkan pilih tanggal yang lain");
						redirect($_SERVER['HTTP_REFERER']);
					}

					$year = date('Y');

					

					/* 
						cari tanggal merah 
					*/

					$querys = $this->myleave_mdl->getdateOf();

					foreach ($querys as $key => $value) {
					$date_off[] = $value['tgl'];
					}
					
					$data_array = implode("','",$date_off);
					
					$querys   = $this->db->query("SELECT * FROM
					(SELECT ADDDATE('1970-01-01',t4.i*10000 + t3.i*1000 + t2.i*100 + t1.i*10 + t0.i) selected_date FROM
					(SELECT 0 i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t0,
					(SELECT 0 i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t1,
					(SELECT 0 i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t2,
					(SELECT 0 i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t3,
					(SELECT 0 i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t4) v
					WHERE selected_date BETWEEN '".$this->input->post('doc_date_start')."' AND '".$this->input->post('doc_date_end')."'
					AND DAYOFWEEK(selected_date) <> 1
					AND DAYOFWEEK(selected_date) <> 7
					AND selected_date NOT IN ('".$data_array."') ");

					foreach ($querys->result() as $rows){

						$dt  = $rows->selected_date;
						$dt1 = strtotime($dt);
						$dt2 = date("l", $dt1);
						$dt3 = strtolower($dt2);
						if(($dt3 == "Saturday" ) || ($dt3 == "Sunday"))
						{

						}
						else
						{

						}

						$this->db->query("DELETE FROM mod_annual_leave WHERE annual_leave_code='".$this->input->post('doc_annual_leave_code')."' AND approved = 0 ");

						$leave   = array (
								"annual_leave_code" 		=> $this->input->post('doc_annual_leave_code'),
								"type_cuty_id" 				=> $this->input->post('doc_type_cuty_id'),
								"annual_leave_date" 		=> date('Y-m-d'),
								"employee_code" 			=> $this->input->post('employee_code'),
								"date_start" 				=> $this->input->post('doc_date_start'),
								"date_end" 					=> $this->input->post('doc_date_end'),
								"balance" 					=> $this->input->post('balance'),
								'jml'       			 	=> $jml_cuti,
								"annual_leave_description" 	=> $this->input->post('doc_annual_leave_description'),
								'created'					=> date("Y-m-d H:i:s"),
								'modified'					=> date("Y-m-d H:i:s"),
								'date_long'					=> $rows->selected_date,
								'days'           			=> $dt3,
								'flag'						=> 2
								);
						# -------------------------
						$this->db->insert("mod_annual_leave", $leave);

					}

					$sqls = $this->db->query("SELECT * FROM mod_type_cuty 
											  WHERE type_cuty_id ='".$this->input->post('doc_type_cuty_id')."'")->row();

					/* Get company name */

					$sqlc = $this->db->query("SELECT mod_company.company_name 
											  FROM mod_employee
											  INNER JOIN mod_company ON mod_employee.company_code = mod_company.company_code
											  WHERE mod_employee.employee_code ='".$this->input->post('employee_code')."'")->row();

					$this->load->library('email');


					/*
						get email parent
					*/

					$eChild = $this->db->query("SELECT parent 
											FROM mod_employee 
											WHERE employee_code ='".$this->input->post('employee_code')."'")->row(); 


					$eParent = $this->db->query("SELECT email 
											FROM mod_employee 
											WHERE employee_code ='".$eChild->parent."'")->row(); 

					

					$config = $this->apps->config_set(); 

					$email_redirect = $this->apps->set_email();

					$bcc = array($email_redirect,$eParent->email,'it@pmka.web.id');

					$this->email->initialize($config);
					$this->email->set_newline("\r\n");
					$this->email->from($this->input->post('emails'));
					$this->email->bcc($bcc);
					$this->email->subject($sqls->type_cuty_name);

					$data['id']    = $this->input->post('doc_annual_leave_code');
					$data['nama']  = $this->input->post('name_employee');
					$data['company']  = $sqlc->company_name;
					$data['date3'] = $this->input->post('doc_date_start');
					$data['date4'] = $this->input->post('doc_date_end');
					$data['judul'] = $sqls->type_cuty_name;
					$data['jml']   = $jml_cuti;
					$data['pesan'] = $this->input->post('doc_annual_leave_description');
					$data['emails'] = $this->input->post('emails');

					$message = $this->load->view('backend/myleave/email',$data,TRUE);
					$this->email->message($message);

					if($this->email->send())
					{

					}
					else
					{
						show_error($this->email->print_debugger());
					}

					$this->load->library('user_agent');
					$logs   = array (
							"log_date"=>date("Y-m-d"),
							"log_description"=>"update leave (".$this->input->post('employee_code').")",
							"user_id"=> $session_data['user_id'],
							"browser" => $this->agent->browser(),
							"ip" =>  $this->input->ip_address(),
							"platform" => $this->agent->platform(),
							"created"=>date("Y-m-d H:i:s"),
							"modified"=>date("Y-m-d H:i:s")
							);
						# -------------------------
					$this->db->insert("sys_logs", $logs);
			        $this->apps->set_notification(1, "Successfully! Leave has ben update");
					redirect('admin/myleave');
				}

			}else{
				redirect('login', 'refresh');
			}
	}


	public function logic($tglawal,$tglakhir,$delimiter)
	{
		$querys = $this->myleave_mdl->getdate();

		$tgl_awal = $tgl_akhir = $minggu = $sabtu = $koreksi = $libur = 0;

		foreach ($querys as $key => $value) {
		    $liburnasional[] = $value['tgl'];
		}
		//var_dump($liburnasional);exit();
	//    memecah tanggal untuk mendapatkan hari, bulan dan tahun
	    $pecah_tglawal = explode($delimiter, $tglawal);
	    $pecah_tglakhir = explode($delimiter, $tglakhir);

	//    mengubah Gregorian date menjadi Julian Day Count
	    $tgl_awal = gregoriantojd($pecah_tglawal[1], $pecah_tglawal[0], $pecah_tglawal[2]);
	    $tgl_akhir = gregoriantojd($pecah_tglakhir[1], $pecah_tglakhir[0], $pecah_tglakhir[2]);

	//    mengubah ke unix timestamp
	    $jmldetik = 24*3600;
	    $a = strtotime($tglawal);
	    $b = strtotime($tglakhir);

	//    menghitung jumlah libur nasional
	    for($i=$a; $i<$b; $i+=$jmldetik){
	        foreach ($liburnasional as $key => $tgllibur) {
	            if($tgllibur==date("d-m-Y",$i)){
	                $libur++;
	            }
	        }
	    }

	//    menghitung jumlah hari minggu
	    for($i=$a; $i<$b; $i+=$jmldetik){
	        if(date("w",$i)=="0"){
	            $minggu++;
	        }
	    }

	//    menghitung jumlah hari sabtu
	    for($i=$a; $i<$b; $i+=$jmldetik){
	        if(date("w",$i)=="6"){
	            $sabtu++;
	        }
	    }
	//    dijalankan jika $tglakhir adalah hari sabtu atau minggu
	    if(date("w",$b)=="0" || date("w",$b)=="6"){
	        $koreksi = 1;
	    }

	//    mengitung selisih dengan pengurangan kemudian ditambahkan 1 agar tanggal awal cuti juga dihitung
	    $jumlahcuti =  $tgl_akhir - $tgl_awal - $libur - $minggu - $sabtu - $koreksi + 1;
	    return $jumlahcuti;
	}


	public function exs()
	{
		$tgl_mulai = "2023-03-14";
		$tgl_selesai = "2023-03-20";
		echo "Awal cuti ".$tgl_mulai." dan Selesai cuti ".$tgl_selesai."<br/>";
		echo "Jumlah cuti = ".  $this->logic($tgl_mulai, $tgl_selesai,"-");
		echo " hari kerja <br/>(hari sabtu,minggu dan libur nasional tidak dihitung) ";
	}


	public function loadTgl(){
		$year = date('Y');
		
		$querys = $this->db->query("SELECT tgl FROM mod_date WHERE YEAR(tgl) ='2023'");

		foreach ($querys as $key => $value) {
		    echo $liburnasional[] = $value['tgl'];
		}

	}


	public function loadStates(&$arr) {
    	$arr = array("2023-03-22","2023-03-25","2023-03-27","2023-03-29","2023-03-31");
	}


	public function send_test()
	{
		$bcc = array('it@pmka.web.id');

		$this->load->library('email');

		$config = $this->apps->config_set();

		$this->email->initialize($config);
		$this->email->set_newline("\r\n");
		$this->email->from('it@pmka.web.id');
		$this->email->bcc($bcc);

		$subject = "Test Email From HRMS New  ";

		$this->email->subject($subject);
		$data['judul'] 		= 'Test';
		$data['note'] 		= 'HTML test';

		$message 			= $this->load->view('backend/myleave/test_mail',$data,TRUE);
		$this->email->message($message);

		if($this->email->send())
		{
			$this->toastr->success("Successfully");
			redirect($_SERVER['HTTP_REFERER']);
		}
		else
		{
			show_error($this->email->print_debugger());
		}

	}


	public function show()
	{
		$data = array();

		$this->load->view('backend/myleave/test_mail',$data);
	}



}
