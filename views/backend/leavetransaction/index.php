<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body"><?php $this->apps->get_notification(); ?>
                   <div class="table-responsives">
                      <div class="row">
                        <div class="col-lg-6 grid-margin grid-margin-lg-0">
                          <div class="card-body">
                            <h4 class="card-title"><?php echo $title; ?></h4>
                            <p>
                              
                            </p>
                          </div>
                        </div>

                        <?php foreach ($getdata as $key => $val_company) { }?>

                        <div class="col-lg-6 grid-margin grid-margin-lg-0">
                          <div class="card-body">
                            <h6 class="card-title">&nbsp;Filter Status:</h6>
                              <select class="js-example-basic-single" style="color:#000;width:100%" id="select_leave">
                                <option value="">Select</option>
                                <option value="<?php echo base_url('admin/leave_transaction/index?query=0')?>">Pending</option>
                                <option value="<?php echo base_url('admin/leave_transaction/index?query=1')?>" <?php if($filter == 1){echo "selected='selected'";} ?>>Approved</option>
                                <option value="<?php echo base_url('admin/leave_transaction/index?query=6')?>" <?php if($filter == 6){echo "selected='selected'";} ?>>Not Approved</option>
                                <option value="<?php echo base_url('admin/leave_transaction/index?query=9')?>" <?php if($filter == 9){echo "selected='selected'";} ?>>Cancel</option>
                              </select>
                           
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="spinner-border" role="status" id="loading" style="margin:-10px;display: none;"></div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="employee" class="table">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Description</th>
                          <th>Date Start</th>
                          <th>Date End</th>
                          <th>Status</th>
                          <th width="9%">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                         <?php foreach ($getdata as $key => $value) {?>
                            <tr>
                              <td>&nbsp;<?php echo $value['employee_name']; ?></td>
                              <td>&nbsp;<?php echo $value['annual_leave_description']; ?></td>
                              <td>&nbsp;<?php echo $value['date_start']; ?></td>
                              <td>&nbsp;<?php echo $value['date_end']; ?></td>
                              <td>
                                <?php if($value['approved'] == 0){ ?>
                                <button type="button" class="btn btn-inverse-warning" style="height:30px;cursor: not-allowed;">pending</button>
                                <?php }elseif($value['approved'] == 6){ ?>
                                <button type="button" class="btn btn-inverse-danger" style="height:30px;cursor: not-allowed;">not approved</button>
                                <?php }elseif($value['approved'] == 9){ ?>
                                <button type="button" class="btn btn-inverse-info" style="height:30px;cursor: not-allowed;">cancel</button>
                                <?php }else{ ?>
                                <button type="button" class="btn btn-inverse-success" style="height:30px;cursor: not-allowed;">approved</button>
                                <?php } ?>
                              </td>
                              <td>
                                <?php if($value['approved'] == 0){ ?>
                                <a 
                                    href="javascript:;"
                                    data-doc_annual_leave_code="<?php echo $value['annual_leave_code']; ?>"
                                    data-doc_type_cuty_id="<?php echo $value['type_cuty_id']; ?>"
                                    data-doc_email="<?php echo $value['email']; ?>"
                                    data-doc_company_name="<?php echo $value['company_name']; ?>"
                                    data-doc_employee_code="<?php echo $value['employee_code']; ?>"
                                    data-doc_employee_name="<?php echo $value['employee_name']; ?>"
                                    data-doc_type_cuty_name="<?php echo $value['type_cuty_name']; ?>"
                                    data-doc_date_start="<?php echo $value['date_start']; ?>"
                                    data-doc_date_end="<?php echo $value['date_end']; ?>"
                                    data-doc_jml="<?php echo $value['jml']; ?>"
                                    data-doc_annual_leave_description="<?php echo $value['annual_leave_description']; ?>"
                                    data-toggle="modal" data-target="#UPDview"
                                    class="badge badge-info" style="background-color:#fff;color:#4B49AC;border:1px solid #4B49AC; ">view
                                </a>
                              <?php }else{ ?>
                                <a href="#" class="btn btn-inverse-info" style="padding-top:7px;height:30px;cursor: not-allowed;background-color:#fff;color:#4B49AC;border:1px solid #4B49AC;">completed</a>
                              <?php } ?>
                              </td>
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


<!-- Start EDIT -->
  <div class="modal fade" id="UPDview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="UPDview">
    <form id="submit_edit" action="<?php echo base_url('admin/leave_transaction/save'); ?>" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <input type="hidden" name="ids" value="2">
          <h5 class="modal-title" id="exampleModalLabel"><b>Form Approved</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        
        <div class="modal-body">

              <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="hidden" name="doc_type_cuty_id" id="doc_type_cuty_id" class="form-control" readonly>
                <input type="hidden" name="doc_company_name" id="doc_company_name" class="form-control" readonly>
                <input type="hidden" name="doc_email" id="doc_email" class="form-control" readonly>
                <input type="text" name="doc_employee_name" id="doc_employee_name" class="form-control" readonly>
                <input type="hidden" name="doc_annual_leave_code" id="doc_annual_leave_code" class="form-control" readonly>
                <input type="hidden" name="doc_employee_code" id="doc_employee_code" class="form-control" readonly>
              </div>

              <?php

                $qselect_params = $this->db->query("SELECT params_cuti, params_cuti_last_year
                                 FROM mod_employee
                                 WHERE employee_code ='$employee_code' LIMIT 1 ");

                foreach ($qselect_params->result_array() as $row_params){}

                $sisa_cuti = $row_params['params_cuti'];
                $sisa_last = $row_params['params_cuti_last_year'];

                $total_cuti= $sisa_cuti+$sisa_last;

              ?>

              
              <div class="form-group">
                <label for="exampleInputEmail1">Type</label>
                <input type="text" class="form-control" name="doc_type_cuty_name" id="doc_type_cuty_name" readonly>
              </div>


              <div class="form-group">
                <label for="exampleInputEmail1">Total</label>
                <input type="text" class="form-control" name="doc_jml" id="doc_jml" readonly>
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">Date Start</label><br>
                <div id="" class="input-group date">
                    <input type="text" class="form-control" name="doc_date_start" id="doc_date_start" readonly>
                    <span class="input-group-addon input-group-append border-left">
                      <span class="ti-calendar input-group-text"></span>
                    </span>
                  </div>
              </div>

               <div class="form-group">
                <label for="exampleInputEmail1">Date End</label><br>
                <div id="" class="input-group date">
                    <input type="text" class="form-control" name="doc_date_end" id="doc_date_end" readonly>
                    <span class="input-group-addon input-group-append border-left">
                      <span class="ti-calendar input-group-text"></span>
                    </span>
                  </div>
              </div>

              <div class="form-group">
                <label for="exampleInputPassword1">Description</label>
                <input class="form-control" name="doc_annual_leave_description" id="doc_annual_leave_description" required="" readonly>
              </div>

              <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Process</label>
                      <div class="col-sm-3">
                        <div class="form-check">
                          <label class="form-check-label">
                            <input type="radio" class="form-check-input" id="approved" name="approved" value="1" checked="checked">
                            Approve
                          </label>
                        </div>
                      </div>

                      <div class="col-sm-4">
                        <div class="form-check">
                          <label class="form-check-label">
                            <input type="radio" class="form-check-input" id="approved" name="approved" value="6">
                            Not Approve
                          </label>
                        </div>
                      </div>

                      <div class="col-sm-2">
                        <div class="form-check">
                          <label class="form-check-label">
                            <input type="radio" class="form-check-input" id="approved" name="approved" value="9">
                            Cancel
                          </label>
                        </div>
                      </div>
                    </div>

              <div class="form-group" style="margin-top:-10px;">
                <label for="exampleInputPassword1">Note</label>
                <input class="form-control" name="note" id="note" required="">
              </div>

        </div>



        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <div id="start_edit">
              <button class="btn btn-primary" type="submit" id="subloading">Submit</button>
          </div>
          
        </div>
      </div>
    </form>
    </div>
  </div>
  <!-- END EDIT -->

<script src="<?php echo base_url() ?>assets/js/jquery.min.js"></script>
  <script>
     $(document).ready(function() {
        
         $('#UPDview').on('show.bs.modal', function (event) { 
             var div      = $(event.relatedTarget) // Tombol dimana modal di tampilkan
             var modal    = $(this)
             var ID3      = div.data('doc_type_cuty_id');
             modal.find("#doc_type_cuty_id option[value='" + ID3 + "']").prop("selected", true).trigger('change'); 

             // Isi nilai pada field  append
            // data-doc_annual_leave_code="<?php echo $value['annual_leave_code']; ?>"
            // data-doc_type_cuty_id="<?php echo $value['type_cuty_id']; ?>"
            // data-doc_date_start="<?php echo $value['date_start']; ?>"
            // data-doc_date_end="<?php echo $value['date_end']; ?>"
            // data-doc_annual_leave_description="<?php echo $value['annual_leave_description']; ?>"
             
             modal.find('#doc_annual_leave_code').attr("value",div.data('doc_annual_leave_code'));
             modal.find('#doc_type_cuty_id').attr("value",div.data('doc_type_cuty_id'));
             modal.find('#doc_company_name').attr("value",div.data('doc_company_name'));
             modal.find('#doc_email').attr("value",div.data('doc_email'));
             modal.find('#doc_type_cuty_name').attr("value",div.data('doc_type_cuty_name'));
             modal.find('#doc_employee_code').attr("value",div.data('doc_employee_code'));
             modal.find('#doc_employee_name').attr("value",div.data('doc_employee_name'));
             modal.find('#doc_jml').attr("value",div.data('doc_jml'));
             modal.find('#doc_date_start').attr("value",div.data('doc_date_start'));
             modal.find('#doc_date_end').attr("value",div.data('doc_date_end'));
             modal.find('#doc_annual_leave_description').attr("value",div.data('doc_annual_leave_description'));

             });


             $('#updated_leave').submit(function(e){
                //Start Save
                e.preventDefault(); 
                     $.ajax({
                         url:"<?php echo base_url(); ?>admin/myleave/save",
                         type:"post",
                         data:new FormData(this),
                         processData:false,
                         contentType:false,
                         // cache:false,
                         // async:false,
                         beforeSend: function() {
                            $("#loading").show();
                            $("#start").hide();
                            $("#end").show();
                          },
                          complete: function() { 
                            $("#loading").hide();
                            $("#start").show();
                            $("#end").hide();
                            
                          },
                         success: function(data){
                          SaveMyleave()
                          setInterval('location.reload()', 1000); 
                         }
                   
                     });
                     //End Save
                });

         });

     function redirect(Filters_company){
          window.location = Filters_company;
      }

      var selectElNew = document.getElementById('select_leave');
      
      selectElNew.onchange = function(){ 
          var Filters_company = this.value;
          redirect(Filters_company);
          
      };  

 </script>