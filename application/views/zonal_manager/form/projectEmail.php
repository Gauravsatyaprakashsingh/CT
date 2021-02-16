<?php
function getStatus( $currentStatus ){
 if( $currentStatus == 1 )
   return [ 'class'=>'text-info' , 'status' =>'Requested' ];
 elseif ( $currentStatus == 2 )
   return [ 'class'=>'text-success' , 'status' =>'Collected From Patient' ];
 elseif ( $currentStatus == 3 )
   return [ 'class'=>'text-success' , 'status' =>'Submited to Lab' ];
}
 ?>
<div class="content-wrapper">
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Project</h4>
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Project Details</h4>
                  <div class="row">
                    <div class="col-md-6">
                      <address >
                        <p class="font-weight-bold">Project Name : <span class="text-muted"><?=$project->project_name?></span> </p>
                        <p class="font-weight-bold">Start Date : <span class="text-muted"><?=date('M d, Y', strtotime($project->project_start_date) )?></span> </p>
                        <p class="font-weight-bold">End Date : <span class="text-muted"><?=date('M d, Y', strtotime($project->project_end_date) )?></span> </p>
                      </address>
                    </div>
                    <div class="col-md-6">
                      <address >
                       <p class="font-weight-bold">Client Email : <span class="text-muted"><?=$project->client_email ?></span> </p>
                       <p class="font-weight-bold">Client Contact : <span class="text-muted"><?=$project->client_contact ?></span> </p>
                       <!-- <p class="font-weight-bold">Payment Type : <span class="text-muted">FOC</span> </p> -->
                      </address>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

    <form class="" action="<?=base_url('Project/sendIntroMail')?>" method="post">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">To</label>
                <div class="col-sm-9">
                  <input name="to" value="<?=$project->client_email ?>"  readonly type="text" class="form-control" />
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Subject</label>
                <div class="col-sm-9">
                  <input name="subject" placeholder="Enter Subject here" type="text" class="form-control" />
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group row">
                <label class="col-sm-1 col-form-label">Body</label>
                <div class="col-sm-11">
                  <textarea type="text" class="form-control"></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <button type="submit" class="btn btn-info" >Send</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>



</div>
