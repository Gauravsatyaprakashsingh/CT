<?php
 $action_url = base_url('Users/save_patient');
 ?>
<div class="content-wrapper">
  <div class="row">
    <div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">New Pateint</h4>
          <form action="<?=$action_url ?>" method="post" class="form-sample">
            <p class="card-description">
              Pateint Details
            </p>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Pateint Fulname</label>
                  <div class="col-sm-9">
                    <input name="fullname" placeholder="Enter pateint fullname" type="text" class="form-control" />
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Pateint Contact</label>
                  <div class="col-sm-9">
                    <input name="contact" placeholder="Enter pateint contact" type="text" class="form-control" />
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Gender</label>
                  <div class="col-sm-9">
                    <select name="client_code" class="form-control">
                        <option value="male">Male</option>
                        <option value="female">Male</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Age</label>
                  <div class="col-sm-9">
                    <input type="text" placeholder="Enter age of pateint" class="form-control" name="start_date" value="">
                  </div>
                </div>
              </div>

              <div class="col-md-5">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Pincode</label>
                  <div class="col-sm-9">
                    <input type="text" placeholder="Enter Pincode" class="form-control" name="start_date" value="">
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Address</label>
                  <div class="col-sm-9">
                    <textarea name="name" class="form-control"></textarea>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Email</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="Enter pateint email" value="">
                  </div>
                </div>
              </div>
            </div>


            <div class="row">
              <div class="col-md-6">
                <button type="submit" class="btn btn-info" >Save</button>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- content-wrapper ends -->
