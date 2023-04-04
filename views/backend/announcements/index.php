<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
              
              <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body"><?php $this->apps->get_notification(); ?>
                  <h4 class="card-title">List Of Announcements</h4>
                  <p class="card-description">

                    <?php foreach($actions as $action) { ?>
                      <?php if($action['module_path'] == 'add') { ?>
                      <a href="<?php echo base_url('admin/announcements/add'); ?>" style="background-color:#fff;color:#4B49AC;border:1px solid #4B49AC; " class="btn btn-light mr-2">Add announcements</a>
                      <?php } } ?>
                  </p>
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                          <th width="40%">Announcements</th>
                          <th>Upload</th>
                          <th>Url</th>
                          <th>Fillename</th>
                          <th>Status</th>
                          <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                         <?php foreach ($getdata as $value) { ?>
                            <tr>
                              <td>&nbsp;<?php echo $value['name']; ?></td>
                              <td>&nbsp;<?php echo $value['date_upload']; ?></td>
                              <?php if($value['url'] == ""){ ?>
                                <td>&nbsp;-</td>
                              <?php }else{ ?>
                                <td>&nbsp;<a href="<?php echo $value['url']; ?>" target="_blank">Show</a></td>
                              <?php } ?>   
                              <?php if($value['fillename'] == NULL){ ?>
                                <td>&nbsp;-</td>
                              <?php }else{ ?>
                                <td>&nbsp;<a href="<?php echo base_url() ?>document/<?php echo $value['fillename']; ?>" target="_blank">Show</a></td>
                              <?php } ?>                       

                              <td>&nbsp;<?php if($value['status'] == '1'){echo "Active";}else{echo "In active";} ?></td>
                              <td align="center">
                                <?php foreach ($actions as $modul){?>
                                  <?php if($modul['module_path']=='edit'){ ?>
                                    <a href="<?php echo base_url('admin/announcements/'); ?><?php echo $modul['module_path']; ?>/<?php echo $value['id']; ?>" class="badge badge-info" style="background-color:#fff;color:#4B49AC;border:1px solid #4B49AC; ">edit</a>
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




