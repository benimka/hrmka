<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
              
              <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"><?php echo $title; ?></h4>
                  <form method="POST" action="<?php echo site_url(); ?>admin/attendance/save" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Shift Code</label>
                      <input type="hidden" name="ids" value="1">
                      <input type="text" class="form-control" id="auto" name="auto" placeholder="Announcements name" value="<?php echo $auto; ?>" readonly>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputUsername1">Shift Name</label>
                      <input type="text" class="form-control" id="shift_name" name="shift_name" placeholder="Assets name" required>
                    </div>

                    <table class="table table-hover table-striped">
                      <tr>
                        <td style="width: 5px;"><input type="checkbox" onchange="checkAll(this)" name="chk[]" ></td>
                        <td>Day name</td>
                        <td>Shift In</td>
                        <td>Shift Out</td>
                      </tr>
                      
                      <tr>
                        <td><input type="checkbox" name="chkbox[]" value="1"></td>
                        <td><input type="hidden" name="shift_code[]" value="<?php echo $auto; ?>"><input type="text" name="day_name[]" class="form-control" value="Monday" readonly=""></td>
                        <td><input type="text" name="shift_in[]" class="form-control" value="08:30" ></td>
                        <td><input type="text" name="shift_out[]" class="form-control" value="17:30"></td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" name="chkbox[]" value="1"></td>
                        <td><input type="hidden" name="shift_code[]" value="<?php echo $auto; ?>"><input type="text" name="day_name[]" class="form-control" value="Tuesday" readonly=""></td>
                        <td><input type="text" name="shift_in[]" class="form-control" value="08:30" ></td>
                        <td><input type="text" name="shift_out[]" class="form-control" value="17:30"></td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" name="chkbox[]" value="1"></td>
                        <td><input type="hidden" name="shift_code[]" value="<?php echo $auto; ?>"><input type="text" name="day_name[]" class="form-control" value="Wednesday" readonly=""></td>
                        <td><input type="text" name="shift_in[]" class="form-control" value="08:30" ></td>
                        <td><input type="text" name="shift_out[]" class="form-control" value="17:30"></td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" name="chkbox[]" value="1"></td>
                        <td><input type="hidden" name="shift_code[]" value="<?php echo $auto; ?>"><input type="text" name="day_name[]" class="form-control" value="Thursday" readonly=""></td>
                        <td><input type="text" name="shift_in[]" class="form-control" value="08:30" ></td>
                        <td><input type="text" name="shift_out[]" class="form-control" value="17:30"></td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" name="chkbox[]" value="1"></td>
                        <td><input type="hidden" name="shift_code[]" value="<?php echo $auto; ?>"><input type="text" name="day_name[]" class="form-control" value="Friday" readonly=""></td>
                        <td><input type="text" name="shift_in[]" class="form-control" value="08:30" ></td>
                        <td><input type="text" name="shift_out[]" class="form-control" value="17:30"></td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" name="chkbox[]" value="1"></td>
                        <td><input type="hidden" name="shift_code[]" value="<?php echo $auto; ?>"><input type="text" name="day_name[]" class="form-control" value="Saturday" readonly=""></td>
                        <td><input type="text" name="shift_in[]" class="form-control" value="09:00" ></td>
                        <td><input type="text" name="shift_out[]" class="form-control" value="14:00"></td>
                      </tr>
                      <tr>
                        <td><input type="checkbox" name="chkbox[]" value="1"></td>
                        <td><input type="hidden" name="shift_code[]" value="<?php echo $auto; ?>"><input type="text" name="day_name[]" class="form-control" value="Sunday" readonly=""></td>
                        <td><input type="text" name="shift_in[]" class="form-control" value="09:00" ></td>
                        <td><input type="text" name="shift_out[]" class="form-control" value="13:00"></td>
                      </tr>
                    </table>

                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a href="<?php echo base_url('admin/attendance'); ?>" class="btn btn-light">Cancel</a>
                  </form>
                </div>
              </div>
            </div>
            
        </div>
    </div>
</div>

<script type="text/javascript">
  function checkAll(ele) {
       var checkboxes = document.getElementsByTagName('input');
       if (ele.checked) {
           for (var i = 0; i < checkboxes.length; i++) {
               if (checkboxes[i].type == 'checkbox' ) {
                   checkboxes[i].checked = true;
               }
           }
       } else {
           for (var i = 0; i < checkboxes.length; i++) {
               if (checkboxes[i].type == 'checkbox') {
                   checkboxes[i].checked = false;
               }
           }
       }
   }
 </script>