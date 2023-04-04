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
                      <a href="#" style="background-color:#fff;color:#4B49AC;border:1px solid #4B49AC; " class="btn btn-light mr-2" data-toggle="modal" data-target="#ADDcertification">Add Certification</a>

                        <?php $this->apps->get_notification(); ?>
                        <table class="table">
                            <thead>
                              <tr>
                                  <th width="40%">Name</th>
                                  <th width="40%">Date expired</th>
                                  <th width="15%">Filename</th>
                                  <th>Edit</th>
                                  <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php $no = 0;foreach ($getsertifikat as $key) { $no++; ?>
                                  <tr>
                                    <td><?php echo $key['name']; ?></td>
                                    <td><?php echo $key['date_expired']; ?></td>
                                    <td><a href="<?php echo base_url()?>certificate/<?php echo $key['filename']; ?>" target="_blank"><?php echo $key['filename']; ?></a></td>
                                    
                                    <td>

                                      <a 
                                          href="javascript:;"
                                          data-doc_id="<?php echo $key['id_training'] ?>"
                                          data-doc_name="<?php echo $key['name']; ?>"
                                          data-doc_expired="<?php echo $key['date_expired']; ?>"
                                          data-doc_file="<?php echo $key['filename']; ?>"
                                          data-toggle="modal" data-target="#UPDcertification"
                                          class="btn btn-sm btn-info" style="background-color:#fff;color:#4B49AC;border:1px solid #4B49AC; ">update
                                      </a>
                                    </td>
                                    <td>
                                      <a href="<?php echo base_url(); ?>admin/employee/delete_certificate/<?php echo $key['id_training']; ?>" class="badge badge-info" style="background-color:#fff;color:#4B49AC;border:1px solid #4B49AC; ">delete</a>
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
  <div class="modal fade" id="ADDcertification" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="ADDcertification">
      <form action="<?php echo base_url('admin/employee/save_certificate'); ?>" method="post" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><b>Add Certificate</b></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
            <div class="form-group">
                <label for="exampleInputUsername1">Name</label>
                <input type="text" class="form-control" name="name"/>
                <input type="hidden" name="employee_code" value="<?php echo $this->uri->segment(4);?>">
            </div>
            <div class="form-group">
              <label>File</label><br>
              <input type="file" name="userfile" class="file-upload-default">
              <div class="input-group col-xs-12">
                <input type="text" class="form-control file-upload-info" id="file" name="userfile" placeholder="Upload File">
                <span class="input-group-append">
                  <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                </span>
              </div>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Date expired</label><br>
              <div id="date_certificate1" class="input-group date">
                  <input type="text" class="form-control" name="expired" id="expired">
                  <span class="input-group-addon input-group-append border-left">
                    <span class="ti-calendar input-group-text"></span>
                  </span>
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
  <!-- END Modal Document -->


  
 <!-- Start Edit Document Modal -->
  <div class="modal fade" id="UPDcertification" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="UPDcertification">
      <form id="submitcertificate">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><b>Update Certificate</b></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
            <div class="form-group">
                <label for="exampleInputUsername1">Name</label>
                <input type="hidden" class="form-control" name="doc_id" id="doc_id"/>
                <input type="text" class="form-control" name="doc_name" id="doc_name"/>
                <input type="hidden" name="employee_code" value="<?php echo $this->uri->segment(4);?>">
            </div>
            <div class="form-group">
              <label>File</label><br>
              <input type="text" id="doc_file" style="border:none;">
              <input type="file" name="userfile" class="file-upload-default">
              <div class="input-group col-xs-12">

                <input type="text" class="form-control file-upload-info" name="userfile" placeholder="Upload File">
                <span class="input-group-append">
                  <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                </span>
              </div>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Date expired</label><br>
              <div id="date_certificate2" class="input-group date">
                  <input type="text" class="form-control" name="doc_expired" id="doc_expired">
                  <span class="input-group-addon input-group-append border-left">
                    <span class="ti-calendar input-group-text"></span>
                  </span>
                </div>
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
  <!-- END Edit Modal Document -->
  <script src="<?php echo base_url() ?>assets/js/jquery.min.js"></script>
  <script>
     $(document).ready(function() {
        
         $('#UPDcertification').on('show.bs.modal', function (event) { 
             var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
             var modal          = $(this)
             var ID1 = div.data('doc_ins_sex');
             var ID2 = div.data('doc_maternit');
             var ID3 = div.data('doc_membership');

             modal.find("#doc_membership option[value='" + ID3 + "']").prop("selected", true).trigger('change'); 

             // Isi nilai pada field  append
             modal.find('#doc_id').attr("value",div.data('doc_id'));
             modal.find('#doc_name').attr("value",div.data('doc_name'));
             modal.find('#doc_expired').attr("value",div.data('doc_expired'));
             modal.find('#doc_file').attr("value",div.data('doc_file'));

             });


             $('#submitcertificate').submit(function(e){
                //Start Save
                e.preventDefault(); 
                     $.ajax({
                         url:"<?php echo base_url(); ?>admin/employee/update_certificate",
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