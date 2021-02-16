<?php
if( isset($client_data) ){
    $editclient = true;
}
else{
    $editclient = false;
}
?>
<div class="content-wrapper">
  <div class="row">
    <div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
            <?php if( isset($client_data) ){?> 
            <?php foreach( $client_data as $value ){
                    $client_datas = $value;
            } }?> 
          <h4 class="card-title"><?= ($editclient)?'Edit Project Co-ordinate':'New Project Co-ordinate'?></h4>
         <?php  $action = ($editclient)?base_url('Users/update_pc'):base_url('Users/insert_project_manager'); ?>
          <form class="form-sample" method="post" action="<?= $action?>">
            <p class="card-description">
              Project Co-ordinate Details
            </p>
            <?php if( isset($client_data) ){?>
            <input type="hidden" name="id" value="<?= ($editclient)?$client_datas->id:''?>"> <?php } ?>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Co-ordinate Name</label>
                  <div class="col-sm-9">
                    <input name="project_name" placeholder="Enter project co-ordinate name" value="<?= ($editclient)?$client_datas->fullname:''?>" type="text" class="form-control" />
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Email</label>
                  <div class="col-sm-9">
                    <input name="email" placeholder="Enter project co-ordinate email" value="<?= ($editclient)?$client_datas->email:''?>" type="text" class="form-control" />
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Password</label>
                  <div class="col-sm-9">
                    <input name="password" placeholder="Enter Password" value="<?= ($editclient)?$client_datas->password:''?>" type="text" class="form-control" />
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Contact</label>
                  <div class="col-sm-9">
                    <input name="contact" placeholder="Enter Contact" value="<?= ($editclient)?$client_datas->contact:''?>" type="number" class="form-control" />
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
               <button type="submit" class="btn btn-info" name="button"> Save </button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- content-wrapper ends -->
