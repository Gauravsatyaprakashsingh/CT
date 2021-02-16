<?php $unique = rand(1,100); ?>
<style media="screen">
.table th , .table td {
    padding: 14px 5px;
    vertical-align: top;
    border-top: 1px solid #f2f2f2;
}
</style>
  <div class="row">
    <div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Pateint details </h4>
                
            <div class="row">
			<?php //print_r($patients_details);?>
			<div class="col-md-4">
			<div class="form-group row">
			<label class="col-sm-3 col-form-label">Name<strong style="color:red;">*</strong></label>
			<div class="col-sm-9">
			<input name="patient_name" placeholder="Enter patient name" type="text" class="form-control" value="<?php echo $patients_details['patient_name'];?>" />
			
			<input type="hidden" name="patientUniqueId[]" value="<?=$uniqueId?>">
			<!--input type="hidden" name="testUniqueIdss[]" value="<?=$unique?>"-->
			</div>
			</div>
			</div>

			<div class="col-md-4">
			<div class="form-group row">
			<label class="col-sm-3 col-form-label">Age<strong style="color:red;">*</strong></label>
			<div class="col-sm-9">
			<input type="text" name="ages" placeholder="Enter Age" value="<?php echo $patients_details['patient_age'];?>"  class="form-control" />
			</div>
			</div>
			</div>
			
			<div class="col-md-4">
			<div class="form-group row">
			<label class="col-sm-3 col-form-label">Sex</label>
			<div class="col-sm-9" >
			<select class="form-control" name="sex[]">
			<option value="male">Male</option>
			<option value="female">Female</option>
			</select>
			</div>
			</div>
			</div>

			<div class="col-md-4">
			<div class="form-group row">
			<label class="col-sm-3 col-form-label">Contact<strong style="color:red;">*</strong></label>
			<div class="col-sm-9">
			<input name="contact[]" id="contact3" placeholder="Enter contact number of patient" type="text"  value="<?php echo $patients_details['patient_contact'];?>" class="form-control" required/>
			</div>
			</div>
			</div>

            

			<div class="col-md-4">
			<div class="form-group row">
			<label class="col-sm-3 col-form-label">Email<strong style="color:red;">*</strong></label>
			<div class="col-sm-9">
			<input name="email[]" placeholder="Enter email of patient" type="text" value="<?php echo $patients_details['patient_email'];?>" class="form-control" required/>
			</div>
			</div>
			</div>


              
            </div>
            <div class="row">
              <table class="table">
                <thead>
                  <th>Test</th>
                  <th>Test Code</th>
                  <th>Type of Shipment</th>
                  <th>Vacutainer Type</th>
                  <th>Payment Status</th>
                  <th>Price</th>
                  <th> Manage </th>
                </thead>
                <tbody id="tbody-<?=$uniqueId?>">
                  <tr>
                    <td>
                      <select class="form-control" onchange="test('<?= $unique ?>')" id="test_value-<?=$unique?>" name="test-<?=$uniqueId?>[]" required>
                        <option value=""> Please select Test</option>
                        <?php foreach ($test_mas as $keys => $values): ?>
                          <option value="<?=$values->test_id?>" ><?=$values->test_name?></option>
                        <?php endforeach; ?>
                      </select>
                    </td>
                    <td>
                      <input type="text" class="form-control" name="test_code-<?=$uniqueId?>[]" id="test_code-<?=$unique?>" value="" required readonly >
                    </td>
                    <td>
                      <!-- <select class='form-control' name='typeShipment-<?=$uniqueId?>[]'>
                      <option value='1' >Embiend</option>
                      <option value='2' >Frozen</option>
                      <option value='3'>Refrigerator</option>
                    </select> -->
                    <input type="text" class="form-control" name="typeShipment-<?=$uniqueId?>[]" id="typeShipment-<?=$unique?>" value="" readonly required>
                    </td>
                    <td>
                     <input type="text" class="form-control" name="vacutainer_type-<?=$uniqueId?>[]" id="vacutainer_type-<?=$unique?>"  value="" readonly required>
                    </td>
                    <td>
                      <select onchange="checkPaymentType('<?=$unique?>' , this )" id="paymentType-<?=$unique?>"  class="form-control" name="payment_status-<?=$uniqueId?>[]" required>
                        <option value="">Select payment type</option>
                        <?php foreach ($payment_type as $key => $value): ?>
                        <option value="<?=$value->type_id?>"><?=$value->type_name?></option>
                        <?php endforeach; ?>
                      </select>
                    </td>
                    <!--td><p id="<?='para-'.$unique ?>" class="price"></p></td-->
                  <td><input readonly type="text" id="<?='para-'.$unique ?>" name="price-<?=$uniqueId?>[]" class="form-control price"></td>
                    <td>
                      <button onclick="removetest(this)" class="btn btn-rounded btn-danger" type="button" name="button">
                         <i class="fa fa-trash"></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

		<div class="row">
		<button type="button" onclick="addMoreTest('<?=$uniqueId?>')" class="btn  btn-rounded btn-info" > <i class="fa fa-plus"></i> Add more test </button>
		</div>
		<br><br>
		<!--<div class="row">
		<button type="button" onclick="removetest(this)" class="btn btn-block btn-rounded btn-danger" name="button">Remove Patient</button>
		</div>-->

        </div>
      </div>
    </div>
  </div>
