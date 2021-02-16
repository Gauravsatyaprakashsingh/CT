<?php
  if( isset($kitData) ){
    $editKit = true;
  }
  else {
    $editKit = false;
  }



 ?>

<div class="content-wrapper">
  <div class="row">
    <div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Kit Management </h4>
          <?php $actionUrl = ($editKit)?base_url('Kit/update_kit'):base_url('Kit/add_new_kit')?>
          <form class="form-sample" action=<?=$actionUrl?> method="post">
            <?php if($editKit): ?>
              <input type="hidden" name="kit_value" value="<?=$kitData->kit_id?>">
            <?php endif; ?>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Kit Name</label>
                  <div class="col-sm-9">
                    <input type="text" value="<?=($editKit)?$kitData->kit_name:''?>" class="form-control" name="kit"/>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Currtent Quantity</label>
                  <div class="col-sm-9">
                    <input type="text" value="<?=($editKit)?$kitData->kit_current_quantity:''?>" class="form-control" name="cquantity" />
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Minimum Quantity</label>
                  <div class="col-sm-9">
                    <input type="text" value="<?=($editKit)?$kitData->kit_minimum_quantity:''?>" class="form-control" name="mquantity" />
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Kit Description</label>
                  <div class="col-sm-9">
                    <input type="text" value="<?=($editKit)?$kitData->kit_description:''?>" class="form-control" name="desc"/>
                  </div>
                </div>
              </div>

             <div class="row">
               <button type="submit" class="btn btn-info btn-rounded" name="button"><?=($editKit)?'Update':'Save'?></button>
             </div>




          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- content-wrapper ends -->
