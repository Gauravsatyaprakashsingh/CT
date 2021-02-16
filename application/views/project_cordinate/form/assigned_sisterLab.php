<?php
// print_r($dd);exit;
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
          <h4 class="card-title"><?=( $editClient )?'Edit Client':'New  SisterLab '?></h4>
          <?php $actionUrl = ( $editClient )?base_url('Users/update_client'):base_url('Sister_Request/sister_assign_lab') ?>
          <form action="<?=$actionUrl?>" method="post" class="form-sample">
            
            <input type="hidden" name="ids" id="ids" value="">
            <input type="hidden" name="visits_id" id="idss" value="<?= $id ?>">
           
            <p class="card-description">
              SisterLab Details
            </p>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">SisterLab Name</label>
                  <div class="col-sm-9">
                    <select name="sister_labs" id="Inhouse_type"  class="form-control">
                        <option value="0">Select SisterLab Name</option>
                        <?php
                         foreach( $dd as $value ){ ?>
                            <option value="<?= $value->sis_id?>"><?= $value->sis_name ?></option>
                        <?php } 
                        ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Password</label>
                  <div class="col-sm-9">
                    <input name="password" id="pass" placeholder="Enter password" type="text" class="form-control" readonly />
                  </div>
                </div>
              </div>
            </div>

            <!--<div class="row">
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
                      <?php// foreach ( $company_list as $key => $value): ?>
                        <option <?php// if( $editClient): if( $value->comp_id == $clientData->company_id ) echo "selected"; endif; ?> value="<?//=$value->comp_id?>"><?//=$value->comp_name?></option>
                      <?php// endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
-->

            <!--<div class="row">-->

            <!--  <?php if( !$editClient ): ?>-->
            <!--  <div class="col-md-6">-->
            <!--    <div class="form-group row">-->
            <!--      <label class="col-sm-3 col-form-label">Report To</label>-->
            <!--      <div class="col-sm-9">-->
            <!--        <select id="selectPerson" class="form-control" name="report_to">-->
            <!--          <option value="">Select Report Person</option>-->
            <!--        </select>-->
            <!--      </div>-->
            <!--    </div>-->
            <!--  </div>-->
            <!--<?php endif; ?>-->
            <!--  <div class="col-md-6">-->
            <!--    <div class="form-group row">-->
            <!--      <label class="col-sm-3 col-form-label">Password</label>-->
            <!--      <div class="col-sm-9">-->
            <!--        <input name="password" placeholder="Enter password" type="text" class="form-control" />-->
            <!--      </div>-->
            <!--    </div>-->
            <!--  </div>-->
            <!--</div>-->


          <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Email</label>
                  <div class="col-sm-9">
                    <input name="email" id="emails" value="<?=( $editClient )?$clientData->email:''?>" placeholder="Enter email" type="text" class="form-control" readonly />
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Contact</label>
                  <div class="col-sm-9">
                    <input name="contact" id="contact" value="<?=( $editClient )?$clientData->contact:''?>" placeholder="Enter contact" type="text" class="form-control" readonly />
                  </div>
                </div>
              </div>
            </div>



            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Location Area</label>
                  <div class="col-sm-9">
                 <input name="Location_area" id="area" value="<?=( $editClient )?$clientData->pincode:''?>" placeholder="Enter Location Area" type="text" class="form-control"  readonly />
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Location Address</label>
                  <div class="col-sm-9">
                    <input name="Location_address" id="loc" value="<?=( $editClient )?$clientData->pincode:''?>" placeholder="Enter Location Address" type="text" class="form-control" readonly />
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Pincode</label>
                  <div class="col-sm-9">
                    <input name="pincode"  id="pincode" value="<?=( $editClient )?$clientData->fullname:''?>"   placeholder="Enter pincode" type="text" class="form-control" readonly />
                  </div>
                </div>
              </div>
              <!--<div class="col-md-6">-->
              <!--  <div class="form-group row">-->
              <!--    <label class="col-sm-3 col-form-label">Password</label>-->
              <!--    <div class="col-sm-9">-->
              <!--      <input name="password" placeholder="Enter password" type="text" class="form-control" />-->
              <!--    </div>-->
              <!--  </div>-->
              <!--</div>-->
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
  
   var Inhouse_type = document.getElementById('Inhouse_type');
  Inhouse_type.onchange = function(){
     var Inhouse_types = document.getElementById('Inhouse_type').value;
     var pass = document.getElementById('pass');
     var emails = document.getElementById('emails');
     var contact = document.getElementById('contact');
     var area = document.getElementById('area');
     var loc = document.getElementById('loc');
     var pincode = document.getElementById('pincode');
     var ids = document.getElementById('ids');
     var requestUrl = "<?=base_url('Sister_Request/sis_assigneds?id=');?>"+Inhouse_types ;
     var xhttp = new XMLHttpRequest();
     xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
              var optionUser =  JSON.parse( this.responseText ) ;
              console.log(optionUser);
              optionUser.forEach((value)=>{
              ids.value = value.login_id       
              pass.value = value.sis_password;
              emails.value = value.sis_email;
              contact.value = value.sis_contact;
              area.value = value.sis_area;
              loc.value = value.sis_address; 
              pincode.value = value.sis_pincode;
              });
        }
    };
     xhttp.open("POST", requestUrl , true);
     xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
     xhttp.send();
   }
</script>
