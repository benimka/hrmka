<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
              <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"></h4>
                  <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title"><?php echo $title; ?></h4>
                        <div class="input-group input-daterange d-flex align-items-center">
                          <input type="text" class="form-control" id="date1">
                          <div class="input-group-addon mx-4">to</div>
                          <input type="text" class="form-control" id="date2">
                        </div>
                        <br>

                        <div class="form-group">
                          <label for="exampleInputUsername1">Device</label><br>
                          <select class="js-example-basic-single w-100" style="color:#000;" name="loc_fg" id="loc_fg">
                            <option value="">Select</option>
                            <?php
                                $locations = $this->db->query("SELECT * FROM mod_device ");

                                  foreach ($locations->result_array() as $loc){
                              ?>
                                <option value="<?php echo $loc['location_id'];?>"><?php echo $loc['device'];?></option>
                              <?php
                                  }
                                
                              ?>
                          </select>
                        </div>


                        <div class="form-group">
                          <label for="exampleInputUsername1">Employee</label><br>
                          <select class="js-example-basic-single w-100" style="color:#000;" name="pin" id="pin">
                            <option value="">Select</option>
                            <?php $qSelect = $this->db->query("SELECT * FROM mod_employee WHERE mod_status_code !='ST004' ");
                              foreach ($qSelect->result_array() as $row){ ?>
                            <option value="<?php echo $row['pin']; ?>"><?php echo $row['employee_name']; ?></option>
                            <?php } ?>
                          </select>
                        </div>


                        <div class="form-group">
                          <label for="exampleInputUsername1">Department</label><br>
                          <select class="js-example-basic-single w-100" style="color:#000;" name="department_code" id="department_code">
                            <option value="">Select</option>
                            <?php $qSelect = $this->db->query("SELECT * FROM mod_department ");
                              foreach ($qSelect->result_array() as $row){ ?>
                            <option value="<?php echo $row['department_code']; ?>"><?php echo $row['department_name']; ?></option>
                            <?php } ?>
                          </select>
                        </div>


                        <div class="form-group">
                          <label for="exampleInputUsername1">Location</label><br>
                          <select class="js-example-basic-single w-100" style="color:#000;" name="location_id" id="location_id">
                            <option value="">Select</option>
                            <?php $qSelect = $this->db->query("SELECT * FROM mod_location ");
                              foreach ($qSelect->result_array() as $row){ ?>
                            <option value="<?php echo $row['location_id']; ?>"><?php echo $row['location_name']; ?></option>
                            <?php } ?>
                          </select>
                        </div>

                        <div class="form-group">
                          <input type="checkbox" name="myCheck" id="check" checked> Download finger print
                        </div>

                        <div class="form-group row">
            
                          <div class="col-sm-3">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="doc_status" value="1" id="jns1" checked="">
                                Html
                              </label>
                            </div>
                          </div>

                          <div class="col-sm-3">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="doc_status" id="jns2" value="2">
                                Excel
                              </label>
                            </div>
                          </div>

                        </div>
                          <br>
                        <div class="input-group input-daterange d-flex align-items-center">
                          <button type="submit" class="btn btn-primary mr-2" id="proses">Proccess</button>
                          <a href="<?php echo base_url('dashboard'); ?>" class="btn btn-light">Cancel</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>


<script src="<?php echo base_url() ?>assets/js/jquery.js"></script>

<script type="text/javascript">
   $("#proses").click(function(){  

        var date1       = $('#date1').val();
        var date2       = $('#date2').val();
        var locfg       = $('#loc_fg').val();
        var pin         = $('#pin').val();
        var div         = $('#department_code').val();
        var loc         = $('#location_id').val();

        if(date1 == "") {
          alert('Date Start is empty');
          $("#date1").focus();
          return false;
        }

        if(date2 == "") {
          alert('Date End is empty');
          $("#date2").focus();
          return false;
        }

        if(date1 > date2){
          alert('Date incorect');
          $("#date1").focus();
          return false;
        } 

        if (document.getElementById('check').checked) {
            var check         = 1;
        } else {
            var check         = 0;
        }

        var arr         = [date1, date2, pin, check, locfg, div, loc];

        if (document.getElementById("jns1").checked == true) {
        
          var url      = "<?php echo base_url(); ?>admin/report/attendance/rpt/?date1="+ date1 + "&date2=" + date2 + "&pin=" + pin + "&check=" + check + "&div=" + div + "&loc=" + loc + "&locfg="+ locfg;
                window.open(url,'_blank');

        } else {

          var url      = "<?php echo base_url(); ?>admin/report/attendance/excel/?date1="+ date1 + "&date2=" + date2 + "&pin=" + pin + "&check=" + check + "&div=" + div + "&loc=" + loc + "&locfg="+ locfg;
                window.open(url,'_blank');
        }

    });
</script>