<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
              <?php foreach($getdata as $data){} ?>
              <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Edit Department</h4>
                  <form class="forms-sample" method="POST" action="<?php echo base_url(); ?>admin/department/save">
                    <input type="hidden" name="ids" value="2">
                    <input type="hidden" class="form-control" id="exampleInputUsername1" name="department_id" placeholder="example PMKA-001" value="<?php echo $data['department_id'];?>">

                    <input type="hidden" class="form-control" id="department_code" name="department_code" value="<?php echo $autoCode; ?>">

                    <?php 

                    $sub_string = substr($autoCode, 0, -7);

                    ?>

                    <input type="hidden" name="department_inisial" value="<?php echo $sub_string; ?>">

                    <div class="form-group">
                      <label for="exampleInputEmail1">Department name</label>
                      <input type="text" class="form-control" id="department_name" name="department_name" value="<?php echo $data['department_name'];?>">
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