<?php //print_r($cc);exit;?>
<style type="text/css">
  .bt{
    display: none;
  }
</style>
<?php
$tableData = empty($tableData)?[]:$tableData;
$userType = $this->session->userdata('log_user')['type'];
?>

<?php
function getPaymentType( $paymentType ){
 if( $paymentType == 1 )
   return [ 'class'=>'text-default' , 'status' =>'FOC' ];
 elseif ( $paymentType == 2 )
   return [ 'class'=>'text-default' , 'status' =>'Co-payment' ];
 elseif ( $paymentType == 3 )
   return [ 'class'=>'text-default' , 'status' =>'Patient paid' ];
}

function getVisitType( $type ){
  if( $type == 1 )
    return [ 'class'=>'text-info' , 'status' =>'Home Collection' ];
  elseif ( $type == 2 )
    return [ 'class'=>'text-success' , 'status' =>'Sample pick up' ];
  elseif ( $type == 3 )
    return [ 'class'=>'text-success' , 'status' =>'Walk In' ];
  elseif ( $type == 4 )
    return [ 'class'=>'text-success' , 'status' =>'Camp' ];

}

function getStatus( $StatusType ){
  switch( $StatusType ){
    case '9':
        return [ 'class'=>'text-success' , 'status' =>'Sample Delivered' ];
    break;
    case '1':
        return [ 'class'=>'text-success' , 'status' =>'Request Assigned' ];
    break;
     case '13':
        return [ 'class'=>'text-success' , 'status' =>'Waiting For SisterLab' ];
    break;
    case '2':
        return [ 'class'=>'text-success' , 'status' =>'Sister Lab Accepted Request' ];
    break;
    case '3':
        return [ 'class'=>'text-danger' , 'status' =>'Sister Lab Denied Request' ];
    break;
    case '4':
        return [ 'class'=>'text-danger' , 'status' =>'Request Cancelled' ];
    break;
    case '5':
        return [ 'class'=>'text-success' , 'status' =>'Reached at Client' ];
    break;
    case '6':
        return [ 'class'=>'text-success' , 'status' =>'Phlebo Accepted Request' ];
    break;
    case '11':
        return [ 'class'=>'text-success' , 'status' =>'Logistic Accepted Request' ];
    break;
    case '7':
        return [ 'class'=>'text-danger' , 'status' =>'Phlebo Denied Request' ];
    break;
    case '8':
        return [ 'class'=>'text-danger' , 'status' =>'Logistic Denied Request' ];
    break;
    case '10':
        return [ 'class'=>'text-danger' , 'status' =>'Sample Collected' ];
    break;
    case '12':
        return [ 'class'=>'text-danger' , 'status' =>'Sister Lab Pick up Request ' ];
    break;
    case '14':
        return [ 'class'=>'text-danger' , 'status' =>'Sister Lab  Denial in progress ' ];
    break;
    default:
    return [];
  }
}


function getCancelled(){
    return [ 'class'=>'text-danger' , 'status' =>'Request Already Cancelled' ];
}
 ?>


<form id="projectForm" action="<?=base_url('Logistic_sister/sample_collected')?>" method="post">
  <input id="projectValue" type="hidden" name="project_value" value="">
</form>
<form id="projectForms" action="<?=base_url('Logistic_sister/phelbo_accepted')?>" method="post">
  <input id="phelbo_id" type="hidden" name="phelbo_id" value="">
</form>
<form id="projectFormss" action="<?=base_url('Logistic_sister/phelbo_denied')?>" method="post">
  <input id="phelbos_id" type="hidden" name="phelbos_id" value="">
</form>

<div class="content-wrapper">
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Total Request</h4>
          <div class="table-responsive">
            <table id="table_id" class="table table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Request ID</th>
                  <?php if ( $userType== 15 ): ?>
                    <th>Phlebo Name</th>
                    <th>Phlebo Contact</th>
                    <!-- <th>Phlebo Email</th> -->
                  <?php endif; ?>
                  <th>Company Name</th>
                  <th>Location</th>
                  <th>Address</th>
                  <th>Type of Collection</th>
                   <th>Status</th>
                  <th>Date of Collection</th>
                  <th>Request</th>
                </tr>
              </thead>
              <tbody>
                <?php $counter = 1;  foreach ($tableData as $key => $value):  ?>
                  <tr>
                    <td><?=$counter++?></td>
                    <td><?=$value->visit_unique_id ?></td>
                    <?php if ( $userType== 15 ): ?>
                      <td><?=$value->Phelbo_name?></td>
                      <td><?=$value->phelbo_contact?></td>
                      <!-- <td>Phlebo Email</td> -->
                    <?php endif; ?>
                    <td><?=$value->clients_name ?></td>
                    <?php if( $value->type_of_collection == '4'){ ?><td><?=$value->city.','.$value->State?></td>
                    <?php } else{?>
                     <td><?=$value->city.','.$value->State?></td>
                    <?php }?>
                    <td><?=$value->Address ?></td>
                    <td>
                      <?php  $status = getVisitType( $value->type_of_collection ) ; ?>
                      <p class="<?=$status['class']?>"><?=$status['status']?></p>
                    </td>
                    <td>
                      <?php $status1 = getStatus( $value->stat );?>
                      <p class="<?=$status1['class']?>"><?=$status1['status']?></p>
                    </td>
                     <!-- <td><?=$value->city.','.$value->State?></td> -->
                    <td><?=date('Y-m-d',strtotime($value->log_time))?></td>
                    <!-- <td>
                        <a href="<?//=base_url('Request/request_detail?value=').$value->visit_id?>" class="btn btn-rounded btn-info" >View</a>
                    </td> -->
                  <?php if( $value->stat == '2'  ){?>
                  <td>
                   <?php
                      if( $value->stat == '5' || $value->stat == '9' || $value->stat == '10' ){}else{?>
                    <a href="<?=base_url('Sister_Request/phelbo_Reached?id=').$value->visit_id?>" title="Reached at Client"  class="btn btn-rounded btn-info ">Reached at Client</a><?php }?>
                     <a href="<?=base_url('Request/request_detail?value=').$value->visit_id?>" class="btn btn-rounded btn-info" >View</a>

                    <!-- <button onclick="Accepted('<?= $value->visit_id ?>')" title="Accept Request" class="btn btn-rounded btn-success">&#10004;</button>
                    <button onclick="Denied('<?= $value->visit_id ?>')"  title="Deny Request" class="btn btn-rounded btn-danger" ><i class="fa fa-close" style="font-size:12px"></i></button> -->

                  </td><?php } else {
                    if( $value->stat == '8' || $value->stat == '7' || $value->stat == '4' ) { ?>
                      <td>
                      <!-- <?php $status2 = getCancelled( );?>
                      <p class="<?=$status2['class']; ?>" ><?=$status2['status']?></p> -->
                      </td><?php } else{?>
                  <td>

                    <?php if( $value->stat == '5' ){?>
                                            <!--<a href="<?//=base_url('Request/patient_views?value=').$value->visit_id?>" class="btn  btn-success" >View Patient</a>-->

                    <?php } ?>
                    <?php if(  $value->stat == '10' ){ ?>
                     <a href="<?=base_url('Request/patient_views?value=').$value->visit_id?>" class="btn  btn-success" >View Patient</a>
                    <!--<a href="<?//=base_url('Sister_Request/phelbo_Delivered?id=').$value->visit_id?>" title="Sample Delivered" class="btn btn-rounded btn-info">Sample Delivered</a>-->
                  <?php }
                  else{

                      if( $value->stat == '9' ){
                      ?>
                      <a href="<?=base_url('Request/request_detail?value=').$value->visit_id?>" class="btn btn-rounded btn-info" >View</a>
                      <?php  }else{?>
                      <a href="<?=base_url('Request/patient_views?value=').$value->visit_id?>" class="btn  btn-success" >View Patient</a>
                  <?php }}

                  }}  ?>
                  </tr>


                <?php endforeach; ?>
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

    function Accepted(visit_id){
        document.getElementById('phelbo_id').value = visit_id;
        document.getElementById('projectForms').submit();
   }

    function Denied(visit_id){
        document.getElementById('phelbos_id').value = visit_id;
        document.getElementById('projectFormss').submit();
   }
  // function edit_project( project_value ){
  //   document.getElementById('projectValue').value = project_value ;
  //   document.getElementById('projectForm').submit();
  // }


  //  function accepted() {
  //   var Accepted = document.getElementById('Accepted');
  //   var updated = document.getElementById('updated');
  //   Accepted.style.display = "none";
  //   updated.classList.remove('bt');
  // }

  // function reached(){
  // var sample = document.getElementById('sample');
  // updated.classList.add('bt');
  // sample.classList.remove('bt');
  // }

  function sample( id ){
    document.getElementById('projectValue').value = id;
    document.getElementById('projectForm').submit();
  }

  // function reason(){
  //   alert('s');
  // }
</script>
