
<style type="text/css">
  .tab-content {
    border: none;
    margin-left:-10px;
  }
  .nav-pills-success .nav-link {
    color: #4B49AC;
    border-radius: 20px;
  }
  .nav-pills-success .nav-link.active {
    background: #4B49AC;
    border-radius: 20px;
}
</style>

<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body"> <?php $this->apps->get_notification(); ?>
                   <div class="table-responsives">
                      <div class="row">
                        <div class="col-lg-12 grid-margin grid-margin-lg-0">
                          <div class="card-body">
                            <h4 class="card-title"><?php echo $title; ?></h4>
                            <p>
                              <ul class="nav nav-pills nav-pills-success" id="pills-tab" role="tablist">
                                  <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Official</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" id="documents-tab" data-toggle="tab" href="#documents" role="tab" aria-controls="documents" aria-selected="false">Documents</a>
                                  </li>

                                  <li class="nav-item">
                                    <a class="nav-link" id="insurances-tab" data-toggle="tab" href="#insurances" role="tab" aria-controls="insurances" aria-selected="false">Insurance</a>
                                  </li>

                                  <li class="nav-item">
                                    <a class="nav-link" id="asset-tab" data-toggle="tab" href="#asset" role="tab" aria-controls="asset" aria-selected="false">Assets</a>
                                  </li>

                                  <li class="nav-item">
                                    <a class="nav-link" id="experienc-tab" data-toggle="tab" href="#experienc" role="tab" aria-controls="experienc" aria-selected="false">Experience</a>
                                  </li>

                                  <li class="nav-item">
                                    <a class="nav-link" id="education-tab" data-toggle="tab" href="#education" role="tab" aria-controls="education" aria-selected="false">Education</a>
                                  </li>

                                  <li class="nav-item">
                                    <a class="nav-link" id="certification-tab" data-toggle="tab" href="#certification" role="tab" aria-controls="certification" aria-selected="false">Certification</a>
                                  </li>

                                  <li class="nav-item">
                                    <a class="nav-link" id="leaves-tab" data-toggle="tab" href="#leaves" role="tab" aria-controls="leaves" aria-selected="false">Leave Activation</a>
                                  </li>

                                </ul>
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <div class="tab-content" id="myTabContent">
            <!-- START DATA EMPLOYEE -->
              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                  <?php 
                    echo $this->load->view ('backend/employee/tab/frm_employee');
                  ?>  
              </div>
              <!-- END TAB DATA EMPLOYEE -->

              <!-- START TAB 2 -->
              <div class="tab-pane fade" id="documents" role="tabpanel" aria-labelledby="documents-tab">
                <?php 
                    echo $this->load->view ('backend/employee/tab/frm_document');
                ?>
              </div>
              <!-- END TAB 2 -->

              <!-- START TAB 3 -->
              <div class="tab-pane fade" id="insurances" role="tabpanel" aria-labelledby="insurances-tab">
                <?php 
                    echo $this->load->view ('backend/employee/tab/frm_insurance');
                ?>
              </div>
              <!-- END TAB 3 -->

              <!-- START TAB 4 -->
              <div class="tab-pane fade" id="asset" role="tabpanel" aria-labelledby="asset-tab">
                <?php 
                    echo $this->load->view ('backend/employee/tab/frm_assets');
                ?>
              </div>
              <!-- END TAB 4 -->

              <!-- START TAB 5 -->
              <div class="tab-pane fade" id="experienc" role="tabpanel" aria-labelledby="experienc-tab">
                <?php 
                    echo $this->load->view ('backend/employee/tab/frm_experience');
                ?>
              </div>
              <!-- END TAB 5 -->

              <!-- START TAB 6 -->
              <div class="tab-pane fade" id="education" role="tabpanel" aria-labelledby="education-tab">
                <?php 
                    echo $this->load->view ('backend/employee/tab/frm_education');
                ?>
              </div>
              <!-- END TAB 6 -->

              <!-- START TAB 7 -->
              <div class="tab-pane fade" id="certification" role="tabpanel" aria-labelledby="certification-tab">
                <?php 
                    echo $this->load->view ('backend/employee/tab/frm_certification');
                ?>
              </div>
              <!-- END TAB 7 -->

              <!-- START TAB 8 -->
              <div class="tab-pane fade" id="leaves" role="tabpanel" aria-labelledby="leaves-tab">
                <?php 
                    echo $this->load->view ('backend/employee/tab/frm_leave');
                ?>
              </div>
              <!-- END TAB 8 -->
        </div>
    </div>
</div>