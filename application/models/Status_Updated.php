<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Status_Updated extends CI_Model {

     public function __construct()
     {

     }

     public function status_change( $tablename,$where,$data ){
        $this->db->where($where)->update($tablename,$data);
        if($this->db->affected_rows()) return true;
        return false;
     }

     public function select_dat( $sql ){
      $queries = $this->db->query( $sql );
      return $queries->result();
    }
}
