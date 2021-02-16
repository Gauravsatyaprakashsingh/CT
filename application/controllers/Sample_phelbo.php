<?php
defined('BASEPATH') OR exit('No direct script access allowed');
defined('BASEPATH') OR exit('No direct script access allowed');


class Sample_phelbo extends My_Controller{

	public function __construct()
	{
		parent::__construct();
			$this->load->model('Status_Updated');
	}

	public function index(){
	    $post = $this->input->post();
	   // print_r( $post );exit;
	    $email = $post['cclient_emails'];
	  	    $data = array(
	    	'visit_id'=>$post['visit_id'],
	    	'patient_name'=>$post['patient_name'],
	    	'payment_status'=>$post['payment_status'],
	    	'Extra_test'=>$post['extra_test'],
	    	'Sample_collected'=>$post['sample_collected'],
	    	'Email_id'=>$post['email_id'],
	    	'Copen'=>$post['copen'],
				'no_of_vacutainer'=> $post['n_vacutainer'],
	    	'Remarks'=>$post['remarks'],
	    );

	    $insert = $this->Master_model->insert('sample_collect',$data);
	    if( $insert ){
        $last_insert = $this->Master_model->lastInsertId();
       $data = array();
           if(!empty($_FILES['agreement']['name'])){
            $filesCount = count($_FILES['agreement']['name']);
            //echo $filesCount."<br>";
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['file']['name']     = $_FILES['agreement']['name'][$i];
                $_FILES['file']['type']     = $_FILES['agreement']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['agreement']['tmp_name'][$i];
                $_FILES['file']['error']     = $_FILES['agreement']['error'][$i];
                $_FILES['file']['size']     = $_FILES['agreement']['size'][$i];
                //print_r( $_FILES['file']['name']);
                // File upload configuration
                $uploadPath = './uploads/';
                $config1['upload_path'] = $uploadPath;
                $config1['allowed_types'] = 'pdf|jpg|docx|png|EML';

                $config1['encrypt_name'] = true;
                $this->load->library('upload', $config1);

                if (!$this->upload->do_upload('file')){
                    $error = array('error' => $this->upload->display_errors());

                    if($error){
                      $this->session->set_flashdata('error',"All Data Inserted, But".$error['error']);
                      redirect('Request/total_request');
                    }
                    exit();
                }
                else {
                    $fdataa = $this->upload->data();
                    $post['agree'] =  $fdataa['file_name'];

                    $data = array( 'sample_id' => $last_insert,
                                   'file_name' => $post['agree'],
                                   'status' =>  '1',
                                  );

                    $abc = $this->db->insert('files', $data);

                  }
                  }
                   if( $abc ){
                   	$ids = $post['visit_id'];
                   	$pat_s = $post['patient_idss'];
                   	$array = array(
					'status'=> '10',
					);
			$Status_Update = $this->Status_Updated->status_change('visit_schedule',['visit_id' => $ids],$array);
			$arrayss = array(
					'p_status'=> '2',
				);
			$Status_Updates = $this->Status_Updated->status_change('patient',['patient_id' => $pat_s],$arrayss);
			if( $Status_Updates ){
			         $this->session->set_flashdata('success',"Sample Collected ");
                      redirect('Request/patient_views?value='.$ids);
			        }
			        else{
			          $this->session->set_flashdata('error',"Something wents wrong");
			           redirect('Request/patient_views?value='.$ids);
			       }


            }

      }    }
   else{
        $this->session->set_flashdata('error',"Creation Failed , Please Try Again");
        redirect('Request/total_request');
   }
	}


  public function sample_walkin(){
    $post = $this->input->post();
      $data = array(
				'visit_id'=>$post['visit_id'],
				'patient_name'=>$post['patient_name'],
				'payment_status'=>$post['payment_status'],
				'Extra_test'=>$post['extra_test'],
				'Sample_collected'=>$post['sample_collected'],
				'Email_id'=>$post['email_id'],
				'Copen'=>$post['copen'],
				'no_of_vacutainer'=> $post['n_vacutainer'],
				'Remarks'=>$post['remarks'],
      );
      $insert = $this->Master_model->insert('sample_collect',$data);
      if( $insert ){
        $last_insert = $this->Master_model->lastInsertId();
       $data = array();
           if(!empty($_FILES['agreement']['name'])){
            $filesCount = count($_FILES['agreement']['name']);
            echo $filesCount."<br>";
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['file']['name']     = $_FILES['agreement']['name'][$i];
                $_FILES['file']['type']     = $_FILES['agreement']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['agreement']['tmp_name'][$i];
                $_FILES['file']['error']     = $_FILES['agreement']['error'][$i];
                $_FILES['file']['size']     = $_FILES['agreement']['size'][$i];
                print_r( $_FILES['file']['name']);
                // File upload configuration
                $uploadPath = './uploads/';
                $config1['upload_path'] = $uploadPath;
                $config1['allowed_types'] = 'pdf|jpg|docx|png|EML';

                $config1['encrypt_name'] = true;
                $this->load->library('upload', $config1);

                if (!$this->upload->do_upload('file')){
                    $error = array('error' => $this->upload->display_errors());

                    if($error){
                      $this->session->set_flashdata('error',"All Data Inserted, But".$error['error']);
                      redirect('Request/total_request');
                    }
                    exit();
                }
                else {
                    $fdataa = $this->upload->data();
                    $post['agree'] =  $fdataa['file_name'];

                    $data = array( 'sample_id' => $last_insert,
                                   'file_name' => $post['agree'],
                                   'status' =>  '1',
                                  );

                    $abc = $this->db->insert('files', $data);

                  }
                  }
                   if( $abc ){
                    $ids = $post['visit_id'];
                    $array = array(
                    'status'=> '12',
          );
          $Status_Update = $this->Status_Updated->status_change('visit_schedule',['visit_id' => $ids],$array);
          if( $Status_Update ){
                $this->session->set_flashdata('success',"Sample Collected ");
                      redirect('Request/total_request');
              }
              else{
                $this->session->set_flashdata('success',"Sample Collected");
                redirect('Request/total_request');
             }


            }

      }    }
   else{
        $this->session->set_flashdata('error',"Creation Failed , Please Try Again");
        redirect('Request/total_request');
   }
  }
}
