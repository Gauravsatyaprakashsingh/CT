<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends My_Controller {


      public function create_Category()
    	{
    		  $this->load->view(
                              'admin/form/create_category'
                               // [
                               //    'type_master'=>$this->Master_model->select('type_master' ,'','created_timestamp',['delete_status'=>'0']) ,
                               //    'service' =>$this->Master_model->select('service_master')
                               // ]
                           );
    	}

      public function anotherMethod(){
      }

      public function add_category()
      {
          $post = $this->input->post();

          // if($this->form_validation->run('create_advertise') == FALSE)
          // {
          //   $this->session->set_flashdata('success_login', 'You have successfully logged out.');
          //    $this->load->view(
          //                      'admin/form/create_category'
          //                       // [
          //                       //    'type_master'=>$this->Master_model->select('type_master' ,'','created_timestamp') ,
          //                       //    'service' =>$this->Master_model->select('service_master')
          //                       // ]
          //                     );
          // }

          //else {


                    if( $this->Master_model->insert(
                                                        'category',
                                                         [
                                                           'cat_name'=> trim($post['name']," "),
                                                           'cat_color_code'=> trim($post['color']," "),
                                                           'alert' => $post['radios']

                                                         ]

                                                   )):

                          $this->session->set_flashdata('sucess',"Category added successfully.");
                          redirect('Category/create_Category');
                    else:
                      $this->session->set_flashdata('error',"Something wents wrong,Please try again.");
                      redirect('Category/create_Category');
                    endif;
        //  }
      }

      public function view_advertisement(){

        $sql="SELECT * FROM `category`";

        $this->load->view('admin/view/category_view',['tabledata'=>$this->Master_model->rawQuery($sql)] );

      }

      public function del_advertisement(){

        $sql="SELECT * FROM `offer_details` LEFT JOIN type_master on type_master.tip=offer_details.offer_type WHERE offer_details.delete_status='1'";

        $this->load->view('admin/view/advertise_view',['tabledata'=>$this->Master_model->rawQuery($sql)] );

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
                        redirect('Category/view_advertisement');
                  else:
                    $this->session->set_flashdata('error',"Something wents wrong,Please try again.");
                    redirect('Category/view_advertisement');
                  endif;
        //}


      }


      public function delete_advertisement()
      {
        $getpost=$this->input->post();
        $today = date("F j, Y, g:i a");
        if($this->Master_model->update( 'category', [ 'cat_id'=>$this->input->post('adv_id')] ,['cat_status'=>'0','cat_created'=>'now()'] ))
        {
                  $this->session->set_flashdata('sucess',"Offer type deleted successfully.");
                  redirect('Category/view_advertisement');
        }
        else
        {
                  $this->session->set_flashdata('error',"Something wents wrong. Please try again.");
                  redirect('Category/view_advertisement');
        }
      }



      public function changeStatus()
      {
        $post=$this->input->post();

        $updateData =  [
                           'cat_status'=> trim($post['adv_id']," ") ,

                        ] ;
        if( $this->Master_model->update(
                                            'category',
                                             [ 'cat_id'=> trim($post['cat_id']," ")],
                                             $updateData
                                        )):

              $this->session->set_flashdata('sucess',"Advertisement update successfully.");
              redirect('Category/view_advertisement');
        else:
          $this->session->set_flashdata('error',"Something wents wrong,Please try again.");
          redirect('Category/view_advertisement');
        endif;





      }



}
