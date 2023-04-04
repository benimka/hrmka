<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
              <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">
                  </h3>
                </div>
                <?php foreach ($getCommissaris as $key => $values) {} ?>
              <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">List Of Commissaris & Management <?php echo $values['company_name']; ?></h4>
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Title</th>
                          <th>Year</th>
                          <th>Expired</th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php foreach ($getCommissaris as $key => $value) { ?>
                          <tr>
                            <td><?php echo $value['commissaris_name']; ?></td>
                            <td><?php echo $value['commissaris_title']; ?></td>
                            <td><?php echo $value['commissaris_year']; ?></td>
                            <td><?php echo $value['commissaris_ex']; ?></td>
                          </tr>
                        <?php } ?>
                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
              <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <?php foreach ($getDocument as $key => $val) {} ?>
                  <h4 class="card-title">List Of Documents <?php echo $val['company_name']; ?></h4>
                  
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                          <th>Document Type</th>
                          <th>Document Name</th>
                          <th>Document Ext</th>
                          <th>Size (KB)</th>
                          <th>Upload</th>
                          <th>Expired</th>
                          <th>Year</th>
                          <th>Status</th>
                          <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                         <?php foreach ($getDocument as $key => $value) { ?>
                            <tr>
                            <td style="color:green;font-weight: bold;"><?php echo $value['type_name']; ?></td>
                            <td><?php echo $value['document_name']; ?></td>
                            <?php 
                                $exten = $value['document_upload'];
                                $file_extension = pathinfo($exten, PATHINFO_EXTENSION);
                                ?>
                            <td><i style="color:#000">(* .<?php echo $file_extension; ?> )</i></td>
                            
                            <td>
                             <?php echo number_format($value['document_size'],0); 

                              ?> 
                            </td>
                            <td><?php echo $value['document_date']; ?></td>
                            <td  style="color:red;"><?php echo $value['document_ex']; ?></td>
                            <td><?php echo $value['document_year']; ?></td>
                            <td>
                                <?php if($value['document_status']  == 1){ ?>
                                  <button type="button" class="btn btn-inverse-success" style="height:40px;">Active</button>
                                <?php }elseif($value['document_status']  == 2){ ?>
                                  <button type="button" class="btn btn-inverse-info" style="height:40px;">In active</button>
                                <?php }else{ ?>
                                  <button type="button" class="btn btn-inverse-danger" style="height:40px;">Expired</button>
                                <?php } ?>

                              </td>
                            <td>


                              <?php foreach($getRules as $moduleRules) { ?>
                                <?php if($moduleRules['module_name'] == 'Preview') { ?>


                                <?php if($file_extension != "pdf"){ ?>

                                  <a href="#" onclick="showWarningToast()" class="btn btn-inverse-info btn-sm" style="height:40px;padding-top: 12px;"><i class="ti-eye btn-icon-prepend" style="height:40%"></i>Preview</a>
                                &nbsp;


                                <?php }else{ ?>
                                <a href="<?php echo base_url()?>admin/view/preview/<?php echo $value['document_id']; ?>" class="btn btn-inverse-info btn-sm" style="height:40px;padding-top: 12px;" target="_blank"><i class="ti-eye btn-icon-prepend" style="height:40%"></i>Preview</a>
                                &nbsp;<?php } ?>

                                <?php }} ?>


                                <?php foreach($getRules as $moduleRules) { ?>
                                <?php if($moduleRules['module_name'] == 'Download') { ?>

                                <a 
                                  href="javascript:;"
                                  data-id="<?php echo $value['document_id']; ?>"
                                  data-com_id="<?php echo $value['company_id']; ?>"
                                  data-toggle="modal" data-target="#PoPup"
                                  class="btn btn-inverse-success btn-sm" style="height:40px;padding-top: 12px;"><i class="ti-download btn-icon-prepend" style="height:40%"></i>Download
                                </a>
                                &nbsp;
                                 <?php }} ?>


                                 <?php foreach($getRules as $moduleRules) { ?>
                                <?php if($moduleRules['module_name'] == 'Email') { ?>
                                <a 
                                  href="javascript:;"
                                  data-id="<?php echo $value['document_id']; ?>"
                                  data-com_id="<?php echo $value['company_id']; ?>"
                                  data-doc_name="<?php echo $value['document_name']; ?>"
                                  data-file="<?php echo $value['document_upload']; ?>"
                                  data-toggle="modal" data-target="#Email"
                                  class="btn btn-inverse-primary btn-sm" style="height:40px;padding-top: 12px;"><i class="ti-share btn-icon-prepend" style="height:40%"></i>Email
                                </a>
                                &nbsp;  
                                <?php }} ?>

                                <?php foreach($getRules as $moduleRules) { ?>
                                <?php if($moduleRules['module_name'] == 'Print') { ?>

                               <?php if($file_extension != "pdf"){ ?>
                                
                                  <a href="#" onclick="showWarningToast()" class="btn btn-outline-info btn-icon-text" style="height:40px;padding-top: 12px;"><i class="ti-printer btn-icon-prepend" style="height:40%"></i>Print</a>
                                &nbsp;


                                <?php }else{ ?>
                                <a href="<?php echo base_url()?>admin/view/preview/<?php echo $value['document_id']; ?>" class="btn btn-outline-info btn-icon-text" style="height:40px;padding-top: 12px;" target="_blank"><i class="ti-printer btn-icon-prepend" style="height:40%"></i>Print</a>
                                &nbsp;<?php } ?>

                                 <?php }} ?>

                                 <?php foreach($getRules as $moduleRules) { ?>
                                <?php if($moduleRules['module_name'] == 'Histories') { ?>

                               <a href="<?php echo base_url()?>admin/view/histories/<?php echo $value['document_id']; ?>" class="btn btn-inverse-info btn-sm" style="height:40px;padding-top: 12px;" target="_blank"><i class="ti-back-left btn-icon-prepend" style="height:40%"></i>Histories</a>



                                 <?php }} ?>
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


<!-- Document Modal Download-->
  <div class="modal fade" id="PoPup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form id="submited" name="contact-form">
      <div class="modal-content">
        <div class="modal-header">

          <h5 class="modal-title" id="exampleModalLabel"><b>Form Download</b></h5>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <input type="hidden" class="form-control" name="id" id="id" readonly>
        <input type="hidden" class="form-control" name="com_id" id="com_id" readonly>

        <div class="modal-body">
        <div class="form-group">
          <label for="exampleInputEmail1">Description</label>
          <input type="text" class="form-control" name="description" id="description" required>
        </div>

        </div>

        <div class="modal-footer">

          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button class="btn btn-primary" type="submit" id="subloading" name="subloading">Start Download
          
        </div>
      </div>
    </form>
    </div>
  </div>



  <!-- Document Modal Send to Email-->
  <div class="modal fade" id="Email" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form id="send_email" name="contact-form">
      <div class="modal-content">
        <div class="modal-header">

          <h5 class="modal-title" id="exampleModalLabel"><b>Send Document</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <input type="hidden" class="form-control" name="id" id="id" readonly>
        <input type="hidden" class="form-control" name="com_id" id="com_id" readonly>
        <div class="modal-body">
        <div class="form-group">
          <label for="exampleInputEmail1">To:</label>
          <input type="text" class="form-control" name="to_email" id="to_email" required>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Subject</label>
          <input type="text" class="form-control" name="doc_name" id="doc_name" readonly>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">File Attachment</label>
          <input type="text" name="file" id="file" class="form-control" readonly>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Description</label>
          <textarea class="form-control" id="desc" name="desc" required></textarea>
        </div>

        </div>
        <div class="modal-footer">

          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button class="btn btn-primary" type="submit" id="subloading" name="subloading">Send
          
        </div>
      </div>
    </form>
    </div>
  </div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>

<script>
     $(document).ready(function() {

         // Untuk sunting
         $('#PoPup').on('show.bs.modal', function (event) { 
             var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
             var modal          = $(this)

             modal.find('#id').attr("value",div.data('id'));
             modal.find('#com_id').attr("value",div.data('com_id'));
             modal.find('#description').attr("value",div.data('description'));
         });


          $('#Email').on('show.bs.modal', function (event) { 
             var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
             var modal          = $(this)

             modal.find('#id').attr("value",div.data('id'));
             modal.find('#com_id').attr("value",div.data('com_id'));
             modal.find('#doc_name').attr("value",div.data('doc_name'));
             modal.find('#file').attr("value",div.data('file'));
         });


         $('#PoPup').on('hidden.bs.modal', function (e) {

              $('#submited').find("input[type=text]").val("");
          })


        $('#submited').submit(function(e){  
            //Start Save
            e.preventDefault(); 
                var id       = $('#id').val();
                var des      = $("#description").val();
                
                var arr         = [id, des];
                var url      = "<?php echo base_url(); ?>admin/view/download/?id="+ id + "&des=" + des;
                window.open(url, "_self");

                var frm = $("#description").val();
                frm.reset();  
                
            });



        $('#send_email').submit(function(e){   
            //Start Send
            e.preventDefault(); 
                var id       = $('#id').val();
                var doc_name = $("#doc_name").val();
                var file     = $("#file").val();
                var to_email = $("#to_email").val();
                var desc     = $("#desc").val();
                
                var arr         = [id, doc_name, file]; 
                var url      = "<?php echo base_url(); ?>admin/view/send_toemail/?id="+ id + "&doc_name=" + doc_name + "&file="+ file + "&to_email=" + to_email + "&desc=" + desc ;
                showSendToast();
                window.open(url, "_self");

                var frm = $("#description").val();
                frm.reset();  
                
            });

      });



 </script>
