<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Links_model extends CI_Model 

{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
/*add links*/
	public function save_links($data){
		$this->db->insert('links', $data);
		return $insert_id = $this->db->insert_id();
	}
/*add links*/
	
	public function get_link_details($u_id){
		$this->db->select('links.l_id,links.l_name,links.l_created_at,favourite.yes,favourite.u_id as favourite_u_id')->from('links');
		$this->db->join('favourite', 'favourite.file_id = links.l_id', 'left');
		$this->db->where('links.u_id', $u_id);
		$this->db->where('links.l_undo', 0);
		$this->db->order_by("links.l_created_at", "DESC");
		return $this->db->get()->result_array();
	}
	
	public function update_link_details($l_id,$data){
		$this->db->where('l_id',$l_id);
		return $this->db->update('links',$data);
		
	}

	

}