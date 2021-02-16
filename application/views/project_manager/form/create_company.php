<?php
   if( isset( $companyData) )
     $editCompany = true;
   else
    $editCompany = false
 ?>


<div class="content-wrapper">
  <div class="row">
    <div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title"><?=($editCompany)?'Edit Company':'New Company'?></h4>
          <?php $actionUrl = ($editCompany)?base_url('Company/update_company'):base_url('Company/save_company') ?>
          <form id="userForm" action="<?=$actionUrl?>" method="post" class="form-sample">
            <?php if( $editCompany): ?>
              <input type="hidden" name="company_value" value="<?=$companyData->comp_id?>">
            <?php endif; ?>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Company Name</label>
                  <div class="col-sm-9">
                    <input name="company_name" value="<?=($editCompany)?$companyData->comp_name:''?>"  placeholder="Enter Company name" type="text" class="form-control" />
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Company Code</label>
                  <div class="col-sm-9">
                    <input name="code" value="<?=($editCompany)?$companyData->comp_code:''?>" placeholder="Enter Company code" type="text" class="form-control" />
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Company contact</label>
                  <div class="col-sm-9">
                    <input name="contact" value="<?=($editCompany)?$companyData->comp_contact:''?>" placeholder="Enter Company contact" type="text" class="form-control" />
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Company address</label>
                  <div class="col-sm-9">
                    <textarea name="address" placeholder="Enter Company address" class="form-control"><?=($editCompany)?$companyData->comp_address:''?></textarea>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <button type="submit" class="btn btn-info" ><?=($editCompany)?'Update':'Save'?></button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- content-wrapper ends -->


<script src="<?=base_url('js/validation/userForm.js')?>"></script>
