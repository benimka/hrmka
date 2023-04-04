<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/cropper/csscrop.css">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/cropper/dropzone.css" />
<link href="<?php echo base_url() ?>assets/cropper/cropper.css" rel="stylesheet"/>
<script src="<?php echo base_url() ?>assets/cropper/dropzone.js"></script>
<script src="<?php echo base_url() ?>assets/cropper/cropper.js"></script>
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-lg-4">
                <div class="border-bottom text-center pb-4">
                  <?php 
                      $imagePath = "upload/".$pic;
                      if(!file_exists($imagePath))
                          $imagePath = "upload/default.png";
                  ?>

                  <div class="image_area">
                  <form method="post">
                    <label for="upload_image">
                      <img src="<?php echo site_url(); ?>/<?php echo $imagePath; ?>" alt="profile" id="uploaded_image" class="img-lg rounded-circle mb-3" />
                      <div class="overlay">
                          <div class="text">Click to Change Profile Image</div>
                      </div>
                        <input type="file" name="image" class="image" id="upload_image" style="display:none">
                      </label>
                    </form>
                  </div>

                  <?php foreach($getdata as $data){} ?>
                  
                  <div class="mb-3">
                    <h3><?php echo $name; ?></h3>
                  </div>
                  <p class="w-75 mx-auto mb-3"><?php echo $data['position_name']; ?></p>
                </div>
                
                <div class="py-4">
                  <p class="clearfix">
                    <span class="float-left">
                      Employee Code   
                    </span>
                    <span class="float-right text-muted">
                      <?php echo $data['employee_code']; ?>
                    </span>
                  </p>
                  <p class="clearfix">
                    <span class="float-left">
                      Company   
                    </span>
                    <span class="float-right text-muted">
                      <?php echo $data['company_name']; ?>
                    </span>
                  </p>
                  <p class="clearfix">
                    <span class="float-left">
                      Location   
                    </span>
                    <span class="float-right text-muted">
                      <?php echo $data['location_name']; ?>
                    </span>
                  </p>
                  <p class="clearfix">
                    <span class="float-left">
                      Department
                    </span>
                    <span class="float-right text-muted">
                      <?php echo $data['department_name']; ?>
                    </span>
                  </p>
                  
                  <p class="clearfix">
                    <span class="float-left">
                      Level
                    </span>
                    <span class="float-right text-muted">
                      <?php echo $data['level_name']; ?>
                    </span>
                  </p>
                  <p class="clearfix">
                    <span class="float-left">
                      E-mail
                    </span>
                    <span class="float-right text-muted">
                      <a href="#"><?php echo $data['email']; ?></a>
                    </span>
                  </p>
                </div>
                
              </div>
              <div class="col-lg-8">
                <div class="d-block d-md-flex justify-content-between mt-4 mt-md-0">
                    <div class="text-center mt-4 mt-md-0">
                      <a href="#timeline" data-toggle="tab" class="btn btn-outline-primary">Personal</a>
                      <a href="#settings" data-toggle="tab" class="btn btn-outline-primary">Profile Update</a>
                    </div>
                </div>
                    
                  <div class="tab-content" style="margin-top:10px;border-top:1px solid #CED4DA">
                      
                    <div class="tab-pane active" id="timeline">
                      <div class="mt-4 py-2 border-top border-bottom">
                        <ul class="nav profile-navbar">
                          <li class="nav-item">
                            <a class="nav-link" href="#">
                              <i class="ti-user"></i>
                              Personal
                            </a>
                          </li>
                        </ul>
                        <div class="table-responsive">
                        <table class="table" id="responsive_profile">
                          
                          <tbody>

                             <tr>
                              <td>Place birth</td>
                              <td>:</td>
                              <td><?php echo $data['place_birth']; ?></td>
                            </tr>
                            <tr>
                              <td>Sex</td>
                              <td>:</td>
                              <td><?php if ($data['sex'] == 'M') { echo "Male"; } ?><?php if ($data['sex'] == 'F') { echo "Female"; } ?></td>
                            </tr>
                            <tr>
                              <td>Birth date</td>
                              <td>:</td>
                              <td><?php echo $data['birth_date']; ?></td>
                            </tr>
                            <tr>
                              <td>Date Of Hire</td>
                              <td>:</td>
                              <td><?php echo $data['date_of_hire']; ?></td>
                            </tr>
                            <tr>
                              <td>Married Status</td>
                              <td>:</td>
                              <td><?php echo $data['status_married']; ?></td>
                            </tr>
                            <tr>
                              <td>Religion</td>
                              <td>:</td>
                              <td><?php echo $data['religion']; ?></td>
                            </tr>
                            <tr>
                              <td>Address</td>
                              <td>:</td>
                              <td><?php echo $data['address']; ?></td>
                            </tr>
                            <tr>
                              <td>City</td>
                              <td>:</td>
                              <td><?php echo $data['city']; ?></td>
                            </tr>
                            <tr>
                              <td>Phone</td>
                              <td>:</td>
                              <td><?php echo $data['phone']; ?></td>
                            </tr>
                            <tr>
                              <td>Bank</td>
                              <td>:</td>
                              <td><?php echo $data['bank_name']; ?></td>
                            </tr>
                            <tr>
                              <td>Bank Account Name</td>
                              <td>:</td>
                              <td><?php echo $data['bank_account_name']; ?></td>
                            </tr>
                            <tr>
                              <td>Bank Account Number</td>
                              <td>:</td>
                              <td><?php echo $data['bank_account_no']; ?></td>
                            </tr>
                            <tr>
                              <td>Social ID</td>
                              <td>:</td>
                              <td><?php echo $data['socialid']; ?></td>
                            </tr>
                            <tr>
                              <td>Employee Status</td>
                              <td>:</td>
                              <td><?php echo $data['mod_status_name']; ?></td>
                            </tr>
                            <tr>
                              <td>Npwp</td>
                              <td>:</td>
                              <td><?php echo $data['npwp']; ?></td>
                            </tr>
                            <tr>
                              <td>BPJS Kesehatan</td>
                              <td>:</td>
                              <td><?php echo $data['bpjs_kesehatan']; ?></td>
                            </tr>
                            <tr>
                              <td>BPJS Ketenagakerjaan</td>
                              <td>:</td>
                              <td><?php echo $data['bpjs_ketenagakerjaan']; ?></td>
                            </tr>

                            <tr>
                              <td>Emergency contact</td>
                              <td>:</td>
                              <td><?php echo $data['emergency_contact']; ?></td>
                            </tr>

                            <tr>
                              <td>Heir / Ahli waris</td>
                              <td>:</td>
                              <td><?php echo $data['heir']; ?></td>
                            </tr>

                            <tr>
                              <td>Domicili</td>
                              <td>:</td>
                              <td><?php echo $data['address_2']; ?></td>
                            </tr>

                          </tbody>
                        </table>
                      </div>
                        </div>

                        <br>
                        <div class="mt-4 py-2 border-top border-bottom">
                        <ul class="nav profile-navbar">
                          <li class="nav-item">
                            <a class="nav-link" href="#">
                              <i class="ti-user"></i>
                              Documents
                            </a>
                          </li>
                        </ul>
                        
                        <div class="table-responsive">
                        <table class="table" class="table table-striped table-bordered grid" style="width:100%">
                          <thead>
                          <tr>
                            <th><b>Name</b></th>
                            <th>Date Expired</th>
                            <th>File</th>
                          </tr>
                          </thead>
                         
                        <?php foreach ($getdoc as $key => $doc) {?>

                        <?php if($doc['file_documents'] == "NULL"){ ?>

                        <?php }else{ ?>

                          <tr>
                            <td><?php echo $doc['documents_name']; ?></td>
                            <?php $date=date_create($doc['documents_expired']); ?>
                            <td><?php  echo date_format($date, "d-m-Y"); ?></td>
                            <td><a href="<?php echo base_url()?>document/<?php echo $doc['file_documents']; ?>" target="_blank">Open file</a> </td>
                          </tr>

                          <?php } ?>
                          <?php } ?>
                          </table>
                        </div>
                        </div>
                        <br>

                        <div class="mt-4 py-2 border-top border-bottom">
                        <ul class="nav profile-navbar">
                          <li class="nav-item">
                            <a class="nav-link" href="#">
                              <i class="ti-user"></i>
                              Insurance
                            </a>
                          </li>
                        </ul>
                        <div class="table-responsive">
                        <table id="example1" class="table">
                        <thead>
                            <tr>
                              <th><b>Name</b></th>
                              <th>Membership</th>
                              <th>Date Oh Birth</td>
                              <th>Sex</th>
                              <th>Maternit</th>
                            </tr>
                        </thead>
                             <?php foreach ($getinsurance as $key => $insu) {?>
                            <tr>
                              <td><?php echo $insu['insurance_name']; ?></td>
                              <td><?php echo $insu['membership']; ?></td>
                              <?php $date=date_create($insu['date_of_birth']); ?>
                              <td><?php  echo date_format($date, "d-m-Y"); ?></td>
                              <td><?php if($insu['ins_sex'] =="M"){echo "Male";}else{echo "Female";} ?></td>
                              <td><?php echo $insu['maternit']; ?></td>
                            </tr>
                            <?php } ?>
                          </table>
                        </div>
                        </div>

                        <br>
                        <div class="mt-4 py-2 border-top border-bottom">
                        <ul class="nav profile-navbar">
                          <li class="nav-item">
                            <a class="nav-link" href="#">
                              <i class="ti-user"></i>
                              Assets
                            </a>
                          </li>
                        </ul>
                        <div class="table-responsive">
                         <table class="table" id="example3">
                            <thead>
                            <tr>
                              <th><b>Item Name</b></th>
                              <th>Total</th>
                            </tr>
                            </thead>
                             <?php foreach ($getassets as $key => $ast) {?>
                            <tr>
                              <td><?php echo $ast['item_name']; ?></td>
                              <td><?php echo $ast['sum']; ?></td>
                            </tr>
                            <?php } ?>
                          </table>
                        </div>
                        </div>

                        <br>
                        <div class="mt-4 py-2 border-top border-bottom">
                            <ul class="nav profile-navbar">
                              <li class="nav-item">
                                <a class="nav-link" href="#">
                                  <i class="ti-user"></i>
                                  Experience
                                </a>
                              </li>
                            </ul>
                            <div class="table-responsive">
                            <table class="table" id="example4">
                            <thead>
                                <tr>
                                  <th><b>Company Name</b></th>
                                  <th>Start</th>
                                  <th>End</th>
                                  <th>Jobs</th>
                                </tr>
                            </thead>
                                 <?php foreach ($getexperience as $key => $exp) {?>
                                <tr>
                                  <td><?php echo $exp['company']; ?></td>
                                  <td><?php echo $exp['start']; ?></td>
                                  <td><?php echo $exp['end']; ?></td>
                                  <td><?php echo $exp['jobs']; ?></td>
                                </tr>
                                <?php } ?>
                              </table>
                            </div>
                        </div>
                        <br>
                        <div class="mt-4 py-2 border-top border-bottom">
                            <ul class="nav profile-navbar">
                              <li class="nav-item">
                                <a class="nav-link" href="#">
                                  <i class="ti-user"></i>
                                  Education
                                </a>
                              </li>
                            </ul>
                            <div class="table-responsive">
                            <table id="example5" class="table" style="width:100%">
                              <thead>
                                  <tr>
                                    <th><b>Name</b></th>
                                    <th>Start</th>
                                    <th>End</th>
                                    <th>Program studies</th>
                                  </tr>
                              </thead>
                                  
                                   <?php foreach ($geteducation as $key => $edu) {?>
                                  <tr>
                                    <td><?php echo $edu['education']; ?></td>
                                    <td><?php echo $edu['start']; ?></td>
                                    <td><?php echo $edu['end']; ?></td>
                                    <td><?php echo $edu['major']; ?></td>
                                  </tr>
                                  <?php } ?>
                                </table>
                            </div>
                        </div>
                        <br>
                        <div class="mt-4 py-2 border-top border-bottom">
                            <ul class="nav profile-navbar">
                              <li class="nav-item">
                                <a class="nav-link" href="#">
                                  <i class="ti-user"></i>
                                  Certification
                                </a>
                              </li>
                            </ul>
                            <div class="table-responsive">
                            <table class="table" id="example6">
                              <thead>
                              <tr>
                                    <th><b>Name</b></th>
                                    <th>Date</th>
                                    <th>File</th>
                                  </tr>
                              </thead>
                                 
                                   <?php foreach ($getsertifikat as $key => $ser) {?>
                                  <tr>
                                    <td><?php echo $ser['name']; ?></td>
                                    <td><?php echo $ser['date']; ?></td>
                                    <td><a href="<?php echo base_url()?>certificate/<?php echo $ser['filename']; ?>" target="_blank"><?php echo $ser['filename']; ?></a></td>
                                  </tr>
                                  <?php } ?>
                                </table>
                              </div>
                        </div>

                    </div>

                    <?php foreach ($getdata as $key => $query) {
                      # code...
                    } ?>

                    <div class="tab-pane" id="settings">
                  <form class="forms-sample" method="POST" action="<?php echo base_url(); ?>admin/profile/update_profile">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Email</label>
                      <input type="hidden" name="employee_code" value="<?php echo $query['employee_code']; ?>">
                      <input type="email" class="form-control" id="inputEmail" name="email" value="<?php echo $user_name; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Name</label>
                      <input type="text" class="form-control" id="inputName" name="employee_name" value="<?php echo $name; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Address</label>
                      <input type="text" class="form-control" id="inputName" name="address" value="<?php echo $query['address']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputConfirmPassword1">Place of Birth</label>
                      <input type="text" class="form-control" name="place_birth" value="<?php echo $query['place_birth']; ?>">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputConfirmPassword1">Place of Birth</label>
                      <input type="text" class="form-control" name="place_birth" value="<?php echo $query['place_birth']; ?>">
                    </div>

                     <div class="form-group">
                      <label for="exampleInputEmail1">Date of Birth</label>
                     
                      <div id="datepicker-popup" class="input-group date">
                        <input type="text" class="form-control" name="birth_date" id="birth_date" value="<?php echo $query['birth_date']; ?>">
                        <span class="input-group-addon input-group-append border-left">
                          <span class="ti-calendar input-group-text"></span>
                        </span>
                      </div>

                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Marital status</label>
                      <select class="form-control select2" name="status_married" style="width:100%;" required="">
                        <option name="status_married" value="<?php echo $query['status_married']; ?>"><?php echo $query['status_married']; ?></option>
                                <option name="status_married" value="">Select</option>
                                <option name="status_married" value="M/0">Single</option>
                                <option name="status_married" value="M/1">M/1</option>
                                <option name="status_married" value="M/2">M/2</option>
                                <option name="status_married" value="M/3">M/3</option>
                                <option name="status_married" value="M/4">S/4</option>
                                <option name="status_married" value="">Other..</option>
                            </select>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputConfirmPassword1">Identity Number</label>
                      <input type="text" class="form-control" id="inputName" name="socialid" value="<?php echo $query['socialid']; ?>">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputConfirmPassword1">NPWP Number</label>
                      <input type="text" class="form-control" id="inputName" name="npwp" value="<?php echo $query['npwp']; ?>">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputConfirmPassword1">Phone</label>
                      <input type="text" class="form-control" name="phone" value="<?php echo $query['phone']; ?>">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputConfirmPassword1">Bank Account (BRI/BCA/etc)</label>
                      <select class="form-control select2" name="bank_id" style="width:100%;" required="">
                          <option name="bank_id" value="<?php echo $query['bank_id'];?>"><?php echo $query['bank_name'];?></option>
                          <option name="bank_id" value="">Select</option>
                          <?php
                                if (count($getbank)){
                                  foreach($getbank as $key => $list3){
                                    if($list3['bank_id'] == $query['bank_id']){}else{
                              ?>
                                <option name="bank_id" value="<?php echo $list3['bank_id'];?>"><?php echo $list3['bank_name'];?></option>
                              <?php
                                    }
                                  }
                                }
                              ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputConfirmPassword1">Bank Account Name</label>
                      <input type="text" class="form-control" id="inputName" name="bank_account_name" value="<?php echo $query['bank_account_name']; ?>">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputConfirmPassword1">Bank Account Number</label>
                      <input type="text" class="form-control" id="inputName" name="bank_account_no" value="<?php echo $query['bank_account_no']; ?>">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputConfirmPassword1">BPJS Ketenagakerjaan Number</label>
                      <input type="text" class="form-control" id="inputName" name="bpjs_ketenagakerjaan" value="<?php echo $query['bpjs_ketenagakerjaan']; ?>">
                    </div>

                    <button type="submit" class="btn btn-primary mr-2">Update</button>
                    <button onClick="window.location.reload();" class="btn btn-light">Cancel</button>
                  </form>
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


        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalLabel">Crop Image Before Upload</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="img-container">
                      <div class="row">
                          <div class="col-md-12">
                              <img src="" id="sample_image"  style="width:100%;height: 100%;"/>
                          </div>
                          <div class="col-md-4">
                              <div class="preview"></div>
                          </div>
                      </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  
                  <div id="start">
                    <button type="button" class="btn btn-primary" id="crop" >Crop</button>
                    </div>
                </div>
            </div>
          </div>
      </div>  

<script>

$(document).ready(function(){

  $("#start").show();
  $("#end").hide();
  $("#loading").hide();

  var $modal = $('#modal');
  var image = document.getElementById('sample_image');
  var cropper;

  //$("body").on("change", ".image", function(e){
  $('#upload_image').change(function(event){
      var files = event.target.files;
      var done = function (url) {
          image.src = url;
          $modal.modal('show');
      };

      if (files && files.length > 0)
      {
        
            reader = new FileReader();
            reader.onload = function (event) {
                done(reader.result);
            };
            reader.readAsDataURL(files[0]);
         
      }
  });

  $modal.on('shown.bs.modal', function() {
      cropper = new Cropper(image, {
        aspectRatio: 1,
        viewMode: 3,
        preview: '.preview'
      });
  }).on('hidden.bs.modal', function() {
      cropper.destroy();
      cropper = null;
  });

  $("#crop").click(function(){
      canvas = cropper.getCroppedCanvas({
          width: 800,
          height: 800,
      });

      canvas.toBlob(function(blob) {
          //url = URL.createObjectURL(blob);
          var reader = new FileReader();
          reader.readAsDataURL(blob); 
          reader.onloadend = function() {
              var base64data = reader.result;  
            
              $.ajax({
                url:"<?php echo base_url('admin/profile/upload')?>",
                  method: "POST",                 
                  data: {image: base64data},
                  beforeSend: function() {
                        $("#loading").show();
                        $("#start").hide();
                        $("#end").show();
                      },
                  success: function(data){
                      console.log(data);
                      $modal.modal('hide');
                      $('#uploaded_image').attr('src', data);
                      setInterval('location.reload()', 100); 
                  }
                });
          }
      });
    });
  
});
</script>