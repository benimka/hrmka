<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
              
              <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"><?php echo $title; ?></h4>
                  <form method="POST" action="<?php echo base_url('admin/position/save'); ?>">
                    
                    
                    <div class="form-group">
                      <label for="exampleInputUsername1">Position Code</label>
                      <input type="hidden" name="ids" value="1">
                      <input type="text" class="form-control" name="position_code" value="<?php echo $autoCode; ?>" readonly>
                    </div>

                    <div class="form-group">
                      <input type="hidden" name="company_code" value="<?php echo $company; ?>">
                      <label for="exampleInputUsername1">Position</label>
                      <input type="text" class="form-control" id="position_name" name="position_name" placeholder="Position name" required>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputUsername1">Initial</label>
                      <input type="text" class="form-control" id="pos_inisial" name="pos_inisial" placeholder="Initial name exam: PMKA, MKA etc" required>
                    </div>

                    <div class="form-group">
                        <label>Department</label><br>
                        <select class="js-example-basic-single w-100" name="department_code" id="department_code" >
                              <option value="">Select department</option>
                            <?php
                              $quer = $this->db->query("SELECT * FROM mod_department WHERE company_code='".$company."' ");
                                foreach ($quer->result() as $ro){
                                $selected=($ro->department_code==$dataEmployee["department_code"]) ? ' selected="selected" ':' ';
                            ?>
                              <option value="<?php echo $ro->department_code;?>"<?=$selected?>><?php echo $ro->department_name;?></option>
                            <?php
                                }
                            ?>
                          </select>
                      </div>

                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a href="<?php echo base_url('admin/position'); ?>" class="btn btn-light">Cancel</a>
                  </form>
                </div>
              </div>
            </div>
            
        </div>
    </div>
</div>