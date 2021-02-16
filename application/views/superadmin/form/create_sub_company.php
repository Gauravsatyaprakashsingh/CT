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
          <h4 class="card-title"><?=($editCompany)?'Edit Sub Company':'New Sub Company'?></h4>
          <?php $actionUrl = ($editCompany)?base_url('Company/update_sub_company'):base_url('Company/save_sub_company') ?>
          <form id="userForm" action="<?=$actionUrl?>" method="post" class="form-sample">
            <?php if( $editCompany): ?>
              <input type="hidden" name="company_value" value="<?=$companyData->sub_comp_id?>">
              <input type="hidden" name="company_id" value="<?=$companyData->company_id?>">
            <?php endif; ?>
            <?php if( ! $editCompany): ?>
            <input type="hidden" name="company_id" value="<?=$company_id?>">
          <?php endif; ?>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Sub Company Name</label>
                  <div class="col-sm-9">
                    <input name="company_name" value="<?=($editCompany)?$companyData->sub_comp_name:''?>"  placeholder="Enter Company name" type="text" class="form-control" />
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Sub Company Code</label>
                  <div class="col-sm-9">
                    <input name="code" value="<?=($editCompany)?$companyData->sub_comp_code:''?>" placeholder="Enter Company code" type="text" class="form-control" />
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Sub Company contact</label>
                  <div class="col-sm-9">
                    <input name="contact" value="<?=($editCompany)?$companyData->sub_comp_contact:''?>" placeholder="Enter Company contact" type="text" class="form-control" />
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Sub Company address</label>
                  <div class="col-sm-9">
                    <textarea name="address" placeholder="Enter Company address" class="form-control"><?=($editCompany)?$companyData->sub_comp_address:''?></textarea>
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

<?php if( !$editCompany): ?>
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Total Company</h4>
          <div class="table-responsive">
            <table id="table_id" class="table table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Sub Company Name</th>
                  <!-- <th>Coupon Name</th>
                  <th>Coupon Type</th>
                  <th>Status</th> -->
                  <th>Manage</th>
                </tr>
              </thead>
              <tbody>
                <?php $counter = 1; foreach ($subCompanyList as $key => $value): ?>
                  <tr>
                    <td><?=$counter++?></td>
                    <td><?=$value->sub_comp_name?></td>
                    <td>
                      <button  title="Edit Company" onclick="edit_company( '<?=$value->sub_comp_id?>' )" class="btn btn-icons btn-rounded btn-info" type="button" name="button">
                        <i class="fa fa-pencil"></i>
                      </button>
                      <a href="<?=base_url('Company/remove_sub_company?value=').$value->sub_comp_id?>"title="Remove Company" class="btn btn-icons btn-rounded btn-danger" >
                        <i class="fa fa-trash"></i>
                      </a>
                    </td>
                  </tr>
                <?php endforeach;?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
<?php endif ?>

    </div>
  </div>
</div>
<!-- content-wrapper ends -->
<!-- content-wrapper ends -->
<form id="projectForm" action="<?=base_url('Company/edit_sub_company')?>" method="post">
  <input id="companyValue" type="hidden" name="company_value" value="">
</form>
<script type="text/javascript">
  function edit_company( company_value ){
    document.getElementById('companyValue').value = company_value ;
    document.getElementById('projectForm').submit();
  }
</script>

<script src="<?=base_url('js/validation/userForm.js')?>"></script>
