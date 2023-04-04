<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
              
              <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Add Department</h4>
                  <form class="forms-sample" method="POST" action="<?php echo base_url(); ?>admin/department/save">
                    <input type="hidden" name="ids" value="1">
                    <input type="hidden" class="form-control" id="exampleInputUsername1" name="company_code" placeholder="example PMKA-001" value="<?php echo $company; ?>">

                    <input type="hidden" class="form-control" id="department_code" name="department_code" value="<?php echo $autoCode; ?>">

                    <?php 

                    $sub_string = substr($autoCode, 0, -7);

                    ?>

                    <input type="hidden" name="department_inisial" value="<?php echo $sub_string; ?>">

                    <div class="form-group">
                      <label for="exampleInputEmail1">Department name</label>
                      <input type="text" class="form-control" id="department_name" name="department_name" placeholder="Department Name" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary mr-2">Save</button>
                    <a href="<?php echo base_url('admin/department'); ?>" class="btn btn-light">Cancel</a>
                  </form>
                </div>
              </div>
            </div>
            
        </div>
    </div>
</div>