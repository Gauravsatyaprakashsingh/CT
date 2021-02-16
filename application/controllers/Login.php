<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {

	     public function __construct()
	     {
	     	 		parent::__construct();
						$this->load->model('Login_model');
	     }


	public function index(){
		$this->load->view('login/login');
	}

  public function admin(){
		$post = $this->input->post();
        
		if($this->form_validation->run('login') == FALSE):
		$this->load->view('login/login');
		else:
		
			$result = $this->Login_model->user_login($post['username'],$post['password']);
			
			if($result):
					$this->session->set_flashdata('success',"LOGIN SUCCESSFULLY.");
					redirect('Welcome');
					
					
			else:
					$this->session->set_flashdata('error',"Incorrect username or password");
					redirect('Login');
			endif;

		endif;

  }

	public function forget_password(){
		$this->load->view('login/forget_password');
	}

	public function send_reset_link( ){
		$post = $this->input->post();
		$isVerifyEmailSent = $this->Login_model->send_reset_link( $post['email'] );
		if( $isVerifyEmailSent ){
			$this->session->set_flashdata('success',"Please find a reset link in your coressponding email.");
		  redirect('Login/forget_password');
		}else{
			$this->session->set_flashdata('error',"Sorry unable to send reset link");
		  redirect('Login/forget_password');
		 }
	}

	public function setnewpassword( ){
	 $data = $this->input->get();
	 $isKeyValid = $this->Login_model->check_key( $data );
	 $this->load->view('login/setnewpassword' , compact( 'data' , 'isKeyValid' ) );
	}

	public function update_password( ){
		$post = $this->input->post( );
		$isKeyValid = true;
		$data['value'] = $post['user_value'];
		if( $post['password'] == $post['confpassword'] ){
			$isUpdate = $this->Master_model->update('employee_master',['id'=>$post['user_value'] ], [ 'password'=>md5( $post['password'] ) ] );
      if( $isUpdate ){
				$key = "put key value here";
				$this->Login_model->key_used( $key );
				$this->session->set_flashdata('success',"Password changed");
				redirect('Login');
			}
			else{
				$this->session->set_flashdata('error',"Something wents wrong Please try again");
				$this->load->view('login/setnewpassword' , compact( 'data' , 'isKeyValid' ) );
			}
		}
		else{
			$this->session->set_flashdata('error',"Password and Conf-password doesn't matched");
			$this->load->view('login/setnewpassword' , compact( 'data' , 'isKeyValid' ) );
		}
	}

	public function logout(){
 	 $this->session->sess_destroy();
 	 redirect('Login');
  }

}
