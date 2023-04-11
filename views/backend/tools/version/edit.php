<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <?php

            $querys = $this->db->query("SELECT * FROM mod_versions WHERE version_id ='".$uri."' ");

            foreach ($querys->result() as $values) { }

                    $arr = str_split($values->version);
                    $a = $arr[0];
                    $b = $arr[1];
                    $c = $arr[2];

            ?>

              <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"><?php echo $title; ?></h4>
                  <form class="forms-sample" method="POST" action="<?php echo base_url(); ?>admin/tools/editversions">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Version Number</label>
                        <input type="text" class="form-control" name="version_hidden" value="<?php echo $a.".".$b.".".$c; ?>" style="width: 100%;" placeholder="Version 1.0.0" readonly >
                        <input type="hidden" class="form-control" name="version" value="<?php echo $values->version; ?>" style="width: 100%;" readonly>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputUsername1">Subject</label>
                      <input type="text" class="form-control" name="subject" value="<?php echo $values->subject; ?>" style="width: 100%" placeholder="Update to V.1.0.0">
                      <input type="hidden" class="form-control" name="version_id" value="<?php echo $values->version_id; ?>" style="width: 100%">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputUsername1">Fix</label>
                      <textarea class="form-control editor" name="fix" id="editor1"  style="height: 400px;"><?php echo $values->fix; ?></textarea>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputUsername1">What's new</label>
                      <textarea class="form-control editor" name="new" id="editor2"  style="height: 400px;"><?php echo $values->new; ?></textarea>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputUsername1">Update Description</label>
                      <textarea class="form-control editor" name="up_description" id="editor3"  style="height: 400px;"><?php echo $values->up_description; ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary mr-2">Update</button>
                    <a href="<?php echo base_url('admin/tools/versions'); ?>" class="btn btn-light">Cancel</a>
                  </form>
                </div>
              </div>
            </div>
            
        </div>
