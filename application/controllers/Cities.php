<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cities extends My_Controller {


      public function create_Cities()
    	{
    		  $this->load->view('admin/form/create_Cities' ,['state'=>$this->Master_model->rawQuery("SELECT * FROM states ") ] );
    	}

      public function add_city(){
          $post = $this->input->post();
          // if($this->form_validation->run('create_admin') == FALSE) $this->load->view('admin/form/create_admin');
          // else {
                    if( $this->Master_model->insert(
                                                        'cities',
                                                         [
                                                           'CityName'=> $post['city_name'] ,
                                                           'status'=> $post['radios'],
                                                           'StateID'=>$post['states']
                                                         ]
                                                   )):

                          $this->session->set_flashdata('success',"City added successfully.");
                          redirect('Cities/view_Cities');
                    else:
                      $this->session->set_flashdata('error',"Something wents wrong,admin not added.Please try again.");
                      redirect('Cities/view_Cities');
                    endif;


        //  }
      }

      public function view_Cities(){

        $sql ="SELECT * FROM `cities`";
        $this->load->view('admin/view/cities_view',['tabledata'=>$this->Master_model->rawQuery($sql)] );

      }

      public function filter(){
        $post =$this->input->post();
        // echo "<pre>";
        // print_r($this->input->post());
        // echo "</pre>";
        $sql ="select isnotify,offer_name,username, mobileno,isInterested,pnid,hasVisited,adminotp from pushnotification
                INNER JOIN tech_login ON tech_login.techuserid = pushnotification.techuserid
                INNER JOIN offer_details ON pushnotification.offerId = offer_details.ofid where  pushnotification.created_timestamp  between '{$post['start_date']}'and '{$post['end_date']}' ";
        $this->load->view('admin/view/notification_view',['tabledata'=>$this->Master_model->rawQuery($sql)] );


      }

      public function edit_cities() {

        $this->load->view(
                            'admin/form/create_Cities',
                             [
                                'adv_data' =>$this->Master_model->select('cities','','',['CityID'=>$this->input->post('cid')]),
                                'state'=>$this->Master_model->rawQuery("SELECT * FROM states ")
                             ]
                         );
      }

      public function Update()
      {
        $post =$this->input->post();
        $updateData =[
                      'status'=>$post['radios'],
                      'CityName'=>$post['city_name'],
                      'StateID'=>$post['states']
                    ];


        if($this->Master_model->update( 'cities', [ 'CityID'=>$this->input->post('city_id')] ,$updateData )){
                  $this->session->set_flashdata('sucess',"Cities Updated successfully.");
                  redirect('Cities/view_Cities');
        }
        else{
                  $this->session->set_flashdata('error',"Something wents wrong. Please try again.");
                  redirect('Cities/view_Cities');
        }
      }



    public function change_status( ){
      $post = $this->input->post();

      if($this->Master_model->update( 'cities', [ 'CityID'=>$post['city_id'] ] ,['status'=> $post['status'] ] )){
          if( $post['status'] == '1' ){
            echo "<button onclick='change_status(0,{$post['city_id']} , this)' type='button' class='btn btn-mini btn-info' >
              Active
            </button>";
          }
          else{
            echo "<button onclick='change_status(1,{$post['city_id']} , this)' type='button' class='btn btn-mini btn-danger' >
              Inactive
            </button>";
          }
      }

    }

    public function delete_cities(){
        // if($this->Master_model->update( 'cities', [ 'CityID'=>$this->input->post('cid')] ,['status'=>'0'] )){
        //           $this->session->set_flashdata('sucess',"Cities deleted successfully.");
        //           redirect('Cities/view_Cities');
        // }
        // else{
        //           $this->session->set_flashdata('error',"Something wents wrong. Please try again.");
        //           redirect('Cities/view_Cities');
        // }
    }

}
