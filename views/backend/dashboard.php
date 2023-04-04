<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css"> -->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/materialdesignicons.min.css">
<style type="text/css">
  

</style>
<div class="main-panel">
    <div class="content-wrapper">
        <?php $this->apps->get_notification(); ?>
          <div class="row">
            <div class="col-md-12 grid-margin transparent">

                <div class="row"> 
                    <?php 
                      $a =1; $b=2; if($a!= $b){
                    ?>
                    <div class="col-md-3 grid-margin">
                        <div class="card d-flex align-items-center"><p style="position: absolute;width: 100%;padding-left: 10px;padding-right: 10px;">
                          <marquee>
                            <?php foreach($birthday as $ulangtahun) {?>
                               <?php
                                   $bln1     = $ulangtahun['birth_date'];
                                   $sub_thn  = substr($bln1,5);
                                   $bln2     = date("m-d");

                                   $birthDt1 = date_create($bln1);
                                   $birthDt2 = date_format($birthDt1, "Y-m-d");
                                   $birthDt = new dateTime($birthDt2);


                                   $today = new DateTime('today');
                                   $y = $today->diff($birthDt)->y;


                                   if($sub_thn == $bln2){
                               ?>
                                <?php echo $ulangtahun['employee_name']; ?> &nbsp;&nbsp;&nbsp;&nbsp;
                                
                               <?php

                                    }
                                  }

                                ?>
                          </marquee>
                        </p>
                          <div class="card-body">
                            <div class="d-flex flex-row align-items-center text-center">
                              <i class=" text-facebook icon-md"></i>

                              <div class="ms-3">
                                <h6 class="text-twitter">Birthday</h6>
                                <button type="button" class="btn btn-outline-secondary btn-rounded btn-icon">
                                <i class="ti-gift"></i>                          
                                </button>
                                
                                <h6 class="text-twitter"></h6>
                                  &nbsp;<a href="" data-toggle="modal" data-target="#Birthday">view</a>

                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <?php } else {?>

                        <div class="col-md-3 grid-margin">
                        <div class="card d-flex align-items-center">
                          <div class="card-body">
                            <div class="d-flex flex-row align-items-center text-center">
                              <i class=" text-facebook icon-md"></i>

                              <div class="ms-3">
                                <h6 class="text-twitter">Birthday</h6>
                                <button type="button" class="btn btn-outline-secondary btn-rounded btn-icon">
                                <i class="ti-gift"></i>                          
                                </button>
                                
                                <h6 class="text-twitter"></h6>
                                  &nbsp;<a href="" data-toggle="modal" data-target="#Birthday">view</a>

                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <?php } ?>
                      <div class="col-md-3 grid-margin">
                        <div class="card d-flex align-items-center">
                          <div class="card-body">
                            <div class="d-flex flex-row align-items-center text-center">
                              <i class=" text-youtube icon-md"></i>
                              <div class="ms-3">
                                <h6 class="text-twitter">Employee</h6>
                                <p class="mt-2 text-muted card-text"></p>
                                <button type="button" class="btn btn-outline-secondary btn-rounded btn-icon">
                                <i class="ti-user"></i>                          
                                </button>
                                <h6 class="text-twitter"></h6>
                                  &nbsp;<a href="<?php echo base_url('admin/profile/'); ?>">view</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3 grid-margin">
                        <div class="card d-flex align-items-center">
                          <div class="card-body">
                            <div class="d-flex flex-row align-items-center text-center">
                              <i class=" text-twitter icon-md"></i>
                              <div class="ms-3">
                                <h6 class="text-twitter">Leave Balance</h6>
                                <p class="mt-2 text-muted card-text"></p>
                                <button type="button" class="btn btn-outline-secondary btn-rounded btn-icon">
                                <i class="ti-bar-chart-alt"></i>                          
                                </button>
                                <h6 class="text-twitter"></h6>
                                  &nbsp;<a href="<?php echo base_url('admin/myleave'); ?>">view (<?php echo $saldo;?>)</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      <div class="col-md-3 grid-margin">
                        <div class="card d-flex align-items-center">
                          <div class="card-body">
                            <div class="d-flex flex-row align-items-center text-center">
                              <i class=" text-twitter icon-md"></i>
                              <div class="ms-3">
                                <h6 class="text-twitter">Clock Out</h6>
                                <?php if($out > 0){ ?>
                                    <button type="button" class="btn btn-outline-secondary btn-rounded btn-icon" disabled style="cursor: not-allowed;">
                                  <i class="ti-unlock"></i>                          
                                  </button>
                                  <h6 class="text-twitter"></h6>
                                  <i style="font-size:14px;color:green">Attendance completed</i>
                                <?php }else{ ?>
                                <p class="mt-2 text-muted card-text"></p>
                                 <?php 
                                    $timestamp = date('H:i:s');
                                    $timeend   = '17:30:00';
                                    if ($timestamp < $timeend) {
                                   ?>
                                <button type="button" class="btn btn-outline-secondary btn-rounded btn-icon" data-toggle="modal" data-target="#Out">
                                <i class="ti-unlock"></i>                          
                                </button>
                                <?php } else { ?>
                                  <button type="button" class="btn btn-outline-secondary btn-rounded btn-icon">
                                  <i class="ti-unlock"></i>                          
                                  </button>
                                <?php } ?>
                                <h6 class="text-twitter"></h6>
                                  <i class="jam" style="font-size:14px;color:green"></i>
                                <?php } ?>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                </div>

                <div class="row">
                   <div class="col-lg-6 grid-margin stretch-card">
                      <div class="card">
                          <div class="card-body">
                            <h4 class="card-title">Leave Holiday <?php echo date('Y');?></h4>
                            <div class="table-responsive">
                              <table class="table table-striped" id="holiday">
                                <thead>
                                  <tr>
                                    <th>
                                    Description
                                    </th>
                                    <th>
                                      Leave Type
                                    </th>
                                    <th>
                                      Date
                                    </th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php foreach ($getholiday as $value) { ?>
                                    <tr>
                                      <td><?php echo $value['description']; ?></td>
                                      <td><?php echo $value['type']; ?></td>
                                      <td><?php echo $value['tgl_cuti']; ?></td>
                                    </tr>
                                  <?php } ?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                    </div>

                    <div class="col-lg-6 grid-margin stretch-card">
                      <div class="card">
                          <div class="card-body">
                            <h4 class="card-title">Company Announcements</h4>
                            <div class="table-responsive">
                              <table class="table table-striped" id="announcements">
                                <thead>
                                  <tr>
                                    <th>
                                    Company Announcements
                                    </th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php foreach ($getannouncements as $announcements) { ?>
                                   

                                    <tr>
                                      <?php if($announcements['url'] == NULL){?>
                                      <td><a href="<?php echo base_url() ?>document/<?php echo $announcements['fillename']; ?>" target="_blank" style="color:#212529;"><?php echo $announcements['name']; ?></a></td>
                                        <?php }else{ ?>   

                                       <td> 
                                          <a href="<?php echo $announcements['url']; ?>" class="product-title" target="_blank"><?php echo $announcements['name']; ?></a>
                                      </td>
                                      <?php } ?>
                                   </tr>
                                  <?php } ?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                   <div class="col-lg-12 grid-margin stretch-card">
                      <div class="card">
                          <div class="card-body">
                            <h4 class="card-title">Leave Today</h4>
                            <div class="table-responsive">
                              <table class="table table-striped">
                                <thead>
                                  <tr>
                                    <th>
                                    Name
                                    </th>
                                    <th>
                                      Leave Type
                                    </th>
                                    <th>
                                      Devision
                                    </th>
                                    <th>
                                      Date Start
                                    </th>
                                    <th>
                                      Date End
                                    </th>
                                    <th>
                                      Description
                                    </th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php foreach ($getcuti as $value) { ?>
                                    <tr>
                                      <td><?php echo $value['employee_name']; ?></td>
                                      <td><?php echo $value['type_cuty_name']; ?></td>
                                      <td><?php echo $value['division_name']; ?></td>
                                      <td><?php echo $value['date_start']; ?></td>
                                      <td><?php echo $value['date_end']; ?></td>
                                      <td><?php echo $value['annual_leave_description']; ?></td>
                                    </tr>
                                  <?php } ?>
                                 
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>

              </div>
             </div>   
            </div>

        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2022.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"><i class="ti-heart text-danger ml-1"></i></span>
          </div>
        </footer>
      </div>


      <div class="modal fade" id="Birthday" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            
              <div class="modal-content">
                <div class="modal-header">

                  <h5 class="modal-title" id="exampleModalLabel"><b>Birthday</b></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                
                <div class="modal-body">
                <table class="table">
                      <thead>
                        <tr>
                          <th width="80%">Name</th>
                          <th>Birthday</th>
                        </tr>
                      </thead>
                      <tbody>

                         <?php
                          $date = date("m-d");
                          foreach ($getdata as $key => $value) { 
                            
                          ?>
                      <tr>
                        <td><?php echo $value['employee_name'];?></td>
                        <?php if($value['datasama'] == $date) { ?>
                          <td><label class="badge badge-success" style="background-color:#fff;color:#57B657;border:1px solid #57B657; "><?php echo $value['bulan'];?>&nbsp;-&nbsp;<?php echo $value['tanggal'];?>&nbsp; <i class="ti-gift"></i></label></td>
                      <?php }else{ ?>
                        <td><label class="badge badge-warning" style="background-color:#fff;color:#FFC100;border:1px solid #FFC100; "><?php echo $value['bulan'];?>&nbsp;-&nbsp;<?php echo $value['tanggal'];?></label></td>
                      <?php } ?>
                     </tr>

                     <?php }?>
                      </tbody>
                    </table>
                </div>
              </div>
          </div>
        </div>


      <div class="modal fade" id="Out" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="submit">
              <div class="modal-content">
                <div class="modal-header">

                  <h5 class="modal-title" id="exampleModalLabel"><b>Clock Out</b></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                
                <div class="modal-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Description</label>
                  <input type="text" class="form-control" name="descriptions" id="descriptions" value="">
                </div>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  <div id="start_edit">
                      <button class="btn btn-primary" type="submit" id="subloading">Yes
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>


      <?php foreach($getCompany as $company) {} ?>

  

  <script>
  
      $('#submit').submit(function(e){ 

        var exp    = $('#descriptions').val();

            if(exp == "") {
              alert('Descriptions is empty');
              $("#descriptions").focus();
              return false;
            }

                e.preventDefault(); 
                 $.ajax({
                     url:"<?php echo base_url(); ?>dashboard/clock_out",
                     type:"post",
                     data:new FormData(this),
                     processData:false,
                     contentType:false,
                     // cache:false,
                     // async:false,
                     beforeSend: function() {
                        // $("#loading").show();
                        // $("#start").hide();
                        // $("#end").show();
                      },
                      complete: function() { 
                        // $("#loading").hide();
                        // $("#start").show();
                        // $("#end").hide();
                        
                      },
                     success: function(data){
                      showSuccessToast()
                      setInterval('location.reload()', 1000); 
                     }
               
                 });
      

        });

 </script>


       <script type="text/javascript">
        $(document).ready(function () {
              $('#holiday').DataTable({
                  scrollY: '500px',
                  scrollCollapse: true,
                  pagingType: 'full_numbers',
                  paging: true,
                  searching: true
              });

              $('#announcements').DataTable({
                  scrollY: '500px',
                  scrollCollapse: true,
                  pagingType: 'full_numbers',
                  paging: true,
                  searching: true
              });

              $('#Upload').DataTable({
                  scrollY: '250px',
                  scrollCollapse: true,
                  pagingType: 'full_numbers',
                  paging: false,
                  searching: false
              });


              $('#Download').DataTable({
                  scrollY: '250px',
                  scrollCollapse: true,
                  pagingType: 'full_numbers',
                  paging: false,
                  searching: false
              });
          });



          $('input[type="radio"]').click(function () {
            var inputValue = $(this).attr("value");
            if (inputValue != "3") {
              $("#ex_id").show();
            } else {
              $("#ex_id").hide();
            }
          });
                              
          
          function jam() {
            var time = new Date(),
                hours = time.getHours(),
                minutes = time.getMinutes(),
                seconds = time.getSeconds();
            document.querySelectorAll('.jam')[0].innerHTML = harold(hours) + ":" + harold(minutes) + ":" + harold(seconds);

            function harold(standIn) {
                if (standIn < 10) {
                  standIn = '0' + standIn
                }
                return standIn;
                }
            }
            setInterval(jam, 1000);
        </script>
      <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
      <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>



