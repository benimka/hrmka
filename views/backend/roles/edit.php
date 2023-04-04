<?php foreach ($getdata as $key => $val) {} ?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row"> 
          <div class="col-md-12 grid-margin grid-margin-md-0 stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Manage Roles <?php echo $val['role_name']; ?></h4>
                  <br>

              <form class="forms-sample" method="POST" action="<?php echo base_url(); ?>admin/roles/save">
                <input type="hidden" name="rols_id" value="<?php echo $val['role_id']; ?>">
                  <ul>
                    <?php foreach ($getModule as $key => $value) { 

                      if($value['module_id'] == 1){

                    ?>

                  <li>
                      <div class="form-check">
                          <label class="form-check-label text-muted"><?php echo $value['module_name']; ?>
                            <input name="role_id[]" type="checkbox" <?php foreach($cek as $key) { if ($key['oke'] == $value['module_id']) { echo "checked"; } } ?> value="<?php echo $value['module_id']; ?>"/>
                        </div>

                        </label>
                        <ul>
                          <li>
                            <?php foreach ($getModule as $key => $vals10) { ?>
                               <?php 
                                  if($vals10['module_parent'] == $value['module_id'] ) {
                                ?>
                            <div class="form-check">
                              <label class="form-check-label text-muted"><?php echo $vals10['module_name']; ?>
                                <input name="role_id[]" type="checkbox" <?php foreach($cek as $key) { if ($key['oke'] == $vals10['module_id']) { echo "checked"; } } ?> value="<?php echo $vals10['module_id']; ?>"/>
                            </div>
                          <?php } } ?>
                          </li>
                        </ul>
                  </li>
                <?php }} ?>

                
                    <?php foreach ($getModule as $key => $val0) { 

                      if($val0['module_id'] == 9){

                    ?>

                  <li>
                      <div class="form-check">
                          <label class="form-check-label text-muted"><?php echo $val0['module_name']; ?>
                            <input name="role_id[]" type="checkbox" <?php foreach($cek as $key) { if ($key['oke'] == $val0['module_id']) { echo "checked"; } } ?> value="<?php echo $val0['module_id']; ?>"/>
                            </div>
                        </label>

                        <ul>
                           <?php foreach ($getModule as $key => $val1) {

                                if($val1['module_parent'] == $val0['module_id']){
                               ?>
                                  <li>
                                    <div class="form-check">
                                        <label class="form-check-label text-muted"><?php echo $val1['module_name']; ?>
                                          <input name="role_id[]" type="checkbox" <?php foreach($cek as $key) { if ($key['oke'] == $val1['module_id']) { echo "checked"; } } ?> value="<?php echo $val1['module_id']; ?>"/>
                                      </div>

                                      <?php foreach ($getModule as $key => $val2) { 

                                        if($val2['module_id'] == 12){
                                      ?>

                                       <?php 
                                        if($val2['module_parent'] == $val1['module_id'] ) {
                                      ?>
                                      <ul>
                                        <li>
                                          <div class="form-check">
                                              <label class="form-check-label text-muted"><?php echo $val2['module_name']; ?>
                                                <input name="role_id[]" type="checkbox" <?php foreach($cek as $key) { if ($key['oke'] == $val2['module_id']) { echo "checked"; } } ?> value="<?php echo $val2['module_id']; ?>"/>
                                            </div>

                                              <ul>
                                                <li>
                                                  <?php foreach ($getModule as $key => $vals1) { ?>
                                                     <?php 
                                                        if($vals1['module_parent'] == $val2['module_id'] ) {
                                                      ?>
                                                  <div class="form-check">
                                                    <label class="form-check-label text-muted"><?php echo $vals1['module_name']; ?>
                                                      <input name="role_id[]" type="checkbox" <?php foreach($cek as $key) { if ($key['oke'] == $vals1['module_id']) { echo "checked"; } } ?> value="<?php echo $vals1['module_id']; ?>"/>
                                                  </div>
                                                <?php } } ?>
                                                </li>
                                              </ul>
                                        </li>
                                        </ul>
                                       <?php } ?>


                                      <?php  }else{ ?>

                                           <?php 
                                              if($val2['module_parent'] == $val1['module_id'] ) {
                                            ?>
                                            <ul>
                                              <li>
                                                <div class="form-check">
                                                    <label class="form-check-label text-muted"><?php echo $val2['module_name']; ?>
                                                      <input name="role_id[]" type="checkbox" <?php foreach($cek as $key) { if ($key['oke'] == $val2['module_id']) { echo "checked"; } } ?> value="<?php echo $val2['module_id']; ?>"/>
                                                  </div>
                                              </li>
                                              </ul>
                                             <?php } ?>


                                      <?php } ?>

                                      <?php } ?>
                                  </li>
                                
                              <?php }} ?>
                        </ul>
                  </li>
                <?php }} ?>





                <?php foreach ($getModule as $key => $val3) {

                  if($val3['module_id'] == 10){
                 ?>
                    <li>
                      <div class="form-check">
                          <label class="form-check-label text-muted"><?php echo $val3['module_name']; ?>
                            <input name="role_id[]" type="checkbox"  <?php foreach($cek as $key) { if ($key['oke'] == $val3['module_id']) { echo "checked"; } } ?> value="<?php echo $val3['module_id']; ?>"/>
                        </div>

                        <?php foreach ($getModule as $key => $val4) { 

                          if($val4['module_parent'] == $val3['module_id'] ) {
                        ?>
                        <ul>
                          <li>
                            <div class="form-check">
                                <label class="form-check-label text-muted"><?php echo $val4['module_name']; ?>
                                  <input name="role_id[]" type="checkbox" <?php foreach($cek as $key) { if ($key['oke'] == $val4['module_id']) { echo "checked"; } } ?> value="<?php echo $val4['module_id']; ?>"/>
                              </div>
                          </li>
                          </ul>
                         <?php } ?>

                        <?php } ?>
                    </li>
                  
                <?php }} ?>


                <?php foreach ($getModule as $key => $val5) {

                  if($val5['module_id'] == 41){
                 ?>
                    <li>
                      <div class="form-check">
                          <label class="form-check-label text-muted"><?php echo $val5['module_name']; ?>
                            <input name="role_id[]" type="checkbox"  <?php foreach($cek as $key) { if ($key['oke'] == $val5['module_id']) { echo "checked"; } } ?> value="<?php echo $val5['module_id']; ?>"/>
                        </div>

                        <?php foreach ($getModule as $key => $val6) { 

                          if($val6['module_parent'] == $val5['module_id'] ) {
                        ?>
                        <ul>
                          <li>
                            <div class="form-check">
                                <label class="form-check-label text-muted"><?php echo $val6['module_name']; ?>
                                  <input name="role_id[]" type="checkbox" <?php foreach($cek as $key) { if ($key['oke'] == $val6['module_id']) { echo "checked"; } } ?> value="<?php echo $val6['module_id']; ?>"/>
                              </div>
                          </li>
                          </ul>
                         <?php } ?>

                        <?php } ?>
                    </li>
                  
                <?php }} ?>
                </ul>

                <?php if($val['role_id'] == 1) {?>

                   <button type="submit" class="btn btn-primary mr-2" disabled>Save</button>

                <?php }else{ ?>

                   <button type="submit" class="btn btn-primary mr-2">Save</button>

                <?php } ?>

               
                <a href="<?php echo base_url('admin/roles'); ?>" class="btn btn-light">Cancel</a>

              </form>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>