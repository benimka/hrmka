<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
              
              <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body"><?php $this->apps->get_notification(); ?>
                  <h4 class="card-title">List Of Company</h4>
                  <p class="card-description">

                    <?php foreach($actions as $action) { ?>
                      <?php if($action['module_path'] == 'add') { ?>
                      <a href="<?php echo base_url('admin/company/add'); ?>" style="background-color:#fff;color:#4B49AC;border:1px solid #4B49AC; " class="btn btn-light mr-2">Add Company</a>
                      <?php } } ?>
                  </p>
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                          <th width="20%">Company Name</th>
                          <th width="40%">Company Address</th>
                          <th>Company Phone</th>
                          <th>Company Email</th>
                          <th>&nbsp;
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                         <?php foreach ($getdata as $key => $value) { ?>
                            <tr>
                              <td><?php echo $value['company_name']; ?></td>
                              <td><?php echo $value['company_address']; ?></td>
                              <td><?php echo $value['company_phone']; ?></td>
                              <td><?php echo $value['company_email']; ?></td>
                              <td align="center">
                                <?php foreach ($actions as $modul){?>
                                  <?php if($modul['module_path']=='edit'){ ?>
                                    <a href="<?php echo base_url('admin/company/'); ?><?php echo $modul['module_path']; ?>/<?php echo $value['company_id']; ?>" class="badge badge-info" style="background-color:#fff;color:#4B49AC;border:1px solid #4B49AC; ">edit</a>
                                  <?php } ?>

                                  <?php if($modul['module_path']=='delete'){ ?>
                                    <a href="<?php echo base_url('admin/company/'); ?><?php echo $modul['module_path']; ?>/<?php echo $value['company_id']; ?>" class="badge badge-info" style="background-color:#fff;color:#4B49AC;border:1px solid #4B49AC; ">delete</a>
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




