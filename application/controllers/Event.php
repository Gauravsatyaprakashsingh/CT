<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends My_Controller {


      public function create_event()
    	{

    		  $this->load->view('admin/form/create_event',[
                                   'category'=>$this->Master_model->select('category' ,'','cat_created',['cat_status' => '1']),
                                   'cities'=>$this->Master_model->rawQuery("SELECT * FROM cities WHERE status ='1' ORDER BY CityName"),
                                   'states'=>$this->Master_model->rawQuery("SELECT * FROM states ")
                                 ]

        );
    	}

      public function add_event(){
          $post = $this->input->post();
          // echo "<pre>";
          // print_r( $post ); exit;
          $shop_images=[];
          $states=[];
          if(isset($post['radios']) && $post['radios'] == 1){
            $repeatEventValue= 1;
          }
          else
          {
            $repeatEventValue= 0;
          }

          foreach ($post['city'] as  $value) {
            array_push($shop_images,$value);
          }
          foreach ($post['states'] as  $value) {
            array_push($states,$value);
          }
          $updateData['city_id']=json_encode($shop_images);
          $updateData['state_id']=json_encode($states);
          $cities=$updateData['city_id'];
          $states=$updateData['state_id']=json_encode($states);
          if( $this->Master_model->insert(
                                              'event',
                                               [
                                                  'e_name' => $post['ename'],
                                                  'e_desc' => $post['edesc'],
                                                  'cat_id' => $post['cat_id'],
                                                  'city_id' => $cities,
                                                  'state_id' => $states,
                                                  'start_date' => $post['e_start'],
                                                  'notify_before_days' => $post['notify_before_days'],
                                                  'e_repeat' => $repeatEventValue

                                               ]

                                         )):

                $this->session->set_flashdata('sucess',"Event Created successfully.");
                redirect('Event/create_event');
          else:
            $this->session->set_flashdata('error',"Something wents wrong,Please try again.");
            redirect('Event/create_event');
          endif;
      }

      public function view_event(){
        $this->load->view('admin/view/view_event',['tabledata'=>$this->Master_model->select('event','','',['e_status'=>'1'] )] );
      }

    public function delete_type(){
      if($this->Master_model->update( 'type_master', [ 'tip'=>$this->input->post('type_id')] ,['delete_status'=>'1'] )){
                $this->session->set_flashdata('sucess',"Offer type deleted successfully.");
                redirect('Offer/view_type');
      }
      else{
                $this->session->set_flashdata('error',"Something wents wrong. Please try again.");
                redirect('Offer/view_type');
      }
  }


  public function edit_event()
  {

    $post = $this->input->post();
    $event_data = $this->Master_model->select('event','','',['e_id'=>$this->input->post('e_id')]);
    $city = $this->getCity( json_decode( $event_data[0]->state_id ) );
    // echo "<pre>";
    // print_r( $city );
    // exit();
    $this->load->view(
                        'admin/form/edit_event',
                         [
                           'category'=>$this->Master_model->select('category' ,'','cat_created',['cat_status' => '1']),
                           'ev_data' =>$event_data,
                           'cities'=>$city,
                           'states'=>$this->Master_model->rawQuery("SELECT * FROM states ")
                         ]
                     );
  }


  public function delete_event(){
    $event_id =trim($this->input->post('e_id')," ") ;
    $isDeletedEvent = $this->Master_model->delete('event',['e_id'=>$event_id ]);
    if( $isDeletedEvent ){
      $this->session->set_flashdata('sucess',"Event Deleted !");
      redirect('Event/view_event');
    }
    else{
      $this->session->set_flashdata('error',"Oops , Something wents wrong ! Please try again.");
      redirect('Event/view_event');
    }
  }


  public function update_event()
  {
    $post = $this->input->post();
     // echo'<pre>'; print_r( $post );exit;
    $repeatEventValue =isset($post['radios'])? 1 : 0 ;
    $updateData =  [
                    'e_name'=> trim($post['ename']," ") ,
                    'e_desc'=> trim($post['edesc']," "),
                    'cat_id' => $post['cat_id'],
                    'city_id' => isset($post['city'])?json_encode( $post['city'] ):json_encode([]),
                    'state_id'=> isset($post['states'])?json_encode( $post['states'] ):json_encode([]),
                    'start_date' => $post['e_start'],
                    'notify_before_days' => $post['notify_before_days'],
                    'e_repeat' => $repeatEventValue
                    ] ;
    // echo "csds";
    // echo ''; print_r($updateData); exit();

    if( $this->Master_model->update(
                                        'event',
                                         [ 'e_id'=> trim($post['e_id']," ")],
                                         $updateData
                                    )):

          $this->session->set_flashdata('sucess',"Event updated successfully.");
          redirect('Event/view_event');
    else:
      $this->session->set_flashdata('error',"Something wents wrong,Please try again.");
      redirect('Event/view_event');
    endif;
  }


  public function getCity( $state ){
		$state_id ="";
		if( $state ){
			foreach ($state as $key => $value) {
				  $state_id.="'{$value}',";
			}
		}
		$state_id = trim( $state_id , ',');
		$sql = "select * from cities where StateID in ({$state_id}) and status ='1' ";
	  $data =	$this->Master_model->rawQuery($sql);
  	return $data ;
	}

}
