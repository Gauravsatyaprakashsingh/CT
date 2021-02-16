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

// function getTypeOfShipment( $type ){
//   if( $type == 1 )
//     return 'Embiend';
//   elseif ( $type == 2 )
//     return 'Frozen';
//   elseif ( $type == 3 )
//     return 'Refrigerator';
// }
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
                      <address>

						<p class="font-weight-bold"> Type of Collection : <span class="text-muted"> <?=getVisitType( $visitData->type_of_collection )['status']?></span> </p>
						<p class="font-weight-bold">Pick up Date Time : <span class="text-muted"><?=date('M d, Y', strtotime($visitData->date_of_collection) )?>
						<?=date('h:m a', strtotime($visitData->pickup_time) )?></span> </p>
						<?php if( $visitData->type_of_collection == '1' || $visitData->type_of_collection == '2' ||  $visitData->type_of_collection == '3'){?>
						<p class="font-weight-bold">Location: <span class="text-muted"> <?=$visitData->city.','.$visitData->State?></span> </p><?php } else {} ?>
						<?php if( $visitData->type_of_collection == '1' || $visitData->type_of_collection == '2'){?>
						<p class="font-weight-bold"> Address : <span class="text-muted"> <?= $visitData->Address?></span></p>
						<p class="font-weight-bold"> Assigned By : <span class="text-muted"> <?= $visitData->name?></span></p>
						
              <?php } ?>
                        <?php foreach($total_price as $row){ ?>
                         <!--p class="font-weight-bold"> Total Price : <span class="text-muted"> <?= $visitData->total_amount ?>/-</span> </p--><?php }?>

                      </address>
                    </div>
                    <!--div class="col-md-6">
                      <address >
                       <p class="font-weight-bold">Type of Payment : <span class="text-muted"><?=getPaymentType( $visitData->payment_status )['status']?></span> </p>
                       <!-- <p class="font-weight-bold">Status : <span class="text-muted">9167291114</span> </p> -->
                       <!-- <p class="font-weight-bold">Payment Type : <span class="text-muted">FOC</span> </p> -->
                      <!--/address>
                    </div-->
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">

        <div class="accordion col-md-12" id="accordionExample">
        <?php if( $visitData->type_of_collection == '3'){?>

          <div class="card">
          <div class="card-header" id="headingOne-1000000S">
            <h5 class="mb-0">
              <button class="btn btn-rounded btn-info" type="button" data-toggle="collapse" data-target="#collapseOne-1000000S" aria-expanded="true" aria-controls="collapseOne-1000000S">
                Lab Details
              </button>
            </h5>
          </div>

          <div id="collapseOne-1000000S" class="collapse show" aria-labelledby="headingOne-1000000S" data-parent="#accordionExample">
            <div class="card-body">
                <p class="text"> Lab State: &nbsp;<?=$visitData->State?> </p>
                <p class="text"> Lab City:&nbsp;  <?=$visitData->city?> </p>
                <p class="text"> Lab Name: &nbsp; <?=$visitData->Lab_Name?> </p>
                <p class="text"> Lab Code:  &nbsp;<?=$visitData->Lab_Code?>  </p>
                <p class="text"> Lab Address: &nbsp;<?=$visitData->Address?>  </p>
                <p class="text"> Lab Pincode:&nbsp; <?=$visitData->pincode?>  </p>


            </div>
          </div>
        </div>





         <?php } ?>

         <?php if( $visitData->type_of_collection == '4'){?>

          <div class="card">
          <div class="card-header" id="headingOne-1000000R">
            <h5 class="mb-0">
              <button class="btn btn-rounded btn-info" type="button" data-toggle="collapse" data-target="#collapseOne-1000000R" aria-expanded="true" aria-controls="collapseOne-1000000R">
                Camp Details
              </button>
            </h5>
          </div>

          <div id="collapseOne-1000000R" class="collapse show" aria-labelledby="headingOne-1000000R" data-parent="#accordionExample">
            <div class="card-body">
                <p class="text"> Hospital Name: &nbsp;<?= (empty($visitData->Hospital_Name) )? "Not Available" : $visitData->Hospital_Name?></p>
                <p class="text"> Hospital Address:&nbsp; <?= (empty($visitData->HospitalAddress) )? "Not Available" : $visitData->HospitalAddress?>  </p>
                <p class="text"> Client Contact: &nbsp; <?= (empty($visitData->ClientContact) )? "Not Available" : $visitData->ClientContact?> </p>
                <p class="text"> Client Name:  &nbsp;<?= (empty($visitData->ClientName) )? "Not Available" : $visitData->ClientName?>  </p>
                <p class="text"> Client Email Address:&nbsp;<?= (empty($visitData->ClientEmailAddress) )? "Not Available" : $visitData->ClientEmailAddress?>   </p>
                <p class="text"> Other Client Contact:&nbsp; <?= (empty($visitData->ClientContactother) )? "Not Available" : $visitData->ClientContactother?> </p>
                <p class="text"> Other Client Name: &nbsp; <?= (empty($visitData->ClientNameother) )? "Not Available" : $visitData->ClientNameother?>  </p>
                <p class="text"> Other Client Email Address:&nbsp;<?= (empty($visitData->ClientEmailAddressOther) )? "Not Available" : $visitData->ClientEmailAddressOther?> </p>
                <p class="text"> Number of Expected patients:&nbsp;<?= (empty($visitData->number_patient_expected) )? "Not Available" : $visitData->number_patient_expected?> </p>
                <p class="text"> Date and Time of Collection From: &nbsp;<?=$visitData->camp_from_date?> </p>
                <p class="text"> Date and Time of Collection To: &nbsp;<?=$visitData->camp_to_date?> </p>

            </div>
          </div>
        </div>





         <?php } ?>
        <?php $counter = 0; foreach ($viewData as $key => $value): ?>
        <div class="card">
          <div class="card-header" id="headingOne-<?=$counter?>">
            <h5 class="mb-0">
              <button class="btn btn-rounded btn-info" type="button" data-toggle="collapse" data-target="#collapseOne-<?=$counter?>" aria-expanded="true" aria-controls="collapseOne-<?=$counter?>">
                <?=$key?>
              </button>
            </h5>
          </div>

          <div id="collapseOne-<?=$counter?>" class="collapse show" aria-labelledby="headingOne-<?=$counter?>" data-parent="#accordionExample">
            <div class="card-body">
                <p class="text"> Name: &nbsp;    <?= $value[0]->patient_name?></p>
                <p class="text"> Age:  &nbsp;  <?=$value[0]->patient_age?></p>
                <p class="text"> Sex:  &nbsp;  <?=$value[0]->patient_gender?></p>
                <p class="text"> Contact: &nbsp;   <?=$value[0]->patient_contact?></p>
                <p class="text"> Email:&nbsp;    <?=$value[0]->patient_email?></p>

              <div class="row">
                <table class="table">
                  <thead>
                    <th>#</th>
                    <th>Test</th>
                    <th>Type of Shipment</th>
                    <th>Vacutainer Type</th>
                    <th>Payment Type</th>
                    <th>Price</th>
                  </thead>
                  <tbody>
                    <?php $testCounter = 1; foreach ($value as $testKey => $testValue): ?>
                      <tr>
                        <td><?=$testCounter?></td>
                        <td><?=$testValue->test_name?></td>
                        <!-- <td><?//=getTypeOfShipment( (int)$testValue->type_of_shipment )?></td> -->
                        <td><?=$testValue->type_of_shipment?></td>
                        <td><?=$testValue->vacutainer_type?></td>
                        <td><?=$testValue->type_name?></td>
                        <td><?=$testValue->price?></td>

                      </tr>
                  <?php $testCounter++; endforeach; ?>
                  <tr style="font-weight:bold"><td>Total<td><td></td><td></td><td> <?= $visitData->total_amount ?></td></tr>

                    </tbody>
                  </table>
              </div>
            </div>
          </div>
        </div>

      <?php $counter++; endforeach; ?>


        </div>
      </div>

      <div class="row">
          <a href="<?=base_url('Request/total_request')?>" class="btn btn-block" >Back</a>
      </div>

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
