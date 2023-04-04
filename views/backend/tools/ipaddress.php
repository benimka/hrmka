<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
              
              <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body"><?php echo $this->apps->get_notification(); ?>
                  <h4 class="card-title">List IP Address</h4>
                  <p class="card-description">

                    <button type="button" class="btn btn-light mr-2" data-toggle="modal" data-target="#Document" style="background-color:#fff;color:#4B49AC;border:1px solid #4B49AC; ">
                      Add IP Address
                    </button>
                  </p>
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                        <tr>
                          <th width="30%">Device</th>
                          <th width="10%">IP Address</th>
                          <th width="10%">Port</th>
                          <th width="5%">Update</th>
                          <th width="5%">Delete</th>
                        </tr>

                         <?php foreach ($getdata as $key => $value) { ?>

                          <form method="POST" action="<?php echo site_url(); ?>admin/tools/update_ip">
                              <tr>
                                <td><input type="text" name="device" class="form-control"  value="<?php echo $value['device']; ?>">
                                </td>
                                <td><input type="hidden" name="id" value="<?php echo $value['id']; ?>"> <input type="text" name="ip" value="<?php echo $value['ip']; ?>" class="form-control" style="width: 130px;"></td>
                                <td><input type="text" name="port" class="form-control" value="<?php echo $value['port']; ?>"> </td>
                                
                                <td>
                                <input type="submit" class="btn btn-sm btn-info btn-sm" value="update" style="background-color:#fff;color:#4B49AC;border:1px solid #4B49AC;height: 25px; padding-bottom: 20px;">
                              </td>
                              <td>
                              <a href="<?php echo base_url(); ?>admin/tools/deleteip/<?php echo $value['id']; ?>" class="badge badge-info" style="background-color:#fff;color:#4B49AC;border:1px solid #4B49AC; ">delete</a>
                            </td>
                             </tr>
                            </form>

                         <?php } ?>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
</div>


<!-- Document Modal -->
  <div class="modal fade" id="document" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <form id="submit_edit" action="<?php echo base_url('admin/tools/save_ip'); ?>" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <input type="hidden" name="ids" value="1">
          <h5 class="modal-title" id="exampleModalLabel"><b>Update Document </b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
        <div class="form-group">
            <label for="exampleInputUsername1">Location</label>
            <select class="js-example-basic-single select2" style="color:#000;width: 100%;" name="location_id" id="location_id" required>
              <option value="">Select</option>
              <?php $qSelect = $this->db->query("SELECT * FROM mod_location ");
                foreach ($qSelect->result_array() as $row){ ?>
              <option value="<?php echo $row['location_id']; ?>"><?php echo $row['location_name']; ?></option>
              <?php } ?>
            </select>
          </div>


          <div class="form-group">
            <label for="exampleInputUsername1">Device</label>
            <input type="text" name="device" class="form-control" value="" placeholder="Device name">
          </div>





          <div class="form-group">
            <label for="exampleInputUsername1">IP Address</label>
            <input type="text" name="ip" class="form-control" value=""  placeholder="IP Address">
          </div>



          <div class="form-group">
            <label for="exampleInputUsername1">Port</label>
            <input type="text" name="port" class="form-control" id="inputName" placeholder="Port">
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <div id="start_edit">
              <button class="btn btn-primary" type="submit" id="subloading">Add
          </div>
          
        </div>
      </div>
    </form>
    </div>
  </div>
  <!-- END EDIT -->




