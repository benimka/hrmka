<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>HRMS</title>

  <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendors/feather/feather.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/vertical-layout-light/style.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/dataTables.bootstrap4.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css//jquery.toast.min.css">

  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/select2.min.css">

  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/select2-bootstrap.min.css">

  <link href="<?php echo base_url() ?>assets/css/jquery-ui.css" rel="stylesheet">

 

  <style type="text/css">
    .theme-setting-wrapper{display: none;}
    .float-none float-sm-right d-block mt-1 mt-sm-0 text-center{display: none;}
    .select2-container--default .select2-selection--single{
      padding-top: 10px;
      height: 50px;
      background-color: #f8f9fa;
      border: 1px solid #CED4DA;
    }

    .select2-selection__arrow {
      padding-top: 50px;
    }

    .js-example-basic-multiple{
      width: 1000px;
      border: none;
    }

    .nav-link {
      position:relative;
    }

    div.scrollmenu {
      background-color: #333;
      overflow: auto;
      white-space: nowrap;
    }

    div.scrollmenu a {
      display: inline-block;
      color: white;
      text-align: center;
      padding: 14px;
      text-decoration: none;
    }

    div.scrollmenu a:hover {
      background-color: #777;
    }

    #loading {
      display: flex;
      align-items: center;
      justify-content: center;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: #fff;
      z-index: 9999;
    }

    .loader {
      border: 8px solid #f3f3f3;
      border-top: 8px solid #3498db;
      border-radius: 50%;
      width: 50px;
      height: 50px;
      animation: spin 2s linear infinite;
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    ::-webkit-scrollbar {
      width: 20px;
    }

    ::-webkit-scrollbar-track {
      background-color: transparent;
    }

    ::-webkit-scrollbar-thumb {
      background-color: #d6dee1;
      border-radius: 40px;
      border: 8px solid transparent;
      background-clip: content-box;
    }

    ::-webkit-scrollbar-thumb:hover {
      background-color: #4B49AC;
    }

  </style>
</head>
<body>
  <div class="container-scroller">
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="<?php echo base_url('dashboard'); ?>">Hrms</a>
        <a class="navbar-brand brand-logo-mini" href="<?php echo base_url('dashboard'); ?>">Hrms</a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">

              <?php 
                $imagePath = "upload/".$pic;
                if(!file_exists($imagePath))
                    $imagePath = "upload/default.png";
            ?>
            <img src="<?php echo site_url(); ?>/<?php echo $imagePath; ?>" alt="profile">
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="<?php echo base_url('admin/users/setting/') ?><?php echo $user_id; ?>">
                <i class="ti-settings text-primary"></i>
                Change Password 
              </a>
              <a class="dropdown-item" href="<?php echo base_url('login/logout');?>/<?php echo $user_name;?>">
                <i class="ti-power-off text-primary"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">

      <nav class="sidebar sidebar-offcanvas" id="sidebar">

      <?php echo $this->apps->parent_menu(); ?>

      </nav>
      