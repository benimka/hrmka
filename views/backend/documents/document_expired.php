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
                      <h4 class="card-title">Document Report Active, Inactive, Expired Or will Expired</h4>
                            <br>
                            <div class="form-group row">

                              <div class="col-sm-3">
                                <div class="form-check">
                                  <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="doc_statuss" id="exp1" value="1" onchange="changeFunc1()" checked="">
                                    Active
                                  </label>
                                </div>
                              </div>

                              <div class="col-sm-3">
                                <div class="form-check">
                                  <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="doc_statuss" id="exp2" value="2" onchange="changeFunc2()">
                                    Inactive
                                  </label>
                                </div>
                              </div>

                              <div class="col-sm-3">
                                <div class="form-check">
                                  <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="doc_statuss" id="exp4" value="4" onchange="changeFunc4()">
                                    Will Expired
                                  </label>
                                </div>
                              </div>

                              <div class="col-sm-3">
                                <div class="form-check">
                                  <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="doc_statuss" id="exp3" value="3" onchange="changeFunc3()">
                                    Expired
                                  </label>
                                </div>
                              </div>
                              
                            </div>

                           <div id="rangeDates">
                            <div class="input-group input-daterange d-flex align-items-center">
                              <input type="text" class="form-control" id="editCom">
                              <div class="input-group-addon mx-4">to</div>
                              <input type="text" class="form-control" id="dateCom">
                            </div>
                          </div>
                          <br>

                          <div id="rangeDatesShow" style="display:none;margin-top:-10px;">
                          <?php
                            $params         = date('Y-m-d');
                            $enampuluh      = mktime(0,0,0,date("n"),date("j")+60,date("Y"));
                            $akhir          = date("Y-m-d", $enampuluh);
                          ?>
                            <i style="color:red;font-size:12px;">Document expired to 60 days!</i>
                            <div class="input-group input-daterange d-flex align-items-center">
                            <input type="text" class="form-control" id="editComs" value="<?php echo $params;?>" readonly>
                              <div class="input-group-addon mx-4">to</div>
                              <input type="text" class="form-control" id="dateComs" value="<?php echo $akhir;?>" readonly>
                            </div>
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
                        <button type="submit" class="btn btn-primary mr-2" id="btnReport2">Proccess</button>
                        <button type="submit" class="btn btn-primary mr-2" id="btnReports2" style="display:none;">Proccess</button>
                          <a href="<?php echo base_url('admin/view/document_expired'); ?>" class="btn btn-light">Cancel</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
        </div>
    </div>
</div>


<script>

    $('#rangeDates').hide();
    $('#rangeDatesShow').hide();
    $('#btnReport2').hide();
    $('#btnReports2').hide();

  function changeFunc1() {
    var selectBox = document.getElementById("exp1").checked == true; 
    var exp1        = $('#exp1').val(); 

      if (exp1==1){ 
        $('#rangeDates').show();
        $('#rangeDatesShow').hide();
        $('#btnReports2').hide();
        $('#btnReport2').show();
      }
  }


  function changeFunc2() {
    var selectBox = document.getElementById("exp2").checked == true; 
    var exp2        = $('#exp2').val(); 

      if (exp2==2){ 
        $('#rangeDates').show();
        $('#rangeDatesShow').hide();
        $('#btnReports2').hide();
        $('#btnReport2').show();
      }
  }


  function changeFunc3() {
    var selectBox = document.getElementById("exp3").checked == true; 
    var exp3        = $('#exp3').val(); 

      if (exp3==3){ 
        $('#rangeDates').show();
        $('#rangeDatesShow').hide();
        $('#btnReports2').hide();
        $('#btnReport2').show();
      }
  }


  function changeFunc4() {
    var selectBox = document.getElementById("exp4").checked == true; 
    var exp4       = $('#exp4').val(); 

      if (exp4==4){ 
        $('#rangeDates').hide();
        $('#rangeDatesShow').show();
        $('#btnReports2').show();
        $('#btnReport2').hide();
      }
  }

</script>