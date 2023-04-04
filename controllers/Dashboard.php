<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct()
 	{
   		parent::__construct();
			$this->load->helper(array('form', 'url', 'inflector'));
			$this->load->library(array('session','form_validation','upload','toastr','apps'));
			$this->load->model(array('users_mdl','msg_mdl','annualleave_mdl','announcements_mdl'));
 	}

	 public function index()
	 { 
		 if($this->session->userdata('logged_in'))
			{  
				 $session_data   			= $this->session->userdata('logged_in');
				 $data['name'] 				= $session_data['name'];
				 $data['user_name'] 		= $session_data['user_name'];
				 $data['user_status'] 	  	= $session_data['user_status'];
				 $data['user_type'] 		= $session_data['user_type'];
				 $data['role_id'] 			= $session_data['role_id'];
				 $data['employee_code'] 	= $session_data['employee_code'];
				 $data['pic'] 				= $session_data['pic'];
				 $data['user_id'] 			= $session_data['user_id'];
				 $in 						= $this->users_mdl->cekIn();
				 $data['out']				= $this->users_mdl->cekOut();
				 $data['birthday'] 			= $this->users_mdl->getbirthday();
				 $data['getholiday']		= $this->annualleave_mdl->GetDataHoliday();
				 $data['getannouncements']	= $this->announcements_mdl->Getannouncements();
				 $data['getcuti']			= $this->annualleave_mdl->getcutilist();

				 $jml	= $this->users_mdl->gethire();

				 foreach ($jml as $key => $value) { }

				/*
					set interval untuk mengetahui jumlah kerja karyawan apakah sudah lebih dari 1 tahun atau belum;
				*/

				$date1 		= $value['date_of_hire']; 
		        $start_date = new DateTime($date1); 
		        $end_date 	= date_create();
		        $interval 	= $start_date->diff($end_date);

	      		/*
	      			jika sudah 1 tahun maka jalankan perintah dibawah ini
	      		*/

	      		if($interval->days > 365){ 

	      			$thn_sekarang   = date('Y');
					$bulan_update   = date('m'); 

					// $thn_sekarang   = '2022';
					// $bulan_update   = '01';

					$sParams = $this->apps->get_params();		

					/*
						cek jika saat ini dibawah bulan april maka lakukan pengecekan sisa cuti lalu lakukan akumulasi
					*/

					/*
						jika user login dibawah bulan april lakukan dibawah ini.
					*/


					if($bulan_update <= $sParams) { 
	 
						$qselect = $this->db->query("SELECT log_cuti FROM mod_employee WHERE employee_code ='".$session_data['employee_code']."'");

						foreach ($qselect->result_array() as $row)

						{ 
							$log_cuti = $row['log_cuti']; 
						}

						    /*
								Jika tahun belum update (user belum melakukan login di tahun yang terbaru)
						    */

						  if($log_cuti < $thn_sekarang){ 

							  	$qselect_params = $this->db->query("SELECT params_cuti 
							  								 FROM mod_employee 
							  								 WHERE employee_code ='".$session_data['employee_code']."' LIMIT 1 ");

							  	$codes = $session_data['employee_code'];

								foreach ($qselect_params->result_array() as $row_params){}

								$sisa_cuti = $row_params['params_cuti'];

								/*
									Jika sisa cuti lebih besar dari 0 maka lakukan perhitungan (cuti tahunan 12 + param cuti)
								*/
								if($sisa_cuti > 0){

									$datas[] = array(
										   'employee_code' 			=> $codes,
										   'params_cuti'   			=> 12,
										   'params_cuti_last_year'  => $sisa_cuti,
										   'advance_total'          => 0,
										   'log_cuti'      			=> $thn_sekarang,
										   'log_update'    			=> date('m')
										  );

									$query = $this->db->update_batch('mod_employee',$datas,'employee_code');

								}elseif($sisa_cuti == 0){

									$datas[] = array(
										   'employee_code' 			=> $codes,
										   'params_cuti'   			=> 12,
										   'params_cuti_last_year'  => 0,
										   'advance_total'          => 0,
										   'log_cuti'      			=> $thn_sekarang,
										   'log_update'    			=> date('m')
										  );

									$query = $this->db->update_batch('mod_employee',$datas,'employee_code');

									

								}elseif($sisa_cuti < 0){ 

									$min 			= str_replace('-', '', $sisa_cuti);
									$param_sisa 	= 12 - $min;

									$datas[] = array(
										   'employee_code' 			=> $codes,
										   'params_cuti'   			=> $param_sisa,
										   'params_cuti_last_year'  => 0,
										   'advance_total'          => 0,
										   'log_cuti'      			=> $thn_sekarang,
										   'log_update'    			=> date('m')
										  );

									$query = $this->db->update_batch('mod_employee',$datas,'employee_code');

								}
						  		
						} 

						
					}

					elseif($bulan_update > $sParams){

						$codes = $session_data['employee_code'];

						$qselect = $this->db->query("SELECT log_cuti, params_cuti FROM mod_employee WHERE employee_code ='$codes'");

							foreach ($qselect->result_array() as $row)

							{ $log_cuti = $row['log_cuti']; }


							  if($log_cuti < $thn_sekarang){

							  		$minus = $this->annualleave_mdl->getallminus();

									foreach ($minus as $key => $value) {}

									$min = $value['params_cuti'];

							  		if($min < 0){

										$min2 			= str_replace('-', '', $min);

										$param_sisa 	= 12 - $min2;

										$datas[] = array(
											   'employee_code' 			=> $codes,
											   'params_cuti'   			=> $param_sisa,
											   'params_cuti_last_year'  => 0,
											   'advance_total'          => 0,
											   'log_cuti'      			=> $thn_sekarang,
											   'log_update'    			=> date('m')
											  );

										$query = $this->db->update_batch('mod_employee',$datas,'employee_code');

										

									} else {

										$datas[] = array(
											   'employee_code' 			=> $codes,
											   'params_cuti'   			=> 12,
											   'params_cuti_last_year'  => 0,
											   'advance_total'          => 0,
											   'log_cuti'      			=> $thn_sekarang,
											   'log_update'    			=> date('m')
											  );

										$query = $this->db->update_batch('mod_employee',$datas,'employee_code');

									}

								}

					}

	      		}

				 if ($in > 0) {

				 	  // if(isset($_SERVER['HTTP_REFERER'])) {
					  //   header('Location: ' . $_SERVER['HTTP_REFERER']);
					  // } else {
					  //   // Redirect ke halaman default jika tidak ada halaman sebelumnya yang tersedia
					  //   $this->home();
					  // }

				 	$this->home();
						 
				 } elseif($in == 0) {


				 	// if(isset($_SERVER['HTTP_REFERER'])) {
					//     header('Location: ' . $_SERVER['HTTP_REFERER']);
					//   } else {
					//     // Redirect ke halaman default jika tidak ada halaman sebelumnya yang tersedia
					//     $this->absen();
					//   }

					$this->absen();
					 
				 } 
 
			}else{
				 redirect('login', 'refresh');
			}
	 }

	public function absen()
	{ 
		if($this->session->userdata('logged_in'))
		   	{  
			    $session_data   			= $this->session->userdata('logged_in');
			    $data['name'] 				= $session_data['name'];
			    $data['user_name'] 			= $session_data['user_name'];
				$data['user_status'] 	  	= $session_data['user_status'];
				$data['user_type'] 			= $session_data['user_type'];
				$data['role_id'] 			= $session_data['role_id'];
				$data['employee_code'] 		= $session_data['employee_code'];
				$data['pic'] 				= $session_data['pic'];
				$data['user_id'] 			= $session_data['user_id'];

				$this->load->view('backend/absen', $data);

			}else{
				redirect('login', 'refresh');
			}
	}

	public function home()
	{ 
		if($this->session->userdata('logged_in'))
		   	{  
			    $session_data   			= $this->session->userdata('logged_in');
				$id 						= $session_data['employee_code'];
			    $data['name'] 				= $session_data['name'];
			    $data['user_name'] 			= $session_data['user_name'];
				$data['user_status'] 	  	= $session_data['user_status'];
				$data['user_type'] 			= $session_data['user_type'];
				$data['role_id'] 			= $session_data['role_id'];
				$data['employee_code'] 		= $session_data['employee_code'];
				$data['pic'] 				= $session_data['pic'];
				$data['user_id'] 			= $session_data['user_id'];
				$data['out']				= $this->users_mdl->cekOut();
				$data['birthday'] 			= $this->users_mdl->getbirthday();
				$data['getdata']			= $this->users_mdl->getbirthdaynow();
				$data['getholiday']			= $this->annualleave_mdl->GetDataHoliday();
				$data['getannouncements']	= $this->announcements_mdl->Getannouncements();
				$data['getcuti']			= $this->annualleave_mdl->getcutilist();

				$cek = $this->db->query("SELECT params_cuti+params_cuti_last_year AS saldo 
                                         FROM mod_employee 
                                         WHERE employee_code ='".$id."'")->row();
		
				$data['saldo']              = $cek->saldo; 
				
				$this->users_mdl->updateumur($id);
				$this->users_mdl->updatesaldocuti($id);
				
				$this->load->view('default/header', $data);
				$this->load->view('backend/dashboard', $data);
				$this->load->view('default/footer', $data);

			}else{
				redirect('login', 'refresh');
			}
	}

	public function clock_in()
	{	
		if($this->session->userdata('logged_in'))
		   	{
			    $session_data   			= $this->session->userdata('logged_in');
			    $data['name'] 				= $session_data['name'];
			    $data['user_name'] 			= $session_data['user_name'];
				$data['user_status'] 	  	= $session_data['user_status'];
				$data['user_type'] 			= $session_data['user_type'];
				$data['company_id'] 		= $session_data['company_id'];
				$data['role_id'] 			= $session_data['role_id'];
				$data['datelogin'] 			= $session_data['datelogin'];

				$daftar_hari = array(
	               'Sunday' => 'Sunday',
	               'Monday' => 'Monday',
	               'Tuesday' => 'Tuesday',
	               'Wednesday' => 'Wednesday',
	               'Thursday' => 'Thursday',
	               'Friday' => 'Friday',
	               'Saturday' => 'Saturday'
	              );

              $date=date('Y-m-d');
              $namahari = date('l', strtotime($date));

              $nama_hari = $daftar_hari[$namahari];

				$day = date('d');

				$kode = $session_data['pin']."-".$day;
				$absen = array(
		  			'pin' 			=> $session_data['pin'],
		  			'auto'          => $kode,
		  			'user_name'     => $session_data['user_name'],
		  			'day_name'      => $nama_hari,
					'date'       	=> date('Y-m-d'),
		  			'timelog'       => date('Y-m-d H:i:s'),
		  			'date_import'   => date('Y-m-d H:i:s'),
		  			'status_in'     => 1,
                    'status'        => 'Web'
			);
				
				$this->users_mdl->clock_in($absen);

				$session_data   	= $this->session->userdata('logged_in');

				$this->load->library('user_agent');
				$logs   = array (
					"log_date"=>date("Y-m-d"),
					"log_description"=>"clock in  (".$nama_hari.")",
					"user_id"=> $session_data['user_id'],
					"browser" => $this->agent->browser(),
					"ip" =>  $this->input->ip_address(),
					"platform" => $this->agent->platform(),
					"created"=>date("Y-m-d H:i:s"),
					"modified"=>date("Y-m-d H:i:s")
				);
				# -------------------------
				$this->db->insert("sys_logs", $logs);

				$this->toastr->success('Clock In Successfully');
				redirect('dashboard/home', 'refresh');

		}else{
				redirect('login', 'refresh');
		}
	}


	public function clock_out()
	{	
		if($this->session->userdata('logged_in'))
		   	{
			    $session_data   			= $this->session->userdata('logged_in');
			    $data['name'] 				= $session_data['name'];
			    $data['user_name'] 			= $session_data['user_name'];
				$data['user_status'] 	  	= $session_data['user_status'];
				$data['user_type'] 			= $session_data['user_type'];
				$data['company_id'] 		= $session_data['company_id'];
				$data['role_id'] 			= $session_data['role_id'];
				$data['datelogin'] 			= $session_data['datelogin'];

				$daftar_hari = array(
	               'Sunday' => 'Sunday',
	               'Monday' => 'Monday',
	               'Tuesday' => 'Tuesday',
	               'Wednesday' => 'Wednesday',
	               'Thursday' => 'Thursday',
	               'Friday' => 'Friday',
	               'Saturday' => 'Saturday'
	              );

				$date=date('Y-m-d');
				$namahari = date('l', strtotime($date));

				$day = date('d');


				$pin  		= $session_data['pin'];
				$auto 		= $session_data['pin']."-".$day;
				$user_name  = $session_data['user_name'];
				$day_name 	= $daftar_hari[$namahari];
				$date 		= date('Y-m-d');
				$timelog    = date('Y-m-d H:i:s');
				$date_import= date('Y-m-d H:i:s');
				$status_in  = 2;
				$status     = 'Web';
				$note 		= $this->input->post('descriptions');


				$result= $this->users_mdl->clock_out($pin,$auto,$user_name,$day_name,$date,$timelog,$date_import,$status_in,$status,$note);
				echo json_decode($result);

		}else{
				redirect('login', 'refresh');
		}
	}

}
