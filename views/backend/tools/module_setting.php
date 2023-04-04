<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
              <?php 

                $users = $this->db->query("SELECT * from sys_roles WHERE role_id ='".$this->uri->segment(4)."'")->row();


              ?>
              <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"><?php echo $title; ?></h4>
                  <b>Role Of <?php echo $users->role_name; ?></b>
                  <br>
                  <br>
                  <form method="POST" action="<?php echo  base_url() ?>admin/tools/update_module">
              <div class="col-sm-6">
                <ul>
                  
                  <?php foreach ($getmodule as $modul) { }
                    
                  ?>
                  <input type="hidden" name="segment" value="<?php echo $this->uri->segment(4); ?>">
                  <input type="hidden" name="flag[]" value="<?php echo $modul['module_id']; ?>">
                  <li>
                    <label class="form-check-label" for="materialInline1">&nbsp;&nbsp;Module</label>
                    <ul>
                      <?php foreach ($getmodule as $module){
                      if($module['module_level'] == 1 AND $module['module_id'] > 12){ ?>
                      <li>

                           <div class="form-check form-check-inline">
                              <input type="checkbox" class="form-check-input" name="flag[]" <?php foreach($cek as $key) { if ($key['oke'] == $module['module_id']) { echo "checked"; } } ?> value="<?php echo $module['module_id']; ?>">
                              &nbsp;&nbsp;<?php echo $module['module_name']; ?>
                            </div>
                            <ul>
                              <?php foreach ($getmodule as $modules){
                              if($modules['module_level'] == 2 AND $modules['module_id'] > 12){
                                if($modules['module_parent'] == $module['module_id']){
                              ?>

                                <li>
                                    <div class="form-check form-check-inline">
                                       <input type="checkbox" class="form-check-input" name="flag[]" <?php foreach($cek as $key) { if ($key['oke'] == $modules['module_id']) { echo "checked"; } } ?> value="<?php echo $modules['module_id']; ?>">
                                       &nbsp;&nbsp;<?php echo $modules['module_name']; ?>
                                     </div>

                                     <ul>
                                       <?php foreach ($getmodule as $mod){
                                       if($mod['module_level'] == 3 AND $mod['module_id'] > 12){
                                         if($mod['module_parent'] == $modules['module_id']){
                                       ?>
                                          <li>
                                            <div class="form-check form-check-inline">
                                               <input type="checkbox" class="form-check-input" name="flag[]" <?php foreach($cek as $key) { if ($key['oke'] == $mod['module_id']) { echo "checked"; } } ?> value="<?php echo $mod['module_id']; ?>">
                                               &nbsp;&nbsp;<?php echo $mod['module_name']; ?>
                                             </div>
                                          </li>
                                        <?php }}} ?>
                                     </ul>

                                </li>
                              <?php }}} ?>
                            </ul>
                         </li>
                    <?php }} ?>
                    </ul>
                  </li>
                <?php  ?>
                </ul>
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"></label>
                  <div class="col-sm-6">
                <a href="<?php echo base_url() ?>admin/tools/module" class="btn btn-default btn-sm">cancel</a>
                <button type="submit" class="btn btn-default btn-sm">save</button>
                </div>
                </div>
              </div>
             </form>
                </div>
              </div>
            </div>
            
        </div>
    </div>
</div>