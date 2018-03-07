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
	public function get_all_user_details($uid){
		$this->db->select('users.u_id,users.role,users.u_name,users.u_email,users.u_mobile,users.u_dob,users.u_gender,users.u_barcode,users.u_barcode_image,u_profilepic')->from('users');		
		$this->db->where('u_id', $uid);
		return $this->db->get()->row_array();
	}
	public function update_user_details($u_id,$data){
		$this->db->where('u_id', $u_id);
		return $this->db->update('users', $data);
	}
	public function save_floders($data){
		$this->db->insert('floder_list', $data);
		return $insert_id = $this->db->insert_id();
	}
	public function folder_details_update($folder_id,$data){
		$this->db->where('f_id', $folder_id);
		return $this->db->update('floder_list', $data);
	}
	public function get_folder_details($f_id){
		$this->db->select('floder_list.f_id,floder_list.u_id')->from('floder_list');		
		$this->db->where('f_id', $f_id);
		return $this->db->get()->row_array();
	}
	public function add_folderfavorites($data){
		$this->db->insert('floder_favourite', $data);
		return $insert_id = $this->db->insert_id();
	}
	public function check_folderfavorites($u_id,$f_id){
		$this->db->select('*')->from('floder_favourite');		
		$this->db->where('f_id', $f_id);
		$this->db->where('u_id', $u_id);
		return $this->db->get()->row_array();
	}
	public function remove_folderfavorites($f_id){
		$sql1="DELETE FROM floder_favourite WHERE id = '".$f_id."'";
		return $this->db->query($sql1);
	}
	public function delete_folder($f_id){
		$sql1="DELETE FROM floder_list WHERE f_id = '".$f_id."'";
		return $this->db->query($sql1);
	}
	public function get_folder_data($f_id){
		$this->db->select('floder_id,f_id,( SELECT  COUNT(*)FROM    floder_list WHERE   floder_id = f_id ) + ( SELECT  COUNT(*) FROM    floder_list WHERE   floder_id = f_id ) - ( SELECT  COUNT(*) FROM    floder_list WHERE   floder_id = f_id AND floder_id = f_id )  COUNT')->from('floder_list');		
		$this->db->where('floder_id >=', $f_id);
		$this->db->or_where('f_id ', $f_id);
		$this->db->where('f_undo', 0);
		return $this->db->get()->result_array();
	}
	public function get_all_datainto_zip($f_id){
		$this->db->select('images.img_id,images.img_name,images.imag_org_name')->from('images');		
		$this->db->where('floder_id', $f_id);
		$this->db->order_by("images.img_create_at", "DESC");
		return $this->db->get()->result();
	}
	
	/* folder share*/
	public function folder_share($data){
		$this->db->insert('shared_folder', $data);
		return $insert_id = $this->db->insert_id();
	}
	public function get_shared_folder_details($u_id,$f_id){
		$this->db->select('*')->from('shared_folder');		
		$this->db->where('u_id', $u_id);
		$this->db->where('f_id', $f_id);
		$this->db->or_where('u_email', $f_id);
		return $this->db->get()->row_array();
	}
	public function get_user_list($val){
		$this->db->select('users.u_id,users.u_name,users.u_email')->from('users');		
		$this->db->where("u_name LIKE '%".$val."%' OR u_email LIKE '%".$val."%'");
		$this->db->where('u_status', 1);
		return $this->db->get()->result_array();
	}
	
	public function get_all_folder_details($f_id){
		$this->db->select('floder_list.f_id,floder_list.u_id,floder_list.page_id,floder_list.floder_id,floder_list.f_name,floder_list.f_create_at,floder_list.f_undo')->from('floder_list');		
		$this->db->where('f_id', $f_id);
		return $this->db->get()->row_array();
	}
	public function get_all_file_details($f_id){
		$this->db->select('images.img_id,images.floder_id,images.img_name,images.imag_org_name,images.img_create_at')->from('images');		
		$this->db->where('floder_id', $f_id);
		return $this->db->get()->result_array();
	}
	/* folder share*/
	
	/* file*/
	public function get_file_details($img_id){
		$this->db->select('images.img_id,images.img_name')->from('images');		
		$this->db->where('img_id', $img_id);
		return $this->db->get()->row_array();
	}
	public function file_details_update($img_id,$data){
		$this->db->where('img_id', $img_id);
		return $this->db->update('images', $data);
	}
	public function add_filefavorites($data){
		$this->db->insert('favourite', $data);
		return $insert_id = $this->db->insert_id();
	}
	public function check_filefavorites($u_id,$file_id){
		$this->db->select('*')->from('favourite');		
		$this->db->where('file_id', $file_id);
		$this->db->where('u_id', $u_id);
		return $this->db->get()->row_array();
	}
	public function remove_filefavorites($file_id){
		$sql1="DELETE FROM favourite WHERE id = '".$file_id."'";
		return $this->db->query($sql1);
	}
	public function delete_file($img_id){
		$sql1="DELETE FROM images WHERE img_id = '".$img_id."'";
		return $this->db->query($sql1);
	}
	public function get_shared_file_details($u_id,$f_id){
		$this->db->select('*')->from('shared_files');		
		$this->db->where('u_id', $u_id);
		$this->db->where('img_id', $f_id);
		$this->db->or_where('u_email', $f_id);
		return $this->db->get()->row_array();
	}
	public function file_share($data){
		$this->db->insert('shared_files', $data);
		return $insert_id = $this->db->insert_id();
	}
	public function get_folder_list($u_id){
		$this->db->select('floder_list.f_id,floder_list.page_id,floder_list.floder_id,floder_list.f_name')->from('floder_list');		
		$this->db->where('u_id', $u_id);
		$this->db->or_where('f_status', 0);
		return $this->db->get()->result_array();
	}
	/* file*/
	/* link*/
		public function save_links($data){
		$this->db->insert('links', $data);
		return $insert_id = $this->db->insert_id();
	}
	public function check_linkfavorites($u_id,$file_id){
		$this->db->select('*')->from('link_favourite');		
		$this->db->where('file_id', $file_id);
		$this->db->where('u_id', $u_id);
		return $this->db->get()->row_array();
	}
	public function add_linkfavorites($data){
		$this->db->insert('link_favourite', $data);
		return $insert_id = $this->db->insert_id();
	}
	public function remove_linkfavorites($linkid){
		$sql1="DELETE FROM link_favourite WHERE id = '".$linkid."'";
		return $this->db->query($sql1);
	}
	public function get_link_details($l_id){
		$this->db->select('links.l_id,links.l_name')->from('links');		
		$this->db->where('l_id', $l_id);
		return $this->db->get()->row_array();
	}
	public function link_details_update($l_id,$data){
		$this->db->where('l_id', $l_id);
		return $this->db->update('links', $data);
	}
	public function delete_link($l_id){
		$sql1="DELETE FROM links WHERE l_id = '".$l_id."'";
		return $this->db->query($sql1);
	}
	public function get_shared_link_details($u_id,$link_id){
		$this->db->select('*')->from('shared_links');		
		$this->db->where('u_id', $u_id);
		$this->db->where('link_id', $link_id);
		$this->db->or_where('u_email', $link_id);
		return $this->db->get()->row_array();
	}
	public function link_share($data){
		$this->db->insert('shared_links', $data);
		return $insert_id = $this->db->insert_id();
	}
	/* link*/
	/*link tab*/
	public function get_link_list($u_id){
		$this->db->select('links.l_id,links.u_id,links.l_name,links.l_created_at,link_favourite.yes')->from('links');
		$this->db->join('link_favourite', 'link_favourite.file_id = links.l_id', 'left');
		$this->db->where('links.u_id', $u_id);
		$this->db->where('links.l_undo', 0);
		$this->db->order_by("links.l_created_at", "DESC");
		return $this->db->get()->result_array();
	}
	/*link tab*/
	/*recyclebintab*/
		public function get_undofile_list($u_id){
		$this->db->select('images.img_id,images.img_name,images.imag_org_name,favourite.yes')->from('images');
		$this->db->join('favourite', 'favourite.file_id = images.img_id', 'left');
		$this->db->where('images.u_id', $u_id);
		$this->db->where('images.img_undo', 1);
		$this->db->order_by("images.img_create_at", "DESC");
		return $this->db->get()->result();
	}	
	public function get_undolink_list($u_id){
		$this->db->select('links.l_id,links.u_id,links.l_name,links.l_created_at,link_favourite.yes')->from('links');
		$this->db->join('link_favourite', 'link_favourite.file_id = links.l_id', 'left');
		$this->db->where('links.u_id', $u_id);
		$this->db->where('links.l_undo', 1);
		$this->db->order_by("links.l_created_at", "DESC");
		return $this->db->get()->result_array();
	}	
	public function get_undofolder_list($u_id){
		$this->db->select('floder_list.f_id,floder_list.f_name,floder_list.u_id')->from('floder_list');		
		$this->db->where('floder_list.u_id', $u_id);
		$this->db->where('f_undo', 1);
		return $this->db->get()->result_array();
	}
	/*recyclebintab*/

}