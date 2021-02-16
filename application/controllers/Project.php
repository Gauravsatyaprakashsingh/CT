<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Project extends My_Controller{

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
		 $data['client_list'] = $this->Master_model->rawQuery( 'SELECT * FROM employee_master em WHERE type = 4' );
		 $sqlQuery = "SELECT * FROM company WHERE status = '1'";
		 $data['company_list'] = $this->Master_model->rawQuery( $sqlQuery );
		 $data['pm_list'] = $this->Master_model->rawQuery( 'SELECT * FROM employee_master em WHERE type = 3' );
		 $this->loadView('form/project_form' , $data );
	}

	public function checkProjectAgreementDate(){
		$project_id = $this->input->post('value');
		$sqlQuery = "SELECT * FROM project WHERE  ( DATE( project_end_date ) >= CURRENT_DATE() AND DATE( project_start_date ) <= CURRENT_DATE() ) AND ( project_status = '1' AND project_id = '{$project_id}')";
    $isDataAvailable = $this->Master_model->rawQuery( $sqlQuery );
		if( $isDataAvailable ){
			echo "true";
		}
		else echo "false";
	}

	public function view_project(){
    $sql = $this->sqlQueryForViewProject( $this->session->userdata('log_user')['type'] );
    //print_r($sql);exit;
		$data['tableData'] = $this->Master_model->rawQuery($sql);
		$this->loadView('view/total_project', $data );
	}

	public function view_test(){
		$project_id = $this->input->post('projects_values');
		$sqlQuery = "SELECT a.project_id,a.price,a.halfpayment,a.foc,a.test_id,a.pat_id,b.test_name,b.test_code,a.client_id FROM `project_available_test` a join test_master b on a.test_id = b.test_id where project_id = '{$project_id}' and a.status = '1'";
		$data['test_lists'] = $this->Master_model->rawQuery( $sqlQuery );
		 $this->LoadView('view/test_view',$data);
	}

	public function edit_AssignedTest(){
		$project_id = $_GET['value'];
		$sql = "SELECT a.project_id,a.test_id,a.pat_id,a.foc,b.test_name,b.test_code,a.client_id,a.price,a.halfpayment FROM `project_available_test` a join test_master b on a.test_id = b.test_id where pat_id = '{$project_id}' and a.status = '1'";
		$data['edit_assigned'] = $this->Master_model->rawQuery( $sql );
		$this->loadView('form/edit_AssignedTest',$data);
	}

	public function update_testPrice(){
		$id = $this->input->post('test_value');
		$post = $this->input->post();
		if(isset($post['Foc_checked'][$i])){
			$check = '0';
			}
			else{
				$check = 'false';
			}
		$data = array(
			'price' => $post['fullpayment'],
			'halfpayment' => $post['halfpayment'],
			'foc' => $check
		);
		$query = $this->Master_model->update('project_available_test',['pat_id'=>$id ],$data);
		if($query){
			$this->session->set_flashdata('success',"Update Successfully");
			redirect('Project/view_project');
		}
		else
		{
			$this->session->set_flashdata('error',"Something wents wrong!. Please try again");
			redirect('Project/view_project');
		}
	}

	public function delete_test(){
		$var = $_GET['value'];
		$sql = $this->db->query("update project_available_test set status = '0' where pat_id='{$var}' ");
		if($sql){
	            $this->session->set_flashdata('success',"Test Deleted Successfully");
				redirect('Project/view_project');
			}
			else {
				$this->session->set_flashdata('error',"Something wents wrong!. Please try again");
				redirect('Project/view_project');
			}
	}
	public function view_project_details(){
		$this->loadView('view/detail_project', [] );
	}

	public function delete_project( ){
    $project_id = $this->input->get('value');
		$isDeleted = $this->Master_model->update('project' , [ 'project_id'=>$project_id ] , [ 'project_status'=>'0' ] );
			if( $isDeleted ){
				$this->session->set_flashdata('success',"Project Deleted");
				redirect('Project/view_project');
			}
			else {
				$this->session->set_flashdata('error',"Something wents wrong!. Please try again");
				redirect('Project/view_project');
			}
	}

	public function add_new_project(){
		$post = $this->input->post();
	 	 $projectData = [
      'project_name' => $post['project_name'],
			'project_created_by' => $this->session->userdata('log_user')['user_id'],
			'project_start_date' => $post['start_date'],
			'project_end_date'  => $post['end_date'],
			'Company_id' => $post['company_id'],
			'sub_company_id' => $post['sub_company_id']
		];

	    $isProjectCreated = $this->Master_model->insert( 'project' , $projectData );
		$project_id = $this->Master_model->lastInsertId();

		$data = array('project_id'=> $project_id,
					  'assigned_by' => $this->session->userdata('log_user')['user_id'],
					  'assigned_to' => $post['company_id']

		);

		$this->db->insert('project_maping',$data);

		$next_data = array('project_id'=> $project_id,
					  'assigned_by' => $this->session->userdata('log_user')['user_id'],
					  'assigned_to' => $post['pm_id']

		);

		$this->db->insert('project_maping',$next_data);

	// 	if( $isProjectCreated ){
	// 		echo "<script>alert('Project created. Assigning to project manager')</script>";

	// 		// foreach ($post['test_list'] as $key => $value) {
	// 		// 	$query = $this->Master_model->insert('project_available_test' ,['project_id'=> $project_id ,'test_id'=> $value ,'client_id'=> $this->session->userdata('log_user')['user_id']] );
	// }
			if($isProjectCreated){
			    redirect('Test/masters_test/'.$project_id."/". $post['company_id']);



			// $this->load->model('Casual_Model');
			// $isMapped = $this->Casual_Model->MapProject( $project_id , $post['pm_id'] , $this->session->userdata('log_user')['user_id'] );
			// if( $isMapped ){
			// 	$this->session->set_flashdata('success',"Project created and assigned to particular project manager");
			// 	redirect('Project');
			// }
			// else{
			// 	$this->session->set_flashdata('error',"Mapping Failed");
			// 	redirect('Project');
			// }
		}
		else{
			$this->session->set_flashdata('error',"Something wents wrong!. Please try again");
			redirect('Project');
		}
	}
	// $insertData = [
	// 	'project_name'=>$post['project_name'],
	// 	'client_code'=> $post['client_code'],
	// 	'project_assign_to' => $post['pm_id'],
	// 	'project_start_date' => $post['start_date'],
	// 	'project_end_date' => $post['end_date'],
	// 	'project_created_by'=>$this->session->userdata('log_user')['user_id']
	// ];
	//
	// $isProjectCreated = $this->Master_model->insert('project' , $insertData );
	// if( $isProjectCreated )
	// redirect('Project');
	// else
	// redirect('Project');

	public function sendEmail(){
		$project_id = $this->input->get('value');
		$sql = "SELECT * FROM  project p
						INNER JOIN client_master cm on cm.client_code = p.client_code
						WHERE p.project_id ='{$project_id}'";
		$data['project'] = $this->Master_model->rawQuery( $sql )[0];
		$this->loadView('form/projectEmail', $data );
	}

	public function Sample_test(){
		$id = $_GET['test_id'];
		$project_id = $_GET['project_id'];

		// $paytype = $_GET['project_id'];
  //       if($paytype == 1){$varcolname = 'price';}elseif ($paytype == 1) {
	 //    $varcolname = 'halfpayment';
  //       }else{$varcolname = 'foc';}
		$sql = "SELECT a.price,b.test_name,b.test_id  FROM `project_available_test` a join test_master b on a.test_id = b.test_id where b.test_id = '{$id}' and a.project_id = '{$project_id}' and a.status='1'";
		$data = $this->Master_model->rawQuery( $sql );
		foreach($data as $row){
			echo $row->price;
		}
  }

	public function edit_project( ){
		$project_id = $this->input->post('project_value');
		$sql = "SELECT * FROM  project p WHERE p.project_id ='{$project_id}'";
		$data['projectData'] = $this->Master_model->rawQuery( $sql )[0];
		$data['client_list'] = $this->Master_model->rawQuery( 'SELECT * FROM employee_master em WHERE type = 4' );
		$sqlQuery = "SELECT * FROM company WHERE status = '1'";
		$data['company_list'] = $this->Master_model->rawQuery( $sqlQuery );
		$data['pm_list'] = $this->Master_model->rawQuery( 'SELECT * FROM employee_master em WHERE type = 3' );
		$this->loadView('form/project_form',$data);
	}

	public function update_project(){
		$post = $this->input->post();
		$id = $post['project_id'];
		$data = array(
			'project_name' => $post['project_name'],
			'project_start_date' => $post['start_date'],
			'project_end_date' => $post['end_date']

		);
		$query = $this->Master_model->update('project',['project_id'=>$id ],$data);
		if($query){
			$this->session->set_flashdata('success',"Update Successfully");
			redirect('Project/view_project');
		}
		else
		{
			$this->session->set_flashdata('error',"Something wents wrong!. Please try again");
			redirect('Project/view_project');
		}
	}

	protected function sqlQueryForViewProject( $type ){
		$id = $this->session->userdata('log_user')['user_id'] ;
		$sql = "SELECT * FROM project_maping pm
						INNER JOIN project p ON p.project_id = pm.project_id
						WHERE pm.assigned_to = '{$id}'";
		if( $type == 1 ){
			$sql = "SELECT * FROM project p WHERE p.project_status = '1'";
			return $sql;
		}
		elseif ($type == 8) {
			$sql = "SELECT * FROM project p WHERE p.project_status = '1' AND p.client_bh_id ='{$id}' ";
			return $sql;
		}
		else{
     return $sql;
		}
	}

	public function assign_to_user( ){
		$data['project_list'] = $this->Common_model->allProject();
		$data['user_list'] = $this->Common_model->allUser();
		$this->loadView( 'form/project_assign_form' , $data );
	}

	public function save_assign_to_user( ){
		$post = $this->input->post();
		$this->load->model('Casual_Model');
		$isProjectMaped = $this->Casual_Model->MapProject( $post['project_value'] , $post['assigned_to'] , $this->session->userdata('log_user')['user_id'] );
		if( $isProjectMaped ){
			$this->session->set_flashdata('success',"Successfully Assigned");
			redirect('Project/assign_to_user');
		}
		else{
			$this->session->set_flashdata('error',"Assigned Failed");
			redirect('Project/assign_to_user');
		}
	}

}
