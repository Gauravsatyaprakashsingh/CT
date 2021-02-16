<?php
   if( isset($testData) )
     $editTest = true;
   else
    $editTest = false
 ?>




<div class="content-wrapper">
  <div class="row">
    <div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title"><?=($editTest)?'Edit Test':'New Test'?></h4>
          <?php $actionUrl = ($editTest)?base_url('Test/update_test'):base_url('Test/save_test') ?>
          <form id="userForm" action="<?=$actionUrl?>" method="post" class="form-sample">
            <?php if( $editTest): ?>
              <input type="hidden" name="test_value" value="<?=$testData->test_id?>">
            <?php endif; ?>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Test Name</label>
                  <div class="col-sm-9">
                    <input name="test_name" value="<?=($editTest)?$testData->test_name:''?>"  placeholder="Enter Test name" type="text" class="form-control" />
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Test Code</label>
                  <div class="col-sm-9">
                   <input name="test_code" value="<?=($editTest)?$testData->test_code:''?>"  placeholder="Enter Test code" type="text" class="form-control" />
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Type Of Shipment</label>
                  <div class="col-sm-9">
                   <input name="test_Shipment" value="<?=($editTest)?$testData->Type_of_shipment:''?>"  placeholder="Enter Test code" type="text" class="form-control" />
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Type of Vacutainer</label>
                  <div class="col-sm-9">
                   <input name="vacutainer_type" value="<?=($editTest)?$testData->vacutainer_type:''?>"  placeholder="Enter vacutainer type" type="text" class="form-control" />
                  </div>
                </div>
              </div>
            </div>


            <div class="row">
              <button type="submit" class="btn btn-info" ><?=($editTest)?'Update':'Save'?></button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- content-wrapper ends -->


<script src="<?=base_url('js/validation/userForm.js')?>"></script>
