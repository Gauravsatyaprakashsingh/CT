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

 <style media="screen">
    .hidden{
      display:none
    }
 </style>

<div class="content-wrapper">
  <div class="row">
    <div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Schedule Visit</h4>
            <p class="card-description">
              Request details
            </p>

            <div class="row">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <address >
                          <p class="font-weight-bold">Type of Request : <span class="text-muted"><?=getVisitType( $requestData->type_of_collection)['status']?></span> </p>
                          <p class="font-weight-bold">Collection Date : <span class="text-muted"><?=date('M d, Y', strtotime($requestData->date_of_collection) )?></span> </p>
                          <p class="font-weight-bold">Location of Collection : <span class="text-muted"><?=$requestData->location_of_collection?></span> </p>
                        </address>
                      </div>
                      <div class="col-md-6">
                        <address >
                         <p class="font-weight-bold">Pincode : <span class="text-muted"><?=$requestData->pincode ?></span> </p>
                        </address>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-6" style="float:right">
                <input  type="text" id="phelboDetails" class="form-control" placeholder="Search Phelbotomist by name,contact" name="" value="">
              </div>
              <div class="col-lg-6" style="float:right">
                <button onclick="searchPhelbo()" type="button" class="btn btn-rounded" name="button">Search</button>
              </div>
            </div>

            <div id="tableDivRow" class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Total Phelbotomist</h4>
                    <div class="table-responsive">
                      <table id="table_id" class="table table-bordered">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Phelbotomist Name</th>
                            <th>Pincode</th>
                            <th>Type</th>
                            <th>Manage</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $counter = 1; foreach ($phelbo_list as $key => $value): ?>
                            <tr>
                              <td><?=$counter++?></td>
                              <td><?=$value->fullname?></td>
                              <td><?=$value->pincode?></td>
                              <td>Inhouse</td>
                              <td>
                                <button type="button" onclick="selectPhelbo(<?=$value->id?>)" class="btn btn-warning" name="button">Select</button>
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

            <br><br>

          <form action="<?=base_url('Request/fix_schedule')?>" method="post" class="form-sample">
            <div id="displayOnSelect" class="row hidden">

            </div>
           <input type="hidden" id="phebo_id" name="phelbo_id" value="">
           <input type="hidden" name="requestId" value="<?=$requestData->visit_id?>">
           <input type="hidden" name="date" value="<?=$requestData->date_of_collection?>">
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- content-wrapper ends -->
<script type="text/javascript">
  function selectPhelbo( phelbo_id ){
    $('#tableDivRow').fadeOut();
    var displayOnSelect = document.getElementById('displayOnSelect');
    var date = "<?=$requestData->date_of_collection?>"
    $('#phebo_id').val( phelbo_id );
    $(displayOnSelect).removeClass('hidden');
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        displayOnSelect.innerHTML = this.responseText
      }
    };
    xhttp.open("POST", "<?=base_url('Request/getSlot')?>", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("phelbo_id="+ phelbo_id +"&date="+date );
  }

  function searchPhelbo(){
   $('#tableDivRow').fadeIn();
   var phelboQuery = $('#phelboDetails').val();
   if( phelboQuery ){
     alert( phelboQuery );
   }
   $('#displayOnSelect').addClass('hidden');
  }

</script>
