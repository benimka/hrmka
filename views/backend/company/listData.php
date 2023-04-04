
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
          <div class="col-12 col-xl-8 mb-4 mb-xl-0"> <?php $this->apps->get_notification(); ?>
                  <h3 class="font-weight-bold">
                    <?php foreach($getCompany as $companys) {} echo $companys['company_name']; ?>
                  </h3>
                </div>
              <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">List Of Commissaris & Management</h4>
                  <p class="card-description">

                    <button type="button" class="btn btn-light mr-2" data-toggle="modal" data-target="#Commissaris">
                      Add Commissaris & Management
                    </button>
                  </p>
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Title</th>
                          <th>Year</th>
                          <th>Expired</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php 
                          $no = 0;
                          foreach ($getCommissaris as $key => $value) {
                          $no++;
                        ?>
                          <tr>
                            <td><?php echo $value['commissaris_name']; ?></td>
                            <td><?php echo $value['title_name']; ?></td>
                            <td><?php echo $value['commissaris_year']; ?></td>
                            <td><?php echo $value['commissaris_ex']; ?></td>
                            <td>

                              <a href="" class="btn btn-sm btn-info" data-toggle="modal"
                                                data-target="#Modal_edit<?php echo $value['commissaris_id']; ?>">Edit</a>

                            </td>
                          </tr>

                          <!-- Commissaris Modal -->
                            <div class="modal fade" id="Modal_edit<?php echo $value['commissaris_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <form action="<?php echo base_url('admin/company/edit_com/') ?>" method="post">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Commissaris & Management</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div> 
                                  <?php foreach($getCompany as $company) {} ?>
                                  <div class="modal-body">
                                  <div class="form-group">
                                    <form id="edit_com">
                                    <label for="exampleInputUsername1">Company Name</label>
                                    <input type="text" class="form-control" id="exampleInputUsername1" name="company_name" value="<?php echo $company['company_name'];  ?>" readonly>

                                    <input type="hidden" class="form-control" id="comis_id" name="comis_id" value="<?php echo $value['commissaris_id']; ?>">
                                    <input type="hidden" class="form-control" id="company_id" name="company_id" value="<?php echo $company['company_id'];  ?>" readonly>
                                  </div>
                                  <input type="hidden" name="uri" value="<?php echo $this->uri->segment(4); ?>">
                                   <div class="form-group">
                                      <label for="exampleInputUsername1">Title</label>
                                      <select class="form-control" style="color:#000;" name="com_title" id="com_title">
                                        <?php $qSelect = $this->db->query("SELECT * FROM mod_title ");
                                          foreach ($qSelect->result_array() as $row){ 
                                            $selected   = ($row["id"] == $value["commissaris_title"]) ? ' selected="selected" ' : '';
                                        ?>
                                        <option id="com_title" value="<?php echo $row['id']; ?>" <?=$selected?>><?php echo $row['title_name']; ?></option>
                                        <?php } ?>
                                      </select>
                                    </div> 


                                  <div class="form-group">
                                    <label for="exampleInputUsername1">Name</label>
                                    <input type="text" class="form-control" id="com_name" name="com_name" value="<?php echo $value["commissaris_name"] ?>">
                                  </div>

                                    <div class="form-group">
                                      <label for="exampleInputConfirmPassword1">Date</label>
                                        <div id="CommisarisDate<?php echo $no;?>" class="input-group date datepicker">
                                          <input type="text" class="form-control" name="date_coms" id="date_coms" value="<?php echo $value['commissaris_year']; ?>" required>
                                          <span class="input-group-addon input-group-append border-left">
                                            <span class="ti-calendar input-group-text"></span>
                                          </span> 
                                        </div>
                                    </div>


                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Length of service</label>
                                    <select class="" style="color:grey;width: 100%; height: 50px;border:1px solid #CED4DA;font-size: 14px;background-color: #f8f9fa;" name="lenght_of_services" id="lenght_of_services" required>
                                     <option value="-">select</option>
                                     <option value="1" <?php if($value['lenght_of_service'] == 1) {echo "selected";} ?>>1 year</option>
                                     <option value="2" <?php if($value['lenght_of_service'] == 2) {echo "selected";} ?>>2 year</option>
                                     <option value="3" <?php if($value['lenght_of_service'] == 3) {echo "selected";} ?>>3 year</option>
                                     <option value="4" <?php if($value['lenght_of_service'] == 4) {echo "selected";} ?>>4 year</option>
                                     <option value="5" <?php if($value['lenght_of_service'] == 5) {echo "selected";} ?>>5 year</option>
                                    </select>
                                  </div>

                                  <div class="form-group">
                                  <label for="exampleInputUsername1">Share Presentage</label>
                                  <input type="text" class="form-control" id="presentage" name="presentage" value="<?php echo number_format($value['presentage'],2); ?>" onBlur="this.value=formatCurrency(this.value);">

                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Edit</button>
                                  </div>
                                </form>
                                </div>
                              </div>
                            </div>
                        <?php } ?>
                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <?php foreach($getCompany as $company) {} ?>

            <!-- Document Modal -->
            <div class="modal fade" id="Document" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <form id="submit">
                <div class="modal-content">
                  <div class="modal-header">

                    <h5 class="modal-title" id="exampleModalLabel"><b>Add Document <?php echo $company['company_name'];  ?></b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <input type="hidden" class="form-control" name="company_id" id="company_id" value="<?php echo $company['company_id'];  ?>" readonly>
                  <div class="modal-body">
                  <div class="form-group">
                    <label for="exampleInputUsername1">Document Type</label>
                    <select class="js-example-basic-single" style="color:#000;width: 100%;" name="document_type" id="document_type" required>
                      <option value="">Select</option>
                      <?php $qSelect = $this->db->query("SELECT * FROM mod_document_type WHERE type_status = 1 AND parent_id = 0  ");
                        foreach ($qSelect->result_array() as $row){ ?>
                      <option value="<?php echo $row['type_id']; ?>"><?php echo $row['type_name']; ?></option>
                      <?php } ?>
                    </select>
                  </div>

                  <!-- ================================================================================================
                  ================================================================================================ -->


                  <div class="form-group" id="subs1"> <i onclick="Fsubs1()">-</i>
                    <label for="exampleInputUsername1">Sub 1</label>
                    <select class="js-example-basic-single" style="color:#000;width: 100%;" name="document_type1" id="sub1">
                      <option>Select</option>
                    </select>
                  </div>


                   <!-- ================================================================================================
                  ================================================================================================ -->



                  <div class="form-group" id="subs2"> <i onclick="Fsubs2()">-</i>
                    <label for="exampleInputUsername1">Sub 2</label>
                    <select class="js-example-basic-single" style="color:#000;width: 100%;" name="document_type2" id="sub2">
                      <option>Select</option>
                    </select>
                  </div>


                   <!-- ================================================================================================
                  ================================================================================================ -->


                  <div class="form-group" id="subs3"> <i onclick="Fsubs3()">-</i>
                    <label for="exampleInputUsername1">Sub 3</label>
                    <select class="js-example-basic-single" style="color:#000;width: 100%;" name="document_type3" id="sub3">
                      <option>Select</option>
                    </select>
                  </div>


                   <!-- ================================================================================================
                  ================================================================================================ -->



                  <div class="form-group" id="subs4"> <i onclick="Fsubs4()">-</i>
                    <label for="exampleInputUsername1">Sub 4</label>
                    <select class="js-example-basic-single" style="color:#000;width: 100%;" name="document_type4" id="sub4">
                      <option>Select</option>
                    </select>
                  </div>


                   <!-- ================================================================================================
                  ================================================================================================ -->



                  <div class="form-group" id="subs5"> <i onclick="Fsubs5()">-</i>
                    <label for="exampleInputUsername1">Sub 5</label>
                    <select class="js-example-basic-single" style="color:#000;width: 100%;" name="document_type5" id="sub5">
                      <option>Select</option>
                    </select>
                  </div>


                   <!-- ================================================================================================
                  ================================================================================================ -->



                  <div class="form-group" id="subs6"> <i onclick="Fsubs6()">-</i>
                    <label for="exampleInputUsername1">Sub 6</label>
                    <select class="js-example-basic-single" style="color:#000;width: 100%;" name="document_type6" id="sub6">
                      <option>Select</option>
                    </select>
                  </div>


                   <!-- ================================================================================================
                  ================================================================================================ -->



                  <div class="form-group" id="subs7"> <i onclick="Fsubs7()">-</i>
                    <label for="exampleInputUsername1">Sub 7</label>
                    <select class="js-example-basic-single" style="color:#000;width: 100%;" name="document_type7" id="sub7">
                      <option>Select</option>
                    </select>
                  </div>


                   <!-- ================================================================================================
                  ================================================================================================ -->



                  <div class="form-group" id="subs8"> <i onclick="Fsubs8()">-</i>
                    <label for="exampleInputUsername1">Sub 8</label>
                    <select class="js-example-basic-single" style="color:#000;width: 100%;" name="document_type8" id="sub8">
                      <option>Select</option>
                    </select>
                  </div>


                   <!-- ================================================================================================
                  ================================================================================================ -->



                  <div class="form-group" id="subs9"> <i onclick="Fsubs9()">-</i>
                    <label for="exampleInputUsername1">Sub 9</label>
                    <select class="js-example-basic-single" style="color:#000;width: 100%;" name="document_type9" id="sub9">
                      <option>Select</option>
                    </select>
                  </div>


                   <!-- ================================================================================================
                  ================================================================================================ -->



                  <div class="form-group" id="subs10"> <i onclick="Fsubs10()">-</i>
                    <label for="exampleInputUsername1">Sub 10</label>
                    <select class="js-example-basic-single" style="color:#000;width: 100%;" name="document_type10" id="sub10">
                      <option>Select</option>
                    </select>
                  </div>


                   <!-- ================================================================================================
                  ================================================================================================ -->


                  <div class="form-group" style="margin-top:-15px;">
                    <label for="exampleInputEmail1">Document name</label>
                    <input type="text" class="form-control" name="document_name" id="document_name" placeholder="document name" required>
                  </div>
                  

                   <div class="form-group" style="margin-top:-15px;">
                      <label>File upload</label>
                       <input type="file" name="userfile" class="form-control" required/> 
                      <!-- <input type="file" name="userfile" id="file" class="file-upload-default" required/>
                      <div class="input-group col-xs-12">
                        <input type="text" class="form-control file-upload-info" id="file" name="userfile" readonly placeholder="Upload Image">
                        <span class="input-group-append">
                          <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                        </span>
                      </div> -->
                    </div>


                  <div class="form-group" style="margin-top:-15px;"> 
                    <label for="exampleInputEmail1">Date</label>
                    <div id="datepicker-popup" class="input-group date">
                        <input type="text" class="form-control" name="document_year" id="document_year" required>
                        <span class="input-group-addon input-group-append border-left">
                          <span class="ti-calendar input-group-text"></span>
                        </span>
                      </div>
                  </div>

                  <div class="form-group row"  style="margin-top:-15px;">
                      <label class="col-sm-4 col-form-label">Select Expired</label>
                      <div class="col-sm-3">
                        <div class="form-check">
                          <label class="form-check-label">
                            <input type="radio" class="form-check-input" id="yes" name="yes" value="1" checked="checked">
                            Yes
                          </label>
                        </div>
                      </div>

                      <div class="col-sm-4">
                        <div class="form-check">
                          <label class="form-check-label">
                            <input type="radio" class="form-check-input" id="yes" name="yes" value="2">
                            No
                          </label>
                        </div>
                      </div>
                    </div>

                  <div class="form-group" id="ex_id" style="margin-top:-15px;">
                    <label for="exampleInputEmail1">Document expired</label>
                    <select class="js-example-basic-single1" style="color:#000;width: 100%;" name="date_ex" id="date_ex" required>
                     <option value="-">select</option>
                     <option value="1">1 year</option>
                     <option value="2">2 year</option>
                     <option value="3">3 year</option>
                     <option value="4">4 year</option>
                     <option value="5">5 year</option>
                    </select>
                  </div>

                  <br>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <div id="start">
                        <button class="btn btn-primary" type="submit" id="subloading">Save changes
                    </div>


                    <div id="end">
                        <button class="btn btn-primary" type="submit" id="subloading">Loading... 
                          <div class="spinner-border" role="status" id="loading" style="margin:-10px;"></div>
                    </div>
                    
                  </div>
                </div>
              </form>
              </div>
            </div>
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">List Of Document</h4>
                  <p class="card-description">

                    <?php foreach($getRuls as $moduleRules) { ?>
                      <?php if($moduleRules['module_name'] == 'Add') { ?>
                    <button type="button" class="btn btn-light mr-2" data-toggle="modal" data-target="#Document">
                      Add Document
                    </button>
                    <?php }} ?>
                  </p>
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                          <th>Type</th>
                          <th>Name</th>
                          <th>Size (KB)</th>
                          <th>Date</th>
                          <th>Expired</th>
                          <th>Status</th>
                          <th>Actions</th> 
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($getDocument as $key => $value) { ?>
                          <tr>
                            <?php 
                              $query = $this->db->query("SELECT type_name FROM mod_document_type WHERE parent_type='".$value['parent_type']."' AND parent_id = 0 ");
                              foreach ($query->result_array() as $row){
                            ?>
                            <td><b>
                              <a href="" data-toggle="modal" data-target=".bd-example-modal-xl<?php echo $value['document_type']; ?>" style="color:green;text-decoration: none;"><?php echo $row['type_name']; ?></a>
                              <?php 
                                  }
                              ?>
                            </b></td>
                            <td><?php echo $value['document_name']; ?></td>
                            <td><?php echo number_format($value['document_size'],0); ?></td>
                            <td><?php echo $value['document_year']; ?></td>
                            <td><?php echo $value['document_ex']; ?></td>
                            <td>
                                <?php if($value['document_status']  == 1){ ?>
                                  <button type="button" class="btn btn-inverse-success" style="height:40px;">Active</button>
                                <?php }elseif($value['document_status']  == 2){ ?>
                                  <button type="button" class="btn btn-inverse-info" style="height:40px;">In active</button>
                                <?php }elseif($value['document_status']  == 3){ ?>
                                  <button type="button" class="btn btn-inverse-danger" style="height:40px;">Expired</button>
                                <?php }else{ ?>
                                  <button type="button" class="btn btn-inverse-warning" style="height:40px;color:#000;">Not expired</button>
                                <?php } ?>

                              </td>
                            <td>

                              <?php foreach($getRuls as $moduleRules) { ?>
                                <?php if($moduleRules['module_name'] == 'Update') { ?>
                                  <a href="<?php  echo base_url('admin/company/edits/') ?><?php echo $value['document_id']; ?>" class="btn btn-inverse-info btn-sm" style="height:40px;padding-top: 12px;">updated</a>
                            <?php }} ?>
                          </td>
                          </tr>

                          <!-- Info Path Modal -->
                              <div class="modal fade bd-example-modal-xl<?php echo $value['document_type']; ?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title">Path Location</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      <div class="template-demo">
                                      <ol class="breadcrumb">

                                        <?php 
                                          $query = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$value['document_type']."' ;");

                                          foreach ($query->result_array() as $row){}
                                           
                                        ?>
                                        <?php if($row['level'] == 1){ ?>
                                          <li class="breadcrumb-item"><a href="#" style="text-decoration:none;">Document Type</a></li>&nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row['type_name']; ?></a></li> 
                                        <?php } ?>


                                        <!-- Level 2 -->

                                        <?php if($row['level'] == 2){ ?>

                                          <?php 
                                            $query1 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$value['document_type']."' ;");

                                            foreach ($query1->result_array() as $row1){}


                                              $query2 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row1['parent_id']."' ;");

                                              foreach ($query2->result_array() as $row2){}


                                          ?>

                                         <li class="breadcrumb-item"><a href="#" style="text-decoration:none;">Document Type</a></li>&nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;

                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row2['type_name']; ?></a></li>&nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row1['type_name']; ?></a></li>

                                        <?php } ?>


                                        <!-- Level 3 -->

                                        <?php if($row['level'] == 3){ ?>

                                          <?php 
                                            $query1 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$value['document_type']."' ;");

                                            foreach ($query1->result_array() as $row1){}


                                              $query2 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row1['parent_id']."' ;");

                                              foreach ($query2->result_array() as $row2){}


                                              $query3 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row2['parent_id']."' ;");

                                              foreach ($query3->result_array() as $row3){}


                                          ?>

                                         <li class="breadcrumb-item"><a href="#" style="text-decoration:none;">Document Type</a></li>&nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;

                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row3['type_name']; ?></a></li>&nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row2['type_name']; ?></a></li>&nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row1['type_name']; ?></a></li>

                                        <?php } ?>


                                        <!-- Level 4 -->

                                        <?php if($row['level'] == 4){ ?>

                                          <?php 
                                            $query1 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$value['document_type']."' ;");

                                            foreach ($query1->result_array() as $row1){}


                                              $query2 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row1['parent_id']."' ;");

                                              foreach ($query2->result_array() as $row2){}


                                              $query3 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row2['parent_id']."' ;");

                                              foreach ($query3->result_array() as $row3){}

                                              $query4 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row3['parent_id']."' ;");

                                              foreach ($query4->result_array() as $row4){}


                                          ?>

                                         <li class="breadcrumb-item"><a href="#" style="text-decoration:none;">Document Type</a></li>&nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;

                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row4['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row3['type_name']; ?></a></li>&nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row2['type_name']; ?></a></li>&nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row1['type_name']; ?></a></li>

                                        <?php } ?>

                                        <!-- Level 5 -->

                                        <?php if($row['level'] == 5){ ?>

                                          <?php 
                                            $query1 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$value['document_type']."' ;");

                                            foreach ($query1->result_array() as $row1){}


                                              $query2 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row1['parent_id']."' ;");

                                              foreach ($query2->result_array() as $row2){}


                                              $query3 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row2['parent_id']."' ;");

                                              foreach ($query3->result_array() as $row3){}

                                              $query4 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row3['parent_id']."' ;");

                                              foreach ($query4->result_array() as $row4){}


                                              $query5 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row4['parent_id']."' ;");

                                              foreach ($query5->result_array() as $row5){}


                                          ?>

                                         <li class="breadcrumb-item"><a href="#" style="text-decoration:none;">Document Type</a></li>&nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;

                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row5['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row4['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row3['type_name']; ?></a></li>&nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row2['type_name']; ?></a></li>&nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row1['type_name']; ?></a></li>

                                        <?php } ?>



                                        <!-- Level 6 -->

                                        <?php if($row['level'] == 6){ ?>

                                          <?php 
                                            $query1 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$value['document_type']."' ;");

                                            foreach ($query1->result_array() as $row1){}


                                              $query2 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row1['parent_id']."' ;");

                                              foreach ($query2->result_array() as $row2){}


                                              $query3 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row2['parent_id']."' ;");

                                              foreach ($query3->result_array() as $row3){}

                                              $query4 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row3['parent_id']."' ;");

                                              foreach ($query4->result_array() as $row4){}


                                              $query5 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row4['parent_id']."' ;");

                                              foreach ($query5->result_array() as $row5){}


                                              $query6 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row5['parent_id']."' ;");

                                              foreach ($query6->result_array() as $row6){}


                                          ?>

                                         <li class="breadcrumb-item"><a href="#" style="text-decoration:none;">Document Type</a></li>&nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row6['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row5['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row4['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row3['type_name']; ?></a></li>&nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row2['type_name']; ?></a></li>&nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row1['type_name']; ?></a></li>

                                        <?php } ?>



                                         <!-- Level 7 -->

                                        <?php if($row['level'] == 7){ ?>

                                          <?php 
                                            $query1 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$value['document_type']."' ;");

                                            foreach ($query1->result_array() as $row1){}


                                              $query2 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row1['parent_id']."' ;");

                                              foreach ($query2->result_array() as $row2){}


                                              $query3 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row2['parent_id']."' ;");

                                              foreach ($query3->result_array() as $row3){}

                                              $query4 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row3['parent_id']."' ;");

                                              foreach ($query4->result_array() as $row4){}


                                              $query5 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row4['parent_id']."' ;");

                                              foreach ($query5->result_array() as $row5){}


                                              $query6 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row5['parent_id']."' ;");

                                              foreach ($query6->result_array() as $row6){}


                                              $query7 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row6['parent_id']."' ;");

                                              foreach ($query7->result_array() as $row7){}


                                          ?>

                                         <li class="breadcrumb-item"><a href="#" style="text-decoration:none;">Document Type</a></li>&nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;

                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row7['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row6['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row5['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row4['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row3['type_name']; ?></a></li>&nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row2['type_name']; ?></a></li>&nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row1['type_name']; ?></a></li>

                                        <?php } ?>


                                         <!-- Level 8 -->

                                        <?php if($row['level'] == 8){ ?>

                                          <?php 
                                            $query1 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$value['document_type']."' ;");

                                            foreach ($query1->result_array() as $row1){}


                                              $query2 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row1['parent_id']."' ;");

                                              foreach ($query2->result_array() as $row2){}


                                              $query3 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row2['parent_id']."' ;");

                                              foreach ($query3->result_array() as $row3){}

                                              $query4 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row3['parent_id']."' ;");

                                              foreach ($query4->result_array() as $row4){}


                                              $query5 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row4['parent_id']."' ;");

                                              foreach ($query5->result_array() as $row5){}


                                              $query6 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row5['parent_id']."' ;");

                                              foreach ($query6->result_array() as $row6){}


                                              $query7 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row6['parent_id']."' ;");

                                              foreach ($query7->result_array() as $row7){}


                                              $query8 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row7['parent_id']."' ;");

                                              foreach ($query8->result_array() as $row8){}


                                          ?>

                                         <li class="breadcrumb-item"><a href="#" style="text-decoration:none;">Document Type</a></li>&nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;

                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row8['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row7['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row6['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row5['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row4['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row3['type_name']; ?></a></li>&nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row2['type_name']; ?></a></li>&nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row1['type_name']; ?></a></li>

                                        <?php } ?>


                                        <!-- Level 9 -->

                                        <?php if($row['level'] == 9){ ?>

                                          <?php 
                                            $query1 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$value['document_type']."' ;");

                                            foreach ($query1->result_array() as $row1){}


                                              $query2 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row1['parent_id']."' ;");

                                              foreach ($query2->result_array() as $row2){}


                                              $query3 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row2['parent_id']."' ;");

                                              foreach ($query3->result_array() as $row3){}

                                              $query4 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row3['parent_id']."' ;");

                                              foreach ($query4->result_array() as $row4){}


                                              $query5 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row4['parent_id']."' ;");

                                              foreach ($query5->result_array() as $row5){}


                                              $query6 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row5['parent_id']."' ;");

                                              foreach ($query6->result_array() as $row6){}


                                              $query7 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row6['parent_id']."' ;");

                                              foreach ($query7->result_array() as $row7){}


                                              $query8 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row7['parent_id']."' ;");

                                              foreach ($query8->result_array() as $row8){}


                                              $query9 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row8['parent_id']."' ;");

                                              foreach ($query9->result_array() as $row9){}

                                          ?>

                                         <li class="breadcrumb-item"><a href="#" style="text-decoration:none;">Document Type</a></li>&nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
                                       
                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row9['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row8['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row7['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row6['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row5['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row4['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row3['type_name']; ?></a></li>&nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row2['type_name']; ?></a></li>&nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row1['type_name']; ?></a></li>

                                        <?php } ?>


                                        <!-- Level 10 -->

                                        <?php if($row['level'] == 10){ ?>

                                          <?php 
                                            $query1 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$value['document_type']."' ;");

                                            foreach ($query1->result_array() as $row1){}


                                              $query2 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row1['parent_id']."' ;");

                                              foreach ($query2->result_array() as $row2){}


                                              $query3 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row2['parent_id']."' ;");

                                              foreach ($query3->result_array() as $row3){}

                                              $query4 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row3['parent_id']."' ;");

                                              foreach ($query4->result_array() as $row4){}


                                              $query5 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row4['parent_id']."' ;");

                                              foreach ($query5->result_array() as $row5){}


                                              $query6 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row5['parent_id']."' ;");

                                              foreach ($query6->result_array() as $row6){}


                                              $query7 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row6['parent_id']."' ;");

                                              foreach ($query7->result_array() as $row7){}


                                              $query8 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row7['parent_id']."' ;");

                                              foreach ($query8->result_array() as $row8){}


                                              $query9 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row8['parent_id']."' ;");

                                              foreach ($query9->result_array() as $row9){}


                                              $query10 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row9['parent_id']."' ;");

                                              foreach ($query10->result_array() as $row10){}
                                          ?>

                                         <li class="breadcrumb-item"><a href="#" style="text-decoration:none;">Document Type</a></li>&nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;

                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row10['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;

                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row9['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row8['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row7['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row6['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row5['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row4['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row3['type_name']; ?></a></li>&nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row2['type_name']; ?></a></li>&nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row1['type_name']; ?></a></li>

                                        <?php } ?>


                                      </ol>
                                      <button type="button" class="btn btn-secondary text-right" data-dismiss="modal">Close</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <!-- End Info Popup -->
                          
                        <?php } ?>
                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            
        </div>
    </div>
</div>


<!-- Commissaris Modal -->
<div class="modal fade" id="Commissaris" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Commissaris & Management</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php foreach($getCompany as $company) {} ?>
      <div class="modal-body">
      <div class="form-group">
        <form id="submit_com">
        <label for="exampleInputUsername1">Company Name</label>
        <input type="text" class="form-control" id="exampleInputUsername1" name="company_name" value="<?php echo $company['company_name'];  ?>" readonly>
        <input type="hidden" class="form-control" id="company_id" name="company_id" value="<?php echo $company['company_id'];  ?>" readonly>
      </div>

      <div class="form-group">
        <label for="exampleInputEmail1">Title</label>
        <select class="js-example-basic-single" style="color:#000;width: 100%;" name="com_title" id="com_title" required>
          <option value="">Select</option>
          <?php $qSelect = $this->db->query("SELECT * FROM mod_title ");
            foreach ($qSelect->result_array() as $row){ ?>
          <option value="<?php echo $row['id']; ?>"><?php echo $row['title_name']; ?></option>
          <?php } ?>
        </select>

      </div>

      <div class="form-group">
        <label for="exampleInputUsername1">Name</label>
        <input type="text" class="form-control" id="com_name" name="com_name" placeholder="Commissaris & Management name" required>
      </div>

      <div class="form-group">
        <label for="exampleInputConfirmPassword1">Date</label>
        <div id="dateCom" class="input-group date datepicker">
              <input type="text" class="form-control" name="com_ex" id="com_ex">
              <span class="input-group-addon input-group-append border-left">
                <span class="ti-calendar input-group-text"></span>
              </span> 
            </div>
      </div>

      <div class="form-group">
        <label for="exampleInputEmail1">Length of service</label>
        <select class="js-example-basic-single1" style="color:#000;width: 100%;" name="lenght_of_service" id="lenght_of_service" required>
         <option value="-">select</option>
         <option value="1">1 year</option>
         <option value="2">2 year</option>
         <option value="3">3 year</option>
         <option value="4">4 year</option>
         <option value="5">5 year</option>
        </select>
      </div>


      <div class="form-group">
        <label for="exampleInputUsername1">Share Presentage</label>
        <input type="text" class="form-control" id="presentage" name="presentage" value="0.00" onBlur="this.value=formatCurrency(this.value);">
      </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </form>
    </div>
  </div>
</div>



<!-- EDIT -->





  <?php foreach($getCompany as $company) {} ?>

  <!-- Document Modal -->
  <div class="modal fade" id="Edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="submit_edit">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b>Update Document <?php echo $company['company_name'];  ?> </b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <input type="hidden" class="form-control" name="id" id="id" readonly>
        <input type="hidden" class="form-control" name="company_ids" id="company_id" value="<?php echo $company['company_id'];  ?>" readonly>
        <div class="modal-body">
          <div class="form-group">
          <p style="color:green;">Dokumen Perizinan > Dokumen korporasi > Anggaran Dasar dan Perubahannya > 2021 > Draft - Perubahan Domisili > Draft</p>
        </div>
       <div class="form-group">

          <?php 

             $kode_type = '<input type="text" id="type">';
             $qSelect1 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id ='".$kode_type."'");
              foreach ($qSelect1->result_array() as $rows){} echo $rows['type_id'];
          ?>

          <label for="exampleInputUsername1">Document Type</label>
          <select class="form-control" style="color:#000;" name="types" id="type" readonly>
            <?php $qSelect = $this->db->query("SELECT * FROM mod_document_type ");
              foreach ($qSelect->result_array() as $row){ 
            ?>
            <option id="type" value="<?php echo $row['type_id']; ?>"><?php echo $row['type_name']; ?></option>
            <?php } ?>
          </select>
        </div> 
        <div class="form-group">
          <label for="exampleInputEmail1">Document Type</label>
          <input type="text" class="form-control" name="names" id="type_name" readonly>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Document name</label>
          <input type="text" class="form-control" name="names" id="name" readonly>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Year</label>
          <input type="text" class="form-control" name="years" id="year" readonly>
        </div>
        
         <div class="form-group">
            <label>File</label>
            <div class="input-group col-xs-12"> 
              <input type="text" class="form-control file-upload-info" id="upload" style="color: green;background-color: #e9ecef;" name="userfiles" disabled placeholder="Upload Image">
              <span class="input-group-append">
                <button class="file-upload-browse btn btn-primary" type="button" disabled>Upload</button>
              </span>
            </div>
          </div>
          <p style="color:green;"><input type="text" id="upload" style="border: none;color: green;"></p> <br>
        <div class="form-group">
          <label for="exampleInputEmail1">Document Expired</label>
          <div id="dateEdit" class="input-group date datepicker">
              <input type="text" class="form-control" name="ex" id="ex">
              <span class="input-group-addon input-group-append border-left">
                <span class="ti-calendar input-group-text"></span>
              </span>
            </div>
        </div>

        <?php 

          $qSelect = $this->db->query("SELECT * FROM mod_document WHERE company_id ='".$this->uri->segment(4)."' ");
           foreach ($qSelect->result_array() as $rows){}
       ?>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Select</label>
            <div class="col-sm-3">
              <div class="form-check">
                <label class="form-check-label">
                  <input type="radio" class="form-check-input" name="doc_status" id="doc_status" value="1">
                  Active
                </label>
              </div>
            </div>

            <div class="col-sm-3">
              <div class="form-check">
                <label class="form-check-label">
                  <input type="radio" class="form-check-input" name="doc_status" id="doc_status" value="2">
                  In active
                </label>
              </div>
            </div>

            <div class="col-sm-3">
              <div class="form-check">
                <label class="form-check-label">
                  <input type="radio" class="form-check-input" name="doc_status" id="doc_status" value="3">
                  Expired
                </label>
              </div>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <div id="start_edit">
              <button class="btn btn-primary" type="submit" id="subloading">Save changes
          </div>


          <div id="end_edit">
              <button class="btn btn-primary" type="submit" id="subloading" disabled>Loading... 
                <div class="spinner-border" role="status" id="loading" style="margin:-10px;"></div>
          </div>
          
        </div>
      </div>
    </form>
    </div>
  </div>
  <!-- END EDIT -->


<script src="<?php echo base_url() ?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/jquery.js"></script>
<script type="text/javascript" src=""></script>
<script>
$(document).ready(function(){
  // var $jnoc = jQuery.noConflict();
  // $("#document_year").datepicker({
  //    format: "yyyy",
  //    viewMode: "years", 
  //    minViewMode: "years",
  //    autoclose:true
  // });  
  
  
  $("#com_year").datepicker({
     format: "yyyy",
     viewMode: "years", 
     minViewMode: "years",
     autoclose:true
  });  

  $("#com_yearedit").datepicker({
     format: "yyyy",
     viewMode: "years", 
     minViewMode: "years",
     autoclose:true
  });  
})


</script>

<script>
     $(document).ready(function() {
         // Untuk sunting
         $('#Edit').on('show.bs.modal', function (event) { 

             var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
             var modal = $(this)
             var ID = div.data('doc_status');

             // Isi nilai pada field
             modal.find('#id').attr("value",div.data('id'));
             modal.find('#type_name').attr("value",div.data('type_name'));
             modal.find("#type").val(div.data('type'));
             modal.find('#name').attr("value",div.data('name'));
             modal.find('#year').attr("value",div.data('year'));
             modal.find('#ex').attr("value",div.data('ex'));
             modal.find('#upload').attr("value",div.data('upload'));
             modal.find('input[name="doc_status"][value="'+ID+'"]').prop('checked',true);
         });



         $('#Com_edit').on('show.bs.modal', function (event) { 
             var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
             var modal = $(this)


             $('#titles').change(function(){
                // AJAX request
                 $.ajax({
                    url:"https://192.168.20.1:60004/coding/eArsip/admin/company/getTitle",
                    method: 'post',
                    data: {parent_id: parent_id}, 
                    dataType: 'json',
                    success: function(response){
                        // Remove options
                        $('#sub1').find('option').not(':first').remove();

                        // Add options
                        $.each(response,function(index,data){
                            $('#sub1').append('<option value="'+data['type_id']+'">'+data['type_name']+'</option>');
                        });
                    }
                });
             });


             // Isi nilai pada field
             modal.find('#comis_id').attr("value",div.data('comis_id'));
             modal.find('#com_id').attr("value",div.data('com_id'));
             modal.find('#com_name').attr("value",div.data('com_name'));
             modal.find("#com_title").val(div.data('com_title')); //select option
             // modal.find("#com_title_name").val(div.data('com_title_name'));
             modal.find('#com_title_name').attr("value",div.data('com_title_name'));
             modal.find('#com_yearedit').attr("value",div.data('com_yearedit'));
             modal.find('#com_ex').attr("value",div.data('com_ex'));
         });
     });
 </script>
<script type="text/javascript">

    $(document).ready(function(){ 

        $("#start").show();
        $("#end").hide();

        $("#start_edit").show();
        $("#end_edit").hide();

        $("#loading").hide();

        $('#submit').submit(function(e){ 
            //Start Save  yes

          var yes           = document.getElementById("yes").checked == true
          var date_ex       = $('#date_ex').val();



          if(yes == 1){
            if(date_ex == "-") {
              alert('Document expired is empty');
              $("#date_ex").focus();
              return false;
            }
          }

          

            e.preventDefault(); 
                 $.ajax({
                     url:"<?php echo base_url(); ?>admin/company/do_upload",
                     type:"post",
                     data:new FormData(this),
                     processData:false,
                     contentType:false,
                     // cache:false,
                     // async:false,
                     beforeSend: function() {
                        $("#loading").show();
                        $("#start").hide();
                        $("#end").show();
                      },
                      complete: function() { 
                        $("#loading").hide();
                        $("#start").show();
                        $("#end").hide();
                        
                      },
                     success: function(data){
                      showSuccessToast()
                      setInterval('location.reload()', 1000); 
                     }
               
                 });
                 //End Save
            });



          $('#submit_edit').submit(function(event){ 

                 // Edit
                 event.preventDefault(); 
                 $.ajax({
                     url:"<?php echo base_url(); ?>admin/company/do_edit",
                     type:"post",
                     data:new FormData(this),
                     processData:false,
                     contentType:false,
                     // cache:false,
                     // async:false,
                     beforeSend: function() {
                        $("#loading").show();
                        $("#start_edit").hide();
                        $("#end_edit").show();
                      },
                      complete: function() { 
                        $("#loading").hide();
                        $("#start_edit").show();
                        $("#end_edit").hide();
                      },
                     success: function(data){
                      showInfoToast()
                      setInterval('location.reload()', 1000); 
                     }
               
                 });
                 //End Edit
            });


          $('#submit_com').submit(function(e){  
            //Start Save
            e.preventDefault(); 
                 $.ajax({
                     url:"<?php echo base_url(); ?>admin/company/save_com",
                     type:"post",
                     data:new FormData(this),
                     processData:false,
                     contentType:false,
                     // cache:false,
                     // async:false,
                     beforeSend: function() {
                        $("#loading").show();
                        $("#start").hide();
                        $("#end").show();
                      },
                      complete: function() { 
                        $("#loading").hide();
                        $("#start").show();
                        $("#end").hide();
                      },
                     success: function(data){
                      showInfoToastSave()
                      setInterval('location.reload()', 1000); 
                     }
               
                 });
                 //End Save
            });



          $('#edit_com').submit(function(e){  
            //Start Save
            e.preventDefault(); 
                 $.ajax({
                     url:"<?php echo base_url(); ?>admin/company/edit_com",
                     type:"post",
                     data:new FormData(this),
                     processData:false,
                     contentType:false,
                     // cache:false,
                     // async:false,
                     beforeSend: function() {
                        $("#loading").show();
                        $("#start").hide();
                        $("#end").show();
                      },
                      complete: function() { 
                        $("#loading").hide();
                        $("#start").show();
                        $("#end").hide();
                      },
                     success: function(data){
                         showInfoToastCom()
                         setInterval('location.reload()', 1000); 
                     }
               
                 });
                 //End Save
            });
         
 
    });


function formatCurrency(num) {
    num = num.toString().replace(/\$|\,/g,'');
    if(isNaN(num))
    num = "0";
    sign = (num == (num = Math.abs(num)));
    num = Math.floor(num*100+0.50000000001);
    cents = num%100;
    num = Math.floor(num/100).toString();
    if(cents<10)
    cents = "0" + cents;
    for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
    num = num.substring(0,num.length-(4*i+3))+','+
    num.substring(num.length-(4*i+3));
    return (((sign)?'':'-') + '' + num + '.' + cents);
}




  $('input[type="radio"]').click(function () {
      var inputValue = $(this).attr("value");
      if (inputValue == "1") {
        $("#ex_id").show();
      } else {
        $("#ex_id").hide();
      }
  });

 function Fsubs1(){ 

    $('#sub1').find('option').not(':first').remove();
    $('#sub2').find('option').not(':first').remove();
    $('#sub3').find('option').not(':first').remove();
    $('#sub4').find('option').not(':first').remove();
    $('#sub5').find('option').not(':first').remove();
    $('#sub6').find('option').not(':first').remove();
    $('#sub7').find('option').not(':first').remove();
    $('#sub8').find('option').not(':first').remove();
    $('#sub9').find('option').not(':first').remove();
    $('#sub10').find('option').not(':first').remove();

    $("#subs1").hide();
    $("#subs2").hide();
    $("#subs3").hide();
    $("#subs4").hide();
    $("#subs5").hide();
    $("#subs6").hide();
    $("#subs7").hide();
    $("#subs8").hide();
    $("#subs9").hide();
    $("#subs10").hide();

  

  
 }
 

 function Fsubs2(){ 

    $('#sub2').find('option').not(':first').remove();
    $('#sub3').find('option').not(':first').remove();
    $('#sub4').find('option').not(':first').remove();
    $('#sub5').find('option').not(':first').remove();
    $('#sub6').find('option').not(':first').remove();
    $('#sub7').find('option').not(':first').remove();
    $('#sub8').find('option').not(':first').remove();
    $('#sub9').find('option').not(':first').remove();
    $('#sub10').find('option').not(':first').remove();

    $("#subs2").hide();
    $("#subs3").hide();
    $("#subs4").hide();
    $("#subs5").hide();
    $("#subs6").hide();
    $("#subs7").hide();
    $("#subs8").hide();
    $("#subs9").hide();
    $("#subs10").hide();

   
 }

 function Fsubs3(){ 
  
    $('#sub3').find('option').not(':first').remove();
    $('#sub4').find('option').not(':first').remove();
    $('#sub5').find('option').not(':first').remove();
    $('#sub6').find('option').not(':first').remove();
    $('#sub7').find('option').not(':first').remove();
    $('#sub8').find('option').not(':first').remove();
    $('#sub9').find('option').not(':first').remove();
    $('#sub10').find('option').not(':first').remove();

    $("#subs3").hide();
    $("#subs4").hide();
    $("#subs5").hide();
    $("#subs6").hide();
    $("#subs7").hide();
    $("#subs8").hide();
    $("#subs9").hide();
    $("#subs10").hide();

    
 }

 function Fsubs4(){ 

    $('#sub4').find('option').not(':first').remove();
    $('#sub5').find('option').not(':first').remove();
    $('#sub6').find('option').not(':first').remove();
    $('#sub7').find('option').not(':first').remove();
    $('#sub8').find('option').not(':first').remove();
    $('#sub9').find('option').not(':first').remove();
    $('#sub10').find('option').not(':first').remove();

    $("#subs4").hide();
    $("#subs5").hide();
    $("#subs6").hide();
    $("#subs7").hide();
    $("#subs8").hide();
    $("#subs9").hide();
    $("#subs10").hide();

    
 }

 function Fsubs5(){ 
    $('#sub5').find('option').not(':first').remove();
    $('#sub6').find('option').not(':first').remove();
    $('#sub7').find('option').not(':first').remove();
    $('#sub8').find('option').not(':first').remove();
    $('#sub9').find('option').not(':first').remove();
    $('#sub10').find('option').not(':first').remove();

    $("#subs5").hide();
    $("#subs6").hide();
    $("#subs7").hide();
    $("#subs8").hide();
    $("#subs9").hide();
    $("#subs10").hide();
 }

 function Fsubs6(){ 

    $('#sub6').find('option').not(':first').remove();
    $('#sub7').find('option').not(':first').remove();
    $('#sub8').find('option').not(':first').remove();
    $('#sub9').find('option').not(':first').remove();
    $('#sub10').find('option').not(':first').remove();

    $("#subs6").hide();
    $("#subs7").hide();
    $("#subs8").hide();
    $("#subs9").hide();
    $("#subs10").hide();
 }

 function Fsubs7(){ 

    $('#sub7').find('option').not(':first').remove();
    $('#sub8').find('option').not(':first').remove();
    $('#sub9').find('option').not(':first').remove();
    $('#sub10').find('option').not(':first').remove();

    $("#subs7").hide();
    $("#subs8").hide();
    $("#subs9").hide();
    $("#subs10").hide();
 }

 function Fsubs8(){ 

    $('#sub8').find('option').not(':first').remove();
    $('#sub9').find('option').not(':first').remove();
    $('#sub10').find('option').not(':first').remove();

    $("#subs8").hide();
    $("#subs9").hide();
    $("#subs10").hide();
 }

 function Fsubs9(){ 
    $('#sub9').find('option').not(':first').remove();
    $('#sub10').find('option').not(':first').remove();

    $("#subs9").hide();
    $("#subs10").hide();
 }

 function Fsubs10(){ 
    $("#subs10").remove();
 }

     
</script>



