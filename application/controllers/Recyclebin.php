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
			$loginuser_id=$this->session->userdata('userdetails');
			$data['userdetails']=$this->User_model->get_user_all_details($loginuser_id['u_id']);
			$filedata['floder_data']=$this->Recyclebin_model->get_undo_floder_data($loginuser_id['u_id']);
			$filedata['file_data']=$this->Recyclebin_model->get_undo_file_data($loginuser_id['u_id']);
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

			$folder_details = $this->Recyclebin_model->delete_for_all_data($f_id,$loginuser_id['u_id']);
			//echo '<pre>';print_r($folder_details);exit;
			foreach($folder_details as $list){
				if($list['floder_id']!='' && $list['floder_id']!=0){
				$lids[]=$list['floder_id'];
				}
			}
			if(isset($lids) && count($lids)>0){
				$this->make_bread->add('Recycle Bin','recyclebin');
			foreach(array_unique($lids) as $li){
				if($li < $f_id){
					$name=$this->Dashboard_model->get_customer_floder_name($li);
					$this->make_bread->add($name['f_name'], 'recyclebin/folder/'.base64_encode($name["floder_id"]));
				}
				
			}
			$filedata['breadcoums'] = $this->make_bread->output();
			}else{
				$filedata['breadcoums']='';
			}
			$filedata['file_data']=$this->Recyclebin_model->get_delete_floder_data($loginuser_id['u_id'],$f_id);
			$filedata['floder_data']=$this->Recyclebin_model->get_pagewiseflodername_data($f_id);	
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
