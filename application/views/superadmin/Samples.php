<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Samples extends My_Controller{

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
		$sqlQuerys = "SELECT DISTINCT(state) FROM walk_in_details";
		$data['state'] = $this->Master_model->rawQuery( $sqlQuerys );
		$stateQuerys = "SELECT DISTINCT(State) FROM walk_in_details";
		$data['state_Sample'] = $this->Master_model->rawQuery( $stateQuerys );
		$sqlQuery = $this->getSqlQueryForProjectList( $this->session->userdata('log_user')['type'] );
		$data['project_list'] = $this->Master_model->rawQuery( $sqlQuery );
		$this->loadView('form/request_sample_collection' , $data );
	}

	public function request_sample()
	{
		
		$data['payment_type'] = $this->Master_model->select('type_of_payment', null , null , ['status'=>'1' ] );
		$sqlQuerys = "SELECT DISTINCT(state) FROM master_pincode";
		$data['state'] = $this->Master_model->rawQuery( $sqlQuerys );
		$stateQuerys = "SELECT DISTINCT(State) FROM master_pincode";
		$data['state_Sample'] = $this->Master_model->rawQuery( $stateQuerys );
		$sqlQuery = $this->getSqlQueryForProjectList( $this->session->userdata('log_user')['type'] );
		$data['project_list'] = $this->Master_model->rawQuery( $sqlQuery );
		$this->loadView('form/request_sample_collection' , $data );
	}

	public function getSqlQueryForProjectList( $type ){
			$id = $this->session->userdata('log_user')['user_id'] ;
		if( $type == '1')
		return $sql = "SELECT * FROM project WHERE project_status = '1'";
		elseif( $type == '3' || $type == '4')
			return $sql = "SELECT * FROM project_maping pm
                     INNER JOIN project p ON p.project_id = pm.project_id and pm.assigned_to = {$id}";
		else
			return $sql = "SELECT * FROM project p
                      INNER JOIN employee_master em ON em.company_id = p.Company_id AND em.id = {$id}";
	}

	public function collected(){
		$sample_id = $this->input->post('sample_id');
		$this->Master_model->update('sample_collection',['sample_id'=>$sample_id ] , [ 'status'=>'2' ] );
	}

	public function getSampleForm(){
		$data['uniqueId'] = mt_rand(15, 50);
		$data['payment_type'] = $this->Master_model->select('type_of_payment', null , null , ['status'=>'1' ] );
		$project_id = $this->input->post('project_id');
		$sqlQuery = "SELECT tm.* FROM project_available_test pat
                 INNER JOIN test_master tm ON tm.test_id = pat.test_id
                 WHERE pat.project_id ='{$project_id}' AND tm.status = '1' ";
        $sql = "SELECT a.price,b.test_name,b.test_id  FROM `project_available_test` a join test_master b on a.test_id = b.test_id where project_id = '{$project_id}' and a.status = '1' ";
		$data['testList'] = $this->Master_model->rawQuery( $sqlQuery );
		$data['test_mas'] = $this->Master_model->rawQuery( $sql);
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

	public function city_walkin(){
		$text_name = $_GET['text_name'];
		$sql = $this->db->query("select DISTINCT(State) as Sub_Unit,State from master_pincode where State = '{$text_name}' and State not in ('') ");
		$queries = $sql->result();
		echo json_encode( $queries );


	}

	public function citySample_walkin(){
		$text_name = $_GET['text_name'];
		$sql = $this->db->query("select DISTINCT(City) as Sub_Unit,State from master_pincode where State = '{$text_name}' and City not in ('') ");
		$queries = $sql->result();
		echo json_encode( $queries );


	}
	
	 public function locationSample_walkin(){
		$text_name = $_GET['text_name'];
		$city_name = $_GET['city_name'];
		
		$sql = $this->db->query("select DISTINCT(Location_name) as location_name,Location_name from master_pincode where State = '{$text_name}' and City ='{$city_name}'");
		$queries = $sql->result();
		echo json_encode( $queries );
    }

	
	
	
	
	
     public function lap_walkin(){
		$text_name = $_GET['text_name'];
		$city_name = $_GET['city_id'];
		if( $text_name != "Maharashtra" ){
		$sql = $this->db->query("SELECT Name FROM `walk_in_details`  where State = '{$text_name}' and  Sub_Unit='{$city_name}' ");
		$queries = $sql->result();
		echo json_encode( $queries );
		}
		else{
		$sql = $this->db->query("SELECT DISTINCT(location) as location FROM `walk_in_details`  where State = '{$text_name}' and  Sub_Unit='{$city_name}'and location not in ('','NA') ");
		//echo $sql;
		$queries = $sql->result();
		echo json_encode( $queries );
		}



	}
	 public function lap_walkin_location(){
		$text_name = $_GET['text_name'];
		$city_name = $_GET['city_id'];
		$location_name = $_GET['location'];
		$sql = $this->db->query("SELECT Name FROM `walk_in_details`  where State = '{$text_name}' and  Sub_Unit='{$city_name}' and  location='{$location_name}' ");
		$queries = $sql->result();
		echo json_encode( $queries );




	}

	public function lap_Code_walkin(){
		$text_name = $_GET['text_name'];
		$city_name = $_GET['city_id'];
		$lap_name = $_GET['lap_name'];
		$sql = $this->db->query("SELECT Attune_Code,Address FROM `walk_in_details` where state = '$text_name' and Sub_Unit = '$city_name' and Name = '$lap_name'");
		$query = $sql->result();
		echo json_encode($query);
	}

	public function lapSample_walkin(){
		$text_name = $_GET['text_name'];
		$city_name = $_GET['city_id'];
		$sql = $this->db->query("SELECT Pincode FROM `master_pincode` where State = '$text_name' and City = '$city_name' ");
		$query = $sql->result();
		echo json_encode($query);
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
		$data['payment_type'] = $this->Master_model->select('type_of_payment', null , null , ['status'=>'1' ] );
		$project_id = $this->input->post('project_id');
		$sqlQuery = "SELECT tm.* FROM project_available_test pat
                 INNER JOIN test_master tm ON tm.test_id = pat.test_id
                 WHERE pat.project_id ='{$project_id}' AND tm.status = '1' ";
        $sql = "SELECT a.price,b.test_name,b.test_id  FROM `project_available_test` a join test_master b on a.test_id = b.test_id where project_id = '{$project_id}' and a.status = '1' ";
		$data['test_mas'] = $this->Master_model->rawQuery( $sql);
		$data['testList'] = $this->Master_model->rawQuery( $sqlQuery );
		$this->load->view('ajax_form/testList' ,  $data );
	}

	public function total_price(){
		$total_amount =  $this->input->get('query');
		$project_id =   $this->input->get('project_id');
		//$sqlQuery = $this->db->query("update patient set total_amount = '{$total_amount}' where patient_id in ('{$project_id}')");
	}

	public function uploadDocumentFile( $visit_id ){
		$errorRedirectPage = "Samples/request_sample";
		$upload_path = realpath('uploads/request_document/').'/request-id-'.$visit_id;
		if(!is_dir( $upload_path ) ) mkdir($upload_path , 0777 );
		$config =[
									'upload_path'=>$upload_path,
									'allowed_types'=>'pdf|jpg|docx|png|EML',
									'encrypt_name'=>true
						 ];

		$this->load->library('upload',$config);
			if(!$this->upload->do_upload('document_file')){
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata( 'error' , $error->error );
				redirect($errorRedirectPage);
				return '';
			}
			else   return  $this->upload->data()['file_name'];
	}

	public function loadTestForm(){
		$this->load->view('superadmin/form/test_form');
	}

	public function saveVisit(){
		$havingAttachment = false;
		$attachment = [];
		$date_time = $this->input->post('doc');
		$camp_from_date = $this->input->post('camp_from_date');
		$camp_to_date = $this->input->post('camp_to_date');
		$type_coll = $this->input->post('tosc');
		$state1 = $this->input->post('state1');
	  $reported_to = $this->session->userdata('log_user')['user_id'];



		if($state1 == "Maharashtra"){
		$location = $this->input->post('locations_walk');}
		else{
			$location = $this->input->post('locations_walks');
		}
		//echo $location;exit;
		$DateTime = str_replace('T',' ',$date_time);
		$Camp_From_Date = str_replace('T',' ',$camp_from_date);
		$Camp_To_Date = str_replace('T',' ',$camp_to_date);
		$data['test_price'] = array();
		$this->load->model('Casual_Model');
		$post = $this->input->post();
		//print_r($post);exit;
		$requestor_id = $this->session->userdata['log_user']['user_id'];
		$userType  = $this->session->userdata['log_user']['type'];
		if($type_coll == '0'){
		   $visitData = [
		    'project_id' => $post['project_value'],
			'refering_doctor_name'=> $post['refer_doctor'],
			'type_of_collection'=>$post['tosc'],
			'date_of_collection'=>$DateTime,
			'requestor_id'=>$requestor_id,
			'report_to'=>$reported_to,
			'emp_id'=>$reported_to,
			'Representative_name'=>$post['r_name'],
			'Representative_contact'=>$post['r_contact'],
			'Representative_email'=>$post['r_email'],
			'client_id'=>$post['client_id'],
			'client_contact'=>$post['client_contact'],
			'client_email'=>$post['client_email'],
			'clients_name'=>$post['client_name'],
			];
		}
		if($type_coll == '3'){
		$visitData = [
			'project_id' => $post['project_value'],
			'refering_doctor_name'=> $post['refer_doctor'],
			'type_of_collection'=>$post['tosc'],
			'date_of_collection'=>$DateTime,
			'requestor_id'=>$requestor_id,
			'city'=>$post['city1'],
			'location'=>$location,
			'State'=>$post['state1'],
			'Address'=>$post['address1'],
			'Lab_Code'=>$post['lapcode1'],
			'Lab_Name'=>$post['lapname1'],
			'pincode'=>$post['pincode1'],
			'report_to'=>$reported_to,
			'emp_id'=>$reported_to,
			'Representative_name'=>$post['r_name'],
			'Representative_contact'=>$post['r_contact'],
			'Representative_email'=>$post['r_email'],
			'client_id'=>$post['client_id'],
			'client_contact'=>$post['client_contact'],
			'client_email'=>$post['client_email'],
			'clients_name'=>$post['client_name'],

		];
		}
		elseif($type_coll == '4' ){
			$visitData = [
            'project_id' => $post['project_value'],
			'refering_doctor_name'=> $post['refer_doctor'],
			'type_of_collection'=>$post['tosc'],
			'camp_from_date'=>$Camp_From_Date,
			'camp_to_date'=>$Camp_To_Date,
			'number_patient_expected'=>$post['Expected_number'],
			'requestor_id'=>$requestor_id,
			'Hospital_Name'=>$post['hospital_name'],
			'HospitalAddress'=>$post['hospital_address'],
			'ClientContact'=>$post['Client_Contact1'],
			'ClientContactother'=>$post['Client_Contact2'],
			'ClientName'=>$post['client1_name'],
			'ClientNameother'=>$post['client2_name'],
			'ClientEmailAddress'=>$post['client1_email'],
			'ClientEmailAddressOther'=>$post['client2_email'],
			'report_to'=>$reported_to,
			'emp_id'=>$reported_to,
			'Representative_name'=>$post['r_name'],
			'Representative_contact'=>$post['r_contact'],
			'Representative_email'=>$post['r_email'],
			'client_id'=>$post['client_id'],
			'client_contact'=>$post['client_contact'],
			'client_email'=>$post['client_email'],
			'clients_name'=>$post['client_name'],
		];
		}
		else{
			$visitData = [
			'project_id' => $post['project_value'],
			'refering_doctor_name'=> $post['refer_doctor'],
			'type_of_collection'=>$post['tosc'],
			'date_of_collection'=>$DateTime,
			'requestor_id'=>$requestor_id,
			'city'=>$post['city2'],
			'State'=>$post['state2'],
			'Address'=>$post['address2'],
			'pincode'=>$post['pincode2'],
			'report_to'=>$reported_to,
			'emp_id'=>$reported_to,
			'Representative_name'=>$post['r_name'],
			'Representative_contact'=>$post['r_contact'],
			'Representative_email'=>$post['r_email'],
			'client_id'=>$post['client_id'],
			'client_contact'=>$post['client_contact'],
			'client_email'=>$post['client_email'],
			'clients_name'=>$post['client_name'],
		];
		}
		$visitData['visit_unique_id'] = 'R'.date('Ymd').$this->generateUniqueId( 3 );
		$visitID = $this->Casual_Model->scheduleVisit( $visitData );
		// check for document is there or not
				if( $_FILES['document_file']['name'] ) {
					// Document is present attach to email and store to server .
					$havingAttachment = true;
					$visit_id = $visitID;
					$fileName = $this->uploadDocumentFile( $visit_id );
					$attachment_path = $upload_path = realpath('uploads/request_document/').'/request-id-'.$visit_id.'/'.$fileName;
					//pushing attachment path to attachment;
					array_push( $attachment , $attachment_path );
				}

			if( $visitID ){
				$totalPatient = count( $post['patientUniqueId'] );
					for ($i=0; $i<$totalPatient ; $i++){
						$uniqueId = $post['patientUniqueId'][$i];
						$pateintData =[
							'patient_name' => $post['patient_name'][$i],
							'patient_contact' => $post['contact'][$i],
							'patient_email' => $post['email'][$i],
							'visit_id' => $visitID,
							'patient_age' => $post['ages'][$i],
							'patient_gender' => $post['sex'][$i]
						];
						
						$patientarray = array('patient_name'=>$post['patient_name'][$i],'patient_contact'=>$post['contact'][$i]);
						//print_r($pateintData);exit;
						$patientID = $this->Casual_Model->addPatient( $pateintData );
						if( $patientID ){
							$totalTest = count($post['test-'.$uniqueId]);
							for ($j=0; $j < $totalTest ; $j++) {
								$testData =[
									'test'=>$post['test-'.$uniqueId][$j],
									'type_of_shipment'=>$post['typeShipment-'.$uniqueId][$j] ,
									'visit_id' => $visitID,
									'patient_id'=> $patientID,
									'payment_status' => $post['payment_status-'.$uniqueId][$j],
									'test_code'=>$post['test_code-'.$uniqueId][$j],
									'price'=>$post['price-'.$uniqueId][$j],
									'project_id'=>$post['project_value'],
								];
								$isSampleRequested = $this->Casual_Model->sample_collections( $testData );
								$test_id = $post['test-'.$uniqueId][$j];
								$paytype = $post['payment_status-'.$uniqueId][$j];
								//$project_id = $post['project_value-'.$uniqueId][$j];
								$email[] = $post['client_email'];
								$email[] = $post['r_email'];
								$this->sendRequestmail($requestor_id,$userType,$isSampleRequested,$email,$havingAttachment,$attachment,$patientarray);

								/////////////////////////////////////ddd///////////////////////////
								$sql = "SELECT *,c.type_name FROM sample_collection sc
			 					INNER JOIN patient p ON p.patient_id = sc.patient_id
					 			INNER JOIN test_master t ON t.test_id = sc.test
			                    INNER JOIN type_of_payment c on sc.payment_status = c.type_id
			 					WHERE sc.visit_id = '{$visitID}'";
			 				    $testList = $this->Master_model->rawQuery( $sql );
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
							 $data['visit_unique_id'] = $visitData['visit_unique_id'];
							// 	foreach($sql->result_array() as $row ){
							// 	array_push($data['test_price'],$row);
							// }

							}   //$this->loadView('view/request_detail',$data);
						}
						// else{

						// }
					}
					$this->session->set_flashdata('success',"Requested");
					$this->loadView('form/project_totalprice',$data);
					//redirect('Samples/new_request_sample');
				}else{
					$this->session->set_flashdata('error',"Requested");
					redirect('Samples/new_request_sample');
				}
	}

	public function generateUniqueId($length_of_string) {
		// String of all alphanumeric character
		$str_result = '0123456789';
		// Shufle the $str_result and returns substring
		// of specified length
		return substr(str_shuffle($str_result),
											 0, $length_of_string);
	}


	public function saveDocument( $visit_id , $fileName ){
		$this->Master_model->insert('visit_request_file' , ['visit_id'=> $visit_id , 'filename'=> $fileName ]);
	}



	public function sendRequestmail( $userId , $userType , $visitID , $email , $havingAttachment=false ,  $attachment = [],$pateintData ){

	    $toEmail = $this->getEmail( $userType,$userId,$visitID,$email);
		$sql = $this->db->query("select vs.visit_id, vs.visit_unique_id,p.patient_name,p.patient_contact,tm.test_name,vs.refering_doctor_name,vs.clients_name as comp_name,vs.Representative_name,vs.Representative_contact as contacts,vs.phebo_id,vs.contact,tp.type_name,vs.update_at,sc.price,concat(vs.Address,vs.HospitalAddress) as address,vs.city,concat(vs.date_of_collection,',',vs.camp_from_date) as date_of_collection, tc.type,vs.location from visit_schedule vs join sample_collection sc on vs.visit_id = sc.visit_id join patient p on sc.patient_id = p.patient_id join test_master tm on sc.test = tm.test_id JOIN type_of_collection tc on vs.type_of_collection = tc.t_id join type_of_payment tp on tp.type_id = sc.payment_status where sc.sample_id = '$visitID'");

		$query = $sql->result();
							foreach( $query as $key => $rows )
							{
								$visit_id = $rows->visit_id;
								$visit_unique_id = $rows->visit_unique_id;
								$patient_name = $rows->patient_name;
								$patient_contact = $rows->patient_contact ;
								$test_name = $rows->test_name ;
								$refering_doctor_name = $rows->refering_doctor_name ;
								$comp_name = $rows->comp_name ;
								$phebo_id = $rows->phebo_id ;
								$contact = $rows->contact ;
								$update_at = $rows->update_at ;
								$price = $rows->price;
								$address = $rows->address;
								$contacts = $rows->contacts;
								$type = $rows->type;
								$res_name = $rows->Representative_name;
								$b_data = $rows->date_of_collection;
								$payment = $rows->type_name;
								$city = $rows->city;
								$location = $rows->location;
							}


           try{

				$mail = $this->Master_model->configureEmail();
				$mail->AddCC( CC_EMAIL );
				if( $havingAttachment ){
					foreach ($attachment as $key => $value) {
						$mail->addAttachment($value);
					}
				}
           
		   
		   //$email_patients = "";
		   if(!empty($pateintData))
		   {
		     print_r($pateintData);
			 //foreach($pateintData as $key=>$value)
			// {
				 /*$email_patients.= "<tr><td>Patient Name: </td><td>".$value['patient_name']."</td></tr>
									<tr><td>Patient contact No:</td><td>".$value['patient_contact']."</td></tr>";
									*/
									//print_r($key);
									//echo $value['patient_name'];
			// }
			 //print_r($pateintData);
		   }
		   
		   
		   //$subject = "BA Metropolis";
		   $subject = "".$type." for ".$comp_name."/".$city."/".$location."- ".$b_data."";
           $body = "Dear Team<br>

            <p> Please find the Blood collection Details for the below mentioned Patient:<br>
            <table border='1px solid'>
	        <tr><td>Type of Collection:</td><td>". $type."</td></tr>
            <tr><td>Unique ID:</td><td>". $visit_unique_id ."</td></tr>
            ".$email_patients."
			<tr><td>Test Name:</td><td>".$test_name."</td></tr>
            <tr><td>Referred By Dr:</td><td>".  $refering_doctor_name."</td></tr>
            <tr><td>Company:</td><td>".$comp_name."</td></tr>
            <tr><td>Executive Name:</td><td>". $res_name."</td></tr>
            <tr><td>Executive Contact:</td><td>".$contacts."</td></tr>
			<tr><td>Blood Collection Date & Time:</td><td>".$b_data."</td></tr>
			<tr><td>Payment Collected:</td><td>". $price."</td></tr>
            </table>
            <br>Thanks & Regards.<br>metropolis <br>
            <strong>This is automatically generated email,Please do not reply.</strong>";

            if( $toEmail ){
					foreach ($toEmail as $key => $email_id) {
						if ( $this->isValidEmailAddress( $email_id ) ) $mail->addAddress( $email_id );
					}
			}else{ $mail->addAddress( $this->session->userdata['log_user']['email'] ); }

				$mail->Subject = $subject;
				$mail->Body    = $body;
				if($mail->send()){
					//do when mail is sent
					return;
			    }else {
					// Do Exception case coding
					return;
				}

     }
      catch (Exception $e) {
        echo $e->getMessage();//Boring error messages from anything else!
      }
	}

	public function getEmail( $userType , $userId , $visitID , $email ){
		$toEmail = [];
		foreach ($email as $key => $value) {
			 array_push( $toEmail , $value );
		}
	 if( $userType == '10' || $userType == '9' ){
		 	$requestorSqlQuery = "SELECT emp.email as reporting_head_email , em.email as requestor_email , vs.client_email FROM employee_master em
														 INNER JOIN visit_schedule vs on vs.requestor_id = em.id AND vs.visit_id = '{$visitID}'
														 INNER JOIN employee_master emp ON emp.id = em.report_to";
		 $reqData = $this->Master_model->rawQuery( $requestorSqlQuery );
		 $reqData = ( $reqData )?$reqData[0]:[];
		 if( $reqData ){
				 array_push( $toEmail , $reqData->requestor_email );
				 if( $userType == '9' )array_push( $toEmail , $reqData->reporting_head_email ) ;
		 }
    return $toEmail;
	}
	 elseif( $userType == '1'  || $userType == '3'  || $userType == '4' ){
		 $requestorSqlQuery = "SELECT em.email as manager_email  FROM `employee_master` em  WHERE em.type = 10 AND em.company_id IN ( SELECT  p.Company_id from visit_schedule  vs
			 INNER JOIN project p  on p.project_id = vs.project_id
			 WHERE vs.visit_id = {$visitID} )";
		$reqData = $this->Master_model->rawQuery( $requestorSqlQuery );
	   array_push( $toEmail , $this->session->userdata['log_user']['email'] );
		foreach ( $reqData as $key => $value) {
			array_push( $toEmail , $value->manager_email );
		}
		return $toEmail;
	 }
	 else{
		 return [];
	 }

	}



	public function isValidEmailAddress($str) {
    return (!preg_match( "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $str))
        ? FALSE : TRUE;
  }

	public function price_count(){
		$test_id = $_GET['test_id'];
		$payment_id = $_GET['payment_id'];
		$project_id = $_GET['project_id'];
		$sql = $this->db->query("select a.price,a.halfpayment,a.foc ,b.test_code,b.Type_of_shipment , b.vacutainer_type from project_available_test a left join test_master b on a.test_id=b.test_id where  a.test_id='$test_id' and a.project_id='$project_id' and a.status='1' limit 1");

		  $price_count = $sql->result();
		  echo json_encode( $price_count[0] );


	}

	public function cliens(){
		$project_id = $_GET['project_id'];
// 		echo $project_id;exit;
		$query = "select sc.sub_comp_id as comp_id , sc.sub_comp_name as comp_name , em.email as comp_email , em.contact as comp_contact
		from  project p
		join sub_company sc on sc.sub_comp_id = p.sub_company_id
		JOIN employee_master em on em.company_id = p.Company_Id AND em.type = 10
		where p.project_id = '{$project_id}' limit 1";
		$sql = $this->db->query( $query );

		  $price_count = $sql->result();
		  echo json_encode( $price_count[0] );


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
			echo 'Samples Requested';
		else
		  echo 'Samples Not Requested';

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
