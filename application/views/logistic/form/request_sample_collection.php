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
  if(isset($project_value)) $hiddenField = true ;
  else $hiddenField = false;
  if(isset($test_mask)){
  print_r($test_mask);}
?>
   <div class="content-wrapper">
   
   <form class="" id="forms" action="<?=base_url('Samples/savecamp')?>" method="post">
    <?php if( $hiddenField ): ?>
    <input type="hidden" name="project_value" value="<?=$project_value?>">
    <?php endif;?>

			<div class="row">
			<div class="col-12 grid-margin">
			<div class="card">
			<div id="card-body" class="card-body">
			<img src="https://cdn.lowgif.com/full/3716714f6973f4c5-loading-pay-1s-spinner-yokratom.gif" hidden id="please-wait-image" alt="">
			<h4 class="card-title">Request for Sample Collection</h4>
             
			<div class="row">
			<input type="hidden" name="projects_value" id="projectValue" value="<?php echo $project_id;?>"> 
			<input type="hidden" name="project_value" value="<?php echo $project_id;?>" id="project_value"> 
			<input type="hidden" name="visit_id" id="visit_id" value="<?php echo $visit_id;?>"> 
			<input type="hidden" name="visit_unique_id" id="visit_unique_id" value="<?php echo $visit_unique_id;?>"> 
			</div>

            <div class="row hidden" id="hidd"></div>
            <div class="row camp_hidden" id="camp_hidd"></div>
            <div class="row hiddens" id="hidds"></div>
			
			<div class="row"></div>
            <div id="formData" class="row"></div>
            
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
    var test_id = document.getElementById('test_value-'+uid).value;
    var project_id = document.getElementById('projectValue').value;
    var requestUrl = "<?=base_url('Samples/price_count?test_id=');?>"+test_id+'&project_id='+project_id+'&payment_id='+payment_id;
    console.log(requestUrl);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        console.log( JSON.parse(this.responseText) );
        allprices[ uid ] = JSON.parse(this.responseText);
        //console.log( allprices[uid] );return;
        test_code.value = allprices[ uid ].test_code;
        typeShipments.value = allprices[ uid ].Type_of_shipment;
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
