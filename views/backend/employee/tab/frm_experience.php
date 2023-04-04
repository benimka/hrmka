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
                      <a href="#" style="background-color:#fff;color:#4B49AC;border:1px solid #4B49AC; " class="btn btn-light mr-2" data-toggle="modal" data-target="#ADDExperience">Add Experience</a>

                        <?php $this->apps->get_notification(); ?>
                        <table class="table">
                            <thead>
                              <tr>
                                  <th width="40%">Company Name</th>
                                  <th width="40%">Start</th>
                                  <th width="15%">End</th>
                                  <th width="15%">Jobs</th>
                                  <th width="5%">Edit</th>
                                  <th width="5%">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php $no = 0;foreach ($getexperience as $key) { $no++; ?>
                                  <tr>
                                    <td><?php echo $key['company']; ?></td>
                                      <td><?php echo $key['start']; ?></td>
                                      <td><?php echo $key['end'];?></td>
                                      <td><?php echo $key['jobs'];?></td>
                                    
                                    <td>

                                      <a 
                                          href="javascript:;"
                                          data-doc_id="<?php echo $key['experience_id'] ?>"
                                          data-doc_company="<?php echo $key['company']; ?>"
                                          data-doc_start="<?php echo $key['start']; ?>"
                                          data-doc_end="<?php echo $key['end']; ?>"
                                          data-doc_jobs="<?php echo $key['jobs']; ?>"
                                          data-doc_desc="<?php echo $key['descriptions_experience']; ?>"
                                          data-toggle="modal" data-target="#UPDexperience"
                                          class="btn btn-sm btn-info" style="background-color:#fff;color:#4B49AC;border:1px solid #4B49AC; ">update
                                      </a>
                                    </td>
                                    <td>
                                      <a href="<?php echo base_url(); ?>admin/employee/delete_experience/<?php echo $key['experience_id']; ?>" class="badge badge-info" style="background-color:#fff;color:#4B49AC;border:1px solid #4B49AC; ">delete</a>
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
</div>


<!-- Start Document Modal -->
  <div class="modal fade" id="ADDExperience" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="ADDExperience">
    <form action="<?php echo base_url('admin/employee/save_experience'); ?>" method="post" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b>Add experience</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <!-- START <form> -->
              <div class="form-group">
                    <label for="exampleInputUsername1">Company</label>
                    <input type="text" class="form-control" name="company" />
                    <input type="hidden" name="employee_code" value="<?php echo $this->uri->segment(4);?>">
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">Start</label><br>
                <div id="date_starts" class="input-group date">
                    <input type="text" class="form-control" name="date_start" id="date_start">
                    <span class="input-group-addon input-group-append border-left">
                      <span class="ti-calendar input-group-text"></span>
                    </span>
                  </div>
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">End</label><br>
                <div id="date_ends" class="input-group date">
                    <input type="text" class="form-control" name="date_end" id="date_end">
                    <span class="input-group-addon input-group-append border-left">
                      <span class="ti-calendar input-group-text"></span>
                    </span>
                  </div>
              </div>

              <div class="form-group">
                  <label for="exampleInputUsername1">Jobs</label>
                  <input type="text" class="form-control" name="jobs"/>
              </div>

              <div class="form-group">
                  <label for="exampleInputUsername1">Descriptions</label>
                  <input type="text" class="form-control" name="descriptions_experience"/>
              </div>
              

          <!-- END </form> -->
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <div id="start_edit">
              <button class="btn btn-primary" type="submit" id="subloading">Save
          </div>
          
        </div>
      </div>
    </form>
    </div>
  </div>
  <!-- END Modal Document -->

 <!-- Start Edit Document Modal -->
  <div class="modal fade" id="UPDexperience" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="UPDexperience">
    <form id="submitex">
      <div class="modal-content">
        <div class="modal-header">
          <input type="hidden" name="ids" value="1">
          <h5 class="modal-title" id="exampleModalLabel"><b>Edit Experience</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
            <!-- START <form> -->
              <div class="form-group">
                    <label for="exampleInputUsername1">Company</label>
                    <input type="hidden" name="doc_id" id="doc_id">
                    <input type="text" class="form-control" name="doc_company" id="doc_company" />
                    <input type="hidden" name="employee_code" id="employee_code" value="<?php echo $this->uri->segment(4);?>">
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">Start</label><br>
                <div id="date_starts1" class="input-group date">
                    <input type="text" class="form-control" name="doc_start" id="doc_start">
                    <span class="input-group-addon input-group-append border-left">
                      <span class="ti-calendar input-group-text"></span>
                    </span>
                  </div>
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">End</label><br>
                <div id="date_ends1" class="input-group date">
                    <input type="text" class="form-control" name="doc_end" id="doc_end">
                    <span class="input-group-addon input-group-append border-left">
                      <span class="ti-calendar input-group-text"></span>
                    </span>
                  </div>
              </div>
  
              <div class="form-group">
                  <label for="exampleInputUsername1">Jobs</label>
                  <input type="text" class="form-control" name="doc_jobs" id="doc_jobs" />
              </div>

              <div class="form-group">
                  <label for="exampleInputUsername1">Descriptions</label>
                  <input type="text" class="form-control" name="doc_desc" id="doc_desc" />
              </div>
              

          <!-- END </form> -->
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <div id="start_edit">
              <button class="btn btn-primary" type="submit" id="subloading">Update
          </div>
          
        </div>
      </div>
    </form>
    </div>
  </div>
  <!-- END Edit Modal Document -->
  <script src="<?php echo base_url() ?>assets/js/jquery.min.js"></script>
  <script>
     $(document).ready(function() {
        
         $('#UPDexperience').on('show.bs.modal', function (event) { 
             var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
             var modal          = $(this)

             var ID = div.data('doc_assets_code');

             modal.find("#doc_assets_code option[value='" + ID + "']").prop("selected", true).trigger('change'); 

             // Isi nilai pada field  append
             modal.find('#doc_id').attr("value",div.data('doc_id'));
             modal.find('#doc_company').attr("value",div.data('doc_company'));
             modal.find('#doc_start').attr("value",div.data('doc_start'));
             modal.find('#doc_end').attr("value",div.data('doc_end'));
             modal.find('#doc_jobs').attr("value",div.data('doc_jobs'));
             modal.find('#doc_desc').attr("value",div.data('doc_desc'));

             });


             $('#submitex').submit(function(e){ 
                //Start Save
                e.preventDefault(); 
                     $.ajax({
                         url:"<?php echo base_url(); ?>admin/employee/update_experience",
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
                          showInfoToast()
                          setInterval('location.reload()', 1000); 
                         }
                   
                     });
                     //End Save
                });

         });
 </script>