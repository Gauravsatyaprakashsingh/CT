<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Test extends My_Controller{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index(){
		$this->loadView('form/create_test' , [] );
	}

	public function save_test( ){
    $testName = $this->input->post('test_name');
    $testCode = $this->input->post('test_code');
    $testShipment = $this->input->post('test_Shipment');
		$vacutainer_type = $this->input->post('vacutainer_type');
    $isInserted = $this->Master_model->insert('test_master', ['test_name'=>$testName , 'test_code'=>$testCode , 'Type_of_shipment'=>$testShipment , 'vacutainer_type'=> $vacutainer_type ] );
    if( $isInserted == true ){
      $this->session->set_flashdata('success',"Test Created !");
      redirect('Test');
    }
    else{
      $this->session->set_flashdata('error',"Something Wents Wrong. Please try again.");
      redirect('Test');
    }
	}

	public function searchTest(){
		$query = $this->input->post('query');
		$sqlQuery = "SELECT * FROM test_master tm WHERE tm.test_code LIKE '%{$query}%'  OR tm.test_name  LIKE '%{$query}%' LIMIT 10";
		$testData = $this->Master_model->rawQuery( $sqlQuery );
		echo json_encode( $testData );
	}

    public function fetch_test($id){
    	$url = $this->uri->segment(3);
    	$test_id = urldecode($url);
    	//print_r($test_id);exit;
		$sql = $this->db->query("SELECT * FROM `test_master` where test_id in ({$test_id})");
		$query = $sql->result();
   		$reponse = "<table class='table table-bordered table-striped'>
	   		  <thead>
	   		  <th>Sr</th>
	   		  <th>Test Code</th>
	   		  <th>Test Name</th>
	   		  <th style='display:none'></th>
	   		  <th>Full Payment </th>
	   		  <th>FOC</th>
	   		  <th>Co Payment</th>
	   		  </thead>
			  <tbody>
			 ";
   	$Counter = 1;
   	foreach($query as $row){
   		$reponse .="<tr><td>$Counter</td>
   						<td>$row->test_code</td>
   						<td>$row->test_name</td>
   						<td style='display:none'><input type='text'  name='tests[]' value='$row->test_id'></td>
   						<td><input type='text' name='price[]'></td>
   						<td><input type='checkbox' name='check[]' value='true'></td>
   						<td><input type='text' name='half_price[]'></td></tr>";
   	$Counter++;
   }
   	$reponse .="</tbody></table></br><input type='submit' name='test' value='save' class='btn btn-primary'></form>";
   	echo $reponse ;
}

 public function fetchs_tests($id){
 	$url = $this->uri->segment(3);
    	$test_id = urldecode($url);
    	//print_r($test_id);exit;
		$sql = $this->db->query("SELECT * FROM `test_master` where test_id in ({$test_id})");
		$query = $sql->result();
   		$reponse = "<table class='table table-bordered table-striped'>
	   		  <thead>
	   		  <th>Sr</th>
	   		  <th>Test Code</th>
	   		  <th>Test Name</th>
	   		  <th style='display:none'></th>
	   		  <th>Full Payment </th>
	   		  <th>FOC</th>
	   		  <th>Co Payment</th>
	   		  </thead>
			  <tbody>
			 ";
   	$Counter = 1;
   	foreach($query as $row){
   		$reponse .="<tr><td>$Counter</td>
   						<td>$row->test_code</td>
   						<td>$row->test_name</td>
   						<td style='display:none'><input type='text'  name='tests[]' value='$row->test_id'></td>
   						<td><input type='text' name='price[]'></td>
   						<td><input type='checkbox' name='check[]' value='true'></td>
   						<td><input type='text' name='half_price[]'></td></tr>";
   	$Counter++;
   }
   	$reponse .="</tbody></table></br><input type='submit' name='test' value='save' class='btn btn-primary'></form>";
   	echo $reponse ;


 }

	public function master_save(){
		$post = $this->input->post();
		$project_id = $this->input->post('id');
		$client_id = $this->input->post('client_id');
		$count = count($this->input->post('price'));
		for($i = 0; $i < $count; $i++)
        {
        	if(isset($post['check'][$i])){
			$check = '0';
			}
			else{
				$check = 'false';
			}

			$masterData = [
	            'project_id' => $project_id,
				'client_id' => $client_id,
				'test_id' => $post['tests'][$i],
				'price'  => $post['price'][$i],
				'halfpayment' => $post['half_price'][$i],
				'foc' => $check
			];



	    $isProjectCreated = $this->Master_model->insert( 'project_available_test' , $masterData );
	}
	    if($isProjectCreated){
	    	$this->session->set_flashdata('success',"Project created and assigned to particular project manager");
	    	redirect('Project');
	    }
	    else{
	    	$this->session->set_flashdata('error',"Something wents wrong!. Please try again");
			redirect('Project');
	    }

	}

	public function masters_saves(){
		$post = $this->input->post();
		$project_id = $this->input->post('id');
		$client_id = $this->input->post('client_id');
		$count = count($this->input->post('price'));
		for($i = 0; $i < $count; $i++)
        {
        	if(isset($post['check'][$i])){
			$check = '0';
			}
			else{
				$check = 'false';
			}

			$masterData = [
	            'project_id' => $project_id,
				'client_id' => $client_id,
				'test_id' => $post['tests'][$i],
				'price'  => $post['price'][$i],
				'halfpayment' => $post['half_price'][$i],
				'foc' => $check
			];



	    $isProjectCreated = $this->Master_model->insert( 'project_available_test' , $masterData );
	}
	    if($isProjectCreated){
	    	$this->session->set_flashdata('success',"Project created and assigned to particular project manager");
	    	redirect('Project/view_project');
	    }
	    else{
	    	$this->session->set_flashdata('error',"Something wents wrong!. Please try again");
			redirect('Project/view_project');
	    }

	}

	public function update_test(){
		$post = $this->input->post();
		$test_id = $post['test_value'];
		$updateData = [
			'test_name' => $post['test_name'],
			'test_code' => $post['test_code'],
			'Type_of_shipment' => $post['test_Shipment'],
			'vacutainer_type' => $post['vacutainer_type']
		 ];

		$isUpdated = $this->Master_model->update('test_master',['test_id'=>$test_id ] , $updateData );
			if( $isUpdated ){
				$this->session->set_flashdata('success',"Test Updated Successfully");
				redirect('Test/total_test');
			}
			else{
				$this->session->set_flashdata('error',"Something wents wrong");
				redirect('Test/total_test');
			}
	}

	public function masters_test(){
		 $uri['project_id'] = $this->uri->segment(3);
		 $uri['client_id'] = $this->uri->segment(4);
     $this->loadView('form/master_test',$uri);
	}

	public function edit_test( ){
		$test_id = $this->input->post('test_value');
		$sql = "SELECT * FROM  test_master t WHERE t.test_id ='{$test_id}'";
		$data['testData'] = $this->Master_model->rawQuery( $sql )[0];
		$this->loadView('form/create_test',$data);
	}




	public function total_test(){
		$data['testList'] = $this->Master_model->select('test_master',null , null, ['status' => '1']);
		$this->loadView('view/test_list' ,  $data );
	}

  public function remove_test( ){
    $testId = $this->input->get('value');
    $isDeleted = $this->Master_model->update('test_master', ['test_id'=>$testId ] , ['status'=>'0'] );
    if( $isDeleted ){
      $this->session->set_flashdata('success',"Deleted");
      redirect('Test/total_test');
    }
    else{
      $this->session->set_flashdata('error',"Something Wents Wrong. Please try again.");
      redirect('Test/total_test');
    }
  }


	public function saveVisit(){
		$this->load->model('Casual_Model');
		$post = $this->input->post();
		$requestor_id=$this->session->userdata['log_user']['user_id'];
		$visitData = [
			'project_id' => $post['project_value'],
			'refering_doctor_name'=> $post['refer_doctor'],
			'payment_percent'=> $post['payment_percent'],
			'type_of_collection'=>$post['tosc'],
			'payment_status'=>$post['payment_status'],
			'location_of_collection'=>$post['loc'],
			'date_of_collection'=>$post['doc'],
			'pincode'=>$post['pincode'],
			'requestor_id'=>$requestor_id,
		];

		$visitID = $this->Casual_Model->scheduleVisit( $visitData );
			if( $visitID ){
				$totalPatient = count( $post['patientUniqueId'] );
					for ($i=0; $i<$totalPatient ; $i++){
						$uniqueId = $post['patientUniqueId'][$i];
						$pateintData =[
							'patient_name' => $post['patient_name'][$i],
							'patient_contact' => $post['contact'][$i],
							'patient_email' => $post['email'][$i],
							'patient_age' => $post['age'][$i],
							'patient_gender' => $post['sex'][$i]
						];
						$patientID = $this->Casual_Model->addPatient( $pateintData );
						if( $patientID ){
							$totalTest = count($post['test-'.$uniqueId]);
							for ($j=0; $j < $totalTest ; $j++) {
								$testData =[
									'test'=>$post['test-'.$uniqueId][$j],
									'type_of_shipment'=>$post['typeShipment-'.$uniqueId][$j] ,
									'visit_id' => $visitID,
									'patient_id'=> $patientID
								];
								$isSampleRequested = $this->Master_model->insert('sample_collection' , $testData );
							}

						}
						else{

						}
					}
					$this->session->set_flashdata('success',"Requested");
					redirect('Sample/new_request_sample');
				}else{
					$this->session->set_flashdata('error',"Requested");
					redirect('Sample/new_request_sample');
				}
	}

	public function bulk_upload(){
		$this->loadView('form/bulk_upload' , [] );
	}


	public function add_sample(){
		$post = $this->input->post();
		$insertData = [
			'project_id'=> $post['project_value'],
			'sample_request_by' => $this->session->userdata('log_user')['user_id'],
			'type_of_collection' => $post['type_of_sample_collection'],
			'patient_name' => $post['patient_name'],
			'age' => $post['age'],
			'gender' => $post['sex'],
			'test' => $post['test'],
			'ref_doc_name' => $post['refer_doctor'],
			'location_of_sample_collection' => $post['location'],
			'location_pincode' => $post['pincode'],
			'sample_collection_date' => $post['collection_date'],
			'payment_status' => $post['payment_status'],
			'contact_patient' => $post['pateint_contact'],
			'status' => '1',
		];

		$isSampleRequested = $this->Master_model->insert('sample_collection', $insertData );

		if( $isSampleRequested )
			echo 'Sample Requested';
		else
		  echo 'Sample Not Requested';

	}

	public function view_project(){
    $sql = $this->sqlQueryForViewProject( $this->session->userdata('log_user')['type'] );
		$data['tableData'] = $this->Master_model->rawQuery($sql);
		$this->loadView('view/total_project', $data );
	}

	public function view_sample_details(){
		$this->loadView('view/detail_sample', [] );
	}


	public function add_new_project(){
		echo "<pre>";
		print_r( $this->input->post() );
	}

	public function sendEmail(){
		$this->loadView('form/projectEmail',[] );
	}

	public function edit_project( ){
		$project_id = $this->input->post('project_value');
		$this->loadView('form/edit_project');
	}

	protected function sqlQueryForViewProject( $type ){
		$sql = "SELECT * FROM project";
		$id = $this->session->userdata('log_user')['user_id'] ;
		if( $type == 3 ){
			$sql = "SELECT * FROM project where project_assign_to = {$id}";
			return $sql;
		}
		else{
     return $sql;
		}
	}

}
