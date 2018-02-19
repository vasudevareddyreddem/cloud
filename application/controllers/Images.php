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
		}
	public function index()
	{
		if($this->session->userdata('userdetails'))
		{
			$loginuser_id=$this->session->userdata('userdetails');
			$data['userdetails']=$this->User_model->get_user_all_details($loginuser_id['u_id']);
			$filedata['file_data']=$this->Images_model->get_fileupload_data($loginuser_id['u_id']);
			//echo '<pre>';print_r();exit;
			$this->load->view('html/header',$data);
			$this->load->view('html/sidebar',$data);
			$this->load->view('html/images',$filedata);
			$this->load->view('html/footer');
		}else{
			redirect();
		}
		
		
	}
	public function filemoving()
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
	
	
	
	
	
	
}
