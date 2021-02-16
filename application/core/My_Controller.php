<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

   class My_Controller extends CI_Controller
   {

         public function __construct()
         {
            parent::__construct();
            if(!$this->checkSession()){
               redirect('Login');
            }
         }

       function checkSession(){
         if($this->session->userdata('log_user')){
           // if( $this->session->userdata('last_action') < time() - 50 ){
           //   $this->session->sess_destroy();
           //   redirect('Login');
           // }
           // else{
           //  $this->session->set_userdata( 'last_action' , time() );
              return true;
           // }
        }
         else return false;
//else return true;

       }

       public function uploadImage( $path, $allowedTypes,$errorRedirectPage ,$filename='', $maxSize='', $maxWidth='', $maxHeight='', $encrypt= true ){

            $config =[
                          'upload_path'=>$path,
                          'allowed_types'=>$allowedTypes,
                          'max_size'=>$maxSize,
                          'max_width'=>$maxWidth,
                          'max_height'=>$maxHeight,
                          'encrypt_name'=>$encrypt
                     ];

           // print_r($config);exit;
           $this->load->library('upload',$config);
           if(!$this->upload->do_upload($filename))
            {
              redirect($errorRedirectPage);
              return '';
            }
            else   return  $this->upload->data()['file_name'];
         }

        public function getFolderName(){
          $type = $this->session->userdata('log_user')['type'];
          $folderName = '';
          switch ($type) {
            case '1':
              $folderName = 'superadmin';
            break;
            case '2':
              $folderName = 'mhl';
            break;
            case '3':
              $folderName = 'project_manager';
            break;
            case '4':
              $folderName = 'project_cordinate';
            break;
            case '5':
              $folderName = 'call_center';
            break;
            case '6':
              $folderName = 'phelbo';
            break;
            case '15':
              $folderName = 'phelbo';
            break;
            case '7':
              $folderName = 'sister_lab';
            break;
            case '8':
              $folderName = 'business_head';
            break;
            case '9':
              $folderName = 'requestor';
            break;
            case '10':
              $folderName = 'manager';
            break;
            case '11':
              $folderName = 'zonal_manager';
            break;
            case '12':
              $folderName = 'grl_lab';
            break;
		      	case '16':
              $folderName = 'logistic';
            break;
            case '19':
              $folderName = 'logistic';
            break;
            default:
              $folderName = '';
            break;
          }
           return $folderName;
        }

        public function loadView( $viewName = '' , $viewData = [] ){
          $this->load->view('header' , $viewData );
          $this->load->view('sidebar' , $viewData );
          $this->load->view( $this->getFolderName().'/'.$viewName , $viewData );
          $this->load->view('footer');
        }


        public function sendMail( ){
          $this->load->library('email');
          $this->email->from('metropolis@mytestserver.com', 'Metropolis Team');
          $this->email->to('singh.nitinkumar.nitin1995@gmail.com');
          // $this->email->cc('another@another-example.com');
          // $this->email->bcc('them@their-example.com');
          $this->email->subject('Email Test');
          $this->email->message('Testing the email class.');
          if ( ! $this->email->send(false)){
            // Generate error
            // echo 'Mail is not send';
            // echo  $this->email->print_debugger(array('headers'));
            // exit;
           }
        }

        public function mailSend( $to , $subject , $message ){
          // use wordwrap() if lines are longer than 70 characters
          $msg = wordwrap( $message,70);
          // send email
          mail( $to , $subject,  $message );
        }

   }













 ?>
