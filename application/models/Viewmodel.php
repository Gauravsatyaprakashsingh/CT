<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Viewmodel extends CI_Model
{
    public function __construct()
	 {
            parent::__construct();
		    //$this->load->model("stringmodel");
			$this->load->helper('url');
			$this->load->helper('date');
			$this->load->library('session');
            $this->load->database();


     }


	public function get_names($id)
		{


			$this->db->select('*');
			$this->db->from('employee_master');
			$my_array = array('type'=>$id);
			$this->db->where($my_array);
			$q = $this->db->get();
			if($q->num_rows() > 0)
			{
				foreach ($q->result() as $row)
				{
		  			$data[] = $row;
				}
				return json_encode($data);
			}
		}





}
?>
