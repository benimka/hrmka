<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
              
              <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"><?php echo $title; ?></h4>
                   <form method="POST" action="<?php echo site_url(); ?>admin/announcements/save"  enctype="multipart/form-data">
                      <div class="box-body">
                        <?php foreach($getedit as $data) {}?>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Announcements Name</label>
                          <input type="hidden" name="ids" value="2">
                          <input type="text" name="name" class="form-control" placeholder="" value="<?php echo $data['name']; ?>">
                          <input type="hidden" name="id" class="form-control" placeholder="" value="<?php echo $data['id']; ?>">
                        </div>



                        <?php if($data['url'] == ""){ ?>

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
                              <label for="exampleInputEmail1">Fille: <a href="<?php echo base_url() ?>document/<?php echo $data['fillename']; ?>" target="_blank"><?php echo $data['fillename']; ?></a></label>
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

                        <?php }else{ ?>

                          <ul class="nav nav-tabs" id="myTab" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Upload File</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Link URL</a>
                          </li>
                        </ul>

                        <div class="tab-content" id="myTabContent">
                          <div class="tab-pane fade " id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Fille</label>
                              <input type="file" name="userfile" class="form-control">
                            </div>
                          </div>
                          <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab" style="margin-top:-20px;">
                            <div class="form-group" style="margin-bottom:40px;">
                                <label for="exampleInputEmail1">url</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i style="font-size: 10px;color:grey;">Example: http://www.facebook.com</i>
                                <input type="text" name="url" class="form-control" placeholder="Optional" value="<?php echo $data['url']; ?>">
                              </div>
                          </div>
                        </div>

                        <?php } ?>

                        <div class="form-group">
                          <label for="exampleInputEmail1">Status</label><br>
                          <input type="radio" name="status" value="1" <?php if ($data['status'] == '1') { echo "checked"; } ?>>&nbsp;&nbsp;&nbsp;Active&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <input type="radio" name="status" value="9" <?php if ($data['status'] == '9') { echo "checked"; } ?>>&nbsp;&nbsp;&nbsp;In active
                        </div>

                      <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="<?php echo base_url(); ?>admin/announcements" class="btn btn-default">Cancel</a>
                      </div>
                    </form>
                </div>
              </div>
            </div>
            
        </div>
    </div>
</div>