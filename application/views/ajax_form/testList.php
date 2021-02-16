<?php
      $unique = rand(1,100);
?>
<style media="screen">
.table th , .table td {
    padding: 14px 5px;
    vertical-align: top;
    border-top: 1px solid #f2f2f2;
}
</style>
<td>
  <select class='form-control'  onchange="test('<?= $unique ?>')" id="test_value-<?=$unique?>" name='test-<?=$uniqueId?>[]'>
     <option value=""> Please select Test</option>
    <?php foreach ($test_mas as $key => $value): ?>
      <option value="<?=$value->test_id?>" ><?=$value->test_name?></option>
    <?php endforeach; ?>
  </select>
</td>
 <td>
    <input type="text" class="form-control" name="test_code-<?=$uniqueId?>[]" id="test_code-<?=$unique?>" value="" readonly>
 </td>
<td>
  <!-- <select class='form-control' name='typeShipment-<?=$uniqueId?>[]'>
    <option value='1' >Embiend</option>
    <option value='2' >Frozen</option>
    <option value='3'>Refrigerator</option>
  </select> -->
  <input type="text" class="form-control" name="typeShipment-<?=$uniqueId?>[]" id="typeShipment-<?=$unique?>" value="dd" readonly>
</td>
<td>
 <input type="text" class="form-control" name="vacutainer_type-<?=$uniqueId?>[]" id="vacutainer_type-<?=$unique?>"  value="" readonly required>
</td>
<td>
    <select onchange="checkPaymentType('<?= $unique ?>' , this )" id="paymentType-<?=$unique?>"  class="form-control" name="payment_status-<?=$uniqueId?>[]">
      <option value="">Select payment type</option>
      <?php foreach ($payment_type as $key => $value): ?>
      <option value="<?=$value->type_id?>"><?=$value->type_name?></option>
      <?php endforeach; ?>
    </select>
</td>
<!--td><p id="<?='para-'.$unique ?>" class="price"></p></td-->
<td><input readonly type="text" id="<?='para-'.$unique ?>"  name="price-<?=$uniqueId?>[]" class="form-control price"></td>
<td>
<button onclick='removetest(this)' class='btn  btn-rounded btn-danger' type='button' name='button'>
  <i class="fa fa-trash"></i>
</button>
</td>
