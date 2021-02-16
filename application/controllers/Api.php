<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

  private  $API_SERVER_KEY = 'AAAA0jCEsBc:APA91bHloRhf1sDqBf8y_BYgjUSO_1HiAOWc5kNdhN9-f5rUqHzUm5MmA_kZIR-FKhNoNk2uyjS_2MtG9-UmVj8dCEYBqIGK0lIbbtc0JsziOrJbUKYnEGytpJRPEmqSynRGtg2-h9Gn';
  private  $is_background = "TRUE";

  public function	updateSessionTime(){
    $time = time();
    $beforeAction = $this->session->userdata('last_action');
		 $this->session->set_userdata( 'last_action' , time() );
    echo json_encode([
      'before_action' => $beforeAction,
      'last_action'=>	$this->session->userdata('last_action')
    ]);
	}

  public function TestCron(){
		 $url =  base_url('TEST/test.json');
     $test = json_decode( file_get_contents( $url ) );

     foreach ( $test as $key => $value) {
       $insertData = [
         'acrpid'=> $value->ACRPID,
         'test_name'=>$value->TNAME ,
         'test_code'=> $value->TCODE,
         'org_id'=>$value->OrgID ,
         'a_type'=>$value->AType
       ];
       $insert = $this->Master_model->insert('test_master' , $insertData );
     }
  }


  public function repersentative_user( ){
    $project_id = $this->input->post('project_id');
    $sql = "SELECT * from employee_master WHERE status = '1' AND ( company_id in ( SELECT company_id FROM project WHERE project_id = {$project_id} ) AND type in ( '9' , '10' ) )";
    $data = $this->Master_model->rawQuery( $sql );
    echo json_encode( $data );
  }

  public function selected_user(){
    $user_id = $this->input->post('user_id');
    $data = $this->Master_model->select('employee_master',null,null,['status'=>'1' , 'id'=>$user_id ]);
    if( $data ) echo json_encode( $data[0] );
    else echo json_encode([]);
  }



}
