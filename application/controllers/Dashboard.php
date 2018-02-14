<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {

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
		$this->load->library('zend');
		}
	public function index()
	{
		if($this->session->userdata('userdetails'))
		{
			$loginuser_id=$this->session->userdata('userdetails');
			$data['userdetails']=$this->User_model->get_user_all_details($loginuser_id['u_id']);
			$this->load->view('html/header',$data);
			$this->load->view('html/sidebar',$data);
			$this->load->view('html/index');
			$this->load->view('html/footer');
		}else{
			$this->load->view('html/login');
		}
		
	}
	
	
	
	
	
}
