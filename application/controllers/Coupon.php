<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Coupon extends My_Controller{

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
		 $sqlQuery = "SELECT * FROM company WHERE company.status = '1' ";
		 $data['company_list'] = $this->Master_model->rawQuery( $sqlQuery );
		 $this->loadView('form/coupon_form' , $data );
	}


	public function add_new_coupon( ){

		$this->load->model('Casual_Model');
		$post = $this->input->post();
		//$frontImageName = $post['coupon_name'].'_front_'.time();
		//$rearImageName = $post['coupon_name'].'_rear_'.time();
		$explodData =explode(",",$post['client_id'] );
		$isPresent = $this->Casual_Model->isAlreadySeriesCouponExist(
																  	$post['pre_text'] ,
																 	  $post['series_start'] ,
																	  $post['series_end'] ,
																	  $explodData[0]
		);
		if( $isPresent ){
			$this->session->set_flashdata('error',"Series you have given already used try with another series");
			redirect('Coupon');
		}
		else{
			$frontImageName = $this->uploadCouponImage( $_FILES['front_image'] ,  $post['coupon_name'].'_front_'.time() );
			$rearImageName = $this->uploadCouponImage( $_FILES['back_image'] , $post['coupon_name'].'_rear_'.time() );
			$this->Casual_Model->addCouponLogger([
				'pre_text' => $post['pre_text'],
				'series_start' => $post['series_start'],
				'front_image' => $frontImageName,
				'back_image' => $rearImageName,
				'series_end' => $post['series_end'],
				'client_id' => $explodData[0],
			]);
			 $insert_id = $this->db->insert_id();
			for ($i=$post['series_start']; $i < ( (int)$post['series_end'] + 1 ) ; $i++) {
				// echo $post['pre_text'].$i;
				$insertData = [
					'coupon_name' => $post['coupon_name'],
					'client_id' => $explodData[0],
					'coupon_code' =>$post['pre_text'].$i,
					'client_code' => $post['client_codes'],
					'valid_from' => $post['valid_from'],
					'valid_till' => $post['valid_till'],
					'coupon_type' => $post['coupon_type'],
					'cl_id' => $insert_id
				];
				//print_r($insertData);exit;
				$isCouponCreated = $this->Master_model->insert('coupon_master' , $insertData );
			}
		}
		if( $isCouponCreated ){
			  $this->session->set_flashdata('success',"Coupon added successfully.");
			redirect('Coupon');
		}
		else{
			$this->session->set_flashdata('error',"Coupon not added.");
			redirect('Coupon');
		}
	}

	public function view_coupon(){
    	$sql = "SELECT cl.*,COUNT(*) as total_coupon , COUNT(CASE WHEN cm.isUsed = 1 THEN 1 END) AS notused , COUNT(CASE WHEN cm.isUsed = 2 THEN 1 END) AS used  FROM `coupon_logger` cl 
            LEFT JOIN coupon_master cm ON cm.cl_id = cl.cl_id
            GROUP BY cl.cl_id " ;
		
		$data['tableData'] = $this->Master_model->rawQuery($sql);
		
		//print_r( $data['tableCount'] );exit;
		$this->loadView( 'view/coupon_company_list', $data);
	}

	public function view_coupon_list(){
		$id = $this->input->post('c_id');
		//echo $id;exit;
    $sql ="SELECT * FROM coupon_master where cl_id = '{$id}' ;" ;
		$data['tableData'] = $this->Master_model->rawQuery($sql);
		$this->loadView('view/coupon_list', $data );
	}

	public function uploadCouponImage( $files , $imageName ){
		$target_dir = realpath( APPPATH."../coupon_image");
    $target_file = $target_dir .'/'.basename( $files['name'] );

    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

		$newFile = $target_dir.'/'.$imageName.'.'.$imageFileType;


		 // Check if image file is a actual image or fake image
     $check = getimagesize( $files["tmp_name"] );
     	if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    	}
			else {
        	echo "File is not an image.";
        	$uploadOk = 0;
    	}

		// Check if file already exists
			if (file_exists($target_file)) {
    		echo "Sorry, file already exists.";
    		$uploadOk = 0;
			}

		// Check file size
		if ( $files["size"] > 500000) {
    		echo "Sorry, your file is too large.";
      	$uploadOk = 0;
		}

		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
					&& $imageFileType != "gif" ) {
    	echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    	$uploadOk = 0;
		}

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
    	echo "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
		}
		else {
    		if ( move_uploaded_file( $files["tmp_name"], $newFile)) {
        	echo "The file ". basename( $files["name"]). " has been uploaded.";
        	return $imageName.".".$imageFileType;
    		}
				else {
        	echo "Sorry, there was an error uploading your file.";
    		}
		}
	}




}
