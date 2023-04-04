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
                      <a href="#" style="background-color:#fff;color:#4B49AC;border:1px solid #4B49AC; " class="btn btn-light mr-2" data-toggle="modal" data-target="#Document">Add Document</a>

                        <?php $this->apps->get_notification(); ?>
                        <table class="table">
                            <thead>
                              <tr>
                                  <th width="40%">Name</th>
                                  <th width="40%">Filename</th>
                                  <th width="15%">Date Expired</th>
                                  <th width="5%">Edit</th>
                                  <th width="5%">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php $no = 0;foreach ($getdokumen as $key) { $no++; ?>
                                  <tr>
                                    <td><?php echo $key['documents_name']; ?></td>
                                    <td><a href="<?php echo base_url()?>document/<?php echo $key['file_documents']; ?>" target="_blank"><?php echo $key['file_documents']; ?></a> </td>
                                    
                                    <td><?php echo $key['documents_expired']; ?></td>
                                    
                                    <td>

                              <a 
                                  href="javascript:;"
                                  data-doc_id="<?php echo $key['id'] ?>"
                                  data-doc_code="<?php echo $key['employee_code']; ?>"
                                  data-doc_name="<?php echo $key['documents_name']; ?>"
                                  data-doc_file="<?php echo $key['file_documents']; ?>"
                                  data-doc_expired="<?php echo $key['documents_expired'] ?>"
                                  data-toggle="modal" data-target="#edit_document"
                                  class="btn btn-sm btn-info" style="background-color:#fff;color:#4B49AC;border:1px solid #4B49AC; ">update
                              </a>
                                    </td>

                                    <td>
                                      <a href="<?php echo base_url(); ?>admin/employee/delete_doc/<?php echo $key['id']; ?>" class="badge badge-info" style="background-color:#fff;color:#4B49AC;border:1px solid #4B49AC; ">delete</a>
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
  <div class="modal fade" id="document" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <form action="<?php echo base_url('admin/employee/save_document'); ?>" method="post" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <input type="hidden" name="ids" value="1">
          <h5 class="modal-title" id="exampleModalLabel"><b>Upload Document</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="form-group">
              <label for="exampleInputUsername1">Document Name</label>
              <input type="text" class="form-control" name="documents_name"/>
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
            <div id="edit-document" class="input-group date">
                <input type="text" class="form-control" name="documents_expired" id="documents_expired">
                <span class="input-group-addon input-group-append border-left">
                  <span class="ti-calendar input-group-text"></span>
                </span>
              </div>
          </div>
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
  <div class="modal fade" id="edit_document" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <form id="submit">
      <div class="modal-content">
        <div class="modal-header">
          <input type="hidden" name="ids" value="1">
          <h5 class="modal-title" id="exampleModalLabel"><b>Upload Document</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="form-group">
              <label for="exampleInputUsername1">Document Name</label>
              <input type="text" class="form-control" name="documents_name" id="doc_name" />
              <input type="hidden" name="doc_id" id="doc_id">
              <input type="hidden" name="employee_code" id="doc_code">
          </div>
          <div class="form-group">
            <label>File</label><br>
            <input type="file" name="userfile" class="file-upload-default">
            <div class="input-group col-xs-12">
              <input type="text" class="form-control file-upload-info" id="doc_file" name="userfile" placeholder="Upload File" readonly>
              <span class="input-group-append">
                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
              </span>
            </div>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Date expired</label><br>
            <div id="editCom" class="input-group date">
                <input type="text" class="form-control" name="documents_expireds" id="doc_expired">
                <span class="input-group-addon input-group-append border-left">
                  <span class="ti-calendar input-group-text"></span>
                </span>
              </div>
          </div>
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
        
         $('#edit_document').on('show.bs.modal', function (event) { 
             var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
             var modal          = $(this)

             // Isi nilai pada field
             modal.find('#doc_id').attr("value",div.data('doc_id'));
             modal.find('#doc_code').attr("value",div.data('doc_code'));
             modal.find('#doc_name').attr("value",div.data('doc_name'));
             modal.find('#doc_file').attr("value",div.data('doc_file'));
             modal.find('#doc_expired').attr("value",div.data('doc_expired'));

             });


             $('#submit').submit(function(e){ 
                //Start Save
                e.preventDefault(); 
                     $.ajax({
                         url:"<?php echo base_url(); ?>admin/employee/edit_document",
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