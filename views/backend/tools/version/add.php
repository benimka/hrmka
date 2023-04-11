<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
              <?php

                 $querys = $this->db->query("SELECT MAX(RIGHT(`version`,3)) + 1 AS CODE FROM mod_versions");

                        foreach ($querys->result() as $row){}

                        $versi = $row->CODE;

                        if($versi == NULL){
                            $versi = '100';
                        }

                        $arr = str_split($versi);
                        $a = $arr[0];
                        $b = $arr[1];
                        $c = $arr[2];

                ?>
              <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"><?php echo $title; ?></h4>
                  <form class="forms-sample" method="POST" action="<?php echo base_url(); ?>admin/tools/send">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Version Number</label>
                      <input type="text" class="form-control" name="version_hidden" value="<?php echo $a.".".$b.".".$c; ?>" style="width: 100%;" readonly>
                      <?php if($row->CODE == NULL){?>
                      <input type="hidden" class="form-control" name="version" value="100" style="width: 100%;" readonly>
                      <?php } else {?>
                      <input type="hidden" class="form-control" name="version" value="<?php echo $versi; ?>" style="width: 100%;" readonly>
                      <?php } ?>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputUsername1">Subject</label>
                      <input type="text" class="form-control" name="subject">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputUsername1">Fix</label>
                      <textarea class="form-control editor" name="fix" id="editor1"  style="height: 400px;"></textarea>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputUsername1">What's new</label>
                      <textarea class="form-control editor" name="new" id="editor2"  style="height: 400px;"></textarea>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputUsername1">Update Description</label>
                      <textarea class="form-control editor" name="up_description" id="editor3"  style="height: 400px;"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary mr-2">Save</button>
                    <a href="<?php echo base_url('admin/tools/versions'); ?>" class="btn btn-light">Cancel</a>
                  </form>
                </div>
              </div>
            </div>
            
        </div>