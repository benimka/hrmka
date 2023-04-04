<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
              <?php foreach($getdata as $data) {} ?>
              <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Edit Company</h4>
                  <form class="forms-sample" method="POST" action="<?php echo base_url(); ?>admin/company/save">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Company code</label>
                      <input type="hidden" name="ids" value="2">
                      <input type="text" class="form-control" id="exampleInputUsername1" name="company_code" placeholder="example PMKA-001" value="<?php echo $data['company_code'];?>">
                      <input type="hidden" name="company_id" value="<?php echo $data['company_id']?>">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputUsername1">Company name</label>
                      <input type="hidden" name="id" value="1">
                      <input type="text" class="form-control" id="exampleInputUsername1" name="company_name" placeholder="Company name" value="<?php echo $data['company_name'];?>">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputUsername1">Company Initial</label>
                      <input type="hidden" name="id" value="1">
                      <input type="text" class="form-control" id="exampleInputUsername1" name="inisial" placeholder="example MKA,PMKA or MAA" value="<?php echo $data['inisial'];?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Company address</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="company_address" placeholder="Company address" value="<?php echo $data['company_address'];?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Company phone</label>
                      <input type="text" class="form-control" id="exampleInputPassword1" name="company_phone" placeholder="Company phone" value="<?php echo $data['company_phone'];?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputConfirmPassword1">Company fax</label>
                      <input type="text" class="form-control" id="exampleInputConfirmPassword1" name="company_fax" placeholder="Company fax" value="<?php echo $data['company_fax'];?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputConfirmPassword1">Company email</label>
                      <input type="text" class="form-control" id="exampleInputConfirmPassword1" name="company_email" placeholder="Company email" value="<?php echo $data['company_email'];?>">
                    </div>
                     <div class="form-group">
                      <label for="exampleInputEmail1">Npwp</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="company_npwp" placeholder="Npwp" value="<?php echo $data['company_npwp'];?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Pic</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="company_pic" placeholder="Pic" value="<?php echo $data['company_pic'];?>">
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