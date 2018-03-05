<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Links extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();	
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('email');
		$this->load->library('session');
		$this->load->library('user_agent');
		$this->load->helper('directory');
		$this->load->helper('security');
		$this->load->model('User_model');
		$this->load->model('Links_model');
		$this->load->model('Dashboard_model');
		$this->load->library('zip');

		}
	public function index()
	{
		if($this->session->userdata('userdetails'))
		{
			$loginuser_id=$this->session->userdata('userdetails');
			$data['userdetails']=$this->User_model->get_user_all_details($loginuser_id['u_id']);
			$data['all_users_list']=$this->Dashboard_model->get_all_users_list($loginuser_id['u_id']);	
			$filedata['links_list']=$this->Links_model->get_link_details($loginuser_id['u_id']);	
			//echo '<pre>';print_r();exit;
			$this->load->view('html/header',$data);
			$this->load->view('html/sidebar',$data);
			$this->load->view('html/links',$filedata);
			$this->load->view('html/footer');
		}else{
			redirect();
		}
		
		
	}
	public function addlink()
	{
		if($this->session->userdata('userdetails'))
		{
			$loginuser_id=$this->session->userdata('userdetails');
			$data['userdetails']=$this->User_model->get_user_all_details($loginuser_id['u_id']);
			$post=$this->input->post();
			//echo '<pre>';print_r($post);exit;
			$addlink=array(
						'u_id'=>$loginuser_id['u_id'],
						'l_name'=>$post['link'],
						'l_created_at'=>date('Y-m-d H:i:s'),
						'l_updated_at'=>date('Y-m-d H:i:s'),				
						'l_undo'=>0				
						);
			$addlink = $this->Links_model->save_links($addlink);
			if(count($addlink)>0){
				$this->session->set_flashdata('success',"link successfully added");
				redirect('links');
			}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
				redirect('links');
			}
		}else{
			 $this->session->set_flashdata('error','Please login to continue');
			 redirect('');
		} 
		
	}
	public function linkdelte()
	{
		if($this->session->userdata('userdetails'))
		{
			$loginuser_id=$this->session->userdata('userdetails');
			$data['userdetails']=$this->User_model->get_user_all_details($loginuser_id['u_id']);
			
			$post=$this->input->post();
			$link_id=base64_decode($this->uri->segment(3));
				$deletedata=array(
						//'u_id'=>$loginuser_id['u_id'],
						'l_undo'=>1,
						'l_updated_at'=>date('Y-m-d H:i:s'),				
						);
					//echo '<pre>';print_r($deletedata);
					$delete_link = $this->Links_model->update_link_details($link_id,$deletedata);
					//echo $this->db->last_query();exit;
					if(count($delete_link)>0){
						$this->session->set_flashdata('success',"Link successfully Deleted");
						redirect('links');
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('links');
					}
				
			
		
		}else{
			 $this->session->set_flashdata('error','Please login to continue');
			 redirect('');
		} 
		
	}
	public function linkedit()
		{
			if($this->session->userdata('userdetails'))
			{
				$loginuser_id=$this->session->userdata('userdetails');
				$data['userdetails']=$this->User_model->get_user_all_details($loginuser_id['u_id']);
				
				$post=$this->input->post();
					$renamedata=array(
							'u_id'=>$loginuser_id['u_id'],
							'l_name'=>$post['linkname'],
							'l_updated_at'=>date('Y-m-d H:i:s'),				
							);
						//echo '<pre>';print_r($floderdata);exit;
						$renamechanges = $this->Links_model->update_link_details($post['linkid'],$renamedata);
						if(count($renamechanges)>0){
								$this->session->set_flashdata('success',"Relink successfully changed");
								redirect('links');
						}else{
							$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
							redirect('links');
						}
			}else{
				 $this->session->set_flashdata('error','Please login to continue');
				 redirect('');
			} 
		
	}
	
	
	
	
	
	
	
}
