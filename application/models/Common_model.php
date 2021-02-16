<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common_model extends CI_Model {

 public function __construct(){

 }

  public function allProject( ){
    $sqlQuery = $this->getSqlQueryTotalProject( $this->session->userdata('log_user')['type'] );
    $queryResult = $this->db->query( $sqlQuery );
    return $queryResult->result();
  }


  public function allUser(){
    $sqlQuery = $this->getSqlQueryTotalUser( $this->session->userdata('log_user')['type'] );
    $queryResult = $this->db->query( $sqlQuery );
    return $queryResult->result();
  }

  public function getClientAllUser(){
    $sqlQuery = $this->getSqlQueryClientTotalUser( $this->session->userdata('log_user')['type'] );
    $queryResult = $this->db->query( $sqlQuery );
    return $queryResult->result();
  }

  public function getSqlQueryClientTotalUser( $type ){
    $id = $this->session->userdata('log_user')['user_id'] ;
    $company_id = $this->session->userdata('log_user')['company_id'] ;
    if( $type == 8 ){
      $sqlQuery = "SELECT * FROM employee_master em
              INNER JOIN employee_category ec ON ec.category_id = em.type
              WHERE em.status = '1'
              AND ( em.report_to ='{$id}' OR em.added_by_user = '{$id}' OR em.company_id = '{$company_id}' ) AND em.type in ( 9, 10 ,11 ) ";
    return $sqlQuery;
    }
    elseif( $type == 9 ){
      $sqlQuery = "SELECT * FROM employee_master em
              INNER JOIN employee_category ec ON ec.category_id = em.type
              WHERE em.status = '1'
              AND ( em.report_to ='{$id}' OR em.added_by_user = '{$id}' AND em.company_id = '{$company_id}' ) AND em.type in ( 10 ,11 ) ";
      return $sqlQuery;
    }
    elseif( $type == 10 ){
      $sqlQuery = "SELECT * FROM employee_master em
              INNER JOIN employee_category ec ON ec.category_id = em.type
              WHERE em.status = '1'
              AND ( em.report_to ='{$id}' OR em.added_by_user = '{$id}' AND em.company_id = '{$company_id}' ) AND em.type = 11 ";
      return $sqlQuery;
    }
  }

  public function getSqlQueryTotalUser( $type ){
    $id = $this->session->userdata('log_user')['user_id'] ;
    $company_id = $this->session->userdata('log_user')['company_id'] ;
		$sql = "SELECT * FROM employee_master em
            INNER JOIN employee_category ec ON ec.category_id = em.type
            WHERE em.status = '1' AND ( em.report_to ='{$id}' OR em.added_by_user = '{$id}' ) AND em.type in (3,4,6,8,9,10,11) ";
		if( $type == 1 ){
			$sql = "SELECT * FROM employee_master em
              INNER JOIN employee_category ec ON ec.category_id = em.type
              WHERE em.status = '1' AND em.type in ( 3, 4 , 6 ,8,9,10 ,11 ) ";
			return $sql;
		}
    elseif( $type == 8  ){
      $sql = "SELECT * FROM employee_master em
              INNER JOIN employee_category ec ON ec.category_id = em.type
              WHERE em.status = '1' AND ( em.report_to ='{$id}' OR em.added_by_user = '{$id}' OR  em.company_id = '{$company_id}' ) AND em.type in (9,10,11)";
      return $sql;
    }
		else{
     return $sql;
		}
  }

  public function getSqlQueryTotalProject( $type ){
    $id = $this->session->userdata('log_user')['user_id'] ;
		$sql = "SELECT * FROM project_maping pm
						INNER JOIN project p ON p.project_id = pm.project_id
						WHERE pm.assigned_to = '{$id}'";

		if( $type == 1 ){
			$sql = "SELECT * FROM project p WHERE p.project_status = '1'";
			return $sql;
		}
    elseif( $type == 8 ){
      $sql = "SELECT * FROM project p WHERE p.project_status = '1' AND p.client_bh_id = {$id}";
      return $sql;
    }
		else{
     return $sql;
		}
  }

 public function addPatient( $data ){
   $query = $this->db->where('patient_contact', $data['patient_contact'] )
            ->or_where( 'patient_email' , $data['patient_email']  )
            ->get( 'patient' , 1 );
   if( $query ->num_rows() <= 0 ){
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




}
