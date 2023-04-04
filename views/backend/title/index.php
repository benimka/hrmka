<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
              
              <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body"> <?php $this->apps->get_notification(); ?>
                  <h4 class="card-title">List Of Title</h4>
                  <p class="card-description">

                    <?php foreach($actions as $action) { ?>
                    <?php if($action['module_path'] == 'add') { ?>
                    <button type="button" class="btn btn-light mr-2" data-toggle="modal" data-target="#AddTipe" style="background-color:#fff;color:#4B49AC;border:1px solid #4B49AC; ">Add Title</button>
                    <?php } } ?>
                  </p>
                  <div class="table-responsive">
                    <table id="mod_status" class="table">
                      <thead>
                        <tr>
                          <th>Title Name</th>
                          <th width="9%">Tools</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php foreach ($getdata as $key => $value) {?>
                            <tr>
                              <td>&nbsp;<?php echo $value['level_name']; ?></td>
                              <td>
                                <?php foreach ($actions as $modul){?>
                                  <?php if($modul['module_path']=='edit'){ ?>
                                    
                                      <a 
                                          href="javascript:;"
                                          data-doc_level="<?php echo $value['level']; ?>"
                                          data-doc_level_name="<?php echo $value['level_name']; ?>"
                                          data-toggle="modal" data-target="#UPDstatus"
                                          class="badge badge-info" style="background-color:#fff;color:#4B49AC;border:1px solid #4B49AC; ">update
                                      </a>

                                  <?php } ?>

                                  <?php if($modul['module_path']=='delete'){ ?>
                                    <a href="<?php echo base_url('admin/title/'); ?><?php echo $modul['module_path']; ?>/<?php echo $value['level']; ?>" class="badge badge-info" style="background-color:#fff;color:#4B49AC;border:1px solid #4B49AC; ">delete</a>
                                  <?php } ?>


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
    <form id="submit_edit" action="<?php echo base_url('admin/title/save'); ?>" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <input type="hidden" name="ids" value="1">
          <h5 class="modal-title" id="exampleModalLabel"><b>Add Title </b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">

          <div class="form-group">
            <label for="exampleInputEmail1">Title Name</label>
            <input type="text" class="form-control" id="level_name" name="level_name"/>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <div id="start_edit">
              <button class="btn btn-primary" type="submit" id="subloading">Save</button>
          </div>
          
        </div>
      </div>
      </div>
    </form>
    </div>
  </div>
  <!-- END ADD -->

<!-- Start EDIT -->
  <div class="modal fade" id="UPDstatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="UPDstatus">
    <form id="submit_status">
      <div class="modal-content">
        <div class="modal-header">
          <input type="hidden" name="ids" value="2">
          <h5 class="modal-title" id="exampleModalLabel"><b>Update Title</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">

          <div class="form-group">
            <input type="hidden" name="doc_level" id="doc_level">
            <label for="exampleInputEmail1">Title Name</label>
            <input type="text" class="form-control" id="doc_level_name" name="doc_level_name">
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
        
         $('#UPDstatus').on('show.bs.modal', function (event) { 
             var div      = $(event.relatedTarget) // Tombol dimana modal di tampilkan
             var modal    = $(this)
             var ID3      = div.data('doc_department_code');
             modal.find("#doc_department_code option[value='" + ID3 + "']").prop("selected", true).trigger('change'); 

             // Isi nilai pada field  append
             modal.find('#doc_level').attr("value",div.data('doc_level'));
             modal.find('#doc_level_name').attr("value",div.data('doc_level_name'));

             });


             $('#submit_status').submit(function(e){
                //Start Save
                e.preventDefault(); 
                     $.ajax({
                         url:"<?php echo base_url(); ?>admin/title/save",
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