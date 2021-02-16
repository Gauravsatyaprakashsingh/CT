<?php
  if( isset( $userData) ){
    $editUser = true;
  }
  else{
    $editUser = false;
  }
 ?>

<div class="content-wrapper">
  <div class="row">
    <div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title"><?=( $editUser )?'Edit User':'New Phlebo'?></h4>
          <?php $actionUrl = ( $editUser )?base_url('Users/update_user'):base_url('Sister_Request/Phelbo_insert') ?>
          <form id="userForm" action="<?=$actionUrl?>" method="post" class="form-sample">
            <?php if( $editUser): ?>
            <input type="hidden" name="userValue" value="<?=$userData->id?>">
            <?php endif; ?>
            <p class="card-description">
              Phlebo Details
            </p>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Fullname</label>
                  <div class="col-sm-9">
                    <input name="phel_name" value="<?=( $editUser )?$userData->fullname:''?>"  placeholder="Enter full name" type="text" class="form-control" required>
                  </div>
                </div>
              </div>
              <!-- <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Select Type of User</label>
                  <div class="col-sm-9">
                    <select class="form-control" name="type">
                      <?php foreach ($label_type as $key => $value): ?>
                        <option <?php if( $editUser): if( $value->type == $userData->type ) echo "selected"; endif; ?> value="<?=$value->type?>"><?=$value->label?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div> -->
            
              <!-- <div class="col-md-6">
                  <label class="col-sm-3 col-form-label">Report To</label>
                <div class="form-group row">
                  <div class="col-sm-9">
                    <select class="form-control" name="report_to">
                      <?php foreach ( $report_to_list as $key => $value): ?>
                        <option <?php if( $editUser): if( $value->id == $userData->report_to ) echo "selected"; endif; ?> value="<?=$value->id?>"><?=$value->fullname?> (<?=$value->label?>)</option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div> -->
              <!-- <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Password</label>
                  <div class="col-sm-9">
                    <input name="password" placeholder="Enter password" type="password" class="form-control" />
                  </div>
                </div>
              </div> -->
            <!-- </div>

            <div class="row"> -->
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Email</label>
                  <div class="col-sm-9">
                    <input name="phel_email" value="<?=( $editUser )?$userData->email:''?>" placeholder="Enter email" type="text" class="form-control" required>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Contact</label>
                  <div class="col-sm-9">
                    <input name="phel_num" value="<?=( $editUser )?$userData->contact:''?>" placeholder="Enter contact" type="number" class="form-control" required>
                  </div>
                </div>
              </div>
           <!--  </div>




            <div class="row"> -->
              <!-- <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Select city </label>
                  <div class="col-sm-9">
                    <select class="form-control" onchange="getSisterLab( this )" name="zsc_id">
                      <?php foreach ($city_list as $key => $value): ?>
                          <option <?php if( $editUser): if( $value->zsc_id == $userData->zsc_id ) echo "selected"; endif; ?> value="<?=$value->zsc_id?>"><?=$value->city?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Pincode</label>
                  <div class="col-sm-9">
                    <input name="pincode" value="<?=( $editUser )?$userData->pincode:''?>" placeholder="Enter pincode" type="text" class="form-control" />
                  </div>
                </div>
              </div>-->
            </div>

         <!--  <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Select Sister Lab </label>
                  <div class="col-sm-9">
                    <select class="form-control" id="sisLab" name="sister_lab_id">
                    </select>
                  </div>
                </div>
              </div> -->

<!-- <?php  if( $editUser): ?>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Change Status</label>
                  <div class="col-sm-9">
                    <select class="form-control" name="status">
                      <option value="0">Inactive</option>
                      <option value="1">Active</option>
                      <option value="2">Suspended</option>
                      <option value="3">Block</option>
                    </select>
                  </div>
                </div>
              </div>
<?php endif; ?> -->
          <!-- </div> -->


            <div class="row">
              <button type="submit" class="btn btn-info" >Save</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- content-wrapper ends -->

<script type="text/javascript">
  function getSisterLab( city ){
    var zsc_id = city.value;
    SisLabAjax( zsc_id );
  }

  function SisLabAjax( zsc_id ){
    var sisLab = document.getElementById('sisLab');
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var result = JSON.parse( this.responseText );
          result.forEach((value)=>{
            console.log( value );
            var opt = document.createElement('option');
            opt.appendChild( document.createTextNode( value.sis_name ) );
            opt.value = value.sister_id;
            sisLab.appendChild(opt);
          });
        }
    };
    xhttp.open("POST", "<?=base_url('Welcome/getSisterLab')?>", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("zsc_id="+zsc_id);
  }



  window.onload = function(){
    var zsc_id = "<?php if( $editUser ) echo $userData->zsc_id; else echo null; ?>";
    if( zsc_id ) SisLabAjax( zsc_id );
  }

</script>

<script src="<?=base_url('js/validation/userForm.js')?>"></script>
