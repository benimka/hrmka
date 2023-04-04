<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body"> <?php $this->apps->get_notification(); ?>
                  <h4 class="card-title">List Of Myleave</h4>
                  <p>
                  <button type="button" class="btn btn-light mr-2" data-toggle="modal" data-target="#AddTipe" style="background-color:#fff;color:#4B49AC;border:1px solid #4B49AC; ">Add Leave</button>
                  </p>
                  <div class="table-responsive">
                    <table id="cuti" class="table">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Type</th>
                          <th>Description</th>
                          <th>Date Start</th>
                          <th>Date End</th>
                          <th>Status</th>
                          <th width="9%">Update</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php foreach ($getdata as $key => $value) {?>
                            <tr>
                              <td>&nbsp;<?php echo $value['employee_name']; ?></td>
                              <td>&nbsp;<?php echo $value['type_cuty_name']; ?></td>
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
                                    data-doc_date_start="<?php echo $value['date_start']; ?>"
                                    data-doc_date_end="<?php echo $value['date_end']; ?>"
                                    data-doc_annual_leave_description="<?php echo $value['annual_leave_description']; ?>"
                                    data-toggle="modal" data-target="#UPDleave"
                                    class="badge badge-info" style="background-color:#fff;color:#4B49AC;border:1px solid #4B49AC; ">update
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

<!-- Start ADD -->
  <div class="modal fade" id="AddTipe" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="AddTipe">
    <form id="submit_edit" action="<?php echo base_url('admin/myleave/save'); ?>" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <input type="hidden" name="ids" value="1">
          <h5 class="modal-title" id="exampleModalLabel"><b>Add Leave </b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">

              <?php 

              $autos = $user_id.$auto;

              ?>

              <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="text" name="emails" class="form-control" value="<?php echo $user_name; ?>" readonly>
                <input type="hidden" name="name_employee" class="form-control" value="<?php echo $name; ?>" readonly>
                <input type="hidden" name="annual_leave_code" class="form-control" value="<?php echo $autos; ?>" readonly>
                <input type="hidden" name="employee_code" class="form-control" value="<?php echo $employee_code; ?>" readonly>
              </div>

               <?php

                $qselect_params = $this->db->query("SELECT params_cuti, params_cuti_last_year, advance_total
                                 FROM mod_employee
                                 WHERE employee_code ='$employee_code' LIMIT 1 ");

                foreach ($qselect_params->result_array() as $row_params){}

                $sisa_cuti = $row_params['params_cuti'];
                $sisa_last = $row_params['params_cuti_last_year'];
                $advance   = $row_params['advance_total'];

                $total     = $sisa_cuti+$sisa_last;

                if($total <=0){
                  $total_cuti= $advance;
                } else {
                  $total_cuti= $sisa_cuti+$sisa_last;
                }

              ?>

              <div class="form-group">
                  <label for="exampleInputEmail1">Type</label>
                  <select class="js-example-basic-single w-100" name="type_cuty_id" id="type_cuty_id" style="width: 100%;">
                    <option value="" required="">Select</option>

                    <?php 
                    if($total <=0){
                        $qSelectType = $this->db->query("SELECT * FROM mod_type_cuty ");
                    } else {
                        $qSelectType = $this->db->query("SELECT * FROM mod_type_cuty WHERE type_cuty_id != 1 ");
                    }
                    
                    foreach ($qSelectType->result_array() as $value) {?>

                      <option value="<?php echo $value['type_cuty_id']; ?>" required=""><?php echo $value['type_cuty_name']; ?>&nbsp;

                        <?php if($value['type_cuty_id'] == 3){ ?>
                          (3 bulan)
                        <?php }else{ ?>

                         (<?php echo $value['type_cuty_jml']; ?>)</option>

                       <?php } ?>
                    <?php } ?>
                </select>
                </div>


              <div class="form-group">
                <label for="exampleInputEmail1">Saldo</label>
                <?php 

                if($total <=0){
                  $total_cuti= $advance;

                ?>

                <input type="text" name="balances" class="form-control" value="<?php echo $total_cuti; ?>" readonly>
                <input type="hidden" name="balance" class="form-control" value="<?php echo $total_cuti; ?>" readonly>

                <?php
                } else {
                  $total_cuti= $sisa_cuti+$sisa_last;
                ?>
                <input type="text" name="balances" class="form-control" value="<?php echo $total_cuti; ?>" readonly>
                <input type="hidden" name="balance" class="form-control" value="<?php echo $total_cuti; ?>" readonly>
                <?php
                  }
                ?>
                
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">Date Start</label><br>
                <div id="dateLeaveStart" class="input-group date">
                    <input type="text" class="form-control" name="date_start" id="date_start" value="<?php echo date("Y-m-d"); ?>">
                    <span class="input-group-addon input-group-append border-left">
                      <span class="ti-calendar input-group-text"></span>
                    </span>
                  </div>
              </div>

               <div class="form-group">
                <label for="exampleInputEmail1">Date End</label><br>
                <div id="dateLeaveEnd" class="input-group date">
                    <input type="text" class="form-control" name="date_end" id="date_end" value="<?php echo date("Y-m-d"); ?>">
                    <span class="input-group-addon input-group-append border-left">
                      <span class="ti-calendar input-group-text"></span>
                    </span>
                  </div>
              </div>

              <div class="form-group">
                <label for="exampleInputPassword1">Description</label>
                <textarea class="form-control" name="annual_leave_description" required=""></textarea>
              </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <div id="start_edit">
              <button class="btn btn-primary" type="submit" id="subloading">Submit</button>
          </div>
          
        </div>
      </div>
      </div>
    </form>
    </div>
  </div>
  <!-- END ADD -->

<!-- Start EDIT -->
  <div class="modal fade" id="UPDleave" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="UPDleave">
    <form id="submit_edit" action="<?php echo base_url('admin/myleave/save'); ?>" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <input type="hidden" name="ids" value="2">
          <h5 class="modal-title" id="exampleModalLabel"><b>Update Leave</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        
        <div class="modal-body">

              <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="text" name="emails" class="form-control" value="<?php echo $user_name; ?>" readonly>
                <input type="hidden" name="name_employee" class="form-control" value="<?php echo $name; ?>" readonly>
                <input type="hidden" name="doc_annual_leave_code" id="doc_annual_leave_code" class="form-control" readonly>
                <input type="hidden" name="employee_code" class="form-control" value="<?php echo $employee_code; ?>" readonly>
              </div>

              <?php

                $qselect_params = $this->db->query("SELECT params_cuti, params_cuti_last_year, advance_total
                                 FROM mod_employee
                                 WHERE employee_code ='$employee_code' LIMIT 1 ");

                foreach ($qselect_params->result_array() as $row_params){}

                $sisa_cuti = $row_params['params_cuti'];
                $sisa_last = $row_params['params_cuti_last_year'];
                $advance   = $row_params['advance_total'];

                $total     = $sisa_cuti+$sisa_last;

                if($total <=0){
                  $total_cuti= $advance;
                } else {
                  $total_cuti= $sisa_cuti+$sisa_last;
                }

              ?>

              <div class="form-group">
                  <label for="exampleInputEmail1">Type</label>
                  <select class="js-example-basic-single w-100" name="doc_type_cuty_id" id="doc_type_cuty_id" style="width: 100%;" selected>
                    <option value="" required="">Select</option>
                    <?php 

                    if($total <=0){
                        $qSelectType = $this->db->query("SELECT * FROM mod_type_cuty ");
                    } else {
                        $qSelectType = $this->db->query("SELECT * FROM mod_type_cuty WHERE type_cuty_id != 1 ");
                    }
                    
                    foreach ($qSelectType->result_array() as $value) {?>

                      <option value="<?php echo $value['type_cuty_id']; ?>" required=""><?php echo $value['type_cuty_name']; ?>&nbsp;

                        <?php if($value['type_cuty_id'] == 14){ ?>
                          (3 bulan)
                        <?php }else{ ?>

                         (<?php echo $value['type_cuty_jml']; ?>)</option>

                       <?php } ?>
                    <?php } ?>
                </select>
                </div>


              <div class="form-group">
                <label for="exampleInputEmail1">Saldo</label>
                <!-- <input type="text" name="balance" class="form-control" value="<?php echo $total_cuti; ?>" readonly> -->

                <?php 

                if($total <=0){
                  $total_cuti= $advance;

                ?>

                <input type="text" name="balances" class="form-control" value="<?php echo $total_cuti; ?> Advance" readonly>
                <input type="hidden" name="balance" class="form-control" value="<?php echo $total_cuti; ?>" readonly>

                <?php
                } else {
                  $total_cuti= $sisa_cuti+$sisa_last;
                ?>
                <input type="text" name="balances" class="form-control" value="<?php echo $total_cuti; ?> Tahunan" readonly>
                <input type="hidden" name="balance" class="form-control" value="<?php echo $total_cuti; ?>" readonly>
                <?php
                  }
                ?>
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">Date Start</label><br>
                <div id="EditLeaveStart" class="input-group date">
                    <input type="text" class="form-control" name="doc_date_start" id="doc_date_start">
                    <span class="input-group-addon input-group-append border-left">
                      <span class="ti-calendar input-group-text"></span>
                    </span>
                  </div>
              </div>

               <div class="form-group">
                <label for="exampleInputEmail1">Date End</label><br>
                <div id="EditLeaveEnd" class="input-group date">
                    <input type="text" class="form-control" name="doc_date_end" id="doc_date_end">
                    <span class="input-group-addon input-group-append border-left">
                      <span class="ti-calendar input-group-text"></span>
                    </span>
                  </div>
              </div>

              <div class="form-group">
                <label for="exampleInputPassword1">Description</label>
                <input class="form-control" name="doc_annual_leave_description" id="doc_annual_leave_description" required="">
              </div>

        </div>



        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <div id="start_edit">
              <button class="btn btn-primary" type="submit" id="subloading">Update</button>
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
        
         $('#UPDleave').on('show.bs.modal', function (event) { 
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

      var selectElNew = document.getElementById('select_filters_company');
      
      selectElNew.onchange = function(){ 
          var Filters_company = this.value;
          redirect(Filters_company);
          
      };  

 </script>