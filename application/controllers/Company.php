<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Company extends My_Controller{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

  public function index(){
    $data['companyList'] = $this->Master_model->select('company',null ,'comp_id desc' , ['status' => '1']);
    $this->loadView('form/create_company' , $data );
  }

  public function create_sub_company(){
    $main_company_id = $this->input->get('company_value');
    $data['company_id'] = $main_company_id;
    $data['subCompanyList'] = $this->Master_model->select('sub_company',null , null , [ 'company_id'=>$main_company_id , 'status' => '1']);
    $this->loadView('form/create_sub_company' , $data );
  }



  public function save_company( ){
    $post = $this->input->post();
    $isInserted = $this->Master_model->insert('company', [ 'comp_name'=>$post['company_name'] ]  );
    if( $isInserted ){
      $this->session->set_flashdata('success',"Company Created !");
      redirect('Company');
    }
    else{
      $this->session->set_flashdata('error',"Something Wents Wrong. Please try again.");
      redirect('Company');
    }
  }




  public function save_sub_company( ){
    $post = $this->input->post();
    $insertData = [
                    'sub_comp_name'=>$post['company_name'] ,
                    'sub_comp_code'=>$post['code'],
                    'sub_comp_contact'=>$post['contact'],
                    'sub_comp_address'=>$post['address'],
                    'company_id' => $post['company_id']
                  ];
    $isInserted = $this->Master_model->insert('sub_company',$insertData  );
    if( $isInserted ){
      $this->session->set_flashdata('success',"Company Created !");
      redirect('Company/create_sub_company?company_value='.$post['company_id']);
    }
    else{
      $this->session->set_flashdata('error',"Something Wents Wrong. Please try again.");
      redirect('Company/create_sub_company?company_value='.$post['company_id'] );
    }
	}

  public function total_company(){
    $data['companyList'] = $this->Master_model->select('company',null , null , ['status' => '1']);
    $this->loadView('view/company_list' ,  $data );
  }

  public function edit_company( ){
    $comp_id = $this->input->post('company_value');
    $sql = "SELECT * FROM  company c WHERE c.comp_id ='{$comp_id}'";
    $data['companyData'] = $this->Master_model->rawQuery( $sql )[0];
    $data['companyList'] = $this->Master_model->select('company',null , null , ['status' => '1']);
    $this->loadView('form/create_company',$data);
  }

  public function edit_sub_company( ){
    $comp_id = $this->input->post('company_value');
    $sql = "SELECT * FROM  sub_company sc WHERE sc.sub_comp_id ='{$comp_id}'";
    $data['subCompanyList'] = $this->Master_model->select('sub_company',null , null , [ 'sub_comp_id'=>$comp_id , 'status' => '1']);
    $data['companyData'] = $this->Master_model->rawQuery( $sql )[0];
    $this->loadView('form/create_sub_company',$data);
  }

  public function remove_company( ){
    $companyId = $this->input->get('value');
    $isDeleted = $this->Master_model->update('company', ['comp_id'=>$companyId ] , ['status'=>'0'] );
    if( $isDeleted ){
      $this->session->set_flashdata('success',"Deleted");
      redirect('Company');
    }
    else{
      $this->session->set_flashdata('error',"Something Wents Wrong. Please try again.");
      redirect('Company');
    }
  }


  public function remove_sub_company( ){
    $sub_company_id = $this->input->get('value');
    $isDeleted = $this->Master_model->update('sub_company', ['sub_comp_id'=>$sub_company_id ] , ['status'=>'0'] );
    if( $isDeleted ){
      $this->session->set_flashdata('success',"Deleted");
      redirect('Company');
    }
    else{
      $this->session->set_flashdata('error',"Something Wents Wrong. Please try again.");
      redirect('Company');
    }
  }



  public function update_company(){
    $post = $this->input->post();
    $comp_id = $post['company_value'];
    $updateData = ['comp_name'=>$post['company_name'] ];
    $isUpdated = $this->Master_model->update('company',['comp_id'=>$comp_id] , $updateData );
      if( $isUpdated ){
        $this->session->set_flashdata('success',"Company Updated Successfully");
        redirect('Company');
      }
      else{
        $this->session->set_flashdata('error',"Something wents wrong");
        redirect('Company');
      }
  }


  public function update_sub_company(){
		$post = $this->input->post();
		$comp_id = $post['company_value'];
		$updateData = [
      'sub_comp_name'=>$post['company_name'] ,
      'sub_comp_code'=>$post['code'],
      'sub_comp_contact'=>$post['contact'],
      'sub_comp_address'=>$post['address'],
		 ];

		$isUpdated = $this->Master_model->update('sub_company',['sub_comp_id'=>$comp_id] , $updateData );
			if( $isUpdated ){
				$this->session->set_flashdata('success',"Company Updated Successfully");
				redirect('Company/create_sub_company?company_value='.$post['company_id']);
			}
			else{
				$this->session->set_flashdata('error',"Something wents wrong");
				redirect('Company/create_sub_company?company_value='.$post['company_id']);
			}
	}

  public function getBHD( ){
    $company_id = $this->input->post('company_id');
    $sqlQuery = "SELECT *
             FROM employee_master em
             INNER JOIN employee_category ec ON ec.category_id = em.type
             WHERE em.company_id = '{$company_id}' AND em.status = '1' AND  em.type = 8  LIMIT 1";
    $data= $this->Master_model->rawQuery( $sqlQuery )[0];
    echo json_encode( $data );
  }

  public function searchUserFromCompany(){
    $companyId = $this->input->post('company_id');
    $responseData['selectedUser'] = $this->Master_model->select('employee_master',null,null,['company_id'=> $companyId , 'type' => 10 ] );
    echo json_encode( $responseData );

  }


  public function getListofSubcompany(){
  		$company_id = $this->input->post('company_value');
  		$sqlQuery = "SELECT * FROM sub_company WHERE status = '1' AND company_id = '{$company_id}' ";
  		$sub_company_list = $this->Master_model->rawQuery( $sqlQuery );
  		echo json_encode( $sub_company_list );
  }






}
