<div class="main-panel">
    <div class="content-wrapper">
        <div class="row"> 
              <?php foreach ($getdata as $key => $value) {} ?>
              <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Add Users</h4>
                  <form class="forms-sample" method="POST" action="<?php echo base_url(); ?>admin/users/save">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Full Name</label>
                      <input type="hidden" name="id" value="1">
                      <input type="text" class="form-control" id="exampleInputUsername1" name="name" value="" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Username</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="user_name" value="" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="password" class="form-control" id="exampleInputPassword1" name="users_password1" value="" required>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputPassword1">Retry Password</label>
                      <input type="password" class="form-control" id="exampleInputPassword1" name="users_password2" value="" required>
                    </div>


                    <div class="form-group">
                      <label for="exampleInputPassword1">Users Role</label>
                      <select class="form-control" style="color:#000;" name="role_id" id="role_id" required>
                            <option value="">Select</option>
                            <?php
                                  $query = $this->db->query("SELECT * FROM sys_roles ");
                                  foreach ($query->result() as $row){
                                   
                              ?>
                                <option name="role_id" id="role_id" value="<?php echo $row->role_id; ?>"><?php echo $row->role_name;?></option>
                              <?php
                                    
                                  }
                              ?>
                          </select>
                    </div>

                    <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Users Status</label>
                          <div class="col-sm-4">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="user_status" id="membershipRadios1" value="1"  <?php if ($value['user_status'] == '1') { echo "checked"; } ?> checked="">
                                Active
                              </label>
                            </div>
                          </div>
                          <div class="col-sm-5">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="user_status" id="membershipRadios2" value="2" <?php if ($value['user_status'] == '2') { echo "checked"; } ?>>
                                In active
                              </label>
                            </div>
                          </div>
                        </div>

                    <button type="submit" class="btn btn-primary mr-2">Save</button>
                    <a href="<?php echo base_url('admin/users'); ?>" class="btn btn-light">Cancel</a>
                  </form>
                </div>
              </div>
            </div>
            
        </div>
    </div>
</div>