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
                        <?php if($role_id !=10){ ?>
                        <div class="form-group">
                          <label for="exampleInputUsername1">Employee</label><br>
                          <select class="js-example-basic-single w-100" style="color:#000;" name="employee_code" id="employee_code">
                            <option value="">Select</option>
                            <?php $qSelect = $this->db->query("SELECT * FROM mod_employee ");
                              foreach ($qSelect->result_array() as $row){ ?>
                            <option value="<?php echo $row['employee_code']; ?>"><?php echo $row['employee_name']; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                        <?php } ?>
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
                          <a href="<?php echo base_url('admin/assets'); ?>" class="btn btn-light">Cancel</a>
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

        var date1         = $('#date1').val();
        var date2         = $('#date2').val();
        var employee_code = $('#employee_code').val();


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

        var arr         = [date1, date2];

        if (document.getElementById("jns1").checked == true) {
        
          var url      = "<?php echo base_url(); ?>admin/report/leave/rpt/?date1="+ date1 + "&date2=" + date2 + "&employee_code=" + employee_code;
                window.open(url,'_blank');

        } else {

          var url      = "<?php echo base_url(); ?>admin/report/leave/excel/?date1="+ date1 + "&date2=" + date2 + "&employee_code=" + employee_code;
                window.open(url,'_blank');
        }

    });
</script>