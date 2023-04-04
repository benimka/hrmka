<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
              
              <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body"><?php $this->apps->get_notification(); ?>
                  <h4 class="card-title"><?php echo $title; ?></h4>
                  <p class="card-description">

                    <?php foreach($actions as $action) { ?>
                      <?php if($action['module_path'] == 'add') { ?>
                      <button type="button" class="btn btn-light mr-2" data-toggle="modal" data-target="#frm_leave_setting" style="background-color:#fff;color:#4B49AC;border:1px solid #4B49AC; ">Add Leave Setting</button>
                      <?php } } ?>
                    
                  </p>
                  <div class="table-responsive">
                    <table id="listing-leaves" class="table">
                      <thead>
                        <tr>
                          <th width="20%">Date</th>
                          <th width="60%">Deskripsi</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                         <?php foreach ($getdata as $key => $value) { ?>
                            <tr>
                              <td><?php echo $value['tgl']; ?></td>
                              <td><?php if($value['type'] == "Bersama"){echo "Cuti Bersama";}else{echo "Holiday";} ?></td>
                              <td align="center">
                                <?php foreach ($actions as $modul){?>
                                  <?php if($modul['module_path']=='edit'){ ?>
                                    
                                      <a 
                                          href="javascript:;"
                                          data-doc_id="<?php echo $value['id'] ?>"
                                          data-doc_tgl="<?php echo $value['tgl']; ?>"
                                          data-doc_type="<?php echo $value['type']; ?>"
                                          data-doc_description="<?php echo $value['description']; ?>"
                                          data-toggle="modal" data-target="#UPDleave"
                                          class="badge badge-info" style="background-color:#fff;color:#4B49AC;border:1px solid #4B49AC; ">update
                                      </a>

                                  <?php } ?>

                                  <?php if($modul['module_path']=='delete'){ ?>
                                    <a href="<?php echo base_url('admin/leaves_setting/'); ?><?php echo $modul['module_path']; ?>/<?php echo $value['id']; ?>" class="badge badge-info" style="background-color:#fff;color:#4B49AC;border:1px solid #4B49AC; ">delete</a>
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
  <div class="modal fade" id="frm_leave_setting" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="frm_leave_setting">
    <form id="submit_edit" action="<?php echo base_url('admin/leaves_setting/save'); ?>" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <input type="hidden" name="ids" value="1">
          <h5 class="modal-title" id="exampleModalLabel"><b>Add Leave Setting </b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="form-group">
            <label for="exampleInputUsername1">Type</label>
            <select class="js-example-basic-single select2" style="color:#000;width: 100%;" name="type" id="type" required>
              <option value="">Select</option>
              <option value="Holiday">Holiday</option>
              <option value="Bersama">Cuti Bersama</option>
            </select>
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Description</label>
            <input type="text" class="form-control" id="description" name="description" placeholder="hari libur nasional">
          </div>

          <div class="form-group"> 
            <label for="exampleInputEmail1">Date</label>
            <div id="date_leave_setting1" class="input-group date">
                <input type="text" class="form-control" name="tgl" id="date" required>
                <span class="input-group-addon input-group-append border-left">
                  <span class="ti-calendar input-group-text"></span>
                </span>
              </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <div id="start_edit">
              <button class="btn btn-primary" type="submit" id="subloading">Add
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
    <form id="submits">
      <div class="modal-content">
        <div class="modal-header">
          <input type="hidden" name="ids" value="1">
          <h5 class="modal-title" id="exampleModalLabel"><b>Update Leave Setting </b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="form-group">
            <label for="exampleInputUsername1">Type</label>
            <input type="hidden" name="doc_id" id="doc_id">
            <select class="js-example-basic-single select2" style="color:#000;width: 100%;" name="doc_type" id="doc_type" selected>
              <option value="">Select</option>
              <option value="Holiday">Holiday</option>
              <option value="Bersama">Cuti Bersama</option>
            </select>
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Description</label>
            <input type="text" class="form-control" id="doc_description" name="doc_description" placeholder="hari libur nasional">
          </div>

          <div class="form-group"> 
            <label for="exampleInputEmail1">Date</label>
            <div id="date_leave_setting2" class="input-group date">
                <input type="text" class="form-control" name="doc_tgl" id="doc_tgl" required>
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
  <!-- END EDIT -->



<script src="<?php echo base_url() ?>assets/js/jquery.min.js"></script>
  <script>
     $(document).ready(function() {
        
         $('#UPDleave').on('show.bs.modal', function (event) { 
             var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
             var modal          = $(this)
             // var ID1 = div.data('doc_ins_sex');
             // var ID2 = div.data('doc_maternit');
             var ID3 = div.data('doc_type');

             modal.find("#doc_type option[value='" + ID3 + "']").prop("selected", true).trigger('change'); 

             // Isi nilai pada field  append
             modal.find('#doc_id').attr("value",div.data('doc_id'));
             modal.find('#doc_tgl').attr("value",div.data('doc_tgl'));
             modal.find('#doc_description').attr("value",div.data('doc_description'));

             });


             $('#submits').submit(function(e){
                //Start Save
                e.preventDefault(); 
                     $.ajax({
                         url:"<?php echo base_url(); ?>admin/leaves_setting/update",
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