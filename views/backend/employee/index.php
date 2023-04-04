<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body"><?php $this->apps->get_notification(); ?>
                   <div class="table-responsives">
                      <div class="row">
                        <div class="col-lg-6 grid-margin grid-margin-lg-0">
                          <div class="card-body">
                            <h4 class="card-title"><?php echo $title; ?></h4>
                            <p>
                              <?php foreach($actions as $action) { ?>
                                  <?php if($action['module_path'] == 'add') { ?>
                                  <button type="button" class="btn btn-light mr-2" data-toggle="modal" data-target="#Document" style="background-color:#fff;color:#4B49AC;border:1px solid #4B49AC; ">
                                  Add Employee
                                </button>
                              <?php } } ?>
                            </p>
                          </div>
                        </div>

                        <?php foreach ($getdata as $key => $val_company) { }?>

                        <div class="col-lg-6 grid-margin grid-margin-lg-0">
                          <div class="card-body">
                            <h6 class="card-title">&nbsp;Filter Company:</h6>
                              <select class="js-example-basic-single" style="color:#000;width:100%" id="select_filters_company">
                                <option value="">Select</option>
                                <?php foreach($company as $data_company) { ?>
                                <option value="<?php echo base_url('admin/employee/index?query='); ?><?php echo $data_company['company_code'] ?>"<?php if($filter == $data_company['company_code']){echo "selected='selected'";} ?>><?php echo $data_company['company_name']; ?></option>
                                <?php } ?>
                              </select>
                           
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="spinner-border" role="status" id="loading" style="margin:-10px;display: none;"></div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="employee" class="table">
                      <thead>
                        <tr>
                          <th width="30%">Employee ID</th>
                          <th width="30%">Employee Name</th>
                          <th width="30%">Company</th>
                          <th width="30%">Department Name</th>
                          <th width="30%">Employee Status</th>
                          <th>&nbsp;Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                         <?php foreach ($getdata as $key => $value) { ?>
                            <tr>
                              <td><?php echo $value['employee_code']; ?></td>
                              <td><?php echo $value['employee_name']; ?></td>
                              <td><?php echo $value['company_name']; ?></td>
                              <td><?php echo $value['department_name']; ?></td>
                              <td><?php echo $value['mod_status_name']; ?></td>
                              <td align="center">
                                <?php foreach ($actions as $modul){?>
                                  <?php if($modul['module_path']=='edit'){ ?>
                                    <a href="<?php echo base_url('admin/employee/'); ?><?php echo $modul['module_path']; ?>/<?php echo $value['employee_code']; ?>" class="badge badge-info" style="background-color:#fff;color:#4B49AC;border:1px solid #4B49AC; ">edit</a>
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
    <form id="submit_edit" action="<?php echo base_url('admin/employee/add'); ?>" method="post">
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

<script type="text/javascript">

    function redirect(Filters_company){
          window.location = Filters_company;
      }

      var selectElNew = document.getElementById('select_filters_company');
      
      selectElNew.onchange = function(){ 
          var Filters_company = this.value;
          redirect(Filters_company);
          
      };  

</script>