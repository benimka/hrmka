<div class="main-panel">
    <div class="content-wrapper"> <?php $this->apps->get_notification(); ?>
        <div class="row"> 
          <?php foreach ($edit_users as $key => $value) {
          # code...
          } ?>
              <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body"> <?php echo $value['role_id']; ?>
                  <h4 class="card-title"><?php echo $title; ?></h4>
                  <form method="POST" action="<?php echo site_url(); ?>admin/tools/edit_users_login" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Name</label>
                      <input type="hidden" name="employee_code" value="<?php echo $value['employee_code'] ?>">
                      <input type="text" class="form-control" name="name" value="<?php echo $value['employee_name'] ?>" readonly>
                      <input type="hidden" class="form-control" name="company_code" value="<?php echo $value['company_code'] ?>">
                      <input type="hidden" class="form-control" name="department" value="<?php echo $value['inisial'] ?>">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputUsername1">Role</label>
                      <select class="js-example-basic-single w-100" name="role_id" id="role_id" >
                          <option  value="">Select</option>
                          <option  value="2"<?php if($value['role_id'] == '2'){echo"selected='selected'";} ?>>Direktur</option>
                          <option  value="3"<?php if($value['role_id'] == '3'){echo"selected='selected'";} ?>>HR Admin</option>
                          <option  value="4"<?php if($value['role_id'] == '4'){echo"selected='selected'";} ?>>Manager</option>
                          <option  value="10"<?php if($value['role_id'] == '10'){echo"selected='selected'";} ?>>Users</option>
                      </select>
                    </div>

                    <div class="form-group"> 
                    <label for="exampleInputEmail1">Login</label> <br>
                   
                        <input type="radio" name="status_login" value="1" <?php if ($value['status_login'] == '1') { echo "checked"; } ?>> &nbsp;&nbsp;&nbsp;Active&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <input type="radio" name="status_login" value="9" <?php if ($value['status_login'] == '9') { echo "checked"; } ?>>&nbsp;&nbsp;&nbsp;Not

                  </div>


                  <div class="form-group"> 
                    <label for="exampleInputEmail1">Password</label> <br>
                   
                        <input type="password" class="form-control" name="password" value="">

                  </div>

                  <div class="form-group"> 
                    <label for="exampleInputEmail1">Retype Password</label> <br>
                   
                        <input type="password" class="form-control" name="password_r" value="">

                  </div>



                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a href="<?php echo base_url('admin/tools/users_setting'); ?>" class="btn btn-light">Cancel</a>
                  </form>
                </div>
              </div>
            </div>
            
        </div>
    </div>
</div>