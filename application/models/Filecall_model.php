<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Filecall_model extends CI_Model 

{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
	public function save_filecall($data){
		$this->db->insert('filecall_list', $data);
		return $insert_id = $this->db->insert_id();
	}
	public function save_filecall_notification($data){
		$this->db->insert('filecaal_notification_list', $data);
		return $insert_id = $this->db->insert_id();
	}
	public function update_filecall_details($id,$data){
		$this->db->where('f_c_id',$id);
		return $this->db->update('filecall_list',$data);
	}
	

	
	
}