<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Task extends My_Controller{

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
	public function request(){
		$id = $this->session->userdata('log_user')['user_id'];
		$sql = "SELECT * FROM  visit_schedule  where phebo_id = '{$id}' and status ='2' ";
		$data['tableData'] = $this->Master_model->rawQuery( $sql );
		$this->loadView('view/today_task' , $data );
	}

	public function bulk_upload(){
		$this->loadView('form/bulk_upload' , [] );
	}

	public function changeStatus(){
		$visitID = $this->input->post('visit');
		$status  = $this->input->post('status');
		$isCompleted = $this->Master_model->update('visit_schedule',['visit_id'=>$visitID] ,['status'=>$status ] );
		redirect('/');
	}

	public function accept_request(){
		$get = $this->input->get();
		if( $get['status'] == '1' ){
			$this->Master_model->update('visit_schedule', ['visit_id'=>$get['requestId'] ] , [ 'isPhelboAssigned'=>'1' , 'status'=>'3' ] );
			redirect('Task/view_task');
		}
		elseif ( $get['status'] == '2' ) {
			$this->Master_model->update('visit_schedule', ['visit_id'=>$get['requestId'] ] , ['status'=>'4' ] );
				redirect('Task/request');
		}

	}

	public function getTodayTask(){
		$todayDate = date('Y-m-d');
		$sqlQuery = "SELECT vs.* FROM phelbo_scheduler ps
									INNER JOIN visit_schedule vs ON vs.visit_id = ps.visit_id
									WHERE ps.phelbo_id = 14 and ps.date = '{$todayDate}'";
		$data['tableData'] = $this->Master_model->rawQuery( $sqlQuery );
	  $this->loadView('view/today_task' , $data );
	}


	public function view_task_details(){
		$visitID = $this->input->get('value');
	  $sql = "SELECT * FROM visit_schedule WHERE visit_id = '{$visitID}'";
		$data['visitData'] = $this->Master_model->rawQuery( $sql )[0];
    $sql = "SELECT sc.* , p.* , t.test_name FROM sample_collection sc
 						INNER JOIN patient p ON p.patient_id = sc.patient_id
						INNER JOIN test_master t ON t.test_id = sc.test
 						WHERE visit_id = '{$visitID}'";
	  $testList = $this->Master_model->rawQuery( $sql );
	  $sql = "SELECT total_amount FROM `visit_schedule` where visit_id = '{$visitID}'";
	  $data['total_price'] =  $this->Master_model->rawQuery( $sql );	

	 	$viewData = [];

	 foreach ($testList as $key => $value) {
		 if( array_key_exists($value->patient_name , $viewData)  ){
			 array_push( $viewData [ $value->patient_name ] , $value );
		 }
		 else{
			 $viewData [ $value->patient_name ] = [];
			 array_push( $viewData [ $value->patient_name ] , $value );
		 }
	 }
    $data['viewData'] = $viewData;
		$this->loadView('view/detail_task',$data);
	}

	public function view_task(){
		$id = $this->session->userdata('log_user')['user_id'];
		$sql = "SELECT * FROM  visit_schedule  where phebo_id = '{$id}' and status ='3' ";
		$data['tableData'] = $this->Master_model->rawQuery( $sql );
		$this->loadView('view/today_task' , $data );
	}


	public function trf_form(){
		$patientID = $this->input->get('id');
		$this->loadView('form/trf_form',[]);
	}

	public function view_sample_details(){
		$this->loadView('view/detail_sample', [] );
	}

	public function track(){
		$track_id = $this->input->get('uniqueTrackId');
		$this->load->view('track/requestTrack');
	}

	public function completed_task( ){
		$sql = "SELECT * FROM  visit_schedule where status ='6' ";
		$data['tableData'] = $this->Master_model->rawQuery( $sql );
		$this->loadView('view/today_task' , $data );
	}

	public function view_requests( ){
		// $sql = "SELECT * FROM  visit_schedule where status ='6' ";
		// $data['tableData'] = $this->Master_model->rawQuery( $sql );
		$this->loadView('view/today_task');
	}

	public function finished_task( ){
		$id = $this->session->userdata('log_user')['user_id'];
		$sql = "SELECT * FROM  visit_schedule where status >='6' and phebo_id = '{$id}' ";
		$data['tableData'] = $this->Master_model->rawQuery( $sql );
		$this->loadView('view/today_task' , $data );
	}

	public function sended_task( ){
		$sql = "SELECT * FROM  visit_schedule where status ='7' ";
		$data['tableData'] = $this->Master_model->rawQuery( $sql );
		$this->loadView('view/today_task' , $data );
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
