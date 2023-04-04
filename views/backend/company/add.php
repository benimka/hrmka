<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
              
              <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Add Company</h4>
                  <form class="forms-sample" method="POST" action="<?php echo base_url(); ?>admin/company/save">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Company code</label>
                      <input type="hidden" name="ids" value="1">
                      <input type="text" class="form-control" id="exampleInputUsername1" name="company_code" placeholder="example PMKA-001" required>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputUsername1">Company name</label>
                      <input type="hidden" name="id" value="1">
                      <input type="text" class="form-control" id="exampleInputUsername1" name="company_name" placeholder="Company name" required>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputUsername1">Company Initial</label>
                      <input type="hidden" name="id" value="1">
                      <input type="text" class="form-control" id="exampleInputUsername1" name="inisial" placeholder="example MKA,PMKA or MAA" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Company address</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="company_address" placeholder="Company address" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Company phone</label>
                      <input type="text" class="form-control" id="exampleInputPassword1" name="company_phone" placeholder="Company phone" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputConfirmPassword1">Company fax</label>
                      <input type="text" class="form-control" id="exampleInputConfirmPassword1" name="company_fax" placeholder="Company fax">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputConfirmPassword1">Company email</label>
                      <input type="text" class="form-control" id="exampleInputConfirmPassword1" name="company_email" placeholder="Company email">
                    </div>
                     <div class="form-group">
                      <label for="exampleInputEmail1">Npwp</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="company_npwp" placeholder="Npwp" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Pic</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="company_pic" placeholder="Pic" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary mr-2">Save</button>
                    <a href="<?php echo base_url('admin/company'); ?>" class="btn btn-light">Cancel</a>
                  </form>
                </div>
              </div>
            </div>
            
        </div>
    </div>
</div>