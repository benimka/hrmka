<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
              
              <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"><?php echo $title; ?></h4>
                  <form method="POST" action="<?php echo base_url('admin/bank/save'); ?>">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Number</label>
                      <input type="hidden" name="ids" value="1">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputUsername1">Name</label>
                      <input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="Bank name" required>
                    </div>

                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a href="<?php echo base_url('admin/bank'); ?>" class="btn btn-light">Cancel</a>
                  </form>
                </div>
              </div>
            </div>
            
        </div>
    </div>
</div>