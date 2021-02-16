<div class="col-md-6">
  <div class="form-group row">
    <label class="col-sm-6 col-form-label">Select Slot</label>
    <div class="col-sm-6">
        <select class="form-control" name="slot_id">
          <?php foreach ($slot_list as $key => $value): ?>
            <option value="<?=$value->slot_id?>"><?=$value->time?></option>
          <?php endforeach; ?>
        </select>
    </div>
  </div>
</div>
<div class="col-md-6">
  <button type="submit" class="btn btn-rounded btn-info">Schedule</button>
</div>
