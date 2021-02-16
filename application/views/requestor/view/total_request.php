<style type="text/css">
  .filess{
    display:none;
  }
</style>
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
        return [ 'class'=>'text-danger' , 'status' =>'Waiting For SisterLab' ];
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
        return [ 'class'=>'text-danger' , 'status' =>'Waiting For SisterLab ' ];
    break;
    default:
    return [];
  }
}



 ?>
<form id="projectForm" action="<?=base_url('Project/edit_project')?>" method="post">
  <input id="projectValue" type="hidden" name="project_value" value="">
</form>

<div class="content-wrapper">
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
            <form action="<?= base_url("Request/export");?>" method="post">
             <!--<button class="btn btn-success" style="float:right;">Export Request</button>-->
             </form>
          <h4 class="card-title">Total Request</h4>
          <div class="table-responsive">

            <table id="table_id" class="table table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Date of Request</th>
                  <th>Request ID</th>
                  <th>Company Name</th>
                  <th>Doctor Name</th>
                  <th>Request Type</th>
                  <th>Status</th>
                   <th>Location</th>
                  <th>Date of Collection</th>
                  <!--<th>Sister Lab Denial Comment</th>-->
                  <th>Manage</th>
                </tr>
              </thead>
              <tbody>
                <?php $counter = 1;  foreach ($tableData as $key => $value):
                      $vis_ids = $value->visit_id;
                ?>
                  <tr>
                    <td><?=$counter++?></td>
                    <td><?=date('M d, Y  ', strtotime($value->schedule_at) )?></td>
                    <td><?=$value->visit_unique_id?></td>
                    <td><?=$value->comp_name?></td>
                     <td><?=$value->refering_doctor_name?></td> 
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
                    <!--<td><?//=$value->sisterLabremarkCanceled?></td>-->
                     <td>

                        <?php if( $value->type == '9'  ){
                             if( $value->Client_status == '0'){
                        ?>
                        <!--<a href="<?//=base_url('Request/cleint_status?id=').$value->visit_id?>" class="btn btn-rounded btn-danger" >Approve</a>-->
                         <a class="btn btn-rounded btn-warning" disabled >Waiting For Client Approval</a>
                         <a href="<?=base_url('Request/request_detail?value=').$value->visit_id?>" class="btn btn-rounded btn-info" >View</a>
                        <?php }else{?>
                        <a class="btn btn-rounded btn-success" >Approved By CLient Manager</a>
                        <a href="<?=base_url('Request/request_detail?value=').$value->visit_id?>" class="btn btn-rounded btn-info" >View</a>
                        <?php } } else {?>
                        <a href="<?=base_url('Request/request_detail?value=').$value->visit_id?>" class="btn btn-rounded btn-info" >View</a>
                        <?php } ?>
                    </td>
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

<button class="btn  btn-default" style="margin-top:30px;margin-bottom:20px" data-toggle="collapse" data-target="#collapseOne-dd" aria-expanded="true" aria-controls="collapseOne-dd" onclick="vidss( '<?=$vis_ids?>' )">View VID Registration Screen</button>
           <!--div id="collapseOne-dd" class="collapse show" aria-labelledby="headingOne-dd" data-parent="#accordionExample"-->
          <span class="filess" id="file">

          </span>


          <span class="filess" id="vidx">

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
var vidx = document.getElementById('vidx');
var files = document.getElementById('file');
 function trfs( id ){

   var requestUrl = "<?=base_url( 'Sister_Request/Additional_files?value=') ; ?>"+id;
    console.log( requestUrl );
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          vidx.classList.add('filess');
           files.classList.remove('filess');
          document.getElementById('file').innerHTML= this.responseText;

      }
    };

    xhttp.open("POST", requestUrl , true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send();

 }

 function vidss( id ){
    var requestUrl = "<?=base_url( 'Sister_Request/Additional_vids?value=') ; ?>"+id;
    console.log( requestUrl );
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          files.classList.add('filess');
           vidx.classList.remove('filess');
          document.getElementById('vidx').innerHTML= this.responseText;

      }
    };
    xhttp.open("POST", requestUrl , true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send();
 }

</script>
