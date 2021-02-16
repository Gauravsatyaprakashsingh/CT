<style>
  .messageCheckbox{
    display:inline;
    font-size: 15px;
  }
  #idd{
    margin-right: 5px;
  }

</style>
<?php
  if( isset( $projectData ) )
  $editProject = true;
  else
  $editProject = false;
 ?>
<div class="content-wrapper">
  <div class="row">
    <div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title"><?=($editProject)?'Edit Project':'New Project'?></h4>
          <?php //$action_url = ($editProject)?base_url('Project/update_project'):base_url('Project/add_new_project') ?>
          <!--form action="<?=$action_url ?>" method="post" class="form-sample"-->
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
            <div class="col-md-12">
              <div class="form-group row">
                <div class="col-sm-3">
                   <input type="text" name="test_id" id="liveSearchInput" placeholder="Search by testname,testcode" class="form-control" value="" />
                </div>
              </div>
                <!-- <div class="col-sm-2">
                   <button type="button" onclick="clearUncheck()" class="btn btn-small btn-info btn-rounded" name="button">clear</button>
                   <p style="font-size: 10px;color: red;"> note:-clear unselected item from list</p>
                </div> -->
                <br><br>
                <div class="row">
                <div class="col-sm-9">
                <div style="width: 100%; border:1px solid silver;height: 100px; overflow-y: scroll;">
                <div id="listTest" style="margin-left: 10px;margin-top: 10px"></div>
                </div>
                </div>
              </div>
              <br><br><br>
                <div class="row">
                <div class="col-sm-2">
                <input type="hidden" id="master_id" name="query"></form>
               <button type="button" name="button" id="master_test" onclick="test_master()" class="btn btn-primary">Submit</button>
                </div>
              </div>
            </div>
          </div>
          <div id="tables">
          <form action="<?php echo base_url('Test/master_save');?>" method='post'>
          <input type="hidden" name="id" value="<?php echo $project_id;?>">
          <input type="hidden" name="client_id" value="<?php echo $client_id;?>">

          <div id="table"></div>
          </div>
            <!--div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Agreement Start Date</label>
                  <div class="col-sm-9">
                    <input type="date"   class="form-control" name="start_date" value="<?=($editProject)?$projectData->project_start_date:''?>" >
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Agreement End Date</label>
                  <div class="col-sm-9">
                    <input type="date"  class="form-control" name="end_date" value="<?=($editProject)?$projectData->project_end_date:''?>">
                  </div>
                </div>
              </div>
            </div>


            <div class="row">
              <div class="col-md-6">
                <button type="submit" class="btn btn-info" ><?=($editProject)?'Update':'Next'?></button>
              </div>
            </div>

          </form-->
        </div>
      </div>
    </div>
  </div>
</div>

<!-- content-wrapper ends -->

<script type="text/javascript">

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
    console.log(keyword);
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
    var space = document.getElementById("tables");
    var a = 'feroz';
    var valS = [];
    $(':checkbox:checked').each(function(i){
         valS[i] = $(this).val();
     });
    var id = valS.toString();
    var selectid = document.getElementById('table');
    var res = encodeURIComponent(id);
    var requestUrl = "<?=base_url('Test/fetch_test/');?>"+ res;
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
