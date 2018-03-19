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
	public function save_recently_file_open($data){
		$this->db->insert('recently_file_open', $data);
		return $insert_id = $this->db->insert_id();
	}
	public function get_flodername($f_id){
		$this->db->select('floder_list.f_id,floder_list.f_name')->from('floder_list');		
		$this->db->where('f_id', $f_id);
		return $this->db->get()->row_array();
	}
	public function get_all_users_list($u_id){
		$this->db->select('users.u_id,users.u_name,users.u_email')->from('users');
		$this->db->where('u_id !=', $u_id);		
		$this->db->where('u_status', 1);
		return $this->db->get()->result_array();
	}
	public function get_customer_floder_list($u_id){
		$this->db->select('floder_list.f_name,floder_list.page_id,floder_list.floder_id')->from('floder_list');		
		$this->db->where('u_id', $u_id);
		$this->db->group_by('floder_list.f_id');
		return $this->db->get()->result_array();
	}
	public function get_customer_floder_name($floder_id){
		$this->db->select('floder_list.f_id,floder_list.f_name,floder_list.page_id,floder_list.floder_id')->from('floder_list');		
		$this->db->where('floder_id', $floder_id);
		return $this->db->get()->row_array();
	}
	public function get_dashbaord_customer_floder_name($floder_id){
		$this->db->select('floder_list.f_id,floder_list.f_name,floder_list.page_id,floder_list.floder_id')->from('floder_list');		
		$this->db->where('floder_id', $floder_id);
		$this->db->where('floder_list.floder_id !=', 0);
		return $this->db->get()->row_array();
	}
	public function recen_get_pagewisefileupload_data($u_id){
		$this->db->select('images.img_id,images.img_name,images.imag_org_name,images.img_create_at,favourite.yes')->from('recently_file_open');		
		$this->db->join('images', 'images.img_id = recently_file_open.file_id', 'left');
		$this->db->join('favourite', 'favourite.file_id = images.img_id', 'left');	

		$this->db->where('images.u_id', $u_id);
		$this->db->where('images.img_undo', 0);
		$this->db->group_by('images.img_id');
		$this->db->limit(4);
		$this->db->order_by("recently_file_open.r_file_create_at", "DESC");
		return $this->db->get()->result();
	}
	public function get_fileupload_data($u_id){
		$this->db->select('images.img_id,images.img_name,images.imag_org_name,images.img_create_at')->from('images');		
		$this->db->where('u_id', $u_id);
		$this->db->where('img_undo', 0);
		$this->db->where('page_id', 0);
		$this->db->where('floder_id', 0);
		$this->db->order_by("images.img_create_at", "DESC");
		return $this->db->get()->result();
	}
	
	public function get_flodername_list($u_id){
		$this->db->select('floder_list.f_id,floder_list.f_name,floder_list.page_id')->from('floder_list');		
		$this->db->where('u_id', $u_id);
		$this->db->where('f_undo', 0);
		return $this->db->get()->result();
	}
	public function get_links_list($u_id){
		$this->db->select('links.l_id,links.l_name,links.l_created_at,link_favourite.yes')->from('links');
		$this->db->join('link_favourite', 'link_favourite.file_id = links.l_id', 'left');
		$this->db->where('links.u_id', $u_id);
		$this->db->where('links.l_undo', 0);
		return $this->db->get()->result_array();
	}
	public function get_floder_movingname_list($u_id,$f_id){
		$this->db->select('floder_list.f_id,floder_list.f_name,floder_list.page_id')->from('floder_list');		
		$this->db->where('u_id', $u_id);
		$this->db->where('floder_id <', $f_id);
		$this->db->where('f_undo', 0);
		return $this->db->get()->result();
	}
	public function get_flodername_data($u_id){
		$this->db->select('floder_list.f_id,floder_list.f_name,floder_list.f_create_at')->from('floder_list');		
		$this->db->where('u_id', $u_id);
		$this->db->where('f_undo', 0);
		$this->db->where('floder_id', 0);
		$this->db->limit(8);
		$this->db->order_by("floder_list.f_create_at", "DESC");
		return $this->db->get()->result();
	}
	public function get_pagewisefileupload_data($u_id,$p_id,$f_id){
		$this->db->select('images.img_id,images.img_name,images.imag_org_name,favourite.yes,favourite.u_id as favourite_u_id')->from('images');
		$this->db->join('favourite', 'favourite.file_id = images.img_id', 'left');
		$this->db->where('images.u_id', $u_id);
		$this->db->where('images.img_undo', 0);
		$this->db->where('images.floder_id',$f_id);
		$this->db->order_by("images.img_create_at", "DESC");
		$this->db->where('images.page_id',$p_id);
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
		$this->db->select('floder_list.f_id,floder_list.f_name,floder_list.f_create_at')->from('recently_floder_open');		
		$this->db->join('floder_list', 'floder_list.f_id = recently_floder_open.f_id', 'left');		
		$this->db->where('recently_floder_open.u_id', $u_id);
		$this->db->group_by('floder_list.f_id');
		$this->db->where('f_undo', 0);
		$this->db->limit(4);
		$this->db->order_by("recently_floder_open.r_f_create_at", "DESC");
		return $this->db->get()->result();
	}
	
	public function update_user_data($u_id,$data){
		$this->db->where('u_id', $u_id);
		return $this->db->update('users', $data);
	}
	/*fav*/
	public function get_floderfavourite_list($u_id){
		$this->db->select('*')->from('floder_favourite');
		$this->db->where('u_id', $u_id);
        return $this->db->get()->result_array();
	}
	public function get_favourite_list($u_id){
		$this->db->select('*')->from('favourite');
		$this->db->where('u_id', $u_id);
        return $this->db->get()->result_array();
	}
	public function get_linkfavourite_list($u_id){
		$this->db->select('*')->from('link_favourite');
		$this->db->where('u_id', $u_id);
        return $this->db->get()->result_array();
	}
	public function remove_folder_favourite($u_id,$f_id){
		$sql1="DELETE FROM floder_favourite WHERE u_id = '".$u_id."' AND  f_id = '".$f_id."'";
		return $this->db->query($sql1);
	}
	public function remove_favourite($u_id,$file_id){
		$sql1="DELETE FROM favourite WHERE u_id = '".$u_id."' AND  file_id = '".$file_id."'";
		return $this->db->query($sql1);
	}
	public function remove_link_favourite($u_id,$file_id){
		$sql1="DELETE FROM link_favourite WHERE u_id = '".$u_id."' AND  file_id = '".$file_id."'";
		return $this->db->query($sql1);
	}
	public function add_folder_favourite($data){
		$this->db->insert('floder_favourite', $data);
		return $insert_id = $this->db->insert_id();
	}
	public function add_favourite($data){
		$this->db->insert('favourite', $data);
		return $insert_id = $this->db->insert_id();
	}
	public function add_link_favourite($data){
		$this->db->insert('link_favourite', $data);
		return $insert_id = $this->db->insert_id();
	}
	/*fav*/
	/*rename*/
	public function update_filename_changes($img_id,$data){
		$this->db->where('img_id', $img_id);
		return $this->db->update('images', $data);
	}public function update_flodername_changes($f_id,$data){
		$this->db->where('f_id', $f_id);
		return $this->db->update('floder_list', $data);
	}
	public function get_folder_details($f_id){
		$this->db->select('floder_list.f_id,floder_list.page_id,floder_list.floder_id')->from('floder_list');		
		$this->db->where('f_id', $f_id);
		return $this->db->get()->row_array();
	}
	/*rename*/
	/*floderDeleteing*/
	
	public function get_linked_floder_details($f_id,$u_id){
		$this->db->select('floder_list.f_id,floder_list.page_id,floder_list.floder_id')->from('floder_list');		
		$this->db->where('floder_id', $f_id);
		$this->db->where('u_id', $u_id);
		return $this->db->get()->result_array();
	}
	public function get_sublinked_floder_details($f_id,$u_id){
		$this->db->select('floder_list.f_id,floder_list.page_id,floder_list.floder_id')->from('floder_list');		
		$this->db->where('floder_id', $f_id);
		$this->db->where('u_id', $u_id);
		return $this->db->get()->result_array();
	}
	public function update_folder_todelte($f_id,$data){
		$this->db->where('f_id', $f_id);
		return $this->db->update('floder_list', $data);
	}
	
	/*floderDeleteing*/
	
	/* notification*/
	public function get_user_notification_list($u_id){
		$this->db->select('filecall_list.u_id,filecaal_notification_list.n_id,filecaal_notification_list.filecall_id,filecaal_notification_list.filecall_created_at,filecall_list.f_c_calling,users.u_name,filecaal_notification_list.filecall_status,filecall_list.f_c_request')->from('filecaal_notification_list');	
		$this->db->join('filecall_list', 'filecall_list.f_c_id = filecaal_notification_list.filecall_id', 'left');		
		$this->db->join('users', 'users.u_id = filecaal_notification_list.sent_u_id', 'left');		
		$this->db->where('filecall_list.f_c_u_id', $u_id);
		$this->db->or_where('filecall_list.u_id', $u_id);
		$this->db->order_by("filecall_list.f_c_created_at", "DESC");
		$this->db->limit(4);
		return $this->db->get()->result_array();
	}
	public function get_user_notification_unreadcount($u_id){
		$this->db->select('COUNT(filecall_list.f_c_id) as unreadcount')->from('filecall_list');	
		$this->db->where('filecall_list.f_c_u_id', $u_id);
		//$this->db->or_where('filecall_list.u_id', $u_id);
		$this->db->where('filecall_list.f_c_request', 0);
		return $this->db->get()->row_array();
	}
	/* notification*/
	/*breadcoum*/
	public function breadcoum_for_all_data($f_id,$u_id){
		$this->db->select('floder_id,f_id,( SELECT  COUNT(*)FROM    floder_list WHERE   floder_id = f_id ) + ( SELECT  COUNT(*) FROM    floder_list WHERE   floder_id = f_id ) - ( SELECT  COUNT(*) FROM    floder_list WHERE   floder_id = f_id AND floder_id = f_id )  COUNT')->from('floder_list');		
		$this->db->where('floder_list.floder_id <=', $f_id);
		$this->db->where('floder_list.u_id', $u_id);
		//$this->db->group_by('floder_list.f_id');
		$this->db->where('floder_list.f_undo', 0);
		return $this->db->get()->result_array();
	}
	/*breadcoum*/
/* testing*/
public function delete_for_all_datasss($f_id,$u_id){
		$this->db->select('floder_list.f_id,floder_list.page_id,floder_list.floder_id')->from('floder_list');		
		$this->db->where('floder_id', $f_id);
		$this->db->where('u_id', $u_id);
		return $this->db->get()->result_array();
}
public function delete_for_all_data($f_id,$u_id){
		$this->db->select('floder_id,f_id,( SELECT  COUNT(*)FROM    floder_list WHERE   floder_id = f_id ) + ( SELECT  COUNT(*) FROM    floder_list WHERE   floder_id = f_id ) - ( SELECT  COUNT(*) FROM    floder_list WHERE   floder_id = f_id AND floder_id = f_id )  COUNT')->from('floder_list');		
		$this->db->where('floder_id >=', $f_id);
		$this->db->where('u_id', $u_id);
		$this->db->where('f_undo', 0);
		return $this->db->get()->result_array();
}

	
/* testing*/

/*testing breadcoumns*/
public function save_folder_ids($f_id){
$_SESSION['cart'][] = $f_id;
//echo '<pre>';print_r($_SESSION['cart']);	
}
/*testing breadcoumns*/

}