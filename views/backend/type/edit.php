<div class="main-panel">
    <div class="content-wrapper"> 

      <?php 

            $query_s = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$this->uri->segment(4)."'");

            foreach ($query_s->result_array() as $row_s){ }

      ?>

        <div class="row">
              <?php foreach ($getData as $value) {}?>
              <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Edit Document Type</h4>
                  <form class="forms-sample" method="POST" action="<?php echo base_url(); ?>admin/type/save">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Type Name</label>
                      <input type="hidden" class="form-control" name="id" value="1">
                      <input type="text" class="form-control" name="type_name" value="<?php echo $value['type_name'];?>">
                      <input type="hidden" class="form-control" name="type_id" value="<?php echo $value['type_id'];?>">
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Select Status</label>
                    </div>

                    <div class="form-group row">
                          <div class="col-sm-4">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="type_status" id="membershipRadios1" value="1"  <?php if ($value['type_status'] == '1') { echo "checked"; } ?>>
                                Active
                              </label>
                            </div>
                          </div>
                          <div class="col-sm-5">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="type_status" id="membershipRadios2" value="2" <?php if ($value['type_status'] == '2') { echo "checked"; } ?>>
                                In active
                              </label>
                            </div>
                          </div>
                        </div>

                    <button type="submit" class="btn btn-primary mr-2">Update</button>
                    <a href="<?php echo base_url('admin/type/subtype/'); ?><?php echo $row_s['parent_id']; ?>" class="btn btn-light">Cancel</a>
                  </form>
                </div>
              </div>
            </div>
            
        </div>
    </div>
</div>