<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Logistic_sister extends My_Controller{

	public function __construct()
	{
		parent::__construct();
			$this->load->model('Status_Updated');
	}

	public function index(){
		$ids = $_GET['id'];
		$data['id'] = $ids;
        $reported_to = $this->session->userdata('log_user')['user_id'];
		$sql = "SELECT * FROM `employee_master` where status = '1' and added_by_user = '$reported_to' and type in ( '16' )";
		$data['sis_emp'] = $this->Status_Updated->select_dat( $sql );
		$this->loadView('form/logistic_form.php',$data);
	}

	public function logis_form(){
	  $ids = $_GET['id'];
	  $data['clients_mail'] = $_GET['email'];

	  $data['contact'] = $_GET['contact'];
 	  //echo $data['contact'];exit;
		$data['id'] = $ids;
		$reported_to = $this->session->userdata('log_user')['user_id'];
		$sql = "SELECT * FROM `employee_master` where status = '1' and added_by_user = '$reported_to' and type in ( '16' )";
		$data['sis_emp'] = $this->Status_Updated->select_dat( $sql );
		$this->loadView('form/logistic_form.php',$data);
	}

	public function accept_walkin(){
	   $ids = $_GET['id'];
		$array = array(
			'status'=> '2',
		);
		$Status_Update = $this->Status_Updated->status_change('visit_schedule',['visit_id' => $ids],$array);
		if( $Status_Update ){
          $this->session->set_flashdata('success',"Sister Lab accepted requested");
          redirect('Request/total_request');
        }
        else{
          $this->session->set_flashdata('error',"Something wents wrong");
          redirect('Request/total_request');
       }
	}
	public function denies(){
	    $ids = $_GET['id'];
		$array = array(
			'status'=> '3',
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

	public function phelbo_accepted(){
	    $ids = $this->input->post('phelbo_id');
		$array = array(
			'status'=> '11',
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
			'status'=> '8',
		);
		$Status_Update = $this->Status_Updated->status_change('visit_schedule',['visit_id' => $ids],$array);
		if( $Status_Update ){
          $this->session->set_flashdata('error',"Logistic denied requested");
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
          $this->session->set_flashdata('error',"Logistic Cancelled requested");
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
          $this->session->set_flashdata('error',"Logistic Cancelled requested");
          redirect('Request/total_request');
        }
        else{
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
          $this->session->set_flashdata('success',"Logistic Reached At Home");
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

	public function new_logistic(){
		 $this->loadView('form/logistic_form_created');
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

	public function Sample_collected(){
		$id = $this->input->post('project_value');
		$ids = $this->input->post('pros_id');
 		// echo $ids;exit;
		$data['ids'] = $ids;
		$data['pat_isd'] = $id;
		$sql = "SELECT p.patient_name,p.total_amount as price,p.visit_id FROM  patient p  where p.patient_id = '$id'";
		$data['patient_name'] = $this->Status_Updated->select_dat( $sql );
	   $this->loadView('form/sample_collected',$data);
	}

	public function walk_in_sample_collection(){
		$id = $this->input->post('project_value');
		$this->loadView('form/sample_collected',[ ] );
	}

	public function logistic_insert(){

		$post = $this->input->post();
		$date =  date("Y-m-d h:i:s");
		$email = $post['phel_email'];
		$password = rand(1,100000000);
        $pass = md5( $password );
		$reported_to = $this->session->userdata('log_user')['user_id'];
		$sql =  $this->db->query("select id from employee_master where status = '1' and email = '$email' and type in ( '16' ) ");
	    if( $sql->num_rows() > 0 ){
	     $this->session->set_flashdata('error',"Email Already Exists");
          redirect('Logistic_sister/new_logistic');
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
        echo $e->errorMessage();exit; //Pretty error messages from PHPMailer
        } catch (Exception $e) {
        echo $e->getMessage();exit; //Boring error messages from anything else!
        }
    // exit;
		//Find_Text
		$array = array(
			'fullname'=>$post['phel_name'],
			'password'=>$pass,
			'email'=>$post['phel_email'],
			'contact'=>$post['phel_num'],
			'pincode'=>'400007',
			'type'=>'16',
			'report_to'=>$reported_to,
			'added_by_user'=>$reported_to,
			'status'=>'1',
			'log_time'=>$date,
		);
		$isUserSaved = $this->Master_model->insert('employee_master',$array);
		if( $isUserSaved ){
          $this->session->set_flashdata('success',"New Logistic Created");
          redirect('Logistic_sister/new_logistic');
        }
        else{
          $this->session->set_flashdata('error',"Something wents wrong");
          redirect('Logistic_sister/new_logistic');
       }
	}
}
// 	public function insert_pick(){
// 		$post = $this->input->post();
// 		print_r( $post );exit;
// 	    $password = rand(1,100000000);
//         $pass = md5( $password );
// 		$id = $this->input->post('id_visits');
// 		$email = $post['phel_email'];
// 		ini_set('error_reporting', E_ALL);
//         error_reporting( E_ALL );
// 		$reported_to = $this->session->userdata('log_user')['user_id'];
// 	    $date =  date("Y-m-d h:i:s");
// 	    $sql =  $this->db->query("select id from employee_master where status = '1' and email = '$email' and type in ( '16' )");
// 	    $query = $sql->result();
// 	    foreach ($query as $key => $value) {
// 	    	$val_id = $value->id;
// 	    }
// 	    if( $sql->num_rows() > 0 ){
// 	    	$array = array(
// 			'emp_id' => $val_id,
// 			'status'=> '2',
// 			'islogisticAssigned'=>$val_id,
// 			'Logistic_name'=>$post['phel_name'],
// 			'phebo_id'=>$post['phel_name'],
// 			'Logistic_id'=>$val_id,
// 			'contact'=>$post['phel_num'],
// 		);
// 		$isUserSaveds = $this->Master_model->update('visit_schedule',['visit_id' => $id],$array);
// 		if( $isUserSaveds ){
//           $this->session->set_flashdata('success',"New Logistic Created");
//           redirect('Request/total_request');
//         }
//         else{
//           $this->session->set_flashdata('error',"Something wents wrong");
//           redirect('Request/total_request');
//       }
// 	    }
// 	    else{
// 	        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions


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
//         echo $e->errorMessage();exit; //Pretty error messages from PHPMailer
//         } catch (Exception $e) {
//         echo $e->getMessage();exit; //Boring error messages from anything else!
//         }
//     // exit;
// 		$array = array(
// 			'fullname'=>$post['phel_name'],
// 			'password'=>$pass,
// 			'email'=>$post['phel_email'],
// 			'contact'=>$post['phel_num'],
// 			'pincode'=>'400007',
// 			'type'=> '16',
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
// 			'islogisticAssigned'=>$Inserted,
// 			'Logistic_name'=>$post['phel_name'],
// 			'phebo_id'=>$post['phel_name'],
// 			'Logistic_id'=>$Inserted,
// 			'contact'=>$post['phel_num'],
// 		);
// 		$isUserSaveds = $this->Master_model->update('visit_schedule',['visit_id' => $id],$array);
// 		if( $isUserSaveds ){
//           $this->session->set_flashdata('success',"New Logistic Created");
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


	public function assign_pickup_request(){
		//create OutSource logistic or Frencishise logistic and assgin login to sister lab
		$post = $this->input->post();
		
		$email_id = explode(",",$this->input->post('mail_ids'));
        $email_cc = array(CC_EMAIL);
		$cc = array_merge($email_cc,$email_id);
		print_r($cc);
		exit;
		
		$log_id = $this->createLogistic( $post['log_id'] , $post['pickup_type'] );
		if( $log_id ){
			$logisticUserData = $this->insertNewPhelboOutsource( $post['phel_email'] , $post['phel_name'] , $post['phel_num'] , $log_id , $log_id , '2' );
         if($logisticUserData){
			$updateData = ['emp_id' => $log_id,
				'status'=> '2',
				'islogisticAssigned'=>$log_id,
				'Logistic_name'=>$logisticUserData->name,
				'Logistic_id'=>$logisticUserData->id,
				'contact'=>$logisticUserData->contact,
				'phebo_id'=>$logisticUserData->name,
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

	public function sendPickupEmailToPickUpGuy($visit_id,$logistic_email,$name,$pick_upcontact,$cc){
	  $sql = $this->db->query("select vs.visit_unique_id , vs.visit_id,p.patient_name,p.patient_contact,tm.test_name,vs.refering_doctor_name, vs.clients_name as comp_name,vs.Representative_name,vs.Representative_contact as contacts,vs.phebo_id,vs.contact,vs.update_at,sc.price,concat(vs.Address,vs.HospitalAddress)  as address,concat(vs.date_of_collection,vs.camp_from_date) as date_of_collection, tc.type from visit_schedule vs join sample_collection sc on vs.visit_id = sc.visit_id join patient p on sc.patient_id =    p.patient_id join test_master tm on sc.test = tm.test_id  join sister_lab_masters sm on vs.sisLab_id = sm.sis_id join type_of_collection tc on vs.type_of_collection = tc.t_id where vs.visit_id = '$visit_id'");

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
	      }

	      $mail = $this->Master_model->configureEmail();
		  $mail->addAddress( $logistic_email );
	      //$mail->AddCC( CC_EMAIL );
	      $email_count = count($cc);
		  for($i=0;$i<$email_count;$i++)
		  {
			 $mail->AddCC($cc[$i]);
		  }
		  
		  $subject = "Logistic-Team";
	      $body = "Dear ".$name."<br>

	      <p> Please find the Blood collection Details for the below mentioned Patient:<br>
	      <table border='1px solid'>
	      <tr><td> Unique ID:</td><td>". $unique_id ."</td></tr>
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
	      <br>
	         Thanks & Regards.<br>
	         metropolis <br>
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

		This is Auto Generated Message. Kindly Do Not reply
		";
		$this->sendTextMessage( $textMessage , $pick_upcontact );
	  if($mail->send()){}
	  else {}
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


public function insert_pick(){
		$post = $this->input->post();
		$log_id = $post['log_id'];
			$password = rand(1,100000000);
        $pass = md5( $password );
// 		print_r($log_id);exit;
		$id = $this->input->post('id_visits');
		$email = $post['phel_email'];
		$email2 = $post['clients_mailsssss'];
		$client_cons = $post['client_cons'];
// 		echo $email2;exit;
				$reported_to = $this->session->userdata('log_user')['user_id'];

		 $sql =  $this->db->query("select id from phelbooutsource where status = '1' and email = '$email' and type in ( '2' )");
	    $query = $sql->result();
	    foreach ($query as $key => $value) {
 	    	$val_id = $value->id;
 	    }
	    if( $sql->num_rows() > 0 ){
	         $date =  date("Y-m-d h:i:s");
	    	$array = array(
			'emp_id' => $log_id,
			'status'=> '2',
			'islogisticAssigned'=>$log_id,
			'Logistic_name'=>$post['phel_name'],
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
			'log_id'=>$log_id,
			'Created_Date'=>$date,
		);
// 		$isUserSaved = $this->Master_model->insert('phelbooutsource',$array);
		$isUserSaved = $this->Master_model->update('phelbooutsource',['id' => $val_id],$array);
		 $sql = $this->db->query("select vs.visit_id,p.patient_name,p.patient_contact,tm.test_name,vs.refering_doctor_name, vs.clients_name as comp_name,vs.Representative_name,vs.Representative_contact as contacts,vs.phebo_id,vs.contact,vs.update_at,sc.price,concat(vs.Address,vs.HospitalAddress)  as address,concat(vs.date_of_collection,vs.camp_from_date) as date_of_collection, tc.type from visit_schedule vs join sample_collection sc on vs.visit_id = sc.visit_id join patient p on sc.patient_id = p.patient_id join test_master tm on sc.test = tm.test_id  join sister_lab_masters sm on vs.sisLab_id = sm.sis_id join type_of_collection tc on vs.type_of_collection = tc.t_id where vs.visit_id = '$id'");

       $query = $sql->result();
    foreach( $query as $key => $rows ){
        $visit_id = $rows->visit_id;
        $patient_name = $rows->patient_name;
        $patient_contact = $rows->patient_contact ;
        $test_name = $rows->test_name ;
        $refering_doctor_name = $rows->refering_doctor_name ;
        $comp_name = $rows->comp_name ;
        $phebo_id = $rows->phebo_id ;
        $contact = $rows->contact ;
        $update_at = $rows->update_at ;
        $price = $rows->price;
        $name = $rows->name;
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
    Name of Logistic Personnel for pick up:".$phebo_id."
    Contact number of Logistic Personnel for pick up:".$contact."
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
    //echo $curlresponse; //echo "Message Sent Succesfully" ;
    }


   //second message to client

	//SMS Intregation
    $users="metropolisindia"; //your username
    $passwords="mhsitadm2012 "; //your password
    $mobilenumberss=$client_cons; //enter Mobile numbers comma seperated
    //echo $mobilenumbers;exit;
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
    echo $curlresponse; //echo "Message Sent Succesfully" ;
    }


      // end of second message to client

			$mail = $this->Master_model->configureEmail();
			$mail->AddCC( CC_EMAIL );



         $email_id= explode(",",$email);
        $email_count=count($email_id);

        try{


            $subject = "BA Metropolis-Logistic-Team";
            $body = "Dear ".$post['phel_name']."<br>

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
            Name of Logistic Personnel for pick up:</td><td>".$phebo_id."</td></tr>
            <tr><td>
            Contact number of Logistic Personnel for pick up:</td><td>".$contact."</td></tr>
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
        echo $e->errorMessage();exit; //Pretty error messages from PHPMailer
        } catch (Exception $e) {
        echo $e->getMessage();exit; //Boring error messages from anything else!
        }
    // exit;
		$mail = $this->Master_model->configureEmail();
		$mail->AddCC( CC_EMAIL );



         $email_id= explode(",",$email2);
        $email_count=count($email_id);

        try{
            $name = $rows->name;
        $address = $rows->address;
        $contacts = $rows->contacts;
        $type = $rows->type;
        $res_name = $rows->Representative_name;
        $b_data = $rows->date_of_collection;

            $subject = "BA Metropolis-Client-Team";
           $body = "Dear team<br>

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
            Name of Logistic Person for pick up:</td><td>".$phebo_id."</td></tr>
            <tr><td>
            Contact number of Logistic Person for pick up:</td><td>".$contact."</td></tr>
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
        echo $e->errorMessage();exit; //Pretty error messages from PHPMailer
        } catch (Exception $e) {
        echo $e->getMessage();exit; //Boring error messages from anything else!
        }
        // exit;

		if( $isUserSaved ){
          $this->session->set_flashdata('success',"New Logistic Created");
          redirect('Request/total_request');
        }
        else{
          $this->session->set_flashdata('error',"Something wents wrong");
          redirect('Request/total_request');
        }

        }
	    }
	    else{
	    $date =  date("Y-m-d h:i:s");
	    	$array = array(
			'emp_id' => $log_id,
			'status'=> '2',
			'islogisticAssigned'=>$log_id,
			'Logistic_name'=>$post['phel_name'],
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
			'log_id'=>$log_id,
			'type'=>'2',
		);
		$isUserSaved = $this->Master_model->insert('phelbooutsource',$array);

		if( $isUserSaved ){
          $this->session->set_flashdata('success',"New Logistic Created");
          redirect('Request/total_request');
        }
        else{
          $this->session->set_flashdata('error',"Something wents wrong");
          redirect('Request/total_request');
        }

        }



  }
}

	public function vid_registration(){
		$id = $_GET['id'];
		$data['ids'] = $id;
		$sql = "select client_email,v_id_number,payment_mode,Remarks,Comment,History from visit_schedule where visit_id = '$id'";
		$data['vid_registe'] = $this->Status_Updated->select_dat( $sql );
		$this->loadView('form/vid_registration',$data);
	}

	public function vid_insert(){
		$id = $this->input->post('visi_id');
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
		 $sql = $this->db->query("select vs.visit_id,ems.fullname,vs.update_at,vs.location,concat(vs.Address,vs.HospitalAddress)  as address,concat(vs.date_of_collection,vs.camp_from_date) as date_of_collection,p.patient_name,p.patient_gender,p.patient_age,pj.project_name,p.patient_contact,vs.refering_doctor_name,scs.Sample_collected,tm.test_name,tps.type_name,vs.Remarks ,su.status_type ,vs.Comment,ems.fullname from visit_schedule vs join sample_collection sc on vs.visit_id = sc.visit_id join patient p on sc.patient_id = p.patient_id join test_master tm on sc.test = tm.test_id  join sister_lab_masters sm on vs.sisLab_id = sm.sis_id join type_of_collection tc on vs.type_of_collection = tc.t_id join project pj on vs.project_id = pj.project_id join sample_collect scs on scs.visit_id = vs.visit_id join type_of_payment tps on tps.type_id = vs.payment_status join employee_master ems on vs.requestor_id = ems.id join status_update su on vs.status = su.status_id where vs.visit_id='$id'");

       $query = $sql->result();
    foreach( $query as $key => $rows ){
        $visit_id = $rows->visit_id;
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
            <td>". $visit_id ."</td>

           <td>".$dispatch."</td>

            <td>".$location."</td>

            <td>".$date_collectiom."</td>

            <td>".  $patient_name."</td>

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
        echo $e->errorMessage();exit; //Pretty error messages from PHPMailer
        } catch (Exception $e) {
        echo $e->getMessage();exit; //Boring error messages from anything else!
        }


        }
        else{
          $this->session->set_flashdata('error',"Something wents wrong");
          redirect('Request/total_request');
        }
	}

  public function update_visit_seducle(){
		//create OutSource logistic or Frencishise logistic and assgin login to sister lab
		$post = $this->input->post();
		$cc = array(CC_EMAIL);
		
		$log_id = $post['emp_ids'];
		if($log_id){
		$logisticUserData = $this->insertNewPhelboOutsource( $post['logis_email'],$post['logis_namesss'],$post['logis_contactss'],$log_id,$log_id,'2');
			if($logisticUserData){
			$updateData = [
				'emp_id' => $log_id,
				'status'=> '2',
				'islogisticAssigned'=>$log_id,
				'Logistic_name'=>$logisticUserData->name,
				'Logistic_id'=>$logisticUserData->id,
				'contact'=>$logisticUserData->contact,
				'phebo_id'=>$logisticUserData->name,
			];
			$updateScehudleVisit = $this->Master_model->update('visit_schedule', ['visit_id'=> $post['id_visit'] ], $updateData  );
			if( $updateScehudleVisit ){
				//sendMail to Logistic user which is given email by sisLab
				$this->sendPickupEmailToPickUpGuy($post['id_visit'],$logisticUserData->email,$logisticUserData->name,$logisticUserData->contact,$cc);
				$this->sendPickupEmailToClient( $post['id_visit'] );
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

}
