<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body"> <?php $this->apps->get_notification(); ?>
                   <div class="table-responsives">
                      <div class="row">
                        <div class="col-lg-6 grid-margin grid-margin-lg-0">
                          <div class="card-body">
                            <h4 class="card-title"><?php echo $title; ?></h4>
                            <p>
                              <?php foreach($actions as $action) { ?>
                                <?php if($action['module_path'] == 'add') { ?>
                                <button type="button" class="btn btn-light mr-2" data-toggle="modal" data-target="#AddTipe" style="background-color:#fff;color:#4B49AC;border:1px solid #4B49AC; ">Add Position</button>
                                <?php } } ?>
                            </p>
                          </div>
                        </div>

                        <div class="col-lg-6 grid-margin grid-margin-lg-0">
                          <div class="card-body">
                            <h6 class="card-title">&nbsp;Filter Company:</h6>
                              <select class="js-example-basic-single" style="color:#000;width:100%" id="select_filters_company">
                                <option value="">Select</option>
                                <?php foreach($getcompany as $data_company) { ?>
                                <option value="<?php echo base_url('admin/position/index?query='); ?><?php echo $data_company['company_code'] ?>"<?php if($filter == $data_company['company_code']){echo "selected='selected'";} ?>><?php echo $data_company['company_name']; ?></option>
                                <?php } ?>
                              </select>
                           
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
         </div>
      </div>

        <div class="row">
              
              <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body"> <?php $this->apps->get_notification(); ?>
                  <h4 class="card-title">List Of Position</h4>
                  <div class="table-responsive">
                    <table id="sublisting" class="table">
                      <thead>
                        <tr>
                          <th>Position Name</th>
                          <th>Division Name</th>
                          <th>Company Name</th>
                          <th width="9%">Tools</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php foreach ($getdata as $key => $value) {?>
                            <tr>
                              <td>&nbsp;<?php echo $value['position_name']; ?></td>
                              <td>&nbsp;<?php echo $value['department_name']; ?></td>
                              <td>&nbsp;<?php echo $value['company_name']; ?></td>
                              <td>
                                <?php foreach ($actions as $modul){?>
                                  <?php if($modul['module_path']=='edit'){ ?>
                                    
                                      <a 
                                          href="javascript:;"
                                          data-doc_company_code="<?php echo $value['company_code']; ?>"
                                          data-doc_position_code="<?php echo $value['position_code']; ?>"
                                          data-doc_department_code="<?php echo $value['department_code']; ?>"
                                          data-doc_position_name="<?php echo $value['position_name']; ?>"
                                          data-doc_pos_inisial="<?php echo $value['pos_inisial']; ?>"
                                          data-toggle="modal" data-target="#UPDleave"
                                          class="badge badge-info" style="background-color:#fff;color:#4B49AC;border:1px solid #4B49AC; ">update
                                      </a>

                                  <?php } ?>

                                  <?php if($modul['module_path']=='delete'){ ?>
                                    <a href="<?php echo base_url('admin/position/'); ?><?php echo $modul['module_path']; ?>/<?php echo $value['position_id']; ?>" class="badge badge-info" style="background-color:#fff;color:#4B49AC;border:1px solid #4B49AC; ">delete</a>
                                  <?php } ?>


                                <?php } ?>
                              </td>
                           </tr>
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

<!-- Start ADD -->
  <div class="modal fade" id="AddTipe" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="AddTipe">
    <form id="submit_edit" action="<?php echo base_url('admin/position/add'); ?>" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <input type="hidden" name="ids" value="1">
          <h5 class="modal-title" id="exampleModalLabel"><b>Add Location </b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">

          <div class="form-group">
            <label for="exampleInputEmail1">Select Company</label>
            <select class="js-example-basic-single" style="color:#000;width:100%" name="company">
              <option value="">Select</option>
              <?php foreach($getcompany as $data_company) { ?>
              <option value="<?php echo $data_company['company_code'] ?>"><?php echo $data_company['company_name']; ?></option>
              <?php } ?>
            </select>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <div id="start_edit">
              <button class="btn btn-primary" type="submit" id="subloading">Add</button>
          </div>
          
        </div>
      </div>
      </div>
    </form>
    </div>
  </div>
  <!-- END ADD -->

<!-- Start EDIT -->
  <div class="modal fade" id="UPDleave" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="UPDleave">
    <form id="submit_position">
      <div class="modal-content">
        <div class="modal-header">
          <input type="hidden" name="ids" value="2">
          <h5 class="modal-title" id="exampleModalLabel"><b>Update Position</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">

          <div class="form-group">
            <input type="hidden" name="doc_company_code" id="doc_company_code">
            <label for="exampleInputEmail1">Position code</label>
            <input type="text" class="form-control" id="doc_position_code" name="doc_position_code" readonly>
          </div>

          <div class="form-group">
            <label>Department</label><br>
              <select class="js-example-basic-single w-100" name="doc_department_code" id="doc_department_code" style="width: 100%;" selected>
                <option value="">Select</option>
                <?php foreach($getdepartment as $key => $list3){ ?>
                  <option value="<?php echo $list3['department_code'];?>"><?php echo $list3['department_name'];?></option>
                <?php } ?>
              </select>
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Position name</label>
            <input type="text" class="form-control" id="doc_position_name" name="doc_position_name" >
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Initial</label>
            <input type="text" class="form-control" id="doc_pos_inisial" name="doc_pos_inisial" >
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <div id="start_edit">
              <button class="btn btn-primary" type="submit" id="subloading">Update</button>
          </div>
          
        </div>
      </div>
    </form>
    </div>
  </div>
  <!-- END EDIT -->

<script src="<?php echo base_url() ?>assets/js/jquery.min.js"></script>
  <script>
     $(document).ready(function() {
        
         $('#UPDleave').on('show.bs.modal', function (event) { 
             var div      = $(event.relatedTarget) // Tombol dimana modal di tampilkan
             var modal    = $(this)
             var ID3      = div.data('doc_department_code');
             modal.find("#doc_department_code option[value='" + ID3 + "']").prop("selected", true).trigger('change'); 

             // Isi nilai pada field  append
             modal.find('#doc_company_code').attr("value",div.data('doc_company_code'));
             modal.find('#doc_position_code').attr("value",div.data('doc_position_code'));
             modal.find('#doc_position_name').attr("value",div.data('doc_position_name'));
             modal.find('#doc_pos_inisial').attr("value",div.data('doc_pos_inisial'));

             });


             $('#submit_position').submit(function(e){
                //Start Save
                e.preventDefault(); 
                     $.ajax({
                         url:"<?php echo base_url(); ?>admin/position/save",
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
                          showInfoToast()
                          setInterval('location.reload()', 1000); 
                         }
                   
                     });
                     //End Save
                });

         });

     function redirect(Filters_company){
          window.location = Filters_company;
      }

      var selectElNew = document.getElementById('select_filters_company');
      
      selectElNew.onchange = function(){ 
          var Filters_company = this.value;
          redirect(Filters_company);
          
      };  

 </script>