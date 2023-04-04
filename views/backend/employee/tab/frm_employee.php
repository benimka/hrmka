<div class="row" style="margin-top: -20px;">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body"> 
      	<?php 
    			foreach($getdata as $dataEmployee){}
    		?>
           <div class="table-responsives">
              <div class="row">
                <div class="col-lg-6 grid-margin grid-margin-lg-0">
                  <div class="card-body">
                    <form action="<?php echo base_url('admin/employee/edit_employee'); ?>" method="post" enctype="multipart/form-data">
                      <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Employee ID</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="employee_code" value="<?php echo $dataEmployee['employee_code']; ?>"  readonly />
                            <input type="hidden" name="company_code" value="<?php echo $dataEmployee['company_code']; ?>">
                            <input type="hidden" name="ids" value="2">
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Contract Number</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="number_contract" value="<?php echo $dataEmployee['number_contract']; ?>" />
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Level</label>
                          <div class="col-sm-9">
                            <select class="js-example-basic-single w-100" name="level" id="level" >
                              <option name="level" id="level" value="">Select level</option>
                            <?php
                                $quer = $this->db->query("SELECT * FROM mod_level ");
                                foreach ($quer->result() as $ro){

                                $selected=($ro->level==$dataEmployee["level"]) ? ' selected="selected" ':' ';
                            ?>
                              <option value="<?php echo $ro->level;?>" <?=$selected?>><?php echo $ro->level_name;?></option>
                            <?php
                                }
                            ?>
                          </select>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Department</label>
                          <div class="col-sm-9">
                            <select class="js-example-basic-single w-100" name="department_code" id="department_code" >
                              <option name="department_code" id="department_code" value="">Select department</option>
                            <?php
                              $quer = $this->db->query("SELECT * FROM mod_department ");
                                foreach ($quer->result() as $ro){
                                $selected=($ro->department_code==$dataEmployee["department_code"]) ? ' selected="selected" ':' ';
                            ?>
                              <option value="<?php echo $ro->department_code;?>"<?=$selected?>><?php echo $ro->department_name;?></option>
                            <?php
                                }
                            ?>
                          </select>
                          </div>
                        </div>


                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Parent Division</label>
                          <div class="col-sm-9">
                            <select class="js-example-basic-single w-100" name="parent" id="parent" >
                              <option name="parent" id="parent" value="">Select parent</option>
                            <?php
                                $query = $this->db->query("SELECT mod_employee.employee_name, mod_employee.employee_code
                                                          FROM mod_employee
                                                          INNER JOIN mod_position ON mod_position.position_code = mod_employee.position_code WHERE mod_status_code !='ST004' ");
                                foreach ($query->result() as $row){

                                $selected=($row->employee_code==$dataEmployee["parent"]) ? ' selected="selected" ':' ';
                            ?>
                              <option value="<?php echo $row->employee_code;?>"<?=$selected?>><?php echo $row->employee_name;?></option>
                            <?php
                                }
                            ?>
                          </select>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Position</label>
                          <div class="col-sm-9">
                            <select class="js-example-basic-single w-100" name="position_code" id="position_code" >
                              <option name="position_code" id="position_code" value="">Select position</option>
                            <?php
                                $query = $this->db->query("SELECT * FROM mod_position ");
                                foreach ($query->result() as $row){

                                $selected=($row->position_code==$dataEmployee["position_code"]) ? ' selected="selected" ':' ';
                            ?>
                              <option value="<?php echo $row->position_code;?>"<?=$selected?>><?php echo $row->position_name;?></option>
                            <?php
                                }
                            ?>
                          </select>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Location</label>
                          <div class="col-sm-9">
                            <select class="js-example-basic-single w-100" name="location_id" id="location_id" >
                              <option name="location_id" id="location_id" value="">Select location</option>
                            <?php
                                $query = $this->db->query("SELECT * FROM mod_location ");
                                foreach ($query->result() as $row){

                                $selected=($row->location_id==$dataEmployee["location"]) ? ' selected="selected" ':' ';
                            ?>
                              <option value="<?php echo $row->location_id;?>"<?=$selected?>><?php echo $row->location_name;?></option>
                            <?php
                                }
                            ?>
                          </select>
                          </div>
                        </div>


                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Date Of Hire</label>
                          <div class="col-sm-9">
                             <div id="datepicker-popup" class="input-group date">
                              <input type="text" class="form-control" name="date_of_hire" id="date_of_hire" value="<?php echo $dataEmployee["date_of_hire"] ?>">
                              <span class="input-group-addon input-group-append border-left">
                                <span class="ti-calendar input-group-text"></span>
                              </span>
                            </div>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Status</label>
                          <div class="col-sm-9">
                            <select class="js-example-basic-single w-100" name="mod_status_code" id="mod_status_code" >
                              <option name="mod_status_code" id="mod_status_code" value="">Select status</option>
                            <?php
                              $querys = $this->db->query("SELECT * FROM mod_employee_status WHERE mod_status_code != 'ST004' AND mod_status_code != 'ST005' ");
                              foreach ($querys->result_array() as $list1){

                              $selected=($list1['mod_status_code']==$dataEmployee["mod_status_code"]) ? ' selected="selected" ':' ';
                            ?>
                            <option value="<?php echo $list1['mod_status_code'];?>"<?=$selected?>><?php echo $list1['mod_status_name'];?> </option>
                            <?php
                              }
                            ?>
                          </select>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Identity ID</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="socialid" value="<?php echo $dataEmployee['socialid'];?>" />
                          </div>
                        </div>


                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Bank</label>
                          <div class="col-sm-9">
                            <select class="js-example-basic-single w-100" name="bank_id" id="bank_id" >
                              <option name="bank_id" id="bank_id" value="">Select bank</option>
                            <?php
                              $querys = $this->db->query("SELECT * FROM mod_bank ");
                              foreach ($querys->result_array() as $list1){
                              $selected=($list1['bank_id']==$dataEmployee["bank_id"]) ? ' selected="selected" ':' ';
                            ?>
                            <option value="<?php echo $list1['bank_id'];?>"<?=$selected?>><?php echo $list1['bank_name'];?> </option>
                            <?php
                              }
                            ?>
                          </select>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Bank Account Name</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="bank_account_name" value="<?php echo $dataEmployee['bank_account_name'];?>" />
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Bank Account Number</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="bank_account_no" value="<?php echo $dataEmployee['bank_account_no'];?>"/>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">BPJS Kesehatan</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="bpjs_kesehatan" value="<?php echo $dataEmployee['bpjs_kesehatan'];?>"/>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">BPJS Ketenagakerjaan</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="bpjs_ketenagakerjaan" value="<?php echo $dataEmployee['bpjs_ketenagakerjaan'];?>"/>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Shifting</label>
                          <div class="col-sm-9">
                            <select class="js-example-basic-single w-100" name="shift_code" id="shift_code" >
                              <option name="shift_code" id="shift_code" value="">Select shift</option>
                            <?php
                              $querys = $this->db->query("SELECT * FROM mod_shift WHERE shift_code !='SH002' AND status = '0' ");
                              foreach ($querys->result_array() as $list1){

                              $selected=($list1['shift_code']==$dataEmployee["shift_code"]) ? ' selected="selected" ':' ';
                            ?>
                            <option value="<?php echo $list1['shift_code'];?>"<?=$selected?>><?php echo $list1['shift_name'];?> </option>
                            <?php
                              }
                            ?>
                          </select>
                          </div>
                        </div> 

                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">ID Finger Print</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="pin" value="<?php echo $dataEmployee['pin'];?>"/>
                          </div>
                        </div>
                  </div>
                </div>

                <div class="col-lg-6 grid-margin grid-margin-lg-0">
                  <div class="card-body">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Employee Name</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="employee_name" value="<?php echo $dataEmployee['employee_name'];?>"/>
                        </div>
                      </div>


                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Place birth</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="place_birth" value="<?php echo $dataEmployee['place_birth'];?>"/>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Gender</label>
                      <div class="col-sm-4">
                        

<div class="form-check">
<label class="form-check-label">
  <input type="radio" class="form-check-input" name="sex" id="sex" value="M" <?php if ($dataEmployee['sex'] == 'M') { echo "checked"; } ?>>
  Male
</label>
</div>
                      </div>
                      <div class="col-sm-5">
<div class="form-check">
<label class="form-check-label">
  <input type="radio" class="form-check-input" name="sex" id="sex" value="F" <?php if ($dataEmployee['sex'] == 'F') { echo "checked"; } ?>>
  Female
</label>
</div>

                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Birthdate</label>
                      <div class="col-sm-9">
                        <div id="dateEdit" class="input-group date">
                          <input type="text" class="form-control" name="birth_date" id="birth_date" value="<?php echo $dataEmployee['birth_date'];?>">
                          <span class="input-group-addon input-group-append border-left">
                            <span class="ti-calendar input-group-text"></span>
                          </span>
                        </div>
                      </div>
                    </div>
                    <!-- <p class="card-description">
                        <b>Address</b>
                      </p>  -->
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">City</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="city" value="<?php echo $dataEmployee['city'];?>" />
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Address 1</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="address" value="<?php echo $dataEmployee['address'];?>" />
                      </div>
                    </div>

                     <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Address 2</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="address_2" value="<?php echo $dataEmployee['address_2'];?>" />
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Phone</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="phone" value="<?php echo $dataEmployee['phone'];?>" />
                      </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                          <input  type="email" name="email" class="form-control"  value="<?php echo $dataEmployee['email'];?>"/>
                        </div>
                      </div>

                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Status married</label>
                      <div class="col-sm-9">
                        <select class="js-example-basic-single w-100" name="status_married" id="status_married" >
                          <option  value="">Select</option>
                          <option  value="M/3"<?php if($dataEmployee['status_married'] == 'M/3'){echo"selected='selected'";} ?>>M/3</option>
                          <option  value="M/2"<?php if($dataEmployee['status_married'] == 'M/2'){echo"selected='selected'";} ?>>M/2</option>
                          <option  value="M/1"<?php if($dataEmployee['status_married'] == 'M/1'){echo"selected='selected'";} ?>>M/1</option>
                          <option  value="M/0"<?php if($dataEmployee['status_married'] == 'M/0'){echo"selected='selected'";} ?>>M/0</option>
                          <option  value="S/0"<?php if($dataEmployee['status_married'] == 'S/0'){echo"selected='selected'";} ?>>S/0</option>
                          <option  value="S/1"<?php if($dataEmployee['status_married'] == 'S/1'){echo"selected='selected'";} ?>>S/1</option>
                          <option  value="S/2"<?php if($dataEmployee['status_married'] == 'S/2'){echo"selected='selected'";} ?>>S/2</option>
                          <option  value="S/3"<?php if($dataEmployee['status_married'] == 'S/3'){echo"selected='selected'";} ?>>S/3</option>
                      </select>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Npwp</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="npwp" value="<?php echo $dataEmployee['npwp'];?>"/>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Region</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="religion" value="<?php echo $dataEmployee['religion'];?>"/>
                      </div>
                    </div> 

                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Term/Ahli waris</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="heir" value="<?php echo $dataEmployee['heir'];?>"/>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Emergency contact</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="emergency_contact" value="<?php echo $dataEmployee['emergency_contact'];?>"/>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Leave Current</label>
                      <div class="col-sm-9">
                        <input type="text" name="params_cuti" class="form-control txt" value="<?php echo $dataEmployee['params_cuti'];?>">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Last Year Leave</label>
                      <div class="col-sm-9">
                        <input type="text" name="params_cuti_last_year" class="form-control txt" value="<?php echo $dataEmployee['params_cuti_last_year'];?>">
                      </div>
                    </div>

                    <button type="submit" class="btn btn-primary me-2">Update</button>

                    <a href="<?php echo base_url('admin/employee'); ?>" class="btn btn-light">Cancel</a>
                  </div>
                </form>
                </div>


              </div>
            </div>
        </div>
    </div>
  </div>
</div>