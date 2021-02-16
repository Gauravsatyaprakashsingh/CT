<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {



    public function user_login($username,$password){
       $password = md5( $password );
       $sql = " SELECT em.id , ec.label , em.email , em.fullname , em.type , em.pincode , em.company_id
                FROM employee_master em
                INNER JOIN employee_category ec ON ec.category_id = em.type
                WHERE em.email = '{$username}' AND em.password ='{$password}' AND em.status = '1'";

        $isUserPresent =$this->db->query( $sql );
        if( $isUserPresent ->num_rows() > 0 ) {

              foreach ($isUserPresent->result() as $key => $value) {
                    $this->session->set_userdata('log_user',['user_id'=>$value->id ,
                                                             'label'=>$value->label ,
															  'email' => $value->email,
															  'username'=>$value->fullname ,
															  'type'=>$value->type,
															  'pincode'=>$value->pincode,
															  'company_id' =>$value->company_id,
                                                                ]);
                    $this->session->set_userdata('last_action',time());
              }
              return true;
          }
          else return false;
    }

    public function send_reset_link( $email ){
      $query = "SELECT id FROM employee_master WHERE email = '{$email}' LIMIT 1";
      $sqlResult = $this->db->query( $query );
      if( $sqlResult ->num_rows() > 0 ) {
        $user_id = $sqlResult->result() [0]->id;
        $rp_key = $this->random_strings( 12 );
        $insert = $this->db->insert('reset_password' , ['user_id'=>$user_id , 'rp_key'=>$rp_key] );
        $resetlink = base_url('Login/setnewpassword')."?value={$user_id}&key={$rp_key}";
        $isSend = $this->sendResetPasswordMail( $resetlink , $email );
      }
      else return false;
    }

    public function sendResetPasswordMail( $resetlink , $email  ){
      $mail = $this->Master_model->configureEmail();
      $mail->Subject = "BA Metropolis - New Password Link";
      $mail->Body ="Dear User , PLease use given link to reset your password <br> {$resetlink}";
      $mail->addAddress( $email );
      return $mail->send();
    }

    public function random_strings($length_of_string) {
        // String of all alphanumeric character
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        // Shufle the $str_result and returns substring
        // of specified length
        return substr(str_shuffle($str_result),
                           0, $length_of_string);
    }

    public function key_used( $key ){
      $this->Master_model->update('reset_password', ['rp_key'=>$key ] , ['isUsed'=> 1] );
    }

    public function check_key( $data ){
      $query = "SELECT * FROM `reset_password` WHERE user_id = '{$data['value']}' and rp_key = '{$data['key']}' and isUsed = '0'";
      $sqlResult = $this->db->query( $query );
      if( $sqlResult ->num_rows() > 0 ) return true;
      else return false;
    }

}
