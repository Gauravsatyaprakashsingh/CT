<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Request extends My_Controller{

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
	 public function __construct()
	{
		parent::__construct();
			$this->load->model('Status_Updated');
	}

	public function index(){

		 $data['client_list'] = $this->Master_model->select( 'client_master' ,null , null ,['active_status' => '1' ] );
		 $this->loadView('form/project_form' , $data );
	}

	public function new_total_request(){
    $sql = $this->sqlQueryForViewProject( $this->session->userdata('log_user')['type'] );
		$data['tableData'] = $this->Master_model->rawQuery($sql);
		$this->loadView('view/new_total_request', $data );
	}

	public function denied_request(){
		$sql = $this->sqlQueryForDeniedRequest( $this->session->userdata('log_user')['type'] );
		$data['tableData'] = $this->Master_model->rawQuery($sql);
		$this->loadView('view/total_request', $data );
	}

	public function collected_request(){
		$sql = $this->sqlQueryForCollectedRequest( $this->session->userdata('log_user')['type'] );
		$data['tableData'] = $this->Master_model->rawQuery($sql);
		$this->loadView('view/total_request', $data );
	}

	public function total_request(){
		$sql = $this->getSqlForTotalRequest( $this->session->userdata('log_user')['type'] );
		$data['tableData'] = $this->Master_model->rawQuery( $sql );
		$this->loadView('view/total_request' , $data );
	}

	public function getSqlForTotalRequest( $type ){
		$id = $this->session->userdata('log_user')['user_id'];
		$selectStatement = "SELECT em.type,vs.Client_status,vs.visit_id , vs.visit_unique_id , vs.schedule_at , vs.camp_from_date,vs.status,vs.date_of_collection,vs.type_of_collection,vs.clients_name as comp_name,vs.date_of_collection, vs.pincode , vs.State ,vs.city FROM visit_schedule vs  join employee_master em on em.id = vs.emp_id order by visit_id desc";
		$company_id = $this->session->userdata('log_user')['company_id'];
		if( $type == 1  ){
			$sqlQuery = "$selectStatement";
			return $sqlQuery;
		}
		elseif( $type == 3 || $type == 4 ){
			$sqlQuery = "SELECT vs.visit_unique_id ,vs.refering_doctor_name , vs.client_contact,vs.client_id,vs.clients_name,vs.client_email,em.type,vs.Client_status,vs.visit_id , vs.schedule_at ,vs.status, vs.date_of_collection,vs.type_of_collection,vs.clients_name as comp_name,vs.date_of_collection, vs.sisterLabremarkCanceled, vs.camp_from_date, vs.pincode , vs.State ,vs.city FROM visit_schedule vs  join employee_master em on em.id = vs.emp_id where vs.project_id in ( SELECT project_id FROM `project_maping` WHERE assigned_to = '{$id}') OR vs.requestor_id = {$id} order by visit_id desc";
			return $sqlQuery;
		}
		elseif( $type == 7 ){
		    $sqlQuery = "SELECT vs.visit_unique_id , vs.client_contact,vs.client_id,vs.clients_name,vs.client_email,em.type,vs.Client_status,vs.visit_id , vs.schedule_at ,vs.status, vs.date_of_collection,vs.type_of_collection,vs.clients_name as comp_name,vs.date_of_collection, vs.camp_from_date, vs.pincode , vs.State ,vs.city FROM visit_schedule vs  join employee_master em on em.id = vs.emp_id where vs.sisLabassigned_id = '$id' and vs.status not in ('1') order by visit_id desc";
			return $sqlQuery;
		}
		// elseif(  $type == 4  ){
		// 	$sqlQuery = "SELECT vs.visit_unique_id , vs.client_contact,vs.client_id,vs.clients_name,vs.client_email,vs.visit_id , vs.schedule_at ,vs.status, vs.date_of_collection,vs.type_of_collection,vs.clients_name as comp_name,vs.date_of_collection, vs.camp_from_date, vs.pincode , vs.State ,vs.city FROM visit_schedule vs  join employee_master em on em.id = vs.emp_id where vs.requestor_id in ('$id','9') order by visit_id desc";
		// 	return $sqlQuery;
		// }
			elseif(  $type == 2  ){
			$sqlQuery = "SELECT  vs.visit_unique_id , vs.visit_id , vs.schedule_at ,vs.status, vs.date_of_collection,vs.type_of_collection,vs.clients_name as comp_name,vs.date_of_collection, vs.camp_from_date, vs.pincode , vs.State ,vs.city FROM visit_schedule vs  join employee_master em on em.id = vs.emp_id where vs.requestor_id in ('$id') order by visit_id desc";
			return $sqlQuery;
		}
		elseif( $type == 6 || $type == 15 ){
			$sqlQuery = "SELECT vs.visit_unique_id ,vs.State , vs.city , vs.Address, vs.Phelbo_name , vs.contact as phelbo_contact ,  vs.location, vs.client_contact,vs.client_id,vs.clients_name,vs.client_email,vs.status as stat,em.*,vs.type_of_collection,vs.visit_id FROM `employee_master` em join visit_schedule vs on em.id = vs.emp_id where  em.status = '1' and vs.status not in ('1','3','0','13','14','4') and vs.isPhelboAssigned = '$id' order by visit_id desc";
			return $sqlQuery;
		}
		elseif( $type == 16 || $type == 19 ){
			$sqlQuery = "SELECT vs.visit_unique_id ,  vs.State , vs.city ,vs.Logistic_name , vs.contact as logistic_contact , vs.Address, vs.location,vs.clients_name,vs.client_email,vs.status as stat,em.*,vs.type_of_collection,vs.visit_id FROM `employee_master` em join visit_schedule vs on em.id = vs.emp_id where  em.status = '1' and vs.status not in ('1','3','0','13','14','4') and vs.islogisticAssigned = '$id' order by visit_id desc";
			return $sqlQuery;
		}
		elseif ($type == 8 ) {
			$sqlQuery = "$selectStatement WHERE vs.requestor_id IN ( SELECT id FROM `employee_master` em WHERE em.company_id = '{$company_id}' ) OR vs.requestor_id = '{$id}'";
			return $sqlQuery;
		}
		elseif( $type == 9 ){
			// $sqlQuery = "SELECT * FROM visit_schedule vs WHERE vs.requestor_id IN ( SELECT id FROM `employee_master` em WHERE em.company_id = '{$company_id}' AND em.type IN ( 10,11 ) ) OR vs.requestor_id = '{$id}'";
			$sqlQuery = "SELECT vs.visit_unique_id ,vs.refering_doctor_name, vs.client_contact,vs.client_id,vs.clients_name,vs.client_email,em.type,vs.Client_status,vs.visit_id , vs.schedule_at ,vs.status, vs.date_of_collection,vs.type_of_collection,vs.clients_name as comp_name ,vs.date_of_collection, vs.camp_from_date, vs.pincode , vs.State ,vs.city
			FROM visit_schedule vs  join employee_master em on em.id = vs.emp_id where vs.requestor_id in ('$id') order by visit_id";
			return $sqlQuery;
		}
			elseif(  $type == 10){
			// $sqlQuery = "SELECT * FROM visit_schedule vs WHERE vs.requestor_id IN ( SELECT id FROM `employee_master` em WHERE em.company_id = '{$company_id}' AND em.type IN ( 10,11 ) ) OR vs.requestor_id = '{$id}'";
			$sqlQuery = "SELECT  vs.visit_unique_id ,vs.refering_doctor_name, vs.client_contact,vs.client_id,vs.clients_name,vs.client_email,em.type,vs.Client_status,vs.visit_id , vs.schedule_at ,vs.status, vs.date_of_collection,vs.type_of_collection,vs.clients_name as comp_name,vs.date_of_collection, vs.camp_from_date, vs.pincode , vs.State ,vs.city FROM visit_schedule vs  join employee_master em on em.id = vs.emp_id where vs.requestor_id in ( SELECT id FROM employee_master WHERE employee_master.report_to = {$id} ) OR vs.requestor_id = {$id}  order by visit_id";
			return $sqlQuery;
		}
		elseif( $type == 11){
			$sqlQuery = "$selectStatement WHERE vs.requestor_id = '{$id}'";
			return $sqlQuery;
		}
	}

	public function patient_views(){
		  $visitID = $this->input->get('value');
		  
		  $sql = "SELECT * FROM `visit_schedule` vs join patient p on vs.visit_id = p.visit_id where p.visit_id = '{$visitID}'";
		  $data['patient_view'] = $this->Master_model->rawQuery($sql);
		  
		  $sql_query = "SELECT * FROM `visit_schedule` where visit_id='{$visitID}'";
		  $details_visit = $this->Master_model->rawQuery($sql_query);
		  
		  $array_chk = json_decode(json_encode($details_visit[0]), true);
		  $data['type'] = $array_chk['type_of_collection'];
		  $data['unique_id'] = $array_chk['visit_unique_id'];
		  
		  $idsql = $this->db->query("SELECT * FROM `patient` where visit_id = '$visitID' and p_status = '1'");
		  if( $idsql->num_rows() > 0 ){
			   $data['cc'] = '0';
		  }
		  else{
			   $data['cc'] = '1';
		  }
		  $this->loadView('view/patient_view',$data);
	}

	public function cleint_status(){
	    $ids = $_GET['id'];
		$array = array(
			'Client_status'=> '1',
		);
		$Status_Update = $this->Status_Updated->status_change('visit_schedule',['visit_id' => $ids],$array);
		if( $Status_Update ){
          $this->session->set_flashdata('success',"Manager Approved the Request");
          redirect('Request/total_request');
        }
        else{
          $this->session->set_flashdata('error',"Something wents wrong");
          redirect('Request/total_request');
       }
	}
	public function export(){
	    $type =  $this->session->userdata('log_user')['type'] ;
	   //	$id = $this->session->userdata('log_user')['user_id'];
        $date=date(" M-d-Y  ");
        $filename = 'excel'.$date.'.csv';
        $replace=str_replace("_", "/",$filename);
        header("Content-Disposition:attachment;filename=$replace");
        $data=$this->Master_model->export_Report( $type );
        // print_r( $data );exit;
        $file=fopen('php://output','w');
        $header=array("Sr.No","Request received Date and Time","Location","Type of Collection","Patient Name","Age/Gender","Patient Contact No","Address","Client Name","Doctor Name","Test Name","Payment Mode","Client Contact No","Client Email","Collection person Name and Contact Number","Remarks","Current Status","VID");
        fputcsv($file,$header);
        foreach($data as $rows){
          fputcsv($file,array_map('strip_tags', $rows ));
        }
      fclose($file);
      return;
	}

	public function request_detail(){
		$visitID = $this->input->get('value');
	    $sql = "SELECT visit_schedule.*,employee_master.fullname as name FROM visit_schedule 
                INNER JOIN employee_master ON  visit_schedule.requestor_id = employee_master.id 
                WHERE visit_schedule.visit_id = '{$visitID}'";
				  
		$data['visitData'] = $this->Master_model->rawQuery( $sql )[0];
        $sql = "SELECT *,c.type_name FROM sample_collection sc
 					INNER JOIN patient p ON p.patient_id = sc.patient_id
		 			INNER JOIN test_master t ON t.test_id = sc.test
                    INNER JOIN type_of_payment c on sc.payment_status = c.type_id
 					WHERE sc.visit_id = '{$visitID}'";
	   $testList = $this->Master_model->rawQuery( $sql );

	 	$viewData = [];
	  $sql = "SELECT total_amount FROM `visit_schedule` where visit_id = '{$visitID}'";
	  $data['total_price'] =  $this->Master_model->rawQuery( $sql );
	 // SELECT * FROM sample_collection sc
 	// 					INNER JOIN patient p ON p.patient_id = sc.patient_id
		// 				INNER JOIN test_master t ON t.test_id = sc.test
  //                       INNER JOIN type_of_payment c on sc.payment_status = c.type_id
 	// 					WHERE visit_id = '6'

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
		$this->loadView('view/request_detail',$data);
	}



public function patient_detail(){
		$visitID = $this->input->get('value');
		$patID = $this->input->get('pat');
	  $sql = "SELECT * FROM visit_schedule WHERE visit_id = '{$visitID}'";
		$data['visitData'] = $this->Master_model->rawQuery( $sql )[0];
      $sql = "SELECT *,c.type_name FROM sample_collection sc
 					INNER JOIN patient p ON p.patient_id = sc.patient_id
		 			INNER JOIN test_master t ON t.test_id = sc.test
                    INNER JOIN type_of_payment c on sc.payment_status = c.type_id
 					WHERE sc.patient_id = '{$patID}'";
	  $testList = $this->Master_model->rawQuery( $sql );

	 	$viewData = [];
	  $sql = "SELECT total_amount FROM `visit_schedule` where visit_id = '{$visitID}'";
	  $data['total_price'] =  $this->Master_model->rawQuery( $sql );
	 // SELECT * FROM sample_collection sc
 	// 					INNER JOIN patient p ON p.patient_id = sc.patient_id
		// 				INNER JOIN test_master t ON t.test_id = sc.test
  //                       INNER JOIN type_of_payment c on sc.payment_status = c.type_id
 	// 					WHERE visit_id = '6'

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
		$this->loadView('view/request_detail',$data);
	}





	public function view_request(){
		$visitID = $this->input->get('requestId');
		$sql = "SELECT * FROM visit_schedule vs
						LEFT JOIN employee_master em ON em.id = vs.phebo_id
						WHERE visit_id = '{$visitID}'";
		$data['requestData'] = $this->Master_model->rawQuery( $sql )[0];
		$sql = " SELECT  sc.patient_id , p.patient_name , p.patient_contact , p.patient_email , COUNT(*) as total_Sample  FROM sample_collection sc
             INNER JOIN patient p on p.patient_id = sc.patient_id
             WHERE visit_id = '{$visitID}' GROUP BY sc.patient_id";
	  $data['totalPatient'] = $this->Master_model->rawQuery( $sql );
		$this->loadView('view/detail_request', $data );
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
		//$sql = "SELECT * FROM  visit_schedule  where isPhelboAssigned = '0' and status = '1' ";
		$sql = "SELECT vs.* , c.comp_name FROM  visit_schedule as vs
LEFT JOIN project as p on vs.project_id = p.project_id
LEFT JOIN company as c ON p.Company_id = c.comp_id
where vs.isPhelboAssigned = '0' and vs.status = '1'";
     return $sql;
	}

	protected function sqlQueryForDeniedRequest( $type ){
		//$sql = "SELECT * FROM  visit_schedule  where isPhelboAssigned = '0' and status = '4' ";
		$sql = "SELECT vs.* , c.comp_name FROM  visit_schedule as vs
LEFT JOIN project as p on vs.project_id = p.project_id
LEFT JOIN company as c ON p.Company_id = c.comp_id
where vs.isPhelboAssigned = '0' and vs.status = '4'";
     return $sql;
	}

	protected function sqlQueryForCollectedRequest( $type ){
		//$sql = "SELECT * FROM  visit_schedule  where isPhelboAssigned = '1' and status = '5' ";
		$sql = "SELECT vs.* , c.comp_name FROM  visit_schedule as vs
LEFT JOIN project as p on vs.project_id = p.project_id
LEFT JOIN company as c ON p.Company_id = c.comp_id
where vs.isPhelboAssigned = '1' and vs.status = '5'";
		return $sql;
	}






	public function scheduleVisit( ){
    $visitID = $this->input->get('requestId');
		$sql = "SELECT * FROM visit_schedule vs
						LEFT JOIN phlebotomist_master phm ON phm.phlebo_id = vs.phebo_id
						WHERE vs.visit_id = '{$visitID}' and vs.isPhelboAssigned = '0'";
		$data['requestData'] = $this->Master_model->rawQuery( $sql )[0];
		$sql = "SELECT * from employee_master where type = 6";
		$data['phelbo_list'] = $this->Master_model->rawQuery( $sql );
		$this->loadView('form/schedule_visit', $data );
	}

	public function getSlot(){
		$phelboID = $this->input->post('phelbo_id');
		$date = $this->input->post('date');
		$sqlQuery = "SELECT * FROM slot_master WHERE slot_id not in ( SELECT slot_id FROM phelbo_scheduler WHERE phelbo_id = '{$phelboID}' AND date = '{$date}' )";
	  $data['slot_list'] = $this->Master_model->rawQuery( $sqlQuery );
		$this->load->view('ajax_form/phelboslot' , $data );
	}

	public function fix_schedule(){
		$post = $this->input->post();
		$insertData = [
			'phelbo_id' => $post['phelbo_id'],
			'visit_id'=> $post['requestId'],
			'slot_id'=> $post['slot_id'],
			'date'=>$post['date'],
		];
	  $isScheduled =	$this->Master_model->insert('phelbo_scheduler', $insertData );
		if( $isScheduled ){
			$updateData = [
				'phebo_id' => $post['phelbo_id'],
				'pickup_time'=> $post['hour'].':'.$post['min'],
				'status'=> '2'
			];
			$isUpdate =	$this->Master_model->update('visit_schedule',['visit_id'=>$post['requestId'] ], $updateData );
			$this->sendMailtoPhelbotomist( $post['phelbo_id'] );
			redirect( 'Request/new_total_request' );
		}
		else{
			redirect( 'Request/new_total_request' );
		}
	}



	public function sendMailtoPhelbotomist( $phelboID ){
    $phelboEmail = $this->Master_model->select('employee_master',1,null,['id'=>$phelboID ] )[0]->email;
		$subject = "Request For Task";
		$body ="Hello You have new Request";
		$this->mailSend($phelboEmail, $subject , $body);
	}




}
