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
          <h4 class="card-title">Project</h4>
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Project Details</h4>
                  <div class="row">
                    <div class="col-md-6">
                      <address >
                        <p class="font-weight-bold">Project Name : <span class="text-muted"><?=$project->project_name?></span> </p>
                        <p class="font-weight-bold">Start Date : <span class="text-muted"><?=date('M d, Y', strtotime($project->project_start_date) )?></span> </p>
                        <p class="font-weight-bold">End Date : <span class="text-muted"><?=date('M d, Y', strtotime($project->project_end_date) )?></span> </p>
                      </address>
                    </div>
                    <div class="col-md-6">
                      <address >
                       <p class="font-weight-bold">Client Email : <span class="text-muted"><?=$project->email ?></span> </p>
                       <p class="font-weight-bold">Client Contact : <span class="text-muted"><?=$project->contact ?></span> </p>
                       <!-- <p class="font-weight-bold">Payment Type : <span class="text-muted">FOC</span> </p> -->
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
                  <h4 class="card-title">Total Request</h4>
                  <div class="table-responsive">
                    <table id="table_id" class="table table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Type of Request</th>
                          <th>Type of Payment</th>
                          <th>Date of Request</th>
                          <th>Location</th>
                          <th>Pincode</th>
                          <th>Manage</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $counter = 1;  foreach ($visitData as $key => $value):  ?>
                          <tr>
                            <td><?=$counter++?></td>
                            <td>
                              <?php  $status = getVisitType( $value->type_of_collection ) ; ?>
                              <p class="<?=$status['class']?>"><?=$status['status']?></p>
                            </td>
                            <td><?=getPaymentType( $value->payment_status )['status']?></td>
                            <td><?=date('M d, Y', strtotime($value->date_of_collection) )?></td>
                            <td><?=$value->location_of_collection?></td>
                            <td><?=$value->pincode?></td>
                            <td>
                              <a href="<?=base_url('Request/view_request?requestId=').$value->visit_id?>"  title="View Request" class="btn btn-icons btn-rounded btn-warning" >
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
          <div class="row">
            <a href="<?=base_url('Sample/new_request_sample?value=').$project->project_id?>" class="btn btn-outline-warning btn-rounded  float-left" name="button">
              <i class="fa fa-plus"></i> More Sample
            </a>
            <a href="<?=base_url('Sample/bulk_upload')?>" class="btn btn-outline-info btn-rounded float-right" name="button">
              <i class="fa fa-plus"></i> Bulk upload
            </a>

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
             <th>Date</th>
             <th>Status</th>
           </thead>
           <tbody>
             <tr>
               <td>1</td>
               <td>Blood Test</td>
             </tr>
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
