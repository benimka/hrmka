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
                        <div class="form-group">
                          <label for="exampleInputEmail1">Periode</label><br>
                          <input type="text" name="datepicker" id="datepicker" class="form-control yearmonth1" placeholder="YYYY-MM" required="">
                        </div>

                        <div class="form-group">
                          <label for="exampleInputUsername1">Location</label><br>
                          <select class="js-example-basic-single w-100" style="color:#000;" name="location_id" id="location_id">
                            <option value="">Select</option>
                            <?php
                              if (count($locations)){
                                foreach($locations as $key => $list2s){
                            ?>
                              <option value="<?php echo $list2s['location_id'];?>"><?php echo $list2s['location_name'];?></option>
                            <?php
                                }
                              }
                            ?>
                          </select>
                        </div>

                        <div class="form-group">
                          <label for="exampleInputUsername1">Shift</label><br>
                          <select class="js-example-basic-single w-100" style="color:#000;" name="shift_code" id="shift_code">
                            <option value="">Select</option>
                            <?php
                              if (count($shift)){
                                foreach($shift as $key => $shifts){
                            ?>
                              <option value="<?php echo $shifts['shift_code'];?>"><?php echo $shifts['shift_name'];?></option>
                            <?php
                                }
                              }
                            ?>
                          </select>
                        </div>


                        <div class="form-group">
                          <label for="exampleInputUsername1">Department</label><br>
                          <select class="js-example-basic-single w-100" style="color:#000;" name="department_code" id="department_code">
                            <option value="">Select All</option>
                            <?php
                                  $query = $this->db->query("SELECT * FROM mod_department 
                                                             WHERE department_code !='TTK-DEV001'
                                                             AND  department_code !='PMKA-DEV001' 
                                                             AND  department_code !='PEN-DEV002' 
                                                             AND  department_code !='TTK-DEV007' 
                                                             AND  department_code !='PMKA-DEV001'  ");

                                    foreach ($query->result_array() as $val_dev){
                                ?>
                                  <option value="<?php echo $val_dev['department_code'];?>"><?php echo $val_dev['department_name'];?></option>
                                <?php
                                    }
                                ?>
                          </select>
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

        var bulan       = $('#datepicker').val();
        var loc         = $('#location_id').val();
        var shift       = $('#shift_code').val();
        var dep         = $('#department_code').val();

        if(bulan ==""){
          alert('Month is empty');
          $("#datepicker").focus();
          return false;
        }

        var arr         = [bulan, loc, shift, dep]; 

        if (document.getElementById("jns1").checked == true) {
        
          var url      = "<?php echo base_url(); ?>admin/report/timesheet/timesheet_rpt/?query="+ bulan + "&loc=" + loc + "&shift=" + shift + "&dep=" + dep;
                window.open(url,'_blank');

        } else {

          var url      = "<?php echo base_url(); ?>admin/report/timesheet/timesheet_excel/?query="+ bulan + "&loc=" + loc + "&shift=" + shift + "&dep=" + dep;
                window.open(url,'_blank');
        }

    });

    var dp=$(".datepicker").datepicker( {
      format: "yyyy-mm",
      startView: "months",
      minViewMode: "months"
  });
</script>