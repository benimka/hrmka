<!DOCTYPE html>
<html lang="en">
<head>
  <title>Histories</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <style type="text/css">
    @import url(http://fonts.googleapis.com/css?family=Calibri:400,300,700);

 body {
     background-color: #fff;
     font-family: 'Calibri', sans-serif !important
 }

.container{
    margin-top:100px;
}
.card {
       position: relative;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0px solid transparent;
    border-radius: 0px;
}
}

.card-body {
    -webkit-box-flex: 1;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    padding: 1.25rem;
}

.card .card-title {
    position: relative;
    font-weight: 600;
    margin-bottom: 10px;
}


.table {
    width: 100%;
    max-width: 100%;
    margin-bottom: 1rem;
    background-color: transparent;
}

* {
    outline: none;
}

.table th, .table thead th {
    font-weight: 500;
}


.table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #dee2e6;
}


.table th {
    padding: 1rem;
    vertical-align: top;
    border-top: 1px solid #dee2e6;
}


.table th, .table thead th {
    font-weight: 500;
}


th {
    text-align: inherit;
}


.m-b-20 {
    margin-bottom: 20px;
}


.customcheckbox {
    display: block;
    position: relative;
    padding-left: 24px;
    font-weight: 100;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 22px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}


.customcheckbox input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

.checkmark {
    position: absolute;
    top: -3px;
    left: 0;
    height: 20px;
    width: 20px;
    background-color: #CDCDCD;
    border-radius: 6px;
}


.customcheckbox input:checked ~ .checkmark {
    background-color: #2196BB;
}


.customcheckbox .checkmark:after {
    left: 8px;
    top: 4px;
    width: 5px;
    height: 10px;
    border: solid white;
    border-width: 0 3px 3px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
}
  </style>
</head>
<body>
<div class="container">
            
             <?php foreach ($gethistories as $key => $val) {} ?>
                                
              <div class="row">
                <a href="<?php echo base_url('/admin/view/excel/') ?><?php echo $this->uri->segment(4); ?>" class="btn btn-light text-right">Download Excel</a>
              <div class="col-12">
                  <div class="card">
                      <div class="card-body text-center">
                          <h5 class="card-title m-b-0">Company: <?php echo $val['company_name']; ?></h5>
                          <h5 class="card-title m-b-0">Document name: <?php echo $val['document_name']; ?></h5>
                      </div>
                          <div class="table-responsive">
                              <table class="table">
                                  <thead class="thead-light">
                                      <tr>
                                          <th scope="col">Datetime Action</th>
                                          <th scope="col">Action</th>
                                          <th scope="col">User</th>
                                          <th scope="col">Description</th>
                                          <th scope="col">Email</th>
                                      </tr>
                                  </thead>
                                  <tbody class="customtable">
                                    <?php foreach ($gethistories as $key => $value) { ?>
                                      <tr>
                                        <td><?php echo $value['created']; ?></td>
                                        <td>
                                            <?php if($value['status_log'] == 1){echo "Preview";} ?>
                                            <?php if($value['status_log'] == 2){echo "Download";} ?>
                                            <?php if($value['status_log'] == 3){echo "Send Email";} ?>
                                        </td>
                                        <td><?php echo $value['name']; ?></td>
                                        <td><?php echo $value['log_description']; ?></td>
                                        <td>
                                            <?php if($value['status_log'] != 3){ ?>
                                                <i>NULL</i>
                                            <?php }else{ ?>
                                            <?php echo $value['email']; ?>
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
  
</body>
</html>
