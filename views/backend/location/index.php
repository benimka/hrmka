<div class="main-panel">
    <div class="content-wrapper">
      

        <div class="row">
              
              <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body"> <?php $this->apps->get_notification(); ?>
                  <h4 class="card-title">List Of Location</h4>


                  <p class="card-description">
                    <?php foreach($actions as $action) { ?>
                      <?php if($action['module_path'] == 'add') { ?>
                      <button type="button" class="btn btn-light mr-2" data-toggle="modal" data-target="#AddTipe" style="background-color:#fff;color:#4B49AC;border:1px solid #4B49AC; ">Add Location</button>
                      <?php } } ?>
                    
                  </p>
                  <div class="table-responsive">
                    <table id="sublisting" class="table">
                      <thead>
                        <tr>
                          <th width="95%">Location</th>
                          <?php foreach ($actions as $modul){?>
                              <?php if($modul['module_path']=='edit'){ ?>
                          <th>Actions</th>
                          <?php } } ?>
                        </tr>
                      </thead>
                      <tbody>
                          <?php foreach ($getdata as $key => $value) { ?>
                            <tr>
                              <td><?php echo $value['location_name']; ?></td>
                              <td>
                                <?php foreach ($actions as $modul){?>
                                  <?php if($modul['module_path']=='edit'){ ?>
                                    
                                      <a 
                                          href="javascript:;"
                                          data-doc_id="<?php echo $value['location_id'] ?>"
                                          data-doc_name="<?php echo $value['location_name']; ?>"
                                          data-doc_inisial="<?php echo $value['inisial']; ?>"
                                          data-toggle="modal" data-target="#UPDleave"
                                          class="badge badge-info" style="background-color:#fff;color:#4B49AC;border:1px solid #4B49AC; ">update
                                      </a>

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
    <form id="submit_edit" action="<?php echo base_url('admin/location/save'); ?>" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <input type="hidden" name="ids" value="1">
          <h5 class="modal-title" id="exampleModalLabel"><b>Add Location </b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">

          <div class="form-group">
            <label for="exampleInputEmail1">Location Name</label>
            <input type="text" class="form-control" id="doc_name" name="doc_name" required>
          </div>

          <!-- <div class="form-group">
            <label for="exampleInputEmail1">Initial</label>
            <input type="text" class="form-control" id="doc_inisial" name="doc_inisial" placeholder="JGL, KMG">
          </div> -->

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <div id="start_edit">
              <button class="btn btn-primary" type="submit" id="subloading">Update</button>
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
    <form id="submited">
      <div class="modal-content">
        <div class="modal-header">
          <input type="hidden" name="ids" value="2">
          <h5 class="modal-title" id="exampleModalLabel"><b>Update Location </b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">

          <div class="form-group">
            <input type="hidden" name="doc_id" id="doc_id">
            <label for="exampleInputEmail1">Location Name</label>
            <input type="text" class="form-control" id="doc_name" name="doc_name" >
          </div>

          <!-- <div class="form-group">
            <label for="exampleInputEmail1">Description</label>
            <input type="text" class="form-control" id="doc_inisial" name="doc_inisial" >
          </div> -->

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
             modal.find('#doc_name').attr("value",div.data('doc_name'));
             modal.find('#doc_inisial').attr("value",div.data('doc_inisial'));

             });


             $('#submited').submit(function(e){ 
                //Start Save
                e.preventDefault(); 
                     $.ajax({
                         url:"<?php echo base_url(); ?>admin/location/save",
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