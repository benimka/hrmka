<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
              <?php foreach($getCompany as $company) {} ?>
              <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"> Add Document <?php echo $company['company_name'];  ?></h4>
                  <form class="forms-sample" method="POST" action="<?php echo base_url(); ?>admin/company/do_upload" enctype="multipart/form-data">
                    <input type="hidden" class="form-control" name="company_id" id="company_id" value="<?php echo $company['company_id'];  ?>" readonly>
                      <div class="form-group">
                          <label for="exampleInputUsername1">Document Type</label>
                          <select class="form-control" style="color:#000;" name="document_type" id="document_type">
                            <option value="">Select</option>
                            <?php $qSelect = $this->db->query("SELECT * FROM mod_document_type ");
                              foreach ($qSelect->result_array() as $row){ ?>
                            <option value="<?php echo $row['type_id']; ?>"><?php echo $row['type_name']; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Document name</label>
                          <input type="text" class="form-control" name="document_name" id="document_name" placeholder="document name">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Year</label>
                          <input type="text" class="form-control" name="document_year" id="document_year" placeholder="year">
                        </div>
                        
                         <div class="form-group">
                            <label>File upload</label>
                            <input type="file" name="userfile" class="file-upload-default">
                            <div class="input-group col-xs-12">
                              <input type="text" class="form-control file-upload-info" id="file" name="userfile" readonly placeholder="Upload Image">
                              <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                              </span>
                            </div>
                          </div>
                        <div class="form-group">
                          <div id="datepicker-popup" class="input-group date datepicker">
                              <input type="text" class="form-control" name="date_ex" id="date_ex">
                              <span class="input-group-addon input-group-append border-left">
                                <span class="ti-calendar input-group-text"></span>
                              </span>
                            </div>
                        </div>

                        </div>
                        <div class="modal-footer">
                          <a href="<?php echo base_url('admin/company/listData'); ?>/<?php echo $company['company_id'];  ?>" class="btn btn-secondary">Cancel</a>
                          <button class="btn btn-primary" id="btn_upload" type="submit">Save changes
                        </div>
                  </form>
                </div>
              </div>
            </div>
            
        </div>
    </div>
</div>