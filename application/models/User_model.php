<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model 

{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
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
	}public function check_mobile_unique($mobile){
		$this->db->select('users.u_id,users.role')->from('users');		
		$this->db->where('u_mobile', $mobile);
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


}