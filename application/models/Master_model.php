<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\Exception;

class Master_model extends CI_Model {

     public function __construct(){

     }

     public function insert( $tablename , $data ){
      //print_r($data);exit();
       $query = $this->db->insert($tablename,$data);
          if($this->db->affected_rows()) return true;
            else return false;
     }

    public function export_Report( $type ){
       $sql = $this->getSqlForTotalRequests( $type );
       	$exp = $this->db->query( $sql );
       	 $data = $exp->result_array();
       	return $data ;

    }

  public function configureEmail( ){
      $mail = new PHPMailer(true);
      try {
            $mail->SMTPDebug = 0;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'gateway.metropolisindia.com';                   // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'mhlct3@metropolisindia.com';                 // SMTP username
            $mail->Password = '@MscfrT@123';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->setFrom('mhlct3@metropolisindia.com');

        return $mail;
      }
      catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        echo $e->getMessage(); //Boring error messages from anything else!
      }

  }

     public function getSqlForTotalRequests( $type ){
         $id = $this->session->userdata('log_user')['user_id'];
         	if( $type == 3  ){

         	    $sqlQuery = "SELECT sc.patient_id,concat(vs.date_of_collection,vs.camp_from_date) as date_of_collection ,vs.location,t.type,p.patient_name,concat(p.patient_age,'/',p.patient_gender) as age,p.patient_contact,concat(vs.Address,vs.HospitalAddress) as Address,vs.clients_name,vs.refering_doctor_name,tm.test_name,tp.type_name,vs.client_contact,vs.client_email,concat(vs.phebo_id,',',vs.contact) 'collection person name',vs.Remarks,sup.status_type,vs.v_id_number FROM `sample_collection` sc inner join patient p on sc.patient_id = p.patient_id inner join visit_schedule vs on sc.visit_id = vs.visit_id join type_of_collection t on vs.type_of_collection = t.t_id join type_of_payment tp on sc.payment_status=tp.type_id join test_master tm on sc.test = tm.test_id join status_update sup on vs.status = sup.status_id join employee_master em on vs.emp_id = em.id where vs.requestor_id in ('$id','10','9','2')";

			return $sqlQuery;
		}
		else{

		}
     }

     public function select( $tablename ,$limit=null , $order_by=null ,$where=[] ){

        $query = $this->db->where($where)->order_by($order_by)->get( $tablename , $limit );
        if( $query ->num_rows() <= 0 ) return [];
        else return $query->result();
     }

     public function advancedSearch( $tablename , $where=[] , $orderby=null , $limit=null , $offset=null ){

       $query = $this->db->where($where)
                         ->order_by($orderby)
                         ->get( $tablename , $limit );
       if( $query ->num_rows() <= 0 ) return [];
       else return $query->result();

     }

     public function rawQuery($sql)
     {
       $query = $this->db->query($sql);

       if( $query ->num_rows() <= 0 ) return [];
       else return $query->result();
     }

     public function rawQueries($sql)
     {

       $query = $this->db->query($sql);

       if( $query ->num_rows() <= 0 ) return [];
       else return $query->result();
     }
	 
	 
	 public function rawQueries_one($sql)
     {
        $query=$this->db->query("SELECT * FROM patient where patient_id = '$sql'");
		if($query->num_rows() > 0)
		{
			foreach($query->result_array() as $row)
			{
				$data = $row;
			}
			return $data;
		}
		else
		{
			return False;
		}
     }

     public function delete($tablename,$where=[]){

       $query = $this->db->where($where)->delete($tablename);
       if($this->db->affected_rows()) return true;
         else return false;
     }


     public function update($tablename,$where=[],$data){
       $query = $this->db->where($where)->update($tablename,$data);
       if($this->db->affected_rows()) return true;
         else return false;

     }


     public function lastInsertId(){
       return $this->db->insert_id();
     }

    public function isRowPresent( $sql ){
      $query = $this->db->query($sql);
      if( $query ->num_rows() <= 0 ) return false;
      else return true;
    }


}
