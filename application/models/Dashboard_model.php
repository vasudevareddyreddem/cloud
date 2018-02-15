<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_model extends CI_Model 

{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}

	public function save_userfile($data){
		$this->db->insert('images', $data);
		return $insert_id = $this->db->insert_id();
	}
	public function get_fileupload_data($u_id){
		$this->db->select('images.img_name,images.imag_org_name')->from('images');		
		$this->db->where('u_id', $u_id);
		$this->db->order_by("images.img_create_at", "DESC");
		$this->db->limit(8);
		return $this->db->get()->result();
	}
	
	public function update_user_data($u_id,$data){
		$this->db->where('u_id', $u_id);
		return $this->db->update('users', $data);
	}


}