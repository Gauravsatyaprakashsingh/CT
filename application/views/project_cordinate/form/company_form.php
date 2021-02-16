

<div class="content-wrapper">
  <div class="row">
    <div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Company Master</h4>
          <form class="form-sample" action="<?=base_url('Coupon/add_new_coupon')?>" method="post">
            <p class="card-description">
              Company Details
            </p>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Company Name</label>
                  <div class="col-sm-9">
                    <input name="name"  placeholder="Enter company name" type="text" class="form-control" />
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Company Code</label>
                  <div class="col-sm-9">
                    <input name="code" placeholder="Enter Company code" type="text" class="form-control" />
                  </div>
                </div>
              </div>
            </div>


            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Company contact</label>
                  <div class="col-sm-9">
                    <input name="contact" placeholder="Enter Company contact" type="text" class="form-control" />
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Company address</label>
                  <div class="col-sm-9">
                    <input name="client_code" placeholder="Enter Client code" type="text" class="form-control" />
                  </div>
                </div>
              </div>
            </div>

            <!-- <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Valid From</label>
                  <div class="col-sm-9">
                    <input name="valid_from" type="date" class="form-control" />
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Valid Till</label>
                  <div class="col-sm-9">
                    <input name="valid_till" type="date" class="form-control" />
                  </div>
                </div>
              </div>
            </div> -->


            <!-- <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Coupon type categories</label>
                  <div class="col-sm-9">
                    <select  name="coupon_type" class="form-control">
                      <option value="1">FOC </option>
                      <option value="2">Co-paid</option>
                      <option value="3">Fully-paid</option>
                    </select>
                  </div>
                </div>
              </div>
            </div> -->

            <div class="row">
              <button type="submit" class="btn btn-info"></button>
            </div>






          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- content-wrapper ends -->
