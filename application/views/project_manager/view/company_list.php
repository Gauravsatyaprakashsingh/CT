
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
<form id="projectForm" action="<?=base_url('Company/edit_company')?>" method="post">
  <input id="companyValue" type="hidden" name="company_value" value="">
</form>

<div class="content-wrapper">
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Total Company</h4>
          <div class="table-responsive">
            <table id="table_id" class="table table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Company Name</th>
                  <!-- <th>Coupon Name</th>
                  <th>Coupon Type</th>
                  <th>Status</th> -->
                  <th>Manage</th>
                </tr>
              </thead>
              <tbody>
                <?php $counter = 1; foreach ($companyList as $key => $value): ?>
                  <tr>
                    <td><?=$counter++?></td>
                    <td><?=$value->comp_name?></td>
                    <td>
                      <button  title="Edit Company" onclick="edit_company( '<?=$value->comp_id?>' )" class="btn btn-icons btn-rounded btn-info" type="button" name="button">
                        <i class="fa fa-pencil"></i>
                      </button>
                      <a href="<?=base_url('Company/remove_company?value=').$value->comp_id?>"title="Remove Company" class="btn btn-icons btn-rounded btn-danger" >
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

  function edit_company( company_value ){
    document.getElementById('companyValue').value = company_value ;
    document.getElementById('projectForm').submit();
  }
</script>
