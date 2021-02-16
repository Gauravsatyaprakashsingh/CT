
<div class="content-wrapper">
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Project</h4>
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Projec Details</h4>
                  <div class="row">
                    <div class="col-md-6">
                      <address >
                        <p class="font-weight-bold">Project Name : <span class="text-muted">Project 1</span> </p>
                        <p class="font-weight-bold">Start Date : <span class="text-muted">March 23 , 2019</span> </p>
                        <p class="font-weight-bold">End Date : <span class="text-muted">May 15 , 2019</span> </p>
                      </address>
                    </div>
                    <div class="col-md-6">
                      <address >
                       <p class="font-weight-bold">Client Email : <span class="text-muted">nitin.singh@voynichventures.com</span> </p>
                       <p class="font-weight-bold">Client Contact : <span class="text-muted">9167291114</span> </p>
                       <!-- <p class="font-weight-bold">Payment Type : <span class="text-muted">FOC</span> </p> -->
                      </address>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Total Sample</h4>
                  <div class="table-responsive">
                    <table id="table_id" class="table table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Test</th>
                          <th>Patient Name</th>
                          <th>Stauts</th>
                          <th>Manage</th>
                        </tr>
                      </thead>
                      <tbody>
                          <tr>
                            <td>1</td>
                            <td>Sample Name</td>
                            <td>
                              Nitin Singh
                            </td>
                            <td> <p title="Collected" class="text-success">Collected</p></td>
                            <td>
                              <button  title="Edit Sample Request"  class="btn btn-icons btn-rounded btn-info" type="button" name="button">
                                <i class="fa fa-pencil"></i>
                              </button>
                              <a href="<?=base_url('Sample/view_sample_details?sample_code=1234')?>" title="View Sample Request" class="btn btn-icons btn-rounded btn-warning" >
                                <i class="fa fa-eye"></i>
                              </a>
                              <a href="" title="Remove Sample Request" class="btn btn-icons btn-rounded btn-danger" >
                                <i class="fa fa-trash"></i>
                              </a>
                            </td>
                          </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <a href="<?=base_url('Sample/new_request_sample')?>" class="btn btn-outline-warning btn-rounded  float-left" name="button">
              <i class="fa fa-plus"></i> More Sample
            </a>
            <a href="<?=base_url('Sample/bulk_upload')?>" class="btn btn-outline-info btn-rounded float-right" name="button">
              <i class="fa fa-plus"></i> Bulk upload
            </a>

          </div>
        </div>
      </div>
    </div>
  </div>


</div>
