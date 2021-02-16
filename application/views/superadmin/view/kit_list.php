


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
<form id="kitForm" action="<?=base_url('Kit/edit_kit')?>" method="post">
  <input id="kitValue" type="hidden" name="kit_value" value="">
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
                  <th>Kit Name</th>
                  <th>Currtent Quantity</th>
                  <th>Minimum Quantity</th>
                  <th>Description</th>
                  <th>Manage</th>
                </tr>
              </thead>
              <tbody>
                <?php $counter = 1; foreach ($tableData as $key => $value): ?>
                  <tr>
                    <td><?=$counter++?></td>
                    <td><?=$value->kit_name?></td>
                    <td><?=$value->kit_current_quantity?></td>
                    <td><?=$value->kit_minimum_quantity?></td>
                    <td><?=$value->kit_description?></td>
                    <td>
                      <button  title="Edit Project" onclick="edit_kit( '<?=$value->kit_id?>' )" class="btn btn-icons btn-rounded btn-info" type="button" name="button">
                        <i class="fa fa-pencil"></i>
                      </button>
                      <a href="<?=base_url('Kit/delete_kit?value=').$value->kit_id?>" title="Remove Project" class="btn btn-icons btn-rounded btn-danger" >
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

  function edit_kit( kit_value ){
    document.getElementById('kitValue').value = kit_value ;
    document.getElementById('kitForm').submit();
  }
</script>
