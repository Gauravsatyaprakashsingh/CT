<?php
 function getStatus( $currentStatus ){
  if( $currentStatus == 1 )
    return [ 'class'=>'text-warning' , 'status' =>'Active' ];
  elseif ( $currentStatus == 0 )
    return [ 'class'=>'text-success' , 'status' =>'Not Active' ];
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
                  <th>Full Name</th>
                  <th>Designation</th>
                  <th>Status</th>
                  <th>Manage</th>
                </tr>
              </thead>
              <tbody>
                <?php $counter = 1; foreach ($tableData as $key => $value): ?>
                  <tr>
                    <td><?=$counter++?></td>
                    <td><?=$value->fullname?></td>
                    <td><?=$value->label?></td>
                    <td>
                      <?php  $status = getStatus( $value->status ) ; ?>
                      <p class="<?=$status['class']?>"><?=$status['status']?></p>
                    </td>
                    <td>
                      <button  title="Edit Project" onclick="edit_project( '<?=$value->id?>' )" class="btn btn-icons btn-rounded btn-info" type="button" name="button">
                        <i class="fa fa-pencil"></i>
                      </button>
                      <a href="<?=base_url('Project/sendEmail?value=').$value->id?>" title="Send Mail" class="btn btn-icons btn-rounded btn-danger" >
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
