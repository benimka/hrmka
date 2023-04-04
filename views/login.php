<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login DMS</title>
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
            <h4 class="text-center" style="font-size: 40px;">Human Resource Management System (MKA)</h4>
            &nbsp;
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <h4>Hello! let's get started</h4>
                <h6 class="font-weight-light">Sign in to continue.</h6>
                <?php $this->load->view('alert'); $this->load->view('flash');?>
              </div>
              
              <form class="pt-3" action="<?php echo base_url('login/authCheck'); ?>" method="POST">
                <div class="form-group">
                  <?php if($invalid != NULL){ ?>
                  <input type="email" class="form-control form-control-lg" name="user_name" id="exampleInputEmail1" placeholder="Username" style="border:1px solid red;" required> 
                  
                  <i class="ti-alert btn-icon-prepend" style="color:red;"></i> <i style="color:red;font-size: 13px;font-style: normal;"><?php echo $invalid;?></i>
                  <?php }else{ ?>

                    <input type="email" class="form-control form-control-lg" name="user_name" id="exampleInputEmail1" placeholder="Username" required> 

                  <?php } ?>

                </div>

              <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                   <a href="https://192.168.20.1:60004/coding/" style="text-decoration:none;">Back to home</a>
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
  <!-- endinject -->
</body>

</html>
