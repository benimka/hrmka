<div class="main-panel">
    <div class="content-wrapper"> 
        <div class="row">
              <?php foreach ($getdata as $key => $value) {} ?>
              <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Company Status</h4>
                  <form class="forms-sample" method="POST" action="<?php echo base_url(); ?>admin/company/save">
                    <div class="form-group">
                      <input type="hidden" class="form-control" name="id" value="3">
                      <input type="hidden" class="form-control" name="company_id" value="<?php echo $value['company_id'];?>">
                      <input type="hidden" class="form-control" id="exampleInputUsername1" name="params" value="<?php echo $value['slug']; ?>">
                    </div>

                    <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Select Status</label>
                          <div class="col-sm-4">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="company_status" id="membershipRadios1" value="1"  <?php if ($value['company_status'] == '1') { echo "checked"; } ?>>
                                Active
                              </label>
                            </div>
                          </div>
                          <div class="col-sm-5">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="company_status" id="membershipRadios2" value="2" <?php if ($value['company_status'] == '2') { echo "checked"; } ?>>
                                In active
                              </label>
                            </div>
                          </div>
                        </div>

                    <button type="submit" class="btn btn-primary mr-2">Update Status</button>
                    <a href="<?php echo base_url('admin/company'); ?>" class="btn btn-light">Cancel</a>
                  </form>
                </div>
              </div>
            </div>
            
        </div>
    </div>
</div>