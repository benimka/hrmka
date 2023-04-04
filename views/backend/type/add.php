<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
              <?php 

                    $query_s = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$this->uri->segment(4)."'");

                    foreach ($query_s->result_array() as $row_s){ }

              ?>
              <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">
                    <?php if($row_s['type_name'] ==""){ ?>
                      <i class="ti-folder"></i>&nbsp;&nbsp;<i class="ti-angle-double-right"></i>&nbsp;&nbsp; Add Document Type
                    <?php }else{ ?>
                    <i class="ti-folder"></i>&nbsp;&nbsp;<i class="ti-angle-double-right"></i>&nbsp;&nbsp; Parent Of <?php echo $row_s['type_name']; ?>
                    <?php } ?>
                    </h4>

                  <form class="forms-sample" method="POST" action="<?php echo base_url(); ?>admin/type/save">
                    <input type="hidden" class="form-control" id="exampleInputUsername1" name="id" value="0" readonly>
                    <?php if($row_s['type_name'] ==""){ ?>
                      <?php 

                        $cd = $this->db->query("SELECT MAX(parent_type) AS kd_max FROM mod_document_type ");
                        $kd = "";
                        if($cd->num_rows()>0){
                            foreach($cd->result() as $k){
                                $tmp = ((int)$k->kd_max)+1;
                                $kd = sprintf("%0s", $tmp);
                            }
                        }else{
                            $kd = "1";
                        }

                      ?>

                       <input type="hidden" class="form-control" id="exampleInputUsername1" name="parent_type" value="<?php echo $kd; ?>" readonly>
                    <?php }else{ ?>

                      <?php 

                        $query = $this->db->query("SELECT parent_type FROM mod_document_type WHERE type_id='".$this->uri->segment(4)."'");
                        foreach ($query->result_array() as $row){}
                          
                      ?>
                        <input type="hidden" class="form-control" id="exampleInputUsername1" name="parent_type" value="<?php echo $row['parent_type'] ?>" readonly>
                    <?php } ?>
                    <input type="hidden" class="form-control" id="exampleInputUsername1" name="type_id" value="<?php echo $this->uri->segment(4); ?>" readonly>

                     <input type="hidden" class="form-control" id="exampleInputUsername1" name="level" value="<?php echo $row_s['level']; ?>" readonly>

                    <input type="hidden" class="form-control" id="exampleInputUsername1" name="parent_id" value="<?php echo $row_s['type_id']; ?>" readonly>

                    <div class="form-group">
                      <label for="exampleInputUsername1">Type Name</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" name="type_name" placeholder="Type name" required>
                    </div>

                    <button type="submit" class="btn btn-primary mr-2">Save</button>
                    <a href="<?php echo base_url('admin/type/subtype/'); ?><?php echo $this->uri->segment(4); ?>" class="btn btn-light">Cancel</a>
                  </form>
                </div>
              </div>
            </div>
            
        </div>
    </div>
</div>