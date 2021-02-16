

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
<form id="projectsForms" action="<?=base_url('Project/view_test')?>" method="post">
    <input id="projectsValues" type="hidden" name="projects_values" value="">
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
                  <th>Manage</th>
                </tr>
              </thead>
              <tbody>
                <?php $counter = 1; foreach ($tableData as $key => $value): ?>
                  <tr>
                    <td><?=$counter++?></td>
                    <td><?=$value->project_name?></td>
                    <td><?=date('M d, Y', strtotime($value->project_start_date) )?></td>
                    <td>
                      <?php  $status = getStatus( $value->project_status ) ; ?>
                      <p class="<?=$status['class']?>"><?=$status['status']?></p>
                    </td>
                    <td>
                      <button  title="Edit Project" onclick="edit_project( '<?=$value->project_id?>' )" class="btn btn-icons btn-rounded btn-info" type="button" name="button">
                        <i class="fa fa-pencil"></i>
                      </button>
                      <a href="<?=base_url('Project/delete_project?value=').$value->project_id?>" title="Remove Project" class="btn btn-icons btn-rounded btn-danger" >
                        <i class="fa fa-trash"></i>
                      </a>
                      
                      <button  title="Edit Project" onclick="assigned_Test( '<?=$value->project_id?>' )" class=" btn btn-info" type="button" name="button">
                        Assign Test
                      </button>
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

  function assigned_Test(project_value){
    document.getElementById('projectsValues').value = project_value ;
    document.getElementById('projectsForms').submit();

  }
</script>
