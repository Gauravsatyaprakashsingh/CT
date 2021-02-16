
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



 ?>
<div class="content-wrapper">
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Request</h4>
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Request Details</h4>
                  <div class="row">
                    <div class="col-md-6">
                      <address >
                        <p class="font-weight-bold">Type of Request : <span class="text-muted"><?=getVisitType( $requestData->type_of_collection)['status']?></span> </p>
                        <p class="font-weight-bold">Collection Date : <span class="text-muted"><?=date('M d, Y', strtotime($requestData->date_of_collection) )?></span> </p>
                        <p class="font-weight-bold">Collection Time : <span class="text-muted"><?=date('h:m a', strtotime($requestData->pickup_time) )?></span> </p>
                        <p class="font-weight-bold">Location of Collection : <span class="text-muted"><?=$requestData->location_of_collection?></span> </p>
                      </address>
                    </div>
                    <div class="col-md-6">
                      <address >
                       <p class="font-weight-bold">Pincode : <span class="text-muted"><?=$requestData->pincode ?></span> </p>
                       <p class="font-weight-bold">Phelbotomist Name : <span class="text-muted"><?=($requestData->fullname)?$requestData->fullname:'Not Assigned Yet' ?></span> </p>
                       <p class="font-weight-bold">Phelbotomist Contact : <span class="text-muted"><?=($requestData->contact)?$requestData->contact:'Not Assigned Yet' ?></span> </p>
                      </address>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Total Patient</h4>
                  <div class="table-responsive">
                    <table id="table_id" class="table table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Pateint Name</th>
                          <th>Pateint Contact</th>
                          <th>Pateint Email</th>
                          <th>Total Test</th>
                          <th>Manage</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $counter = 1;  foreach ($totalPatient as $key => $value):  ?>
                          <tr>
                            <td><?=$counter++?></td>
                            <td><?=$value->patient_name?></td>
                            <td><?=$value->patient_contact?></td>
                            <td><?=$value->patient_email?></td>
                            <td><?=$value->total_Sample?></td>
                            <td>
                              <a data-toggle="modal" href="#myModal" onclick="showTotalTest('<?=$value->patient_id?>' , '<?=$requestData->visit_id?>' )"   title="View Request" class="btn btn-icons btn-rounded btn-warning" >
                                <i class="fa fa-eye"></i>
                              </a>
                              <a href="" title="Remove Sample Request" class="btn btn-icons btn-rounded btn-danger" >
                                <i class="fa fa-trash"></i>
                              </a>
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
      </div>
    </div>
  </div>


</div>


<!-- Modal -->
 <div class="modal fade" id="myModal" role="dialog">
   <div class="modal-dialog">
     <!-- Modal content-->
     <div class="modal-content">
       <div class="modal-header">
         <h4 class="modal-title">Sample Request</h4>
         <button type="button" class="close" data-dismiss="modal">&times;</button>
       </div>
       <div class="modal-body">
         <table class="table">
           <thead>
             <th>#</th>
             <th>Test</th>
             <th>Status</th>
           </thead>
           <tbody id="modal-tbody">
           </tbody>
         </table>
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       </div>
     </div>
   </div>
 </div>




</div>


<script type="text/javascript">

 function showTotalTest( patient_id  , visit_id ){
   var xhttp = new XMLHttpRequest();
   xhttp.onreadystatechange = function() {
     if (this.readyState == 4 && this.status == 200) {
       var tbodyId = "modal-tbody";
       document.getElementById( tbodyId ).innerHTML= this.responseText;
     }
   };
   xhttp.open("POST", "<?=base_url('Sample/total_test')?>", true);
   xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
   xhttp.send("patient_id="+patient_id+"&visit_id="+visit_id );
 }

</script>
