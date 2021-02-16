<div class="content-wrapper">
  <div class="row">
    <div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Project Assign To User</h4>
          <form id="userForm" action="<?=base_url('Project/save_assign_to_user')?>" method="post" class="form-sample">
            <!-- <p class="card-description">
              User Details
            </p> -->
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Select Project</label>
                  <div class="col-sm-9">
                    <select class="form-control" name="project_value">
                      <?php foreach ($project_list as $key => $value): ?>
                        <option value="<?=$value->project_id?>"><?=$value->project_name?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Select User</label>
                  <div class="col-sm-9">
                    <select class="form-control" name="assigned_to">
                      <?php foreach ( $user_list as $key => $value): ?>
                        <option value="<?=$value->id?>"><?=$value->fullname?>( <?=$value->label?> )</option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              
            </div>
            <div class="row">
              <button type="submit" class="btn btn-info" >Assign</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- content-wrapper ends -->


<script src="<?=base_url('js/validation/userForm.js')?>"></script>
