
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
                  <th>Client Name</th>
                  <th>Start Series</th>
                  <th>End Series</th>
                  <th>Front Image</th>
                  <th>Back Image</th>
                  <th>Total Coupon</th>
                  <th>Used Coupon</th>
                  <th>UnUsed Coupon</th>
                  <!--th>Status</th-->
                  <th>Manage</th>
                </tr>
              </thead>
              <tbody>
                <?php $counter = 1; foreach ($tableData as $key => $value): 
                  $cid = $value->cl_id;
                 $server_front = 'http://'.$_SERVER['SERVER_NAME'].'/metropolis/coupon_image/'.$value->front_image;
                  $server_back = 'http://'.$_SERVER['SERVER_NAME'].'/metropolis/coupon_image/'.$value->back_image;
                 // http://mytestserver.tech/metropolis/coupon_image/
                  //echo $server;exit;
                ?>
                 
                
                    <tr>
                    <td><?=$counter++?></td>
                    <td><?=$value->pre_text?></td>
                    <td><?=$value->series_start?></td>
                    <td><?=$value->series_end?></td>
                    <td><img src="<?= $server_front ?>" style="width:80px;height:60px"></td>
                    <td><img src="<?= $server_back?>" style="width:80px;height:60px"></td>
                    <td><?=$value->total_coupon?></td>
                    <td><?=$value->used?></td>
                    <td><?=$value->notused?></td>
                    <!--td>
                      <?php  $type = getCouponType( $value->coupon_type ) ; ?>
                      <p class="<?=$type['class']?>"><?=$type['type']?></p>
                    </td>
                    <td>
                      <?php  $status = getStatus( $value->isUsed ) ; ?>
                      <p class="<?=$status['class']?>"><?=$status['status']?></p>
                    </td-->
                    <td>
                      <button  title="Edit Coupon"  class="btn btn-primary" onclick="cid('<?= $cid ?>')" type="button" name="button">
                        <!--i class="fa fa-pencil"></i-->
                        View
                      </button>
                      <!--a title="Remove Coupon" class="btn btn-icons btn-rounded btn-danger" >
                        <i class="fa fa-trash"></i>
                      </a-->
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

<form id="submits" action="<?= base_url('Coupon/view_coupon_list');?>" method="post">
<input type="hidden" name="c_id" id="cid" value="">
</form>

<script type="text/javascript">

  function edit_project( project_value ){
    document.getElementById('projectValue').value = project_value ;
    document.getElementById('projectForm').submit();
  }

  function cid(id){
    document.getElementById('cid').value = id;
    document.getElementById('submits').submit();
  }
</script>
