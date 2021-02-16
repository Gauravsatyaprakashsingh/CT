

<?php
// print_r($tableData);exit;
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
<form id="projectForm" action="<?=base_url('User/edit_project_cordinate')?>" method="post">
  <input id="projectValue" type="hidden" name="cordinate_id" value="">
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
                  <th>Name</th>
                  <th>Email</th>
                  <th>Contact Number</th>
                  <th>Area</th>
                  <th>Address/Location</th>
                  <th>Pincode</th>
                  <th>Manage</th>
                </tr>
              </thead>
              <tbody>
                <?php $counter = 1; foreach ($tableData as $key => $value): ?>
                  <tr>
                    <td><?=$counter++?></td>
                    <td><?=$value->sis_name?></td>
                    <td><?=$value->sis_email?></td>
                    <td><?=$value->sis_contact?></td>
                    <td><?=$value->sis_area?></td>
                    <td><?=$value->sis_address?></td>
                    <td><?=$value->sis_pincode?></td>
                    <!--<td>-->
                    <!--  <p class="text-success">Active</p>-->
                    <!--</td>-->
                    <td>
                      <a  title="Edit SisterLab" href="<?= base_url('Sisterlab/update_sisterlab?id=')?><?=$value->sis_id?>"  class="btn btn-icons btn-rounded btn-info" >
                        <i class="fa fa-pencil"></i>
                      </a>
                      <a href="<?= base_url('Sisterlab/delete_sisterlab?id=')?><?=$value->sis_id?>" title="Delete SisterLab" class="btn btn-icons btn-rounded btn-danger" >
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
