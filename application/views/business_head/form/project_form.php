

<?php
  if( isset( $projectData ) )
  $editProject = true;
  else
  $editProject = false;

 ?>
<div class="content-wrapper">
  <div class="row">
    <div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title"><?=($editProject)?'Edit Project':'New Project'?></h4>
          <?php $action_url = ($editProject)?base_url('Project/update_project'):base_url('Project/add_new_project') ?>
          <form action="<?=$action_url ?>" method="post" class="form-sample">
            <p class="card-description">
              Project Details
            </p>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Project Name</label>
                  <div class="col-sm-9">
                    <input name="project_name" value="<?=($editProject)?$projectData->project_name:''?>" placeholder="Enter project name" type="text" class="form-control" />
                  </div>
                </div>
              </div>

              <?php if( !$editProject ): ?>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Select Project Manager</label>
                  <div class="col-sm-9">
                    <select  name="pm_id" class="form-control">
                      <?php foreach ($pm_list as $key => $value): ?>
                        <option  value="<?=$value->id?>"><?=$value->fullname?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
            <?php endif; ?>
            </div>

          <?php if( !$editProject ): ?>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Select Company</label>
                  <div class="col-sm-9">
                    <select id="selectCompany" onchange="getBhd()" name="company_id" class="form-control">
                      <?php foreach ( $company_list as $key => $value): ?>
                        <option value="<?=$value->comp_id?>"><?=$value->comp_name?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">BHD Name</label>
                  <div class="col-sm-9">
                    <input type="hidden" id="emp_id" name="emp_id" value="">
                    <input type="text" readonly class="form-control" id="empName" value="">
                  </div>
                </div>
              </div>

            </div>
          <?php endif; ?>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Start Date</label>
                  <div class="col-sm-9">
                    <input type="date"   class="form-control" name="start_date" value="<?=($editProject)?$projectData->project_start_date:''?>" >
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">End date</label>
                  <div class="col-sm-9">
                    <input type="date"  class="form-control" name="end_date" value="<?=($editProject)?$projectData->project_end_date:''?>">
                  </div>
                </div>
              </div>
            </div>


            <div class="row">
              <div class="col-md-6">
                <button type="submit" class="btn btn-info" ><?=($editProject)?'Update':'Save'?></button>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- content-wrapper ends -->

<script type="text/javascript">

  function getBhd(){
    var selectCompany = document.getElementById('selectCompany');
    var employee_id = document.getElementById('emp_id');
    var employeeName = document.getElementById('empName');
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
              var userObject = JSON.parse( this.responseText );
              employee_id.value = userObject.id ;
              employeeName.value = userObject.fullname;
        }
    };
    xhttp.open("POST", "<?=base_url('Company/getBHD')?>", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("company_id="+ selectCompany.value );
  }
</script>
