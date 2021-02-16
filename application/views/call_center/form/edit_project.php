<div class="content-wrapper">
  <div class="row">
    <div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">New Project</h4>
          <form class="form-sample">
            <p class="card-description">
              Project Details
            </p>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Project name</label>
                  <div class="col-sm-9">
                    <input name="project_name" placeholder="Enter project name" type="text" class="form-control" />
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Select Project Manager</label>
                  <div class="col-sm-9">
                    <select class="form-control">
                      <option>Project Manager 1 </option>
                      <option>Project Manager 2</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Select Client</label>
                  <div class="col-sm-9">
                    <select class="form-control">
                      <option>Pharma 1</option>
                      <option>Pharma 2</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">City</label>
                  <div class="col-sm-9">
                    <select class="form-control">
                      <option>Mumbai</option>
                      <option>Pune</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- content-wrapper ends -->


<div class="content-wrapper">
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
                    <td> Collected </td>
                    <td>
                      <button  title="Edit Project"  class="btn btn-icons btn-rounded btn-info" type="button" name="button">
                        <i class="fa fa-pencil"></i>
                      </button>
                      <a href="<?=base_url('Sample/view_sample_details?sample_code=1234')?>" title="view sample" class="btn btn-icons btn-rounded btn-warning" >
                        <i class="fa fa-eye"></i>
                      </a>
                      <a href="" title="delete sample" class="btn btn-icons btn-rounded btn-danger" >
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
</div>
