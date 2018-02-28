<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Shared extends CI_Controller {

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
		$this->load->model('User_model');
		$this->load->model('Images_model');
		$this->load->model('Dashboard_model');

		$this->load->library('zend');
		}
	public function index()
	{
		if($this->session->userdata('userdetails'))
		{
			$loginuser_id=$this->session->userdata('userdetails');
			$data['userdetails']=$this->User_model->get_user_all_details($loginuser_id['u_id']);
			$data['all_users_list']=$this->Dashboard_model->get_all_users_list($loginuser_id['u_id']);	
			$shared['shared_file']=$this->Images_model->get_shared_file($loginuser_id['u_id']);	
			$shared['shared_folder']=$this->Images_model->get_shared_folder($loginuser_id['u_id']);	

			//echo '<pre>';print_r($shared);exit;
			$this->load->view('html/header',$data);
			$this->load->view('html/sidebar',$data);
			$this->load->view('html/shared',$shared);
			$this->load->view('html/footer');
		}else{
			$this->load->view('html/login');
		}
		
		
	}
	public function folder()
	{
		if($this->session->userdata('userdetails'))
		{
			$pid=base64_decode($this->uri->segment(3));
			$fid=base64_decode($this->uri->segment(4));
			$filedata['permissions']=base64_decode($this->uri->segment(5));
			$loginuser_id=$this->session->userdata('userdetails');
			
			
			//echo '<pre>';print_r($filedata);exit;			
			$data['userdetails']=$this->User_model->get_user_all_details($loginuser_id['u_id']);
			$filedata['flodername']=$this->Dashboard_model->get_flodername($fid);
			$data['page_id']=isset($pid)?$pid:'';
			$data['floder_id']=isset($fid)?$fid:'';
			$filedata['file_data']=$this->Images_model->get_pagewisefileupload_data($pid,$fid);
			$filedata['floder_data']=$this->Images_model->get_pagewiseflodername_data($pid,$fid);	
			$data['all_users_list']=$this->Dashboard_model->get_all_users_list($loginuser_id['u_id']);
			$filedata['shared_folder']=$this->Images_model->get_shared_folder($loginuser_id['u_id']);				
			//$filedata['users_list']=$this->Dashboard_model->get_all_users_list();	
			//echo '<pre>';print_r($filedata);exit;
			$this->load->view('html/header',$data);
			$this->load->view('html/sidebar',$data);
			$this->load->view('html/sharedpage',$filedata);
			$this->load->view('html/footer');
		}else{
			redirect('');
		}
		
	}
	
	
	
	
	
	
}
