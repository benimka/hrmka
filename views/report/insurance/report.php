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
                          <select class="form-control" style="color:#000;" name="company_code" id="company_code">
                            <option value="">Select</option>
                            <?php $qSelect = $this->db->query("SELECT * FROM mod_company ");
                              foreach ($qSelect->result_array() as $row){ ?>
                            <option value="<?php echo $row['company_code']; ?>"><?php echo $row['company_name']; ?></option>
                            <?php } ?>
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

        var company_code  = $('#company_code').val();

        if (document.getElementById("jns1").checked == true) {
        
          var url      = "<?php echo base_url(); ?>admin/report/insurance/rpt/?company="+ company_code;
                window.open(url,'_blank');

        } else {

          var url      = "<?php echo base_url(); ?>admin/report/insurance/excel/?company="+ company_code;
                window.open(url,'_blank');
        }

    });
</script>