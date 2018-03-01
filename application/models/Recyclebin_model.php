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
	public function update_folder_changes($f_id,$data){
		$this->db->where('f_id', $f_id);
		return $this->db->update('floder_list', $data);
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
	public function get_pagewiseflodername_data($f_id){
		$this->db->select('floder_list.f_id,floder_list.f_name')->from('floder_list');		
		//$this->db->where('f_undo', 0);
		$this->db->where('floder_id',$f_id);
		$this->db->order_by("floder_list.f_create_at", "DESC");
		return $this->db->get()->result();
	}
		public function delete_for_all_data($f_id,$u_id){
		$this->db->select('floder_id,floder_id,( SELECT  COUNT(*)FROM    floder_list WHERE   floder_id = f_id ) + ( SELECT  COUNT(*) FROM    floder_list WHERE   floder_id = f_id ) - ( SELECT  COUNT(*) FROM    floder_list WHERE   floder_id = f_id AND floder_id = f_id )  COUNT')->from('floder_list');		
		$this->db->where('floder_list.floder_id <=', $f_id);
		$this->db->where('floder_list.u_id', $u_id);
		$this->db->group_by('floder_list.f_id');
		return $this->db->get()->result_array();
	}
	
	public function perment_delete_for_all_data($f_id,$u_id){
		$this->db->select('floder_id,f_id,( SELECT  COUNT(*)FROM    floder_list WHERE   floder_id = f_id ) + ( SELECT  COUNT(*) FROM    floder_list WHERE   floder_id = f_id ) - ( SELECT  COUNT(*) FROM    floder_list WHERE   floder_id = f_id AND floder_id = f_id )  COUNT')->from('floder_list');		
		$this->db->where('floder_id >=', $f_id);
		$this->db->where('u_id', $u_id);
		$this->db->where('f_undo', 0);
		$this->db->order_by("floder_list.f_id", "DESC");
		return $this->db->get()->result_array();
	}
	public function permedelte_folder_images_list($f_id)
	{
		$this->db->select('images.img_id,images.img_name,images.imag_org_name,images.floder_id')->from('images');		
		$this->db->where('images.floder_id', $f_id);
		return $this->db->get()->result_array();
	}
	public function permenentdelte_image($img_id)
	{
		$sql1="DELETE FROM images WHERE img_id = '".$img_id."' ";
		return $this->db->query($sql1);
	}
	public function permenent_shared_delte_folder($f_id)
	{
		$sql1="DELETE FROM shared_folder WHERE f_id = '".$f_id."' ";
		return $this->db->query($sql1);
	}
	public function permenentdelte_folder($f_id)
	{
		$sql1="DELETE FROM floder_list WHERE f_id = '".$f_id."' ";
		return $this->db->query($sql1);
	}
	
	
}