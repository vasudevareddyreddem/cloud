<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recent_model extends CI_Model 

{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}

	public function recen_get_pagewisefileupload_data($u_id){
		$this->db->select('images.img_id,images.img_name,images.imag_org_name')->from('images');		
		$curr_date = date('Y-m-d h:i:s A', strtotime('-7 days'));
		$this->db->where('images.u_id', $u_id);
		$this->db->where('images.img_create_at >', $curr_date);
		$this->db->order_by("images.img_create_at", "DESC");
		return $this->db->get()->result();
	}
	public function recen_get_links_data($u_id){
		$this->db->select('links.l_id,links.l_name,links.l_created_at')->from('links');		
		$curr_date = date('Y-m-d h:i:s A', strtotime('-7 days'));
		$this->db->where('links.u_id', $u_id);
		$this->db->where('links.l_created_at >', $curr_date);
		$this->db->order_by("links.l_created_at", "DESC");
		return $this->db->get()->result_array();
	}
	public function recen_get_floder_data($u_id){
			

		$curr_date = date('Y-m-d h:i:s A', strtotime('-7 days'));
 		//$curr_date = $date->format('Y-m-d h:i:s A');
		$this->db->select('floder_list.f_id,floder_list.f_name')->from('floder_list');		
		$this->db->where('floder_list.u_id', $u_id);
		$this->db->where('floder_list.f_create_at >', $curr_date);
		$this->db->where('floder_list.f_id !=','');
		$this->db->group_by('floder_list.f_id');
		$this->db->order_by("floder_list.f_create_at", "DESC");
		return $this->db->get()->result();
	}
	public function get_flodername_data($u_id){
		$curr_date = date('Y-m-d h:i:s A', strtotime('-7 days'));
		$this->db->select('floder_list.f_id,floder_list.f_name')->from('floder_list');		
		$this->db->where('u_id', $u_id);
		$this->db->where('f_undo', 0);
		$this->db->where('floder_id', 0);
		$this->db->where('floder_list.f_create_at >', $curr_date);
		$this->db->order_by("floder_list.f_create_at", "DESC");
		return $this->db->get()->result();
	}
	
	
}