<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $title; ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <style type="text/css">
    @import url(http://fonts.googleapis.com/css?family=Calibri:400,300,700);

 body {
     background-color: #fff;
     font-family: 'Calibri', sans-serif !important
 }

.container{
    margin-top:100px;
}
.card {
       position: relative;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0px solid transparent;
    border-radius: 0px;
}
}

.card-body {
    -webkit-box-flex: 1;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    padding: 1.25rem;
}

.card .card-title {
    position: relative;
    font-weight: 600;
    margin-bottom: 10px;
}


.table {
    width: 100%;
    max-width: 100%;
    margin-bottom: 1rem;
    background-color: transparent;
}

* {
    outline: none;
}

.table th, .table thead th {
    font-weight: 500;
}


.table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #dee2e6;
}


.table th {
    padding: 1rem;
    vertical-align: top;
    border-top: 1px solid #dee2e6;
}


.table th, .table thead th {
    font-weight: 500;
}


th {
    text-align: inherit;
}


.m-b-20 {
    margin-bottom: 20px;
}


.customcheckbox {
    display: block;
    position: relative;
    padding-left: 24px;
    font-weight: 100;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 22px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}


.customcheckbox input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

.checkmark {
    position: absolute;
    top: -3px;
    left: 0;
    height: 20px;
    width: 20px;
    background-color: #CDCDCD;
    border-radius: 6px;
}


.customcheckbox input:checked ~ .checkmark {
    background-color: #2196BB;
}


.customcheckbox .checkmark:after {
    left: 8px;
    top: 4px;
    width: 5px;
    height: 10px;
    border: solid white;
    border-width: 0 3px 3px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
}
  </style>
</head>
<body>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
              <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">
                  </h3>
                </div>

                <?php
                  $originalDate1 = $_GET['date1'];
                  $newDate1 = date("d-m-Y", strtotime($originalDate1));

                  $originalDate2 = $_GET['date2'];
                  $newDate2 = date("d-m-Y", strtotime($originalDate2));
                ?>
                
              <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <?php foreach ($getReport as $key => $val) {} ?>
                  <h4 class="card-title"><?php echo $title; ?></h4>
                  <h5>Date: <?php echo $newDate1; ?>&nbsp; to &nbsp; <?php echo $newDate2; ?></h5>
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <tr>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Date</th>
                                <th>On Duty</th>
                                <th>Off Duty</th>
                                <th>Clock In</th>
                                <th>Clock Out</th>
                                <th>Early</th>
                                <th>Late</th>
                                <th>OT Time</th>
                                <th>Total OT</th>
                            </tr>
                        </tr>
                      </thead>
                      
                      <tbody>
                         
                         <?php

                              $tanggal_lahir  = strtotime($newDate1);
                              $sekarang    = time();
                              $diff   = $sekarang - $tanggal_lahir;
                              $day = floor($diff / (60 * 60 * 24));
                              $day;

                              $create1 = date_create($newDate1);
                              $format1 = date_format($create1, 'Y-m-d');

                              $create2 = date_create($newDate2);
                              $format2 = date_format($create2, 'Y-m-d');
                             // var_dump($format1);exit();

                              $n = $day;

                            ?>


                            <?php

                                $a  = date_format($create1, 'Y');
                                $b  = date_format($create1, 'm');
                                $c  = date_format($create1, 'd');

                                $month = $b;
                                $year = $a;

                                $start_date = $c."-".$month."-".$year;
                                $start_time = strtotime($start_date);

                                $end_time = strtotime("+1 month", $start_time);

                                for($i=$start_time; $i<$end_time; $i+=86400)
                                {
                                   $list[] = date('d-m-Y-D', $i);
                                }

                            ?>


                            <?php

                              foreach ($report as $key => $value)
                              {

                            ?>

                               <tr>
                                  <td><?php echo $value['employee_name']; ?></td>
                                  <td><?php echo $value['division_name']; ?></td>
                                  <td><?php echo $value['DATE']; ?></td>
                                  <td><?php echo $value['shift_in']; ?></td>
                                  <td><?php echo $value['shift_out']; ?></td>
                                  <td><?php echo $value['log_in']; ?></td>
                                  <td><?php echo $value['log_out']; ?></td>

                                  <?php
                                      $jam_tetap = $value['shift_in'];
                                      $jam_masuk = $value['log_in'];
                                      $datetime1 = strtotime($jam_tetap);
                                      $datetime2 = strtotime($jam_masuk);

                                      $interval  = abs($datetime1 - $datetime2);
                                      $minutes   = round($interval / 60);

                                      ?>
                                      <?php if($jam_masuk < '08:00:00'){ ?>
                                        <td style="background-color:green;color:#fff;">
                                        <?php $v = sprintf("%02d:%02d:00",   floor($minutes/60), $minutes%60); echo $v; ?>
                                        </td>

                                      <?php }else{ ?>

                                        <td>&nbsp;</td>

                                      <?php } ?>


                                  </td>

                                   <?php
                                            $jam_tetap = $value['shift_in'];
                                            $jam_masuk = $value['log_in'];
                                            $datetime1 = strtotime($jam_tetap);
                                            $datetime2 = strtotime($jam_masuk);
                                            $interval  = abs($datetime1 - $datetime2);
                                            $minutes   = round($interval / 60);

                                            if($jam_masuk > '08:30:00'){
                                            echo "<td style='background-color:red;color:#fff;'>";
                                            $v = sprintf("%02d:%02d:00",   floor($minutes/60), $minutes%60); echo $v;
                                            echo "</td>";
                                          }else{
                                            echo "<td></td>";
                                          }
                                    ?>


                                    <?php
                                          $jam_tetap = '18:00:00';
                                          $jam_pulang = $value['log_out'];
                                          $jam_masuk = $value['log_in'];
                                          $datetime11 = strtotime($jam_tetap);
                                          $datetime22 = strtotime($jam_pulang);

                                          $intervals  = abs($datetime22 - $datetime11);
                                          $minutess   = round($intervals / 60);

                                          if($jam_pulang > '19:00:00' AND $jam_masuk < '08:00:00'){
                                            echo "<td style='background-color:grey;color:#fff;'>";
                                            $vs = sprintf("%02d:%02d:00",   floor($minutess/60), $minutess%60); echo $vs;
                                            echo "</td>";
                                          }else{
                                            echo "<td></td>";
                                          }

                                    ?>
                                  <td>&nbsp;</td>
                              </tr>

                            <?php
                                }
                            ?>

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            
        </div>
    </div>
</div>
 
  
</body>
</html>
