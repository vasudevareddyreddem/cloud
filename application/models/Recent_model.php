<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recent_model extends CI_Model 

{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}

	public function recen_get_pagewisefileupload_data($u_id){
		$this->db->select('images.img_id,images.img_name,images.imag_org_name')->from('recently_file_open');		
		$this->db->join('images', 'images.img_id = recently_file_open.file_id', 'left');		
		$this->db->where('recently_file_open.u_id', $u_id);
		$this->db->where('images.img_undo', 0);
		$this->db->where('images.img_id !=','');
		$this->db->group_by('images.img_id');
		$this->db->order_by("recently_file_open.r_file_create_at", "DESC");
		return $this->db->get()->result();
	}
	public function recen_get_floder_data($u_id){
		$this->db->select('floder_list.f_id,floder_list.f_name')->from('recently_floder_open');		
		$this->db->join('floder_list', 'floder_list.f_id = recently_floder_open.f_id', 'left');		
		$this->db->where('recently_floder_open.u_id', $u_id);
		$this->db->where('f_undo', 0);
		$this->db->where('floder_list.f_id !=','');
		$this->db->group_by('floder_list.f_id');
		$this->db->order_by("recently_floder_open.r_f_create_at", "DESC");
		return $this->db->get()->result();
	}
	
	
}