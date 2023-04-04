<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Skydash Admin</title>
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendors/feather/feather.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/vertical-layout-light/style.css">
  <link rel="shortcut icon" href="<?php echo base_url() ?>assets/images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <h4>Hello! <?php echo $name; ?></h4>
                <h6 class="font-weight-light">Next to continue.</h6>
                <?php $this->load->view('alert'); $this->load->view('flash');?>
              </div>
              
              <form class="pt-3" action="<?php echo base_url('verifylogin'); ?>" method="POST">
                <div class="form-group">
                  <input type="hidden" class="form-control form-control-lg" name="user_name" id="user_name" value="<?php echo $user_name; ?>"><button type="button" class="btn btn-inverse-info btn-icon" style="height:20px;width: 20px;">
                        <i class="ti-star"></i>
                      </button> <?php echo $user_name; ?>
                </div>

                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" name="user_password" id="user_password" placeholder="enter your password" value="<?php echo get_cookie('user_password'); ?>"> <?php echo $icon; ?>  <i style="color:red;font-size: 13px;font-style: normal;"><?php echo $invalid;?></i>
                </div>

              <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                     
                      <input name="remember" type="checkbox" <?php echo get_cookie('remember') ? 'checked="checked"' : ''; ?>/>
                      Stay signed in
                    <i class="input-helper"></i></label>
                  </div>
                </div>

                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input id="myCheck" name="check" type="checkbox" onclick="myFunction()"/>
                      Download finger print
                    <i class="input-helper"></i></label>
                  </div>
                  </div>

                  <input type="submit" name="login" id="login" class="btn btn-primary btn-icon-text" value="Next"/>
                </div>
                <div class="form-group" id="text" style="display:none">
                      <select class="form-group" name="ip" style="color: #000000;">
                        <option name="ip" value="">--select--</option>
                        <?php
                              $locations = $this->db->query("SELECT * FROM mod_device ");

                                foreach ($locations->result_array() as $loc){
                            ?>
                              <option name="ip" value="<?php echo $loc['ip'];?>"><?php echo $loc['device'];?></option>
                            <?php
                                }
                              
                            ?>
                      </select>
                    </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>

  <script src="<?php echo base_url() ?>assets/vendors/js/vendor.bundle.base.js"></script>
  <script src="<?php echo base_url() ?>assets/js/off-canvas.js"></script>
  <script src="<?php echo base_url() ?>assets/js/hoverable-collapse.js"></script>
  <script src="<?php echo base_url() ?>assets/js/template.js"></script>
  <script src="<?php echo base_url() ?>assets/js/settings.js"></script>
  <script src="<?php echo base_url() ?>assets/js/todolist.js"></script>

  <script type="text/javascript">
  function myFunction() {
  
    var checkBox = document.getElementById("myCheck");
    var text = document.getElementById("text");
    if (checkBox.checked == true){
      text.style.display = "block";
    } else {
       text.style.display = "none";
    }
  }


  function Stay() {
    var checkBox = document.getElementById("myCheck");
    var text = document.getElementById("text");
    if (checkBox.checked == true){
      text.style.display = "block";
    } else {
       text.style.display = "none";
    }
  }
</script>
  <!-- endinject -->
</body>

</html>
