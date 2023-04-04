<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
              
              <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body"><?php $this->apps->get_notification(); ?>
                  <h4 class="card-title">List Of Roles</h4>
                  <p class="card-description">
                    <button type="button" class="btn btn-light mr-2" data-toggle="modal" data-target="#Roles">
                      Add Roles
                    </button>
                  </p>
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                          <th width="30%">Role Name</th>
                          <th width="50%">Role Description</th>
                          <th width="20%">Status</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                         <?php foreach ($getdata as $key => $value) { ?>
                            <tr>
                              <td><?php echo $value['role_name']; ?></td>
                              <td><?php echo $value['role_description']; ?></td>
                              <td>
                                <?php if($value['role_status']  == 1){ ?>
                                  <button type="button" class="btn btn-inverse-success" style="height:40px;">active</button>
                                <?php }else{ ?>
                                  <button type="button" class="btn btn-inverse-danger" style="height:40px;">in active</button>
                                <?php } ?>

                              </td>
                              <td>
                                <a href="<?php echo base_url('admin/roles/edit/'); ?><?php echo $value['role_id']; ?>" class="btn btn-outline-info" id="nav-items" style="height:40px;padding-top: 10px;">update</a>
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



<div class="modal fade" id="Roles" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Roles</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     
      <div class="modal-body">
        <form id="submit_roles">
      <div class="form-group">
        <label for="exampleInputUsername1">Roles Name</label>
        <input type="text" class="form-control" id="role_name" name="role_name" required>
      </div>

      <div class="form-group">
        <label for="exampleInputUsername1">Roles Description</label>
        <input type="text" class="form-control" id="role_description" name="role_description" required>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </form>
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>

<script type="text/javascript">

    $(document).ready(function(){ 

        $("#start").show();
        $("#end").hide();

        $("#start_edit").show();
        $("#end_edit").hide();

        $("#loading").hide();


          $('#submit_roles').submit(function(e){ 
            //Start Save
            e.preventDefault(); 
                 $.ajax({
                     url:"<?php echo base_url(); ?>admin/roles/save_roles",
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
                         window.location.reload();
                     }
               
                 });
                 //End Save
            });



          $('#edit_com').submit(function(e){  
            //Start Save
            e.preventDefault(); 
                 $.ajax({
                     url:"<?php echo base_url(); ?>admin/company/edit_com",
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
                         window.location.reload();
                     }
               
                 });
                 //End Save
            });
         
 
    });
     
</script>



