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
			$this->load->view('html/login');
		}
		
		
	}
	
	
	
	
	
	
}
