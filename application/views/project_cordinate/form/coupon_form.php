


<div class="content-wrapper">
  <div class="row">
    <div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Business Aliance Coupon Master</h4>
          <form class="form-sample" action="<?=base_url('Coupon/add_new_coupon')?>" enctype="multipart/form-data" method="post">
            <p class="card-description">
              Coupon Details
            </p>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Enter Pre Text</label>
                  <div class="col-sm-9">
                    <input name="pre_text" placeholder="Enter coupon Pre Text" type="text" class="form-control" />
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group row">
                  <label class="col-sm-5 col-form-label">Series Start From </label>
                  <div class="col-sm-7">
                    <input  type="tel" name="series_start" placeholder="Enter Number" class="form-control" />
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group row">
                  <label class="col-sm-5 col-form-label">Series End</label>
                  <div class="col-sm-7">
                    <input  type="tel" name="series_end" placeholder="Enter Number"  class="form-control" />
                  </div>
                </div>
              </div>
            </div>


            <div class="row">
              <div class="col-md-4">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Select Client</label>
                  <div class="col-sm-9">
                    <select class="form-control" onchange="addressClientCode(this)" name="client_id">
                      <option value="">Select Company</option>
                      <?php foreach ($company_list as $key => $value): ?>
                        <option value="<?=$value->comp_id.','.$value->comp_code?>"><?=$value->comp_name?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Client code</label>
                  <div class="col-sm-8">
                    <input name="client_codes" id="client_code" readonly placeholder="Enter Client code" type="text" class="form-control" />
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group row">
                  <label class="col-sm-5 col-form-label">Coupon Name</label>
                  <div class="col-sm-7">
                    <input name="coupon_name"  type="text" class="form-control" />
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
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
            </div>


            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Coupon type categories</label>
                  <div class="col-sm-9">
                    <select  name="coupon_type" class="form-control">
                      <option value="1">FOC </option>
                      <option value="2">Co-paid</option>
                      <option value="3">Fully-paid</option>
                      <option value="4">FOC + Co-paid </option>
                      <option value="5">Co-paid + Fully-paid</option>
                      <option value="6">FOC + Fully-paid</option>
                      <option value="7">FOC + Co-paid + Fully-paid</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Coupon-Image(Front)</label>
                  <div class="col-sm-9">
                    <input type="file" accept="image/*" name="front_image" class="form-control" />
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Coupon-Image(Back)</label>
                  <div class="col-sm-9">
                    <input type="file" accept="image/*" name="back_image"  class="form-control" />
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <button type="submit" class="btn btn-info">Save</button>
            </div>






          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- content-wrapper ends -->

<script type="text/javascript">
  function addressClientCode( companyList ){
    var result = companyList.value.split(",");
    $('#client_code').val( result[1] );
  }
</script>
