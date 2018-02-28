<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Images_model extends CI_Model 

{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}

	
	public function get_folder_details($f_id){
		$this->db->select('floder_list.f_id,floder_list.page_id,floder_list.floder_id')->from('floder_list');		
		$this->db->where('f_id', $f_id);
		return $this->db->get()->row_array();
	}
	public function get_fileupload_data($u_id){
		$this->db->select('images.img_id,images.img_name,images.imag_org_name')->from('images');		
		$this->db->where('u_id', $u_id);
		$this->db->where('img_undo', 0);
		$this->db->order_by("images.img_create_at", "DESC");
		return $this->db->get()->result();
	}
	public function get_all_datainto_zip($u_id,$f_id){
		$this->db->select('images.img_id,images.img_name,images.imag_org_name')->from('images');		
		$this->db->where('u_id', $u_id);
		$this->db->where('floder_id', $f_id);
		$this->db->order_by("images.img_create_at", "DESC");
		return $this->db->get()->result();
	}
	public function update_foldername_changes($f_id,$data){
		$this->db->where('f_id', $f_id);
		return $this->db->update('floder_list', $data);
	}
	
/*filesharing*/
public function save_file_sharing($data){
		$this->db->insert('shared_files', $data);
		return $insert_id = $this->db->insert_id();
	}
	public function get_shared_file($u_id){
		$this->db->select('images.img_id,images.img_name,images.imag_org_name,shared_files.s_permission')->from('shared_files');
		$this->db->join('images', 'images.img_id = shared_files.img_id', 'left');
		$this->db->where('shared_files.u_id', $u_id);
		return $this->db->get()->result();
	}
/*filesharing*/
}