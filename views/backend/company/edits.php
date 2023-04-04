<div class="main-panel">
    <div class="content-wrapper">
        <div class="row"> 
        <?php 
            $callbacks = $this->db->query("SELECT mod_document.company_id, mod_company.company_name 
                                           FROM mod_document 
                                           INNER JOIN mod_company ON mod_document.company_id = mod_company.company_id
                                           WHERE document_id='".$this->uri->segment(4)."'");

            foreach ($callbacks->result_array() as $row_call){ }

        ?>    


      <?php foreach ($getDocument as $key => $val_update) {} ?>


            <h3>Update Document <?php echo $row_call['company_name']; ?></h3>
              <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title"><i class="ti-folder"></i>&nbsp;&nbsp;<i class="ti-angle-double-right"></i>&nbsp;&nbsp;Document Location</h5>

<?php 
        $q_kdid = $this->db->query("SELECT document_type FROM mod_document WHERE document_id='".$this->uri->segment(4)."'");

        foreach ($q_kdid->result_array() as $row_kdid){ } 

?>

<div class="template-demo">

    <ol class="breadcrumb">
        <i class="ti-folder" style="padding-top:4px;"></i>&nbsp;&nbsp;
        <li class="breadcrumb-item"><a href="#" style="text-decoration:none">Document Type</a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
    <?php 
    

    $query1 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row_kdid['document_type']."'");

        foreach ($query1->result_array() as $row1){

    ?>
       

       <?php if($row1['level'] == 1){ ?>
        <li class="breadcrumb-item active" aria-current="page"><?php echo $row1['type_name']; ?></li> 
        <?php } ?>




        <?php if($row1['level'] == 2){ ?>

            <?php 
                $query2 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row1['parent_id']."'");

                foreach ($query2->result_array() as $row2){ }?>

        <li class="breadcrumb-item"><a href="#" style="text-decoration:none"><?php echo $row2['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
       
        <li class="breadcrumb-item active" aria-current="page"><?php echo $row1['type_name']; ?></li>
        <?php } ?>




        <?php if($row1['level'] == 3){ ?>

            <?php 
                $query3 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row1['parent_id']."'");

                foreach ($query3->result_array() as $row3){ }
                

                $query_i = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row3['parent_id']."'");

                foreach ($query_i->result_array() as $row_i){ }
            ?>

        <li class="breadcrumb-item"><a href="#" style="text-decoration:none"><?php echo $row_i['type_name']; ?></a></li>

        &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;

        <li class="breadcrumb-item"><a href="#" style="text-decoration:none"><?php echo $row3['type_name']; ?></a></li>

        &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
       
        <li class="breadcrumb-item active" aria-current="page"><?php echo $row1['type_name']; ?></li>
        <?php } ?>




        <?php if($row1['level'] == 4){ ?>

            <?php 
                $query3 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row1['parent_id']."'");

                foreach ($query3->result_array() as $row3){ }
                

                $query_i = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row3['parent_id']."'");

                foreach ($query_i->result_array() as $row_i){ }


                $query_z = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row_i['parent_id']."'");

                foreach ($query_z->result_array() as $row_z){ }
            ?>


        <li class="breadcrumb-item"><a href="#" style="text-decoration:none"><?php echo $row_z['type_name']; ?></a></li>
        &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;

        <li class="breadcrumb-item"><a href="#" style="text-decoration:none"><?php echo $row_i['type_name']; ?></a></li>
        &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;

        <li class="breadcrumb-item"><a href="#" style="text-decoration:none"><?php echo $row3['type_name']; ?></a></li>
        &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
       
        <li class="breadcrumb-item active" aria-current="page"><?php echo $row1['type_name']; ?></li>
        <?php } ?>



        <?php if($row1['level'] == 5){ ?>

            <?php 
                $query3 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row1['parent_id']."'");

                foreach ($query3->result_array() as $row3){ }
                

                $query_i = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row3['parent_id']."'");

                foreach ($query_i->result_array() as $row_i){ }


                $query_z = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row_i['parent_id']."'");

                foreach ($query_z->result_array() as $row_z){ }


                $query_x = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row_z['parent_id']."'");

                foreach ($query_x->result_array() as $row_x){ }
            ?>


        <li class="breadcrumb-item"><a href="#" style="text-decoration:none"><?php echo $row_x['type_name']; ?></a></li>
        &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;

        <li class="breadcrumb-item"><a href="#" style="text-decoration:none"><?php echo $row_z['type_name']; ?></a></li>
        &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;

        <li class="breadcrumb-item"><a href="#" style="text-decoration:none"><?php echo $row_i['type_name']; ?></a></li>
        &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;

        <li class="breadcrumb-item"><a href="#" style="text-decoration:none"><?php echo $row3['type_name']; ?></a></li>
        &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;

        <li class="breadcrumb-item active" aria-current="page"><?php echo $row1['type_name']; ?></li>
        <?php } ?>


        <?php if($row1['level'] == 6){ ?>

            <?php 
                $query3 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row1['parent_id']."'");

                foreach ($query3->result_array() as $row3){ }
                

                $query_i = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row3['parent_id']."'");

                foreach ($query_i->result_array() as $row_i){ }


                $query_z = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row_i['parent_id']."'");

                foreach ($query_z->result_array() as $row_z){ }


                $query_x = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row_z['parent_id']."'");

                foreach ($query_x->result_array() as $row_x){ }


                $query_y = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row_x['parent_id']."'");

                foreach ($query_y->result_array() as $row_y){ }
            ?>


        <li class="breadcrumb-item"><a href="#" style="text-decoration:none"><?php echo $row_y['type_name']; ?></a></li>

        &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
        <li class="breadcrumb-item"><a href="#" style="text-decoration:none"><?php echo $row_x['type_name']; ?></a></li>
        &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
        <li class="breadcrumb-item"><a href="#" style="text-decoration:none"><?php echo $row_z['type_name']; ?></a></li>
        &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
        <li class="breadcrumb-item"><a href="#" style="text-decoration:none"><?php echo $row_i['type_name']; ?></a></li>
        &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
        <li class="breadcrumb-item"><a href="#" style="text-decoration:none"><?php echo $row3['type_name']; ?></a></li>
        &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
        <li class="breadcrumb-item active" aria-current="page"><?php echo $row1['type_name']; ?></li>
        <?php } ?>




        <?php if($row1['level'] == 7){ ?>

            <?php 
                $query3 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row1['parent_id']."'");

                foreach ($query3->result_array() as $row3){ }
                

                $query_i = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row3['parent_id']."'");

                foreach ($query_i->result_array() as $row_i){ }


                $query_z = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row_i['parent_id']."'");

                foreach ($query_z->result_array() as $row_z){ }


                $query_x = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row_z['parent_id']."'");

                foreach ($query_x->result_array() as $row_x){ }


                $query_y = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row_x['parent_id']."'");

                foreach ($query_y->result_array() as $row_y){ }


                $query_w = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row_y['parent_id']."'");

                foreach ($query_w->result_array() as $row_w){ }
            ?>


        <li class="breadcrumb-item"><a href="#" style="text-decoration:none"><?php echo $row_w['type_name']; ?></a></li>
        &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
        <li class="breadcrumb-item"><a href="#" style="text-decoration:none"><?php echo $row_y['type_name']; ?></a></li>
        &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;

        <li class="breadcrumb-item"><a href="#" style="text-decoration:none"><?php echo $row_x['type_name']; ?></a></li>
        &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
        <li class="breadcrumb-item"><a href="#" style="text-decoration:none"><?php echo $row_z['type_name']; ?></a></li>
        &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
        <li class="breadcrumb-item"><a href="#" style="text-decoration:none"><?php echo $row_i['type_name']; ?></a></li>
        &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
        <li class="breadcrumb-item"><a href="#" style="text-decoration:none"><?php echo $row3['type_name']; ?></a></li>
        &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
        <li class="breadcrumb-item active" aria-current="page"><?php echo $row1['type_name']; ?></li>
        <?php } ?>



        <?php if($row1['level'] == 8){ ?>

            <?php 
                $query3 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row1['parent_id']."'");

                foreach ($query3->result_array() as $row3){ }
                

                $query_i = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row3['parent_id']."'");

                foreach ($query_i->result_array() as $row_i){ }


                $query_z = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row_i['parent_id']."'");

                foreach ($query_z->result_array() as $row_z){ }


                $query_x = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row_z['parent_id']."'");

                foreach ($query_x->result_array() as $row_x){ }


                $query_y = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row_x['parent_id']."'");

                foreach ($query_y->result_array() as $row_y){ }


                $query_w = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row_y['parent_id']."'");

                foreach ($query_w->result_array() as $row_w){ }


                $query_q = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row_w['parent_id']."'");

                foreach ($query_q->result_array() as $row_q){ }
            ?>


        <li class="breadcrumb-item"><a href="#" style="text-decoration:none"><?php echo $row_q['type_name']; ?></a></li>
        &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
        <li class="breadcrumb-item"><a href="#" style="text-decoration:none"><?php echo $row_w['type_name']; ?></a></li>
        &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
        <li class="breadcrumb-item"><a href="#" style="text-decoration:none"><?php echo $row_y['type_name']; ?></a></li>

        &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
        <li class="breadcrumb-item"><a href="#" style="text-decoration:none"><?php echo $row_x['type_name']; ?></a></li>
        &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
        <li class="breadcrumb-item"><a href="#" style="text-decoration:none"><?php echo $row_z['type_name']; ?></a></li>
        &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
        <li class="breadcrumb-item"><a href="#" style="text-decoration:none"><?php echo $row_i['type_name']; ?></a></li>
        &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
        <li class="breadcrumb-item"><a href="#" style="text-decoration:none"><?php echo $row3['type_name']; ?></a></li>
        &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
        <li class="breadcrumb-item active" aria-current="page"><?php echo $row1['type_name']; ?></li>
        <?php } ?>




        <?php if($row1['level'] == 9){ ?>

            <?php 
                $query3 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row1['parent_id']."'");

                foreach ($query3->result_array() as $row3){ }
                

                $query_i = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row3['parent_id']."'");

                foreach ($query_i->result_array() as $row_i){ }


                $query_z = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row_i['parent_id']."'");

                foreach ($query_z->result_array() as $row_z){ }


                $query_x = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row_z['parent_id']."'");

                foreach ($query_x->result_array() as $row_x){ }


                $query_y = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row_x['parent_id']."'");

                foreach ($query_y->result_array() as $row_y){ }


                $query_w = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row_y['parent_id']."'");

                foreach ($query_w->result_array() as $row_w){ }


                $query_q = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row_w['parent_id']."'");

                foreach ($query_q->result_array() as $row_q){ }


                $query_r = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row_q['parent_id']."'");

                foreach ($query_r->result_array() as $row_r){ }
            ?>


        <li class="breadcrumb-item"><a href="#" style="text-decoration:none"><?php echo $row_r['type_name']; ?></a></li>
        &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
        <li class="breadcrumb-item"><a href="#" style="text-decoration:none"><?php echo $row_q['type_name']; ?></a></li>
        &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
        <li class="breadcrumb-item"><a href="#" style="text-decoration:none"><?php echo $row_w['type_name']; ?></a></li>
        &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
        <li class="breadcrumb-item"><a href="#" style="text-decoration:none"><?php echo $row_y['type_name']; ?></a></li>
        &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;

        <li class="breadcrumb-item"><a href="#" style="text-decoration:none"><?php echo $row_x['type_name']; ?></a></li>
        &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
        <li class="breadcrumb-item"><a href="#" style="text-decoration:none"><?php echo $row_z['type_name']; ?></a></li>
        &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
        <li class="breadcrumb-item"><a href="#" style="text-decoration:none"><?php echo $row_i['type_name']; ?></a></li>
        &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
        <li class="breadcrumb-item"><a href="#" style="text-decoration:none"><?php echo $row3['type_name']; ?></a></li>
        &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
        <li class="breadcrumb-item active" aria-current="page"><?php echo $row1['type_name']; ?></li>
        <?php } ?>





        <?php if($row1['level'] == 10){ ?>

            <?php 
                $query3 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row1['parent_id']."'");

                foreach ($query3->result_array() as $row3){ }
                

                $query_i = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row3['parent_id']."'");

                foreach ($query_i->result_array() as $row_i){ }


                $query_z = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row_i['parent_id']."'");

                foreach ($query_z->result_array() as $row_z){ }


                $query_x = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row_z['parent_id']."'");

                foreach ($query_x->result_array() as $row_x){ }


                $query_y = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row_x['parent_id']."'");

                foreach ($query_y->result_array() as $row_y){ }


                $query_w = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row_y['parent_id']."'");

                foreach ($query_w->result_array() as $row_w){ }


                $query_q = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row_w['parent_id']."'");

                foreach ($query_q->result_array() as $row_q){ }


                $query_r = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row_q['parent_id']."'");

                foreach ($query_r->result_array() as $row_r){ }


                $query_s = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row_r['parent_id']."'");

                foreach ($query_s->result_array() as $row_s){ }
            ?>


        <li class="breadcrumb-item"><a href="#" style="text-decoration:none"><?php echo $row_s['type_name']; ?></a></li>
        &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
        <li class="breadcrumb-item"><a href="#" style="text-decoration:none"><?php echo $row_r['type_name']; ?></a></li>
        &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
        <li class="breadcrumb-item"><a href="#" style="text-decoration:none"><?php echo $row_q['type_name']; ?></a></li>
        &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
        <li class="breadcrumb-item"><a href="#" style="text-decoration:none"><?php echo $row_w['type_name']; ?></a></li>
        &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
        <li class="breadcrumb-item"><a href="#" style="text-decoration:none"><?php echo $row_y['type_name']; ?></a></li>
        &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;

        <li class="breadcrumb-item"><a href="#" style="text-decoration:none"><?php echo $row_x['type_name']; ?></a></li>
        &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
        <li class="breadcrumb-item"><a href="#" style="text-decoration:none"><?php echo $row_z['type_name']; ?></a></li>
        &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
        <li class="breadcrumb-item"><a href="#" style="text-decoration:none"><?php echo $row_i['type_name']; ?></a></li>
        &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
        <li class="breadcrumb-item"><a href="#" style="text-decoration:none"><?php echo $row3['type_name']; ?></a></li>
        &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
        <li class="breadcrumb-item active" aria-current="page"><?php echo $row1['type_name']; ?></li>
        <?php } ?>


    

    <?php  } ?>
    </ol>
</div>
<br>
<br>

                  <form id="submit" class="forms-sample" method="POST" action="<?php echo base_url(); ?>admin/company/do_edit"  enctype="multipart/form-data">
                    <div class="form-group">
                      <input type="hidden" name="company_ids" value="<?php echo $row_call['company_id'];?>">
                      <label for="exampleInputUsername1">Document Type</label> <br>
                        <select class="js-example-basic-single" style="color:#000;width: 50%;" name="document_type" id="document_type">
                          <option value="0">Select</option>
                          <?php $qSelect = $this->db->query("SELECT * FROM mod_document_type WHERE type_status = 1 AND parent_id = 0 ");
                            foreach ($qSelect->result_array() as $row){ ?>
                          <option value="<?php echo $row['type_id']; ?>"><?php echo $row['type_name']; ?></option>
                          <?php } ?>
                        </select>
                    </div>
                    

                    <!-- ================================================================================================
                  ================================================================================================ -->


                  <div class="form-group" id="subs1"> <i onclick="Fsubs1()">-</i>
                    <label for="exampleInputUsername1">Sub 1</label><br>
                    <select class="js-example-basic-single" style="color:#000;width: 50%;" name="document_type1" id="sub1">
                      <option>Select</option>
                    </select>
                  </div>


                   <!-- ================================================================================================
                  ================================================================================================ -->



                  <div class="form-group" id="subs2"> <i onclick="Fsubs2()">-</i>
                    <label for="exampleInputUsername1">Sub 2</label><br>
                    <select class="js-example-basic-single" style="color:#000;width: 50%;" name="document_type2" id="sub2">
                      <option>Select</option>
                    </select>
                  </div>


                   <!-- ================================================================================================
                  ================================================================================================ -->


                  <div class="form-group" id="subs3"> <i onclick="Fsubs3()">-</i>
                    <label for="exampleInputUsername1">Sub 3</label><br>
                    <select class="js-example-basic-single" style="color:#000;width: 50%;" name="document_type3" id="sub3">
                      <option>Select</option>
                    </select>
                  </div>


                   <!-- ================================================================================================
                  ================================================================================================ -->



                  <div class="form-group" id="subs4"> <i onclick="Fsubs4()">-</i>
                    <label for="exampleInputUsername1">Sub 4</label><br>
                    <select class="js-example-basic-single" style="color:#000;width: 50%;" name="document_type4" id="sub4">
                      <option>Select</option>
                    </select>
                  </div>


                   <!-- ================================================================================================
                  ================================================================================================ -->



                  <div class="form-group" id="subs5"> <i onclick="Fsubs5()">-</i>
                    <label for="exampleInputUsername1">Sub 5</label><br>
                    <select class="js-example-basic-single" style="color:#000;width: 50%;" name="document_type5" id="sub5">
                      <option>Select</option>
                    </select>
                  </div>


                   <!-- ================================================================================================
                  ================================================================================================ -->



                  <div class="form-group" id="subs6"> <i onclick="Fsubs6()">-</i>
                    <label for="exampleInputUsername1">Sub 6</label><br>
                    <select class="js-example-basic-single" style="color:#000;width: 50%;" name="document_type6" id="sub6">
                      <option>Select</option>
                    </select>
                  </div>


                   <!-- ================================================================================================
                  ================================================================================================ -->



                  <div class="form-group" id="subs7"> <i onclick="Fsubs7()">-</i>
                    <label for="exampleInputUsername1">Sub 7</label><br>
                    <select class="js-example-basic-single" style="color:#000;width: 50%;" name="document_type7" id="sub7">
                      <option>Select</option>
                    </select>
                  </div>


                   <!-- ================================================================================================
                  ================================================================================================ -->


 
                  <div class="form-group" id="subs8"> <i onclick="Fsubs8()">-</i>
                    <label for="exampleInputUsername1">Sub 8</label><br>
                    <select class="js-example-basic-single" style="color:#000;width: 50%;" name="document_type8" id="sub8">
                      <option>Select</option>
                    </select>
                  </div>


                   <!-- ================================================================================================
                  ================================================================================================ -->



                  <div class="form-group" id="subs9"> <i onclick="Fsubs9()">-</i>
                    <label for="exampleInputUsername1">Sub 9</label><br>
                    <select class="js-example-basic-single" style="color:#000;width: 50%;" name="document_type9" id="sub9">
                      <option>Select</option>
                    </select>
                  </div>


                   <!-- ================================================================================================
                  ================================================================================================ -->



                  <div class="form-group" id="subs10"> <i onclick="Fsubs10()">-</i>
                    <label for="exampleInputUsername1">Sub 10</label><br>
                    <select class="js-example-basic-single" style="color:#000;width: 50%;" name="document_type10" id="sub10">
                      <option>Select</option>
                    </select>
                  </div>


                   <!-- ================================================================================================
                  ================================================================================================ -->


                   <div class="form-group">
                    <label for="exampleInputEmail1">Document name</label><br>
                    <input type="text" class="form-control" name="document_name" id="document_name" placeholder="document name" style="width: 50%;" value="<?php echo $val_update['document_name']; ?>" readonly>

                    <input type="hidden" name="document_id" value="<?php echo $this->uri->segment(4);?>">
                  </div>
                    

                <div class="form-group">
                  <label>File upload</label><br>
                  <input type="file" name="userfile" class="file-upload-default" style="width: 60%;">
                  <div class="input-group col-xs-12">
                    <input type="text" class="form-control file-upload-info" id="filec" name="userfilec" placeholder="Upload Image" style="width: 50%;background-color:#CED4DA;" value="<?php echo $val_update['document_upload'] ?>" disabled>
                    <span class="input-group-append" style="width: 50%;">
                      <button class="file-upload-browse btn btn-primary" type="button" disabled>Upload</button>
                    </span>
                  </div>
                </div>


                  <div class="form-group">
                    <label for="exampleInputEmail1">Date</label><br>
                    <div id="datepicker-popup" class="input-group date">
                        <input type="text" class="form-control" name="document_year" id="document_year" style="width: 50%;" value="<?php echo $val_update['document_year'] ?>">
                        <span class="input-group-addon input-group-append border-left" style="width: 50%;">
                          <span class="ti-calendar input-group-text"></span>
                        </span>
                      </div>
                  </div>
                  


                  <div class="form-group row">
                    <label class="col-sm-1 col-form-label" style="margin-top:-8px;">Select</label>
                    <div class="col-sm-2" style="padding-left:-100px">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="doc_status" id="doc_status1" value="1" <?php if ($val_update['document_status'] == '1') { echo "checked"; } ?>>
                          Active
                        </label>
                      </div>
                    </div>

                    <div class="col-sm-2" style="margin-left:-100px">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="doc_status" id="doc_status2" value="2" <?php if ($val_update['document_status'] == '2') { echo "checked"; } ?>>
                          In active 
                        </label>
                      </div>
                    </div>

                    <div class="col-sm-2" style="margin-left:-100px">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="doc_status" id="doc_status3" value="3" <?php if ($val_update['document_status'] == '3') { echo "checked"; } ?>> 
                          Expired
                        </label>
                      </div>
                    </div>

                    <div class="col-sm-2" style="margin-left:-100px">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="doc_status" id="doc_status4" value="4" <?php if ($val_update['document_status'] == '4') { echo "checked"; } ?>>
                          Not expired
                        </label>
                      </div>
                    </div>
                  </div>

                  

                  <div class="form-group">
                    <div class="form-group" id="ex_id" style="margin-top:-15px;">
                        <label for="exampleInputEmail1">Document expired <i style="color:red;font-size: 12px;"><?php echo $val_update['document_ex']; ?></i></label><br>
                        <select class="js-example-basic-single1" style="color:#000;width: 50%;" name="date_ex" id="date_ex" required>
                         <option value="-">select</option>
                         <option value="1"<?php if($val_update['expired'] == 1) echo 'selected="selected"';?>>1 year</option>
                         <option value="2"<?php if($val_update['expired'] == 2) echo 'selected="selected"';?>>2 year</option>
                         <option value="3"<?php if($val_update['expired'] == 3) echo 'selected="selected"';?>>3 year</option>
                         <option value="4"<?php if($val_update['expired'] == 4) echo 'selected="selected"';?>>4 year</option>
                         <option value="5"<?php if($val_update['expired'] == 5) echo 'selected="selected"';?>>5 year</option>
                        </select>
                      </div>
                  </div>

                  <div class="col-sm-6" style="margin-left:-10px">
                      
                    </div>

                    <button type="submit" class="btn btn-primary mr-2">Update</button>
                    <a href="<?php echo base_url('admin/company/listData/'); ?><?php ECHO $row_call['company_id']; ?>" class="btn btn-light">Cancel</a>
                  </form>
                </div>
              </div>
            </div>
            
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery-ui.js"></script>

<script src="<?php echo base_url() ?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/jquery.js"></script>
<script type="text/javascript" src=""></script>
<script>
$(document).ready(function(){
  
  
  $("#com_year").datepicker({
     format: "yyyy",
     viewMode: "years", 
     minViewMode: "years",
     autoclose:true
  });  

  $("#com_yearedit").datepicker({
     format: "yyyy",
     viewMode: "years", 
     minViewMode: "years",
     autoclose:true
  });  
})

<?php if($val_update['document_status'] == 3){ ?>

$("#ex_id").hide();

<?php } ?>

$('#submit').submit(function(e){ 

var yes           = document.getElementById("doc_status1").checked == true;
if (document.getElementById("doc_status1").checked == true) {
  var exp        = $('#doc_status1').val();
} 

if (document.getElementById("doc_status2").checked == true) {
  var exp        = $('#doc_status2').val();
} 

if (document.getElementById("doc_status3").checked == true) {
  var exp        = $('#doc_status3').val();
} 

if (document.getElementById("doc_status4").checked == true) {
  var exp        = $('#doc_status4').val();
} 

var date_ex       = $('#date_ex').val();  

    if(exp !=3 ){
        if(date_ex == "-") {
          alert('Document expired is empty');
          $("#date_ex").focus();
          return false;
        }
    }

});

$('input[type="radio"]').click(function () {
  var inputValue = $(this).attr("value");
  if (inputValue != "3") {
    $("#ex_id").show();
  } else {
    $("#ex_id").hide();
  }
});


function Fsubs1(){ 

    $('#sub1').find('option').not(':first').remove();
    $('#sub2').find('option').not(':first').remove();
    $('#sub3').find('option').not(':first').remove();
    $('#sub4').find('option').not(':first').remove();
    $('#sub5').find('option').not(':first').remove();
    $('#sub6').find('option').not(':first').remove();
    $('#sub7').find('option').not(':first').remove();
    $('#sub8').find('option').not(':first').remove();
    $('#sub9').find('option').not(':first').remove();
    $('#sub10').find('option').not(':first').remove();

    $("#subs1").hide();
    $("#subs2").hide();
    $("#subs3").hide();
    $("#subs4").hide();
    $("#subs5").hide();
    $("#subs6").hide();
    $("#subs7").hide();
    $("#subs8").hide();
    $("#subs9").hide();
    $("#subs10").hide();

  

  
 }
 

 function Fsubs2(){ 

    $('#sub2').find('option').not(':first').remove();
    $('#sub3').find('option').not(':first').remove();
    $('#sub4').find('option').not(':first').remove();
    $('#sub5').find('option').not(':first').remove();
    $('#sub6').find('option').not(':first').remove();
    $('#sub7').find('option').not(':first').remove();
    $('#sub8').find('option').not(':first').remove();
    $('#sub9').find('option').not(':first').remove();
    $('#sub10').find('option').not(':first').remove();

    $("#subs2").hide();
    $("#subs3").hide();
    $("#subs4").hide();
    $("#subs5").hide();
    $("#subs6").hide();
    $("#subs7").hide();
    $("#subs8").hide();
    $("#subs9").hide();
    $("#subs10").hide();

   
 }

 function Fsubs3(){ 
  
    $('#sub3').find('option').not(':first').remove();
    $('#sub4').find('option').not(':first').remove();
    $('#sub5').find('option').not(':first').remove();
    $('#sub6').find('option').not(':first').remove();
    $('#sub7').find('option').not(':first').remove();
    $('#sub8').find('option').not(':first').remove();
    $('#sub9').find('option').not(':first').remove();
    $('#sub10').find('option').not(':first').remove();

    $("#subs3").hide();
    $("#subs4").hide();
    $("#subs5").hide();
    $("#subs6").hide();
    $("#subs7").hide();
    $("#subs8").hide();
    $("#subs9").hide();
    $("#subs10").hide();

    
 }

 function Fsubs4(){ 

    $('#sub4').find('option').not(':first').remove();
    $('#sub5').find('option').not(':first').remove();
    $('#sub6').find('option').not(':first').remove();
    $('#sub7').find('option').not(':first').remove();
    $('#sub8').find('option').not(':first').remove();
    $('#sub9').find('option').not(':first').remove();
    $('#sub10').find('option').not(':first').remove();

    $("#subs4").hide();
    $("#subs5").hide();
    $("#subs6").hide();
    $("#subs7").hide();
    $("#subs8").hide();
    $("#subs9").hide();
    $("#subs10").hide();

    
 }

 function Fsubs5(){ 
    $('#sub5').find('option').not(':first').remove();
    $('#sub6').find('option').not(':first').remove();
    $('#sub7').find('option').not(':first').remove();
    $('#sub8').find('option').not(':first').remove();
    $('#sub9').find('option').not(':first').remove();
    $('#sub10').find('option').not(':first').remove();

    $("#subs5").hide();
    $("#subs6").hide();
    $("#subs7").hide();
    $("#subs8").hide();
    $("#subs9").hide();
    $("#subs10").hide();
 }

 function Fsubs6(){ 

    $('#sub6').find('option').not(':first').remove();
    $('#sub7').find('option').not(':first').remove();
    $('#sub8').find('option').not(':first').remove();
    $('#sub9').find('option').not(':first').remove();
    $('#sub10').find('option').not(':first').remove();

    $("#subs6").hide();
    $("#subs7").hide();
    $("#subs8").hide();
    $("#subs9").hide();
    $("#subs10").hide();
 }

 function Fsubs7(){ 

    $('#sub7').find('option').not(':first').remove();
    $('#sub8').find('option').not(':first').remove();
    $('#sub9').find('option').not(':first').remove();
    $('#sub10').find('option').not(':first').remove();

    $("#subs7").hide();
    $("#subs8").hide();
    $("#subs9").hide();
    $("#subs10").hide();
 }

 function Fsubs8(){ 

    $('#sub8').find('option').not(':first').remove();
    $('#sub9').find('option').not(':first').remove();
    $('#sub10').find('option').not(':first').remove();

    $("#subs8").hide();
    $("#subs9").hide();
    $("#subs10").hide();
 }

 function Fsubs9(){ 
    $('#sub9').find('option').not(':first').remove();
    $('#sub10').find('option').not(':first').remove();

    $("#subs9").hide();
    $("#subs10").hide();
 }

 function Fsubs10(){ 
    $("#subs10").remove();
 }

</script>