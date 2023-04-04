<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
              <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"></h4>
                  <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Report Percentage of shareholders</h4>
                        <div class="input-group input-daterange d-flex align-items-center">
                          <input type="text" class="form-control" id="editCom">
                          <div class="input-group-addon mx-4">to</div>
                          <input type="text" class="form-control" id="dateCom">
                        </div>
                        <br>

                        <div class="form-group row">
            
                          <div class="col-sm-3">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="doc_status" value="1" id="jns1" checked="">
                                Html
                              </label>
                            </div>
                          </div>

                          <div class="col-sm-3">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="doc_status" id="jns2" value="2">
                                Excel
                              </label>
                            </div>
                          </div>

                        </div>
                          <br>
                        <div class="input-group input-daterange d-flex align-items-center">
                          <button type="submit" class="btn btn-primary mr-2" id="presentage_report">Proccess</button>
                          <a href="<?php echo base_url('admin/view/presentage_report'); ?>" class="btn btn-light">Cancel</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>

