<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Images_model extends CI_Model 

{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}

	
	public function get_fileupload_data($u_id){
		$this->db->select('images.img_id,images.img_name,images.imag_org_name')->from('images');		
		$this->db->where('u_id', $u_id);
		$this->db->where('img_undo', 0);
		$this->db->order_by("images.img_create_at", "DESC");
		return $this->db->get()->result();
	}
	
	


}