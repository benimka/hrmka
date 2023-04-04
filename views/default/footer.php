
    </div>
  </div>

  <script src="<?php echo base_url() ?>assets/js/jquery.js"></script>
  <script src="<?php echo base_url() ?>assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- <script src="<?php echo base_url() ?>assets/vendors/chart.js/Chsart.min.js"></script> -->

  <script src="<?php echo base_url() ?>assets/js/dashboard.js"></script>
  <script src="<?php echo base_url() ?>assets/js/template.js"></script>
  <script src="<?php echo base_url() ?>assets/js/file-upload.js"></script>
  <script src="<?php echo base_url() ?>assets/js/bootstrap-datepicker.min.js"></script>
  <script src="<?php echo base_url() ?>assets/js/formpickers.js"></script>

  
  

  <script src="<?php echo base_url() ?>assets/js/jquery.toast.min.js"></script>
  <script src="<?php echo base_url() ?>assets/js/toastDemo.js"></script>
  <script src="<?php echo base_url() ?>assets/js/formpickers.js"></script>


  <script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery.dataTables.js"></script>

  <script type="text/javascript" src="<?php echo base_url() ?>assets/js//dataTables.bootstrap4.js"></script>

  <script type="text/javascript" src="<?php echo base_url() ?>assets/js/data-table.js"></script>

  <script type="text/javascript" src="<?php echo base_url() ?>assets/js/select2.min.js"></script>

  <script type="text/javascript" src="<?php echo base_url() ?>assets/js/select2.js"></script>

  <script type="text/javascript" src="<?php echo base_url() ?>assets/js/currency.js"></script>

  <script type="text/javascript" src="<?php echo base_url() ?>assets/js/multi_select.js"></script>

  <script type="text/javascript" src="https://www.bootstrapdash.com/demo/skydash/template/js/tabs.js"></script>



  <script type="text/javascript">

  $("#btnReport1").click(function(){ 

          var date1       = $('#editCom').val();
          var date2       = $('#dateCom').val();


          if(date1 == "") {
						alert('Date Start is empty');
						$("#editCom").focus();
						return false;
					}

          if(date2 == "") {
						alert('Date End is empty');
						$("#dateCom").focus();
						return false;
					}

          if(date1 > date2){
            alert('Date incorect');
						$("#editCom").focus();
						return false;
          }

          var arr         = [date1, date2];

          if (document.getElementById("jns1").checked == true) {
          
            var url      = "<?php echo base_url(); ?>admin/view/report1/?date1="+ date1 + "&date2=" + date2 ;
                  window.open(url,'_blank');

          } else {

            var url      = "<?php echo base_url(); ?>admin/view/reportExcel1/?date1="+ date1 + "&date2=" + date2 ;
                  window.open(url,'_blank');
          }

      });
      /*End//*/


      $("#btnReport2").click(function(){ 
        
          var date1       = $('#editCom').val();
          var date2       = $('#dateCom').val();

          if(date1 == "") {
						alert('Date Start is empty');
						$("#editCom").focus();
						return false;
					}

          if(date2 == "") {
						alert('Date End is empty');
						$("#dateCom").focus();
						return false;
					}

          if(date1 > date2){
            alert('Date incorect');
						$("#editCom").focus();
						return false;
          }

          if (document.getElementById("exp1").checked == true) {
              var exp        = $('#exp1').val();
          } 

          if (document.getElementById("exp2").checked == true) {
              var exp        = $('#exp2').val();
          } 

          if (document.getElementById("exp3").checked == true) {
              var exp        = $('#exp3').val();
          } 

          var arr         = [date1, date2, exp];

          if (document.getElementById("jns1").checked == true) {
          
            var url      = "<?php echo base_url(); ?>admin/view/report2/?date1="+ date1 + "&date2=" + date2 + "&exp=" + exp;
                  window.open(url,'_blank');

          } else {

            var url      = "<?php echo base_url(); ?>admin/view/reportExcel2/?date1="+ date1 + "&date2=" + date2 + "&exp=" + exp;
                  window.open(url,'_blank');
          }

      });



      $("#btnReports2").click(function(){ 
        
        var date1       = $('#editComs').val();
        var date2       = $('#dateComs').val();

        if (document.getElementById("exp4").checked == true) {
            var exp        = $('#exp4').val();
        } 

        var arr         = [date1, date2, exp];

        if (document.getElementById("jns1").checked == true) {
        
          var url      = "<?php echo base_url(); ?>admin/view/report2/?date1="+ date1 + "&date2=" + date2 + "&exp=" + exp;
                window.open(url,'_blank');

        } else {

          var url      = "<?php echo base_url(); ?>admin/view/reportExcel2/?date1="+ date1 + "&date2=" + date2 + "&exp=" + exp;
                window.open(url,'_blank');
        }

    });



    $("#presentage_report").click(function(){  

        var date1       = $('#editCom').val();
        var date2       = $('#dateCom').val();


        if(date1 == "") {
          alert('Date Start is empty');
          $("#editCom").focus();
          return false;
        }

        if(date2 == "") {
          alert('Date End is empty');
          $("#dateCom").focus();
          return false;
        }

        if(date1 > date2){
          alert('Date incorect');
          $("#editCom").focus();
          return false;
        } 

        var arr         = [date1, date2];

        if (document.getElementById("jns1").checked == true) {
        
          var url      = "<?php echo base_url(); ?>admin/view/presentage_rpt/?date1="+ date1 + "&date2=" + date2 ;
                window.open(url,'_blank');

        } else {

          var url      = "<?php echo base_url(); ?>admin/view/presentage_excel/?date1="+ date1 + "&date2=" + date2 ;
                window.open(url,'_blank');
        }

    });
    /*End//*/



    $("#directors_report").click(function(){  

        var date1       = $('#editCom').val();
        var date2       = $('#dateCom').val();


        if(date1 == "") {
          alert('Date Start is empty');
          $("#editCom").focus();
          return false;
        }

        if(date2 == "") {
          alert('Date End is empty');
          $("#dateCom").focus();
          return false;
        }

        if(date1 > date2){
          alert('Date incorect');
          $("#editCom").focus();
          return false;
        } 

        var arr         = [date1, date2];

        if (document.getElementById("jns1").checked == true) {
        
          var url      = "<?php echo base_url(); ?>admin/view/directors_rpt/?date1="+ date1 + "&date2=" + date2 ;
                window.open(url,'_blank');

        } else {

          var url      = "<?php echo base_url(); ?>admin/view/directors_excel/?date1="+ date1 + "&date2=" + date2 ;
                window.open(url,'_blank');
        }

    });
    /*End//*/




</script>

<script type="text/javascript">
  
    $('a[data-toggle="tab"]').on('show.bs.tab', function(e) { 
      localStorage.setItem('activeTab', $(e.target).attr('href'));
    });

    var activeTab = localStorage.getItem('activeTab');

    if(activeTab){
      $('#pills-tab a[href="' + activeTab + '"]').tab('show');
    }
</script>

</body>
</html>

