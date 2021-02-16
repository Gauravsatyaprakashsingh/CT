<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title></title>
    <!--<link href="<?//=base_url('js/bootstrap.min.css')?>" rel="stylesheet" media="screen">-->
    <link href="<?=base_url('js/bootstrap-datetimepicker.min.css')?>" rel="stylesheet" media="screen">

<style media="screen">
   .hidden{
     display:none;
   }

   .camp_hidden{
     display:none;
   }

   .location{
    display:none;
   }

   .hiddens{
    display: none;
   }

   .location_hiddens{
    display: none;
   }

   .location_hidd{
    display: none;
   }
#state_id{
  display:inline;
}
input[type="datetime-local" i] {
    align-items: center;
    display: -webkit-inline-flex;
    font-family: arial;
    padding-inline-start: 1px;
    content: 30%;
    padding: 10px;
    font-size: 1.02rem;

}

#please-wait-image {
   height: 250px;
   left: 50%;
   margin-top: -125px;
   margin-left: -125px;
   position: absolute;
   top: 50%;
   width: 250px;
   z-index: 99999;
   filter: blur(0px);
}

.blur-div{
  filter: blur(1px);
  pointer-events: none;
}
</style>
</head>
<?php
  if( isset($project_value) ) $hiddenField = true ;
  else $hiddenField = false;
  if(isset($test_mask)){
  print_r($test_mask);}

  //print_r( $state_Sample );exit;
 ?>
<div class="content-wrapper">
  <form class="" id="forms" action="<?=base_url('Samples/saveVisit')?>" method="post">
    <?php if( $hiddenField ): ?>
      <input type="hidden" name="project_value" value="<?=$project_value?>">
    <?php endif;  ?>

  <div class="row">
    <div class="col-12 grid-margin">
      <div class="card">
        <div id="card-body" class="card-body">
          <img src="https://cdn.lowgif.com/full/3716714f6973f4c5-loading-pay-1s-spinner-yokratom.gif" hidden id="please-wait-image" alt="">
          <h4 class="card-title">Request for Sample Collection</h4>
            <div class="row" >
              <?php if( !$hiddenField ): ?>
                         <div class="col-md-4">
                           <div class="form-group row">
                             <label class="col-sm-3 col-form-label">Select Project<strong style="color:red;">*</strong></label>
                             <div class="col-sm-9">
                               <select  onchange="clearPreviousForm()" class="form-control" class="readonly" id="projectValue" name="projects_value">
                                  <option value="">Select Project</option>
                                 <?php foreach( $project_list as $key => $value): ?>
                                   <option value="<?=$value->project_id?>"><?=$value->project_name?></option>
                                 <?php endforeach; ?>
                               </select>
                               <input type="hidden" name="project_value" value="" id="project_value">
                             </div>
                           </div>
                         </div>
                       <?php endif; ?>
              <div class="col-md-4">
                             <div class="form-group row">
                               <label class="col-sm-3 col-form-label">Doctor Name<strong style="color:red;">*</strong></label>
                               <div class="col-sm-9">
                                 <input name="refer_doctor" placeholder="Enter refering doctor name" id="drs" type="text" class="form-control" required/>
                                 <input name="client_id"  id ="client_id" placeholder="Enter refering doctor name" type="hidden" class="form-control" />
                                 <input name="client_name" id ="client_name" placeholder="Enter refering doctor name" type="hidden" class="form-control" />
                                 <input name="client_email" id ="client_email" placeholder="Enter refering doctor name" type="hidden" class="form-control" />
                                 <input name="client_contact"  id ="client_contact" placeholder="Enter refering doctor name" type="hidden" class="form-control" />
                               </div>
                             </div>
                           </div>
              <div class="col-md-4" >
                             <div class="form-group row">
                               <label class="col-sm-4 col-form-label"> Type of sample collection<strong style="color:red;">*</strong> </label>
                               <div class="col-sm-8">
                                 <select class="form-control" name="tosc" id="value_id" onchange="walk()" required>
                                  <option value="0" >Select Collection</option>
                                   <option value="1" >Home Collection</option>
                                   <option value="2">Sample Pick up</option>
                                   <option value="3" >Walk In</option>
                                   <option value="4">Camp</option>
                                 </select>
                               </div>
                             </div>
                           </div></div>

              <div class="row hidden" id="hidd">
                           <div class="col-md-4"  >
                             <div class="form-group row">
                               <label class="col-sm-4 col-form-label">Lab State<strong style="color:red;">*</strong></label>
                               <div class="col-sm-8">
                                   <select class="form-control" name="state1" id="state_name" onchange="state_walkin()"  >
                                    <?php foreach($state as $row):?>
                                      <option><?= $row->state?></option>
                                    <?php endforeach?>

                                   </select>
                               </div>
                             </div>
                           </div>
              <div class="col-md-4">
                             <div class="form-group row">
                               <label class="col-sm-4 col-form-label">Lab City<strong style="color:red;">*</strong></label>
                               <div class="col-sm-8">
                               <select class="form-control" onclick="walk_Lap()" name="city1" id="state_id"><option>Select Location</option></select>
                               </div>
                             </div>
                           </div>
                           <div class="col-md-4 location_hiddens" id="location_state_id">
                             <div class="form-group row">
                               <label class="col-sm-4 col-form-label">Lab Location</label>
                               <div class="col-sm-8">
                               <select class="form-control" onclick="location_lapaddress()" id="locationss_statess_id" name="locations_walk"></select>
                             </div>
                             </div>
                           </div>
                           <div class="col-md-4 location_hidd" id="locations_states_id">
                             <div class="form-group row">
                               <label class="col-sm-4 col-form-label">Lab Location<strong style="color:red;">*</strong></label>
                               <div class="col-sm-8">
                               <textarea class="form-control" name="locations_walks" ></textarea>
                               </div>
                             </div>
                           </div>
              <div class="col-md-4">
                             <div class="form-group row">
                               <label class="col-sm-4 col-form-label">Lab Name<strong style="color:red;">*</strong></label>
                               <div class="col-sm-8">
                               <select class="form-control"  name="lapname1" id="lap_id"  >

                                 </select>
                               </div>
                             </div>
                           </div>
                 <div class="col-md-4">
                             <div class="form-group row">
                               <label class="col-sm-4 col-form-label">Lab Code<strong style="color:red;">*</strong></label>
                               <div class="col-sm-8">
                               <input type="text" class="form-control" required placeholder="Enter Lab Code" name="lapcode1" id="lapcode_id" readonly>
                               </div>
                             </div>
                           </div>

                 <div class="col-md-4">
                             <div class="form-group row">
                               <label class="col-sm-4 col-form-label">Lab Address<strong style="color:red;">*</strong></label>
                               <div class="col-sm-8">
                                <textarea name="address1" required id="lap_address" placeholder="Enter Lab Address " class="form-control"></textarea>
                              </div>
                             </div>
                           </div>

                         <div class="col-md-4">
                             <div class="form-group row">
                               <label class="col-sm-4 col-form-label">Lab Pincode<strong style="color:red;">*</strong></label>
                               <div class="col-sm-8">
                                <input type="text" name="pincode1" required placeholder="Enter Lab Pincode" id="walk_pincode"  class="form-control">
                              </div>
                             </div>
                           </div>
                         </div>
                         <!---Camp_Start-->
                            <div class="row camp_hidden" id="camp_hidd">
                           <!--div class="col-md-4"  >
                             <div class="form-group row">
                               <label class="col-sm-4 col-form-label">Doctor Name</label>
                               <div class="col-sm-8">
                                <input type="text" name="doct_name" placeholder="Enter Doctor Name of Camp" class="form-control">
                               </div>
                             </div>
                           </div-->
              <div class="col-md-4">
                             <div class="form-group row">
                               <label class="col-sm-4 col-form-label">Hospital Name<strong style="color:red;">*</strong></label>
                               <div class="col-sm-8">
                                <input type="text" name="hospital_name" id="h1" placeholder="Enter Hospital Name of Camp" class="form-control" required>
                               </div>
                             </div>
                           </div>
              <div class="col-md-4">
                             <div class="form-group row">
                               <label class="col-sm-4 col-form-label">HospitaL Address<strong style="color:red;">*</strong></label>
                               <div class="col-sm-8">
                                <TEXTAREA name="hospital_address" id="h2" placeholder="Enter Hospital Address of Camp" class="form-control" required> </TEXTAREA>
                               </div>
                             </div>
                           </div>
                 <div class="col-md-4">
                             <div class="form-group row">
                               <label class="col-sm-4 col-form-label">Client Contact<strong style="color:red;">*</strong></label>
                              <div class="col-sm-8">
                               <input type="text" required name="Client_Contact1" placeholder="Enter Contact of Camp " pattern="[789][0-9]{9}" title="It accepts exactly 10 Numbers"  id="Client_Contact1"  class="form-control">
                              </div>
                             </div></div>

                 <div class="col-md-4">
                             <div class="form-group row">
                               <label class="col-sm-4 col-form-label">Client Name<strong style="color:red;">*</strong></label>
                               <div class="col-sm-8">
                              <input type="text" name="client1_name" id="h3" placeholder="Enter Client Name of Camp" class="form-control" required>
                            </div>
                            </div>
                           </div>

                         <div class="col-md-4">
                             <div class="form-group row">
                               <label class="col-sm-4 col-form-label">Client Email Address<strong style="color:red;">*</strong></label>
                               <div class="col-sm-8">
                                <input type="email" name="client1_email" id="h4" placeholder="Enter Email of Camp" class="form-control" required>
                              </div>
                             </div>
                           </div>
                           <div class="col-md-4">
                             <div class="form-group row">
                               <label class="col-sm-4 col-form-label">Other Client Contact</label>
                              <div class="col-sm-8">
                               <input type="text" name="Client_Contact2" placeholder="Enter Contact of Camp " pattern="[789][0-9]{9}" title="It accepts exactly 10 Numbers"  id="Client_Contact2"  class="form-control">
                              </div>
                             </div></div>

                 <div class="col-md-4">
                             <div class="form-group row">
                               <label class="col-sm-4 col-form-label">Other Client Name</label>
                               <div class="col-sm-8">
                              <input type="text" name="client2_name" placeholder="Enter Client Name of Camp" class="form-control">
                            </div>
                            </div>
                           </div>

                         <div class="col-md-4">
                             <div class="form-group row">
                               <label class="col-sm-4 col-form-label">Other Client Email Address</label>
                               <div class="col-sm-8">
                                <input type="email" name="client2_email" placeholder="Enter Email of Camp" class="form-control">
                              </div>
                             </div>
                           </div>
                           <div class="col-md-4">
                             <div class="form-group row">
                               <label class="col-sm-4 col-form-label">Number of Expected patients<strong style="color:red;">*</strong></label>
                               <div class="col-sm-8">
                                <input type="number" name="Expected_number" id="h5" placeholder="Enter Number of Expected patients" class="form-control" required>
                              </div>
                             </div>
                           </div>
                           <div class="col-md-4">
                             <div class="form-group row">
                               <label class="col-sm-4 col-form-label">Date and Time of Collection From<strong style="color:red;">*</strong></label>
                               <div class="col-sm-8 input-append date  form_datetime1">
                                 <input type="text" required  placeholder="Date and Time of Collection from" id="datetime1" class="form-control" name="camp_from_date" value="">
                               <span class="add-on"><i class="icon-remove"></i></span>
                                <span class="add-on"><i class="icon-th"></i></span>
                               </div>
                             </div>
                           </div>
                           <div class="col-md-4">
                             <div class="form-group row input-append date  form_datetime2">
                               <label class="col-sm-4 col-form-label">Date and Time of Collection To<strong style="color:red;">*</strong></label>
                               <div class="col-sm-8">
                                 <input type="text" required  placeholder="Date and Time of Collection To" id="datetime2" class="form-control" name="camp_to_date" value="">
                               <span class="add-on"><i class="icon-remove"></i></span>
                                <span class="add-on"><i class="icon-th"></i></span>
                               </div>
                             </div>
                           </div>

                         </div>



                         <!---Camp_End---->
                         <div class="row hiddens" id="hidds">
                           <div class="col-md-4"  >
                             <div class="form-group row">
                               <label class="col-sm-4 col-form-label">State<strong style="color:red;">*</strong></label>
                               <div class="col-sm-8">
                                   <select class="form-control" name="state2" id="state_names" onchange="state_sample()"  >
                                    <?php foreach($state_Sample as $rows):?>
                                      <option><?= $rows->State?></option>
                                    <?php endforeach?>

                                   </select>
                               </div>
                             </div>
                           </div>
              <div class="col-md-4">
                             <div class="form-group row">
                               <label class="col-sm-4 col-form-label">Location<strong style="color:red;">*</strong></label>
                               <div class="col-sm-8">
                               <select class="form-control" name="city2" onclick="walkSample_Lap()" id="statess_id">
                                 <option>Select Location</option></select>
                               </div>
                             </div>
                           </div>
              <!--div class="col-md-4">
                             <div class="form-group row">
                               <label class="col-sm-4 col-form-label">Lap Name</label>
                               <div class="col-sm-8">
                               <select class="form-control"  name="lapname" id="Sample_lapnames">

                                 </select>
                               </div>
                             </div>
                           </div>
                 <!--div class="col-md-4">
                             <div class="form-group row">
                               <label class="col-sm-4 col-form-label">Lap Code</label>
                               <div class="col-sm-8">
                               <input type="text" class="form-control" name="lapname" id="lapcode_id" readonly>
                               </div>
                             </div>
                           </div-->

                 <div class="col-md-4">
                             <div class="form-group row">
                               <label class="col-sm-4 col-form-label">Address<strong style="color:red;">*</strong></label>
                               <div class="col-sm-8">
                                <textarea name="address2" required id="Lap_sample_address" class="form-control" required></textarea>
                              </div>
                             </div>
                           </div>

                         <div class="col-md-4">
                             <div class="form-group row">
                               <label class="col-sm-4 col-form-label">Pincode<strong style="color:red;">*</strong></label>
                               <div class="col-sm-8">
                                <input type="text" name="pincode2" value="" id="walklap_pincode" placeholder="Enter Pincode"  class="form-control" required>
                              </div>
                             </div>
                           </div>
                         </div>
                         <div class="row">
              <!--div class="col-md-4 location" id="locations">
                             <div class="form-group row">
                               <label class="col-sm-4 col-form-label">Location of Collection</label>
                               <div class="col-sm-8">
                                 <textarea name="loc" class="form-control"></textarea>
                               </div>
                             </div-->

              <div class="col-md-4 date_hidden" id="date_hidd">
                             <div class="form-group row">
                               <label class="col-sm-4 col-form-label">Date and Time of Collection<strong style="color:red;">*</strong></label>
                               <div class="col-sm-8 input-append date  form_datetime" data-date="2012-12-21T15:25:00Z">
                                 <input required type="text"  placeholder="Date and Time of Collection " id="datetime" class="form-control" name="doc" value="">
                                 <span class="add-on"><i class="icon-remove"></i></span>
                                <span class="add-on"><i class="icon-th"></i></span>
                               </div>
                             </div>
                           </div>
                           <div class="col-md-4 date_hidden" >
                             <div class="form-group row">
                               <label class="col-sm-4 col-form-label">Representative name<strong style="color:red;">*</strong></label>
                               <div class="col-sm-8">
                                 <input type="text" name="r_name" placeholder="Enter Representative name" id="r2" class="form-control" required>
                               </div>
                             </div>
                           </div>
                           <div class="col-md-4 date_hidden" >
                             <div class="form-group row">
                               <label class="col-sm-4 col-form-label">Representative contact no<strong style="color:red;">*</strong></label>
                               <div class="col-sm-8">
                                 <input type="text" name="r_contact" placeholder="Enter Representative contact no" id="r1" class="form-control" required>
                               </div>
                             </div>
                           </div>
                           <div class="col-md-4 date_hidden" >
                             <div class="form-group row">
                               <label class="col-sm-4 col-form-label">Representative email<strong style="color:red;">*</strong></label>

                               <div class="col-sm-8">
                                 <input type="email" name="r_email" id="remail" placeholder="Enter Representative email" class="form-control" required>
                               </div>
                             </div>
                           </div>
              <!--div class="col-md-4">
                             <div class="form-group row">
                               <label class="col-sm-4 col-form-label">Pincode</label>
                               <div class="col-sm-8">
                                 <input type="text"  placeholder="Enter pincode of location" class="form-control" name="pincode" value="">
                               </div>
                             </div>
                           </div--></div>
              <!-- <input type="text" id="tst_idd" name="tst_id" value=""> -->

            <div id="formData" class="row">


            </div>
            <div class="row">
            <button type="button" onclick="getSampleForm()" class="btn btn-rounded btn-warning"><i class="fa fa-plus"></i> Add Patient</button>
            <input type="hidden" id="pname" value='2'>
            <input type="hidden" id="tests" value='2'>
            <input type="hidden" id="pay" value='2'>
          </div>
            <br>

            <div class="row">
              <button type="submit" class="btn btn-block btn-info" onclick="submit_pincode()" id="submit_pincodse" name="button">Save</button>
            </div>



        </div>
      </div>
    </div>
  </div>
</form>
</div>
<!-- content-wrapper ends -->
<!--<div class="input-append date " data-date="2012-12-21T15:25:00Z">-->
<!--    <input size="16" type="text" value="" readonly>-->
<!--    <span class="add-on"><i class="icon-remove"></i></span>-->
<!--    <span class="add-on"><i class="icon-th"></i></span>-->
<!--</div>-->
<script type="text/javascript" src="<?=base_url('js/jquery-1.8.3.min.js')?>"  charset="UTF-8"></script>
<script type="text/javascript" src="<?=base_url('js/bootstrap.min.js')?>" ></script>
<script type="text/javascript" src="<?=base_url('js/bootstrap-datetimepicker.js')?>"  charset="UTF-8"></script>
<script type="text/javascript" src="<?=base_url('js/bootstrap-datetimepicker.fr.js')?>"  charset="UTF-8"></script>

<script type="text/javascript">

        $('.form_datetime').datetimepicker({
             format: 'mm/dd/yyyy h:i p',
              startDate: '-3d'
        });


         $('.form_datetime1').datetimepicker({
                     format: 'mm/dd/yyyy h:i p',
                      startDate: '-3d'
                });

         $('.form_datetime2').datetimepicker({
             format: 'mm/dd/yyyy h:i p',
              startDate: '-3d'
        });

</script>



<script type="text/javascript">

  var allprices = [] ; var uniquenum ;
  function submit_pincode(){
    var sel = document.getElementById('value_id').value;
    var pnames = document.getElementById('pname').value;
    var tests = document.getElementById('tests').value;
    var pay = document.getElementById('pay').value;
    var datetime = document.getElementById('datetime').value;
    var datetime1 = document.getElementById('datetime1').value;
    var datetime2 = document.getElementById('datetime2').value;
    var h1 = document.getElementById('h1').value;
    var h2 = document.getElementById('h2').value;
    var h3 = document.getElementById('h3').value;
    var h4 = document.getElementById('h4').value;
    var h5 = document.getElementById('h5').value;
    var r1 = document.getElementById('r1').value;
    var r2 = document.getElementById('r2').value;
    var drs = document.getElementById('drs').value;
    var remail = document.getElementById('remail').value;
    var project_select = document.getElementById('projectValue').value;
    var project_values = document.getElementById('project_value').value = project_select;



  if( sel == '3' ){
    var pincode1 = document.getElementById('walk_pincode').value;
    if( pincode1 > 100000 && pincode1 < 1000000){
         if( pnames == '1'  ){
       if( datetime == '' || remail == '' || r1 == '' || r2 == '' || drs == '' ){
           alert('Fill Required Field');
       }else{
           if(  tests == '1'){
      if(  pay  == '1' ){
      document.getElementById('forms').submit();}
               else{
                   alert('Please select payment Status ');
               }
           }
           else{
          alert('Please Fill Patients Required Fields & Test ');
      }
       }
        }
        else{
            alert('Fill Patient Details');
        }
    }
    else{
      alert('Pincode must contain exactly six digits');
    }
  }
  else if( sel == '1' || sel == '2' ){
    var pincode2 = document.getElementById('walklap_pincode').value;
   if( pincode2 > 100000  && pincode2 < 1000000 ){
    if( pnames == '1'  ){
       if( datetime == '' || remail == '' || r1 == '' || r2 == '' || drs == '' ){
           alert('Fill Required Field');
       }else{
           if(  tests == '1' ){
               if(  pay  == '1' ){
      document.getElementById('forms').submit();}
               else{
                   alert('Please select payment Status ');
               }
           }
           else{
          alert('Please Fill Patients Required Fields & Test ');
      }
       }
        }
        else{
            alert('Fill Patient Details');
        }
    }
    else{
      alert('Pincode must contain exactly six digits');
    }
  }
  else if( sel == '0'){

      alert(' Select Type of sample collection  ');
    //document.getElementById('forms').submit();
  }
  else{
    var patt = document.getElementById('Client_Contact1').value;
     var pattern2 = document.getElementById('Client_Contact2').value;
    var pattern = /^\d{10}$/;
    if(patt.match(pattern) || pattern2.match(pattern)){
    if( pnames == '1'   ){


        if(  tests == '1' ){
     if(  pay  == '1' ){
          if( datetime1 == '' || datetime2 == '' || remail == '' || h1 == '' || h2 == '' || h3 == '' || h4 == '' || h5 == '' || r1 == '' || r2 == '' || drs == '' ){
           alert('Fill Required Field');
       }
       else{
      document.getElementById('forms').submit();}}
               else{
                   alert('Please select payment Status ');
               }}
      else{
          alert('Please Fill Patients Required Fields & Test ');
      }

        }
        else{
            alert('Fill Patient Details');
        }

    }
    else{
      alert('Please Enter valid Contact Number');
    }
  }
  }

  function getSampleForm(  ){
    var project_value = document.getElementById('projectValue');
    var i = '1';
    var pname = document.getElementById('pname').value = i;
    var project_select = document.getElementById('projectValue').value;
     $(project_value)
        .attr("disabled", true);
    //var project_values = document.getElementById('project_value').value = project_select;
    var xhttp = new XMLHttpRequest();
    var project_id = document.getElementById('projectValue').value;
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var element = document.createElement("div");
        project_value.style.disabled;
        element.innerHTML = this.responseText;
        document.getElementById("formData").appendChild(element);
      }
    };
    xhttp.open("POST", "<?=base_url('Samples/getSampleForm')?>", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("project_id=" + project_id );
  }

  function addMoreTest( uniqueId ){
    var xhttp = new XMLHttpRequest();
    var project_id = document.getElementById('projectValue').value;
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var tbodyId = "tbody-"+uniqueId;
        var element = document.createElement("tr");
        element.innerHTML = this.responseText
        document.getElementById( tbodyId ).appendChild(element) ;
      }
    };
    xhttp.open("POST", "<?=base_url('Samples/addMoreTest')?>", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("uniqueId="+uniqueId+"&project_id="+project_id);
  }

  function removetest( currentDom ){

    tableRow = currentDom.parentNode.parentNode;
    tableRow.parentNode.removeChild(tableRow);
  }

  function test( uid ){
    var i = '1';
    var tests = document.getElementById('tests').value = i;
    var payment_id = document.getElementById('paymentType-'+uid).value;
    var test_code = document.getElementById('test_code-'+uid);
    var typeShipments = document.getElementById('typeShipment-'+uid);
    var vacutainer_type = document.getElementById('vacutainer_type-'+uid);
    var test_id = document.getElementById('test_value-'+uid).value;
    var project_id = document.getElementById('projectValue').value;
    var requestUrl = "<?=base_url('Samples/price_count?test_id=');?>"+test_id+'&project_id='+project_id+'&payment_id='+payment_id;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        console.log( JSON.parse(this.responseText) );
        allprices[ uid ] = JSON.parse(this.responseText);
        test_code.value = allprices[ uid ].test_code;
        typeShipments.value = allprices[ uid ].Type_of_shipment;
        vacutainer_type.value = allprices[ uid ].vacutainer_type
      }
    };
    xhttp.open("POST", requestUrl , true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send();
  }

  function checkPaymentType( uniquenum , currentObject ){
       var i = '1';
        var pay = document.getElementById('pay').value = i;
        var payment_id = document.getElementById('paymentType-'+uniquenum).value;
        console.log( uniquenum );
        var paragraph = document.getElementById('para-'+uniquenum );
        console.log( paragraph );
        console.log( allprices[uniquenum] );
        if( payment_id == '3' ){
          if( allprices[ uniquenum].price === 0 || allprices[ uniquenum].price === '0' ){
            alert( 'Full payment is not valid on selected Test please select again');
            resetSelection( currentObject );
            paragraph.value = null;
          }
          else{
            paragraph.value = allprices[ uniquenum].price
          }
        }
        else if( payment_id == '2' ){
          if( allprices[ uniquenum].halfpayment === 0 || allprices[ uniquenum].halfpayment === '0' ){
            alert( 'Half payment is not valid on selected Test please select again');
            resetSelection( currentObject );
            paragraph.value = null;
          }
          else{
            paragraph.value = allprices[ uniquenum].halfpayment
          }

        }
        else{
          if( allprices[ uniquenum].foc === 'false' ){
            alert('FOC is not applicable on selected Test');
            paragraph.value = null;
            resetSelection( currentObject );
          }
          else{
            paragraph.value = allprices[ uniquenum].foc
          }
        }
  }

  function resetSelection( instance ){
        $(instance).prop('selectedIndex',0);
  }

  function clearPreviousForm(){
     var id = document.getElementById('projectValue').value;
     $request_url = "<?= base_url('Samples/cliens?project_id=')?>"+id;
     checkProjectAgreementDate( id );
    //  alert( $request_url );
    var xhttp = new XMLHttpRequest();
     xhttp.onreadystatechange = function(){
         if( this.readyState == 4 && this.status == 200 ){
             console.log( JSON.parse(this.responseText) );
             var option = JSON.parse(this.responseText);
             document.getElementById('client_id').value = option.comp_id;
             document.getElementById('client_name').value = option.comp_name;
             document.getElementById('client_email').value = option.comp_email;
             document.getElementById('client_contact').value = option.comp_contact;

         }
     };
     xhttp.open("POST",$request_url, true);
     xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
     xhttp.send();
    document.getElementById("formData").innerHTML=null;
  }

  function checkProjectAgreementDate( id ){
    showBlur();
    var xhttp = new XMLHttpRequest();
     xhttp.onreadystatechange = function(){
         if( this.readyState == 4 && this.status == 200 ){
           var resp = JSON.parse(this.responseText);
             console.log( resp );
             if( resp ){
               hideBlur();
             }
             else {
               alert("Project is expired you can't raise request against this project");
               window.location.reload();
             }
         }
     };
     xhttp.open("POST","<?=base_url('Project/checkProjectAgreementDate')?>", true);
     xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
     xhttp.send("value="+id );
  }

  function showBlur( ){
    var loadingImage = document.getElementById('please-wait-image');
    var  targetDiv = document.getElementById('card-body');
    loadingImage.removeAttribute("hidden");
    targetDiv.classList.add("blur-div");
  }

  function hideBlur(){
    var loadingImage = document.getElementById('please-wait-image');
    var  targetDiv = document.getElementById('card-body');
    loadingImage.setAttribute("hidden" ,true);
    targetDiv.classList.remove("blur-div");
  }

function walk(){
  var walk_id = document.getElementById('value_id').value;
  var location_field = document.getElementById('hidd');
  var home_collection = document.getElementById('hidds');
  var camp_collection = document.getElementById('camp_hidd');
  var date_hidd = document.getElementById('date_hidd');
  //var location_other = document.getElementById('locations');
  if(walk_id=='3'){
      location_field.classList.remove('hidden');
      camp_collection.classList.add('camp_hidden');
      home_collection.classList.add('hiddens');
  }
  else if(walk_id=='1'){
      home_collection.classList.remove('hiddens');
      camp_collection.classList.add('camp_hidden');
      location_field.classList.add('hidden');
  }
  else if(walk_id=='2'){
      home_collection.classList.remove('hiddens');
      camp_collection.classList.add('camp_hidden');
      location_field.classList.add('hidden');
  }
  else{
      camp_collection.classList.remove('camp_hidden');
      location_field.classList.add('hidden');
      home_collection.classList.add('hiddens');
      date_hidd.classList.add('hiddens');

  }
}

 function state_walkin(){
  var state_name = document.getElementById('state_name').value;
  var id = document.getElementById('state_id');
  var location_state_id = document.getElementById('location_state_id');
  var locations_states_id = document.getElementById('locations_states_id');
  if( state_name == "Maharashtra"){
    locations_states_id.classList.add('location_hidd');
    location_state_id.classList.remove('location_hiddens');
  }
  else{
    location_state_id.classList.add('location_hiddens');
    locations_states_id.classList.remove('location_hidd');
  }
  console.log(state_name);
  var requestUrl = "<?=base_url('Samples/city_walkin?text_name=');?>"+state_name ;
    console.log(requestUrl);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
       var opt = JSON.parse(this.responseText);
      // var select = document.createElement('select');
       //select.className = 'form-control';
       opt.forEach((value)=>{

       var option = document.createElement('option');
       option.id = 'opt_id';
       //option.onclick = opt_click();
       var textNode = document.createTextNode(value.Sub_Unit);
       var textNodes = document.createTextNode(value.State);
       //state_id.appendChild( select );
         id.appendChild( option );
          console.log(option.appendChild(textNode));

  });
   }
    };
    $(id).empty();
    xhttp.open("POST", requestUrl , true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send();

 }

function state_sample(){
  var state_name = document.getElementById('state_names').value;
  var id = document.getElementById('statess_id');
 // var id = document.getElementById('select_id');
  console.log(state_name);
  var requestUrl = "<?=base_url('Samples/citySample_walkin?text_name=');?>"+state_name ;
    console.log(requestUrl);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
       var opt = JSON.parse(this.responseText);
      // var select = document.createElement('select');
       //select.className = 'form-control';
       opt.forEach((value)=>{

       var option = document.createElement('option');
       option.id = 'opt_id';
       //option.onclick = opt_click();
       var textNode = document.createTextNode(value.Sub_Unit);
       var textNodes = document.createTextNode(value.State);
       //state_id.appendChild( select );
        id.appendChild( option );
        console.log(option.appendChild(textNode));

  });
   }
    };
    $(id).empty();
    xhttp.open("POST", requestUrl , true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send();

 }

 function walk_Lap(){
    var lap_id = document.getElementById( 'lap_id' );
    var states_id = document.getElementById( 'state_name' ).value;
    var locationss_statess_id = document.getElementById('locationss_statess_id');
    var city_name = document.getElementById( 'state_id' ).value;
    //alert(states_id +"city = "+city_name);
    var requestUrl = "<?=base_url( 'Samples/lap_walkin?text_name=' );?>"+states_id+"&city_id="+city_name;
    console.log(requestUrl);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var optionUser = JSON.parse(this.responseText);
        console.log(optionUser);
        optionUser.forEach((value)=>{
            if( states_id != "Maharashtra" ){
              var option = document.createElement( 'option' );
              var textNode = document.createTextNode( value.Name );
              option.appendChild( textNode );
              lap_id.appendChild( option );
            }
            else if( states_id == "Maharashtra" ){
              var option = document.createElement( 'option' );
              var textNode = document.createTextNode( value.location );
              option.appendChild( textNode );
              locationss_statess_id.appendChild( option );
          }
        });

      }
    };
    $(lap_id).empty();
    $(locationss_statess_id).empty();
    xhttp.open("POST", requestUrl , true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send();
 }
 function location_lapaddress(){
  var lap_id = document.getElementById( 'lap_id' );
    var states_id = document.getElementById( 'state_name' ).value;
    var city_name = document.getElementById( 'state_id' ).value;
    var location_name = document.getElementById('locationss_statess_id').value;
    var requestUrl = "<?=base_url( 'Samples/lap_walkin_location?text_name=' );?>"+states_id+"&city_id="+city_name+"&location="+location_name;
    console.log(requestUrl);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var optionUser = JSON.parse(this.responseText);
        console.log(optionUser);
        optionUser.forEach((value)=>{
              var option = document.createElement( 'option' );
              var textNode = document.createTextNode( value.Name );
              option.appendChild( textNode );
              lap_id.appendChild( option );


        });

      }
    };
    $(lap_id).empty();
    xhttp.open("POST", requestUrl , true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send();
 }
 function walkSample_Lap(){
    var lap_id = document.getElementById( 'walklap_pincode' );
    var states_id = document.getElementById( 'state_names' ).value;
    var city_name = document.getElementById( 'statess_id' ).value;
    var requestUrl = "<?=base_url( 'Samples/lapSample_walkin?text_name=' );?>"+states_id+"&city_id="+city_name;
    //console.log(requestUrl);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var optionUser = JSON.parse(this.responseText);
        optionUser.forEach((value)=>{
           lap_id.value = value.Pincode;

        });

      }
    };
    $(lap_id).empty();
    xhttp.open("POST", requestUrl , true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send();
 }

 function sample_Lap(){
    var lap_id = document.getElementById( 'lap_id' );
    var states_id = document.getElementById( 'state_name' ).value;
    var city_name = document.getElementById( 'state_id' ).value;
    //alert(states_id +"city = "+city_name);
    var requestUrl = "<?=base_url( 'Samples/lap_walkin?text_name=' );?>"+states_id+"&city_id="+city_name;
    console.log(requestUrl);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var optionUser = JSON.parse(this.responseText);
        //console.log(optionUser);
        optionUser.forEach((value)=>{
            var option = document.createElement( 'option' );
            var textNode = document.createTextNode( value.Name );
            option.appendChild( textNode );
            lap_id.appendChild( option );
        });

      }
    };
    $(lap_id).empty();
    xhttp.open("POST", requestUrl , true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send();
 }

 var lap_name = document.getElementById('lap_id');

 lap_name.onclick = function(){
    var lap_name = document.getElementById( 'lap_id' ).value;
    var states_id = document.getElementById( 'state_name' ).value;
    var city_name = document.getElementById( 'state_id' ).value;
    var lap_address = document.getElementById('lap_address');
    var lapcode_name = document.getElementById('lapcode_id');
    var requestUrl = "<?=base_url( 'Samples/lap_Code_walkin?text_name=' );?>"+states_id+"&city_id="+city_name+"&lap_name="+lap_name;
    console.log(requestUrl);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          optionUser = JSON.parse(this.responseText);
          console.log(optionUser);
          optionUser.forEach((value)=>{
         // console.log(value.Attune_Code);
          //console.log(value.Address);
          lap_address.value = value.Address;
          lapcode_name.value = value.Attune_Code;
          });
       }
    };
    //$(lap_id).empty();
    xhttp.open("POST", requestUrl , true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send();
 }

</script>
