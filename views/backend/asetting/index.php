<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
              
              <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body"><?php $this->apps->get_notification(); ?>
                  <h4 class="card-title">List Of <?php echo $title; ?></h4>
                  <p class="card-description">

                    
                      <a href="<?php echo base_url('admin/attendance/add'); ?>" style="background-color:#fff;color:#4B49AC;border:1px solid #4B49AC; " class="btn btn-light mr-2">Add Shift</a>
                    
                  </p>
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                          <th width="30%">Shift Code</th>
                          <th width="50%">Shift Name</th>
                          <th width="10%">Status</th>
                          <th width="10%">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                         <?php foreach ($getdata as $key => $value) { ?>
                            <tr>
                              <td><?php echo $value['shift_code']; ?></td>
                              <td><?php echo $value['shift_name']; ?></td>
                              <td>
                                  <?php if($value['status'] == 1){ ?>
                                    <button type="button" class="btn btn-inverse-danger" style="height:30px;cursor: not-allowed;">not active</button>
                                  <?php }else{ ?>
                                    <button type="button" class="btn btn-inverse-success" style="height:30px;cursor: not-allowed;">active</button>
                                  <?php } ?>
                              </td>
                              <td align="center">
                                
                                    <a href="<?php echo base_url('admin/attendance/edit'); ?>/<?php echo $value['shift_code']; ?>" class="badge badge-info" style="background-color:#fff;color:#4B49AC;border:1px solid #4B49AC;">edit</a>
                                 
                                    <a href="<?php echo base_url('admin/attendance/delete/'); ?><?php echo $value['shift_code']; ?>" class="badge badge-info" style="background-color:#fff;color:#4B49AC;border:1px solid #4B49AC;" onclick="return confirm('Inactive. Are you sure?')">status</a>
                                  
                              </td>
                            </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">List Of Manual Attendance</h4>
                  
                  <form method="POST" action="<?php echo site_url(); ?>admin/attendance/save_manual" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Employee</label>
                      <input type="hidden" name="ids" value="1">
                      <select class="js-example-basic-single" style="color:#000;width: 100%;" name="pin" id="pin">
                        <option>select employee</option>
                        <?php $qSelect = $this->db->query("SELECT * FROM mod_employee WHERE dum !='1' AND mod_status_code !='ST004' AND mod_status_code !='ST005'");
                          foreach ($qSelect->result_array() as $row){ 
                        ?>
                        <option value="<?php echo $row['pin']; ?>"><?php echo $row['employee_name']; ?></option>
                        <?php } ?>
                      </select>
                    </div>

                    <div class="form-group" style="width: 300px;">
                        <label for="exampleInputEmail1">Type</label>
                        <select id="selectBox" name="status" class="form-control" onchange="changeFunc()">
                           <option name="status">select</option>
                           <option name="status" value="H">Absen Manual</option>
                           <option name="status" value="C">Cuti Manual</option>
                           <option name="status" value="S">Sakit</option>
                           <option name="status" value="D">Perjalanan Dinas/Luar Kota</option>
                           <option name="status" value="A">Alpha</option>
                        </select>
                    </div>

                    <div id="frm_date">
                        <div class="form-group" style="width: 300px;">
                          <label for="exampleInputEmail1">Date</label>
                          <input type="text" class="form-control" id="date2" name="tgl" value="<?php echo date("d-m-Y"); ?>" >
                        </div>
                      </div>

                      <div id="textboxes">
                          <div class="form-group" style="width: 270px;">
                              <label for="exampleInputEmail1">Clock In</label> <br>
                              <!-- <input type="text" name="shift_in" class="form-control" required=""> -->
                              <?php 
                                  $start = strtotime('12:00 AM');
                                  $end   = strtotime('11:59 PM');
                              ?>
                              <select name="shift_in" class="form-control select2">
                                  <?php 

                                  for($hours=0; $hours<24; $hours++) 
                                    for($mins=0; $mins<60; $mins+=5) 
                                        echo '<option>'.str_pad($hours,2,'0',STR_PAD_LEFT).':'.str_pad($mins,2,'0',STR_PAD_LEFT).'</option>';
                                  ?>
                              </select>
                            </div>

                            <div class="form-group" style="width: 200px;">
                              <label for="exampleInputEmail1">Clock Out</label><br>
                               <select name="shift_out" class="form-control select2">
                                  <?php 

                                  for($hours=0; $hours<24; $hours++) 
                                    for($mins=0; $mins<60; $mins+=5) 
                                        echo '<option>'.str_pad($hours,2,'0',STR_PAD_LEFT).':'.str_pad($mins,2,'0',STR_PAD_LEFT).'</option>';
                                  ?>
                              </select>
                            </div>
                      </div>

                      <div id="frm_manual">
                          <div class="form-group" style="width: 300px;">
                            <label for="exampleInputEmail1">Date start</label>
                            <input type="text" class="form-control" id="date_start" name="date_start" value="<?php echo date("d-m-Y"); ?>" >
                          </div>

                          <div class="form-group" style="width: 300px;">
                            <label for="exampleInputEmail1">Date end</label>
                            <input type="text" class="form-control" id="date_end" name="date_end" value="<?php echo date("d-m-Y"); ?>" >
                          </div>
                      </div>

                    <div class="form-group">
                      <label for="exampleInputUsername1">Description</label>
                      <input type="text" class="form-control" id="noted" name="noted" placeholder="Noted" required>
                    </div>

                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a href="<?php echo base_url('admin/attendance'); ?>" class="btn btn-light">Cancel</a>
                  </form>
                </div>
              </div>
            </div>
            
        </div>
    </div>
</div>

<script src="<?php echo base_url() ?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/jquery.js"></script>
<script type="text/javascript">

    $('#frm_manual').hide();
    $('#frm_date').hide();
    $('#textboxes').hide();

  function changeFunc() {
    var selectBox = document.getElementById("selectBox");
    var selectedValue = selectBox.options[selectBox.selectedIndex].value;

      if (selectedValue=="H"){
        $('#textboxes').show();
        $('#frm_date').show();
        $('#frm_manual').hide();
      }


      if (selectedValue=="C"){
        $('#frm_manual').show();
        $('#frm_date').hide();
        $('#textboxes').hide();
      } 

      if (selectedValue!="H" && selectedValue!="C") {
        $('#frm_manual').hide();
        $('#frm_date').show();
        $('#textboxes').hide();
      }
  }

  var timepicker = new TimePicker('time', {
    lang: 'en',
    theme: 'dark'
  });
  timepicker.on('change', function(evt) {
    
    var value = (evt.hour || '00') + ':' + (evt.minute || '00');
    evt.element.value = value;

  });


</script>








