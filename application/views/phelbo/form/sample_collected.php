 <?php //print_r($pat_isd);exit;?>
<div class="content-wrapper">
  <div class="row">
    <div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Sample Collected</h4>
          <form class="form-sample" method="post" enctype='multipart/form-data' action="<?= base_url('sample_phelbo')?>">
            <p class="card-description">
              Sample Collected
            </p>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Patient  Name</label>
                  <div class="col-sm-9">
                    <?php foreach( $patient_name as $key => $value){?>
                    <input name="patient_name" placeholder="Enter Patient" value="<?=$value->patient_name ?>"  readonly="" type="text" class="form-control" />
                  <?php } ?>
                    <input type="hidden" name="visit_id" value="<?= $ids?>">
                    <input type="hidden" name="patient_idss" value="<?= $pat_isd ?>">
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Amount to be collected</label>
                  <div class="col-sm-9">
                   <?php foreach( $patient_name as $key => $value){?>
                  <input type="text" readonly value="<?= $value->price ?>" name="payment_status" class="form-control">
                  <input type="hidden" readonly value="<?//= $value->client_email ?>" name="cclient_emails" class="form-control"><?php } ?>

                    <!--<select name="payment_status" class="form-control">-->
                    <!--  <option value="Recieved">Recieved</option>-->
                    <!--  <option value="Not Recieved">Not Recieved</option>-->
                    <!--</select>-->
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Extra Test</label>
                  <div class="col-sm-9">
                    <input name="extra_test" placeholder="Enter Extra Test (if any)" type="text" class="form-control" />
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Sample Collected</label>
                  <div class="col-sm-9">
                    <select name="sample_collected" class="form-control">
                      <option value="Yes">Yes</option>
                      <option value="No">No</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Email ID</label>
                  <div class="col-sm-9">
                    <input name="email_id" placeholder="Enter Multiple Emails" type="text" class="form-control" />
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">TRF Upload</label>
                  <div class="col-sm-9">
                    <input name="agreement[]"  type="File" class="form-control" multiple="" />
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
             <div class="col-md-4">
               <div class="form-group row">
                  <label class="col-sm-5 col-form-label">Copen Number</label>
                  <div class="col-sm-7">
                    <input name="copen" placeholder="Enter Copen" type="text" class="form-control" />
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group row">
                   <label class="col-sm-7 col-form-label">No of vacutainer</label>
                   <div class="col-sm-5">
                     <input name="n_vacutainer" type="text" class="form-control" />
                   </div>
                 </div>
               </div>

             <div class="col-md-5">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Remarks</label>
                  <div class="col-sm-9">
                    <textarea class="form-control" name="remarks" placeholder="Enter Remarks"></textarea>
                  </div>
                </div>
              </div></div>
            <div class="row">
               <button style="margin-left: 10px" name="agreement" type="submit" class="btn btn-info" name="button"> Save </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- content-wrapper ends -->
