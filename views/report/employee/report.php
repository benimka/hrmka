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
                          <label for="exampleInputUsername1">Company</label><br>
                          <select class="js-example-basic-single w-100" style="color:#000;" name="company_code" id="company_code">
                            <option value="">Select</option>
                            <?php
                                $locations = $this->db->query("SELECT * FROM mod_company ");

                                  foreach ($locations->result_array() as $loc){
                              ?>
                                <option value="<?php echo $loc['company_code'];?>"><?php echo $loc['company_name'];?></option>
                              <?php
                                  }
                                
                              ?>
                          </select>
                        </div>


                        <div class="form-group">
                          <label for="exampleInputUsername1">Status</label><br>
                          <select class="js-example-basic-single w-100" style="color:#000;" name="status" id="status">
                            <option value="">Select</option>
                            <?php $qSelect = $this->db->query("SELECT * FROM mod_employee_status ");
                              foreach ($qSelect->result_array() as $row){ ?>
                            <option value="<?php echo $row['mod_status_code']; ?>"><?php echo $row['mod_status_name']; ?></option>
                            <?php } ?>
                          </select>
                        </div>


                        <div class="form-group">
                          <label for="exampleInputUsername1">Educational</label><br>
                          <select class="js-example-basic-single w-100" style="color:#000;" id="stage" name="stage">
                            <option value="all">All</option>
                            <option value="S3">S3</option>
                            <option value="S2">S2</option>
                            <option value="S1">S1</option>
                            <option value="D3">D3</option>
                            <option value="D1">D1</option>
                            <option value="SMA">SMA</option>
                            <option value="SMP">SMP</option>
                          </select>
                        </div>


                        <div class="form-group">
                          <label for="exampleInputUsername1">Age</label><br>
                          <select class="js-example-basic-single w-100" style="color:#000;" name="age" id="age">
                            <option value="all">All</option>
                            <option value="30">30-55</option>
                            <option value="20">20-29</option>
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

        var stage  = $('#stage').val();
        var age    = $('#age').val();
        var status = $('#status').val();
        var company_code = $('#company_code').val(); 


        if (document.getElementById('jns1').checked) {
            var jns1         = 1;
        } else {
            var jns1         = 0;
        }

        if (document.getElementById("jns1").checked == true) { 
        
          var url      = "<?php echo base_url(); ?>admin/report/employee/rpt/?stage=" + stage + "&age=" + age + "&status=" + status  + "&company_code=" + company_code;
                window.open(url,'_blank');

        } else {

          var url      = "<?php echo base_url(); ?>admin/report/employee/excel/?stage=" + stage + "&age=" + age + "&status=" + status  + "&company_code=" + company_code;
                window.open(url,'_blank');
        }

    });
</script>