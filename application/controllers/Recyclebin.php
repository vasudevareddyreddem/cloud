<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Recyclebin extends CI_Controller {

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
		$this->load->library('zend');
		$this->load->helper("file");
		$this->load->model('User_model');
		$this->load->model('Recyclebin_model');
		$this->load->model('Images_model');
		$this->load->model('Dashboard_model');
		$this->load->library('zend');
		$this->load->library('make_bread');
		}
	public function index()
	{
		if($this->session->userdata('userdetails'))
		{
			unset($_SESSION['make_bread']);
			$loginuser_id=$this->session->userdata('userdetails');
			$data['userdetails']=$this->User_model->get_user_all_details($loginuser_id['u_id']);
			$filedata['floder_data']=$this->Recyclebin_model->get_undo_floder_data($loginuser_id['u_id']);
			$filedata['file_data']=$this->Recyclebin_model->get_undo_file_data($loginuser_id['u_id']);
			$filedata['link_data']=$this->Recyclebin_model->get_undo_link_data($loginuser_id['u_id']);
			$data['notofication_list']=$this->Dashboard_model->get_user_notification_list($loginuser_id['u_id']);	
			$data['notofication_uread_count']=$this->Dashboard_model->get_user_notification_unreadcount($loginuser_id['u_id']);	
			/*$folder_details = $this->Dashboard_model->delete_for_all_data($floder_id,$loginuser_id['u_id']);
				if(count($folder_details)>0){
					foreach($folder_details as $m_links){
						$this->Dashboard_model->update_folder_todelte($m_links['f_id'],array('f_undo'=>1));
					}
				}*/
			//echo '<pre>';print_r($filedata);exit;
			$this->load->view('html/header',$data);
			$this->load->view('html/sidebar',$data);
			$this->load->view('html/recyclebin',$filedata);
			$this->load->view('html/footer');
		}else{
			$this->load->view('html/login');
		}
		
		
	}
	public function folder(){
		if($this->session->userdata('userdetails'))
		{
			$loginuser_id=$this->session->userdata('userdetails');
			$data['userdetails']=$this->User_model->get_user_all_details($loginuser_id['u_id']);
			$f_id=base64_decode($this->uri->segment(3));
			if(is_numeric($f_id)){
			$_SESSION['make_bread1'][] = $f_id;
			foreach($_SESSION['make_bread1'] as $list){
				if(is_numeric($list)){
					$li[]=$list;
				}
			}
			$bread=implode(',',array_unique($li));
			$len =  strpos($bread,$f_id);
			$idds=substr($bread,0,$len);
				$this->make_bread->add('Recycle bin','recyclebin');
				foreach(explode(",",$idds) as $li){
					if($li!=0){
					$name=$this->Dashboard_model->get_customer_floder_name($li);
					$this->make_bread->add($name['f_name'], 'dashboard/page/'.base64_encode($name["page_id"]).'/'.base64_encode($name["floder_id"]));
					}
				}
				$filedata['breadcoums'] = $this->make_bread->output();
			}
			$filedata['file_data']=$this->Recyclebin_model->get_delete_floder_data($loginuser_id['u_id'],$f_id);
			$filedata['floder_data']=$this->Recyclebin_model->get_pagewiseflodername_data($f_id);	
			$data['notofication_list']=$this->Dashboard_model->get_user_notification_list($loginuser_id['u_id']);	
			$data['notofication_uread_count']=$this->Dashboard_model->get_user_notification_unreadcount($loginuser_id['u_id']);	
			//echo $this->db->last_query();exit;
			
			//echo '<pre>';print_r($filedata);exit;
			$this->load->view('html/header',$data);
			$this->load->view('html/sidebar',$data);
			$this->load->view('html/recyclebinpage',$filedata);
			$this->load->view('html/footer');
		}else{
			 $this->session->set_flashdata('error','Please login to continue');
			 redirect('');
		} 
	}
	public function imgdelte()
	{
		if($this->session->userdata('userdetails'))
		{
			$loginuser_id=$this->session->userdata('userdetails');
			$data['userdetails']=$this->User_model->get_user_all_details($loginuser_id['u_id']);
			
			$post=$this->input->post();
			$image_id=base64_decode($this->uri->segment(3));
				$imgdetails = $this->Recyclebin_model->get_delte_image_details($loginuser_id['u_id'],$image_id);
				$delete_image = $this->Recyclebin_model->delte_image($loginuser_id['u_id'],$image_id);
					unlink("assets/files/".$imgdetails['img_name']);
					if(count($delete_image)>0){
						$activity=array(
								'u_id'=>$loginuser_id['u_id'],
								'file'=>$image_id,
								'folder'=>'',
								'link'=>'',
								'action'=>'Delete',
								'create_at'=>date('Y-m-d H:i:s')
								);
							$this->User_model->activity_login($activity);
						$this->session->set_flashdata('success',"FIle successfully Deleted");
						redirect('recyclebin');
					
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('recyclebin');
					
					}
				
			
		
		}else{
			 $this->session->set_flashdata('error','Please login to continue');
			 redirect('');
		} 
		
	}
	public function restore()
	{
		if($this->session->userdata('userdetails'))
		{
			$loginuser_id=$this->session->userdata('userdetails');
			$data['userdetails']=$this->User_model->get_user_all_details($loginuser_id['u_id']);
			
			$image_id=base64_decode($this->uri->segment(3));
				$deletedata=array(
						'u_id'=>$loginuser_id['u_id'],
						'img_undo'=>0,
						'f_update_at'=>date('Y-m-d H:i:s'),				
						);
					//echo '<pre>';print_r($renamedata);exit;
					$delete_image = $this->Recyclebin_model->update_filename_changes($image_id,$deletedata);
					//echo $this->db->last_query();exit;
					if(count($delete_image)>0){
						$activity=array(
								'u_id'=>$loginuser_id['u_id'],
								'file'=>$image_id,
								'folder'=>'',
								'link'=>'',
								'action'=>'Restore',
								'create_at'=>date('Y-m-d H:i:s')
								);
							$this->User_model->activity_login($activity);
						$this->session->set_flashdata('success',"FIle successfully Deleted");
						redirect('recyclebin');
						
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('recyclebin');
					}
				
		}else{
			 $this->session->set_flashdata('error','Please login to continue');
			 redirect('');
		} 
		
	}
	public function linkrestore()
	{
		if($this->session->userdata('userdetails'))
		{
			$loginuser_id=$this->session->userdata('userdetails');
			$data['userdetails']=$this->User_model->get_user_all_details($loginuser_id['u_id']);
			
			$link_id=base64_decode($this->uri->segment(3));
				$deletedata=array(
						'u_id'=>$loginuser_id['u_id'],
						'l_undo'=>0,
						'l_updated_at'=>date('Y-m-d H:i:s'),				
						);
					//echo '<pre>';print_r($renamedata);exit;
					$delete_image = $this->Recyclebin_model->update_link_details($link_id,$deletedata);
					//echo $this->db->last_query();exit;
					if(count($delete_image)>0){
						$activity=array(
								'u_id'=>$loginuser_id['u_id'],
								'file'=>'',
								'folder'=>'',
								'link'=>$link_id,
								'action'=>'Restore',
								'create_at'=>date('Y-m-d H:i:s')
								);
							$this->User_model->activity_login($activity);
						$this->session->set_flashdata('success',"Link successfully Restore");
						redirect('recyclebin');
						
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('recyclebin');
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
				$delete_image = $this->Recyclebin_model->delte_link($loginuser_id['u_id'],$link_id);
				$this->Recyclebin_model->share_delte_link($link_id);
					if(count($delete_image)>0){
						$activity=array(
								'u_id'=>$loginuser_id['u_id'],
								'file'=>'',
								'folder'=>'',
								'link'=>$link_id,
								'action'=>'Delete',
								'create_at'=>date('Y-m-d H:i:s')
								);
							$this->User_model->activity_login($activity);
						$this->session->set_flashdata('success',"LInk successfully Deleted");
						redirect('recyclebin');
					
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('recyclebin');
					
					}
				
			
		
		}else{
			 $this->session->set_flashdata('error','Please login to continue');
			 redirect('');
		} 
		
	}
	public function folderrestore()
	{
		if($this->session->userdata('userdetails'))
		{
			$loginuser_id=$this->session->userdata('userdetails');
			$data['userdetails']=$this->User_model->get_user_all_details($loginuser_id['u_id']);
			
			$folder_id=base64_decode($this->uri->segment(3));
				$deletedata=array(
						'f_undo'=>0,
						'f_updated_at'=>date('Y-m-d H:i:s'),				
						);
					//echo '<pre>';print_r($renamedata);exit;
					$delete_folder= $this->Recyclebin_model->update_folder_changes($folder_id,$deletedata);
					//echo $this->db->last_query();exit;
					if(count($delete_folder)>0){
						$activity=array(
								'u_id'=>$loginuser_id['u_id'],
								'file'=>'',
								'folder'=>$folder_id,
								'link'=>'',
								'action'=>'Restore',
								'create_at'=>date('Y-m-d H:i:s')
								);
							$this->User_model->activity_login($activity);
						$this->session->set_flashdata('success',"Folder successfully Restored");
						redirect('recyclebin');
						
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('recyclebin');
					}
				
		}else{
			 $this->session->set_flashdata('error','Please login to continue');
			 redirect('');
		} 
		
	}
	public function deletefolder()
	{
		if($this->session->userdata('userdetails'))
		{
			$loginuser_id=$this->session->userdata('userdetails');
			$data['userdetails']=$this->User_model->get_user_all_details($loginuser_id['u_id']);
			
			$post=$this->input->post();
			$folder_id=base64_decode($this->uri->segment(3));
			$u_id=base64_decode($this->uri->segment(4));
				
				$folder_details = $this->Recyclebin_model->perment_delete_for_all_data($folder_id,$loginuser_id['u_id']);
				//echo $this->db->last_query();exit
				//echo '<pre>';print_r($folder_details);exit;
				if(count($folder_details)>0){
					foreach($folder_details as $m_links){
						$delete_folder_imgs = $this->Recyclebin_model->permedelte_folder_images_list($m_links['f_id']);
						$this->Recyclebin_model->permenent_shared_delte_folder($m_links['f_id']);
						foreach($delete_folder_imgs as $list){
							$this->Recyclebin_model->permenentdelte_image($list['img_id']);
							unlink("assets/files/".$list['img_name']);
						}
						$delete_folder = $this->Recyclebin_model->permenentdelte_folder($m_links['f_id']);
						$this->Recyclebin_model->permenent_shared_delte_folder($m_links['f_id']);

					}
				}
				$folder = $this->Recyclebin_model->permedelte_folder_images_list($folder_id);
				$this->Recyclebin_model->permenent_shared_delte_folder($folder_id);
				foreach($folder as $list){
							$this->Recyclebin_model->permenentdelte_image($list['img_id']);
							unlink("assets/files/".$list['img_name']);
						}
				$delete_folder = $this->Recyclebin_model->permenentdelte_folder($folder_id);
				$this->Recyclebin_model->permenent_shared_delte_folder($folder_id);
			
					if(count($delete_folder)>0){
						$activity=array(
								'u_id'=>$loginuser_id['u_id'],
								'file'=>'',
								'folder'=>$folder_id,
								'link'=>'',
								'action'=>'Delete',
								'create_at'=>date('Y-m-d H:i:s')
								);
							$this->User_model->activity_login($activity);
						$this->session->set_flashdata('success',"Folder successfully Deleted");
						redirect('recyclebin');
					
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('recyclebin');
					
					}
				
			
		
		}else{
			 $this->session->set_flashdata('error','Please login to continue');
			 redirect('');
		} 
		
	}
	
	
	
	
	
}
