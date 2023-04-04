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

        var date1         = $('#date1').val();
        var date2         = $('#date2').val();
        var company_code  = $('#company_code').val();


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
        
          var url      = "<?php echo base_url(); ?>admin/report/viewlog/rpt/?date1="+ date1 + "&date2=" + date2;
                window.open(url,'_blank');

        } else {

          var url      = "<?php echo base_url(); ?>admin/report/viewlog/excel/?date1="+ date1 + "&date2=" + date2;
                window.open(url,'_blank');
        }

    });
</script>