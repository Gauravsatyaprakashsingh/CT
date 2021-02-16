
<style>
  .test_class{
    display: none;
  }
  .messageCheckbox{
    display:inline;
    font-size: 15px;
  }
  #idd{
    margin-right: 5px;
  }

</style>
<!-- <?php
 function getStatus( $currentStatus ){
  if( $currentStatus == 0 )
    return [ 'class'=>'text-warning' , 'status' =>'Iniated' ];
  elseif ( $currentStatus == 1 )
    return [ 'class'=>'text-success' , 'status' =>'Active' ];
  elseif ( $currentStatus == 2 )
    return [ 'class'=>'text-danger' , 'status' =>'Closed' ];
 }

$tableData = empty($tableData)?[]:$tableData;

?>
 --><form id="projectForm" action="<?=base_url('Project/edit_project')?>" method="post">
  <input id="projectValue" type="hidden" name="project_value" value="">
</form>
<form id="projectsForms" action="<?=base_url('Project/view_test')?>" method="post">
    <input id="projectsValues" type="hidden" name="projects_values" value="">
</form>
<div class="content-wrapper">
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <button type="button" class="btn btn-primary" id="hides_button">Add More Test</button></br></br>
          <div id="Add_More"  class="test_class">
             <p class="card-description">

            </p>
            <!--div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Project name</label>
                  <div class="col-sm-9">
                    <input name="project_name" value="<?=($editProject)?$projectData->project_name:''?>" placeholder="Enter project name" type="text" class="form-control" />
                  </div>
                </div>
              </div>

              <?php if( !$editProject ): ?>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Select Project Manager</label>
                  <div class="col-sm-9">
                    <select  name="pm_id" class="form-control">
                      <?php foreach ($pm_list as $key => $value): ?>
                        <option  value="<?=$value->id?>"><?=$value->fullname?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
            <?php endif; ?>
            </div>

          <?php if( !$editProject ): ?>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Select Company</label>
                  <div class="col-sm-9">
                    <select id="selectCompany" onchange="getBhd()" name="company_id" class="form-control">
                      <?php foreach ( $company_list as $key => $value): ?>
                        <option value="<?=$value->comp_id?>"><?=$value->comp_name?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <input type="hidden" id="emp_id" name="emp_id" value="">

            </div>
          <?php endif; ?>
-->
          <div class="row">


                <div class="col-sm-3">
                   <input type="text" name="test_id" id="liveSearchInput" placeholder="Search by testname,testcode" class="form-control" value="" />
                </div>

                <!-- <div class="col-sm-2">
                   <button type="button" onclick="clearUncheck()" class="btn btn-small btn-info btn-rounded" name="button">clear</button>
                   <p style="font-size: 10px;color: red;"> note:-clear unselected item from list</p>
                </div> -->

                <div class="col-sm-7">
                <div style="width: 100%; border:1px solid silver;height: 100px; overflow-y: scroll;">
                <div id="listTest" style="margin-left: 10px;margin-top: 10px"></div>
                </div></div>




                <div class="col-md-2">
                <input type="hidden" id="master_id" name="query"></form>
               <button type="button" style="float:left" name="button" id="master_test" onclick="test_master()" class="btn btn-primary">Submit</button>

              </div>
            </div>
          <div id="tables">
          <form action="<?php echo base_url('Test/masters_saves');?>" method='post'>
          <input type="hidden" id="project_ids" name="id">
          <input type="hidden" id="clients_id" name="client_id" value="<?//php echo $client_id;?>">

          <div id="table"></div>
          </div>

        </div>
          <h4 class="card-title">Total Project</h4>
          <div class="table-responsive">
            <table id="table_id" class="table table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Test Name</th>
                  <th>Test Code</th>
                  <th>Full Payment</th>
                  <th>Half Payment</th>
                  <th>Foc</th>
                  <th>Manage</th>
                </tr>
              </thead>
              <tbody>
                <?php $counter = 1; foreach ($test_lists as $key => $value):
                  $project_id = $value->project_id;
                  $clients_id = $value->client_id;
                  $foc = $value->foc;
                  if($foc == '0'){
                    $focs = '&#10004;';
                  }
                  elseif($foc == 'false'){
                    $focs = '&#10006;';
                  }
                ?>
                  <tr>
                    <td><?=$counter++?></td>
                    <td><?= $value->test_name; ?></td>
                    <td><?= $value->test_code; ?></td>
                    <td><?= $value->price?></td>
                    <td><?= $value->halfpayment?></td>
                    <td><?= $focs?></td>

                    <td>
                      <a href="<?=base_url('Project/edit_AssignedTest?value=').$value->pat_id?>"  title="Edit Project" class="btn btn-icons btn-rounded btn-info" name="button">
                        <i class="fa fa-pencil"></i>
                      </a>
                      <a href="<?=base_url('Project/delete_test?value=').$value->pat_id?>" title="Remove Project" class="btn btn-icons btn-rounded btn-danger" >
                        <i class="fa fa-trash"></i>
                      </a>
                      <input type="hidden" value="<?= $project_id?>" id="projects_valuess">
                      <input type="hidden" value="<?= $clients_id?>" id="clientss_id">
                      <!--button  title="Edit Project" onclick="assigned_Test( '<?=$value->project_id?>' )" class=" btn btn-info" type="button" name="button">
                        Assign Test
                      </button-->
                    </td>
                  </tr>
                <?php endforeach;?>

              </tbody>
            </table>
          </div>
           </div>

      </div>
    </div>
  </div>
</div>
<!-- content-wrapper ends -->

<script type="text/javascript">

  var hides_button = document.getElementById('hides_button');
  hides_button.onclick = function(){
  var id = document.getElementById('Add_More');
  id.classList.remove('test_class');

  }

  function edit_project( project_value ){
    document.getElementById('projectValue').value = project_value ;
    document.getElementById('projectForm').submit();
  }

  function assigned_Test(project_value){
    document.getElementById('projectsValues').value = project_value ;
    document.getElementById('projectsForms').submit();

  }

  function getBhd(){
    var selectCompany = document.getElementById('selectCompany');
    var employee_id = document.getElementById('emp_id');
    var employeeName = document.getElementById('empName');
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
              var userObject = JSON.parse( this.responseText );
              employee_id.value = userObject.id ;
              employeeName.value = userObject.fullname;
        }
    };
    xhttp.open("POST", "<?=base_url('Company/getBHD')?>", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("company_id="+ selectCompany.value );
  }

  var textInput = document.getElementById('liveSearchInput');
  var timeout = null;

  textInput.onkeyup = function(e){
    clearTimeout(timeout);
    timeout = setTimeout(function () {
      searchTest( textInput.value );
    }, 500);
  };

  function searchTest( keyword ){
  var listTest = document.getElementById('listTest');
  var button = document.getElementById("master_id");
  var liveSearchInput = document.getElementById("liveSearchInput").value;
  listTest.innerHTML = '';
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var userObject = JSON.parse( this.responseText );
            console.log( userObject );
            userObject.forEach((value)=>{
              var option = document.createElement("p");
              var options = document.createElement("br");
              option.className="messageCheckbox";
              var input = document.createElement("input");
              input.type="checkbox";
              input.className="messageCheckbox";
              input.name="chk_group[]";
              //option.setAttribute("value", value.test_id );
              input.value= value.test_id ;
              input.id="idd";
              console.log( input.value );
              var textNode = document.createTextNode(value.test_name+"("+value.test_code+")");
              button.value = value.test_id;
              option.appendChild(textNode);
              listTest.appendChild( input );
              listTest.appendChild( option );
              listTest.appendChild( options );
              listTest.appendChild( options );
              if(liveSearchInput == ""){
                $(listTest).hide();
             }
              if(liveSearchInput != ""){
                $(listTest).show();
             }
              });

        }

    };
    xhttp.open("POST", "<?=base_url('Test/searchTest')?>", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("query="+ keyword );
  }

  function clearUncheck(){
    var listTest = document.getElementById('listTest');
  }


   function test_master(){
    var projects = document.getElementById('projects_valuess').value;
    var project_ids = document.getElementById('project_ids').value = projects;
    var clientss_id = document.getElementById('clientss_id').value;
    var clients_id = document.getElementById('clients_id').value = clientss_id ;
    var space = document.getElementById("tables");
    var a = 'feroz';
    var valS = [];
    $(':checkbox:checked').each(function(i){
         valS[i] = $(this).val();
     });
    var id = valS.toString();
    var selectid = document.getElementById('table');
    var res = encodeURIComponent(id);
    var requestUrl = "<?=base_url('Test/fetchs_tests/');?>"+ res;
   // alert(requestUrl);
    console.log( requestUrl );
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      console.log( this.responseText );
      space.style.marginTop  = '3%';
      space.style.marginBottom  = '5%';
      selectid.innerHTML = this.responseText;
    }
    };
    xhttp.open("GET", requestUrl , true);

    xhttp.send();


   }
</script>
