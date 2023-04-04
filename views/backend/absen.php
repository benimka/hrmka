
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Clock In</title>
  <link rel="stylesheet" href="<?php echo base_url('')?>assets/css/feather.css">
  <link rel="stylesheet" href="<?php echo base_url('')?>assets/css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/cropper/csscrop.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/cropper/dropzone.css" />
  <link href="<?php echo base_url() ?>assets/cropper/cropper.css" rel="stylesheet"/>
  <script src="<?php echo base_url() ?>assets/cropper/dropzone.js"></script>
  <script src="<?php echo base_url() ?>assets/cropper/cropper.js"></script>
</head>
<style type="text/css">
  .responsive {
    width: 100%;
    height: auto;
  }
</style>
<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth lock-full-bg">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">

          <?php 
              $imagePath = "upload/".$pic;
              if(!file_exists($imagePath))
                  $imagePath = "upload/default.png";
          ?>
            <div class="auth-form-transparent text-left p-5 text-center"> 
              <div class="image_area">
                <forms method="post">
                  <label for="upload_image">
                    <img src="<?php echo $imagePath; ?>" alt="profile" id="uploaded_image" class="img-lg rounded-circle mb-3" />
                    <div class="overlay">
                        <div class="text">Click to Change Profile Image</div>
                    </div>
                      <input type="file" name="image" class="image" id="upload_image" style="display:none">
                    </label>
                  </forms>
                </div>
              <form class="pt-5" action="<?php echo base_url() ?>dashboard/clock_in" method="post">
                <div class="form-group">
                  <h3>Hi, <?php echo $user_name;?></h3>
                </div>
                <div class="mt-5">
                  <button type="submit" class="btn btn-circle btn-success btn-lg font-weight-medium" href="" style="color:#fff;">Clock In</button>
                </div>
              </form>
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
                      setInterval('location.reload()', 500); 
                  }
                });
          }
      });
    });
  
});
</script>

</body>
</html>
