<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Sample extends My_Controller{

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
	public function new_request_sample(){
		$data['project_value'] = $this->input->get('value');
		$data['payment_type'] = $this->Master_model->select('type_of_payment', null , null , ['status'=>'1' ] );
		$this->loadView('form/request_sample_collection' , $data );
	}

	public function request_sample(){
		$data['payment_type'] = $this->Master_model->select('type_of_payment', null , null , ['status'=>'1' ] );
		$sqlQuery = $this->getSqlQueryForProjectList( $this->session->userdata('log_user')['type'] );
		$data['project_list'] = $this->Master_model->rawQuery( $sqlQuery );
		$this->loadView('form/request_sample_collection' , $data );
	}

	public function getSqlQueryForProjectList( $type ){
			$id = $this->session->userdata('log_user')['user_id'] ;
		if( $type == '1' )
		return $sql = "SELECT * FROM project WHERE project_status = '1' ";
		else
			return $sql = "SELECT * FROM project_maping pm
							INNER JOIN project p ON p.project_id = pm.project_id
							WHERE pm.assigned_to = '{$id}'";
	}

	public function collected(){
		$sample_id = $this->input->post('sample_id');
		$this->Master_model->update('sample_collection',['sample_id'=>$sample_id ] , [ 'status'=>'2' ] );
	}

	public function getSampleForm(){
		$data['uniqueId'] = mt_rand(15, 50);
		$project_id = $this->input->post('project_id');
		$sqlQuery = "SELECT tm.* FROM project_available_test pat
                 INNER JOIN test_master tm ON tm.test_id = pat.test_id
                 WHERE pat.project_id ='{$project_id}' AND tm.status = '1'";
		$data['testList'] = $this->Master_model->rawQuery( $sqlQuery );
		$this->load->view('ajax_form/ajax_sample_request_form' , $data );
	}

	public function total_test(){

		$patientID = $this->input->post('patient_id');
		$visitID = $this->input->post('visit_id');
		$totalTest = $this->Master_model->select('sample_collection',null,null ,['visit_id'=>$visitID , 'patient_id'=>$patientID ] );

		$counter = 1;
		foreach ($totalTest as $key => $value) {
			echo "<tr>
				<td>{$counter}</td>
				<td>{$value->test}</td>
				<td>".$this->getSampleStatus( $value->status )."</td>
			 </tr>
	     ";
	    $counter++;
		}
	}

	public function getSampleStatus( $status ){
		if( $status == '1' ){
			return 'Requested';
		}
		elseif( $status == '2' ){
			return 'Collect From patient';
		}
		elseif( $status == '3' ){
			return 'Submited to Lab';
		}
	}

	public function addMoreTest(){
		$data['uniqueId'] = $this->input->post('uniqueId');
		$project_id = $this->input->post('project_id');
		$sqlQuery = "SELECT tm.* FROM project_available_test pat
                 INNER JOIN test_master tm ON tm.test_id = pat.test_id
                 WHERE pat.project_id ='{$project_id}' AND tm.status = '1' ";
		$data['testList'] = $this->Master_model->rawQuery( $sqlQuery );
		$this->load->view('ajax_form/testList' ,  $data );
	}


	public function saveVisit()
	{
		$this->load->model('Casual_Model');
		$post = $this->input->post();
		$requestor_id=$this->session->userdata['log_user']['user_id'];
		$visitData = ['project_id' => $post['project_value'],
					  'refering_doctor_name'=> $post['refer_doctor'],
					  'payment_percent'=> $post['payment_percent'],
					  'type_of_collection'=>$post['tosc'],
					  'payment_status'=>$post['payment_status'],
					  'location_of_collection'=>$post['loc'],
					  'date_of_collection'=>$post['doc'],
					  'pincode'=>$post['pincode'],
					  'requestor_id'=>$requestor_id];

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
