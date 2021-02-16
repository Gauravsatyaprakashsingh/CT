<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Sister_Request extends My_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Status_Updated');
	}

	public function index(){
		$ids = $_GET['id'];
		$data['id'] = $ids;
		$data['clients_mail'] = $_GET['email'];
		$data['contact'] = $_GET['contact'];
	    //echo $data['contact'];
		$reported_to = $this->session->userdata('log_user')['user_id'];
		//$data['sis_emp'] = $this->Master_model->select( 'employee_master' ,null , null ,['status' => '1' , 'added_by_user' => '15','type' => '13/15'] );
		$sql = "SELECT * FROM `employee_master` where status = '1' and added_by_user = '$reported_to' and type in ( '6' )";
		$data['sis_emp'] = $this->Status_Updated->select_dat( $sql );
		$this->loadView('form/phelbo_form',$data);
	}

	public function denies(){
	   // $ids = $_GET['id'];
	    $remark = $this->input->post('remark_sis');
	    $ids = $this->input->post('id');
	    if( empty( $remark ) ){
	        $this->session->set_flashdata('error',"Field cannot be Empty,please Provide reason of denial request");
            redirect('Request/total_request');
	    }
	    else{
		$array = array(
			'status'=> '3',
			'sisterLabremarkCanceled'=>$remark,
		);
		$Status_Update = $this->Status_Updated->status_change('visit_schedule',['visit_id' => $ids],$array);
		if( $Status_Update ){
          $this->session->set_flashdata('error',"Sister Lab denied requested");
          redirect('Request/total_request');
        }
        else{
          $this->session->set_flashdata('error',"Something wents wrong");
          redirect('Request/total_request');
       }
	    }
	}

	public function denies_start(){
	    $ids = $_GET['id'];
		$array = array(
			'status'=> '14',
		);
		$Status_Update = $this->Status_Updated->status_change('visit_schedule',['visit_id' => $ids],$array);
		if( $Status_Update ){
           $this->session->set_flashdata('error',"Provide Reason in the below field to deny the Request ");
          redirect('Request/total_request');
        }
        else{
           $this->session->set_flashdata('error',"Something wents wrong");
          redirect('Request/total_request');
       }
	}

	public function phelbo_accepted(){
	    $ids = $this->input->post('phelbo_id');
		$array = array(
			'status'=> '6',
		);
		$Status_Update = $this->Status_Updated->status_change('visit_schedule',['visit_id' => $ids],$array);
		if( $Status_Update ){
          // $this->session->set_flashdata('error',"Phlebo Accepted requested");
          redirect('Request/total_request');
        }
        else{
          // $this->session->set_flashdata('error',"Something wents wrong");
          redirect('Request/total_request');
       }
	}

	public function phelbo_denied(){
	    $ids = $this->input->post('phelbos_id');
		$array = array(
			'status'=> '7',
		);
		$Status_Update = $this->Status_Updated->status_change('visit_schedule',['visit_id' => $ids],$array);
		if( $Status_Update ){
          $this->session->set_flashdata('error',"Phlebo denied requested");
          redirect('Request/total_request');
        }
        else{
          $this->session->set_flashdata('error',"Something wents wrong");
          redirect('Request/total_request');
       }
	}

	public function cancelled(){
	    $ids = $_GET['id'];
		$array = array(
			'status'=> '4',
		);
		$Status_Update = $this->Status_Updated->status_change('visit_schedule',['visit_id' => $ids],$array);
		if( $Status_Update ){
          $this->session->set_flashdata('error'," Cancelled requested");
          redirect('Request/total_request');
        }
        else{
          $this->session->set_flashdata('error',"Something wents wrong");
          redirect('Request/total_request');
       }
	}

	public function phelbo_cancelled(){
	    $ids = $_GET['id'];
		$array = array(
			'status'=> '8',
		);
		$Status_Update = $this->Status_Updated->status_change('visit_schedule',['visit_id' => $ids],$array);
		if( $Status_Update ){
          $this->session->set_flashdata('error',"Phlebo Cancelled requested");
          redirect('Request/total_request');
        }
        else{
          $this->session->set_flashdata('error',"Something wents wrong");
          redirect('Request/total_request');
       }
	}

	public function sister_assign_lab(){
	    $post = $this->input->post();
	    $ids = $post['visits_id'];
		$emailid = $post['email'];
		
		$email_id= explode(",",$this->input->post('mail_ids'));
        $email_cc = array(CC_EMAIL);
		$cc = array_merge($email_cc,$email_id);
		$email_count = count($cc);
		
		$array = array(
			'status'=> '13',
			'sisLab_id'=>$post['sister_labs'],
			'sisLabassigned_id'=>$post['ids'],
		);
		$Status_Update = $this->Status_Updated->status_change('visit_schedule',['visit_id' => $ids],$array);
		if( $Status_Update )
		{
		   $sql = $this->db->query("select vs.visit_id,vs.visit_unique_id, p.patient_name,p.patient_contact,tm.test_name,vs.refering_doctor_name,vs.clients_name as comp_name,vs.Representative_name,vs.Representative_contact as contacts,vs.phebo_id,vs.contact,tp.type_name,vs.update_at,sc.price,concat(vs.Address,vs.HospitalAddress) as address,concat(vs.date_of_collection,',',vs.camp_from_date) as date_of_collection,sub_company.sub_comp_code,tc.type,vs.city,vs.location from visit_schedule vs 
									join sample_collection sc on vs.visit_id = sc.visit_id join patient p on sc.patient_id = p.patient_id 
									join test_master tm on sc.test = tm.test_id 
									JOIN type_of_collection tc on vs.type_of_collection = tc.t_id 
									join type_of_payment tp on tp.type_id = sc.payment_status
									join sub_company on sub_company.sub_comp_name = vs.clients_name 
									where vs.visit_id = '$ids'");
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
								$company_name = $rows->comp_name;
								$clientcode = $rows->sub_comp_code;
								$city = $rows->city;
								$location = $rows->location;
							}
           
		$email_patients = "";
		$testarray = array();
		$sql_query = $this->db->query("select patient_id,patient_name,patient_contact FROM patient where visit_id ='$visit_id'");
		$query_patient = $sql_query->result_array();
		if(!empty($query_patient))
		{
			$i =1;
			
			$sqlquerytest = $this->db->query("SELECT test_master.test_name FROM sample_collection 
                   inner join test_master on test_master.test_code = sample_collection.test_code where sample_collection.visit_id ='$visit_id'");
		    $querytest = $sqlquerytest->result_array();
			foreach($querytest as $keys=>$values)
			{
				     $testarray[] = $values['test_name'];
				
			}
			
			foreach($query_patient as $key=>$value)
			{
				$email_patients.= "<tr><td>Patient Name".$i.": </td><td>".$value['patient_name']."</td></tr>
								   <tr><td>Patient contact No".$i.":</td><td>".$value['patient_contact']."</td></tr>";
								   
				$i++;				   
			}
		}
		$commaList = implode(', ', $testarray);
		   
		  $mail = $this->Master_model->configureEmail();
		  //$mail->AddCC(CC_EMAIL);
		  for($i=0;$i<$email_count;$i++)
		  {
			 $mail->AddCC($cc[$i]);
		  }
		  
		  //$subject = "BA Metropolis";
		  $subject = "".$type." for ".$comp_name."/".$city."/".$location."- ".$b_data."";
		  /*$body = "Dear Team<br>

			<p> Please find the Blood collection Details for the below mentioned Patient:<br>
			<table border='1px solid'>
			<tr><td>Type of Collection:</td><td>". $type."</td></tr>
			<tr><td>Unique ID:</td><td>". $visit_unique_id ."</td></tr>
			<tr><td>Patient Name: </td><td>".$patient_name."</td></tr>
			<tr><td>Patient contact No:</td><td>".$patient_contact."</td></tr>
			<tr><td>Test Name:</td><td>".$test_name."</td></tr>
			<tr><td>Referred By Dr:</td><td>".  $refering_doctor_name."</td></tr>
			<tr><td>Company:</td><td>".$comp_name."</td></tr>
			<tr><td>Executive Name:</td><td>". $res_name."</td></tr>
			<tr><td>Executive Contact:</td><td>".$contacts."</td></tr>
			<tr><td>Blood Collection Date & Time:</td><td>".$b_data."</td></tr>
			<tr><td>Payment Collected:</td><td>". $price."</td></tr>
			<tr><td>Client Name:</td><td>". $company_name."</td></tr>
			<tr><td>Client Code:</td><td>". $clientcode."</td></tr>
			</table>
			<br>Thanks & Regards.<br>metropolis <br>
			<strong>This is automatically generated email , please do not reply.</strong>";*/
		  
		  $body = "Dear Team<br>

			<p> Please find the Blood collection Details for the below mentioned Patient:<br>
			<table border='1px solid'>
			<tr><td>Type of Collection:</td><td>". $type."</td></tr>
			<tr><td>Unique ID:</td><td>". $visit_unique_id ."</td></tr>
			".$email_patients."
			<tr><td>Test Name:</td><td>".$commaList."</td></tr>
			<tr><td>Referred By Dr:</td><td>".  $refering_doctor_name."</td></tr>
			<tr><td>Company:</td><td>".$comp_name."</td></tr>
			<tr><td>Executive Name:</td><td>". $res_name."</td></tr>
			<tr><td>Executive Contact:</td><td>".$contacts."</td></tr>
			<tr><td>Blood Collection Date & Time:</td><td>".$b_data."</td></tr>
			<tr><td>Payment Collected:</td><td>". $price."</td></tr>
			<tr><td>Client Name:</td><td>". $company_name."</td></tr>
			<tr><td>Client Code:</td><td>". $clientcode."</td></tr>
			</table>
			<br>Thanks & Regards.<br>metropolis <br>
			<strong>This is automatically generated email , please do not reply.</strong>";
			
		  $mail->addAddress($emailid);
		  $mail->Subject = $subject;
		  $mail->Body  = $body;
		  $mail->send();

		
		
          $this->session->set_flashdata('',"Sister Lab Assigned Successfully");
          redirect('Request/total_request');
        }
        else
		{
           $this->session->set_flashdata('error',"Something wents wrong");
           redirect('Request/total_request');
        }
	}

	public function phelbo_Reached(){
	  $ids = $_GET['id'];
		$array = array(
			'status'=> '5',
		);
		$Status_Update = $this->Status_Updated->status_change('visit_schedule',['visit_id' => $ids],$array);
		if( $Status_Update ){
          $this->session->set_flashdata('success',"Phlebo Reached At Home");
          redirect('Request/total_request');
        }
        else{
          $this->session->set_flashdata('error',"Something wents wrong");
          redirect('Request/total_request');
       }
	}

	public function phelbo_Delivered(){
	    $ids = $_GET['id'];
		$array = array(
			'status'=> '9',
		);
		$Status_Update = $this->Status_Updated->status_change('visit_schedule',['visit_id' => $ids],$array);
		if( $Status_Update ){
          $this->session->set_flashdata('success',"Sample Delivered");
          redirect('Request/total_request');
        }
        else{
          $this->session->set_flashdata('error',"Something wents wrong");
          redirect('Request/total_request');
       }
	}

	public function new_phelbo(){
    $sql = "SELECT * from employee_master em
             INNER JOIN employee_category ec ON ec.category_id = em.type
             where  em.type in ( '6')";
    $data['report_to_list'] = $this->Master_model->rawQuery( $sql );
    $sql = "SELECT category_id as type , label FROM employee_category WHERE category_id not in( 8,9,10,11)";
    $data['label_type'] = $this->Master_model->rawQuery( $sql );
    $data['city_list'] = $this->Master_model->select('zone_state_city');
		 $this->loadView('form/phelbo_form_created',$data);
	}

	public function fetch_data(){
		$id = $_GET['id'];
	    $reported_to = $this->session->userdata('log_user')['user_id'];
		// $sqlQuery = $this->Master_model->select( 'employee_master' ,null , null ,['status' => '1' , 'added_by_user' => '15' , 'id' => $id] );
		$sqlQuery = $this->db->query("select fullname,email,contact,id from employee_master where status = '1' and added_by_user = '$reported_to' and id = '$id' ");
		$query = $sqlQuery->result();
		foreach( $query as $value){
			echo json_encode( $value );
	}



	}


	public function sis_assigneds(){
		$id = $_GET['id'];
		// $sqlQuery = $this->Master_model->select( 'employee_master' ,null , null ,['status' => '1' , 'added_by_user' => '15' , 'id' => $id] );
		$sqlQuery = $this->db->query("select * from sister_lab_masters where status = '1' and sis_id = '$id' ");
		$query = $sqlQuery->result();
// 		foreach( $query as $value){
			echo json_encode( $query );
// 	}

}
	public function Sample_collected(){
		$id = $this->input->post('project_value');
		$ids = $this->input->post('pros_id');
// 		echo $ids;
		$data['ids'] = $ids;
		$data['pat_isd'] = $id;
		$sql = "SELECT p.patient_name,p.total_amount as price,p.visit_id FROM  patient p  where p.patient_id = '$id'";
		$data['patient_name'] = $this->Status_Updated->select_dat( $sql );
	   $this->loadView('form/sample_collected',$data);
	}

	public function Phelbo_insert(){
		$post = $this->input->post();
		$date =  date("Y-m-d h:i:s");
		$email = $post['phel_email'];
		$password = rand(1,100000000);
        $pass = md5( $password );
		ini_set('error_reporting', E_ALL);
        error_reporting( E_ALL );
		$reported_to = $this->session->userdata('log_user')['user_id'];
		$sql =  $this->db->query("select id from employee_master where status = '1' and email = '$email' and type in ( '6' ) ");
	    if( $sql->num_rows() > 0 ){
	     $this->session->set_flashdata('error',"Email Already Exists");
          redirect('Sister_Request/new_phelbo');
	    }
	    else{
	        $mail = $this->Master_model->configureEmail();
					$mail->AddCC( CC_EMAIL );
         $email_id= explode(",",$email);
        $email_count=count($email_id);

        try{
            $subject = "BA Metropolis";
            $body = "Dear ".$post['phel_name']."<br>
            <p>Email :".$email."<br> Password:".$password."</p><br>
           Thanks & Regards.<br>
        This is automatically generated email , please do not reply.";


        for($i=0;$i<$email_count;$i++){
                  $mail->addAddress($email_id[$i]);}
                  $mail->Subject = $subject;
                   $mail->Body    = $body;
                  if($mail->send())
                    {

                    }
                    else {

                    }



     }

        catch (phpmailerException $e) {
        echo $e->errorMessage(); //Pretty error messages from PHPMailer
        } catch (Exception $e) {
        echo $e->getMessage(); //Boring error messages from anything else!
        }
    //
		$array = array(
			'fullname'=>$post['phel_name'],
			'password'=>$pass,
			'email'=>$post['phel_email'],
			'contact'=>$post['phel_num'],
			'pincode'=>'400007',
			'type'=>'6',
			'report_to'=>$reported_to,
			'added_by_user'=>$reported_to,
			'status'=>'1',
			'log_time'=>$date,
		);
		$isUserSaved = $this->Master_model->insert('employee_master',$array);
		if( $isUserSaved ){
          $this->session->set_flashdata('success',"New Phlebo Created");
          redirect('Sister_Request/new_phelbo');
        }
        else{
          $this->session->set_flashdata('error',"Something wents wrong");
          redirect('Sister_Request/new_phelbo');
       }
	}
}
// 	public function insert_pick(){
// 		$post = $this->input->post();
// 		print_r($post);
//       	$password = rand(1,100000000);
//         $pass = md5( $password );
// 		$id = $this->input->post('id_visits');
// 		$email = $post['phel_email'];
// 		ini_set('error_reporting', E_ALL);
//         error_reporting( E_ALL );
// 		$reported_to = $this->session->userdata('log_user')['user_id'];
// 	    $date =  date("Y-m-d h:i:s");
// 	    $sql =  $this->db->query("select id from employee_master where status = '1' and email = '$email' and type in ( '6' ) ");
// 	    $query = $sql->result();
// 	    foreach ($query as $key => $value) {
// 	    	$val_id = $value->id;
// 	    }
// 	    if( $sql->num_rows() > 0 ){
// 	    	$array = array(
// 			'emp_id' => $val_id,
// 			'status'=> '2',
// 			'isPhelboAssigned'=>$val_id,
// 			'Phelbo_name'=>$post['phel_name'],
// 			'phebo_id'=>$post['phel_name'],
// 			'Logistic_id'=>$val_id,
// 			'contact'=>$post['phel_num'],
// 		);
// 		$isUserSaveds = $this->Master_model->update('visit_schedule',['visit_id' => $id],$array);
// 		if( $isUserSaveds ){
//           $this->session->set_flashdata('success',"New Phlebo Created");
//           redirect('Request/total_request');
//         }
//         else{
//           $this->session->set_flashdata('error',"Something wents wrong");
//           redirect('Request/total_request');
//       }
// 	    }
// 	    else{
// 	   $mail = new PHPMailer(true);                              // Passing `true` enables exceptions


//           try {

//             //   $mail->SMTPDebug = 2;                                 // Enable verbose debug output
//               $mail->isSMTP();                                      // Set mailer to use SMTP
//               $mail->Host = 'gateway.metropolisindia.com';                   // Specify main and backup SMTP servers
//               $mail->SMTPAuth = true;                               // Enable SMTP authentication
//               $mail->Username = 'testit@metropolisindia.com';                 // SMTP username
//               $mail->Password = 'Tes@#2020';                           // SMTP password
//               $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
//               $mail->Port = 587;                                    // TCP port to connect to
//               $mail->isHTML(true);                                  // Set email format to HTML
//               $mail->setFrom('testit@metropolisindia.com');

//           }

//          catch (Exception $e) {
//             echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
//             echo $e->getMessage(); //Boring error messages from anything else!
//         }
//          $email_id= explode(",",$email);
//         $email_count=count($email_id);

//         try{
//             $subject = "BA Metropolis";
//             $body = "Dear ".$post['phel_name']."<br>
//             <p>Email :".$email."<br> Password:".$password."</p><br>
//           Thanks & Regards.<br>
//         This is automatically generated email , please do not reply.";


//         for($i=0;$i<$email_count;$i++){
//                   $mail->addAddress($email_id[$i]);}
//                   $mail->Subject = $subject;
//                   $mail->Body    = $body;
//                   if($mail->send())
//                     {

//                     }
//                     else {

//                     }



//      }

//         catch (phpmailerException $e) {
//         echo $e->errorMessage(); //Pretty error messages from PHPMailer
//         } catch (Exception $e) {
//         echo $e->getMessage(); //Boring error messages from anything else!
//         }
//     //
// 		$array = array(
// 			'fullname'=>$post['phel_name'],
// 			'password'=>$pass,
// 			'email'=>$post['phel_email'],
// 			'contact'=>$post['phel_num'],
// 			'pincode'=>'400007',
// 			'type'=>'6',
// 			'report_to'=>$reported_to,
// 			'added_by_user'=>$reported_to,
// 			'status'=>'1',
// 			'log_time'=>$date,
// 		);
// 		$isUserSaved = $this->Master_model->insert('employee_master',$array);
// 		$Inserted = $this->Master_model->lastInsertId();
// 		if( $Inserted ){
// 		$array = array(
// 			'emp_id' => $Inserted,
// 			'status'=> '2',
// 			'isPhelboAssigned'=>$Inserted,
// 			'Phelbo_name'=>$post['phel_name'],
// 			'phebo_id'=>$post['phel_name'],
// 			'Logistic_id'=>$Inserted,
// 			'contact'=>$post['phel_num'],
// 		);
// 		$isUserSaveds = $this->Master_model->update('visit_schedule',['visit_id' => $id],$array);
// 		if( $isUserSaveds ){
//           $this->session->set_flashdata('success',"New Phlebo Created");
//           redirect('Request/total_request');
//         }
//         else{
//           $this->session->set_flashdata('error',"Something wents wrong");
//           redirect('Request/total_request');
//         }
//     }
//     else{
//     	$this->session->set_flashdata('error',"Something wents wrong");
//         redirect('Request/total_request');
//     }
//   }
// }


    public function insert_pick(){
		$post = $this->input->post();
		$log_id = $post['log_id'];
		$id = $this->input->post('id_visits');
		$email = $post['phel_email'];
		$email2 = $post['clients_mailsssss'];
                $client_cons = $post['client_cons'];
// 		echo $email2;
		ini_set('error_reporting', E_ALL);
        error_reporting( E_ALL );
		$reported_to = $this->session->userdata('log_user')['user_id'];
	    $date =  date("Y-m-d h:i:s");

	    $sql =  $this->db->query("select id from phelbooutsource where status = '1' and email = '$email' and type in ( '1' )");
	    $query = $sql->result();
	    foreach ($query as $key => $value) {
 	    	$val_id = $value->id;
 	    }
	    if( $sql->num_rows() > 0 ){
	        	$array = array(
			'emp_id' => $log_id,
			'status'=> '2',
			'isPhelboAssigned'=>$log_id,
			'Phelbo_name'=>$post['phel_name'],
			'phebo_id'=>$post['phel_name'],
			'Logistic_id'=>$log_id,
			'contact'=>$post['phel_num'],
		);
		$isUserSavedss = $this->Master_model->update('visit_schedule',['visit_id' => $id],$array);
		if( $isUserSavedss ){

		$array = array(
	    	'name'=>$post['phel_name'],
			'contact'=>$post['phel_num'],
			'requestor_id'=>$reported_to,
			'Created_Date'=>$date,
			'log_id	'=>$log_id,
		);
		$isUserSaved = $this->Master_model->update('phelbooutsource',['id' => $val_id],$array);

		if( $isUserSaved == 'true' ){
			$sql = $this->db->query("select vs.visit_id,vs.visit_unique_id , p.patient_name,p.patient_contact,tm.test_name,vs.refering_doctor_name, vs.clients_name as comp_name,vs.Representative_name,vs.Representative_contact as contacts,vs.phebo_id,vs.contact,vs.update_at,sc.price,concat(vs.Address,vs.HospitalAddress) as address,concat(vs.date_of_collection,vs.camp_from_date) as date_of_collection, tc.type from visit_schedule vs join sample_collection sc on vs.visit_id = sc.visit_id join patient p on sc.patient_id = p.patient_id join test_master tm on sc.test = tm.test_id  join sister_lab_masters sm on vs.sisLab_id = sm.sis_id join type_of_collection tc on vs.type_of_collection = tc.t_id where vs.visit_id = '$id'");

       $query = $sql->result();
    foreach( $query as $key => $rows ){
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
        // $name = $rows->name;
        $address = $rows->address;
        $contacts = $rows->contacts;
        $type = $rows->type;
        $res_name = $rows->Representative_name;
        $b_data = $rows->date_of_collection;
    }


        //SMS Intregation
    $user="metropolisindia"; //your username
    $password="mhsitadm2012 "; //your password
    $mobilenumbers=$post['phel_num']; //enter Mobile numbers comma seperated
    $message = "Please find the Blood collection Details for the below mentioned Patient:

    Unique ID:". $visit_unique_id ."
    Patient Name:".$patient_name."
    Patient contact No:".$patient_contact."
    Test Name:".$test_name."
    Referred By Dr:".  $refering_doctor_name."
    Company:".$comp_name."
    Executive Name:".$res_name."
    Patient Address:".$address."
    Executive Contact:".$contacts."
    Blood Collection Date & Time:".$b_data."
    Name of Phlebo Personnel for pick up:".$phebo_id."
    Contact number of Phlebo Personnel for pick up::".$contact."
    Dispatched Date & Time:".$update_at."
    Payment Collected:". $price.".

Regards,
Metropolis Team

This is Auto Generated Message. Kindly Do Not reply
"
; //enter Your Message
    $senderid="METLAB"; //Your senderid
    $messagetype="N"; //Type Of Your Message
    $DReports="Y"; //Delivery Reports
    $url="http://www.smscountry.com/SMSCwebservice_Bulk.aspx";
    $message = urlencode($message);
    $ch = curl_init();
    if (!$ch){die("Couldn't initialize a cURL handle");}
    $ret = curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt ($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt ($ch, CURLOPT_POSTFIELDS,
    "User=$user&passwd=$password&mobilenumber=$mobilenumbers&message=$message&sid=$senderid&mtype=$messagetype&DR=$DReports");
    $ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //If you are behind proxy then please uncomment below line and provide your proxy ip with port.
    // $ret = curl_setopt($ch, CURLOPT_PROXY, "PROXY IP ADDRESS:PORT");
    $curlresponse = curl_exec($ch); // execute
    if(curl_errno($ch))
    echo 'curl error : '. curl_error($ch);
    if (empty($ret)) {
    // some kind of an error happened
    die(curl_error($ch));
    curl_close($ch); // close cURL handler
    } else {
    $info = curl_getinfo($ch);
    curl_close($ch); // close cURL handler
    echo $curlresponse; //echo "Message Sent Succesfully" ;
    }

    //second message to client

	//SMS Intregation
    $users="metropolisindia"; //your username
    $passwords="mhsitadm2012 "; //your password
    $mobilenumberss=$client_cons; //enter Mobile numbers comma seperated
    //echo $mobilenumbers;
    $messages = "Please find the Blood collection Details for the below mentioned Patient:

    Unique ID:". $visit_unique_id ."
    Patient Name:".$patient_name."
    Patient contact No:".$patient_contact."
    Test Name:".$test_name."
    Referred By Dr:".  $refering_doctor_name."
    Company:".$comp_name."
    Name of Logistic Personnel for pick up:".$phebo_id."
    Contact number of Logistic Personnel for pick up::".$contact."


Regards,
Metropolis Team

This is Auto Generated Message. Kindly Do Not reply
"
; //enter Your Message
    $senderids="METLAB"; //Your senderid
    $messagetypes="N"; //Type Of Your Message
    $DReportss="Y"; //Delivery Reports
    $url="http://www.smscountry.com/SMSCwebservice_Bulk.aspx";
    $message = urlencode($messages);
    $ch = curl_init();
    if (!$ch){die("Couldn't initialize a cURL handle");}
    $ret = curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt ($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt ($ch, CURLOPT_POSTFIELDS,
    "User=$users&passwd=$passwords&mobilenumber=$mobilenumberss&message=$messages&sid=$senderids&mtype=$messagetypes&DR=$DReportss");
    $ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //If you are behind proxy then please uncomment below line and provide your proxy ip with port.
    // $ret = curl_setopt($ch, CURLOPT_PROXY, "PROXY IP ADDRESS:PORT");
    $curlresponse = curl_exec($ch); // execute
    if(curl_errno($ch))
    echo 'curl error : '. curl_error($ch);
    if (empty($ret)) {
    // some kind of an error happened
    die(curl_error($ch));
    curl_close($ch); // close cURL handler
    } else {
    $info = curl_getinfo($ch);
    curl_close($ch); // close cURL handler
    echo $curlresponse; //echo "Message Sent Succesfully" ;
    }


      // end of second message to client



        try{

					$mail = $this->Master_model->configureEmail();
					$mail->AddCC( CC_EMAIL );
					$email_id= explode(",",$email);
					$email_count=count($email_id);

            $subject = "BA Metropolis-Phelbotonist-Team";
            $body = "Dear ".$post['phel_name']."<br>

              <p> Please find the Blood collection Details for the below mentioned Patient:<br>
              <table border='1px solid'>
            <tr><td>
            Unique ID:</td><td>". $visit_unique_id ."</td></tr>
            <tr><td>
            Patient Name: </td><td>".$patient_name."</td></tr>
            <tr><td>
            Patient contact No:</td><td>".$patient_contact."</td></tr>
            <tr><td>
            Test Name:</td><td>".$test_name."</td></tr>
            <tr><td>
            Referred By Dr:</td><td>".  $refering_doctor_name."</td></tr>
            <tr><td>
            Company:</td><td>".$comp_name."</td></tr>
            <tr><td>
            Executive Name:</td><td>". $res_name."</td></tr>
            <tr><td>
            Sample pick up From:</td><td>".$address."</td></tr>
            <tr><td>
            Executive No:</td><td>".$contacts."</td></tr>
            <tr><td>
            Blood Collection Date & Time:</td><td>".$b_data."</td></tr>
            <tr><td>
            Name of Phlebo Personnel for pick up:</td><td>".$phebo_id."</td></tr>
            <tr><td>
            Contact number of Phlebo Personnel for pick up:</td><td>".$contact."</td></tr>
            <tr><td>
            Dispatched Date & Time:</td><td>".$update_at."</td></tr>
            <tr><td>
            Payment Collected:</td><td>". $price."</td></tr>

            </table>
            <br>
               Thanks & Regards.<br>
               metropolis <br>
        <strong>This is automatically generated email , please do not reply.</strong>";


        for($i=0;$i<$email_count;$i++){
                  $mail->addAddress($email_id[$i]);}
                  $mail->Subject = $subject;
                   $mail->Body    = $body;
                  if($mail->send())
                    {

                    }
                    else {

                    }



     }

        catch (phpmailerException $e) {
        echo $e->errorMessage(); //Pretty error messages from PHPMailer
        } catch (Exception $e) {
        echo $e->getMessage(); //Boring error messages from anything else!
        }
    //

		$mail = $this->Master_model->configureEmail();
		$mail->AddCC( CC_EMAIL );
		$email_id= explode(",",$email2);
		$email_count=count($email_id);

        try{
            // $name = $rows->name;
        $address = $rows->address;
        $contacts = $rows->contacts;
        $type = $rows->type;
        $res_name = $rows->Representative_name;
        $b_data = $rows->date_of_collection;

            $subject = "BA Metropolis-Client-Team";
           $body = "Dear Team<br>

             <p> Please find the Blood collection Details for the below mentioned Patient:<br>
              <table border='1px solid'>
            <tr><td>
            Unique ID:</td><td>". $visit_unique_id ."</td></tr>
            <tr><td>
            Patient Name: </td><td>".$patient_name."</td></tr>
            <tr><td>
            Patient contact No:</td><td>".$patient_contact."</td></tr>
            <tr><td>
            Test Name:</td><td>".$test_name."</td></tr>
            <tr><td>
            Referred By Dr:</td><td>".  $refering_doctor_name."</td></tr>
            <tr><td>
            Company:</td><td>".$comp_name."</td></tr>
            <tr><td>
            Executive Name:</td><td>". $res_name."</td></tr>
            <tr><td>
            Sample pick up From:</td><td>".$address."</td></tr>
            <tr><td>
            Executive No:</td><td>".$contacts."</td></tr>
            <tr><td>
            Blood Collection Date & Time:</td><td>".$b_data."</td></tr>
            <tr><td>
            Name of Phlebo Personnel for pick up:</td><td>".$phebo_id."</td></tr>
            <tr><td>
            Contact number of Phlebo Personnel for pick up:</td><td>".$contact."</td></tr>
            <tr><td>
            Dispatched Date & Time:</td><td>".$update_at."</td></tr>
            <tr><td>
            Payment Collected:</td><td>". $price."</td></tr>

            </table>
            <br>
               Thanks & Regards.<br>
               metropolis <br>
        <strong>This is automatically generated email , please do not reply.</strong>";


        for($i=0;$i<$email_count;$i++){
                  $mail->addAddress($email_id[$i]);}
                  $mail->Subject = $subject;
                   $mail->Body    = $body;
                  if($mail->send())
                    {

                    }
                    else {

                    }



     }

        catch (phpmailerException $e) {
        echo $e->errorMessage(); //Pretty error messages from PHPMailer
        } catch (Exception $e) {
        echo $e->getMessage(); //Boring error messages from anything else!
        }
    //
          $this->session->set_flashdata('success',"New Phlebo Created");
          redirect('Request/total_request');
        }
        else{
          $this->session->set_flashdata('error',"Something wents wrong");
          redirect('Request/total_request');
        }

        }
	    }
	    else{
	    	$array = array(
			'emp_id' => $log_id,
			'status'=> '2',
			'isPhelboAssigned'=>$log_id,
			'Phelbo_name'=>$post['phel_name'],
			'phebo_id'=>$post['phel_name'],
			'Logistic_id'=>$log_id,
			'contact'=>$post['phel_num'],
		);
		$isUserSavedss = $this->Master_model->update('visit_schedule',['visit_id' => $id],$array);
		if( $isUserSavedss ){

		$array = array(
	    	'name'=>$post['phel_name'],
			'email'=>$post['phel_email'],
			'contact'=>$post['phel_num'],
			'requestor_id'=>$reported_to,
			'status'=>'1',
			'Created_Date'=>$date,
			'log_id	'=>$log_id,
			'type'=>'1',
		);
		$isUserSaved = $this->Master_model->insert('phelbooutsource',$array);

		if( $isUserSaved == 'true' ){
		  $sql = $this->db->query("select vs.visit_id,vs.visit_unique_id , p.patient_name,p.patient_contact,tm.test_name,vs.refering_doctor_name, vs.clients_name as comp_name,vs.Representative_name,vs.Representative_contact as contacts,vs.phebo_id,vs.contact,vs.update_at,sc.price,concat(vs.Address,vs.HospitalAddress) as address,concat(vs.date_of_collection,vs.camp_from_date) as date_of_collection, tc.type from visit_schedule vs join sample_collection sc on vs.visit_id = sc.visit_id join patient p on sc.patient_id = p.patient_id join test_master tm on sc.test = tm.test_id  join sister_lab_masters sm on vs.sisLab_id = sm.sis_id join type_of_collection tc on vs.type_of_collection = tc.t_id where vs.visit_id = '$id'");

       $query = $sql->result();
    foreach( $query as $key => $rows ){
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
        // $name = $rows->name;
        $address = $rows->address;
        $contacts = $rows->contacts;
        $type = $rows->type;
        $res_name = $rows->Representative_name;
        $b_data = $rows->date_of_collection;
    }


        //SMS Intregation
    $user="metropolisindia"; //your username
    $password="mhsitadm2012 "; //your password
    $mobilenumbers=$post['phel_num']; //enter Mobile numbers comma seperated
    $message = "Please find the Blood collection Details for the below mentioned Patient:

    Unique ID:". $visit_unique_id ."
    Patient Name:".$patient_name."
    Patient contact No:".$patient_contact."
    Test Name:".$test_name."
    Referred By Dr:".  $refering_doctor_name."
    Company:".$comp_name."
    Executive Name:".$res_name."
    Patient Address:".$address."
    Executive Contact:".$contacts."
    Blood Collection Date & Time:".$b_data."
    Name of Phlebo Personnel for pick up:".$phebo_id."
    Contact number of Phlebo Personnel for pick up::".$contact."
    Dispatched Date & Time:".$update_at."
    Payment Collected:". $price.".

Regards,
Metropolis Team

This is Auto Generated Message. Kindly Do Not reply
"
; //enter Your Message
    $senderid="METLAB"; //Your senderid
    $messagetype="N"; //Type Of Your Message
    $DReports="Y"; //Delivery Reports
    $url="http://www.smscountry.com/SMSCwebservice_Bulk.aspx";
    $message = urlencode($message);
    $ch = curl_init();
    if (!$ch){die("Couldn't initialize a cURL handle");}
    $ret = curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt ($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt ($ch, CURLOPT_POSTFIELDS,
    "User=$user&passwd=$password&mobilenumber=$mobilenumbers&message=$message&sid=$senderid&mtype=$messagetype&DR=$DReports");
    $ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //If you are behind proxy then please uncomment below line and provide your proxy ip with port.
    // $ret = curl_setopt($ch, CURLOPT_PROXY, "PROXY IP ADDRESS:PORT");
    $curlresponse = curl_exec($ch); // execute
    if(curl_errno($ch))
    echo 'curl error : '. curl_error($ch);
    if (empty($ret)) {
    // some kind of an error happened
    die(curl_error($ch));
    curl_close($ch); // close cURL handler
    } else {
    $info = curl_getinfo($ch);
    curl_close($ch); // close cURL handler
    echo $curlresponse; //echo "Message Sent Succesfully" ;
    }

    //second message to client

	//SMS Intregation
    $users="metropolisindia"; //your username
    $passwords="mhsitadm2012 "; //your password
    $mobilenumberss=$client_cons; //enter Mobile numbers comma seperated
    //echo $mobilenumbers;
    $messages = "Please find the Blood collection Details for the below mentioned Patient:

    Unique ID:". $visit_unique_id ."
    Patient Name:".$patient_name."
    Patient contact No:".$patient_contact."
    Test Name:".$test_name."
    Referred By Dr:".  $refering_doctor_name."
    Company:".$comp_name."
    Name of Logistic Personnel for pick up:".$phebo_id."
    Contact number of Logistic Personnel for pick up::".$contact."


Regards,
Metropolis Team

This is Auto Generated Message. Kindly Do Not reply
"
; //enter Your Message
    $senderids="METLAB"; //Your senderid
    $messagetypes="N"; //Type Of Your Message
    $DReportss="Y"; //Delivery Reports
    $url="http://www.smscountry.com/SMSCwebservice_Bulk.aspx";
    $message = urlencode($messages);
    $ch = curl_init();
    if (!$ch){die("Couldn't initialize a cURL handle");}
    $ret = curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt ($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt ($ch, CURLOPT_POSTFIELDS,
    "User=$users&passwd=$passwords&mobilenumber=$mobilenumberss&message=$messages&sid=$senderids&mtype=$messagetypes&DR=$DReportss");
    $ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //If you are behind proxy then please uncomment below line and provide your proxy ip with port.
    // $ret = curl_setopt($ch, CURLOPT_PROXY, "PROXY IP ADDRESS:PORT");
    $curlresponse = curl_exec($ch); // execute
    if(curl_errno($ch))
    echo 'curl error : '. curl_error($ch);
    if (empty($ret)) {
    // some kind of an error happened
    die(curl_error($ch));
    curl_close($ch); // close cURL handler
    } else {
    $info = curl_getinfo($ch);
    curl_close($ch); // close cURL handler
    echo $curlresponse; //echo "Message Sent Succesfully" ;
    }


      // end of second message to client



			$mail = $this->Master_model->configureEmail();
			$mail->AddCC( CC_EMAIL );


         $email_id= explode(",",$email);
        $email_count=count($email_id);

        try{


            $subject = "BA Metropolis-Phelbotonist-Team";
            $body = "Dear ".$post['phel_name']."<br>

              <p> Please find the Blood collection Details for the below mentioned Patient:<br>
              <table border='1px solid'>
            <tr><td>
            Unique ID:</td><td>". $visit_unique_id ."</td></tr>
            <tr><td>
            Patient Name: </td><td>".$patient_name."</td></tr>
            <tr><td>
            Patient contact No:</td><td>".$patient_contact."</td></tr>
            <tr><td>
            Test Name:</td><td>".$test_name."</td></tr>
            <tr><td>
            Referred By Dr:</td><td>".  $refering_doctor_name."</td></tr>
            <tr><td>
            Company:</td><td>".$comp_name."</td></tr>
            <tr><td>
            Executive Name:</td><td>". $res_name."</td></tr>
            <tr><td>
            Sample pick up From:</td><td>".$address."</td></tr>
            <tr><td>
            Executive No:</td><td>".$contacts."</td></tr>
            <tr><td>
            Blood Collection Date & Time:</td><td>".$b_data."</td></tr>
            <tr><td>
            Name of Phlebo Personnel for pick up:</td><td>".$phebo_id."</td></tr>
            <tr><td>
            Contact number of Phlebo Personnel for pick up:</td><td>".$contact."</td></tr>
            <tr><td>
            Dispatched Date & Time:</td><td>".$update_at."</td></tr>
            <tr><td>
            Payment Collected:</td><td>". $price."</td></tr>

            </table>
            <br>
               Thanks & Regards.<br>
               metropolis <br>
        <strong>This is automatically generated email , please do not reply.</strong>";


        for($i=0;$i<$email_count;$i++){
                  $mail->addAddress($email_id[$i]);}
                  $mail->Subject = $subject;
                   $mail->Body    = $body;
                  if($mail->send())
                    {

                    }
                    else {

                    }



     }

        catch (phpmailerException $e) {
        echo $e->errorMessage(); //Pretty error messages from PHPMailer
        } catch (Exception $e) {
        echo $e->getMessage(); //Boring error messages from anything else!
        }
    //

	   	$mail = $this->Master_model->configureEmail();
	   	$mail->AddCC( CC_EMAIL );

         $email_id= explode(",",$email2);
        $email_count=count($email_id);

        try{
            // $name = $rows->name;
        $address = $rows->address;
        $contacts = $rows->contacts;
        $type = $rows->type;
        $res_name = $rows->Representative_name;
        $b_data = $rows->date_of_collection;

            $subject = "BA Metropolis-Client-Team";
           $body = "Dear Team<br>

              <p> Please find the Blood collection Details for the below mentioned Patient:<br>
              <table border='1px solid'>
            <tr><td>
            Unique ID:</td><td>". $visit_unique_id ."</td></tr>
            <tr><td>
            Patient Name: </td><td>".$patient_name."</td></tr>
            <tr><td>
            Patient contact No:</td><td>".$patient_contact."</td></tr>
            <tr><td>
            Test Name:</td><td>".$test_name."</td></tr>
            <tr><td>
            Referred By Dr:</td><td>".  $refering_doctor_name."</td></tr>
            <tr><td>
            Company:</td><td>".$comp_name."</td></tr>
            <tr><td>
            Executive Name:</td><td>". $res_name."</td></tr>
            <tr><td>
            Sample pick up From:</td><td>".$address."</td></tr>
            <tr><td>
            Executive No:</td><td>".$contacts."</td></tr>
            <tr><td>
            Blood Collection Date & Time:</td><td>".$b_data."</td></tr>
            <tr><td>
            Name of Phlebo Personnel for pick up:</td><td>".$phebo_id."</td></tr>
            <tr><td>
            Contact number of Phlebo Personnel for pick up:</td><td>".$contact."</td></tr>
            <tr><td>
            Dispatched Date & Time:</td><td>".$update_at."</td></tr>
            <tr><td>
            Payment Collected:</td><td>". $price."</td></tr>

            </table>
            <br>
               Thanks & Regards.<br>
               metropolis <br>
        <strong>This is automatically generated email , please do not reply.</strong>";


        for($i=0;$i<$email_count;$i++){
                  $mail->addAddress($email_id[$i]);}
                  $mail->Subject = $subject;
                   $mail->Body    = $body;
                  if($mail->send())
                    {

                    }
                    else {

                    }



     }

        catch (phpmailerException $e) {
        echo $e->errorMessage(); //Pretty error messages from PHPMailer
        } catch (Exception $e) {
        echo $e->getMessage(); //Boring error messages from anything else!
        }
    //
          $this->session->set_flashdata('success',"New Phlebo Created");
          redirect('Request/total_request');
        }
        else{
          $this->session->set_flashdata('error',"Something wents wrong");
          redirect('Request/total_request');
        }

        }
    }
}

	public function assign_pickup_request(){
			//create OutSource logistic or Frencishise logistic and assgin login to sister lab
			$post = $this->input->post();
			$log_id = $this->createLogistic($post['log_id'],$post['pickup_type']);
			
			$email_id = explode(",",$post['mail_ids']);
			$email_cc = array(CC_EMAIL);
			$cc = array_merge($email_cc,$email_id);
			
			
			if( $log_id ){
				$logisticUserData = $this->insertNewPhelboOutsource( $post['phel_email'] , $post['phel_name'] , $post['phel_num'] , $log_id , $log_id , '1' );
				if( $logisticUserData ){
				$updateData = [
					'emp_id' => $log_id,
					'status'=> '2',
					'isPhelboAssigned'=>$log_id,
					'Phelbo_name'=>$logisticUserData->name,
					'phebo_id'=>$logisticUserData->id,
					'Logistic_id'=>$log_id,
					'contact'=>$logisticUserData->contact,
				];
				$updateScehudleVisit = $this->Master_model->update('visit_schedule', ['visit_id'=> $post['id_visits'] ], $updateData  );
				if( $updateScehudleVisit ){
					//sendMail to Logistic user which is given email by sisLab
					$this->sendPickupEmailToPickUpGuy($post['id_visits'],$logisticUserData->email,$logisticUserData->name,$logisticUserData->contact,$cc);
					$this->sendPickupEmailToClient( $post['id_visits'] );
					$this->session->set_flashdata('success',"Assigned to {$logisticUserData->name} ");
					redirect('Request/total_request');
				}
				else{
					$this->session->set_flashdata('error',"Something Went Wrong");
					redirect('Request/total_request');
				}
			 }
			 else{
				 $this->session->set_flashdata('error',"Something Went Wrong");
				 redirect('Request/total_request');
			 }
		 }
			else{
				$this->session->set_flashdata('error',"Something wents wrong");
				redirect('Request/total_request');
			}
	}

	public function search_logistic( $logistic_email , $type = 2  ){
		$logisticQuery = "SELECT * FROM `phelbooutsource` WHERE email = '{$logistic_email}' AND ( type = {$type} AND status = '1' )";
		$logisticData = $this->Master_model->rawQuery( $logisticQuery );
		if( $logisticData ){
			return $logisticData;
		}
		else{
			return [];
		}
	}

	public function createLogistic( $login_id , $type ){
	 	$login_user_data = $this->Master_model->select('employee_master',null,null ,[ 'id'=> $login_id , 'status' =>'1' ] );
	   $password = rand(1,100000000);
	 	if( $login_user_data ){
	 			$login_user_data = $login_user_data[0];
	 		  $userQuery = "select id from employee_master where status = '1' and email = '{$login_user_data->email}' and type = {$type}";
	 		   if(  $isUserAlreadyPresent = $this->Master_model->rawQuery( $userQuery ) ) {
	           return $isUserAlreadyPresent[0]->id;
	 			 }
	 			 else{
	 						 $array = array(
	 							 'fullname'=>$login_user_data->fullname,
	 							 'password'=>md5( $password ),
	 							 'email'=>$login_user_data->email,
	 							 'contact'=>$login_user_data->contact,
	 							 'pincode'=>$login_user_data->pincode,
	 							 'type'=>$type,
	 							 'report_to'=>$login_id,
	 							 'added_by_user'=>$login_id,
	 							 'status'=>'1',
	 							 'log_time'=>date("Y-m-d h:i:s"),
	 						 );
	 						 $isLogisticCreated = $this->Master_model->insert('employee_master' , $array );
	 						 if( $isLogisticCreated ){
	 							 $this->sendNewUserCredential( $login_user_data->fullname ,  $login_user_data->email , $password );
	 							 return $this->Master_model->lastInsertId();
	 						 }
	 			 }
	 	}
	 	else{
	      return false;
	 	}
	}

	public function sendNewUserCredential( $name , $email_id , $password  ){
			$mail = $this->Master_model->configureEmail();
			$mail->addAddress( $email_id );
			$mail->Subject = "BA Logistic Credentials";
			$mail->Body    =  "Dear {$name} , <br>
		             <p>Email : $email_id <br> Password:". $password."</p><br>
			         Thanks & Regards.<br>
			        This is automatically generated email , please do not reply.";
			if($mail->send()){
	      return true;
			}
			else return false;
	}

	public function insertNewPhelboOutsource( $logistic_email , $logistic_name , $logistic_contact , $log_id , $requestor_id , $type ){
		$isPresent = $this->search_logistic( $logistic_email  , $type );
		if( ! $isPresent ){
			$data = [
				'log_id' => $log_id,
				'name' => $logistic_name,
				'email' => $logistic_email,
				'contact' => $logistic_contact,
				'requestor_id' => $log_id,
				'status' => '1',
				'type' => $type
			];
			$isCreated = $this->Master_model->insert('phelbooutsource' , $data );
			if( $isCreated ){
				$data['id'] = $this->Master_model->lastInsertId();
				return (object)$data;
			}
			else return [];
		}
		else return $isPresent[0];
	}

	public function sendPickupEmailToPickUpGuy($visit_id,$logistic_email,$name,$pick_upcontact,$cc){
		$sql = $this->db->query("select vs.visit_unique_id , vs.visit_id,p.patient_name,p.patient_contact,tm.test_name,vs.refering_doctor_name, vs.clients_name as comp_name,vs.Representative_name,vs.Representative_contact as contacts,vs.phebo_id,vs.contact,vs.update_at,sc.price,concat(vs.Address,vs.HospitalAddress)  as address,concat(vs.date_of_collection,vs.camp_from_date) as date_of_collection, tc.type,vs.city,vs.location from visit_schedule vs join sample_collection sc on vs.visit_id = sc.visit_id join patient p on sc.patient_id = p.patient_id join test_master tm on sc.test = tm.test_id  join sister_lab_masters sm on vs.sisLab_id = sm.sis_id join type_of_collection tc on vs.type_of_collection = tc.t_id where vs.visit_id = '$visit_id'");

		$query = $sql->result();
				foreach( $query as $key => $rows ){
						$unique_id = $rows->visit_unique_id;
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
						$city = $rows->city;
			            $location = $rows->location;
				}

				$mail = $this->Master_model->configureEmail();
				$mail->addAddress( $logistic_email );
				$email_count = count($cc);
				for($i=0;$i<$email_count;$i++)
				{
				  $mail->AddCC($cc[$i]);
				}
				//$mail->AddCC( CC_EMAIL );
				//$subject = "Logistic-Team";
				$subject = "Logistic-Team".$type." for ".$comp_name."/".$city."/".$location."- ".$b_data."";
				$body = "Dear ".$name."<br>
                <p> Please find the Blood collection Details for the below mentioned Patient:<br>
				<table border='1px solid'>
				<tr><td>Unique ID:</td><td>". $unique_id ."</td></tr>
				<tr><td>Patient Name: </td><td>".$patient_name."</td></tr>
				<tr><td>Patient contact No:</td><td>".$patient_contact."</td></tr>
				<tr><td>Test Name:</td><td>".$test_name."</td></tr>
				<tr><td>Referred By Dr:</td><td>".  $refering_doctor_name."</td></tr>
				<tr><td>Company:</td><td>".$comp_name."</td></tr>
				<tr><td>Executive Name:</td><td>". $res_name."</td></tr>
				<tr><td>Sample pick up From:</td><td>".$address."</td></tr>
				<tr><td>Executive No:</td><td>".$contacts."</td></tr>
				<tr><td>Blood Collection Date & Time:</td><td>".$b_data."</td></tr>
				<tr><td>Name of Logistic Personnel for pick up:</td><td>".$phebo_id."</td></tr>
				<tr><td>Contact number of Logistic Personnel for pick up:</td><td>".$contact."</td></tr>
				<tr><td>Dispatched Date & Time:</td><td>".$update_at."</td></tr>
				<tr><td>Payment Collected:</td><td>". $price."</td></tr>
                </table>
				<br>Thanks & Regards.<br>metropolis <br>
		        <strong>This is automatically generated email , please do not reply.</strong>";

				$mail->Subject = $subject;
				$mail->Body    = $body;
				$textMessage = "Please find the Blood collection Details for the below mentioned Patient:

		    Unique ID:". $unique_id ."
		    Patient Name:".$patient_name."
		    Patient contact No:".$patient_contact."
		    Test Name:".$test_name."
		    Referred By Dr:".  $refering_doctor_name."
		    Company:".$comp_name."
		    Executive Name:".$res_name."
		    Patient Address:".$address."
		    Executive Contact:".$contacts."
		    Blood Collection Date & Time:".$b_data."
		    Name of Logistic Personnel for pick up:".$phebo_id."
		    Contact number of Logistic Personnel for pick up:".$contact."
		    Dispatched Date & Time:".$update_at."
		    Payment Collected:". $price.".

		Regards,
		Metropolis Team

		This is Auto Generated Message. Kindly Do Not reply";
		$this->sendTextMessage( $textMessage , $pick_upcontact );
		if($mail->send()){}
		else {}
	}

	public function testSMS(){
		$textMessage = "Please find the Blood collection Details for the below mentioned Patient:

		Unique ID:R230424556677
		Patient Name:Nitin Singh
		Patient contact No:9167291114
		Test Name: TA
		Referred By Dr: Swati
		Company:VOy_2020
		Executive Name:Suraj Patwa
		Patient Address:Satrastha
		Executive Contact:1234567890
		Blood Collection Date & Time:23/23/2020 1:35:00
		Name of Logistic Personnel for pick up: Dharamveer
		Contact number of Logistic Personnel for pick up:38686826863826
		Dispatched Date & Time:23/23/2300
		Payment Collected: 1500.

Regards,
Metropolis Team

This is Auto Generated Message. Kindly Do Not reply";
$response = $this->sendTextMessage( $textMessage , '9167291114' );
var_dump( $response );
	}

	public function sendPickupEmailToClient(  $visit_id  ){
	  $sql = $this->db->query("select vs.visit_unique_id ,  vs.visit_id,p.patient_name,p.patient_contact,tm.test_name,vs.refering_doctor_name, vs.client_email ,vs.client_contact , vs.clients_name as comp_name,vs.Representative_name,vs.Representative_contact as contacts,vs.phebo_id,vs.contact,vs.update_at,sc.price,concat(vs.Address,vs.HospitalAddress)  as address,concat(vs.date_of_collection,vs.camp_from_date) as date_of_collection, tc.type from visit_schedule vs join sample_collection sc on vs.visit_id = sc.visit_id join patient p on sc.patient_id =    p.patient_id join test_master tm on sc.test = tm.test_id  join sister_lab_masters sm on vs.sisLab_id = sm.sis_id join type_of_collection tc on vs.type_of_collection = tc.t_id where vs.visit_id = '$visit_id'");

	  $query = $sql->result();
	      foreach( $query as $key => $rows ){
						$unique_id = $rows->visit_unique_id;
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
	          $client_email = $rows->client_email;
						$client_contact = $rows->client_contact;
	      }


	  $mail = $this->Master_model->configureEmail();
	  $mail->AddCC( CC_EMAIL );
	      try{

	          $subject = "BA Metropolis-Client-Team";
	         $body = "Dear team<br>

	            <p> Please find the Blood collection Details for the below mentioned Patient:<br>
	            <table border='1px solid'>
	          <tr><td>
	          Unique ID:</td><td>". $unique_id ."</td></tr>
	          <tr><td>
	          Patient Name: </td><td>".$patient_name."</td></tr>
	          <tr><td>
	          Patient contact No:</td><td>".$patient_contact."</td></tr>
	          <tr><td>
	          Test Name:</td><td>".$test_name."</td></tr>
	          <tr><td>
	          Referred By Dr:</td><td>".  $refering_doctor_name."</td></tr>
	          <tr><td>
	          Company:</td><td>".$comp_name."</td></tr>
	          <tr><td>
	          Executive Name:</td><td>". $res_name."</td></tr>
	          <tr><td>
	          Sample pick up From:</td><td>".$address."</td></tr>
	          <tr><td>
	          Executive No:</td><td>".$contacts."</td></tr>
	          <tr><td>
	          Blood Collection Date & Time:</td><td>".$b_data."</td></tr>
	          <tr><td>
	          Name of Logistic Person for pick up:</td><td>".$phebo_id."</td></tr>
	          <tr><td>
	          Contact number of Logistic Person for pick up:</td><td>".$contact."</td></tr>
	          <tr><td>
	          Dispatched Date & Time:</td><td>".$update_at."</td></tr>
	          <tr><td>
	          Payment Collected:</td><td>".$price."</td></tr>

	          </table>
	          <br>
	             Thanks & Regards.<br>
	             metropolis <br>
	      <strong>This is automatically generated email , please do not reply.</strong>";

	      $mail->addAddress( $client_email );
	      $mail->Subject = $subject;
	      $mail->Body    = $body;
				$textMessage ="Please find the Blood collection Details for the below mentioned Patient:

				    Unique ID:". $unique_id ."
				    Patient Name:".$patient_name."
				    Patient contact No:".$patient_contact."
				    Test Name:".$test_name."
				    Referred By Dr:".  $refering_doctor_name."
				    Company:".$comp_name."
				    Name of Logistic Personnel for pick up:".$phebo_id."
				    Contact number of Logistic Personnel for pick up::".$contact."


				Regards,
				Metropolis Team

				This is Auto Generated Message. Kindly Do Not reply
				";
				$this->sendTextMessage( $textMessage , $client_contact );
	        if($mail->send()){}
	        else {}
		}
		catch (Exception $e) {
		echo $e->getMessage(); //Boring error messages from anything else!
		}
  }

	public function sendTextMessage( $message , $contact ){
		$user="metropolisindia"; //your username
		$password="mhsitadm2012 "; //your password
		$senderid="METLAB"; //Your senderid
		$messagetype="N"; //Type Of Your Message
		$DReports="Y"; //Delivery Reports
		$url="http://www.smscountry.com/SMSCwebservice_Bulk.aspx";
		$message = urlencode($message);
			$curl = curl_init();
			curl_setopt_array($curl, array(
		  																CURLOPT_URL =>$url,
		  																CURLOPT_RETURNTRANSFER => true,
		  																CURLOPT_ENCODING => "",
		  																CURLOPT_MAXREDIRS => 10,
		  																CURLOPT_TIMEOUT => 30,
		  																CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  																CURLOPT_CUSTOMREQUEST => "POST",
		  																CURLOPT_POSTFIELDS => "User=$user&passwd=$password&mobilenumber=$contact&message=$message&sid=$senderid&mtype=$messagetype&DR=$DReports",
		  														  	CURLOPT_HTTPHEADER => array(
		    																													"cache-control: no-cache",
		    																													"content-type: application/x-www-form-urlencoded",
		    																													"postman-token: d3382794-94e7-e929-fbf6-d5c2a94846ab"
		  																												),
				));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		//var_dump( $err );
		curl_close($curl);
		if ( $err ) {
		  var_dump("cURL Error #:" . $err) ;
		} else {
		  return $response;
		}

	}

	public function vid_registration(){
		$id = $_GET['id'];
		$data['ids'] = $id;
		$data['is'] = $this->input->get('type');
		$sql = "select client_email,v_id_number,payment_mode,Remarks,Comment,History from visit_schedule where visit_id = '$id'";
		$data['vid_registe'] = $this->Status_Updated->select_dat( $sql );
		$this->loadView('form/vid_registration',$data);
	}

	public function vid_insert(){
		$id = $this->input->post('visi_id');
		$tys = $this->input->post('visi_type');
		$post = $this->input->post();
		$vid = $post['vid_id'];
		$email = $post['idss'];
		 	ini_set('error_reporting', E_ALL);
        error_reporting( E_ALL );
		$reported_to = $this->session->userdata('log_user')['user_id'];

	    $array = array(
	    	'v_id_number'=>$post['vid_id'],
	    	'Payment_mode'=>$post['payment_mode'],
	    	'Remarks'=>$post['remarks'],
	    	'Comment'=>$post['Comment'],
	    	'History'=>$post['History'],
			);
	    $isUserSaveds = $this->Master_model->update('visit_schedule',['visit_id' => $id],$array);
	     if( $isUserSaveds ){
		 if( $tys != '3' ){
		 $sql = $this->db->query("select vs.visit_id, vs.visit_unique_id ,ems.fullname,vs.update_at,vs.location,vs.date_of_collection,p.patient_name,p.patient_gender,p.patient_age,pj.project_name,p.patient_contact,vs.refering_doctor_name,scs.Sample_collected,tm.test_name,tps.type_name,vs.Remarks ,su.status_type ,vs.Comment,ems.fullname from visit_schedule vs join sample_collection sc on vs.visit_id = sc.visit_id join patient p on sc.patient_id = p.patient_id join test_master tm on sc.test = tm.test_id  join sister_lab_masters sm on vs.sisLab_id = sm.sis_id join type_of_collection tc on vs.type_of_collection = tc.t_id join project pj on vs.project_id = pj.project_id join sample_collect scs on scs.visit_id = vs.visit_id join type_of_payment tps on tps.type_id = vs.payment_status join employee_master ems on vs.requestor_id = ems.id join status_update su on vs.status = su.status_id where vs.visit_id='$id'");
       }
	   else{
		$sql = $this->db->query("select vs.visit_id, vs.visit_unique_id ,ems.fullname,vs.update_at,vs.location,vs.date_of_collection,p.patient_name,p.patient_gender,p.patient_age,pj.project_name,p.patient_contact,vs.refering_doctor_name,tm.test_name,tps.type_name,vs.Remarks ,su.status_type ,vs.Comment,ems.fullname from visit_schedule vs join sample_collection sc on vs.visit_id = sc.visit_id join patient p on sc.patient_id = p.patient_id join test_master tm on sc.test = tm.test_id  join sister_lab_masters sm on vs.sisLab_id = sm.sis_id join type_of_collection tc on vs.type_of_collection = tc.t_id join project pj on vs.project_id = pj.project_id  join type_of_payment tps on tps.type_id = vs.payment_status join employee_master ems on vs.requestor_id = ems.id join status_update su on vs.status = su.status_id where vs.visit_id='$id'");
	   }
       $query = $sql->result();
    foreach( $query as $key => $rows ){
        $visit_id = $rows->visit_id;
				$visit_unique_id = $rows->visit_unique_id;
        $dispatch = $rows->update_at;
        $location = $rows->location;
        $date_collectiom = $rows->date_of_collection;
        $patient_name = $rows->patient_name;
        $patient_gender = $rows->patient_gender;
        $patient_age = $rows->patient_age;
        $project_name = $rows->project_name;
        $patient_contact = $rows->patient_contact ;
        $refering_doctor_name = $rows->refering_doctor_name ;
        $Sample_collected = $rows->Sample_collected;
        $test_name = $rows->test_name;
        $type_name = $rows->type_name;
        $Remarks = $rows->Remarks;
	      $statusw = $rows->status_type;
        $Comment = $rows->Comment;
        $fullname = $rows->fullname;
        }

				$mail = $this->Master_model->configureEmail();
				$mail->AddCC( CC_EMAIL );


         $email_id= explode(",",$email);
        $email_count=count($email_id);

        try{


            $subject = "BA Metropolis";
            $body = "Dear Team<br>

              <p> We have registered the following sample. VID is ".$vid."<br><br>
              <table border='1px solid'>
              <tr>
              <th>Accession Number</th>
              <th> Dispatch Datetime</th>
              <th>Location</th>
              <th>Collection date_time</th>
              <th>Subject Details</th>
              <th>Gender</th>
              <th>Age</th>
              <th>Project Name</th>
              <th>Subject contact no</th>
              <th>Doctor Name</th>
              <th>Trf Received</th>
              <th>Test name</th>
              <th>Payment received</th>
              <th>Remark</th>
	      <th>Status</th>
              <th>Comment</th>
              <th>Coordinator Name</th>
              </tr>
            <tr>
            <td>".$visit_unique_id ."</td>

           <td>".$dispatch."</td>

            <td>".$location."</td>

            <td>".$date_collectiom."</td>

            <td>".$patient_name."</td>

            <td>".$patient_gender."</td>

            <td>". $patient_age."</td>

            <td>". $project_name."</td>

            <td>".$patient_contact."</td>

            <td>".$refering_doctor_name."</td>

            <td>".$Sample_collected."</td>

            <td>".$test_name ."</td>

            <td>".$type_name."</td>

            <td>". $Remarks."</td>
	    <td>".$statusw."</td>
            <td>".$Comment."</td>
            <td>". $fullname."</td>
            </tr>
            </table>
            <br>
               Thanks & Regards.<br>
               metropolis <br>
        <strong>This is automatically generated email , please do not reply.</strong>";


        for($i=0;$i<$email_count;$i++){
                  $mail->addAddress($email_id[$i]);}
                  $mail->Subject = $subject;
                   $mail->Body    = $body;
                  if($mail->send())
                    {
                     $this->session->set_flashdata('success',"New VID Registration Screen Created");
                      redirect('Request/total_request');
                    }
                    else {

                    }



     }

        catch (phpmailerException $e) {
        echo $e->errorMessage(); //Pretty error messages from PHPMailer
        } catch (Exception $e) {
        echo $e->getMessage(); //Boring error messages from anything else!
        }


        }
        else{
          $this->session->set_flashdata('error',"Successfully Done");
          redirect('Request/total_request');
        }





			}


	public function update_visit_seducle(){
		//create OutSource logistic or Frencishise logistic and assgin login to sister lab
			$post = $this->input->post();
			$log_id = $post['emp_ids'];
			$cc = array(CC_EMAIL);
			if( $log_id ){
				$logisticUserData = $this->insertNewPhelboOutsource( $post['logis_email'] , $post['phelbo_namess'] , $post['logis_contactss'] , $log_id , $log_id , '1' );
			  if( $logisticUserData ){
						$updateData = [
							'emp_id' => $log_id,
							'status'=> '2',
							'isPhelboAssigned'=>$log_id,
							'Phelbo_name'=>$logisticUserData->name,
							'phebo_id'=>$logisticUserData->id,
							'Logistic_id'=>$log_id,
							'contact'=>$logisticUserData->contact,
						];
						$updateScehudleVisit = $this->Master_model->update('visit_schedule', ['visit_id'=> $post['id_visit'] ], $updateData  );
						if( $updateScehudleVisit ){
							//sendMail to Logistic user which is given email by sisLab
							$this->sendPickupEmailToPickUpGuy($post['id_visit'],$logisticUserData->email,$logisticUserData->name,$logisticUserData->contact,$cc);
							$this->sendPickupEmailToClient($post['id_visit'] );
							$this->session->set_flashdata('success',"Assigned to {$logisticUserData->name} ");
							redirect('Request/total_request');
						}
						else{
							$this->session->set_flashdata('error',"Something Went Wrong");
							redirect('Request/total_request');
						}
					 }
					 else{
						 $this->session->set_flashdata('error',"Something Went Wrong");
						 redirect('Request/total_request');
					 }
				 }
					else{
						$this->session->set_flashdata('error',"Something wents wrong");
						redirect('Request/total_request');
					}
	}


	public function update_visit_seducle_bck(){
		$post = $this->input->post();
// 		print_r( $post );
		$id = $this->input->post('id_visit');
		$emp_ids = $this->input->post('emp_ids');
		$phelbo_namess = $this->input->post('phelbo_namess');
		$logis_contactss = $this->input->post('logis_contactss');
		$logis_contact = $this->input->post('logis_contact');
		$email = $post['logis_email'];
		$email2 = $post['logis_email2'];
// 		echo $email2;

		$reported_to = $this->session->userdata('log_user')['user_id'];
		$array = array(
			'emp_id' => $emp_ids,
			'status'=> '2',
			'isPhelboAssigned'=>$emp_ids,
			'Phelbo_name'=>	$phelbo_namess,
			'phebo_id'=>$phelbo_namess,
			'Logistic_id'=>$emp_ids,
			'contact'=>$logis_contactss,

		);
		$isUserSaved = $this->Master_model->update('visit_schedule',['visit_id' => $id],$array);
		$sql = $this->db->query("select vs.visit_id, vs.visit_unique_id ,p.patient_name,p.patient_contact,tm.test_name,vs.refering_doctor_name, vs.clients_name as comp_name,vs.Representative_name,vs.Representative_contact as contacts,vs.phebo_id,vs.contact,vs.update_at,sc.price,concat(vs.Address,vs.HospitalAddress) as address,concat(vs.date_of_collection,vs.camp_from_date) as date_of_collection, tc.type from visit_schedule vs join sample_collection sc on vs.visit_id = sc.visit_id join patient p on sc.patient_id = p.patient_id join test_master tm on sc.test = tm.test_id  join sister_lab_masters sm on vs.sisLab_id = sm.sis_id join type_of_collection tc on vs.type_of_collection = tc.t_id where vs.visit_id = '$id'");

       $query = $sql->result();
    foreach( $query as $key => $rows ){
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
        //$name = $rows->name;
        $address = $rows->address;
        $contacts = $rows->contacts;
        $type = $rows->type;
        $res_name = $rows->Representative_name;
        $b_data = $rows->date_of_collection;
    }


        //SMS Intregation
    $user="metropolisindia"; //your username
    $password="mhsitadm2012 "; //your password
    $mobilenumbers=$logis_contactss; //enter Mobile numbers comma seperated
    $message = "Please find the Blood collection Details for the below mentioned Patient:

    Unique ID:". $visit_id ."
    Patient Name:".$patient_name."
    Patient contact No:".$patient_contact."
    Test Name:".$test_name."
    Referred By Dr:".  $refering_doctor_name."
    Company:".$comp_name."
    Executive Name:".$res_name."
    Patient Address:".$address."
    Executive Contact:".$contacts."
    Blood Collection Date & Time:".$b_data."
    Name of Phlebo Personnel for pick up:".$phebo_id."
    Contact number of Phlebo Personnel for pick up::".$contact."
    Dispatched Date & Time:".$update_at."
    Payment Collected:". $price.".

Regards,
Metropolis Team

This is Auto Generated Message. Kindly Do Not reply
"
; //enter Your Message
    $senderid="METLAB"; //Your senderid
    $messagetype="N"; //Type Of Your Message
    $DReports="Y"; //Delivery Reports
    $url="http://www.smscountry.com/SMSCwebservice_Bulk.aspx";
    $message = urlencode($message);
    $ch = curl_init();
    if (!$ch){die("Couldn't initialize a cURL handle");}
    $ret = curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt ($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt ($ch, CURLOPT_POSTFIELDS,
    "User=$user&passwd=$password&mobilenumber=$mobilenumbers&message=$message&sid=$senderid&mtype=$messagetype&DR=$DReports");
    $ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //If you are behind proxy then please uncomment below line and provide your proxy ip with port.
    // $ret = curl_setopt($ch, CURLOPT_PROXY, "PROXY IP ADDRESS:PORT");
    $curlresponse = curl_exec($ch); // execute
    if(curl_errno($ch))
    echo 'curl error : '. curl_error($ch);
    if (empty($ret)) {
    // some kind of an error happened
    die(curl_error($ch));
    curl_close($ch); // close cURL handler
    } else {
    $info = curl_getinfo($ch);
    curl_close($ch); // close cURL handler
   // echo $curlresponse; //echo "Message Sent Succesfully" ;
    }


//second message to client

	//SMS Intregation
    $users="metropolisindia"; //your username
    $passwords="mhsitadm2012 "; //your password
    $mobilenumberss=$logis_contact; //enter Mobile numbers comma seperated
    //echo $mobilenumbers;
    $messages = "Please find the Blood collection Details for the below mentioned Patient:

    Unique ID:". $visit_id ."
    Patient Name:".$patient_name."
    Patient contact No:".$patient_contact."
    Test Name:".$test_name."
    Referred By Dr:".  $refering_doctor_name."
    Company:".$comp_name."
    Name of Logistic Personnel for pick up:".$phebo_id."
    Contact number of Logistic Personnel for pick up::".$contact."


Regards,
Metropolis Team

This is Auto Generated Message. Kindly Do Not reply
"
; //enter Your Message
    $senderids="METLAB"; //Your senderid
    $messagetypes="N"; //Type Of Your Message
    $DReportss="Y"; //Delivery Reports
    $url="http://www.smscountry.com/SMSCwebservice_Bulk.aspx";
    $message = urlencode($messages);
    $ch = curl_init();
    if (!$ch){die("Couldn't initialize a cURL handle");}
    $ret = curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt ($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt ($ch, CURLOPT_POSTFIELDS,
    "User=$users&passwd=$passwords&mobilenumber=$mobilenumberss&message=$messages&sid=$senderids&mtype=$messagetypes&DR=$DReportss");
    $ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //If you are behind proxy then please uncomment below line and provide your proxy ip with port.
    // $ret = curl_setopt($ch, CURLOPT_PROXY, "PROXY IP ADDRESS:PORT");
    $curlresponse = curl_exec($ch); // execute
    if(curl_errno($ch))
    echo 'curl error : '. curl_error($ch);
    if (empty($ret)) {
    // some kind of an error happened
    die(curl_error($ch));
    curl_close($ch); // close cURL handler
    } else {
    $info = curl_getinfo($ch);
    curl_close($ch); // close cURL handler
    //echo $curlresponse; //echo "Message Sent Succesfully" ;
    }


      // end of second message to client


			$mail = $this->Master_model->configureEmail();
			$mail->AddCC( CC_EMAIL );


         $email_id= explode(",",$email);
        $email_count=count($email_id);

        try{


            $subject = "BA Metropolis-Phelbotonist-Team";
            $body = "Dear ".$phelbo_namess."<br>

              <p> Please find the Blood collection Details for the below mentioned Patient:<br>
              <table border='1px solid'>
            <tr><td>
            Unique ID:</td><td>". $visit_id ."</td></tr>
            <tr><td>
            Patient Name: </td><td>".$patient_name."</td></tr>
            <tr><td>
            Patient contact No:</td><td>".$patient_contact."</td></tr>
            <tr><td>
            Test Name:</td><td>".$test_name."</td></tr>
            <tr><td>
            Referred By Dr:</td><td>".  $refering_doctor_name."</td></tr>
            <tr><td>
            Company:</td><td>".$comp_name."</td></tr>
            <tr><td>
            Executive Name:</td><td>". $res_name."</td></tr>
            <tr><td>
            Sample pick up From:</td><td>".$address."</td></tr>
            <tr><td>
            Executive No:</td><td>".$contacts."</td></tr>
            <tr><td>
            Blood Collection Date & Time:</td><td>".$b_data."</td></tr>
            <tr><td>
            Name of Phlebo Personnel for pick up:</td><td>".$phebo_id."</td></tr>
            <tr><td>
            Contact number of Phlebo Personnel for pick up:</td><td>".$contact."</td></tr>
            <tr><td>
            Dispatched Date & Time:</td><td>".$update_at."</td></tr>
            <tr><td>
            Payment Collected:</td><td>". $price."</td></tr>

            </table>
            <br>
               Thanks & Regards.<br>
               metropolis <br>
        <strong>This is automatically generated email , please do not reply.</strong>";


        for($i=0;$i<$email_count;$i++){
                  $mail->addAddress($email_id[$i]);}
                  $mail->Subject = $subject;
                   $mail->Body    = $body;
                  if($mail->send())
                    {

                    }
                    else {

                    }



     }

        catch (phpmailerException $e) {
        echo $e->errorMessage(); //Pretty error messages from PHPMailer
        } catch (Exception $e) {
        echo $e->getMessage(); //Boring error messages from anything else!
        }
    //
		$mail = $this->Master_model->configureEmail();
		$mail->AddCC( CC_EMAIL );


         $email_id= explode(",",$email2);
        $email_count=count($email_id);

        try{
            // $name = $rows->name;
        $address = $rows->address;
        $contacts = $rows->contacts;
        $type = $rows->type;
        $res_name = $rows->Representative_name;
        $b_data = $rows->date_of_collection;

            $subject = "BA Metropolis-Client-Team";
           $body = "Dear Team<br>

              <p> Please find the Blood collection Details for the below mentioned Patient:<br>
              <table border='1px solid'>
            <tr><td>
            Unique ID:</td><td>". $visit_id ."</td></tr>
            <tr><td>
            Patient Name: </td><td>".$patient_name."</td></tr>
            <tr><td>
            Patient contact No:</td><td>".$patient_contact."</td></tr>
            <tr><td>
            Test Name:</td><td>".$test_name."</td></tr>
            <tr><td>
            Referred By Dr:</td><td>".  $refering_doctor_name."</td></tr>
            <tr><td>
            Company:</td><td>".$comp_name."</td></tr>
            <tr><td>
            Executive Name:</td><td>". $res_name."</td></tr>
            <tr><td>
            Sample pick up From:</td><td>".$address."</td></tr>
            <tr><td>
            Executive No:</td><td>".$contacts."</td></tr>
            <tr><td>
            Blood Collection Date & Time:</td><td>".$b_data."</td></tr>
            <tr><td>
            Name of Phlebo Personnel for pick up:</td><td>".$phebo_id."</td></tr>
            <tr><td>
            Contact number of Phlebo Personnel for pick up:</td><td>".$contact."</td></tr>
            <tr><td>
            Dispatched Date & Time:</td><td>".$update_at."</td></tr>
            <tr><td>
            Payment Collected:</td><td>". $price."</td></tr>

            </table>
            <br>
               Thanks & Regards.<br>
               metropolis <br>
        <strong>This is automatically generated email , please do not reply.</strong>";

        for($i=0;$i<$email_count;$i++){
                  $mail->addAddress($email_id[$i]);}
                  $mail->Subject = $subject;
                   $mail->Body    = $body;
                  if($mail->send())
                    {
						$this->session->set_flashdata('success',"New Phlebo Created");
                        redirect('Request/total_request');
                    }
                    else {

                    }



     }

        catch (phpmailerException $e) {
        echo $e->errorMessage(); //Pretty error messages from PHPMailer
        } catch (Exception $e) {
        echo $e->getMessage(); //Boring error messages from anything else!
        }
    //
		/*$array = array(
			'emp_id' => $emp_ids,
			'status'=> '2',
			'isPhelboAssigned'=>$emp_ids,
			'Phelbo_name'=>	$phelbo_namess,
			'phebo_id'=>$phelbo_namess,
			'Logistic_id'=>$emp_ids,
			'contact'=>$logis_contactss,

		);
		$isUserSaved = $this->Master_model->update('visit_schedule',['visit_id' => $id],$array);*/
		if( $isUserSaveds ){
         /* $this->session->set_flashdata('success',"New Phlebo Created");
          redirect('Request/total_request');*/
        }
        else{
          $this->session->set_flashdata('error',"Something wents wrong");
          redirect('Request/total_request');
        }

	}

	public function Additional_details(){
		$id = $_GET['value'];
        $sql = "SELECT sc.*,vs.type_of_collection FROM `visit_schedule` vs join sample_collect sc on vs.visit_id = sc.visit_id  where sc.visit_id = '$id'";
        $vid_registes = $this->Status_Updated->select_dat( $sql );
         $response = "
		    <table class='table table-bordered table-striped'>
		      <thead><th>#</th><th>Details</th><thead><tbody>";
        foreach( $vid_registes as $key => $value):
			if( $value->type_of_collection != '5'){
		     $response.="  <tr>
		       <td>Patient Name</td><td>";
		       $response.= $value->patient_name ;
			$response.=  "</td></tr>
		       <tr>
		       <td>Payment Status</td><td>";
		       $response.= $value->payment_status ;
			$response.=  "</td></tr>
		       <tr>
		       <td>Extra Test</td><td>";
		       $response.= $value->Extra_test ;
			$response.=  "</td></tr>
		       <tr>
		       <td>Email Id</td><td>";
		       $response.= $value->Email_id ;
			$response.=  "</td></tr>
		       <tr>
		       <td>Sample Collected</td><td>";
		       $response.= $value->Sample_collected ;}else{};
			$response.=  "</td></tr>
		       <tr>
		       <td>Copen</td><td>";
		       $response.= $value->Copen ;
			$response.=  "</td></tr>
			<tr>
			<td>No of Vacutainer</td><td>";
			$response.= $value->no_of_vacutainer ;
 $response.=  "</td></tr>
		       <tr>
		       <td>Remarks</td><td>";
		       $response.= $value->Remarks ;


		endforeach ;
		$response.=  "</td></tr></tbody></table>
			 <button class='btn  btn-default ff' style='margin-top:30px;margin-bottom:20px' data-toggle='collapse' data-target='#collapseOne'  aria-expanded='true' aria-controls='collapseOne' onclick='trfs( $value->visit_id )'>View Trf Files</button>

		     ";

		      echo $response;


	}

	public function Additional_files(){
		$id = $_GET['value'];
		$sql = "SELECT f.* FROM  sample_collect sc join files f on f.sample_id = sc.sample_id  where sc.visit_id =  '$id'";
        $vid_registes = $this->Status_Updated->select_dat( $sql );
        $response = "<table class='table table-bordered table-striped'>
		      <thead><th>#</th><th>Files Name</th><thead><tbody>";
        $counter=1;foreach( $vid_registes as $key => $value):
		 $response.= "
		       <tr>
		       <td>";
		       $response.= $counter;
			$response.=  "</td>

		       <td><a href='";
		       $response.= base_url();
		       $response.="uploads/";
		       $response.= $value->file_name;
		       $response.= "' target='_blank'>";
		       $response.= $value->file_name ;
			  $response.="</a>";
		     $counter++;

		endforeach ;
		$response.=  "</td></tr>


			</tbody></table>

		     ";	 echo $response;


	}

	public function Additional_vids(){
		$id = $_GET['value'];
		$sql = "SELECT * FROM `visit_schedule` where visit_id = '$id'";
        $vid_registes = $this->Status_Updated->select_dat( $sql );
        $response = "<table class='table table-bordered table-striped'>
		      <thead><th>#</th><th>VID Registration</th><thead><tbody>";
        ;foreach( $vid_registes as $key => $value):
		$response.="  <tr>
		       <td>VID Number</td><td>";
		       $response.= $value->v_id_number ;
			$response.=  "</td></tr>
		       <tr>
		       <td>Payment Mode</td><td>";
		       $response.= $value->Payment_mode ;
			$response.=  "</td></tr>
		       <tr>
		       <td>Remarks</td><td>";
		       $response.= $value->Remarks ;
			$response.=  "</td></tr>
		       <tr>
		       <td>History</td><td>";
		       $response.= $value->History ;
			$response.=  "</td></tr>
		       <tr>
		       <td>Comment</td><td>";
		       $response.= $value->Comment ;


		endforeach ;
		$response.=  "</td></tr>


			</tbody></table>

		     ";	 echo $response;
	}


  public function AssignedSister(){
    $data['id'] =  $_GET['id'];
    $sql = $this->db->query("select sis_name,sis_id from sister_lab_masters where status = '1'");
    $data['dd'] = $sql->result();
    
    $this->loadView('form/assigned_sisterLab',$data);


  }

  public function sms(){
      //Your authentication key
        $user="metropolisindia"; //your username
        $password="mhsitadm2012 "; //your password
        $mobilenumbers="9183696958"; //enter Mobile numbers comma seperated
        $message = "test messgae"; //enter Your Message
        $senderid="METLAB"; //Your senderid
        $messagetype="N"; //Type Of Your Message
        $DReports="Y"; //Delivery Reports
        $url="http://www.smscountry.com/SMSCwebservice_Bulk.aspx";
        $message = urlencode($message);
        $ch = curl_init();
        if (!$ch){die("Couldn't initialize a cURL handle");}
        $ret = curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt ($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt ($ch, CURLOPT_POSTFIELDS,
        "User=$user&passwd=$password&mobilenumber=$mobilenumbers&message=$message&sid=$senderid&mtype=$messagetype&DR=$DReports");
        $ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //If you are behind proxy then please uncomment below line and provide your proxy ip with port.
        // $ret = curl_setopt($ch, CURLOPT_PROXY, "PROXY IP ADDRESS:PORT");
        $curlresponse = curl_exec($ch); // execute
        if(curl_errno($ch))
        echo 'curl error : '. curl_error($ch);
        if (empty($ret)) {
        // some kind of an error happened
        die(curl_error($ch));
        curl_close($ch); // close cURL handler
        } else {
        $info = curl_getinfo($ch);
        curl_close($ch); // close cURL handler
        echo $curlresponse; //echo "Message Sent Succesfully" ;
        }
        }
}
