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
                      <a href="#" style="background-color:#fff;color:#4B49AC;border:1px solid #4B49AC; " class="btn btn-light mr-2" data-toggle="modal" data-target="#ADDEducation">Add Education</a>

                        <?php $this->apps->get_notification(); ?>
                        <table class="table">
                            <thead>
                              <tr>
                                  <th width="40%">School Name</th>
                                  <th width="40%">Educational stage</th>
                                  <th width="15%">Start</th>
                                  <th width="15%">End</th>
                                  <th width="15%">Program studi</th>
                                  <th width="5%">Edit</th>
                                  <th width="5%">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php $no = 0;foreach ($geteducation as $key) { $no++; ?>
                                  <tr>
                                      <td><?php echo $key['education']; ?></td>
                                      <td><?php echo $key['stage']; ?></td>
                                      <td><?php echo $key['start']; ?></td>
                                      <td><?php echo $key['end'] ?></td>
                                      <td><?php echo $key['major']; ?></td>
                                    
                                    <td>

                                      <a 
                                          href="javascript:;"
                                          data-doc_id="<?php echo $key['education_id'] ?>"
                                          data-doc_edu="<?php echo $key['education']; ?>"
                                          data-doc_stage="<?php echo $key['stage']; ?>"
                                          data-doc_start="<?php echo $key['start']; ?>"
                                          data-doc_end="<?php echo $key['end']; ?>"
                                          data-doc_major="<?php echo $key['major']; ?>"
                                          data-doc_desc="<?php echo $key['description']; ?>"
                                          data-toggle="modal" data-target="#UPDEducation"
                                          class="btn btn-sm btn-info" style="background-color:#fff;color:#4B49AC;border:1px solid #4B49AC; ">update
                                      </a>
                                    </td>
                                    <td>
                                      <a href="<?php echo base_url(); ?>admin/employee/delete_education/<?php echo $key['education_id']; ?>" class="badge badge-info" style="background-color:#fff;color:#4B49AC;border:1px solid #4B49AC; ">delete</a>
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
  <div class="modal fade" id="ADDEducation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="ADDEducation">
    <form action="<?php echo base_url('admin/employee/save_education'); ?>" method="post" enctype="multipart/form-data">
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
                    <label for="exampleInputUsername1">School name</label>
                    <input type="text" class="form-control" name="education" />
                    <input type="hidden" name="employee_code" value="<?php echo $this->uri->segment(4);?>">
              </div>


              <div class="form-group">
                <label>Educational stage</label><br>
                <select class="js-example-basic-single w-100" name="stage" id="stage" style="width: 100%;">
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
                <label for="exampleInputEmail1">Start</label><br>
                <input type="text" name="start" class="form-control year1" placeholder="YYYY" required="">
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">End</label><br>
                <input type="text" name="end" class="form-control year2" placeholder="YYYY" required="">
              </div>

              <div class="form-group">
                  <label for="exampleInputUsername1">Program study</label>
                  <input type="text" class="form-control" name="major"/>
              </div>

              <div class="form-group">
                  <label for="exampleInputUsername1">Descriptions</label>
                  <input type="text" class="form-control" name="description"/>
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
  <div class="modal fade" id="UPDEducation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="UPDEducation">
    <form id="submited">
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
                    <label for="exampleInputUsername1">School name</label>
                     <input type="hidden" name="doc_id" id="doc_id">
                    <input type="text" class="form-control" name="doc_edu" id="doc_edu" />
                    <input type="hidden" name="employee_code" value="<?php echo $this->uri->segment(4);?>">
              </div>


              <div class="form-group">
                <label>Educational stage</label><br>
                <select class="js-example-basic-single w-100" name="doc_stage" id="doc_stage" style="width: 100%;">
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
                <label for="exampleInputEmail1">Start</label><br>
                <input type="text" name="doc_start" id="doc_start" class="form-control year1" placeholder="YYYY" required="">
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">End</label><br>
                <input type="text" name="doc_end" id="doc_end" class="form-control year2" placeholder="YYYY" required="">
              </div>

              <div class="form-group">
                  <label for="exampleInputUsername1">Program study</label>
                  <input type="text" class="form-control" name="doc_major" id="doc_major" />
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
        
         $('#UPDEducation').on('show.bs.modal', function (event) { 
             var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
             var modal          = $(this)

             var ID = div.data('doc_stage');

             modal.find("#doc_stage option[value='" + ID + "']").prop("selected", true).trigger('change'); 

             // Isi nilai pada field  append
             modal.find('#doc_id').attr("value",div.data('doc_id'));
             modal.find('#doc_edu').attr("value",div.data('doc_edu'));
             modal.find('#doc_start').attr("value",div.data('doc_start'));
             modal.find('#doc_end').attr("value",div.data('doc_end'));
             modal.find('#doc_major').attr("value",div.data('doc_major'));
             modal.find('#doc_desc').attr("value",div.data('doc_desc'));

             });


             $('#submited').submit(function(e){ 
                //Start Save
                e.preventDefault(); 
                     $.ajax({
                         url:"<?php echo base_url(); ?>admin/employee/update_education",
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