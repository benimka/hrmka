<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
              
              <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body"><?php $this->apps->get_notification(); ?>
                  <h4 class="card-title"><?php echo $title; ?></h4>
                  <p class="card-description">

                    <?php foreach($actions as $action) { ?>
                      <?php if($action['module_path'] == 'add') { ?>
                      <button type="button" class="btn btn-light mr-2" data-toggle="modal" data-target="#Document" style="background-color:#fff;color:#4B49AC;border:1px solid #4B49AC; ">
                      Add Department
                    </button>
                      <?php } } ?>
                  </p>
                  <div class="table-responsive">
                    <table id="department" class="table">
                      <thead>
                        <tr>
                          <th width="40%">Department Name</th>
                          <th width="50%">Company Name</th>
                          <th>&nbsp;Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                         <?php foreach ($getdata as $key => $value) { ?>
                            <tr>
                              <td><?php echo $value['department_name']; ?></td>
                              <td><?php echo $value['company_name']; ?></td>
                              <td align="center">
                                <?php foreach ($actions as $modul){?>
                                  <?php if($modul['module_path']=='edit'){ ?>
                                    <a href="<?php echo base_url('admin/department/'); ?><?php echo $modul['module_path']; ?>/<?php echo $value['department_id']; ?>" class="badge badge-info" style="background-color:#fff;color:#4B49AC;border:1px solid #4B49AC; ">edit</a>
                                  <?php } ?>

                                  <?php if($modul['module_path']=='delete'){ ?>
                                    <a href="<?php echo base_url('admin/department/'); ?><?php echo $modul['module_path']; ?>/<?php echo $value['department_id']; ?>" class="badge badge-info" style="background-color:#fff;color:#4B49AC;border:1px solid #4B49AC; ">delete</a>
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




  <!-- Document Modal -->
  <div class="modal fade" id="document" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <form id="submit_edit" action="<?php echo base_url('admin/department/add'); ?>" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <input type="hidden" name="ids" value="1">
          <h5 class="modal-title" id="exampleModalLabel"><b>Update Document </b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
        <div class="form-group">
            <label for="exampleInputUsername1">Company Name</label>
            <select class="js-example-basic-single select2" style="color:#000;width: 100%;" name="company_code" id="company_code" required>
              <option value="">Select</option>
              <?php $qSelect = $this->db->query("SELECT * FROM mod_company ");
                foreach ($qSelect->result_array() as $row){ ?>
              <option value="<?php echo $row['company_code']; ?>"><?php echo $row['company_name']; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <div id="start_edit">
              <button class="btn btn-primary" type="submit" id="subloading">Add
          </div>
          
        </div>
      </div>
    </form>
    </div>
  </div>
  <!-- END EDIT -->