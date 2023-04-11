<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
          
              <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body"> <?php echo $this->apps->get_notification(); ?>
                 <h4 class="card-title">List Of Version</h4>
                  <p> <?php foreach ($module as $modul){?>
                    <?php if($modul['module_name']=='Add Versions'){?>
                      <a href="<?php echo base_url('admin/tools/addversions'); ?>" style="background-color:#fff;color:#4B49AC;border:1px solid #4B49AC; " class="btn btn-light mr-2">Add Version</a>
                    <?php } } ?></p>
                  <div class="table-responsive">
                    <table id="sublisting" class="table">
                      <thead>
                        <tr>
                            <th>Versions</th>
                            <th>Subject</th>
                            <th>Update By</th>
                            <th>Date</th>
                            <th width="14%" style="text-align: center;">Tools</th>
                        </tr>
                      </thead>
                      <tbody>
                         <?php foreach ($getversions as $key => $value) { ?>
                            <tr>
                              <td>&nbsp;<?php echo $value['version']; ?></td>
                              <td>&nbsp;<?php echo $value['subject']; ?></td>
                              <td>&nbsp;<?php echo $value['name']; ?></td>
                              <td>&nbsp;<?php echo $value['created']; ?></td>
                              <td><a href="<?php echo base_url(); ?>admin/tools/updversi/<?php echo $value['version_id']; ?>" class="btn btn-outline-success btn-sm" id="nav-items" style="height:40px;padding-top: 15px;">Edit</a>&nbsp;
                              <a href="<?php echo base_url(); ?>admin/tools/deleteversions/<?php echo $value['version_id']; ?>" class="btn btn-outline-warning btn-sm" id="nav-items" style="height:40px;padding-top: 15px;">Delete</a>
                            </td>
                           </tr>
                         <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
           



