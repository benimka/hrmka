<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
              
              <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"><?php echo $title; ?></h4>
                  <form method="POST" action="<?php echo site_url(); ?>admin/announcements/save"  enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Announcements name</label>
                      <input type="hidden" name="ids" value="1">
                      <input type="text" class="form-control" id="exampleInputUsername1" name="name" placeholder="Announcements name" required>
                    </div>
                    
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Upload File</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Link URL</a>
                      </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Fille</label>
                          <input type="file" name="userfile" class="form-control">
                        </div>
                      </div>
                      <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab" style="margin-top:-20px;">
                        <div class="form-group" style="margin-bottom:40px;">
                            <label for="exampleInputEmail1">url</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i style="font-size: 10px;color:grey;">Example: http://www.facebook.com</i>
                            <input type="text" name="url" class="form-control" placeholder="Optional">
                          </div>
                      </div>
                    </div>
                    <br>

                    <div class="form-group"> 
                    <label for="exampleInputEmail1">Date</label>
                    <div id="datepicker-popup" class="input-group date">
                        <input type="text" class="form-control" name="date" id="date" required>
                        <span class="input-group-addon input-group-append border-left">
                          <span class="ti-calendar input-group-text"></span>
                        </span>
                      </div>
                  </div>
                  <br>
                  <div class="form-group row">
                      <label class="col-sm-4 col-form-label">Status</label>
                      <div class="col-sm-3">
                        <div class="form-check">
                          <label class="form-check-label">
                            <input type="radio" class="form-check-input" id="status" name="status" value="1" checked="checked">
                            Active
                          </label>
                        </div>
                      </div>

                      <div class="col-sm-4">
                        <div class="form-check">
                          <label class="form-check-label">
                            <input type="radio" class="form-check-input" id="status" name="status" value="9">
                            Inactive
                          </label>
                        </div>
                      </div>
                    </div>

                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a href="<?php echo base_url('admin/announcements'); ?>" class="btn btn-light">Cancel</a>
                  </form>
                </div>
              </div>
            </div>
            
        </div>
    </div>
</div>