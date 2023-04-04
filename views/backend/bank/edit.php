<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
              <?php foreach($getdata as $data) {} ?>
              <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"><?php echo $title; ?></h4>
                  <form method="POST" action="<?php echo site_url(); ?>admin/bank/save" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Number</label>
                      <input type="hidden" name="ids" value="2">
                      <input type="hidden" name="bank_id" class="form-control" value="<?php echo $data['bank_id']; ?>">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputUsername1">Name</label>
                      <input type="text" class="form-control" id="bank_name" name="bank_name" value="<?php echo $data['bank_name']; ?>">
                    </div>

                    
                    <button type="submit" class="btn btn-primary mr-2">Update</button>
                    <a href="<?php echo base_url('admin/bank'); ?>" class="btn btn-light">Cancel</a>
                  </form>
                </div>
              </div>
            </div>
            
        </div>
    </div>
</div>