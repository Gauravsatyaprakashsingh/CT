<?php
// print_r($visitData);
// exit;
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

function getTypeOfShipment( $type ){
  if( $type == 1 )
    return 'Embiend';
  elseif ( $type == 2 )
    return 'Frozen';
  elseif ( $type == 3 )
    return 'Refrigerator';
}

 ?>


<div class="content-wrapper">
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Task</h4>
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Task Details</h4>
                  <div class="row">
                    <div class="col-md-6">
                      <address >
                        <p class="font-weight-bold"> Type of Collection : <span class="text-muted"><?=getVisitType( $visitData->type_of_collection )['status']?></span> </p>
                        <p class="font-weight-bold">Pick up Date Time : <span class="text-muted"><?=date('M d, Y', strtotime($visitData->date_of_collection) )?>
                          <?=date('h:m a', strtotime($visitData->pickup_time) )?></span> </p>
                        <p class="font-weight-bold">Location: <span class="text-muted"><?=$visitData->location_of_collection?></span> </p>
                      </address>
                    </div>
                    <div class="col-md-6">
                      <address >
                       <p class="font-weight-bold">Type of Payment : <span class="text-muted"><?=getPaymentType( $visitData->payment_status )['status']?></span> </p>
                       <!-- <p class="font-weight-bold">Status : <span class="text-muted">9167291114</span> </p> -->
                       <!-- <p class="font-weight-bold">Payment Type : <span class="text-muted">FOC</span> </p> -->
                      </address>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">

        <div class="accordion col-md-12" id="accordionExample">

        <?php $counter = 0; foreach ($viewData as $key => $value): ?>

        <div class="card">
          <div class="card-header" id="headingOne-<?=$counter?>">
            <h5 class="mb-0">
              <button class="btn btn-rounded btn-info" type="button" data-toggle="collapse" data-target="#collapseOne-<?=$counter?>" aria-expanded="true" aria-controls="collapseOne-<?=$counter?>">
                <?=$key?>
              </button>
              <a href="<?=base_url('Task/trf_form?Pid=').$value[0]->patient_id.'&Vid=' ?>" class="btn btn-warning btn-rounded" style="float:right">TRF form</a>
            </h5>
          </div>

          <div id="collapseOne-<?=$counter?>" class="collapse show" aria-labelledby="headingOne-<?=$counter?>" data-parent="#accordionExample">
            <div class="card-body">
                <p class="text"> Name:<?=$value[0]->patient_name?></p>
                <p class="text"> Age:<?=$value[0]->patient_age?></p>
                <p class="text"> Sex:<?=$value[0]->patient_gender?></p>
                <p class="text"> Contact:<?=$value[0]->patient_contact?></p>
                <p class="text"> Email:<?=$value[0]->patient_email?></p>
              <div class="row">
                <table class="table">
                  <thead>
                    <th>#</th>
                    <th>Test</th>
                    <th>Type of Shipment</th>
                    <th>Manage</th>
                  </thead>
                  <tbody>
                    <?php $testCounter = 1; foreach ($value as $testKey => $testValue): ?>
                      <tr>
                        <td><?=$testCounter?></td>
                        <td><?=$testValue->test_name?></td>
                        <td><?=getTypeOfShipment( (int)$testValue->type_of_shipment )?></td>
                        <td>
                          <?php if($testValue->status == '1' ): ?>
                            <a onclick="sampleCollected(<?=$testValue->sample_id?> , this )"  title="Accept Request" class="btn btn-icons btn-rounded btn-success"> <i class="fa fa-check"></i></a>
                          <?php elseif( $testValue->status == '2' ): ?>
                            <a href="javascript:void(0)" class="btn btn-rounded">Collected</a>
                          <?php endif; ?>
                        </td>
                      </tr>
                      <?php $testCounter++; endforeach; ?>
                    </tbody>
                  </table>
              </div>
            </div>
          </div>
        </div>

      <?php $counter++; endforeach; ?>


        </div>
      </div>

      <!-- <p class="note text-danger">Note:-please click save button when you collected all sample </p> -->
      <form class="" action="<?=base_url('Task/changeStatus')?>" method="post">
      <div class="row">
          <input type="hidden" name="visit" value="<?=$visitData->visit_id?>">
          <input type="hidden" name="status" value="8">
          <button type="submit" class="btn btn-block" >Received</button>
      </div>
    </form>
    </div>
  </div>




</div>

<script type="text/javascript">

 function sampleCollected( sample_id , anchor ){
   var xhttp = new XMLHttpRequest();
   xhttp.onreadystatechange = function() {
     if (this.readyState == 4 && this.status == 200) {
       anchor.className = 'btn btn-rounded';
       anchor.innerHTML = 'Collected';
     }
   };
   xhttp.open("POST", "<?=base_url('Sample/collected')?>", true);
   xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
   xhttp.send("sample_id="+sample_id);

 }

</script>
