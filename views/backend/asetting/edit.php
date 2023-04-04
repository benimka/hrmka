<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
              <?php foreach ($getdata as $key => $value) {} ?>
              <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"><?php echo $title; ?></h4>
                  <form method="POST" action="<?php echo site_url(); ?>admin/attendance/save" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Shift Code</label>
                      <input type="hidden" name="ids" value="2">
                      <input type="text" name="shift_codes" class="form-control" value="<?php echo $value['shift_code']; ?>" readonly>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputUsername1">Shift Name</label>
                      <input type="text" name="shift_name" class="form-control" value="<?php echo $value['shift_name']; ?>">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Work Day</label>
                      <input type="text" name="shift_day" class="form-control" value="<?php echo $value['shift_day']; ?>" readonly>
                    </div>

                    <table class="table table-hover table-striped">
                <tr>
                  <td style="width: 5px;"><input type="checkbox" onchange="checkAll(this)" name="chk[]" ></td>
                  <td>Day name</td>
                  <td>Shift In</td>
                  <td>Shift Out</td>
                </tr>
                <?php foreach ($getdata as $key => $val) {
                  if ($val['checkbox'] == 1 ) { $set_checked = "checked";}
                        else {$set_checked = ""; }
                ?>
                <tr>
                  <td><input type="checkbox" name="chkbox[]" value="1" <?php echo $set_checked; ?>></td>
                  <td><input type="hidden" name="shift_code[]" value="<?php echo $val['shift_code']; ?>"><input type="text" name="day_name[]" class="form-control" value="<?php echo $val['day_name']; ?>" readonly=""></td>
                  <td><input type="text" name="shift_in[]" class="form-control" value="<?php echo $val['shift_in']; ?>" ></td>
                  <td><input type="text" name="shift_out[]" class="form-control" value="<?php echo $val['shift_out']; ?>"></td>
                </tr>
                <?php } ?>
                <?php if($val['day_name'] == 'Monday'){ ?>

                  <tr>
                    <td><input type="checkbox" name="chkbox[]" value="1"></td>
                    <td><input type="text" name="day_name[]" class="form-control" value="Tuesday" readonly=""></td>
                    <td><input type="text" name="shift_in[]" class="form-control" value="08:30" ></td>
                    <td><input type="text" name="shift_out[]" class="form-control" value="17:30"></td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="chkbox[]" value="1"></td>
                    <td><input type="text" name="day_name[]" class="form-control" value="Wednesday" readonly=""></td>
                    <td><input type="text" name="shift_in[]" class="form-control" value="08:30" ></td>
                    <td><input type="text" name="shift_out[]" class="form-control" value="17:30"></td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="chkbox[]" value="1"></td>
                    <td><input type="text" name="day_name[]" class="form-control" value="Thursday" readonly=""></td>
                    <td><input type="text" name="shift_in[]" class="form-control" value="08:30:00" ></td>
                    <td><input type="text" name="shift_out[]" class="form-control" value="17:30:00"></td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="chkbox[]" value="1"></td>
                    <td><input type="text" name="day_name[]" class="form-control" value="Friday" readonly=""></td>
                    <td><input type="text" name="shift_in[]" class="form-control" value="08:30:00" ></td>
                    <td><input type="text" name="shift_out[]" class="form-control" value="17:30:00"></td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="chkbox[]" value="1"></td>
                    <td><input type="text" name="day_name[]" class="form-control" value="Saturday" readonly=""></td>
                    <td><input type="text" name="shift_in[]" class="form-control" value="09:00:00" ></td>
                    <td><input type="text" name="shift_out[]" class="form-control" value="14:00:00"></td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="chkbox[]" value="1"></td>
                    <td><input type="text" name="day_name[]" class="form-control" value="Sunday" readonly=""></td>
                    <td><input type="text" name="shift_in[]" class="form-control" value="09:00:00" ></td>
                    <td><input type="text" name="shift_out[]" class="form-control" value="16:00:00"></td>
                  </tr>
                <?php } elseif($val['day_name'] == 'Tuesday') {?>
                  <tr>
                    <td><input type="checkbox" name="chkbox[]" value="1"></td>
                    <td><input type="text" name="day_name[]" class="form-control" value="Wednesday" readonly=""></td>
                    <td><input type="text" name="shift_in[]" class="form-control" value="08:30:00" ></td>
                    <td><input type="text" name="shift_out[]" class="form-control" value="17:30:00"></td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="chkbox[]" value="1"></td>
                    <td><input type="text" name="day_name[]" class="form-control" value="Thursday" readonly=""></td>
                    <td><input type="text" name="shift_in[]" class="form-control" value="08:30:00" ></td>
                    <td><input type="text" name="shift_out[]" class="form-control" value="17:30:00"></td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="chkbox[]" value="1"></td>
                    <td><input type="text" name="day_name[]" class="form-control" value="Friday" readonly=""></td>
                    <td><input type="text" name="shift_in[]" class="form-control" value="08:30:00" ></td>
                    <td><input type="text" name="shift_out[]" class="form-control" value="17:30:00"></td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="chkbox[]" value="1"></td>
                    <td><input type="text" name="day_name[]" class="form-control" value="Saturday" readonly=""></td>
                    <td><input type="text" name="shift_in[]" class="form-control" value="09:00:00" ></td>
                    <td><input type="text" name="shift_out[]" class="form-control" value="14:00:00"></td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="chkbox[]" value="1"></td>
                    <td><input type="text" name="day_name[]" class="form-control" value="Sunday" readonly=""></td>
                    <td><input type="text" name="shift_in[]" class="form-control" value="09:00:00" ></td>
                    <td><input type="text" name="shift_out[]" class="form-control" value="16:00:00"></td>
                  </tr>
                <?php } elseif($val['day_name'] == 'Wednesday') {?>

                  <tr>
                    <td><input type="checkbox" name="chkbox[]" value="1"></td>
                    <td><input type="text" name="day_name[]" class="form-control" value="Thursday" readonly=""></td>
                    <td><input type="text" name="shift_in[]" class="form-control" value="08:30:00" ></td>
                    <td><input type="text" name="shift_out[]" class="form-control" value="17:30:00"></td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="chkbox[]" value="1"></td>
                    <td><input type="text" name="day_name[]" class="form-control" value="Friday" readonly=""></td>
                    <td><input type="text" name="shift_in[]" class="form-control" value="08:30:00" ></td>
                    <td><input type="text" name="shift_out[]" class="form-control" value="17:30:00"></td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="chkbox[]" value="1"></td>
                    <td><input type="text" name="day_name[]" class="form-control" value="Saturday" readonly=""></td>
                    <td><input type="text" name="shift_in[]" class="form-control" value="09:00:00" ></td>
                    <td><input type="text" name="shift_out[]" class="form-control" value="14:00:00"></td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="chkbox[]" value="1"></td>
                    <td><input type="text" name="day_name[]" class="form-control" value="Sunday" readonly=""></td>
                    <td><input type="text" name="shift_in[]" class="form-control" value="09:00:00" ></td>
                    <td><input type="text" name="shift_out[]" class="form-control" value="16:00:00"></td>
                  </tr>

                  <?php } elseif($val['day_name'] == 'Thursday') {?>


                  <tr>
                    <td><input type="checkbox" name="chkbox[]" value="1"></td>
                    <td><input type="text" name="day_name[]" class="form-control" value="Friday" readonly=""></td>
                    <td><input type="text" name="shift_in[]" class="form-control" value="08:30:00" ></td>
                    <td><input type="text" name="shift_out[]" class="form-control" value="17:30:00"></td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="chkbox[]" value="1"></td>
                    <td><input type="text" name="day_name[]" class="form-control" value="Saturday" readonly=""></td>
                    <td><input type="text" name="shift_in[]" class="form-control" value="09:00:00" ></td>
                    <td><input type="text" name="shift_out[]" class="form-control" value="14:00:00"></td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="chkbox[]" value="1"></td>
                    <td><input type="text" name="day_name[]" class="form-control" value="Sunday" readonly=""></td>
                    <td><input type="text" name="shift_in[]" class="form-control" value="09:00:00" ></td>
                    <td><input type="text" name="shift_out[]" class="form-control" value="16:00:00"></td>
                  </tr>

                  <?php } elseif($val['day_name'] == 'Friday') {?>

                  <tr>
                    <td><input type="checkbox" name="chkbox[]" value="1"></td>
                    <td><input type="text" name="day_name[]" class="form-control" value="Saturday" readonly=""></td>
                    <td><input type="text" name="shift_in[]" class="form-control" value="09:00:00" ></td>
                    <td><input type="text" name="shift_out[]" class="form-control" value="14:00:00"></td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="chkbox[]" value="1"></td>
                    <td><input type="text" name="day_name[]" class="form-control" value="Sunday" readonly=""></td>
                    <td><input type="text" name="shift_in[]" class="form-control" value="09:00:00" ></td>
                    <td><input type="text" name="shift_out[]" class="form-control" value="16:00:00"></td>
                  </tr>

                  <?php } elseif($val['day_name'] == 'Saturday') {?>
                  <tr>
                    <td><input type="checkbox" name="chkbox[]" value="1"></td>
                    <td><input type="text" name="day_name[]" class="form-control" value="Sunday" readonly=""></td>
                    <td><input type="text" name="shift_in[]" class="form-control" value="09:00:00" ></td>
                    <td><input type="text" name="shift_out[]" class="form-control" value="16:00:00"></td>
                  </tr>
                  <?php } ?>
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