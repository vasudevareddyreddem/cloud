<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mobile_model extends CI_Model 

{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}

	public function mobile_checking($username){

		$sql = "SELECT * FROM users WHERE (u_email ='".$username."') OR (u_mobile ='".$username."')";
      return $this->db->query($sql)->row_array(); 
	}
	public function save_user($data){
		$this->db->insert('users', $data);
		return $insert_id = $this->db->insert_id();
	}
	public function update_user_barcode($u_id,$barcode){
		$sql1="UPDATE users SET u_barcode ='".$u_id."', u_barcode_image ='".$barcode."' WHERE u_id = '".$u_id."'";
       	return $this->db->query($sql1);
	}
	public function get_user_details($uid){
		$this->db->select('users.u_id,users.role')->from('users');		
		$this->db->where('u_id', $uid);
		return $this->db->get()->row_array();
	}
	public function check_login_details($email,$pwd){
		$this->db->select('users.u_id,users.role,users.u_name,users.u_email,users.u_mobile,users.u_dob,users.u_gender,users.u_barcode,users.u_barcode_image,u_profilepic')->from('users');		
		$this->db->where('u_email', $email);
		$this->db->where('u_password', $pwd);
		return $this->db->get()->row_array();
	}
	public function oldpassword($usid,$pass){
		$sql="SELECT * FROM users WHERE u_id ='".$usid."' AND u_password ='".md5($pass)."'";
        return $this->db->query($sql)->row_array(); 
	}
	public function set_user_password($usid,$pass){
		$sql1="UPDATE users SET u_password ='".md5($pass)."', u_orginalpassword ='".$pass."' WHERE u_id = '".$usid."'";
       	return $this->db->query($sql1);
	}

}