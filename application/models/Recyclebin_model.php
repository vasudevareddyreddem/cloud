<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recyclebin_model extends CI_Model 

{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}

	public function get_undo_file_data($u_id){
		$this->db->select('images.img_id,images.img_name,images.imag_org_name')->from('images');		
		$this->db->where('images.u_id', $u_id);
		$this->db->where('images.img_undo', 1);
		return $this->db->get()->result();
	}
	public function get_undo_floder_data($u_id){
		$this->db->select('floder_list.f_id,floder_list.f_name,floder_list.u_id')->from('floder_list');		
		$this->db->where('floder_list.u_id', $u_id);
		$this->db->where('f_undo', 1);
		return $this->db->get()->result();
	}
	public function get_delte_image_details($u_id,$img_id){
		$this->db->select('*')->from('images');		
		$this->db->where('images.u_id', $u_id);
		$this->db->where('images.img_id', $img_id);
		return $this->db->get()->row_array();
	}
	public function get_delte_folder_details($u_id,$f_id){
		$this->db->select('*')->from('floder_list');		
		$this->db->where('floder_list.u_id', $u_id);
		$this->db->where('floder_list.f_id', $f_id);
		return $this->db->get()->row_array();
	}
	public function update_filename_changes($img_id,$data){
		$this->db->where('img_id', $img_id);
		return $this->db->update('images', $data);
	}
	public function delte_image($u_id,$img_id)
	{
		$sql1="DELETE FROM images WHERE u_id = '".$u_id."'  AND img_id = '".$img_id."' ";
		return $this->db->query($sql1);
	}
	public function delte_folder($u_id,$f_id)
	{
		$sql1="DELETE FROM floder_list WHERE u_id = '".$u_id."'  AND f_id = '".$f_id."' ";
		return $this->db->query($sql1);
	}public function delte_folder_images_list($u_id,$f_id)
	{
		$this->db->select('images.img_id,images.img_name,images.imag_org_name,images.floder_id')->from('images');		
		$this->db->where('images.u_id', $u_id);
		$this->db->where('images.floder_id', $f_id);
		return $this->db->get()->result_array();
	}
	public function get_delete_floder_data($u_id,$f_id)
	{
		$this->db->select('images.img_id,images.img_name,images.imag_org_name,images.floder_id')->from('images');		
		$this->db->where('images.u_id', $u_id);
		$this->db->where('images.floder_id', $f_id);
		return $this->db->get()->result();
	}
	
	
}