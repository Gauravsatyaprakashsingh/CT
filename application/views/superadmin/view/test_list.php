
<?php
 function getStatus( $currentStatus ){
  if ( $currentStatus == '1' )
    return [ 'class'=>'text-success' , 'status' =>'Not Used' ];
  elseif ( $currentStatus == '2' )
    return [ 'class'=>'text-danger' , 'status' =>'Used' ];
 }


 function getCouponType( $currentStatus ){
  if ( $currentStatus == '1' )
    return [ 'class'=>'text-success' , 'type' =>'FOC' ];
  elseif ( $currentStatus == '2' )
    return [ 'class'=>'text-danger' , 'type' =>'Co-Paid' ];
  elseif ( $currentStatus == '3' )
    return [ 'class'=>'text-danger' , 'type' =>'Fully Paid' ];

 }
$tableData = empty($tableData)?[]:$tableData;

?>
<form id="testForm" action="<?=base_url('Test/edit_test')?>" method="post">
  <input id="testValue" type="hidden" name="test_value" value="">
</form>

<div class="content-wrapper">
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Total Test</h4>
          <div class="table-responsive">
            <table id="table_id" class="table table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Test Name</th>
                  <th>Test Code</th>
                  <th>Type Of Shipment</th>
                  <th>Vacutainer Type</th>
                  <th>Manage</th>
                </tr>
              </thead>
              <tbody>
                <?php $counter = 1; foreach ($testList as $key => $value): ?>
                  <tr>
                    <td><?=$counter++?></td>
                    <td><?=$value->test_name?></td>
                    <td><?=$value->test_code?></td>
                    <td><?=$value->Type_of_shipment?></td>
                    <td><?=$value->vacutainer_type?></td>
                    <td>
                      <button  title="Edit Company"  onclick="edit_test( '<?=$value->test_id?>' )" class="btn btn-icons btn-rounded btn-info" type="button" name="button">
                        <i class="fa fa-pencil"></i>
                      </button>
                      <a href="<?=base_url('Test/remove_test?value=').$value->test_id?>"title="Remove Company" class="btn btn-icons btn-rounded btn-danger" >
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

  function edit_test( test_value ){
    document.getElementById('testValue').value = test_value ;
    document.getElementById('testForm').submit();
  }
</script>
