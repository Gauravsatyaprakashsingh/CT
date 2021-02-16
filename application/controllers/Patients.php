<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Patients extends My_Controller {
    
    public function __construct()
    {
        parent::__construct();
		
		
	}


    public function view_patients()
	{
		$sql_query = "SELECT * FROM patient order by patient_id desc";
		$data['patients_details'] = $this->Master_model->rawQuery($sql_query);

		$this->loadView('view/patients_view',$data);
	}

    public function view_details()
	{
		$patients_id = $this->uri->segment(3);
		
		$data['payment_type'] = $this->Master_model->select('type_of_payment',null,null,['status'=>'1']);
		$sqlQuerys = "SELECT DISTINCT(state) FROM master_pincode";
		$data['state'] = $this->Master_model->rawQuery( $sqlQuerys );
		$stateQuerys = "SELECT DISTINCT(State) FROM master_pincode";
		$data['state_Sample'] = $this->Master_model->rawQuery( $stateQuerys );
		$sqlQuery = $this->getSqlQueryForProjectList($this->session->userdata('log_user')['type']);
		$data['project_list'] = $this->Master_model->rawQuery( $sqlQuery );
		
		
		$sql_query = "SELECT * FROM patient where patient_id ='$patients_id'";
		$data['patients_details'] = $this->Master_model->rawQuery($sql_query);
		$data['patient_id'] = $patients_id;
		$this->loadView('form/request_sample_collection_patients',$data);
		
	}
	
	public function getSqlQueryForProjectList($type)
	{
		$id = $this->session->userdata('log_user')['user_id'] ;
		if( $type == '1')
		return $sql = "SELECT * FROM project WHERE project_status = '1'";
		elseif( $type == '3' || $type == '4')
			return $sql = "SELECT * FROM project_maping pm
                     INNER JOIN project p ON p.project_id = pm.project_id and pm.assigned_to = {$id}";
		else
			return $sql = "SELECT * FROM project p
                      INNER JOIN employee_master em ON em.company_id = p.Company_id AND em.id = {$id}";
	}



    public function getSampleForm()
	{
		$data['uniqueId'] = mt_rand(15, 50);
		$data['payment_type'] = $this->Master_model->select('type_of_payment',null,null,['status'=>'1']);
		$patient_id = $this->input->post('patient_id');
		
		$data_chk = $this->Master_model->rawQueries_one($patient_id);
		$data['patients_details'] = $data_chk;
		
		$this->load->view('ajax_form/ajax_sample_request_patients',$data);
		
	}









}