<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MKA-Group</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/dist/css/AdminLTE.min.css">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <script type="text/javascript">

        var IDLE_TIMEOUT = 600; //seconds
        var _idleSecondsCounter = 0;
        document.onclick = function() {
            _idleSecondsCounter = 0;
        };
        document.onmousemove = function() {
            _idleSecondsCounter = 0;
        };
        document.onkeypress = function() {
            _idleSecondsCounter = 0;
        };
        window.setInterval(CheckIdleTime, 1000);

        function CheckIdleTime() {
            _idleSecondsCounter++;
            var oPanel = document.getElementById("SecondsUntilExpire");
            if (oPanel)
                oPanel.innerHTML = (IDLE_TIMEOUT - _idleSecondsCounter) + "";
            if (_idleSecondsCounter >= IDLE_TIMEOUT) {
                
                document.location.href = "<?php echo site_url(); ?>login/out";
            }
        }
        </script>
        
</head>
<body class="hold-transition lockscreen">
<div class="lockscreen-wrapper">
  <div class="lockscreen-logo">
    <a href="<?php echo base_url(); ?>ticketing"><b></b>&nbsp;<?php //echo $role_id; ?></a>
  </div>
</div>
<?php $this->load->view('alert');?>
<section class="content" align="center">
      <div class="row">

             <div class="row">
                  <?php foreach($module as $modul){?>
                    <?php if($modul['module_level'] == '0'){?>
                      <?php if($modul['module_path'] == 'ticketing'){?>
                      <div class="col-lg-6 col-xs-6">
                        <div class="small-box bg-aqua">
                          <div class="inner">
                            <h3><?php echo $modul['module_name']; ?></h3>
                          </div>
                          <a href="<?php echo $modul['module_path']; ?>" class="small-box-footer">Click <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                      </div>
                    <?php } else { ?>
                      <div class="col-lg-6 col-xs-6">
                        <div class="small-box bg-yellow">
                          <div class="inner">
                            <h3><?php echo $modul['module_name']; ?></h3>
                          </div>
                          <a href="<?php echo $modul['module_path']; ?>" class="small-box-footer">Click <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                      </div>
                      <?php } ?>
                    <?php }?>
                  <?php } ?>
              </div>     
          
      </div>

</section>
<script type="text/javascript">

  var $ok = jQuery.noConflict();
  $ok("#absen").click(function()
      {   
          var employee_code        = $ok('#employee_code').val();
          //var url                = "<?php echo base_url(); ?>hrm/master/insertmutasi";

          listarray                = [employee_code, from_company_name, from_division_name, from_position_name, company_code, division_code, position_code, date_mut, description];
          
          $ok.post(url, {xdata:listarray}, function(response){
            location.reload();
          });
      });
</script>
</body>
</html>
