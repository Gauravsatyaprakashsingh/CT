<?php
 $action_url = base_url('Project/add_new_project');
 ?>
<div class="content-wrapper">
  <div class="row">
    <div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">New Project</h4>
          <form id="projectForm" action="<?=$action_url ?>" method="post" class="form-sample">
            <p class="card-description">
              Project Details
            </p>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Project name</label>
                  <div class="col-sm-9">
                    <input  name="project_name" placeholder="Enter project name" type="text" class="form-control" />
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Select Project Manager</label>
                  <div class="col-sm-9">
                    <select data-show-subtext="true" data-live-search="true"  name="pm_id" class="form-control">
                      <?php foreach ($pm_list as $key => $value): ?>
                        <option value="<?=$value->id?>"><?=$value->fullname?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Select Client</label>
                  <div class="col-sm-9">
                    <select name="client_code" class="form-control">
                      <?php foreach ($client_list as $key => $value): ?>
                        <option value="<?=$value->id?>"><?=$value->fullname?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <!-- <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">City</label>
                  <div class="col-sm-9">
                    <select name="city_id" class="form-control">
                      <option>Mumbai</option>
                      <option>Pune</option>
                    </select>
                  </div>
                </div>
              </div> -->
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Start Date</label>
                  <div class="col-sm-9">
                    <input type="date" class="form-control" name="start_date" value="">
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">End date</label>
                  <div class="col-sm-9">
                    <input type="date" class="form-control" name="end_date" value="">
                  </div>
                </div>
              </div>
            </div>


            <div class="row">
              <div class="col-md-6">
                <button type="submit" class="btn btn-info" >Save</button>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- content-wrapper ends -->

<script src="<?=base_url('js\validation\projectForm.js')?>"></script>
