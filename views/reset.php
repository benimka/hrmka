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
                <!-- <h6 class="font-weight-light" style="color:red;">Next to reset session login DSM</h6> -->
                <?php $this->load->view('alert'); $this->load->view('flash');?>
              </div>
              
              <form class="pt-3" action="<?php echo base_url('login/resets'); ?>" method="POST">
                
                <div class="form-group">
                  <input type="hidden" class="form-control form-control-lg" name="user_name" id="exampleInputEmail1" value="<?php echo $name; ?>">
                  <input type="password" class="form-control form-control-lg" name="user_password" id="show" placeholder="enter your password"> <?php echo $icon; ?>  <i style="color:red;font-size: 13px;font-style: normal;"><?php echo $invalid;?></i>
                </div>

              <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input" onclick="myFunction()">
                      Show password
                    <i class="input-helper"></i></label>
                  </div>
                  <button type="submit" class="btn btn-primary btn-icon-text">Next</button>
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
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="<?php echo base_url() ?>assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="<?php echo base_url() ?>assets/js/off-canvas.js"></script>
  <script src="<?php echo base_url() ?>assets/js/hoverable-collapse.js"></script>
  <script src="<?php echo base_url() ?>assets/js/template.js"></script>
  <script src="<?php echo base_url() ?>assets/js/settings.js"></script>
  <script src="<?php echo base_url() ?>assets/js/todolist.js"></script>

  <script type="text/javascript">
  function myFunction() {
  var x = document.getElementById("show");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
  <!-- endinject -->
</body>

</html>
