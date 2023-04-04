<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
              <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">
                  </h3>
                </div>
                <?php foreach ($getCommissaris as $key => $values) {} ?>
              <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">List Of Commissaris & Management <?php echo $values['company_name']; ?></h4>
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Title</th>
                          <th>Year</th>
                          <th>Expired</th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php foreach ($getCommissaris as $key => $value) { ?>
                          <tr>
                            <td><?php echo $value['commissaris_name']; ?></td>
                            <td><?php echo $value['commissaris_title']; ?></td>
                            <td><?php echo $value['commissaris_year']; ?></td>
                            <td><?php echo $value['commissaris_ex']; ?></td>
                          </tr>
                        <?php } ?>
                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
              <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <?php foreach ($getDocument as $key => $val) {} ?>
                  <h4 class="card-title">List Of Documents <?php echo $val['company_name']; ?></h4>
                  
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                          <th>Document Type</th>
                          <th>Document Name</th>
                          <th>Document Ext</th>
                          <th>Size (KB)</th>
                          <th>Upload</th>
                          <th>Expired</th>
                          <th>Year</th>
                          <th>Status</th>
                          <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                         <?php foreach ($getDocument as $key => $value) { ?>
                            <tr>
                            <?php 
                              $query = $this->db->query("SELECT type_name FROM mod_document_type WHERE parent_type='".$value['parent_type']."' AND parent_id = 0 ");
                              foreach ($query->result_array() as $row){
                            ?>
                            <td><b>
                              <a href="" data-toggle="modal" data-target=".bd-example-modal-xl<?php echo $value['document_type']; ?>" style="color:green;text-decoration: none;"><?php echo $row['type_name']; ?></a>
                              <?php 
                                  }
                              ?>
                            </b></td>

                            <td><?php echo $value['document_name']; ?></td>
                            <?php 
                                $exten = $value['document_upload'];
                                $file_extension = pathinfo($exten, PATHINFO_EXTENSION);
                                ?>
                            <td><i style="color:#000">(* .<?php echo $file_extension; ?> )</i></td>
                            
                            <td>
                             <?php echo number_format($value['document_size'],0); 

                              ?> 
                            </td>
                            <td><?php echo $value['document_date']; ?></td>
                            <td  style="color:red;"><?php echo $value['document_ex']; ?></td>
                            <td><?php echo $value['document_year']; ?></td>
                            <td>
                                <?php if($value['document_status']  == 1){ ?>
                                  <button type="button" class="btn btn-inverse-success" style="height:40px;">Active</button>
                                <?php }elseif($value['document_status']  == 2){ ?>
                                  <button type="button" class="btn btn-inverse-info" style="height:40px;background-color:#F8F8FF;color:grey">In active</button>
                                <?php }elseif($value['document_status']  == 3){ ?>
                                  <button type="button" class="btn btn-inverse-danger" style="height:40px;">Expired</button>
                                <?php }else{ ?>
                                  <button type="button" class="btn btn-inverse-warning" style="height:40px;color:#000;">Not expired</button>
                                <?php } ?>

                              </td>
                            <td>


                              <?php foreach($getRules as $moduleRules) { ?>
                                <?php if($moduleRules['module_name'] == 'Preview') { ?>


                                <?php if($file_extension != "pdf"){ ?>

                                  <a href="#" onclick="showWarningToast()" class="btn btn-inverse-info btn-sm" style="height:40px;padding-top: 12px;"><i class="ti-eye btn-icon-prepend" style="height:40%"></i>Preview</a>
                                &nbsp;


                                <?php }else{ ?>
                                <a href="<?php echo base_url()?>admin/view/preview/<?php echo $value['document_id']; ?>" class="btn btn-inverse-info btn-sm" style="height:40px;padding-top: 12px;" target="_blank"><i class="ti-eye btn-icon-prepend" style="height:40%"></i>Preview</a>
                                &nbsp;<?php } ?>

                                <?php }} ?>


                                <?php foreach($getRules as $moduleRules) { ?>
                                <?php if($moduleRules['module_name'] == 'Download') { ?>

                                <a 
                                  href="javascript:;"
                                  data-id="<?php echo $value['document_id']; ?>"
                                  data-com_id="<?php echo $value['company_id']; ?>"
                                  data-toggle="modal" data-target="#PoPup"
                                  class="btn btn-inverse-success btn-sm" style="height:40px;padding-top: 12px;"><i class="ti-download btn-icon-prepend" style="height:40%"></i>Download
                                </a>
                                &nbsp;
                                 <?php }} ?>


                                 <?php foreach($getRules as $moduleRules) { ?>
                                <?php if($moduleRules['module_name'] == 'Email') { ?>

                                <?php if($value['document_size'] > 1000 ){ ?>

                                  <a href="#" onclick="showDangerToast()" class="btn btn-inverse-primary btn-sm" style="height:40px;padding-top: 12px;"><i class="ti-share btn-icon-prepend" style="height:40%"></i>Email</a>
                                &nbsp;

                                <?php }else{ ?>
                                <a 
                                  href="javascript:;"
                                  data-ids="<?php echo $value['document_id']; ?>"
                                  data-com_ids="<?php echo $value['company_id']; ?>"
                                  data-doc_name="<?php echo $value['document_name']; ?>"
                                  data-file="<?php echo $value['document_upload']; ?>"
                                  data-toggle="modal" data-target="#Email"
                                  class="btn btn-inverse-primary btn-sm" style="height:40px;padding-top: 12px;"><i class="ti-share btn-icon-prepend" style="height:40%"></i>Email
                                </a>
                               <?php } ?>
                                &nbsp;  
                                <?php }} ?>

                                <?php foreach($getRules as $moduleRules) { ?>
                                <?php if($moduleRules['module_name'] == 'Histories') { ?>

                               <a href="<?php echo base_url()?>admin/view/histories/<?php echo $value['document_id']; ?>" class="btn btn-inverse-info btn-sm" style="height:40px;padding-top: 12px;" target="_blank"><i class="ti-back-left btn-icon-prepend" style="height:40%"></i>Histories</a>



                                 <?php }} ?>
                              </td>
                            </tr>

                            <!-- Info Path Modal -->
                              <div class="modal fade bd-example-modal-xl<?php echo $value['document_type']; ?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title">Path Location</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      <div class="template-demo">
                                      <ol class="breadcrumb">

                                        <?php 
                                          $query = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$value['document_type']."' ;");

                                          foreach ($query->result_array() as $row){}
                                           
                                        ?>
                                        <?php if($row['level'] == 1){ ?>
                                          <li class="breadcrumb-item"><a href="#" style="text-decoration:none;">Document Type</a></li>&nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row['type_name']; ?></a></li> 
                                        <?php } ?>


                                        <!-- Level 2 -->

                                        <?php if($row['level'] == 2){ ?>

                                          <?php 
                                            $query1 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$value['document_type']."' ;");

                                            foreach ($query1->result_array() as $row1){}


                                              $query2 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row1['parent_id']."' ;");

                                              foreach ($query2->result_array() as $row2){}


                                          ?>

                                         <li class="breadcrumb-item"><a href="#" style="text-decoration:none;">Document Type</a></li>&nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;

                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row2['type_name']; ?></a></li>&nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row1['type_name']; ?></a></li>

                                        <?php } ?>


                                        <!-- Level 3 -->

                                        <?php if($row['level'] == 3){ ?>

                                          <?php 
                                            $query1 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$value['document_type']."' ;");

                                            foreach ($query1->result_array() as $row1){}


                                              $query2 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row1['parent_id']."' ;");

                                              foreach ($query2->result_array() as $row2){}


                                              $query3 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row2['parent_id']."' ;");

                                              foreach ($query3->result_array() as $row3){}


                                          ?>

                                         <li class="breadcrumb-item"><a href="#" style="text-decoration:none;">Document Type</a></li>&nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;

                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row3['type_name']; ?></a></li>&nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row2['type_name']; ?></a></li>&nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row1['type_name']; ?></a></li>

                                        <?php } ?>


                                        <!-- Level 4 -->

                                        <?php if($row['level'] == 4){ ?>

                                          <?php 
                                            $query1 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$value['document_type']."' ;");

                                            foreach ($query1->result_array() as $row1){}


                                              $query2 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row1['parent_id']."' ;");

                                              foreach ($query2->result_array() as $row2){}


                                              $query3 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row2['parent_id']."' ;");

                                              foreach ($query3->result_array() as $row3){}

                                              $query4 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row3['parent_id']."' ;");

                                              foreach ($query4->result_array() as $row4){}


                                          ?>

                                         <li class="breadcrumb-item"><a href="#" style="text-decoration:none;">Document Type</a></li>&nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;

                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row4['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row3['type_name']; ?></a></li>&nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row2['type_name']; ?></a></li>&nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row1['type_name']; ?></a></li>

                                        <?php } ?>

                                        <!-- Level 5 -->

                                        <?php if($row['level'] == 5){ ?>

                                          <?php 
                                            $query1 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$value['document_type']."' ;");

                                            foreach ($query1->result_array() as $row1){}


                                              $query2 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row1['parent_id']."' ;");

                                              foreach ($query2->result_array() as $row2){}


                                              $query3 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row2['parent_id']."' ;");

                                              foreach ($query3->result_array() as $row3){}

                                              $query4 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row3['parent_id']."' ;");

                                              foreach ($query4->result_array() as $row4){}


                                              $query5 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row4['parent_id']."' ;");

                                              foreach ($query5->result_array() as $row5){}


                                          ?>

                                         <li class="breadcrumb-item"><a href="#" style="text-decoration:none;">Document Type</a></li>&nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;

                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row5['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row4['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row3['type_name']; ?></a></li>&nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row2['type_name']; ?></a></li>&nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row1['type_name']; ?></a></li>

                                        <?php } ?>



                                        <!-- Level 6 -->

                                        <?php if($row['level'] == 6){ ?>

                                          <?php 
                                            $query1 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$value['document_type']."' ;");

                                            foreach ($query1->result_array() as $row1){}


                                              $query2 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row1['parent_id']."' ;");

                                              foreach ($query2->result_array() as $row2){}


                                              $query3 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row2['parent_id']."' ;");

                                              foreach ($query3->result_array() as $row3){}

                                              $query4 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row3['parent_id']."' ;");

                                              foreach ($query4->result_array() as $row4){}


                                              $query5 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row4['parent_id']."' ;");

                                              foreach ($query5->result_array() as $row5){}


                                              $query6 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row5['parent_id']."' ;");

                                              foreach ($query6->result_array() as $row6){}


                                          ?>

                                         <li class="breadcrumb-item"><a href="#" style="text-decoration:none;">Document Type</a></li>&nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row6['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row5['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row4['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row3['type_name']; ?></a></li>&nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row2['type_name']; ?></a></li>&nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row1['type_name']; ?></a></li>

                                        <?php } ?>



                                         <!-- Level 7 -->

                                        <?php if($row['level'] == 7){ ?>

                                          <?php 
                                            $query1 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$value['document_type']."' ;");

                                            foreach ($query1->result_array() as $row1){}


                                              $query2 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row1['parent_id']."' ;");

                                              foreach ($query2->result_array() as $row2){}


                                              $query3 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row2['parent_id']."' ;");

                                              foreach ($query3->result_array() as $row3){}

                                              $query4 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row3['parent_id']."' ;");

                                              foreach ($query4->result_array() as $row4){}


                                              $query5 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row4['parent_id']."' ;");

                                              foreach ($query5->result_array() as $row5){}


                                              $query6 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row5['parent_id']."' ;");

                                              foreach ($query6->result_array() as $row6){}


                                              $query7 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row6['parent_id']."' ;");

                                              foreach ($query7->result_array() as $row7){}


                                          ?>

                                         <li class="breadcrumb-item"><a href="#" style="text-decoration:none;">Document Type</a></li>&nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;

                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row7['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row6['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row5['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row4['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row3['type_name']; ?></a></li>&nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row2['type_name']; ?></a></li>&nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row1['type_name']; ?></a></li>

                                        <?php } ?>


                                         <!-- Level 8 -->

                                        <?php if($row['level'] == 8){ ?>

                                          <?php 
                                            $query1 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$value['document_type']."' ;");

                                            foreach ($query1->result_array() as $row1){}


                                              $query2 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row1['parent_id']."' ;");

                                              foreach ($query2->result_array() as $row2){}


                                              $query3 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row2['parent_id']."' ;");

                                              foreach ($query3->result_array() as $row3){}

                                              $query4 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row3['parent_id']."' ;");

                                              foreach ($query4->result_array() as $row4){}


                                              $query5 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row4['parent_id']."' ;");

                                              foreach ($query5->result_array() as $row5){}


                                              $query6 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row5['parent_id']."' ;");

                                              foreach ($query6->result_array() as $row6){}


                                              $query7 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row6['parent_id']."' ;");

                                              foreach ($query7->result_array() as $row7){}


                                              $query8 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row7['parent_id']."' ;");

                                              foreach ($query8->result_array() as $row8){}


                                          ?>

                                         <li class="breadcrumb-item"><a href="#" style="text-decoration:none;">Document Type</a></li>&nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;

                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row8['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row7['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row6['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row5['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row4['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row3['type_name']; ?></a></li>&nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row2['type_name']; ?></a></li>&nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row1['type_name']; ?></a></li>

                                        <?php } ?>


                                        <!-- Level 9 -->

                                        <?php if($row['level'] == 9){ ?>

                                          <?php 
                                            $query1 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$value['document_type']."' ;");

                                            foreach ($query1->result_array() as $row1){}


                                              $query2 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row1['parent_id']."' ;");

                                              foreach ($query2->result_array() as $row2){}


                                              $query3 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row2['parent_id']."' ;");

                                              foreach ($query3->result_array() as $row3){}

                                              $query4 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row3['parent_id']."' ;");

                                              foreach ($query4->result_array() as $row4){}


                                              $query5 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row4['parent_id']."' ;");

                                              foreach ($query5->result_array() as $row5){}


                                              $query6 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row5['parent_id']."' ;");

                                              foreach ($query6->result_array() as $row6){}


                                              $query7 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row6['parent_id']."' ;");

                                              foreach ($query7->result_array() as $row7){}


                                              $query8 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row7['parent_id']."' ;");

                                              foreach ($query8->result_array() as $row8){}


                                              $query9 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row8['parent_id']."' ;");

                                              foreach ($query9->result_array() as $row9){}

                                          ?>

                                         <li class="breadcrumb-item"><a href="#" style="text-decoration:none;">Document Type</a></li>&nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
                                       
                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row9['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row8['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row7['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row6['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row5['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row4['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row3['type_name']; ?></a></li>&nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row2['type_name']; ?></a></li>&nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row1['type_name']; ?></a></li>

                                        <?php } ?>


                                        <!-- Level 10 -->

                                        <?php if($row['level'] == 10){ ?>

                                          <?php 
                                            $query1 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$value['document_type']."' ;");

                                            foreach ($query1->result_array() as $row1){}


                                              $query2 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row1['parent_id']."' ;");

                                              foreach ($query2->result_array() as $row2){}


                                              $query3 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row2['parent_id']."' ;");

                                              foreach ($query3->result_array() as $row3){}

                                              $query4 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row3['parent_id']."' ;");

                                              foreach ($query4->result_array() as $row4){}


                                              $query5 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row4['parent_id']."' ;");

                                              foreach ($query5->result_array() as $row5){}


                                              $query6 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row5['parent_id']."' ;");

                                              foreach ($query6->result_array() as $row6){}


                                              $query7 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row6['parent_id']."' ;");

                                              foreach ($query7->result_array() as $row7){}


                                              $query8 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row7['parent_id']."' ;");

                                              foreach ($query8->result_array() as $row8){}


                                              $query9 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row8['parent_id']."' ;");

                                              foreach ($query9->result_array() as $row9){}


                                              $query10 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row9['parent_id']."' ;");

                                              foreach ($query10->result_array() as $row10){}
                                          ?>

                                         <li class="breadcrumb-item"><a href="#" style="text-decoration:none;">Document Type</a></li>&nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;

                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row10['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;

                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row9['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row8['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row7['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row6['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row5['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row4['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row3['type_name']; ?></a></li>&nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row2['type_name']; ?></a></li>&nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;


                                        <li class="breadcrumb-item"><a href="#" style="text-decoration:none;"><?php echo $row1['type_name']; ?></a></li>

                                        <?php } ?>


                                      </ol>
                                      <button type="button" class="btn btn-secondary text-right" data-dismiss="modal">Close</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <!-- End Info Popup -->

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


<!-- Document Modal Download-->
  <div class="modal fade" id="PoPup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form id="submited" name="contact-form">
      <div class="modal-content">
        <div class="modal-header">

          <h5 class="modal-title" id="exampleModalLabel"><b>Form Download</b></h5>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <input type="hidden" class="form-control" name="id" id="id" readonly>
        <input type="hidden" class="form-control" name="com_id" id="com_id" readonly>
        <input type="hidden" class="form-control" name="status_log" id="status_log" value="2">

        <div class="modal-body">
        <div class="form-group">
          <label for="exampleInputEmail1">Description</label>
          <input type="text" class="form-control" name="description" id="description" required>
        </div>

        </div>

        <div class="modal-footer">

          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button class="btn btn-primary" type="submit" id="subloading" name="subloading">Start Download
          
        </div>
      </div>
    </form>
    </div>
  </div>



  <!-- Document Modal Send to Email-->
  <div class="modal fade" id="Email" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form id="send_email" name="contact-form">
      <div class="modal-content">
        <div class="modal-header">

          <h5 class="modal-title" id="exampleModalLabel"><b>Send Document</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <input type="hidden" class="form-control" name="ids" id="ids" readonly>
        <input type="hidden" class="form-control" name="com_ids" id="com_ids" readonly>
        <input type="hidden" class="form-control" name="status_logs" id="status_logs" value="3">
        <div class="modal-body">
        <div class="form-group">
          <label for="exampleInputEmail1">To:</label>
          <input type="text" class="form-control" name="to_email" id="to_email" required>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Subject</label>
          <input type="text" class="form-control" name="doc_name" id="doc_name" readonly>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">File Attachment</label>
          <input type="text" name="file" id="file" class="form-control" readonly>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Description</label>
          <textarea class="form-control" id="desc" name="desc" required></textarea>
        </div>

        </div>
        <div class="modal-footer">

          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button class="btn btn-primary" type="submit" id="subloading" name="subloading">Send
          
        </div>
      </div>
    </form>
    </div>
  </div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>

<script>
     $(document).ready(function() {

         // Untuk sunting
         $('#PoPup').on('show.bs.modal', function (event) { 
             var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
             var modal          = $(this)

             modal.find('#id').attr("value",div.data('id'));
             modal.find('#com_id').attr("value",div.data('com_id'));
             modal.find('#description').attr("value",div.data('description'));
         });


          $('#Email').on('show.bs.modal', function (event) { 
             var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
             var modal          = $(this)

             modal.find('#ids').attr("value",div.data('ids'));
             modal.find('#com_ids').attr("value",div.data('com_ids'));
             modal.find('#doc_name').attr("value",div.data('doc_name'));
             modal.find('#file').attr("value",div.data('file'));
         });


         $('#PoPup').on('hidden.bs.modal', function (e) {

              $('#submited').find("input[type=text]").val("");
          })


        $('#submited').submit(function(e){  
            //Start Save
            e.preventDefault(); 
                var id       = $('#id').val();
                var des      = $("#description").val();
                var log      = $("#status_log").val();
                
                var arr      = [id, des, log];
                var url      = "<?php echo base_url(); ?>admin/view/download/?id="+ id + "&des=" + des  + "&log=" + log;
                window.open(url, "_self");

                var frm = $("#description").val();
                frm.reset();  
                
            });



        $('#send_email').submit(function(e){   
            //Start Send
            e.preventDefault(); 
                var ids      = $('#ids').val();
                var doc_name = $("#doc_name").val();
                var file     = $("#file").val();
                var to_email = $("#to_email").val();
                var desc     = $("#desc").val();
                var logs     = $("#status_logs").val(); 
                
                var arr         = [id, doc_name, file, logs]; 
                var url      = "<?php echo base_url(); ?>admin/view/send_toemail/?ids="+ ids + "&doc_name=" + doc_name + "&file="+ file + "&to_email=" + to_email + "&desc=" + desc  + "&logs=" + logs;
                showSendToast();
                window.open(url, "_self");

                var frm = $("#description").val();
                frm.reset();  
                
            });

      });



 </script>



