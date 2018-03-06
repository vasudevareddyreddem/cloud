<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Images extends CI_Controller {

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
		$this->load->model('Images_model');
		$this->load->model('Dashboard_model');
		$this->load->library('zip');

		}
	public function index()
	{
		if($this->session->userdata('userdetails'))
		{
			$loginuser_id=$this->session->userdata('userdetails');
			$fid='';
			$data['userdetails']=$this->User_model->get_user_all_details($loginuser_id['u_id']);
			$filedata['file_data']=$this->Images_model->get_fileupload_data($loginuser_id['u_id']);
			$filedata['floder_data']=$this->Dashboard_model->get_flodername_data($loginuser_id['u_id']);
			$filedata['links_list']=$this->Dashboard_model->get_links_list($loginuser_id['u_id']);	
			$data['all_users_list']=$this->Dashboard_model->get_all_users_list($loginuser_id['u_id']);	
			$data['notofication_list']=$this->Dashboard_model->get_user_notification_list($loginuser_id['u_id']);	
			$data['notofication_uread_count']=$this->Dashboard_model->get_user_notification_unreadcount($loginuser_id['u_id']);	
			$filedata['floder_name_list']=$this->Dashboard_model->get_flodername_list($loginuser_id['u_id']);	
			$filedata['floder_moving_list']=$this->Dashboard_model->get_floder_movingname_list($loginuser_id['u_id'],$fid);	

			//echo '<pre>';print_r($filedata);exit;
			$this->load->view('html/header',$data);
			$this->load->view('html/sidebar',$data);
			$this->load->view('html/images',$filedata);
			$this->load->view('html/footer');
		}else{
			redirect();
		}
		
		
	}
	public function floderdatazip()
	{
		if($this->session->userdata('userdetails'))
		{
			$loginuser_id=$this->session->userdata('userdetails');
			$data['userdetails']=$this->User_model->get_user_all_details($loginuser_id['u_id']);
			
			$f_id=base64_decode($this->uri->segment(3));
			$folder_data=$this->Images_model->get_all_datainto_zip($loginuser_id['u_id'],$f_id);
			$this->zip->clear_data();
			foreach($folder_data as $list){
				$zipdata=$this->zip->read_file('assets/files/'.$list->img_name);
			}
			$this->zip->read_file($zipdata, TRUE);
			$this->zip->download($f_id.'.zip');
		}else{
			 $this->session->set_flashdata('error','Please login to continue');
			 redirect('');
		} 
		
	}public function filemoving()
	{
		if($this->session->userdata('userdetails'))
		{
			$loginuser_id=$this->session->userdata('userdetails');
			$data['userdetails']=$this->User_model->get_user_all_details($loginuser_id['u_id']);
			
			$post=$this->input->post();
			//echo '<pre>';print_r($post);exit;
			$fname = $this->security->sanitize_filename($this->input->post('filerename'), TRUE);
				$movedata=array(
						'u_id'=>$loginuser_id['u_id'],
						'page_id'=>$post['pageid'],
						'floder_id'=>$post['floderid'],
						'f_update_at'=>date('Y-m-d H:i:s'),				
						);
					//echo '<pre>';print_r($floderdata);exit;
					$mvechanges = $this->Dashboard_model->update_filename_changes($post['moveimgid'],$movedata);
					if(count($mvechanges)>0){
						$recentlyopen_file=array(
						'u_id'=>$loginuser_id['u_id'],
						'file_id'=>$post['moveimgid'],
						'r_file_status'=>1,
						'r_file_create_at'=>date('Y-m-d H:i:s'),
						'r_file_updated_at'=>date('Y-m-d H:i:s'),
						);
						$this->Dashboard_model->save_recently_file_open($recentlyopen_file);
						
						$this->session->set_flashdata('success',"File successfully Moved");
						if(isset($post['pageid']) && $post['pageid']!=''){
							redirect('dashboard/page/'.base64_encode($post['pageid']).'/'.base64_encode($post['floderid']));
						}else{
							redirect('dashboard');
						}
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						if(isset($post['pageid']) && $post['pageid']!=''){
							redirect('dashboard/page/'.base64_encode($post['pageid']).'/'.base64_encode($post['floderid']));
						}else{
							redirect('dashboard');
						}
					}
				
			
		
		}else{
			 $this->session->set_flashdata('error','Please login to continue');
			 redirect('');
		} 
		
	}
	public function foldermoving()
	{
		if($this->session->userdata('userdetails'))
		{
			$loginuser_id=$this->session->userdata('userdetails');
			$data['userdetails']=$this->User_model->get_user_all_details($loginuser_id['u_id']);
			
			$post=$this->input->post();
			//echo '<pre>';print_r($post);exit;
			$fname = $this->security->sanitize_filename($this->input->post('filerename'), TRUE);
			$folder_details = $this->Images_model->get_folder_details($post['floderid']);

				$movedata=array(
						'u_id'=>$loginuser_id['u_id'],
						'page_id'=>$folder_details['page_id'],
						'floder_id'=>$post['floderid'],
						'f_updated_at'=>date('Y-m-d H:i:s'),				
						);
					//echo '<pre>';print_r($floderdata);exit;
					$mvechanges = $this->Images_model->update_foldername_changes($post['movefolderid'],$movedata);
					if(count($mvechanges)>0){
						$recentlyopen_folder=array(
						'u_id'=>$loginuser_id['u_id'],
						'f_id'=>$post['movefolderid'],
						'r_f_status'=>1,
						'r_f_create_at'=>date('Y-m-d H:i:s'),
						'r_f_updated_at'=>date('Y-m-d H:i:s'),
						);
						$this->Dashboard_model->recently_view_data($recentlyopen_folder);
						
						$this->session->set_flashdata('success',"Folder successfully Moved");
						if(isset($post['pageid']) && $post['pageid']!='' && $folder_details['floder_id']!=0){
							redirect('dashboard/page/'.base64_encode($folder_details['page_id']).'/'.base64_encode($folder_details['floder_id']));
						}else{
							redirect('dashboard');
						}
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
							if(isset($post['pageid']) && $post['pageid']!='' && $folder_details['floder_id']!=0){
							redirect('dashboard/page/'.base64_encode($folder_details['page_id']).'/'.base64_encode($folder_details['floder_id']));
						}else{
							redirect('dashboard');
						}
					}
				
			
		
		}else{
			 $this->session->set_flashdata('error','Please login to continue');
			 redirect('');
		} 
		
	}
	public function filesharing()
	{
		if($this->session->userdata('userdetails'))
		{
			$post=$this->input->post();
			//echo '<pre>';print_r($post);exit;
			$redirection_url=$this->agent->referrer();
			$loginuser_id=$this->session->userdata('userdetails');
			$data['userdetails']=$this->User_model->get_user_all_details($loginuser_id['u_id']);
			if(isset($post['yes']) && $post['yes']==0){
					if(isset($post['filesharing']) && $post['filesharing']!=''){
						foreach($post['filesharing'] as $list){
							$sharingdata=array(
							'u_id'=>$list,
							'img_id'=>$post['sharingfile_id'],
							's_permission'=>$post['permissions'],
							's_status'=>1,
							's_created'=>date('Y-m-d H:i:s'),
							'file_created_id'=>$loginuser_id['u_id']
							);
							$sharedfile=$this->Images_model->save_file_sharing($sharingdata);
							//echo '<pre>';print_r($sharingdata);
						}
						//exit;
					}
					if(isset($post['sharingnotification']) && $post['sharingnotification']!=''){
						$sharingdata=array(
							'u_email'=>$post['sharingnotification'],
							'img_id'=>$post['sharingfile_id'],
							's_permission'=>$post['permissions'],
							's_status'=>1,
							's_created'=>date('Y-m-d H:i:s'),
							'file_created_id'=>$loginuser_id['u_id']
							);
							$sharedfile=$this->Images_model->save_file_sharing($sharingdata);
					}
			}else if(isset($post['yes']) && $post['yes']==2){
				
				if(isset($post['filesharing']) && $post['filesharing']!=''){
						foreach($post['filesharing'] as $list){
							$sharingdata=array(
							'u_id'=>$list,
							'link_id'=>$post['sharingfile_id'],
							's_permission'=>$post['permissions'],
							's_status'=>1,
							's_created'=>date('Y-m-d H:i:s'),
							'file_created_id'=>$loginuser_id['u_id']
							);
							$sharedfile=$this->Images_model->save_link_sharing($sharingdata);
							//echo '<pre>';print_r($sharingdata);
						}
						//exit;
					}
					if(isset($post['sharingnotification']) && $post['sharingnotification']!=''){
						$sharingdata=array(
							'u_email'=>$post['sharingnotification'],
							'f_id'=>$post['sharingfile_id'],
							's_permission'=>$post['permissions'],
							's_status'=>1,
							's_created'=>date('Y-m-d H:i:s'),
							'file_created_id'=>$loginuser_id['u_id']
							);
							$sharedfile=$this->Images_model->save_link_sharing($sharingdata);
					}
			}else{
					if(isset($post['filesharing']) && $post['filesharing']!=''){
						foreach($post['filesharing'] as $list){
							$sharingdata=array(
							'u_id'=>$list,
							'f_id'=>$post['sharingfile_id'],
							's_permission'=>$post['permissions'],
							's_status'=>1,
							's_created'=>date('Y-m-d H:i:s'),
							'file_created_id'=>$loginuser_id['u_id']
							);
							$sharedfile=$this->Images_model->save_folder_sharing($sharingdata);
							//echo '<pre>';print_r($sharingdata);
						}
						//exit;
					}
					if(isset($post['sharingnotification']) && $post['sharingnotification']!=''){
						$sharingdata=array(
							'u_email'=>$post['sharingnotification'],
							'f_id'=>$post['sharingfile_id'],
							's_permission'=>$post['permissions'],
							's_status'=>1,
							's_created'=>date('Y-m-d H:i:s'),
							'file_created_id'=>$loginuser_id['u_id']
							);
							$sharedfile=$this->Images_model->save_folder_sharing($sharingdata);
					}
				
			}
			if(count($sharedfile)>0){
				$this->session->set_flashdata('success',"File successfully shared");
				
					redirect($redirection_url);
			
			}else{
				$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
					
							redirect($redirection_url);
					
			}
			
			
		}else{
			redirect();
		}
		
		
	}
	
	
	
	
	
	
}
