<?php
$tableData = empty($tableData)?[]:$tableData;

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

    return [ 'class'=>'text-danger' , 'status' =>'Request Cancelled' ];
}
 ?>

<form id="projectForm" action="<?=base_url('Project/edit_project')?>" method="post">
  <input id="projectValue" type="hidden" name="project_value" value="">
</form>
<form id="projectForms" action="<?=base_url('Request/patient_views')?>" method="get">
  <input id="projectValues" type="hidden" name="value" value="">
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
                  <th>Date of Request</th>
                  <th>Request ID</th>
                  <th>Company Name</th>
                  <!-- <th>Payment Type</th> -->
                  <th>Request Type</th>
                  <th>Status</th>
                   <th>Location</th>
                  <th>Date of Collection</th>
                  <th>Request</th>
                   </tr>
              </thead>
              <tbody>
                <?php $counter = 1;  foreach ($tableData as $key => $value):  ?>
                  <tr>
                    <td><?=$counter++?></td>
                    <td><?=date('M d, Y  ', strtotime($value->schedule_at) )?></td>
                    <td><?=$value->visit_unique_id?></td>
                    <td><?=$value->comp_name?></td>
                    <!-- <td><?=getPaymentType( $value->payment_status )['status']?></td> -->
                    <td>
                      <?php  $status = getVisitType( $value->type_of_collection ) ; ?>
                      <p class="<?=$status['class']?>"><?=$status['status']?></p>
                    </td>
                    <td>
                      <?php $status1 = getStatus( $value->status );?>
                      <p class="<?=$status1['class']; ?>" ><?=$status1['status']?></p>
                    </td>
                     <?php if( $value->type_of_collection == '4'){ ?><td><?=$value->city.','.$value->State?></td>
                  <td><?=$value->camp_from_date?></td><?php } else{?>
                     <td><?=$value->city.','.$value->State?></td>

                    <td><?=$value->date_of_collection?></td><?php }?>

                   <!--<td>
                        <a href="<?//=base_url('Request/request_detail?value=').$value->visit_id?>" class="btn btn-rounded btn-info" >View</a>
                    </td>-->
                    <?php if( $value->type_of_collection == '1' ){
                    if($value->status == '13'){?>
                    <td>
                    <a href="<?=base_url('Request/request_detail?value=').$value->visit_id?>" class="btn btn-rounded btn-info">View Request1</a>
                    <a title="Accept Request" href="<?= base_url('Sister_Request?id=').$value->visit_id.'&email='.$value->client_email.'&contact='.$value->client_contact ; ?>" class="btn btn-rounded btn-success">&#10004;</a>
                    <a title="Deny Request" href="<?=base_url('Sister_Request/denies_start?id=').$value->visit_id?>" class="btn btn-rounded btn-danger" ><i class="fa fa-close" style="font-size:12px"></i></a>
                    </td>
                    <?php }else{ ?>

                    <?php
                    if( $value->status == '4' ){?><td>
                    <?php $status2 = getCancelled();?>
                    <p class="<?=$status2['class']; ?>" ><?=$status2['status']?></p>
                    </td>
					<?php } else{ ?>
                    <td>
                    
					<?php if( $value->status == '9' ){?>
                    <a href="<?=base_url('Request/request_detail?value=').$value->visit_id?>" class="btn btn-rounded btn-info" >View Request2</a>
                    <a title="Fill VID Registration" href="<?=base_url('Sister_Request/vid_registration?id=').$value->visit_id.'&type='.$value->type_of_collection?>" class="btn btn-rounded btn-primary" ><style="font-size:12px">VID Registration </a>

                      <?php }?>
                      <?php if( $value->status == '9' || $value->status == '10' ){?>
                      <button class="btn btn-rounded btn-warning" onclick="esc('<?= $value->visit_id?>')" data-toggle="modal" data-target="#myModal" >View Phlebo details</button>
                      <?php }?>
                      <?php if( $value->status == '2' || $value->status == '5' || $value->status == '10'){?>
                      <a href="<?=base_url('Request/request_detail?value=').$value->visit_id?>" class="btn btn-rounded btn-info" >View Request</a>
                      <a title="Accept Request" href="<?= base_url('Logistic_sister/logis_form?id=').$value->visit_id.'&email='.$value->client_email.'&contact='.$value->client_contact ; ?>" class="btn btn-rounded btn-success">ReAssign</a>

                      <?php }?>
                      <?php if( $value->status == '14' ){ ?>
                       <form action="<?=base_url('Sister_Request/denies') ?>" method="post">
                      <textarea name="remark_sis" class="form-control"></textarea><br>
                      <input type="hidden" value="<?= $value->visit_id ?>" name="id">
                       <input title="Deny Request" type="submit"  class="btn  btn-primary" value="Deny Request" ></form>
                      <?php }?>

                    <!--a title="Cancel Request" href="<?//=base_url('Sister_Request/cancelled?id=').$value->visit_id?>" class="btn btn-rounded btn-danger" ><style="font-size:12px">Cancel</a-->


                    </td>

					<?php }} }
                    elseif($value->type_of_collection == '2' || $value->type_of_collection == '4'){
					if($value->status == '13'){?>
					<td>
					<a href="<?=base_url('Request/request_detail?value=').$value->visit_id?>" class="btn btn-rounded btn-info" >View Request</a>
					<a title="Accept Request" href="<?= base_url('Logistic_sister/logis_form?id=').$value->visit_id.'&email='.$value->client_email.'&contact='.$value->client_contact ; ?>" class="btn btn-rounded btn-success">&#10004;</a>
					<a title="Deny Request" href="<?=base_url('Sister_Request/denies_start?id=').$value->visit_id?>" class="btn btn-rounded btn-danger" ><i class="fa fa-close" style="font-size:12px"></i></a>
					</td>
					<?php } else{ ?>

                    <?php
                    if( $value->status == '4' ){?><td>
                    <?php $status2 = getCancelled( );?>
                    <p class="<?=$status2['class']; ?>" ><?=$status2['status']?></p>
                    </td><?php } else{
                    ?>
                    <td>
                    <?php if( $value->status == '9' ){?>
                    <a href="<?=base_url('Request/request_detail?value=').$value->visit_id?>" class="btn btn-rounded btn-info" >View Request</a>
                    <a title="Fill VID Registration" href="<?=base_url('Sister_Request/vid_registration?id=').$value->visit_id.'&type='.$value->type_of_collection ?>" class="btn btn-rounded btn-primary" ><style="font-size:12px">VID Registration </a>

                    <?php }?>
                    <?php if( $value->status == '9' || $value->status == '10'  ){?>
                    <button class="btn btn-rounded btn-warning" onclick="esc('<?= $value->visit_id?>')" data-toggle="modal" data-target="#myModal" >View Logistic details</button>
                    <?php }?>
                    <?php if( $value->status == '2' || $value->status == '5' || $value->status == '10' ){?>
                    <a href="<?=base_url('Request/request_detail?value=').$value->visit_id?>" class="btn btn-rounded btn-info" >View Request</a>
					<a title="Accept Request" href="<?= base_url('Logistic_sister/logis_form?id=').$value->visit_id.'&email='.$value->client_email.'&contact='.$value->client_contact ; ?>" class="btn btn-rounded btn-success">ReAssign</a>


                    <?php }?>
                    <?php if( $value->status == '14' ){ ?>
                    <form action="<?=base_url('Sister_Request/denies') ?>" method="post">
                    <textarea name="remark_sis" class="form-control"></textarea><br>
                    <input type="hidden" value="<?= $value->visit_id ?>" name="id">
                    <input title="Deny Request" type="submit"  class="btn  btn-primary" value="Deny Request" ></form>
                    <?php }?>
                    </td>
                    <?php }} } elseif(  $value->type_of_collection == '3' ) {
                    if( $value->status == '13'  ) { ?>
                    <td>
                    <a href="<?=base_url('Request/request_detail?value=').$value->visit_id?>" class="btn btn-rounded btn-info" >View Request</a>
                    <a title="Accept Request" href="<?= base_url('Logistic_sister/accept_walkin?id=').$value->visit_id ; ?>" class="btn btn-rounded btn-success">&#10004;</a>
                    <a title="Deny Request" href="<?=base_url('Sister_Request/denies_start?id=').$value->visit_id?>" class="btn btn-rounded btn-danger" ><i class="fa fa-close" style="font-size:12px"></i></a>
                    </td>
                    <?php } else{ ?>

                  <?php
                  if( $value->status == '4' ){?><td>
                      <?php $status2 = getCancelled( );?>
                      <p class="<?=$status2['class']; ?>" ><?=$status2['status']?></p>
                      </td><?php } else{
                      ?>
                      <td>
                      <?php if( $value->status == '2' ){ ?>
                        <a href="<?=base_url('Request/request_detail?value=').$value->visit_id?>" class="btn btn-rounded btn-info" >View Request</a>
                        <a title="Fill VID Registration" href="<?=base_url('Sister_Request/vid_registration?id=').$value->visit_id.'&type='.$value->type_of_collection ?>" class="btn btn-rounded btn-primary" ><style="font-size:12px">VID Registration </a>
                         <button onclick = "sample('<?= $value->visit_id?>')" title="Sample Collected" class="btn btn-rounded btn-warning ">Pick Up Request</button>
                      <?php } ?>
                       <?php if( $value->status == '12' ){ ?>
                        <a href="<?=base_url('Request/request_detail?value=').$value->visit_id?>" class="btn btn-rounded btn-info" >View Request</a>
                        <a title="Fill VID Registration" href="<?=base_url('Sister_Request/vid_registration?id=').$value->visit_id.'&type='.$value->type_of_collection?>" class="btn btn-rounded btn-primary" ><style="font-size:12px">VID Registration </a>
                      <button class="btn btn-rounded btn-warning" onclick="esc('<?= $value->visit_id?>')" data-toggle="modal" data-target="#myModal" >View Additional details</button>
                      <?php } ?>
                       <?php if( $value->status == '14' ){ ?>
                       <form action="<?=base_url('Sister_Request/denies') ?>" method="post">
                      <textarea name="remark_sis" class="form-control"></textarea><br>
                      <input type="hidden" value="<?= $value->visit_id ?>" name="id">
                       <input title="Deny Request" type="submit"  class="btn  btn-primary" value="Deny Request" ></form>
                      <?php }?>

                    </td>
                    <?php } } } ?>

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
<div class="container">
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
          <h4 class="modal-title">Additional Details</h4>
        </div>
        <div class="modal-body">

          <span id="price">

          </span>
          <span id="file">

          </span>



        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>

</div>
<script type="text/javascript">

  function edit_project( project_value ){
    document.getElementById('projectValue').value = project_value ;
    document.getElementById('projectForm').submit();
  }

  function esc( id ){
    var requestUrl = "<?=base_url( 'Sister_Request/Additional_details?value=') ; ?>"+id;
    console.log( requestUrl );
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          document.getElementById('price').innerHTML= this.responseText
      }
    };
    xhttp.open("POST", requestUrl , true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send();
 }

 function trfs( id ){
   var requestUrl = "<?=base_url( 'Sister_Request/Additional_files?value=') ; ?>"+id;
    console.log( requestUrl );
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          document.getElementById('file').innerHTML= this.responseText
      }
    };
    xhttp.open("POST", requestUrl , true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send();
 }


  function sample( id ){
    document.getElementById('projectValues').value = id;
    document.getElementById('projectForms').submit();
  }
</script>
