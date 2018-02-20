<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Recent extends CI_Controller {

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
		$this->load->model('Recent_model');
		$this->load->model('Dashboard_model');
		$this->load->library('zend');
		}
	public function index()
	{
		if($this->session->userdata('userdetails'))
		{
			$loginuser_id=$this->session->userdata('userdetails');
			$data['userdetails']=$this->User_model->get_user_all_details($loginuser_id['u_id']);
			$filedata['file_data']=$this->Recent_model->recen_get_pagewisefileupload_data($loginuser_id['u_id']);
			$filedata['floder_data']=$this->Recent_model->recen_get_floder_data($loginuser_id['u_id']);
			
			//echo '<pre>';print_r($filedata);exit;
			$this->load->view('html/header',$data);
			$this->load->view('html/sidebar',$data);
			$this->load->view('html/recent',$filedata);
			$this->load->view('html/footer');
		}else{
			$this->load->view('html/login');
		}
		
		
	}
	
	
	
	
	
	
}