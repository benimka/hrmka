<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
              
              <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body"><?php echo $this->apps->get_notification(); ?>
                  <h4 class="card-title">List Of <?php echo $title; ?></h4>
                  <p class="card-description">

                   
                  </p>
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                          <th>User Name</th>
                          <th>Company</th>
                          <th>Status Login</th>
                          <th width="9%">Tools</th>
                        </tr>
                      </thead>
                      <tbody>

                          <?php foreach ($getusers as $key => $value) { ?>
                              <tr>
                                <td>&nbsp;<?php echo $value['employee_name']; ?></td>
                                <td>&nbsp;<?php echo $value['company_name']; ?></td>
                                <?php if($value['status_login'] == 0) {?>
                                <td><button type="button" class="btn btn-inverse-warning" style="height:30px;cursor: not-allowed;">new users</button></td>
                                <?php }elseif($value['status_login'] == 9){ ?>
                                <td><small class="label label-danger">Non active</small></td>
                                <?php }else{ ?>
                                <td><button type="button" class="btn btn-inverse-success" style="height:30px;cursor: not-allowed;">active</button></td>
                                <?php } ?>
                                <?php if($value['status_login'] == 0) {?>
                                <td><a href="<?php echo base_url(); ?>admin/tools/setting_users/<?php echo $value['employee_code']; ?>" class="badge badge-warning" style="background-color:#fff;color:#4B49AC;border:1px solid #4B49AC;">setting</a></small></td>

                                <?php }elseif($value['status_login'] == 9){ ?>
                                  <td><a href="<?php echo base_url(); ?>admin/tools/edit_users/<?php echo $value['employee_code']; ?>" class="badge badge-info" style="background-color:#fff;color:#4B49AC;border:1px solid #4B49AC;">Update</a></td>
                                <?php }else{ ?>
                                <td><a href="<?php echo base_url(); ?>admin/tools/edit_users/<?php echo $value['employee_code']; ?>" class="badge badge-info" style="background-color:#fff;color:#4B49AC;border:1px solid #4B49AC;">update</a></td>
                                <?php } ?>
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




