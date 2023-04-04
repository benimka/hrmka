<?php

class Timesheet_mdl extends CI_Model{
	public function __construct(){
		parent::__construct();
	}


	public function getemployees()
	{
		if($this->session->userdata('logged_in'))
			{
				$session_data = $this->session->userdata('logged_in');
				$id           = $session_data['inisial'];
				$role_id      = $session_data['role_id'];
				$employee_code= $session_data['employee_code'];
				$department_code= $session_data['department_code'];

				$data           = array();
				if($role_id == 4){
					$query          = "SELECT employee_code, employee_name, pin FROM mod_employee WHERE dum !='1' AND mod_status_code !='ST005' AND department_code='$department_code' ";
				} else {
					$query          = "SELECT employee_code, employee_name, pin FROM mod_employee WHERE dum !='1' AND mod_status_code !='ST005'";
				}

				$Q              = $this->db->query($query);

				if ($Q->num_rows() > 0){
					foreach ($Q->result_array() as $row){
						$data[] = $row;
					}
				}

							return $data;
		}else{
			redirect('login', 'refresh');
		}
	}

	function get_timesheet($bulan,$loc,$shift,$div)
	{

	if($this->session->userdata('logged_in'))
	   	{
		    $session_data   	 = $this->session->userdata('logged_in');
		    $role		 		 = $session_data['role_id'];
		    $department_code	 = $session_data['department_code'];
		    $pin		 		 = $session_data['pin'];
		    $kode		 		 = $session_data['employee_code'];

			set_time_limit(120);
        	ini_set('memory_limit', '256M');

		    //Staff Only

		    if($role == 10){

		    	$cuti = "<b style=color:white;background-color:green;padding:5px 8px 5px 8px;>C</b>";
					$this->db->simple_query("SET SESSION group_concat_max_len = 1000000");
					$query1 = "
						SELECT
							GROUP_CONCAT(
								CONCAT(
									\"GROUP_CONCAT(DISTINCT(CASE
									WHEN DATE_FORMAT(s.timelog, '%Y-%m-%d') = '\" ,dt, \"' THEN 'H'
									WHEN DATE_FORMAT(cuti.date_long, '%Y-%m-%d') = '\" ,dt, \"' THEN  'C'
									WHEN DATE_FORMAT(shelter2.date_shelter, '%Y-%m-%d') = '\" ,dt, \"' THEN  'S'
									WHEN DATE_FORMAT(shelter3.date_shelter, '%Y-%m-%d') = '\" ,dt, \"' THEN  'D'
									WHEN DATE_FORMAT(shelter4.date_shelter, '%Y-%m-%d') = '\" ,dt, \"' THEN  'A'
									ELSE NULL END)) AS '\",date_format(dt,'%d'),\"'\"
								)
							) arrsql

						FROM
						(
							SELECT DISTINCT(a.date) AS dt
							FROM mod_detail_shift a
							LEFT JOIN mod_employee r ON r.schedule = a.id
							WHERE date_format(a.date, '%Y-%m') = '$bulan'
							ORDER BY a.date
						) d
						";

					$Q1		= $this->db->query($query1);
					if ($Q1->num_rows() > 0){
						foreach ($Q1->result_array() as $row){
							$mysql[] = $row;
						}
					}


					$query = "
					SELECT r.employee_name AS NAME, l.location_name AS LOCATION, d.department_name AS DIVISION,

						COUNT(Distinct date_format(s.timelog, '%Y-%m-%d')) As Hadir,

						(   SELECT count(mod_detail_annual_leave.jml) AS total
							FROM mod_detail_annual_leave
							LEFT JOIN mod_employee ON mod_detail_annual_leave.employee_code = mod_employee.employee_code
							WHERE mod_detail_annual_leave.employee_code IN (r.employee_code)
							AND DATE_FORMAT(mod_detail_annual_leave.date_start, '%Y-%m')='$bulan' AND DATE_FORMAT(mod_detail_annual_leave.date_end, '%Y-%m')='$bulan' AND mod_employee.pin = '". $pin ."'
						) as Cuti,

						(   SELECT count(mod_shelter.pin) AS sakit
							FROM mod_employee
							LEFT JOIN mod_shelter ON mod_employee.pin = mod_shelter.pin
							WHERE mod_shelter.pin IN (s.pin) AND mod_shelter.status ='S'
							AND DATE_FORMAT(mod_shelter.date_shelter, '%Y-%m')='$bulan' AND mod_employee.pin = '". $pin ."'
						) as Sakit,

						(   SELECT count(mod_shelter.pin) AS dinas
							FROM mod_employee
							LEFT JOIN mod_shelter ON mod_employee.pin = mod_shelter.pin
							WHERE mod_shelter.pin IN (s.pin) AND mod_shelter.status ='D'
							AND DATE_FORMAT(mod_shelter.date_shelter, '%Y-%m')='$bulan' AND mod_employee.pin = '". $pin ."'
						) as Dinas,

						(   SELECT count(mod_shelter.pin) AS alpha
							FROM mod_employee
							LEFT JOIN mod_shelter ON mod_employee.pin = mod_shelter.pin
							WHERE mod_shelter.pin IN (s.pin) AND mod_shelter.status ='A'
							AND DATE_FORMAT(mod_shelter.date_shelter, '%Y-%m')='$bulan' AND mod_employee.pin = '". $pin ."'
						) as Alpha,

						" . $mysql[0][arrsql] . "

							FROM mod_absen s

							LEFT JOIN mod_employee r ON r.pin = s.pin
							INNER JOIN mod_location l ON l.location_id = r.location
							INNER JOIN mod_department d ON d.department_code = r.department_code
							LEFT JOIN mod_detail_annual_leave cuti ON cuti.employee_code = r.employee_code
							LEFT JOIN mod_shelter shelter2 ON shelter2.pin = r.pin AND shelter2.status ='S'
							LEFT JOIN mod_shelter shelter3 ON shelter3.pin = r.pin AND shelter3.status ='D'
							LEFT JOIN mod_shelter shelter4 ON shelter4.pin = r.pin AND shelter4.status ='A'
							WHERE date_format(s.timelog, '%Y-%m') = '$bulan' AND r.pin ='". $pin ."'
							GROUP BY s.pin, MONTH(timelog) ORDER BY r.employee_name ASC
							";

					$Q		= $this->db->query($query);
					
					if ($Q->num_rows() > 0){
						foreach ($Q->result_array() as $row){
							$data[] = $row;
						}
					}

					return $data;


		    } elseif($role == 4) {

					if($employee_code == ""){

						$cuti = "<b style=color:white;background-color:green;padding:5px 8px 5px 8px;>C</b>";
						$this->db->simple_query("SET SESSION group_concat_max_len = 1000000");
						$query1 = "
							SELECT
								GROUP_CONCAT(
									CONCAT(
										\"GROUP_CONCAT(DISTINCT(CASE
										WHEN DATE_FORMAT(s.timelog, '%Y-%m-%d') = '\" ,dt, \"' THEN 'H'
										WHEN DATE_FORMAT(cuti.date_long, '%Y-%m-%d') = '\" ,dt, \"' THEN  'C'
										WHEN DATE_FORMAT(shelter2.date_shelter, '%Y-%m-%d') = '\" ,dt, \"' THEN  'S'
										WHEN DATE_FORMAT(shelter3.date_shelter, '%Y-%m-%d') = '\" ,dt, \"' THEN  'D'
										WHEN DATE_FORMAT(shelter4.date_shelter, '%Y-%m-%d') = '\" ,dt, \"' THEN  'A'
										ELSE NULL END)) AS '\",date_format(dt,'%d'),\"'\"
									)
								) arrsql

							FROM
							(
								SELECT DISTINCT(a.date) AS dt
								FROM mod_detail_shift a
								LEFT JOIN mod_employee r ON r.schedule = a.id
								WHERE date_format(a.date, '%Y-%m') = '$bulan'
								ORDER BY a.date
							) d
							";

						$Q1		= $this->db->query($query1);
						if ($Q1->num_rows() > 0){
							foreach ($Q1->result_array() as $row){
								$mysql[] = $row;
							}
						}


						$query = "
						SELECT  r.employee_name AS NAME, l.location_name AS LOCATION, d.department_name AS DIVISION,

							COUNT(Distinct date_format(s.timelog, '%Y-%m-%d')) As Hadir,

							(   SELECT count(mod_detail_annual_leave.jml) AS total
								FROM mod_detail_annual_leave
								LEFT JOIN mod_employee ON mod_detail_annual_leave.employee_code = mod_employee.employee_code
								WHERE mod_detail_annual_leave.employee_code IN (r.employee_code)
								AND DATE_FORMAT(mod_detail_annual_leave.date_start, '%Y-%m')='$bulan' AND DATE_FORMAT(mod_detail_annual_leave.date_end, '%Y-%m')='$bulan'
								AND mod_employee.parent = '". $kode ."'
							) as Cuti,

							(   SELECT count(mod_shelter.pin) AS sakit
								FROM mod_employee
								LEFT JOIN mod_shelter ON mod_employee.pin = mod_shelter.pin
								WHERE mod_shelter.pin IN (s.pin) AND mod_shelter.status ='S'
								AND DATE_FORMAT(mod_shelter.date_shelter, '%Y-%m')='$bulan' AND mod_employee.parent = '". $kode ."'
							) as Sakit,

							(   SELECT count(mod_shelter.pin) AS dinas
								FROM mod_employee
								LEFT JOIN mod_shelter ON mod_employee.pin = mod_shelter.pin
								WHERE mod_shelter.pin IN (s.pin) AND mod_shelter.status ='D'
								AND DATE_FORMAT(mod_shelter.date_shelter, '%Y-%m')='$bulan' AND mod_employee.parent = '". $kode ."'
							) as Dinas,

							(   SELECT count(mod_shelter.pin) AS alpha
								FROM mod_employee
								LEFT JOIN mod_shelter ON mod_employee.pin = mod_shelter.pin
								WHERE mod_shelter.pin IN (s.pin) AND mod_shelter.status ='A'
								AND DATE_FORMAT(mod_shelter.date_shelter, '%Y-%m')='$bulan' AND mod_employee.parent = '". $kode ."'
							) as Alpha,

							" . $mysql[0][arrsql] . "

								FROM mod_absen s

								LEFT JOIN mod_employee r ON r.pin = s.pin
								INNER JOIN mod_location l ON l.location_id = r.location
								INNER JOIN mod_department d ON d.department_code = r.department_code
								LEFT JOIN mod_detail_annual_leave cuti ON cuti.employee_code = r.employee_code
								LEFT JOIN mod_shelter shelter2 ON shelter2.pin = r.pin AND shelter2.status ='S'
								LEFT JOIN mod_shelter shelter3 ON shelter3.pin = r.pin AND shelter3.status ='D'
								LEFT JOIN mod_shelter shelter4 ON shelter4.pin = r.pin AND shelter4.status ='A'
								WHERE date_format(s.timelog, '%Y-%m') = '$bulan' AND r.department_code ='".$department_code."'
								GROUP BY s.pin, MONTH(timelog) ORDER BY r.employee_name ASC
								";
						// 		echo "<pre>";
						// var_dump($query);exit();
						$Q		= $this->db->query($query);

						if ($Q->num_rows() > 0){
							foreach ($Q->result_array() as $row){
								$data[] = $row;
							}
						}

						return $data;
					} else {
						//echo "Perorang";
						$cuti = "<b style=color:white;background-color:green;padding:5px 8px 5px 8px;>C</b>";
						$this->db->simple_query("SET SESSION group_concat_max_len = 1000000");
						$query1 = "
							SELECT
								GROUP_CONCAT(
									CONCAT(
										\"GROUP_CONCAT(DISTINCT(CASE
										WHEN DATE_FORMAT(s.timelog, '%Y-%m-%d') = '\" ,dt, \"' THEN 'H'
										WHEN DATE_FORMAT(cuti.date_long, '%Y-%m-%d') = '\" ,dt, \"' THEN  'C'
										WHEN DATE_FORMAT(shelter2.date_shelter, '%Y-%m-%d') = '\" ,dt, \"' THEN  'S'
										WHEN DATE_FORMAT(shelter3.date_shelter, '%Y-%m-%d') = '\" ,dt, \"' THEN  'D'
										WHEN DATE_FORMAT(shelter4.date_shelter, '%Y-%m-%d') = '\" ,dt, \"' THEN  'A'
										ELSE NULL END)) AS '\",date_format(dt,'%d'),\"'\"
									)
								) arrsql

							FROM
							(
								SELECT DISTINCT(a.date) AS dt
								FROM mod_detail_shift a
								LEFT JOIN mod_employee r ON r.schedule = a.id
								WHERE date_format(a.date, '%Y-%m') = '$bulan'
								ORDER BY a.date
							) d
							";

						$Q1		= $this->db->query($query1);
						if ($Q1->num_rows() > 0){
							foreach ($Q1->result_array() as $row){
								$mysql[] = $row;
							}
						}


						$query = "
						SELECT r.employee_name AS NAME, l.location_name AS LOCATION, d.department_name AS DIVISION,

							COUNT(Distinct date_format(s.timelog, '%Y-%m-%d')) As Hadir,

							(   SELECT count(mod_detail_annual_leave.jml) AS total
								FROM mod_detail_annual_leave
								LEFT JOIN mod_employee ON mod_detail_annual_leave.employee_code = mod_employee.employee_code
								WHERE mod_detail_annual_leave.employee_code IN (r.employee_code)
								AND DATE_FORMAT(mod_detail_annual_leave.date_start, '%Y-%m')='$bulan' AND DATE_FORMAT(mod_detail_annual_leave.date_end, '%Y-%m')='$bulan'
								AND mod_employee.employee_code ='". $employee_code ."'
							) as Cuti,

							(   SELECT count(mod_shelter.pin) AS sakit
								FROM mod_employee
								LEFT JOIN mod_shelter ON mod_employee.pin = mod_shelter.pin
								WHERE mod_shelter.pin IN (s.pin) AND mod_shelter.status ='S'
								AND DATE_FORMAT(mod_shelter.date_shelter, '%Y-%m')='$bulan' AND mod_employee.employee_code ='". $employee_code ."'
							) as Sakit,

							(   SELECT count(mod_shelter.pin) AS dinas
								FROM mod_employee
								LEFT JOIN mod_shelter ON mod_employee.pin = mod_shelter.pin
								WHERE mod_shelter.pin IN (s.pin) AND mod_shelter.status ='D'
								AND DATE_FORMAT(mod_shelter.date_shelter, '%Y-%m')='$bulan' AND mod_employee.employee_code ='". $employee_code ."'
							) as Dinas,

							(   SELECT count(mod_shelter.pin) AS alpha
								FROM mod_employee
								LEFT JOIN mod_shelter ON mod_employee.pin = mod_shelter.pin
								WHERE mod_shelter.pin IN (s.pin) AND mod_shelter.status ='A'
								AND DATE_FORMAT(mod_shelter.date_shelter, '%Y-%m')='$bulan' AND mod_employee.employee_code ='". $employee_code ."'
							) as Alpha,

							" . $mysql[0][arrsql] . "

								FROM mod_absen s

								LEFT JOIN mod_employee r ON r.pin = s.pin
								INNER JOIN mod_location l ON l.location_id = r.location
								INNER JOIN mod_department d ON d.department_code = r.department_code
								LEFT JOIN mod_detail_annual_leave cuti ON cuti.employee_code = r.employee_code
								LEFT JOIN mod_shelter shelter2 ON shelter2.pin = r.pin AND shelter2.status ='S'
								LEFT JOIN mod_shelter shelter3 ON shelter3.pin = r.pin AND shelter3.status ='D'
								LEFT JOIN mod_shelter shelter4 ON shelter4.pin = r.pin AND shelter4.status ='A'
								WHERE date_format(s.timelog, '%Y-%m') = '$bulan' AND r.employee_code ='". $employee_code ."'
								GROUP BY s.pin, MONTH(timelog) ORDER BY r.employee_name ASC
								";

						$Q		= $this->db->query($query);

						if ($Q->num_rows() > 0){
							foreach ($Q->result_array() as $row){
								$data[] = $row;
							}
						}

						return $data;
					}



		    } else {



					$cuti = "<b style=color:white;background-color:green;padding:5px 8px 5px 8px;>C</b>";
					$this->db->simple_query("SET SESSION group_concat_max_len = 1000000");
					$query1 = "
						SELECT
							GROUP_CONCAT(
								CONCAT(
									\"GROUP_CONCAT(DISTINCT(CASE
									WHEN DATE_FORMAT(s.timelog, '%Y-%m-%d') = '\" ,dt, \"' THEN 'H'
									WHEN DATE_FORMAT(cuti.date_long, '%Y-%m-%d') = '\" ,dt, \"' THEN  'C'
									WHEN DATE_FORMAT(shelter2.date_shelter, '%Y-%m-%d') = '\" ,dt, \"' THEN  'S'
									WHEN DATE_FORMAT(shelter3.date_shelter, '%Y-%m-%d') = '\" ,dt, \"' THEN  'D'
									WHEN DATE_FORMAT(shelter4.date_shelter, '%Y-%m-%d') = '\" ,dt, \"' THEN  'A'
									ELSE NULL END)) AS '\",date_format(dt,'%d'),\"'\"
								)
							) arrsql

						FROM
						(
							SELECT DISTINCT(a.date) AS dt
							FROM mod_detail_shift a
							LEFT JOIN mod_employee r ON r.schedule = a.id
							WHERE date_format(a.date, '%Y-%m') = '$bulan'
							ORDER BY a.date
						) d
						";

					$Q1		= $this->db->query($query1);
					if ($Q1->num_rows() > 0){
						foreach ($Q1->result_array() as $row){
							$mysql[] = $row;
						}
					}


					$query = "
					SELECT r.employee_name AS NAME, l.location_name AS LOCATION, d.department_name AS DIVISION,

						COUNT(Distinct date_format(s.timelog, '%Y-%m-%d')) As Hadir,

						(   SELECT count(mod_detail_annual_leave.jml) AS total
							FROM mod_detail_annual_leave
							LEFT JOIN mod_employee ON mod_detail_annual_leave.employee_code = mod_employee.employee_code
							WHERE mod_detail_annual_leave.employee_code IN (r.employee_code)
							AND DATE_FORMAT(mod_detail_annual_leave.date_start, '%Y-%m')='$bulan' AND DATE_FORMAT(mod_detail_annual_leave.date_end, '%Y-%m')='$bulan'
						) as Cuti,

						(   SELECT count(mod_shelter.pin) AS sakit
							FROM mod_employee
							LEFT JOIN mod_shelter ON mod_employee.pin = mod_shelter.pin
							WHERE mod_shelter.pin IN (s.pin) AND mod_shelter.status ='S'
							AND DATE_FORMAT(mod_shelter.date_shelter, '%Y-%m')='$bulan'
						) as Sakit,

						(   SELECT count(mod_shelter.pin) AS dinas
							FROM mod_employee
							LEFT JOIN mod_shelter ON mod_employee.pin = mod_shelter.pin
							WHERE mod_shelter.pin IN (s.pin) AND mod_shelter.status ='D'
							AND DATE_FORMAT(mod_shelter.date_shelter, '%Y-%m')='$bulan'
						) as Dinas,

						(   SELECT count(mod_shelter.pin) AS alpha
							FROM mod_employee
							LEFT JOIN mod_shelter ON mod_employee.pin = mod_shelter.pin
							WHERE mod_shelter.pin IN (s.pin) AND mod_shelter.status ='A'
							AND DATE_FORMAT(mod_shelter.date_shelter, '%Y-%m')='$bulan'
						) as Alpha,

						" . $mysql[0][arrsql] . "

							FROM mod_absen s

							LEFT JOIN mod_employee r ON r.pin = s.pin
							INNER JOIN mod_location l ON l.location_id = r.location
							INNER JOIN mod_department d ON d.department_code = r.department_code
							LEFT JOIN mod_detail_annual_leave cuti ON cuti.employee_code = r.employee_code
							LEFT JOIN mod_shelter shelter2 ON shelter2.pin = r.pin AND shelter2.status ='S'
							LEFT JOIN mod_shelter shelter3 ON shelter3.pin = r.pin AND shelter3.status ='D'
							LEFT JOIN mod_shelter shelter4 ON shelter4.pin = r.pin AND shelter4.status ='A'
							WHERE date_format(s.timelog, '%Y-%m') = '$bulan' ";

				if ($loc !="")
					{	
						$query 	.= "AND r.location ='$loc' ";
					}


				if ($shift !="")
					{ 
						$query 	.= "AND r.shift_code ='$shift'  ";
					}

				if ($div !="")
					{   
						$query 	.= "AND r.department_code ='$div' ";
					}

				$query 	          .= "GROUP BY s.pin, MONTH(timelog) ORDER BY r.employee_name ASC ";
				//echo "<pre>";var_dump($query);exit();
				$Q		= $this->db->query($query);
				if ($Q->num_rows() > 0){
					foreach ($Q->result_array() as $row){
						$data[] = $row;
					}
				}

				return $data;

		    }


		} else {

			redirect('login', 'refresh');

		}

	}


	public function get_cuti($item,$loc){


		$query2 = $this->db->query(" SELECT mod_detail_annual_leave.employee_code AS total_cuti
					FROM mod_detail_annual_leave
					INNER JOIN mod_employee ON mod_detail_annual_leave.employee_code = mod_employee.employee_code
					WHERE DATE_FORMAT(mod_detail_annual_leave.date_start, '%Y-%m')='$item' ");

		return $query2->num_rows();
	}


	public function hari_ini()
    {
    	$hari = date ("D");

		switch($hari){
			case 'Sun':
				$hari_ini = "Minggu";
			break;

			case 'Mon':
				$hari_ini = "Senin";
			break;

			case 'Tue':
				$hari_ini = "Selasa";
			break;

			case 'Wed':
				$hari_ini = "Rabu";
			break;

			case 'Thu':
				$hari_ini = "Kamis";
			break;

			case 'Fri':
				$hari_ini = "Jumat";
			break;

			case 'Sat':
				$hari_ini = "Sabtu";
			break;

			default:
				$hari_ini = "Tidak di ketahui";
			break;
		}

			return "$hari_ini";
    }

	function get_timesheet_1($item)
	{
		$tanggal = date("Y-m-d", strtotime($tgltimesheet2));
		$tahun =  date("Y", strtotime($tgltimesheet2));
		$bulan = date("m", strtotime($tgltimesheet2));
		$nbulan = date("m", strtotime($tgltimesheet2) - 1);

		$tgl_today = date($tgltimesheet2);
		$tgl1 = date('01', strtotime($tgltimesheet2));

		$tgl2 = date('t', strtotime($tgltimesheet2));

		$rangestart = $tahun . "-" . $bulan . "-" . $tgl1;
		$rangeend = $tahun . "-" . $bulan . "-" . $tgl2;
		//var_dump($rangestart);exit();
		$data			= array();

		$query		= "SELECT date_format(date, '%d') as date FROM mod_detail_shift WHERE date_format(date, '%Y-%m') = '$item'  ";
		//var_dump($rangestart);exit();
		// $query		.= "WHERE date BETWEEN '" . $rangestart ."' AND '" . $rangeend ."' ";
		// $query		.= "ORDER BY date";
		$Q		= $this->db->query($query);
		if ($Q->num_rows() > 0){
			foreach ($Q->result_array() as $row){
				$data[] = $row;
			}
		}
		return $data;
	}


	function get_timesheets_1($item)
	{
		$tanggal = date("Y-m-d", strtotime($tgltimesheet2));
		$tahun =  date("Y", strtotime($tgltimesheet2));
		$bulan = date("m", strtotime($tgltimesheet2));
		$nbulan = date("m", strtotime($tgltimesheet2) - 1);

		$tgl_today = date($tgltimesheet2);
		$tgl1 = date('01', strtotime($tgltimesheet2));

		$tgl2 = date('t', strtotime($tgltimesheet2));

		$rangestart = $tahun . "-" . $bulan . "-" . $tgl1;
		$rangeend = $tahun . "-" . $bulan . "-" . $tgl2;
		//var_dump($rangestart);exit();
		$data			= array();

		$query		= "SELECT date_format(date, '%d') as date FROM mod_detail_shift WHERE date_format(date, '%Y-%m') = '$item'  ";

		$Q		= $this->db->query($query);
		if ($Q->num_rows() > 0){
			foreach ($Q->result_array() as $row){
				$data[] = $row;
			}
		}
		return $data;
	}




	function get_timesheet_2()
	{

		$data		= array();
		$query		= "SELECT employee_name, pin FROM mod_employee ";

		$Q		= $this->db->query($query);
		if ($Q->num_rows() > 0){
			foreach ($Q->result_array() as $row){
				$data[] = $row;
			}
		}
		return $data;
	}


	function get_timesheet_3($i,$pin)
	{


		$data		= array();
		$query		= "SELECT a.pin, a.timelog FROM mod_absen a ";
		$query		.= "WHERE date_format(a.timelog, '%Y-%m') >='2020-08' AND a.pin='22' ";
		// echo "<pre>";
		// var_dump($query);
		// echo "</pre>";
		// exit();
		$Q		= $this->db->query($query);

		if ($Q->num_rows() > 0){
			foreach ($Q->result_array() as $row){
				$data[] = $row;
			}
		}
		return $data;
	}
}
?>
