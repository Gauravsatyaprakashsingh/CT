<style>
  .tab_info{
    margin-top: -15px;
  }
</style>
<!-- <?php
// function getTypeOfShipment( $type ){
//   if( $type == 'Embiend' )
//     return 'Embiend';
//   elseif ( $type == 'Frozen' )
//     return 'Frozen';
//   elseif ( $type == 'Refrigerator' )
//     return 'Refrigerator';
// }

 // echo "<pre>" ;print_r($test_price);exit;
?> -->

<div class="content-wrapper">
  <div class="row">
    <div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body" >
          <h4 class="card-title">Request ID :- <?=$visit_unique_id?></h4>
          <form  id="userForm" action="<?=base_url('Samples/request_sample')?>" method="post" class="form-sample">
            <!-- <p class="card-description">
              User Details
            </p> -->
            <body onload="total_mark()">
                  <div class="row">

        <div class="accordion col-md-12" id="accordionExample">

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
                <p class="text"> Name:     <?= $value[0]->patient_name?></p>
                <p class="text"> Age:    <?=$value[0]->patient_age?></p>
                <p class="text"> Sex:    <?=$value[0]->patient_gender?></p>
                <p class="text"> Contact:    <?=$value[0]->patient_contact?></p>
                <p class="text"> Email:    <?=$value[0]->patient_email?></p>
              <div class="row">
              <table class="table table-striped">
                <thead>
                    <th>#</th>
                    <th>Test Name</th>
                    <th>Type of Shipment</th>
                    <th>Payment Type</th>
                    <th>Test Price</th>
                  </thead>
                  <tbody >
                    <?php $testCounter = 1; $total = 0 ;foreach ($value as $testKey => $testValue): ?>
                      <tr>
                        <td><?=$testCounter?></td>
                        <td><?=$testValue->test_name?></td>
                        <!-- <td><?//=getTypeOfShipment( (int)$testValue->type_of_shipment )?></td> -->
                        <td><?=$testValue->type_of_shipment?></td>
                        <td><?=$testValue->type_name?></td>
                        <td><?=$testValue->price?></td>

                      </tr>
                  <?php $testCounter++;
                  $total= $total + $testValue->price;
                  $project_id = $testValue->patient_id;
                 // print_r( $project_id)
                  endforeach;
                  ?>
                  <tr style="font-weight:bold"><td>Total<td><td></td><td></td><td> <?= $total  ?></td></tr>
                    <input type="Hidden" value="<?= $total?>" id="ids">
                    <input type="Hidden"  value="<?= $project_id ?>" id="prod_id">
                  </tbody>
              </table>
              </div>
            </div>
          </div>
        </div>

      <?php $counter++; endforeach; ?>


        </div>
      </div>
          <button style ="margin-top:30px;" type="submit"  class="btn btn-info">Finish</button></tfoot>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- content-wrapper ends -->
<script>

    history.pushState(null, null, document.URL);
window.addEventListener('popstate', function () {
history.pushState(null, null, document.URL);
});
</script>

<script src="<?=base_url('js/validation/userForm.js')?>"></script>
<script>
  function total_mark(){
  var a = document.getElementById('ids').value;
  var project_id = document.getElementById('prod_id').value;
  var employeeName = document.getElementById('empName');
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
              employeeName.innerHTML = this.responseText ;
        }
    };
    xhttp.open("POST", "<?=base_url('Samples/total_price?query=')?>"+a+"&project_id="+project_id, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send();
}
</script>
