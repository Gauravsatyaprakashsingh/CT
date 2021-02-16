<?php
  if( isset( $clientData) ){
    $editClient = true;
  }
  else{
    $editClient = false;
  }
 ?>

<div class="content-wrapper">
  <div class="row">

    <div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title"><?=( $editClient )?'Edit Client':'New Client'?></h4>
          <?php $actionUrl = ( $editClient )?base_url('Users/update_client'):base_url('Users/save_client') ?>
          <form action="<?=$actionUrl?>" method="post" class="form-sample">
            <?php if( $editClient): ?>
            <input type="hidden" name="userValue" value="<?=$clientData->id?>">
            <?php endif; ?>
            <p class="card-description">
              Client Details
            </p>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Fullname</label>
                  <div class="col-sm-9">
                    <input name="fullname"  value="<?=( $editClient )?$clientData->fullname:''?>"   placeholder="Enter full name" type="text" class="form-control" />
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">T Code</label>
                  <div class="col-sm-9">
                    <input name="t_code" value="<?=( $editClient )?$clientData->t_code:''?>" placeholder="Enter t-code" type="text" class="form-control" />
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Role</label>
                  <div class="col-sm-9">
                    <select class="form-control" name="type">
                      <?php foreach ( $label_type as $key => $value): ?>
                          <option <?php if( $editClient): if( $value->type == $clientData->type ) echo "selected"; endif; ?> value="<?=$value->type?>"><?=$value->label?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>


              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Company</label>
                  <div class="col-sm-9">
                    <select id="selectCompany" onchange="selectUserForParticularCompany()" class="form-control" name="company_id">
                      <option value="">Select Company</option>
                      <?php foreach ( $company_list as $key => $value): ?>
                        <option <?php if( $editClient): if( $value->comp_id == $clientData->company_id ) echo "selected"; endif; ?> value="<?=$value->comp_id?>"><?=$value->comp_name?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>


            <div class="row">

              <?php if( !$editClient ): ?>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Report To</label>
                  <div class="col-sm-9">
                    <select id="selectPerson" class="form-control" name="report_to">
                      <option value="">Select Report Person</option>
                    </select>
                  </div>
                </div>
              </div>
            <?php endif; ?>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Password</label>
                  <div class="col-sm-9">
                    <input name="password" placeholder="Enter password" type="text" class="form-control" />
                  </div>
                </div>
              </div>
            </div>


          <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Email</label>
                  <div class="col-sm-9">
                    <input name="email" value="<?=( $editClient )?$clientData->email:''?>" placeholder="Enter email" type="text" class="form-control" />
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Contact</label>
                  <div class="col-sm-9">
                    <input name="contact" value="<?=( $editClient )?$clientData->contact:''?>" placeholder="Enter contact" type="text" class="form-control" />
                  </div>
                </div>
              </div>
            </div>



            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Select city </label>
                  <div class="col-sm-9">
                    <select class="form-control" name="zsc_id">
                      <?php foreach ($city as $key => $value): ?>
                        <option <?php if( $editClient): if( $value->zsc_id == $clientData->zsc_id ) echo "selected"; endif; ?> value="<?=$value->zsc_id?>"><?=$value->city?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Pincode</label>
                  <div class="col-sm-9">
                    <input name="pincode" value="<?=( $editClient )?$clientData->pincode:''?>" placeholder="Enter pincode" type="text" class="form-control" />
                  </div>
                </div>
              </div>
            </div>


            <div class="row">
              <button type="submit" class="btn btn-info" ><?=( $editClient )?'Update':'Save'?></button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- content-wrapper ends -->

<script type="text/javascript">
  function selectUserForParticularCompany(){
    var selectCompany = document.getElementById('selectCompany');
    // console.log( selectCompany.value );
    var selectPerson  = document.getElementById('selectPerson');
    emptySelect( selectPerson );
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          // alert( this.responseText );
              var userObject = JSON.parse( this.responseText );
              userObject.selectedUser.forEach((value)=>{
                // console.log( value );
                var newOption = document.createElement("OPTION");
                newOption.setAttribute("value", value.id );
                var textValue = document.createTextNode( value.fullname );
                newOption.appendChild( textValue );
                selectPerson.appendChild( newOption );
              })
        }
    };
    xhttp.open("POST", "<?=base_url('Company/searchUserFromCompany')?>", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("company_id="+ selectCompany.value );
  }

  function emptySelect( select ){
    select.innerHTML = '';
  }
</script>
