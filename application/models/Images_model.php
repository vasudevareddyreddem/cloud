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
		$this->db->select('images.img_id,images.img_name,images.imag_org_name,images.img_create_at,favourite.yes')->from('images');
		$this->db->join('favourite', 'favourite.file_id = images.img_id', 'left');
		$this->db->where('images.u_id', $u_id);
		$this->db->where('images.img_undo', 0);
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
	public function save_folder_sharing($data){
		$this->db->insert('shared_folder', $data);
		return $insert_id = $this->db->insert_id();
	}
	public function save_link_sharing($data){
		$this->db->insert('shared_links', $data);
		return $insert_id = $this->db->insert_id();
	}
	public function get_shared_file($u_id){
		$this->db->select('images.img_id,images.img_name,images.imag_org_name,images.img_create_at,shared_files.s_permission')->from('shared_files');
		$this->db->join('images', 'images.img_id = shared_files.img_id', 'left');
		$this->db->where('shared_files.u_id', $u_id);
		$this->db->group_by('shared_files.img_id');
		return $this->db->get()->result();
	}
	public function get_shared_folder($u_id){
		$this->db->select('floder_list.f_id,floder_list.f_name,floder_list.f_create_at,shared_folder.s_permission')->from('shared_folder');
		$this->db->join('floder_list', 'floder_list.f_id = shared_folder.f_id', 'left');
		$this->db->where('shared_folder.u_id', $u_id);
		$this->db->group_by('shared_folder.f_id');
		return $this->db->get()->result();
	}
	public function get_pagewisefileupload_data($p_id,$f_id){
		$this->db->select('images.img_id,images.img_name,images.imag_org_name,favourite.yes,favourite.u_id as favourite_u_id')->from('images');
		$this->db->join('favourite', 'favourite.file_id = images.img_id', 'left');
		$this->db->where('images.img_undo', 0);
		$this->db->where('images.floder_id',$f_id);
		$this->db->order_by("images.img_create_at", "DESC");
		$this->db->where('images.page_id',$p_id);
		return $this->db->get()->result();
	}
	public function get_pagewiseflodername_data($p_id,$f_id){
		$this->db->select('floder_list.f_id,floder_list.f_name')->from('floder_list');		
		$this->db->where('f_undo', 0);
		$this->db->where('page_id',$p_id);
		$this->db->where('floder_id',$f_id);
		$this->db->order_by("floder_list.f_create_at", "DESC");
		return $this->db->get()->result();
	}
	public function get_customer_floder_list($u_id){
		$this->db->select('floder_list.f_id,floder_list.f_name,shared_folder.s_permission')->from('shared_folder');
		$this->db->join('floder_list', 'floder_list.f_id = shared_folder.f_id', 'left');
		$this->db->where('shared_folder.u_id', $u_id);
		$this->db->group_by('shared_folder.f_id');
		return $this->db->get()->result();
	}
	public function delete_for_all_data($f_id){
		$this->db->select('floder_id,floder_id,( SELECT  COUNT(*)FROM    floder_list WHERE   floder_id = f_id ) + ( SELECT  COUNT(*) FROM    floder_list WHERE   floder_id = f_id ) - ( SELECT  COUNT(*) FROM    floder_list WHERE   floder_id = f_id AND floder_id = f_id )  COUNT')->from('floder_list');		
		$this->db->join('shared_folder', 'shared_folder.f_id = floder_list.f_id', 'left');
		$this->db->where('floder_list.floder_id <=', $f_id);
		//$this->db->where('floder_list.u_id', $u_id);
		//$this->db->where('floder_list.f_undo', 0);
		return $this->db->get()->result_array();
	}
/*filesharing*/
}