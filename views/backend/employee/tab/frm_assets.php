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
                      <a href="#" style="background-color:#fff;color:#4B49AC;border:1px solid #4B49AC; " class="btn btn-light mr-2" data-toggle="modal" data-target="#ADDasset">Add Assets</a>

                        <?php $this->apps->get_notification(); ?>
                        <table class="table">
                            <thead>
                              <tr>
                                  <th width="40%">Asset Code</th>
                                  <th width="40%">Asset Name</th>
                                  <th width="15%">Date of receipt</th>
                                  <th width="5%">Edit</th>
                                  <th width="5%">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php $no = 0;foreach ($getListAssets as $key) { $no++; ?>
                                  <tr>
                                    <td><?php echo $key['item_code']; ?></td>
                                      <td><?php echo $key['item_name']; ?></td>
                                      <td><?php echo $key['date_assets'];?></td>
                                    
                                    <td>

                                      <a 
                                          href="javascript:;"
                                          data-doc_assets_id="<?php echo $key['kodeassets'] ?>"
                                          data-doc_assets_code="<?php echo $key['item_code']; ?>"
                                          data-doc_assets_date="<?php echo $key['date_assets']; ?>"
                                          data-toggle="modal" data-target="#UPDassets"
                                          class="btn btn-sm btn-info" style="background-color:#fff;color:#4B49AC;border:1px solid #4B49AC; ">update
                                      </a>
                                    </td>
                                    <td>
                                      <a href="<?php echo base_url(); ?>admin/employee/delete_assets/<?php echo $key['kodeassets']; ?>" class="badge badge-info" style="background-color:#fff;color:#4B49AC;border:1px solid #4B49AC; ">delete</a>
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
  <div class="modal fade" id="ADDasset" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="ADDasset">
    <form action="<?php echo base_url('admin/employee/save_assets'); ?>" method="post" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <input type="hidden" name="ids" value="1">
          <h5 class="modal-title" id="exampleModalLabel"><b>Add Assets</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <!-- START <form> -->

              <div class="form-group">
                <label>Asset</label><br>
                <input type="hidden" name="employee_code" value="<?php echo $this->uri->segment(4);?>">
                <select class="js-example-basic-single w-100" name="item_code" id="item_code" style="width: 100%;">
                    <option value="">Select</option>
                    <?php foreach($getasset as $key => $list3){ ?>
                      <option value="<?php echo $list3['item_code'];?>"><?php echo $list3['item_name'];?></option>
                    <?php } ?>
                  </select>
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">Date</label><br>
                <div id="add_assets" class="input-group date">
                    <input type="text" class="form-control" name="date_assets" id="date_assets">
                    <span class="input-group-addon input-group-append border-left">
                      <span class="ti-calendar input-group-text"></span>
                    </span>
                  </div>
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
  <div class="modal fade" id="UPDassets" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="UPDassets">
    <form id="submites">
      <div class="modal-content">
        <div class="modal-header">
          <input type="hidden" name="ids" value="1">
          <h5 class="modal-title" id="exampleModalLabel"><b>Edit Assets</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
            <!-- START <form> -->

              <div class="form-group">
                <label>Asset</label><br>
                <input type="hidden" name="doc_assets_id" id="doc_assets_id">
                <input type="hidden" name="employee_code" id="employee_code" value="<?php echo $this->uri->segment(4);?>">
                <select class="js-example-basic-single w-100" name="doc_assets_code" id="doc_assets_code" style="width: 100%;">
                    <option value="">Select</option>
                    <?php foreach($getasset as $key => $list3){ ?>
                      <option value="<?php echo $list3['item_code'];?>"><?php echo $list3['item_name'];?></option>
                    <?php } ?>
                  </select>
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">Date</label><br>
                <div id="edit_assets" class="input-group date">
                    <input type="text" class="form-control" name="doc_assets_date" id="doc_assets_date">
                    <span class="input-group-addon input-group-append border-left">
                      <span class="ti-calendar input-group-text"></span>
                    </span>
                  </div>
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
        
         $('#UPDassets').on('show.bs.modal', function (event) { 
             var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
             var modal          = $(this)

             var ID = div.data('doc_assets_code');

             modal.find("#doc_assets_code option[value='" + ID + "']").prop("selected", true).trigger('change'); 

             // Isi nilai pada field  append
             modal.find('#doc_assets_id').attr("value",div.data('doc_assets_id'));
             modal.find('#doc_assets_date').attr("value",div.data('doc_assets_date'));

             });


             $('#submites').submit(function(e){ 
                //Start Save
                e.preventDefault(); 
                     $.ajax({
                         url:"<?php echo base_url(); ?>admin/employee/update_assets",
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