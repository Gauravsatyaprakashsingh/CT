<?php
 function getStatus( $currentStatus ){
  if( $currentStatus == 0 )
    return [ 'class'=>'text-warning' , 'status' =>'Iniated' ];
  elseif ( $currentStatus == 1 )
    return [ 'class'=>'text-success' , 'status' =>'Active' ];
  elseif ( $currentStatus == 2 )
    return [ 'class'=>'text-danger' , 'status' =>'Closed' ];
 }

$tableData = empty($tableData)?[]:$tableData;

?>
<form id="projectForm" action="<?=base_url('Project/edit_project')?>" method="post">
  <input id="projectValue" type="hidden" name="project_value" value="">
</form>

<div class="content-wrapper">
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Total Project</h4>
          <div class="table-responsive">
            <table id="table_id" class="table table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Project Name</th>
                  <th>Start Date</th>
                  <th>Status</th>
                  <!-- <th>Manage</th> -->
                </tr>
              </thead>
              <tbody>
                <?php $counter = 1; foreach ($tableData as $key => $value): ?>
                  <tr>
                    <td><?=$counter++?></td>
                    <td><?=$value->project_name?></td>
                    <td> <?=date('M d, Y', (int)$value->project_start_date )?></td>
                    <td>
                      <?php  $status = getStatus( $value->project_status ) ; ?>
                      <p class="<?=$status['class']?>"><?=$status['status']?></p>
                    </td>
                    <!-- <td>
                      <button  title="Edit Project" onclick="edit_project( '<?=$value->project_id?>' )" class="btn btn-icons btn-rounded btn-info" type="button" name="button">
                        <i class="fa fa-pencil"></i>
                      </button>
                      <a href="<?=base_url('Project/sendEmail?value=').$value->project_id?>" title="Send Mail" class="btn btn-icons btn-rounded btn-warning" >
                        <i class="fa fa-mail-reply"></i>
                      </a>
                      <a href="<?=base_url('Project/view_project_details?value=').$value->project_id?>" title="View Project" class="btn btn-icons btn-rounded btn-success" >
                        <i class="fa fa-eye"></i>
                      </a>
                    </td> -->
                  </tr>
                <?php endforeach;?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- content-wrapper ends -->

<script type="text/javascript">

  function edit_project( project_value ){
    document.getElementById('projectValue').value = project_value ;
    document.getElementById('projectForm').submit();
  }
</script>