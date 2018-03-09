<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cloud extends CI_Controller {

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
			redirect('dashboard');
		}else{
			$data['tab'] ='';
			$data['questions_list'] =$this->User_model->get_question_list();
			$this->load->view('html/login',$data);
		}
		
	}
	public function index_backup()
	{
		$this->load->view('html/header');
		$this->load->view('html/sidebar');
		$this->load->view('html/index');
		$this->load->view('html/footer');
	}
	
	public function login_post(){
			$post = $this->input->post();
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim|xss_clean');
			$this->form_validation->set_rules('password', 'Password',  'required|min_length[6]');
			if ($this->form_validation->run() == FALSE) {
					$data['validationerrors'] = validation_errors();
					$data['tab'] ='1';
					$this->load->view('html/login',$data);
			}else{
				$useremail = $this->security->sanitize_filename($post['email'], TRUE);
				$check_login=$this->User_model->check_login_details($useremail,md5($post['password']));
				if(count($check_login)>0){
						$date=date('Y-m-d H:i:s');
						$date1  = new DateTime($date);
						$date2 = new DateTime($check_login['password_lastupdate']);
						$days  = $date2->diff($date1)->format('%a');
						$updateuserdata=array(
							'ip_address'=>$this->input->ip_address(),
							'last_login_time'=>date('Y-m-d H:i:s')
							);
						$this->User_model->update_user_data($check_login['u_id'],$updateuserdata);
							$activity=array(
								'u_id'=>$check_login['u_id'],
								'file'=>'',
								'folder'=>'',
								'link'=>'',
								'action'=>'Login',
								'create_at'=>date('Y-m-d H:i:s')
								);
							$this->User_model->activity_login($activity);
					$this->session->set_userdata('userdetails',$check_login);
					if($days >=90){
							redirect('profile/resetpassword');
						}else{
							redirect('dashboard');
						}
					
				}else{
					$this->session->set_flashdata('error',"Login Details are wrong. Plase try again");
					redirect('');
				}
			}
	}
	
	public function register_post(){
		$post=$this->input->post();
		//echo '<pre>';print_r($post);exit;
		$this->form_validation->set_rules('custname', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim|xss_clean|callback_check_email_unique');
        $this->form_validation->set_rules('mobile', 'Mobile',  'required|min_length[10]|xss_clean|callback_check_mobile_unique');
        $this->form_validation->set_rules('password', 'Password',  'required|min_length[6]|max_length[12]');
        $this->form_validation->set_rules('confirmpwd', 'Confirm Password', 'required|min_length[6]|max_length[12]');
        if ($this->form_validation->run() == FALSE) {
			$data['validationerrors'] = validation_errors();
			$data['tab'] ='2';
            $this->load->view('html/login',$data);
        }else{
			if(md5($post['password'])==md5($post['confirmpwd'])){
				$this->zend->load('Zend/Barcode');
				$username = $this->security->sanitize_filename($this->input->post('custname'), TRUE);
				$useremail = $this->security->sanitize_filename($this->input->post('email'), TRUE);
				$usermobile = $this->security->sanitize_filename($this->input->post('mobile'), TRUE);
				$userdata=array(
				'u_name'=>$username,
				'u_email'=>$useremail,
				'u_mobile'=>$usermobile,
				'u_password'=>md5($post['password']),
				'u_orginalpassword'=>$post['password'],
				'question_1'=>$post['questions1'],
				'answer_1'=>$post['answer1'],
				'question_2'=>$post['questions2'],
				'answer_2'=>$post['answer2'],
				'question_3'=>$post['questions3'],
				'answer_3'=>$post['answer3'],
				'last_login_time'=>date('Y-m-d H:i:s'),
				'password_lastupdate'=>date('Y-m-d H:i:s'),
				'ip_address'=>$this->input->ip_address(),
				'u_status'=>1,
				'role'=>1,
				'u_create_at'=>date('Y-m-d H:i:s'),
				);
				$saveduser = $this->User_model->save_user($userdata);
				if(count($saveduser)>0){
					$activity=array(
						'u_id'=>$saveduser,
						'file'=>'',
						'folder'=>'',
						'link'=>'',
						'action'=>'Register',
						'create_at'=>date('Y-m-d H:i:s')
						);
					$this->User_model->activity_login($activity);
					$file = Zend_Barcode::draw('code128', 'image', array('text' => $saveduser), array());
					$code = time().$saveduser;
					$store_image1 = imagepng($file, $this->config->item('documentroot')."assets/userbarcodes/{$code}.png");
					$this->User_model->update_user_barcode($saveduser,$code.'.png');
					$userdetals=$this->User_model->get_user_details($saveduser);
					$this->session->set_userdata('userdetails',$userdetals);
					redirect('dashboard');
				}else{
					$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
					redirect('');
				}
			}else{
				$this->session->set_flashdata('error',"Password and Confirm password are not matched.");
				redirect('');
			}
		}
	}
	function check_email_unique(){
     $email = $this->input->post('email');
	 $check=$this->User_model->check_email_unique($email);
		 if(count($check)==0){
			 return true;
		 }else{
			 $this->form_validation->set_message('check_email_unique', 'Email Address already exits. Please use another Email Address');
			 return false;
		 } 
	}
	function check_mobile_unique(){
     $mobile = $this->input->post('mobile');
	 $check=$this->User_model->check_mobile_unique($mobile);
		 if(count($check)==0){
			 return true;
		 }else{
			 $this->form_validation->set_message('check_mobile_unique', 'Mobile Number already exits. Please use another Mobile Number');
			 return false;
		 } 
	}
	public function forgotpassword(){
		if(!$this->session->userdata('userdetails'))
		 {
			$post=$this->input->post();
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim|xss_clean');
			if ($this->form_validation->run() == FALSE) {
			$data['validationerrors'] = validation_errors();
			$data['tab'] ='3';
			$this->load->view('html/login',$data);
			}else{
				$email_check=$this->User_model->get_forgotpassword_details($post['email']);
				if(count($email_chec)>0){
						$this->load->library('email');
						$this->email->set_newline("\r\n");
						$this->email->set_mailtype("html");
						$this->email->from('Cloud.com');
						$this->email->to($email);
						$this->email->subject('shofus - Forgot Password');
						$html = $this->load->view('email/forgetpassword', $data, true); 
						$this->email->message($html);
						$this->email->send();
				}else{
					$this->session->set_flashdata('error','You are unregistered email id. Please try again');
					redirect('');
				}
			}		
			 echo '<pre>';print_r($email_check);exit;
		 }else{
			$this->session->set_flashdata('loginerror','Please login to continue');
			redirect('dashboard');
		} 
	}
	public function logout()
	{
		$userinfo = $this->session->userdata('userdetails');
        $this->session->unset_userdata($userinfo);
		$this->session->sess_destroy('userdetails');
		$this->session->unset_userdata('userdetails');
		$this->session->set_flashdata('loginerror','Please login to continue');
        redirect('');
		  
	}
	
	
	
}
