<div class="content-wrapper">
  <div class="row">
    <div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">TRF Form</h4>
          <form class="form-sample">
            <div class="row">
              <div class="accordion col-lg-12 primary" id="accordionExample">
                <div class="card">
                  <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                      <button class="btn btn-link text-uppercase" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          Patient Information
                      </button>
                    </h5>
                  </div>
              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Name</label>
                        <div class="col-sm-8">
                          <input name="patient_name" placeholder="Enter patient name" type="text" class="form-control" />
                        </div>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">DOB</label>
                        <div class="col-sm-9">
                          <input name="patient_dob"  type="date" class="form-control" />
                        </div>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Age</label>
                        <div class="col-sm-8">
                          <input name="patient_age" placeholder="Enter patient age" type="text" class="form-control" />
                        </div>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Gender</label>
                        <div class="col-sm-8">
                          <select class="form-control" name="gender">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Contact</label>
                        <div class="col-sm-8">
                          <input name="patient_contact" placeholder="Enter patient contact" type="text" class="form-control" />
                        </div>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                          <input name="patient_email" placeholder="Enter patient email"  type="text" class="form-control" />
                        </div>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Transplant Date</label>
                        <div class="col-sm-8">
                          <input name="patient_age" type="date" class="form-control" />
                        </div>
                      </div>
                    </div>

                  </div>

                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Tacrolimus Dose</label>
                        <div class="col-sm-8">
                          <input name="patient_age" type="text" class="form-control" />
                        </div>
                      </div>
                    </div>

                    <div class="col-md-8">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Other Drugs & Dose</label>
                        <div class="col-sm-3">
                          <input name="patient_age" type="text" class="form-control" />
                        </div>
                        <div class="col-sm-3">
                          <input name="patient_age" type="text" class="form-control" />
                        </div>

                        <div class="col-sm-3">
                          <input name="patient_age" type="text" class="form-control" />
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
            </div>
       </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed text-uppercase" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Doctor Information
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group row">
              <label class="col-sm-4 col-form-label">Name</label>
              <div class="col-sm-8">
                <input name="patient_name" placeholder="Enter Doctor name" type="text" class="form-control" />
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Hospital</label>
              <div class="col-sm-9">
                <input name="patient_dob"  type="text" class="form-control" />
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group row">
              <label class="col-sm-4 col-form-label">Contact No</label>
              <div class="col-sm-8">
                <input name="patient_age" placeholder="Enter doctor contact number" type="text" class="form-control" />
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group row">
              <label class="col-sm-4 col-form-label">Email</label>
              <div class="col-sm-8">
                <input name="patient_age" placeholder="Enter doctor email" type="text" class="form-control" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingThree">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed text-uppercase" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Sample collection form
        </button>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-4 col-form-label">Sample collection address</label>
              <div class="col-sm-8">
                <textarea name="name" class="form-control"></textarea>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Contact Person</label>
              <div class="col-sm-9">
                <input name="patient_dob"  type="text" class="form-control" />
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-4 col-form-label">Contact No</label>
              <div class="col-sm-8">
                <input name="patient_age" placeholder="" type="text" class="form-control" />
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-4 col-form-label">Collection Date</label>
              <div class="col-sm-8">
                <input name="patient_age"  type="date" class="form-control" />
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-4 col-form-label">Collection Time</label>
              <div class="col-sm-8">
                <input name="patient_age"  type="text" class="form-control" />
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header" id="headingFour">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed text-uppercase" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
          Sms feild use
        </button>
      </h5>
    </div>
    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-4 col-form-label">Request processed by</label>
              <div class="col-sm-8">
                <textarea name="name" class="form-control"></textarea>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Date</label>
              <div class="col-sm-9">
                <input name="patient_dob"  type="date" class="form-control" />
              </div>
            </div>
          </div>

        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Assay Subsidy</label>
              <div class="col-sm-9">
                <input name="patient_dob"  type="text" class="form-control" />
              </div>
            </div>
          </div>


          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-4 col-form-label">Email</label>
              <div class="col-sm-8">
                <input name="patient_age" placeholder="" type="text" class="form-control" />
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-4 col-form-label">Amount to be collected from patient</label>
              <div class="col-sm-8">
                <input name="patient_age"  type="text" class="form-control" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingFive">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed text-uppercase" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
          Metropolis Use
        </button>
      </h5>
    </div>
    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
      <div class="card-body">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group row">
              <label class="col-sm-4 col-form-label">Name</label>
              <div class="col-sm-8">
                <textarea name="name" class="form-control"></textarea>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Contact</label>
              <div class="col-sm-9">
                <input name="patient_dob"  type="text" class="form-control" />
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Email Id</label>
              <div class="col-sm-9">
                <input name="patient_dob"  type="text" class="form-control" />
              </div>
            </div>
          </div>


        </div>


      </div>
    </div>
  </div>
</div>

</div>


<br>
<div class="row">
  <button type="button" class="btn btn-block btn-info" name="button">Save</button>
</div>
            <!-- <div class="row">
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
            </div> -->
            <!-- <div class="row">
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
            </div> -->

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- content-wrapper ends -->
