<div class="main-panel">
    <div class="content-wrapper"><?php $this->apps->get_notification(); ?>
        <div class="row"> 
              <?php foreach ($getdata as $key => $value) {} ?>
              <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Change password</h4>
                  <form class="forms-sample" method="POST" action="<?php echo base_url(); ?>admin/users/save">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Full Name</label>
                      <input type="hidden" name="id" value="3">
                      <input type="text" class="form-control" id="exampleInputUsername1" name="name" value="<?php echo $value['name']; ?>" readonly>
                      <input type="hidden" class="form-control" id="exampleInputUsername1" name="user_id" value="<?php echo $value['user_id']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Username</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="user_name" value="<?php echo $value['user_name']; ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="password" class="form-control" id="exampleInputPassword1" name="users_password1" value="123">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputPassword1">Retry Password</label>
                      <input type="password" class="form-control" id="exampleInputPassword1" name="users_password2" value="123">
                    </div>



                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a href="<?php echo base_url('admin/users'); ?>" class="btn btn-light">Cancel</a>
                  </form>
                </div>
              </div>
            </div>
            
        </div>
    </div>
</div>