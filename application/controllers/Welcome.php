<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Welcome extends My_Controller{

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
		 $this->loadView('welcome_message' , [] );
	}

	public function getCity( ){
		$state = $this->input->post('state');
		$state_id ="";
		if( $state ){
			foreach ($state as $key => $value) {
				$state_id.="'{$value}',";
			}
		}
		$state_id = trim( $state_id , ',');
		$sql = "select * from cities where StateID in ({$state_id}) and status ='1' ";
	  $data =	$this->Master_model->rawQuery($sql);
		echo json_encode( $data );
	}


	public function getSisterLab(){
		$zsc_id = $this->input->post('zsc_id');
		$sqlQuery = "SELECT sister_id , sis_name FROM sister_lab_master slm WHERE slm.zsc_id = {$zsc_id}";
		$data =	$this->Master_model->rawQuery($sqlQuery);
		echo json_encode( $data );
	}

	


}
