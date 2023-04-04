<div class="row" style="margin-top: -20px;">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body"> 
         <div class="table-responsives">
            <div class="row">
              <div class="col-lg-12 grid-margin grid-margin-lg-0">
                <div class="card-body">
                  <div class="col-lg-12 grid-margin grid-margin-lg-0">
                    <div class="card-body">
                      <a href="#" style="background-color:#fff;color:#4B49AC;border:1px solid #4B49AC; " class="btn btn-light mr-2" data-toggle="modal" data-target="#modaInsurance">Add Insurance</a>

                        <?php $this->apps->get_notification(); ?>
                        <table class="table">
                            <thead>
                              <tr>
                                  <th>Name</th>
                                  <th>Membership</th>
                                  <th>Gender</th>
                                  <th>Date Oh Birth</th>
                                  <th>Maternit</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php $no = 0;foreach ($getinsurance as $key) { $no++; ?>
                                  <tr>
                                    <td><?php echo $key['insurance_name']; ?></td>
                                    <td><?php echo $key['membership']; ?></td>
                                    <td><?php echo $key['ins_sex']; ?></td>
                                    <td><?php echo $key['date_of_birth']; ?></td>
                                    <td><?php echo $key['maternit']; ?></td>
                                    <td>
                                      <a href="<?php echo base_url(); ?>admin/employee/delete_insurance/<?php echo $key['insurance_id']; ?>" class="badge badge-info" style="background-color:#fff;color:#4B49AC;border:1px solid #4B49AC; ">delete</a>
                                    </td>
                                    <td>

                                      <a 
                                          href="javascript:;"
                                          data-doc_insurance_id="<?php echo $key['insurance_id'] ?>"
                                          data-doc_employee_code="<?php echo $key['employee_code']; ?>"
                                          data-doc_insurance_name="<?php echo $key['insurance_name']; ?>"
                                          data-doc_membership="<?php echo $key['membership']; ?>"
                                          data-doc_date_of_birth="<?php echo $key['date_of_birth'] ?>"
                                          data-doc_ins_sex="<?php echo $key['ins_sex'] ?>"
                                          data-doc_maternit="<?php echo $key['maternit'] ?>"
                                          data-toggle="modal" data-target="#edit_insurance"
                                          class="btn btn-sm btn-info" style="background-color:#fff;color:#4B49AC;border:1px solid #4B49AC; ">update
                                      </a>
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
       </div>
    </div>

     <!-- Start Edit Insurance Modal -->
   <div class="modal fade" id="edit_insurance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">

    <form id="submit_updated">
      <div class="modal-content">
        <div class="modal-header">
          <input type="hidden" name="id" value="1">
          <h5 class="modal-title" id="exampleModalLabel"><b>Add Insurance</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="form-group">
              <label for="exampleInputUsername1">Name</label>
              <input type="hidden" name="doc_insurance_id" id="doc_insurance_id">
              <input type="text" class="form-control" name="doc_insurance_name" id="doc_insurance_name"/>
              <input type="hidden" name="doc_employee_code" id="doc_employee_code" value="<?php echo $this->uri->segment(4);?>">
          </div>
          <div class="form-group">
            <label>Membership</label><br>
            <select class="js-example-basic-single w-100" name="doc_membership" id="doc_membership"  style="width: 100%;" selected>
                <option value="">Select</option>
                <option value="EMPLOYEE">Employee</option>
                <option value="SPOUSE">Spouse</option>
                <option value="CHILD">Child</option>
               
              </select>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Date Of Birth</label><br>
            <div id="edit_ins" class="input-group date">
                <input type="text" class="form-control" name="doc_date_of_birth" id="doc_date_of_birth">
                <span class="input-group-addon input-group-append border-left">
                  <span class="ti-calendar input-group-text"></span>
                </span>
              </div>
          </div>

              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Gender</label>
                <div class="col-sm-3">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="doc_ins_sex" id="doc_ins_sex" value="M">
                      Male
                    </label>
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="doc_ins_sex" id="doc_ins_sex" value="F">
                      Female
                    </label>
                  </div>
                </div>

              </div>

              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Maternit</label>
                <div class="col-sm-3">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="doc_maternit" id="doc_maternit" value="YES">
                      Yes
                    </label>
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="doc_maternit" id="doc_maternit" value="NO">
                      No
                    </label>
                  </div>
                </div>

              </div>


        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <div id="start_edit">
              <button class="btn btn-primary" type="submit" id="subloading">Save</button>
          </div>
          
        </div>
      </div>
    </form>
    </div>
  </div>
  <!-- END Edit Modal Insurance -->
</div>


<!-- Start Insurance Modal -->
  <div class="modal fade" id="modaInsurance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <form action="<?php echo base_url('admin/employee/save_insurance'); ?>" method="post" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <input type="hidden" name="id" value="1">
          <h5 class="modal-title" id="exampleModalLabel"><b>Add Insurance</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="form-group">
              <label for="exampleInputUsername1">Name</label>
              <input type="text" class="form-control" name="insurance_name"/>
              <input type="hidden" name="employee_code" value="<?php echo $this->uri->segment(4);?>">
          </div>
          <div class="form-group">
            <label>Membership</label><br>
            <select class="js-example-basic-single w-100" name="membership" id="membership" style="width: 100%;">
                <option value="">Select</option>
                <option value="EMPLOYEE">Employee</option>
                <option value="SPOUSE">Spouse</option>
                <option value="CHILD">Child</option>
               
              </select>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Date Of Birth</label><br>
            <div id="date_ins" class="input-group date">
                <input type="text" class="form-control" name="date_of_birth" id="date_of_birth">
                <span class="input-group-addon input-group-append border-left">
                  <span class="ti-calendar input-group-text"></span>
                </span>
              </div>
          </div>

              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Gender</label>
                <div class="col-sm-3">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="ins_sex" id="ins_sex" value="M">
                      Male
                    </label>
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="ins_sex" id="ins_sex" value="F">
                      Female
                    </label>
                  </div>
                </div>

              </div>

              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Maternit</label>
                <div class="col-sm-3">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="maternit" id="maternit" value="YES">
                      Yes
                    </label>
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="maternit" id="maternit" value="NO">
                      No
                    </label>
                  </div>
                </div>

              </div>


        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <div id="start_edit">
              <button class="btn btn-primary" type="submit" id="subloading">Save</button>
          </div>
          
        </div>
      </div>
    </form>
    </div>
  </div>
  <!-- END Modal Insurance -->

  <script src="<?php echo base_url() ?>assets/js/jquery.min.js"></script>
  <script>
     $(document).ready(function() {

         $('#edit_insurance').on('show.bs.modal', function (event) { 
             var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
             var modal          = $(this)
             var ID1 = div.data('doc_ins_sex');
             var ID2 = div.data('doc_maternit');
             var ID3 = div.data('doc_membership');

             modal.find("#doc_membership option[value='" + ID3 + "']").prop("selected", true).trigger('change'); 

             // Isi nilai pada field  append
             modal.find('#doc_insurance_id').attr("value",div.data('doc_insurance_id'));
             modal.find('#doc_employee_code').attr("value",div.data('doc_employee_code'));
             modal.find('#doc_insurance_name').attr("value",div.data('doc_insurance_name'));
             modal.find('#doc_date_of_birth').attr("value",div.data('doc_date_of_birth'));
             modal.find('input[name="doc_ins_sex"][value="'+ID1+'"]').prop('checked',true);
             modal.find('input[name="doc_maternit"][value="'+ID2+'"]').prop('checked',true);

             });


             $('#submit_updated').submit(function(e){ 
                //Start Save
                e.preventDefault(); 
                     $.ajax({
                         url:"<?php echo base_url(); ?>admin/employee/update_insurance",
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
                          showSuccessToast()
                          setInterval('location.reload()', 1000); 
                         }
                   
                     });
                     //End Save
                });

         });
 </script>