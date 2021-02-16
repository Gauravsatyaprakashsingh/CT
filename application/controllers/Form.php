<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Form extends My_Controller{

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
	public function client_master(){
		 $this->loadView('sample/client_master' , [] );
	}

	public function coupon_master(){
		$this->loadView('sample/coupon_master', [] );
	}

	public function request_sample_collection(){
		$this->loadView('sample/request_sample_collection',[] );
	}

	public function sample_registration(){
		$this->loadView('sample/sample_registration' , [] );
	}

	public function user_mapping(){
		$this->loadView('sample/user_mapping' , [] );
	}

	public function Phelbotomist(){
		$this->loadView('sample/Phelbotomist' , [] );
	}

	public function phelbotomist_payment(){
		$this->loadView('sample/phelbotomist_payment' , [] );
	}






}
