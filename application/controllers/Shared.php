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

			//echo '<pre>';print_r($shared);exit;
			$this->load->view('html/header',$data);
			$this->load->view('html/sidebar',$data);
			$this->load->view('html/shared',$shared);
			$this->load->view('html/footer');
		}else{
			$this->load->view('html/login');
		}
		
		
	}
	
	
	
	
	
	
}
