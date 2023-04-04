<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
              
              <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body"> <?php $this->apps->get_notification(); ?>
                  <div class="table-responsive">
                    <div class="card">
                      <div class="card-body">

                        <?php foreach($title as $Titles) {} ?>
                        <h4 class="card-title"><i class="ti-folder"></i>&nbsp;&nbsp;<i class="ti-angle-double-right"></i>&nbsp;&nbsp;<?php echo $Titles['type_name']; ?></h4>
                        <div class="template-demo">

                            <ol class="breadcrumb">

                                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/type/'); ?>">Document Type</a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
                            <?php 
                            

                            $query1 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$Titles['type_id']."'");

                                foreach ($query1->result_array() as $row1){

                            ?>
                               

                               <?php if($row1['level'] == 1){ ?>
                                <li class="breadcrumb-item active" aria-current="page"><?php echo $row1['type_name']; ?></li> 
                                <?php } ?>




                                <?php if($row1['level'] == 2){ ?>

                                    <?php 
                                        $query2 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$Titles['parent_id']."'");

                                        foreach ($query2->result_array() as $row2){ }?>

                                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/type/subtype/'); ?><?php echo $row2['type_id']; ?>"><?php echo $row2['type_name']; ?></a></li> &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
                               
                                <li class="breadcrumb-item active" aria-current="page"><?php echo $row1['type_name']; ?></li>
                                <?php } ?>




                                <?php if($row1['level'] == 3){ ?>

                                    <?php 
                                        $query3 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$Titles['parent_id']."'");

                                        foreach ($query3->result_array() as $row3){ }
                                        

                                        $query_i = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row3['parent_id']."'");

                                        foreach ($query_i->result_array() as $row_i){ }
                                    ?>

                                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/type/subtype/'); ?><?php echo $row_i['type_id']; ?>"><?php echo $row_i['type_name']; ?></a></li>

                                &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;

                                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/type/subtype/'); ?><?php echo $row3['type_id']; ?>"><?php echo $row3['type_name']; ?></a></li>

                                &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
                               
                                <li class="breadcrumb-item active" aria-current="page"><?php echo $row1['type_name']; ?></li>
                                <?php } ?>




                                <?php if($row1['level'] == 4){ ?>

                                    <?php 
                                        $query3 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$Titles['parent_id']."'");

                                        foreach ($query3->result_array() as $row3){ }
                                        

                                        $query_i = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row3['parent_id']."'");

                                        foreach ($query_i->result_array() as $row_i){ }


                                        $query_z = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row_i['parent_id']."'");

                                        foreach ($query_z->result_array() as $row_z){ }
                                    ?>


                                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/type/subtype/'); ?><?php echo $row_z['type_id']; ?>"><?php echo $row_z['type_name']; ?></a></li>
                                &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;

                                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/type/subtype/'); ?><?php echo $row_i['type_id']; ?>"><?php echo $row_i['type_name']; ?></a></li>
                                &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;

                                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/type/subtype/'); ?><?php echo $row3['type_id']; ?>"><?php echo $row3['type_name']; ?></a></li>
                                &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
                               
                                <li class="breadcrumb-item active" aria-current="page"><?php echo $row1['type_name']; ?></li>
                                <?php } ?>



                                <?php if($row1['level'] == 5){ ?>

                                    <?php 
                                        $query3 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$Titles['parent_id']."'");

                                        foreach ($query3->result_array() as $row3){ }
                                        

                                        $query_i = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row3['parent_id']."'");

                                        foreach ($query_i->result_array() as $row_i){ }


                                        $query_z = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row_i['parent_id']."'");

                                        foreach ($query_z->result_array() as $row_z){ }


                                        $query_x = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$row_z['parent_id']."'");

                                        foreach ($query_x->result_array() as $row_x){ }
                                    ?>


                                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/type/subtype/'); ?><?php echo $row_x['type_id']; ?>"><?php echo $row_x['type_name']; ?></a></li>
                                &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;

                                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/type/subtype/'); ?><?php echo $row_z['type_id']; ?>"><?php echo $row_z['type_name']; ?></a></li>
                                &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;

                                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/type/subtype/'); ?><?php echo $row_i['type_id']; ?>"><?php echo $row_i['type_name']; ?></a></li>
                                &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;

                                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/type/subtype/'); ?><?php echo $row3['type_id']; ?>"><?php echo $row3['type_name']; ?></a></li>
                                &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;

                                <li class="breadcrumb-item active" aria-current="page"><?php echo $row1['type_name']; ?></li>
                                <?php } ?>


                                <?php if($row1['level'] == 6){ ?>

                                    <?php 
                                        $query3 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$Titles['parent_id']."'");

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


                                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/type/subtype/'); ?><?php echo $row_y['type_id']; ?>"><?php echo $row_y['type_name']; ?></a></li>

                                &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
                                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/type/subtype/'); ?><?php echo $row_x['type_id']; ?>"><?php echo $row_x['type_name']; ?></a></li>
                                &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
                                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/type/subtype/'); ?><?php echo $row_z['type_id']; ?>"><?php echo $row_z['type_name']; ?></a></li>
                                &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
                                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/type/subtype/'); ?><?php echo $row_i['type_id']; ?>"><?php echo $row_i['type_name']; ?></a></li>
                                &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
                                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/type/subtype/'); ?><?php echo $row3['type_id']; ?>"><?php echo $row3['type_name']; ?></a></li>
                                &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
                                <li class="breadcrumb-item active" aria-current="page"><?php echo $row1['type_name']; ?></li>
                                <?php } ?>




                                <?php if($row1['level'] == 7){ ?>

                                    <?php 
                                        $query3 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$Titles['parent_id']."'");

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


                                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/type/subtype/'); ?><?php echo $row_w['type_id']; ?>"><?php echo $row_w['type_name']; ?></a></li>
                                &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
                                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/type/subtype/'); ?><?php echo $row_y['type_id']; ?>"><?php echo $row_y['type_name']; ?></a></li>
                                &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;

                                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/type/subtype/'); ?><?php echo $row_x['type_id']; ?>"><?php echo $row_x['type_name']; ?></a></li>
                                &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
                                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/type/subtype/'); ?><?php echo $row_z['type_id']; ?>"><?php echo $row_z['type_name']; ?></a></li>
                                &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
                                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/type/subtype/'); ?><?php echo $row_i['type_id']; ?>"><?php echo $row_i['type_name']; ?></a></li>
                                &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
                                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/type/subtype/'); ?><?php echo $row3['type_id']; ?>"><?php echo $row3['type_name']; ?></a></li>
                                &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
                                <li class="breadcrumb-item active" aria-current="page"><?php echo $row1['type_name']; ?></li>
                                <?php } ?>



                                <?php if($row1['level'] == 8){ ?>

                                    <?php 
                                        $query3 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$Titles['parent_id']."'");

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


                                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/type/subtype/'); ?><?php echo $row_q['type_id']; ?>"><?php echo $row_q['type_name']; ?></a></li>
                                &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
                                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/type/subtype/'); ?><?php echo $row_w['type_id']; ?>"><?php echo $row_w['type_name']; ?></a></li>
                                &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
                                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/type/subtype/'); ?><?php echo $row_y['type_id']; ?>"><?php echo $row_y['type_name']; ?></a></li>

                                &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
                                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/type/subtype/'); ?><?php echo $row_x['type_id']; ?>"><?php echo $row_x['type_name']; ?></a></li>
                                &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
                                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/type/subtype/'); ?><?php echo $row_z['type_id']; ?>"><?php echo $row_z['type_name']; ?></a></li>
                                &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
                                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/type/subtype/'); ?><?php echo $row_i['type_id']; ?>"><?php echo $row_i['type_name']; ?></a></li>
                                &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
                                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/type/subtype/'); ?><?php echo $row3['type_id']; ?>"><?php echo $row3['type_name']; ?></a></li>
                                &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
                                <li class="breadcrumb-item active" aria-current="page"><?php echo $row1['type_name']; ?></li>
                                <?php } ?>




                                <?php if($row1['level'] == 9){ ?>

                                    <?php 
                                        $query3 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$Titles['parent_id']."'");

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


                                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/type/subtype/'); ?><?php echo $row_r['type_id']; ?>"><?php echo $row_r['type_name']; ?></a></li>
                                &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
                                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/type/subtype/'); ?><?php echo $row_q['type_id']; ?>"><?php echo $row_q['type_name']; ?></a></li>
                                &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
                                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/type/subtype/'); ?><?php echo $row_w['type_id']; ?>"><?php echo $row_w['type_name']; ?></a></li>
                                &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
                                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/type/subtype/'); ?><?php echo $row_y['type_id']; ?>"><?php echo $row_y['type_name']; ?></a></li>
                                &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;

                                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/type/subtype/'); ?><?php echo $row_x['type_id']; ?>"><?php echo $row_x['type_name']; ?></a></li>
                                &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
                                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/type/subtype/'); ?><?php echo $row_z['type_id']; ?>"><?php echo $row_z['type_name']; ?></a></li>
                                &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
                                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/type/subtype/'); ?><?php echo $row_i['type_id']; ?>"><?php echo $row_i['type_name']; ?></a></li>
                                &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
                                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/type/subtype/'); ?><?php echo $row3['type_id']; ?>"><?php echo $row3['type_name']; ?></a></li>
                                &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
                                <li class="breadcrumb-item active" aria-current="page"><?php echo $row1['type_name']; ?></li>
                                <?php } ?>





                                <?php if($row1['level'] == 10){ ?>

                                    <?php 
                                        $query3 = $this->db->query("SELECT * FROM mod_document_type WHERE type_id='".$Titles['parent_id']."'");

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


                                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/type/subtype/'); ?><?php echo $row_s['type_id']; ?>"><?php echo $row_s['type_name']; ?></a></li>
                                &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
                                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/type/subtype/'); ?><?php echo $row_r['type_id']; ?>"><?php echo $row_r['type_name']; ?></a></li>
                                &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
                                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/type/subtype/'); ?><?php echo $row_q['type_id']; ?>"><?php echo $row_q['type_name']; ?></a></li>
                                &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
                                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/type/subtype/'); ?><?php echo $row_w['type_id']; ?>"><?php echo $row_w['type_name']; ?></a></li>
                                &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
                                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/type/subtype/'); ?><?php echo $row_y['type_id']; ?>"><?php echo $row_y['type_name']; ?></a></li>
                                &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;

                                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/type/subtype/'); ?><?php echo $row_x['type_id']; ?>"><?php echo $row_x['type_name']; ?></a></li>
                                &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
                                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/type/subtype/'); ?><?php echo $row_z['type_id']; ?>"><?php echo $row_z['type_name']; ?></a></li>
                                &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
                                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/type/subtype/'); ?><?php echo $row_i['type_id']; ?>"><?php echo $row_i['type_name']; ?></a></li>
                                &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
                                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/type/subtype/'); ?><?php echo $row3['type_id']; ?>"><?php echo $row3['type_name']; ?></a></li>
                                &nbsp;<i class="ti-angle-right" style="padding-top:5px;"></i>&nbsp;
                                <li class="breadcrumb-item active" aria-current="page"><?php echo $row1['type_name']; ?></li>
                                <?php } ?>


                            

                            <?php  } ?>
                            </ol>
                        </div>
                      </div>
                    </div>
                    <?php if($Titles['level'] == 10){ ?>

                    <?php }else{ ?>
                          <p class="card-description">
                            <?php foreach($getRules as $moduleRules) { ?>
                              <?php if($moduleRules['module_name'] == 'Add') { ?>
                              <a href="<?php echo base_url('admin/type/add'); ?>/<?php echo $row1['type_id']; ?>" style="text-decoration:none;color:#000" class="btn btn-light btn-sm">add sub folder</a>
                              <?php } } ?>
                            
                          </p>
                    <?php } ?>

            <div class="table-responsive">
                <table id="sublisting" class="table">
                      <thead>
                        <tr>
                          <th width="80%">Document Type</th>
                          <th>Status</th>
                          <?php foreach($getRules as $moduleRules) { ?>
                          <?php if($moduleRules['module_name'] == 'Edit') { ?>
                          <th>Actions</th>
                          <?php } } ?>
                        </tr>
                      </thead>
                      <tbody>
                         <?php foreach ($getdata as $key => $value) { ?>
                            <tr>
                              <td><a href="<?php echo base_url('admin/type/subtype/'); ?><?php echo $value['type_id']; ?>"><?php echo $value['type_name']; ?></a></td>
                              <td>
                                <?php if($value['type_status'] ==1){ ?>
                                  <button type="button" class="btn btn-inverse-success btn-sm" style="height:40px;padding-top:5px;">active</button>
                                <?php }else{ ?>
                                  <button type="button" class="btn btn-inverse-danger btn-sm" style="height:40px;padding-top:5px;">in active</button>
                                <?php } ?>
                              </td>

                              <?php foreach($getRules as $moduleRules) { ?>
                              <?php if($moduleRules['module_name'] == 'Edit') { ?>
                              
                              <td><a href="<?php echo base_url('admin/type/edit/'); ?><?php echo $value['type_id']; ?>" class="btn btn-outline-success btn-sm" id="nav-items" style="height:40px;padding-top: 15px;">update</a>

                              </td>
                              <?php } } ?>
                                
                            </tr>
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
</div>


