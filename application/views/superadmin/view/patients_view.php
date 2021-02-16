<div class="content-wrapper">
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Patients Details</h4>
          <div class="table-responsive">
            <table id="table_id" class="table table-bordered">
			<thead>
			<tr>
			<th>#</th>
			<th>FullName</th>
			<th>Mobile</th>
			<th>Email</th>
			<th>Gender</th>
			<th>Age</th>
			<th>View</th>
			</tr>
			</thead>
			<tbody>
			<?php $counter = 1; 
			//print_r($patients_details);
			  foreach ($patients_details as $key => $value): 
			?>
				<tr>
				<td><?=$counter++?></td>
				<td><?=$value->patient_name?></td>
				<td><?=$value->patient_contact?></td>
				<td><?=$value->patient_email?></td>
				<td><?=$value->patient_gender?></td>
				<td><?=$value->patient_age?></td>
				<td><a href="<?=base_url()?>Patients/view_details/<?=$value->patient_id?>" class="btn btn-rounded btn-info" >View</a></td>
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

