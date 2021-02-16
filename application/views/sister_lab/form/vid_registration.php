 <!--<?php //print_r($vid_registe);exit;?> -->
<div class="content-wrapper">
  <div class="row">
    <div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">VID Registration</h4>
          <form class="form-sample" method="post" enctype='multipart/form-data' action="<?= base_url('Sister_Request/vid_insert')?>">
            <p class="card-description">
              VID Registration
            </p>
            <?php foreach( $vid_registe as $key => $value ): ?>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">VID Registration Id</label>
                  <div class="col-sm-9">
                    <input type="number" class="form-control" value="<?=$value->v_id_number?>" placeholder="Enter VID Registration Number" name="vid_id" > 
                    <input type="hidden" name="idss" value="<?= $value->client_email ;?>">
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Select Payment Mode</label>
                  <div class="col-sm-9">
                    <select name="payment_mode" class="form-control">
                      <?php if(empty( $value->payment_mode)){}else{?>
                      <option value="<?=$value->payment_mode?>" ><?= $value->payment_mode ;?></option><?php } ?>
                      <option value="Cash">Cash</option>
                      <option value="Card">Card</option>
                      <option value="Online">Online</option>
                    </select>
                  </div>
                </div>
              </div>
              </div>
            <div class="row">
             
             <div class="col-md-6">                
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Comment</label>
                  <div class="col-sm-9">
                    <textarea class="form-control" name="Comment" value="" placeholder="Enter Comment"><?= $value->Comment?></textarea>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
               <div class="form-group row">
                  <label class="col-sm-3 col-form-label">History</label>
                 <div class="col-sm-9">
                    <textarea class="form-control" name="History" value="" placeholder="Enter History"><?= $value->History?></textarea>
                  </div>
                </div></div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Remarks</label>
                  <div class="col-sm-9">
                    <input type="hidden" name="visi_id" value="<?= $ids ?>">
					<input type="hidden" name="visi_type" value="<?= $is ?>">
                    <textarea class="form-control" name="remarks" value="" placeholder="Enter Remarks"><?= $value->Remarks?></textarea>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
            <div class="row">
            </div>
               <button style="margin-left: 10px" name="agreement" type="submit" class="btn btn-info" name="button"> Save </button>              
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- content-wrapper ends -->
