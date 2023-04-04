<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
              <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">
                  </h3>
                </div>
              <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <?php foreach ($getDocument as $key => $val) {} ?>
                  <h4 class="card-title">Total Upload</h4>
                  
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                          <th>User </th>
                          <th>Upload date</th>
                          <th>Company </th>
                          <th>Document Name </th>
                          <th>Document Size (KB)</th>
                        </tr>
                      </thead>
                      <tbody>
                         <?php foreach ($getUpload as $key => $value) { ?>
                            <tr>
                            <td style="color:green;font-weight: bold;"><?php echo $value['name']; ?></td>
                            <td><?php echo $value['created']; ?></td>
                            <td><?php echo $value['company_name']; ?></td>
                            <td><?php echo $value['document_name']; ?></td>
                            <td><?php echo number_format($value['document_size'],0); ?></td>
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
