<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Kit extends My_Controller{

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
		 $this->loadView('form/kit_form'  );
	}

	public function view_kit(){
    $sql = "SELECT * FROM kit_master where kit_status = '1'";
		$data['tableData'] = $this->Master_model->rawQuery($sql);
		$this->loadView('view/kit_list', $data );
	}




	public function add_new_kit(){
	  $post = $this->input->post();
		$insertData = [
			'kit_name' => $post['kit'],
			'kit_current_quantity' => $post['cquantity'],
			'kit_minimum_quantity' => $post['mquantity'],
			'kit_description' => $post['desc']
	   ];

		$isInserted = $this->Master_model->insert('kit_master' , $insertData );
		if( $isInserted ){
			$this->session->set_flashdata('success',"Kit Create Successfully");
			redirect('Kit');
		}
		else{
			$this->session->set_flashdata('error',"Something wents wrong");
			redirect('Kit');
		}
	}

	public function edit_kit( ){
		$kit_id = $this->input->post('kit_value');
		$sql = "SELECT * FROM  kit_master km WHERE km.kit_id ='{$kit_id}'";
		$data['kitData'] = $this->Master_model->rawQuery( $sql )[0];
		$this->loadView('form/kit_form',$data);
	}


	public function update_kit(){
		$post = $this->input->post();
		$kit_id = $post['kit_value'];
		$updateData = [
			'kit_name' => $post['kit'],
			'kit_current_quantity' => $post['cquantity'],
			'kit_minimum_quantity' => $post['mquantity'],
			'kit_description' => $post['desc']
		 ];

		$isUpdated = $this->Master_model->update('kit_master',['kit_id'=>$kit_id] , $updateData );
			if( $isUpdated ){
				$this->session->set_flashdata('success',"Kit Updated Successfully");
				redirect('Kit/view_kit');
			}
			else{
				$this->session->set_flashdata('error',"Something wents wrong");
				redirect('Kit/view_kit');
			}
	}


	public function sendEmail(){
		$project_id = $this->input->get('value');
		$sql = "SELECT * FROM  project p
						INNER JOIN client_master cm on cm.client_code = p.client_code
						WHERE p.project_id ='{$project_id}'";
		$data['project'] = $this->Master_model->rawQuery( $sql )[0];
		$this->loadView('form/projectEmail', $data );
	}

	public function edit_project( ){
		$project_id = $this->input->post('project_value');
		$sql = "SELECT * FROM  project p
						INNER JOIN client_master cm on cm.client_code = p.client_code
						WHERE p.project_id ='{$project_id}'";
		$data['project'] = $this->Master_model->rawQuery( $sql )[0];
		$sql = "SELECT * FROM sample_collection WHERE project_id ='$project_id'";
		$data['sampleData'] = $this->Master_model->rawQuery( $sql );
		$this->loadView('form/edit_project',$data);
	}

	protected function sqlQueryForViewProject( $type ){
		$id = $this->session->userdata('log_user')['user_id'] ;
		$sql = "SELECT * FROM project p LEFT JOIN employee_master em on em.id = p.project_assign_to where p.project_created_by = '{$id}' ";
		if( $type == 3 || $type == 7 ){
			$sql = "SELECT * FROM project p where p.project_assign_to = '{$id}'";
			return $sql;
		}
		elseif( $type == 1 ){
			$sql = "SELECT * FROM project p ";
			return $sql;
		}
		else{
     return $sql;
		}
	}

	public function delete_kit(){
		$id = $_GET['value'];
		$sql = $this->db->query( "update kit_master set kit_status = '0' where kit_id = '{$id}' " );
		if($sql){
				$this->session->set_flashdata('success',"Kit Deleted Successfully");
				redirect('Kit/view_kit');
			}
			else{
				$this->session->set_flashdata('error',"Something wents wrong");
				redirect('Kit/view_kit');
			}
	}
}
