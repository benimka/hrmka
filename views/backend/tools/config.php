<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
        <?php

        $query = $this->db->query("SELECT * FROM setting");

        foreach ($query->result() as $row)
            {
                $id = $row->id;
                $protocol = $row->protocol;
                $smtp_host = $row->smtp_host;
                $smtp_port = $row->smtp_port;
                $smtp_user = $row->smtp_user;
                $smtp_pass = $row->smtp_pass;
                $mailtype = $row->mailtype;
                $charset = $row->charset;
                $wordwrap = $row->wordwrap;
            }


        ?>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"><?php echo $title; ?></h4>
                  <form method="POST" action="<?php echo base_url(); ?>admin/tools/save_setting">
                      <div class="form-group">
                        <label for="formGroupExampleInput">Protocol</label>
                        <input type="text" class="form-control" id="formGroupExampleInput" name="protocol" value="<?php echo $protocol; ?>">
                        <input type="hidden" class="form-control" id="formGroupExampleInput" name="id" value="<?php echo $id; ?>">
                      </div>
                      <div class="form-group">
                        <label for="formGroupExampleInput2">Smtp host</label>
                        <input type="text" class="form-control" id="formGroupExampleInput2" name="smtp_host" value="<?php echo $smtp_host; ?>">
                      </div>
                      <div class="form-group">
                        <label for="formGroupExampleInput2">Smtp port</label>
                        <input type="text" class="form-control" id="smtp_port" name="smtp_port" value="<?php echo $smtp_port; ?>">
                      </div>
                      <div class="form-group">
                        <label for="formGroupExampleInput2">Smtp users</label>
                        <input type="text" class="form-control" id="smtp_user" name="smtp_user" value="<?php echo $smtp_user; ?>">
                      </div>
                      <div class="form-group">
                        <label for="formGroupExampleInput2">Smtp password</label>
                        <input type="password" class="form-control" id="smtp_pass" name="smtp_pass" value="<?php echo $smtp_pass; ?>">
                      </div>
                      <div class="box-footer">
                          <button type="submit" class="btn btn-primary mr-2">Update</button>
                          <a href="<?php echo base_url(); ?>admin/tools/send_test" class="btn btn-warning">Test Email</a>
                      </div>
                  </form>
                </div>
              </div>
            </div>

            <?php 

            $query = $this->db->query("SELECT * FROM mod_send_email ");
            foreach ($query->result() as $row){}

            ?>

            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                <h4 class="card-title">Setting Sending Email</h4>
                    <form method="POST" action="<?php echo base_url(); ?>admin/tools/save_setting_email">
                        <div class="form-group row">
                          <div class="col-sm-3">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="values" value="1" <?php if ($row->status == '1') { echo "checked"; } ?>>
                                Default
                              </label>
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="values" value="2"<?php if ($row->status == '2') { echo "checked"; } ?>>
                                Testing
                              </label>
                            </div>
                          </div>
                        </div>
                        <div class="box-footer">
                            <div class="pull-left">
                              <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
              </div>
            </div>  
            
        </div>
    </div>
</div>