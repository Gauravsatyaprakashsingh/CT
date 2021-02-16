<style type="text/css">
  .bt{
    display: none;
  }
</style>
<?php
// print_r($cc);exit;
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
    return [ 'class'=>'text-danger' , 'status' =>'Request Already Cancelled' ];
}
 ?>


<form id="projectForm" action="<?=base_url('Logistic_sister/sample_collected')?>" method="post">
  <input id="projectValue" type="hidden" name="project_value" value="">
  <input id="pro_id" type="hidden" name="pros_id" value="">
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
                  <th>Patient Name</th>
                  <th>Patient Email</th>
                  <!-- <th>Payment Type</th> -->
                  <th>Patient Contact</th>
                  <th>Patient Age</th>
                  <th>Patient Gender</th>
                  <?php if( $cc != '1') { ?>
                  <th>Request</th>
                  <?php } ?>
                </tr>
              </thead>
              <tbody>
                <?php $counter = 1;  foreach ($patient_view as $key => $value):  
                   $ids = $value->visit_id;
                ?>
                  <tr>
                    <td><?=$counter++?></td>
                    <td><?=$value->patient_name ?></td>
                    <td><?=$value->patient_email?></td>
                    <td><?=$value->patient_contact?></td>
                    <td><?=$value->patient_age?></td>
                    <td><?=$value->patient_gender?></td>
                  <?php if( $value->p_status == '1'  ){?> 
                  
                    <td>
                    <button onclick = "sample('<?= $value->patient_id?>','<?= $value->visit_id?>')" title="Sample Collected" class="btn btn-rounded btn-warning ">Sample Collected</button>
                    <a href="<?=base_url('Request/patient_detail?value=').$value->visit_id.'&&pat='.$value->patient_id?>" class="btn btn-rounded btn-info" >View</a>
                    </td>
                  <?php } else { 
                  if( $cc == '0' ) { ?>
                  <td>
                    <button title="Sample Collected" class="btn btn-rounded btn-success ">Sample Collected</button>
                    </td></tr>
                
                <?php } } endforeach; ?>
                   <?php if( $cc == '1') { ?>
                   
                    <a   style="width:150px;
            height:28px;
           <!--background-color: #00ce68;-->
           <!--border-color: #00ce68;-->
            color:#FFF;
            padding:5px 3px;
            text-align:center;
            top:0;
            position:absolute;
            right:0;
            margin-right:20px;
            margin-top:20px" href="<?=base_url('Sister_Request/phelbo_Delivered?id=').$ids?>" title="Sample Delivered" class="btn  btn-info ">Sample Delivered</a>
                
          <?php  }?>
                  
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

  function sample( id , ids ){
    document.getElementById('pro_id').value = ids; 
    document.getElementById('projectValue').value = id;
    document.getElementById('projectForm').submit();
  }

  // function reason(){
  //   alert('s');
  // }
</script>
