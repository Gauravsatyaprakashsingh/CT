<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends My_Controller {


      public function create_admin()
    	{
    		  $this->load->view('admin/form/create_admin');
    	}

      public function add_admin(){
          $post = $this->input->post();
          if($this->form_validation->run('create_admin') == FALSE) $this->load->view('admin/form/create_admin');
          else {
                    if( $this->Master_model->insert(
                                                        'login',
                                                         [
                                                           'username'=> trim($post['username']," ") ,
                                                           'password'=> md5(trim($post['password']," ")),
                                                           'type'=>'2',
                                                           'email'=>trim($post['email']," ")
                                                         ]
                                                   )):

                          $this->session->set_flashdata('sucess',"Admin added successfully.");
                          redirect('Home/create_admin');
                    else:
                      $this->session->set_flashdata('error',"Something wents wrong,admin not added.Please try again.");
                      redirect('Home/create_admin');
                    endif;


          }
      }

      public function view_admin(){

         // var_dump($this->Master_model->select('login')); exit;

        $this->load->view('admin/view/admin_view',['tabledata'=>$this->Master_model->select('login' ,'','log_time desc')] );

      }

    public function edit_admin(){
       $this->load->view('admin/form/create_admin',[
                                                       'admin_data'=>$this->Master_model->advancedSearch(
                                                                                                              'login',
                                                                                                              [
                                                                                                               'id'=>$this->input->post('admin_id')
                                                                                                              ]
                                                                                                         )
                                                    ]);
    }

    public function delete_admin(){
          if($this->Master_model->delete( 'login', [ 'id'=>$this->input->post('admin_id')] )){
                    $this->session->set_flashdata('sucess',"Admin Deleted successfully.");
                    redirect('Home/view_admin');
          }
          else{
                    $this->session->set_flashdata('error',"Something wents wrong. Please try again.");
                    redirect('Home/view_admin');
          }
    }

    public function update_admin(){
      $post = $this->input->post();
         if( $this->Master_model->update(
                                                    'login',
                                                    ['id'=>$post['admin_id']],
                                                    ['password'=> md5(trim($post['password']," "))]

                                          )):

                      $this->session->set_flashdata('sucess',"Admin Updated successfully.");
                      redirect('Home/view_admin');
                else:
                  $this->session->set_flashdata('error',"Something wents wrong,admin not updated.Please try again.");
                  redirect('Home/view_admin');
                endif;


      }




}
