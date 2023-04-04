<style type="text/css">
  .table th, .jsgrid .jsgrid-table th, .table td, .jsgrid .jsgrid-table td{
    border-top:none;
  }
</style>
<div class="row" style="margin-top: -20px;">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body"> 
        <?php 
          foreach($getdata as $dataEmployee){}
        ?>
         <div class="table-responsives">
            <div class="row">
              <div class="col-lg-12 grid-margin grid-margin-lg-0">
                <div class="card-body">
                  <div class="col-lg-12 grid-margin grid-margin-lg-0">
                    <div class="card-body">

                        <?php $this->apps->get_notification(); ?>
                          <table class="table">
                               <tr>

                                    <?php if($dataEmployee['flag'] == 0){ ?>



                                      <form method="POST" action="<?php echo base_url(); ?>admin/employee/active_leave">
                                      <td>
                                          <h5>Advance total</h5>
                                            <div class="form-group">
                                              <input type="text" name="advance_total" class="form-control">
                                            </div>
                                          </div>
                                      </td>

                                      <td>
                                        <h5>&nbsp;</h5>
                                         <div class="form-group">
                                            <input type="hidden" name="employee_code" class="form-control" value="<?php echo $dataEmployee['employee_code']; ?>">
                                            <input type="hidden" name="flag" value="1">
                                            <button type="submit" name="button" class="btn btn-info btn-sm">Activate</button>
                                          </div>
                                      </td>


                                    <?php }else{ ?>
                                      <form method="POST" action="<?php echo base_url(); ?>admin/employee/active_leave">
                                          <input type="hidden" name="employee_code" class="form-control" value="<?php echo $dataEmployee['employee_code']; ?>">
                                          <input type="hidden" name="flag" value="0">
                                          <td><button type="submit" name="button" class="btn btn-success btn-sm">Active</button></td>
                                      </form>

                                    <?php } ?>

                                </tr>
                          </table>
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