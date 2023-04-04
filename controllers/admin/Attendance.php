<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance extends CI_Controller {

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
				$data['title']       		= 'Shift';
				$data['master']        		= 'master';
				$data['pic'] 				= $session_data['pic'];
				$id 						= $this->uri->segment(2);
				$data['getdata']			= $this->attendance_mdl->GetData();
				$data['actions']			= $this->attendance_mdl->actions();

				$userInfo = $this->users_mdl->user_info($id); 

		        if($userInfo=="")
		        {
		            $this->load->view('backend/notfound', $data);
		        } else {
		            $this->load->view('default/header', $data);
				  	$this->load->view('backend/asetting/index', $data);
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
				$data['user_type'] 			= $session_data['user_type'];
				$data['role_id'] 			= $session_data['role_id'];
				$data['user_id'] 			= $session_data['user_id'];
				$data['title']       		= 'Add Shift';
				$data['master']        		= 'master';
				$data['pic'] 				= $session_data['pic'];
				$id 						= $this->uri->segment(2);
				$data['getdata']			= $this->attendance_mdl->GetData();
				$data['actions']			= $this->attendance_mdl->actions();
				$data['auto']			    = $this->attendance_mdl->shift_auto();

				$userInfo = $this->users_mdl->user_info($id); 

		        if($userInfo=="")
		        {
		            $this->load->view('backend/notfound', $data);
		        } else {
		            $this->load->view('default/header', $data);
				  	$this->load->view('backend/asetting/add', $data);
				  	$this->load->view('default/footer', $data);
		        }

				
			}else{
				redirect('login', 'refresh');
			}
	}


	public function edit($shift_code)
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
				$data['title']       		= 'Add Shift';
				$data['master']        		= 'master';
				$data['pic'] 				= $session_data['pic'];
				$id 						= $this->uri->segment(2);
				$data['getdata']			= $this->attendance_mdl->getedit($shift_code);
				$data['actions']			= $this->attendance_mdl->actions();
				$data['auto']			    = $this->attendance_mdl->shift_auto();

				$this->load->view('default/header', $data);
			  	$this->load->view('backend/asetting/edit', $data);
			  	$this->load->view('default/footer', $data);

			}else{
				redirect('login', 'refresh');
			}
	}


	public function save()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data   	   = $this->session->userdata('logged_in');

			if($this->input->post('ids') == 1){

				$jumlah 		  	   = count($this->input->post('chkbox'));

				$item=array(
					'shift_code'        => $this->input->post('auto'),
					'shift_name'        => $this->input->post('shift_name'),
					'shift_day' 	    => $jumlah
				);

				$this->attendance_mdl->save($item);

				$count 		  	= count($this->input->post('shift_code'));
				$shift_code     = $this->input->post('shift_code');
				$shift_in 		= $this->input->post('shift_in');
				$shift_out 		= $this->input->post('shift_out');
				$day 		    = $this->input->post('day_name');

				for ($i = 0; $i <$jumlah; $i++){
					$item = array(
						'shift_code'			    => $shift_code[$i],
						'shift_in'		 			=> $shift_in[$i],
						'shift_out'		 			=> $shift_out[$i],
						'day_name'                  => $day[$i],
						'checkbox'                  => 1
					);

				$this->attendance_mdl->save_detail($item);

				}


				$this->load->library('user_agent');
				$logs   = array (
					"log_date"=>date("Y-m-d"),
					"log_description"=>"add shifting (".$this->input->post('shift_name').") ",
					"user_id"=> $session_data['user_id'],
					"browser" => $this->agent->browser(),
					"ip" =>  $this->input->ip_address(),
					"platform" => $this->agent->platform(),
					"created"=>date("Y-m-d H:i:s"),
					"modified"=>date("Y-m-d H:i:s")
					);
				# -------------------------
				$this->db->insert("sys_logs", $logs);

			
				$this->apps->set_notification(1, "Shift has been save");
				redirect('admin/attendance/');

			} else {


				$jumlah 		  	   = count($this->input->post('chkbox'));

				$item=array(
					'shift_name'        => $this->input->post('shift_name'),
					'shift_day' 	    => $jumlah
				);

				$data = array(
					'shift_code' => $this->input->post('shift_codes')
				);

				$this->attendance_mdl->update($item, $data);


				$kode = $this->input->post('shift_codes');

				$this->db->query("DELETE FROM mod_detail_shift_work WHERE shift_code='".$kode."'");

				$count 		  	= count($this->input->post('chkbox'));

				$shift_code     = $this->input->post('shift_code');
				$shift_in 		= $this->input->post('shift_in');
				$shift_out 		= $this->input->post('shift_out');
				$day 		    = $this->input->post('day_name');

				for ($i = 0; $i <$count; $i++){

					$item = array(
						'shift_code'			    => $this->input->post('shift_codes'),
						'shift_in'		 			=> $shift_in[$i],
						'shift_out'		 			=> $shift_out[$i],
						'day_name'                  => $day[$i],
						'checkbox'                  => 1
					);

				$this->attendance_mdl->save_detail($item);

				}

				$this->db->query("DELETE FROM mod_detail_shift_work WHERE shift_code='NULL'");

				$this->load->library('user_agent');
				$logs   = array (
					"log_date"=>date("Y-m-d"),
					"log_description"=>"edit shifting (".$this->input->post('shift_name').") ",
					"user_id"=> $session_data['user_id'],
					"browser" => $this->agent->browser(),
					"ip" =>  $this->input->ip_address(),
					"platform" => $this->agent->platform(),
					"created"=>date("Y-m-d H:i:s"),
					"modified"=>date("Y-m-d H:i:s")
					);
				# -------------------------
				$this->db->insert("sys_logs", $logs);

				$this->apps->set_notification(1, "Shift has been edit");
				redirect('admin/attendance/');

			}

		}else{
			redirect('login', 'refresh');
		}
	}


	public function delete()
	{
		$selects = $this->db->query("SELECT status FROM mod_shift WHERE shift_code='".$this->uri->segment(4)."' ");

		foreach ($selects->result_array() as $row){ }

		$a = $row['status'];
		$uri = $this->uri->segment(4);

		if($a == 1){
			$this->db->query("UPDATE mod_shift SET status ='0' WHERE shift_code ='".$uri."'");
		} else {
			$this->db->query("UPDATE mod_shift SET status ='1' WHERE shift_code ='".$uri."'");
		}

		$this->load->library('user_agent');
			$logs   = array (
				"log_date"=>date("Y-m-d"),
				"log_description"=>"inactive shifting",
				"user_id"=> $session_data['user_id'],
				"browser" => $this->agent->browser(),
				"ip" =>  $this->input->ip_address(),
				"platform" => $this->agent->platform(),
				"created"=>date("Y-m-d H:i:s"),
				"modified"=>date("Y-m-d H:i:s")
				);
			# -------------------------
			$this->db->insert("sys_logs", $logs);

		$this->apps->set_notification(1, "Shift has been edit");
		redirect('admin/attendance/');
	}


	public function save_manual()
	{

		if($this->session->userdata('logged_in'))
			{
				$session_data   = $this->session->userdata('logged_in');
				$pin 		    = $this->input->post('pin');
				$shift_in 		= $this->input->post('shift_in');
				$shift_out 		= $this->input->post('shift_out');
				$noted 		    = $this->input->post('noted');
				$day_name 		= $this->input->post('day_name');

				$date_start 	= $this->input->post('date_start');
				$date_end 		= $this->input->post('date_end');


				$date_starts 	= date_create($this->input->post('date_start'));
				$date_ends 		= date_create($this->input->post('date_end'));

				$jml = $this->logic($date_start, $date_end,"-");

				$tgl1 = date_create($this->input->post('tgl'));
				$tgl2 = date_format($tgl1, "Y-m-d");

				$pin = $pin;
				$in = $tgl2." ".$shift_in;
				$out = $tgl2." ".$shift_out;
				$noted = $noted;
				$nameOfDay = date('l', strtotime($tgl2));

				$status = $this->input->post('status');

				if($status == 'H'){

					$item1 = array(
						'pin'			    => $pin,
						'day_name'          => $nameOfDay,
						'timelog'		 	=> $in,
						'status'            => 'M',
						'noted'             => $noted
					);
					
					$this->attendance_mdl->save_manual1($item1);

					$item2 = array(
						'pin'			    => $pin,
						'day_name'          => $nameOfDay,
						'timelog'		 	=> $out,
						'status'            => 'M',
						'noted'             => $noted
					);
					//echo "<pre>"; var_dump($item2);exit();
					$this->attendance_mdl->save_manual2($item2);

				} elseif($status == 'S'){

					$item1 = array(
						'pin'			    => $pin,
						'day_name'          => $nameOfDay,
						'date_shelter'		=> $tgl2,
						'status'            => 'S',
						'noted'             => $noted
					);

					$this->attendance_mdl->save_shelter($item1);

				}  elseif($status == 'D'){

					$item1 = array(
						'pin'			    => $pin,
						'day_name'          => $nameOfDay,
						'date_shelter'		=> $tgl2,
						'status'            => 'D',
						'noted'             => $noted
					);

					$this->attendance_mdl->save_shelter($item1);

				} elseif($status == 'A'){

					$item1 = array(
						'pin'			    => $pin,
						'day_name'          => $nameOfDay,
						'date_shelter'		=> $tgl2,
						'status'            => 'A',
						'noted'             => $noted
					);

					$this->attendance_mdl->save_shelter($item1);

				} elseif($status == 'C'){

					$emplo            = $this->db->query("SELECT * FROM mod_employee WHERE pin ='$pin'")->result_array();

			        foreach ($emplo as $key => $values) {}
			        $empl_code   = $values['employee_code'];
			    	$params_cuti = $values['params_cuti'];
			    	$hasil = $params_cuti-$jml;
			    	$this->db->query("UPDATE mod_employee SET params_cuti ='$hasil' WHERE employee_code='$empl_code'");

					$item=array(
						'annual_leave_code'      		=> $this->myleave_mdl->auto(),
						'type_cuty_id'			 		=> 8,
						'annual_leave_date'      		=> date('Y-m-d'),
						'employee_code'   		 		=> $empl_code,
						'date_start' 			 		=> date_format($date_starts, "Y-m-d"),
						'date_end' 	 		     		=> date_format($date_ends, "Y-m-d"),
						'balance'                       => $hasil,
						'jml'       			 		=> $jml,
						'annual_leave_description'      => $noted,
						'approved'						=> 1,
						'approved_by'					=> $session_data['name'],
						'created'						=> date("Y-m-d H:i:s"),
						'modified'						=> date("Y-m-d H:i:s")
					);

					$this->attendance_mdl->save1($item);


					$item=array(
						'annual_leave_code'      		=> $this->myleave_mdl->auto(),
						'type_cuty_id'			 		=> 8,
						'annual_leave_date'      		=> date('Y-m-d'),
						'employee_code'   		 		=> $empl_code,
						'date_start' 			 		=> date_format($date_starts, "Y-m-d"),
						'date_end' 	 		     		=> date_format($date_ends, "Y-m-d"),
						'balance'                       => $hasil,
						'jml'       			 		=> $jml,
						'annual_leave_description'      => $noted,
						'approved'						=> 1,
						'approved_by'					=> $session_data['name'],
						'created'						=> date("Y-m-d H:i:s"),
						'modified'						=> date("Y-m-d H:i:s")
					);

					$this->attendance_mdl->savedetail1($item);

				}


				$this->load->library('user_agent');
				$logs   = array (
					"log_date"=>date("Y-m-d"),
					"log_description"=>"add absen manual (".$status.")",
					"user_id"=> $session_data['user_id'],
					"browser" => $this->agent->browser(),
					"ip" =>  $this->input->ip_address(),
					"platform" => $this->agent->platform(),
					"created"=>date("Y-m-d H:i:s"),
					"modified"=>date("Y-m-d H:i:s")
					);
				# -------------------------
				$this->db->insert("sys_logs", $logs);

				
				$this->apps->set_notification(1, "Data has been save");
				redirect('admin/attendance/');

			}else{
				redirect('login', 'refresh');
		}
	}


	public function logic($tglawal,$tglakhir,$delimiter)
	{
		$querys = $this->attendance_mdl->getLogic();

		$tgl_awal = $tgl_akhir = $minggu = $sabtu = $koreksi = $libur = 0;

		foreach ($querys as $key => $value) {
		    $liburnasional[] = $value['tgl'];
		}

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


	public function timesheet()
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
			  	$this->load->view('backend/attendance/timesheet', $data);
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
          $data['title']       = 'attendance';
          $data['aktif']       = 'active treeview';

          $bulan    =  $_GET['query'];
          $loc    	=  $_GET['loc'];
          $shift    =  $_GET['shift'];
          $div    	=  $_GET['div'];

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
        $contents = $this->timesheet_mdl->get_timesheet($bulan,$loc,$shift,$employee_code,$div);
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
		echo "EXCEL";
	}
}
