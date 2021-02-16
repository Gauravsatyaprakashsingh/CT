

<style type="text/css">
input[type=checkbox]{
      transform: scale(1.5);

}
</style>

<div class="content-wrapper">
  <div class="row">
    <div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Edit Assigned Test</h4>
          <form id="userForm" action="<?= base_url('Project/update_testPrice');?>" method="post" class="form-sample">
            <?php foreach( $edit_assigned as $key=>$value ){?>
              <input type="hidden" name="test_value" value="<?=$value->pat_id?>">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Test Name</label>
                  <div class="col-sm-9">
                    <input name="test_name" value="<?= $value->test_name?>" readonly placeholder="Enter Test name" type="text" class="form-control" />
                  </div>
                </div>
              </div>
            <!--/div>
            <div class="row"-->
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Test Code</label>
                  <div class="col-sm-9">
                   <input name="test_code" value="<?= $value->test_code?>" readonly placeholder="Enter Test code" type="text" class="form-control" />
                  </div>
                </div>
            </div>
              
            <!--div class="row"-->
              <div style="margin-top: 10px" class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Full Payment</label>
                  <div class="col-sm-9">
                   <input name="fullpayment" value="<?= $value->price?>"  placeholder="Enter Test code" type="text" class="form-control" />
                  </div>
                </div>
              </div>
            <!--/div>
            <div class="row"-->
              <div style="margin-top: 10px" class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Half Payment</label>
                  <div class="col-sm-9">
                   <input name="halfpayment" value="<?= $value->halfpayment?>" placeholder="Enter Test code" type="text" class="form-control" />
                  </div>
                </div>
              </div>
              <div style="margin-top: 10px" class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Foc</label>
                  <div class="col-sm-9">
                    <?php $foc_id = $value->foc ;
                          if( $foc_id == "false" ){?>
                            <input type="checkbox" style="" name="Foc_checked">
                          <?php }
                          elseif ( $foc_id == "0" ) { ?>
                            <input type="checkbox" name="Foc_checked" checked>
                          <?php }
                    ?>
                  </div>
                </div>
              </div>
            </div>
            <br>
            <div class="row">
              <button type="submit" class="btn btn-info" >Update</button>
            </div>
          <?php }?>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- content-wrapper ends -->


<script src="<?=base_url('js/validation/userForm.js')?>"></script>
