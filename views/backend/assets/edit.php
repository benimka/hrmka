<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
              <?php foreach($getdata as $data) {} ?>
              <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"><?php echo $title; ?></h4>
                  <form method="POST" action="<?php echo site_url(); ?>admin/assets/save" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Number</label>
                      <input type="hidden" name="ids" value="2">
                      <input type="text" class="form-control" id="item_code" name="item_code" placeholder="Numbers" value="<?php echo $data['item_code']; ?>" readonly>
                      <input type="hidden" name="company_code" class="form-control" value="<?php echo $company_code; ?>" readonly>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputUsername1">Name</label>
                      <input type="text" class="form-control" id="item_name" name="item_name" placeholder="Assets name" value="<?php echo $data['item_name']; ?>">
                    </div>

                    <div class="form-group"> 
                    <label for="exampleInputEmail1">Date</label>
                    <div id="datepicker-popup" class="input-group date">
                        <input type="text" class="form-control" name="date_buy" id="date_buy" value="<?php echo $data['date_buy']; ?>">
                        <span class="input-group-addon input-group-append border-left">
                          <span class="ti-calendar input-group-text"></span>
                        </span>
                      </div>
                  </div>

                    <button type="submit" class="btn btn-primary mr-2">Edit</button>
                    <a href="<?php echo base_url('admin/assets'); ?>" class="btn btn-light">Cancel</a>
                  </form>
                </div>
              </div>
            </div>
            
        </div>
    </div>
</div>