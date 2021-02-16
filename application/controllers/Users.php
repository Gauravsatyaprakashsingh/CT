<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends My_Controller {

  public function index(){
    $sql = "SELECT * from employee_master em
             INNER JOIN employee_category ec ON ec.category_id = em.type
             where  em.type in ( '1','2','3','4','5','6','7','12' )";
    $data['report_to_list'] = $this->Master_model->rawQuery( $sql );
    $sql = "SELECT category_id as type , label FROM employee_category WHERE category_id not in( 8,9,10,11)";
    $data['label_type'] = $this->Master_model->rawQuery( $sql );
    $data['city_list'] = $this->Master_model->select('zone_state_city');
    $this->loadView('form/create_user',$data);
  }

  public function add_user(){
    $sql = "SELECT * from employee_master em
             INNER JOIN employee_category ec ON ec.category_id = em.type
             where  em.type in ( '1','2','3','4','5','6','7','12' )";
    $data['report_to_list'] = $this->Master_model->rawQuery( $sql );
    $sql = "SELECT category_id as type , label FROM employee_category WHERE category_id not in( 8,9,10,11)";
    $data['label_type'] = $this->Master_model->rawQuery( $sql );
    $data['city_list'] = $this->Master_model->select('zone_state_city');
    $this->loadView('form/create_user',$data);
  }
  public function view_user(){
    $sql = "SELECT em.* , ec.label
             FROM employee_master em
             INNER JOIN employee_category ec ON ec.category_id = em.type where type IN ( '1','2','3','4','5','6','7','12' ) AND em.status != '4' ";
    $this->loadView('view/user_view',['tableData'=>$this->Master_model->rawQuery( $sql ) ] );
  }

  public function client_user(){
    $data['tableData'] = $this->Common_model->getClientAllUser();
    $this->loadView('view/client_view', $data );
  }

  public function edit_user(){
    $user_id = $this->input->post('user_value');
    $data['userData'] = $this->Master_model->select('employee_master', null ,null, ['id'=>$user_id] )[0];
    $sql = "SELECT * from employee_master em
             INNER JOIN employee_category ec ON ec.category_id = em.type
             where  em.type in ( '1','2','3','4','5','6','7','12' )";
    $data['report_to_list'] = $this->Master_model->rawQuery( $sql );
    $sql = "SELECT category_id as type , label FROM employee_category WHERE category_id not in( 8,9,10,11)";
    $data['label_type'] = $this->Master_model->rawQuery( $sql );
    $data['city_list'] = $this->Master_model->select('zone_state_city');
    $this->loadView('form/create_user' , $data );
  }



  public function edit_client(){
    $user_id = $this->input->post('user_value');
    $data['clientData'] = $this->Master_model->select('employee_master', null ,null, ['id'=>$user_id] )[0];
    $data['city'] = $this->Master_model->select('zone_state_city');
    $data['company_list'] = $this->Master_model->select('company' , null , null ,[ 'status'=> '1' ] );
    $sql = "SELECT * from employee_master em
             INNER JOIN employee_category ec ON ec.category_id = em.type
             where  em.type in ( 8,9,10,11 )";
    $data['report_to_list'] = $this->Master_model->rawQuery( $sql );
    $sql = "SELECT category_id as type , label FROM employee_category WHERE category_id in( 8,9,10,11)";
    $data['label_type'] = $this->Master_model->rawQuery( $sql );
    $this->loadView('form/client_form' , $data );
  }



  public function view_client(){
    $sql = "SELECT *
             FROM employee_master em
             INNER JOIN employee_category ec ON ec.category_id = em.type where type IN ( '8','9','10','11' ) AND em.status = '1' ";
    $this->loadView('view/client_view',['tableData'=>$this->Master_model->rawQuery( $sql ) ] );
  }

  public function save_user(){
    $post = $this->input->post();
    $this->load->model('Casual_Model');
    if( ! $this->Casual_Model->isUserPresent( $post['contact'] , $post['email']) ) {
      $post['password'] = md5( $post['password'] );
      $post['added_by_user'] = $this->session->userdata('log_user')['user_id'];
      $isUserSaved = $this->Master_model->insert('employee_master', $post );
        if( $isUserSaved ){
          $this->session->set_flashdata('success',"New User Created");
          redirect('Users');
        }
        else{
          $this->session->set_flashdata('error',"Something wents wrong");
          redirect('Users');
        }
    }
    else{
      $this->session->set_flashdata('error',"User Already Present ");
      redirect('Users');
    }
  }



  public function delete_user( ){
    $user_id = $this->input->get('value');
    $isDeleted = $this->Master_model->update('employee_master' , ['id'=>$user_id ] , [ 'status'=>'4' ] );
    if( $isDeleted ){
      $this->session->set_flashdata('success',"User Deleted");
      redirect('Users/view_client');
    }
    else {
      $this->session->set_flashdata('error',"Something wents wrong!. Please try again");
      redirect('Users/view_client');
    }
  }


  public function update_user( ){
    $post = $this->input->post();
    $id = $post['userValue'];
    echo $id;
    unset( $post['userValue'] );
    if( empty( $post['password'] ) )
          unset( $post['password'] );
    else $post['password'] = md5( $post['password'] );
    $isUpdated = $this->Master_model->update('employee_master',['id'=>$id] , $post );
    if( $isUpdated ){
      $this->session->set_flashdata('success',"Updated successfully");
      redirect('Users/view_user');
    }
    else{
      $this->session->set_flashdata('error',"Something wents wrong!. Please try again");
      redirect('Users/view_user');
    }
  }

  public function update_client( ){
    $post = $this->input->post();
    $id = $post['userValue'];
    unset( $post['userValue'] );
    if( empty( $post['password'] ) )
          unset( $post['password'] );
    else $post['password'] = md5( $post['password'] );
    $isUpdated = $this->Master_model->update('employee_master',['id'=>$id] , $post );
    if( $isUpdated ){
      $this->session->set_flashdata('success',"Updated successfully");
      redirect('Users/view_client');
    }
    else{
      $this->session->set_flashdata('error',"Something wents wrong!. Please try again");
      redirect('Users/view_client');
    }
  }

  public function getListPatient( ){
    $query = $this->input->post('query');
    if( $query ){
      $sql = " SELECT * FROM patient p
                WHERE patient_name like '%{$query}%'
                OR patient_contact like '%{$query}'
                OR patient_email like '%{$query}' LIMIT 5 ";
      $data['pateintData'] = $this->Master_model->rawQuery($sql);
      $this->load->view('ajax_form/ajax_patient_list', $data );
    }
  }


  public function new_patient( ){
    $this->loadView('form/patient_form' ,[]);
  }

  public function client(){
    $data['city'] = $this->Master_model->select('zone_state_city');
    $data['company_list'] = $this->Master_model->select('company' , null , null ,[ 'status'=> '1' ] );
    $sql = "SELECT * from employee_master em
             INNER JOIN employee_category ec ON ec.category_id = em.type
             where  em.type in ( 9,10 )";
    $data['report_to_list'] = $this->Master_model->rawQuery( $sql );
    $sql = "SELECT category_id as type , label FROM employee_category WHERE category_id in( 9,10)";
    $data['label_type'] = $this->Master_model->rawQuery( $sql );
    $this->loadView('form/client_form' , $data );
  }

  public function save_client( ){
    $post = $this->input->post();
     // echo "<pre>"; print_r( $post ); exit;
    $this->load->model('Casual_Model');
    if( $post['type'] == '8' ){
      if( $this->checkBHDAlreadyPresent( $post['company_id'] ) ){
        $this->session->set_flashdata('error',"Already Business Head Present for this company");
        redirect('Users/client');
        return;
      }
    }

    if( ! $this->Casual_Model->isUserPresent( $post['contact'] , $post['email']) ) {
      $post['password'] = md5( $post['password'] );
      $post['added_by_user'] = $this->session->userdata('log_user')['user_id'];
      $post['report_to'] = ( $post['report_to'] )?$post['report_to']:0;
      $isUserSaved = $this->Master_model->insert('employee_master', $post );
        if( $isUserSaved ){
          $this->session->set_flashdata('success',"New User Created");
          redirect('Users/client');
        }
        else{
          $this->session->set_flashdata('error',"Something wents wrong");
          redirect('Users/client');
        }
    }
    else{
      $this->session->set_flashdata('error',"User Already Present ");
      redirect('Users/client');
    }
  }


  public function zonal_view_user(){
    $login_id = $this->session->userdata('log_user')['user_id'];
    $sql = "SELECT * FROM employee_master WHERE type in ( 11 , 13 ) AND added_by_user = '$login_id' ;";
    $this->loadView('view/user_view',['tableData'=>$this->Master_model->rawQuery( $sql ) ] );
  }

  public function bd_view_user(){
    $login_id = $this->session->userdata('log_user')['user_id'];
    $sql = "SELECT * FROM employee_master WHERE type in ( 11 , 13 ) and added_by_user = '$login_id' ;";
    $this->loadView('view/user_view',['tableData'=>$this->Master_model->rawQuery( $sql ) ] );
  }

  public function project_cordinate(){
    $sql = "SELECT category_id as type , label FROM employee_category WHERE category_id not in( 8,9,10,11)";
    $data['label_type'] = $this->Master_model->rawQuery( $sql );
    $data['city_list'] = $this->Master_model->select('zone_state_city');
    $this->loadView('form/project_cordinate', $data );
  }

 public function insert_project_manager(){
    $post = $this->input->post();
    $report_to = $this->session->userdata('log_user')['user_id'];
     $pass = md5( $post['password'] );
     $password = $post['password'];
      $email = $post['email'];
     ini_set('error_reporting', E_ALL);
     error_reporting( E_ALL );
      $sql = $this->db->query("select * from employee_master where email = '$email' and type = '4'");
      $mail = $this->Master_model->configureEmail();


         $email_id= explode(",",$email);
        $email_count=count($email_id);

        try{
            $subject = "BA Metropolis";
            $body = "Dear ".$post['project_name']."<br>
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
     if( $sql->num_rows() > 0 ){
        //  $query = $sql->result();
        //  foreach( $query as $key => $value){
        //      $id = $value->id;
        //  }

         $this->session->set_flashdata('success',"Project Coordinator already exists");
	         redirect('Users/project_cordinate');
        }
    else{
    $data = array(
        'email'=>$post['email'],
        'fullname'=>$post['project_name'],
        'password'=>$pass,
        'contact'=>$post['contact'],
        'type'=> '4',
        'report_to' => $report_to,
        'added_by_user' => $report_to,

        );
        $insert_login = $this->Master_model->insert('employee_master' , $data );
        if( $insert_login ){
             $this->session->set_flashdata('success',"SisterLab inserted Successfully");
    	     redirect('Users/project_cordinate');
         }
         else{
             $this->session->set_flashdata('error',"Something went wrong");
	         redirect('Users/project_cordinate');
         }
    }

}
  public function edit_project_cordinate(){
    $user_id = $this->input->post('user_value');
    $data['userData'] = $this->Master_model->select('employee_master', null ,null, ['id'=>$user_id] )[0];
    $sql = "SELECT category_id as type , label FROM employee_category WHERE category_id not in( 8,9,10,11)";
    $data['label_type'] = $this->Master_model->rawQuery( $sql );
    $data['city_list'] = $this->Master_model->select('zone_state_city');
    $this->loadView('form/project_cordinate', $data );
  }


  public function update_project_cordinate( ){
    $post = $this->input->post();
    $id = $post['userValue'];
    echo $id;
    unset( $post['userValue'] );
    if( empty( $post['password'] ) )
          unset( $post['password'] );
    else $post['password'] = md5( $post['password'] );
    $isUpdated = $this->Master_model->update('employee_master',['id'=>$id] , $post );
    if( $isUpdated ){
      $this->session->set_flashdata('success',"Updated successfully");
      redirect('Users/list_project_cordinate');
    }
    else{
      $this->session->set_flashdata('error',"Something wents wrong!. Please try again");
      redirect('Users/list_project_cordinate');
    }
  }



  public function save_project_cordinate(){
    $post = $this->input->post();
    $this->load->model('Casual_Model');
    if( ! $this->Casual_Model->isUserPresent( $post['contact'] , $post['email']) ) {
      $post['password'] = md5( $post['password'] );
      $post['added_by_user'] = $this->session->userdata('log_user')['user_id'];
      $isUserSaved = $this->Master_model->insert('employee_master', $post );
        if( $isUserSaved ){
          $this->session->set_flashdata('success',"New User Created");
          redirect('Users/project_cordinate');
        }
        else{
          $this->session->set_flashdata('error',"Something wents wrong");
          redirect('Users/project_cordinate');
        }
    }
    else{
      $this->session->set_flashdata('error',"User Already Present ");
      redirect('Users/project_cordinate');
    }
  }

  public function reporting_person_name($id){
    $this->load->model("Viewmodel");
    $data["get_results"] = json_decode($this->Viewmodel->get_names($id),true);
	    foreach($data['get_results'] as $info){
            echo "<option value=".$info['id'].">".$info['fullname']."</option>";
      }
  }



  public function list_project_cordinate( ){
        $type = $this->input->get('query_type');
        $id = $this->session->userdata('log_user')['user_id'];
        $sql = "SELECT * FROM employee_master em
                WHERE em.status ='1' AND ( em.report_to = '{$id}' OR em.added_by_user ='{$id}')  ";
        $data['tableData'] = $this->Master_model->rawQuery( $sql );
        $this->loadView('view/total_project_coordinate' , $data );
  }

public function delete_pc(){
       $id = $_GET['id'];
       $isDeleted = $this->Master_model->update('employee_master' , ['id'=>$id ] , [ 'status'=>'0' ] );
        if( $isDeleted ){
          $this->session->set_flashdata('success',"Project Cpordinate Deleted");
          redirect('Users/list_project_cordinate');
        }
        else {
          $this->session->set_flashdata('error',"Something wents wrong!. Please try again");
          redirect('Users/list_project_cordinate');
        }
   }

   public function edit_pc(){
       $id = $_GET['id'];
      $sql = "SELECT * FROM employee_master em
                WHERE em.status ='1' AND em.id = '$id'";
        $data['client_data'] = $this->Master_model->rawQuery( $sql );
        $this->loadView('form/project_cordinate' , $data );
   }

   public function update_pc(){
    //   $id = $_GET['id'];
       $id = $this->input->post('id');
       $post = $this->input->post();
    //   print_r($post);exit;
      $data = array(
        'email'=>$post['email'],
        'fullname'=>$post['project_name'],
        'password'=>$pass,
        'contact'=>$post['contact'],
        );

       $isDeleted = $this->Master_model->update('employee_master' , ['id'=>$id ] , $data );
        if( $isDeleted ){
          $this->session->set_flashdata('success',"Project Cpordinate Deleted");
          redirect('Users/list_project_cordinate');
        }
        else {
          $this->session->set_flashdata('error',"Something wents wrong!. Please try again");
          redirect('Users/list_project_cordinate');
        }
   }

  public function edit_category(){
    $this->load->view(
                            'admin/form/create_category',
                             [
                                'adv_data' =>$this->Master_model->select('category','','',['cat_id'=>$this->input->post('adv_id')])
                             ]
                         );
  }

  public function update_category(){
    $post = $this->input->post();
    $updateData =  [
                           'cat_name'=> trim($post['name']," ") ,
                           'cat_color_code'=> trim($post['color']," "),
                           'alert' => $post['radios']
                        ] ;

        // if($this->form_validation->run('create_advertise') == FALSE)  $this->load->view(
        //                      'admin/form/create_advertisement',
        //                       [
        //                          'type_master'=>$this->Master_model->select('type_master' ,'','created_timestamp') ,
        //                          'service' =>$this->Master_model->select('service_master')
        //                       ]
        //                   );
        // else {

                  if( $this->Master_model->update(
                                                      'category',
                                                       [ 'cat_id'=> trim($post['adv_id']," ")],
                                                       $updateData
                                                  )):

                        $this->session->set_flashdata('sucess',"Category update successfully.");
                        redirect('Category/view_adverti(sement');
                  else:
                    $this->session->set_flashdata('error',"Something wents wrong,Please try again.");
                    redirect('Category/view_advertisement');
                  endif;
        //}


      }


  public function checkBHDAlreadyPresent( $company_id ){
    $sqlQuery = "SELECT * FROM employee_master WHERE company_id = '{$company_id}' and type ='8' LIMIT 1";
    return $this->Master_model->isRowPresent( $sqlQuery );
  }




}
