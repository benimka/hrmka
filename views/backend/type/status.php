<div class="main-panel">
    <div class="content-wrapper"> 
        <div class="row">
              <?php foreach ($getData as $value) {}?>
              <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Status Document Type</h4>
                  <form class="forms-sample" method="POST" action="<?php echo base_url(); ?>admin/type/save">
                    <div class="form-group">
                      <input type="hidden" class="form-control" name="id" value="2">
                      <input type="hidden" class="form-control" name="type_id" value="<?php echo $value['type_id'];?>">
                    </div>

                    <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Select Status</label>
                          <div class="col-sm-4">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="type_status" id="membershipRadios1" value="1"  <?php if ($value['type_status'] == '1') { echo "checked"; } ?>>
                                Active
                              </label>
                            </div>
                          </div>
                          <div class="col-sm-5">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="type_status" id="membershipRadios2" value="2" <?php if ($value['type_status'] == '2') { echo "checked"; } ?>>
                                In active
                              </label>
                            </div>
                          </div>
                        </div>

                    <button type="submit" class="btn btn-primary mr-2">Update Status</button>
                    <a href="<?php echo base_url('admin/type'); ?>" class="btn btn-light">Cancel</a>
                  </form>
                </div>
              </div>
            </div>
            
        </div>
    </div>
</div>