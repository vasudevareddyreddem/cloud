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
	public function get_user_notification_lists($u_id){
		$this->db->select('filecall_list.u_id,filecall_list.f_c_u_id,filecaal_notification_list.n_id,filecaal_notification_list.filecall_id,filecaal_notification_list.filecall_created_at,filecall_list.f_c_calling,users.u_name,filecaal_notification_list.filecall_status,filecall_list.f_c_request')->from('filecaal_notification_list');	
		$this->db->join('filecall_list', 'filecall_list.f_c_id = filecaal_notification_list.filecall_id', 'left');		
		$this->db->join('users', 'users.u_id = filecaal_notification_list.sent_u_id', 'left');		
		$this->db->where('filecall_list.f_c_u_id', $u_id);
		$this->db->or_where('filecall_list.u_id', $u_id);
			$this->db->order_by("filecall_list.f_c_created_at", "DESC");
		return $this->db->get()->result_array();
	}
	public function get_all_folder_data($u_id){
		$this->db->select('floder_list.f_id,floder_list.f_name,floder_list.page_id,floder_list.floder_id')->from('floder_list');	
		$this->db->where('floder_list.u_id', $u_id);
		$this->db->where('floder_list.f_undo', 0);
		return $this->db->get()->result_array();
	}
	public function get_all_file_data($u_id){
		$this->db->select('images.img_id,images.img_name,images.imag_org_name,images.page_id,images.floder_id')->from('images');	
		$this->db->where('images.u_id', $u_id);
		$this->db->where('images.img_undo', 0);
		return $this->db->get()->result_array();
	}
	
public function save_file_sharing($data){
		$this->db->insert('shared_files', $data);
		return $insert_id = $this->db->insert_id();
	}
	public function save_folder_sharing($data){
		$this->db->insert('shared_folder', $data);
		return $insert_id = $this->db->insert_id();
	}
	
	
}