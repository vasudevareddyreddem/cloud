<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model 

{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}

	public function get_question_list(){
		$this->db->select('*')->from('questions');		
		$this->db->where('status', 1);
		return $this->db->get()->result_array();
	}
	public function save_user($data){
		$this->db->insert('users', $data);
		return $insert_id = $this->db->insert_id();
	}
	public function check_login_details($email,$pwd){
		$this->db->select('*')->from('users');		
		$this->db->where('u_email', $email);
		$this->db->where('u_password', $pwd);
		return $this->db->get()->row_array();
	}public function get_user_details($uid){
		$this->db->select('users.u_id,users.role')->from('users');		
		$this->db->where('u_id', $uid);
		return $this->db->get()->row_array();
	}
	public function check_email_unique($email){
		$this->db->select('users.u_id,users.role')->from('users');		
		$this->db->where('u_email', $email);
		return $this->db->get()->row_array();
	}public function get_forgotpassword_details($email){
		$this->db->select('users.u_id,users.role,users.u_orginalpassword,users.u_name,users.u_email')->from('users');		
		$this->db->where('u_email', $email);
		return $this->db->get()->row_array();
	}public function check_mobile_unique($mobile){
		$this->db->select('users.u_id,users.role')->from('users');		
		$this->db->where('u_mobile', $mobile);
		return $this->db->get()->row_array();
	}
	public function check_oldpassword_exits($u_id,$pwd){
		$this->db->select('users.u_id,users.role')->from('users');		
		$this->db->where('u_password', $pwd);
		$this->db->where('u_id', $u_id);
		return $this->db->get()->row_array();
	}
	public function get_user_all_details($uid){
		$this->db->select('*')->from('users');		
		$this->db->where('u_id', $uid);
		return $this->db->get()->row_array();
	}
	public function update_user_barcode($u_id,$barcode){
		$sql1="UPDATE users SET u_barcode ='".$u_id."', u_barcode_image ='".$barcode."' WHERE u_id = '".$u_id."'";
       	return $this->db->query($sql1);
	}
	public function update_user_data($u_id,$data){
		$this->db->where('u_id', $u_id);
		return $this->db->update('users', $data);
	}
	public function activity_login($data){
		$this->db->insert('logs', $data);
		return $insert_id = $this->db->insert_id();
	}
	public function get_user_all_activity_logs($uid){
		$this->db->select('logs.id,logs.create_at,logs.action,floder_list.f_name,images.imag_org_name,links.l_name')->from('logs');
		$this->db->join('floder_list', 'floder_list.f_id = logs.folder', 'left');		
		$this->db->join('images', 'images.img_id = logs.file', 'left');		
		$this->db->join('links', 'links.l_id = logs.link', 'left');		
		$this->db->where('logs.u_id', $uid);
		$this->db->order_by("logs.create_at", "DESC");
		return $this->db->get()->result_array();
	}
	public function delete_all_activity_logs($id){
		$sql1="DELETE FROM logs WHERE id = '".$id."'";
		return $this->db->query($sql1);
	}


}