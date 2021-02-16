

<?php
 function getStatus( $currentStatus ){
  if( $currentStatus == '1' )
    return [ 'class'=>'text-success' , 'status' =>'Active' ];
  elseif ( $currentStatus == '0' )
    return [ 'class'=>'text-info' , 'status' =>'Not Active' ];
  elseif ( $currentStatus == '2' )
    return [ 'class'=>'text-warning' , 'status' =>'Suspended' ];
  elseif ( $currentStatus == '3' )
    return [ 'class'=>'text-danger' , 'status' =>'Blocked' ];

 }

$tableData = empty($tableData)?[]:$tableData;

?>
<form id="userForm" action="<?=base_url('Users/edit_user')?>" method="post">
  <input id="userValue" type="hidden" name="user_value" value="">
</form>

<div class="content-wrapper">
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Total User</h4>
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
                      <?php $status = getStatus( $value->status ) ; ?>
                      <p class="<?=$status['class']?>"><?=$status['status']?></p>
                    </td>
                    <td>
                      <button  title="Edit User" onclick="edit_user( '<?=$value->id?>' )" class="btn btn-icons btn-rounded btn-info" type="button" name="button">
                        <i class="fa fa-pencil"></i>
                      </button>
                      <a href="<?=base_url('Users/delete_user?value=').$value->id?>" title="Delete" class="btn btn-icons btn-rounded btn-danger" >
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

  function edit_user( user_value ){
    document.getElementById('userValue').value = user_value ;
    document.getElementById('userForm').submit();
  }
</script>
