<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Casual_Model extends CI_Model {

 public function __construct(){

 }

 public function scheduleVisit( $data ){
   $data['visit_unique_id'] =
   $query = $this->db->insert('visit_schedule',$data);
      if($this->db->affected_rows()) return $this->db->insert_id();
        else return false;
 }

  public function sample_collections( $data ){
   $query = $this->db->insert('sample_collection',$data);
      if($this->db->affected_rows()) return $this->db->insert_id();
        else return false;
 }

 public function addPatient( $data ){
   $query = $this->db->where('patient_contact', $data['patient_contact'] )
            ->or_where( 'patient_email' , $data['patient_email']  )
            ->get( 'patient' , 1 );
   if( $query ->num_rows() >= 0 ){
      //echo "dd";exit;
      $patientInsert = $this->db->insert('patient' , $data );
      return $this->db->insert_id();
   }
   else{
     return $query->result()[0]->patient_id;
   }
 }

  public function isUserPresent( $contact , $email  ){
    $query = $this->db->where( 'contact' , $contact )
                      ->or_where( 'email' , $email  )
                      ->get( 'employee_master' , 1 );
    if( $query ->num_rows() <= 0 ) return false;
    else return true;
  }

  public function mapUser( $user_id ){
    if( ! $this->isMapped( $user_id ) ){
      $this->db->insert('client_user_mapping' , [ 'user_id' , $user_id ] );
    }
    else return;
  }


  public function getReportToId( $employee_id  ){
    return $this->db->where( 'id' , $employee_id )
                ->get('employee_master')->row()->report_to;
  }


  public function isMapped( $user_id ){
    $query = $this->db->where( 'user_id' , $user_id )
                      ->get('client_user_mapping' , 1 );
    if( $query ->num_rows() <= 0 ) return false;
    else return true;
  }


  public function getTotalNumberOfProject( $id = null ){
    if( $id ){
      $query = $this->db->query("SELECT * FROM project WHERE project_created_by='{$id}' ");
      return $query->num_rows();
    }
    else{
      $query = $this->db->query('SELECT * FROM project');
      return $query->num_rows();
    }
  }



  public function MapProject( $project_id , $assigned_to , $assigned_by ){
    if( ! $this->isProjectMap( $project_id , $assigned_to ) ){
      $insertData = [
                      'project_id'=> $project_id ,
                      'assigned_to' => $assigned_to ,
                      'assigned_by' => $assigned_by
                    ];
      $this->db->insert('project_maping' , $insertData );
      return true;
    }
    else return false;
  }

  public function isProjectMap( $project_id , $assigned_to ){
    $query = $this->db->where('project_id' , $project_id )
                      ->where('assigned_to' , $assigned_to  )
                      ->get( 'project_maping' , 1 );
    if( $query ->num_rows() <= 0 ) return false;
    else return true;
  }


  public function isAlreadySeriesCouponExist( $pre_text , $startSeries , $endSeries , $client_id ){
    $sqlQuery = "SELECT * FROM `coupon_logger` WHERE pre_text = '{$pre_text}' AND {$endSeries} >= series_start AND {$endSeries} <= series_end";
    $query = $this->db->query( $sqlQuery );
    if( $query ->num_rows() <= 0 ) return false;
    else return true;
  }

  public function addCouponLogger( $data ){
    $this->db->insert('coupon_logger' , $data );
    return ($this->db->affected_rows() != 1) ? false : true;
  }
  
  public function get_details($visitid)
  {
	  $query=$this->db->query("SELECT * FROM visit_schedule where visit_id = $visitid");
	  return $query->row_array();
  }
  
  public function get_sample_collected($visitid)
  {
	  $query=$this->db->query("SELECT * FROM sample_collection where visit_id = $visitid");
	  return $query->row_array();
  }



}
