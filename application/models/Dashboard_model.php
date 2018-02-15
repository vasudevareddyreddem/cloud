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
	public function save_floders($data){
		$this->db->insert('floder_list', $data);
		return $insert_id = $this->db->insert_id();
	}
	public function recently_view_data($data){
		$this->db->insert('recently_floder_open', $data);
		return $insert_id = $this->db->insert_id();
	}
	public function get_flodername($f_id){
		$this->db->select('floder_list.f_id,floder_list.f_name')->from('floder_list');		
		$this->db->where('f_id', $f_id);
		return $this->db->get()->row_array();
	}
	public function get_fileupload_data($u_id){
		$this->db->select('images.img_name,images.imag_org_name')->from('images');		
		$this->db->where('u_id', $u_id);
		$this->db->where('img_undo', 0);
		$this->db->where('page_id', 0);
		$this->db->where('floder_id', 0);
		$this->db->order_by("images.img_create_at", "DESC");
		$this->db->limit(8);
		return $this->db->get()->result();
	}
	public function get_flodername_data($u_id){
		$this->db->select('floder_list.f_id,floder_list.f_name')->from('floder_list');		
		$this->db->where('u_id', $u_id);
		$this->db->where('f_undo', 0);
		$this->db->where('page_id', 0);
		$this->db->where('floder_id', 0);
		$this->db->limit(8);
		$this->db->order_by("floder_list.f_create_at", "DESC");
		return $this->db->get()->result();
	}
	public function get_pagewisefileupload_data($u_id,$p_id,$f_id){
		$this->db->select('images.img_name,images.imag_org_name')->from('images');		
		$this->db->where('u_id', $u_id);
		$this->db->where('img_undo', 0);
		$this->db->where('floder_id',$f_id);
		$this->db->order_by("images.img_create_at", "DESC");
		$this->db->where('page_id',$p_id);
		return $this->db->get()->result();
	}
	public function get_pagewiseflodername_data($u_id,$p_id,$f_id){
		$this->db->select('floder_list.f_id,floder_list.f_name')->from('floder_list');		
		$this->db->where('u_id', $u_id);
		$this->db->where('f_undo', 0);
		$this->db->where('page_id',$p_id);
		$this->db->where('floder_id',$f_id);
		$this->db->order_by("floder_list.f_create_at", "DESC");
		return $this->db->get()->result();
	}
	public function recen_get_floder_data($u_id){
		$this->db->select('floder_list.f_id,floder_list.f_name')->from('recently_floder_open');		
		$this->db->join('floder_list', 'floder_list.f_id = recently_floder_open.f_id', 'left');		
		$this->db->where('recently_floder_open.u_id', $u_id);
		$this->db->where('f_undo', 0);
		$this->db->limit(4);
		$this->db->order_by("recently_floder_open.r_f_create_at", "DESC");
		return $this->db->get()->result();
	}
	
	public function update_user_data($u_id,$data){
		$this->db->where('u_id', $u_id);
		return $this->db->update('users', $data);
	}


}