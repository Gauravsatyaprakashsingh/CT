 <!--<?php //print_r($clients_mail) ;exit;?>  -->
<style type="text/css">
  .hidden{
    display: none;
  }
</style>
<div class="content-wrapper">
  <div class="row">
    <div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Pickup Type</h4>
          <form id="form_ids"  method="post" action="<?= base_url('Logistic_sister/update_visit_seducle');?>">
              <input type="hidden" readonly value="<?= $id ?>" name="id_visit" id="id_visit" >
              <input type="hidden" readonly value="" name="emp_ids" id="emp_ids" >
              <input type="hidden" readonly value="" name="logis_namesss" id="logis_namesss" >
              <input type="hidden" readonly value="" name="logis_contactss" id="logis_contactss" >
              <input type="hidden" readonly value="" name="logis_email" id="logis_email" >
              <input type="hidden" readonly value="" name="logis_email2" id="cklient" >
			  <input type="hidden" readonly value="" name="logis_contact" id="ccon" >
          </form>
          <form id="form_picks" class="form-sample" method="post" action="<?= base_url('Logistic_sister/assign_pickup_request');?>">
            <!-- <form id="form_picks" class="form-sample" method="post" action="<?= base_url('Logistic_sister/insert_pick');?>"> -->


            <p class="card-description">
              Pickup Type
            </p>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Select Pickup Type</label>
                  <div class="col-sm-9">
                    <select onchange="pickup()" name="pickup_type" id="type" class="form-control">
                      <option value="">Select Pickup </option>
                      <option value="16">InHouse Logistic </option>
                      <option value="19">Franchinse</option>
                      <!-- <option value="17">OutSource</option> -->
                      <!--<option value="18">Pickup guy</option>-->
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <!------------------Start Box---------------->
            <div class="row hidden" id="hidd">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Select InHouse Logistic  </label>
                  <div class="col-sm-9">
                    <select  id="Inhouse_type"  class="form-control">
                      <option value="">Select Logistic</option>
                      <?php foreach($sis_emp as $key=>$value):?>
                      <option value="<?= $value->id ;?>"><?= $value->fullname?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="hidden" id="hiddev"><br>
            <p class="card-description">
                     Logistic  details
                 </p>
             <div class="row">

			<div class="col-md-6">
			<div class="form-group row">
			<label class="col-sm-3 col-form-label">Logistic  Name</label>
			<div class="col-sm-9">
			<input name="phelbo_name" readonly="" id="phelbo_names" placeholder="Enter Logistic Name" type="text" class="form-control" required>
			</div>
			</div>
			</div>
			
			<div class="col-md-6">
			<div class="form-group row">
			<label class="col-sm-3 col-form-label">Logistic  Contact Number</label>
			<div class="col-sm-9">
			<input name="phelbo_contact" readonly id="phelbo_contact" placeholder="Enter Logistic Contact Number" type="number" class="form-control" required>
			</div>
			</div>
			</div>
			  
			  </div>
            
			<div class="row">
			
			<div class="col-md-6">
			<div class="form-group row">
			<label class="col-sm-3 col-form-label">Logistic  Email ID</label>
			<div class="col-sm-9">
			<input name="phelbo_email" readonly="" id="phelbo_email" placeholder="Enter Logistic Email ID" type="email" class="form-control" required>
			</div>
			</div>
			</div>
			  
			<div class="col-md-6">
			<div class="form-group row">
			<label class="col-sm-3 col-form-label">Multiple Emails</label>
			<div class="col-sm-9">
			<input type="text" name="mail_ids" id="mail_ids" placeholder="Enter Emails address" class="form-control" />
			</div>
			</div>
			</div>
			  
			  
            </div>
			
			
			
            <div class="row">
               <button style="margin-left: 10px" onclick="vix()" type="button" class="btn btn-info" name="button"> Save </button>
            </div>
          </div>
            <!------------------End Box---------------->
            <div class="hidden" id="hiddes">
              <input type="hidden" name="log_id" value="<?=$this->session->userdata('log_user')['user_id']?>">
            <!-- <div class="row" >
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Select InHouse Logistic  </label>
                  <div class="col-sm-9">
                    <select  name="log_id"  class="form-control">
                      <?php foreach($sis_emp as $key=>$value):?>
                      <option value="<?= $value->id ;?>"><?= $value->fullname?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
            </div> -->
            <p class="card-description">
                    Fill Logistic  details
                 </p>
             <!-- <form id="form_picks" class="form-sample" method="post" action="ss"> -->
             <div class="row">
                            <input type="hidden" readonly value="<?= $id ?>" name="id_visits" id="id_visits" >
                            <input type="hidden" readonly value="<?= $clients_mail ?>" name="clients_mailsssss" id="ddd" >
							<input type="hidden" readonly value="<?= $contact ?>" name="client_cons" id="client_cons" >
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Logistic  Name</label>
                  <div class="col-sm-9">
                    <input name="phel_name" placeholder="Enter Phlebotomist Name" type="text" class="form-control" required>
                  </div>
              </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Logistic  Contact Number</label>
                  <div class="col-sm-9">
                    <input name="phel_num" placeholder="Enter Phlebotomist Contact Number" type="number" class="form-control" required>
                  </div>
              </div>
              </div></div>
              <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Logistic  Email ID</label>
                  <div class="col-sm-9">
                    <input name="phel_email" placeholder="Enter Phlebotomist Email ID" type="email" class="form-control" required>
                  </div>
              </div>
              </div>
			  
			<div class="col-md-6">
			<div class="form-group row">
			<label class="col-sm-3 col-form-label">Multiple Emails</label>
			<div class="col-sm-9">
			<input type="text" name="mail_ids" id="mail_ids" placeholder="Enter Emails address" class="form-control" />
			</div>
			</div>
			</div>
			  
            </div>
            <div class="row">
               <button style="margin-left: 10px" type="button" onclick="formaa_pick()" class="btn btn-info" name="button"> Save </button>
            </div></form>
          </div>
            <!---------------------2nd Box------------------------->

        </div>
      </div>
    </div>
  </div>
</div>
<!-- content-wrapper ends -->
<script type="text/javascript">
  function pickup(){
    var type = document.getElementById('type').value;
    var hidd = document.getElementById('hidd');
    var hiddes = document.getElementById('hiddes');
    switch( type ){
      case '16' :
       hiddes.classList.add('hidden');
       hidd.classList.remove('hidden');
      break;
      case '19':
         hiddes.classList.remove('hidden');
         hiddev.classList.add('hidden');
         hidd.classList.add('hidden');
      break;
      case '17':
         hiddes.classList.remove('hidden');
         hiddev.classList.add('hidden');
         hidd.classList.add('hidden');
      break;
      default :
       hiddes.classList.remove('hidden');
       hiddev.classList.add('hidden');
       hidd.classList.add('hidden');
      break;
    }
  }

  var Inhouse_type = document.getElementById('Inhouse_type');
  Inhouse_type.onchange = function(){
     var hiddev = document.getElementById('hiddev');
     var Inhouse_types = document.getElementById('Inhouse_type').value;
     hiddev.classList.remove('hidden');
     hiddes.classList.add('hidden');
     var selectCompany = document.getElementById('Inhouse_type').value;
     var phelbo_name = document.getElementById('phelbo_names');
     var logis_namesss = document.getElementById('logis_namesss');
     var phelbo_email = document.getElementById('phelbo_email');
     var phelbo_contact = document.getElementById('phelbo_contact');
     var logis_contactss = document.getElementById('logis_contactss');
     var emp_ids = document.getElementById('emp_ids');
      var s = document.getElementById('ddd').value;
	  var client_cons = document.getElementById('client_cons').value;
     document.getElementById('cklient').value = s;
	 document.getElementById('ccon').value = client_cons;
      var logis_email = document.getElementById('logis_email');
     var requestUrl = "<?=base_url('Sister_Request/fetch_data?id=');?>"+selectCompany ;
     var xhttp = new XMLHttpRequest();
     xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
              var optionUser =  JSON.parse( this.responseText ) ;
              console.log(optionUser);
              phelbo_name.value = optionUser.fullname;
              phelbo_contact.value = optionUser.contact;
              phelbo_email.value = optionUser.email;
              emp_ids.value = optionUser.id;
              logis_namesss.value = optionUser.fullname;
              logis_contactss.value = optionUser.contact;
               logis_email.value = optionUser.email;
        }
    };
     xhttp.open("POST", requestUrl , true);
     xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
     xhttp.send();
   }

   function formaa_pick(){
     document.getElementById('form_picks').submit();
   }

    function vix(){
     document.getElementById('form_ids').submit();
   }

</script>
