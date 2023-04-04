<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
              
              <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body"><?php $this->apps->get_notification(); ?>
                  <h4 class="card-title">List Of Users</h4>
                  <p class="card-description">
                    <a href="<?php echo base_url('admin/users/add'); ?>" style="text-decoration:none;color:#000" class="btn btn-light mr-2">Add Users</a>
                  </p>
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                          <th width="20%">Full Name</th>
                          <th width="30%">Users name</th>
                          <th width="40%">Role</th>
                          <th>Created</th>
                          <th>Update</th>
                          <th>Status</th>
                          <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                         <?php foreach ($getdata as $key => $value) { ?>
                            <tr>
                              <td><?php echo $value['name']; ?></td>
                              <td><?php echo $value['user_name']; ?></td>
                              <td><?php echo $value['role_name']; ?></td>
                              <td><?php echo $value['created']; ?></td>
                              <td><?php echo $value['modified']; ?></td>
                              <td>
                                <?php if($value['user_status']  == 1){ ?>
                                  <button type="button" class="btn btn-inverse-success" style="height:40px;">active</button>
                                <?php }else{ ?>
                                  <button type="button" class="btn btn-inverse-danger" style="height:40px;">in active</button>
                                <?php } ?>

                              </td>
                              <td>
                                <a href="<?php echo base_url('admin/users/edit/'); ?><?php echo $value['user_id']; ?>" class="btn btn-outline-info" id="nav-items" style="height:40px;padding-top: 10px;">update</a>
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




