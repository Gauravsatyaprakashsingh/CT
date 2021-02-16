<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Sisterlab extends My_Controller {

  public function index(){

    $this->loadView('form/sister_lab_form');
  }

  public function save_sisterlab(){
     $post = $this->input->post();
     $pass = md5( $post['password'] );
     $password = $post['password'];
    //  echo $password;exit;
     $email = $post['email'];
     ini_set('error_reporting', E_ALL);
     error_reporting( E_ALL );
     $sql = $this->db->query("select * from employee_master where email = '$email' and type = '7'");
      $mail = $this->Master_model->configureEmail();
 	  	$mail->AddCC( CC_EMAIL );


         $email_id= explode(",",$email);
        $email_count=count($email_id);

        try{
            $subject = "BA Metropolis";
            $body = "Dear ".$post['fullname']."<br>
            <p>Email :".$email."<br> Password:".$password."</p><br>
           Thanks & Regards.<br>
        This is automatically generated email , please do not reply.";


        for($i=0;$i<$email_count;$i++){
                  $mail->addAddress($email_id[$i]);}
                  $mail->Subject = $subject;
                   $mail->Body    = $body;
                  // if($mail->send())
                  //   {
                  //
                  //   }
                  //   else {
                  //
                  //   }



     }

        catch (phpmailerException $e) {
        echo $e->errorMessage();exit; //Pretty error messages from PHPMailer
        } catch (Exception $e) {
        echo $e->getMessage();exit; //Boring error messages from anything else!
        }
    // exit;
     if( $sql->num_rows() > 0 ){
         $query = $sql->result();
         foreach( $query as $key => $value){
             $id = $value->id;
         }
         $arr = array(
            'sis_name'=> $post['fullname'],
            'sis_password'=> $pass,
            'sis_email'=> $post['email'],
            'sis_contact'=> $post['contact'],
            'sis_area'=> $post['Location_area'],
            'sis_address'=> $post['Location_address'],
            'sis_pincode'=> $post['pincode'],
            'login_id'=> $id,

         );
         $insert = $this->Master_model->insert('sister_lab_masters' , $arr );

         if( $insert ){
             $last_insert = $this->Master_model->lastInsertId();
             $this->session->set_flashdata('success',"SisterLab inserted Successfully");
    	     redirect('Sisterlab');
         }
         else{
             $this->session->set_flashdata('error',"Something went wrong");
	         redirect('Sisterlab');
         }
     }
     else{
         $data = array(
            'fullname'=> $post['fullname'],
            'password'=> $pass,
            'email'=> $post['email'],
            'contact'=> $post['contact'],
            // 'sis_area'=> $post['Location_area'],
            // 'sis_address'=> $post['Location_address'],
            'pincode'=> $post['pincode'],
            'type'=>'7',
            'status' => '1'

         );
         $insert_login = $this->Master_model->insert('employee_master' , $data );
         if( $insert_login ){
          $ins = $this->db->insert_id();
          $dat = array(
              'report_to' => $ins,
              'added_by_user' => $ins,
              );
         $this->Master_model->update('employee_master' , ['id'=>$ins ] , $dat );

         $arr = array(
            'sis_name'=> $post['fullname'],
            'sis_password'=> $pass,
            'sis_email'=> $post['email'],
            'sis_contact'=> $post['contact'],
            'sis_area'=> $post['Location_area'],
            'sis_address'=> $post['Location_address'],
            'sis_pincode'=> $post['pincode'],
            'login_id'=>  $ins ,

         );
         $inserts = $this->Master_model->insert('sister_lab_masters' , $arr );
        if( $inserts ){
             $this->session->set_flashdata('success',"SisterLab inserted Successfully");
    	     redirect('Sisterlab');
         }
         else{
             $this->session->set_flashdata('error',"Something went wrong");
	         redirect('Sisterlab');
         }
         }
     }



      }


    public function sister_lab_view(){
        $sql = "SELECT * FROM sister_lab_masters where status = '1'";
        $data['tableData'] = $this->Master_model->rawQuery( $sql );
        $this->loadView('view/view_total_sisterLab',$data);
    }

   public function delete_sisterlab(){
       $id = $_GET['id'];
       $isDeleted = $this->Master_model->update('sister_lab_masters' , ['sis_id'=>$id ] , [ 'status'=>'0' ] );
        if( $isDeleted ){
          $this->session->set_flashdata('success',"SisterLab Deleted");
          redirect('Sisterlab/sister_lab_view');
        }
        else {
          $this->session->set_flashdata('error',"Something wents wrong!. Please try again");
          redirect('Sisterlab/sister_lab_view');
        }
   }


  public function update_sisterlab(){
      $id = $_GET['id'];
      $sql = "SELECT * FROM sister_lab_masters where sis_id = '$id' and status = '1'";
      $data['clientDatas'] = $this->Master_model->rawQuery( $sql );

      $this->loadView('form/sister_lab_form',$data);
  }

  public function edit_sisterLab(){
     $post = $this->input->post();
     $id = $this->input->post('userValue');
    //  echo $id;exit;
     $pass = md5( $post['password'] );
     $password = $post['password'];
    //  echo $id;exit;
     $arr = array(
            'sis_name'=> $post['fullname'],
            'sis_password'=> $pass,
            'sis_email'=> $post['email'],
            'sis_contact'=> $post['contact'],
            'sis_area'=> $post['Location_area'],
            'sis_address'=> $post['Location_address'],
            'sis_pincode'=> $post['pincode'],
         );

        //  $isUpdated = $this->Master_model->update('sister_lab_masters',['sis_id'=>$id] , $arr );
         $isUpdated = $this->Master_model->update('sister_lab_masters' , ['sis_id'=>$id ] , $arr );
        if( $isUpdated ){
          $this->session->set_flashdata('success',"Updated successfully");
          redirect('Sisterlab/sister_lab_view');
        }
        else{
          $this->session->set_flashdata('error',"Something wents wrong!. Please try again");
          redirect('Sisterlab/sister_lab_view');
        }
  }
}
