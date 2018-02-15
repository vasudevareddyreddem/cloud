<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Profile extends CI_Controller {

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
			$this->load->view('html/profile');
			$this->load->view('html/footer');
		}else{
			$this->load->view('html/login');
		}
		
	}
	public function edit()
	{
		if($this->session->userdata('userdetails'))
		{
			$loginuser_id=$this->session->userdata('userdetails');
			$data['userdetails']=$this->User_model->get_user_all_details($loginuser_id['u_id']);
			$this->load->view('html/header',$data);
			$this->load->view('html/sidebar',$data);
			$this->load->view('html/editprofile',$data);
			$this->load->view('html/footer');
		}else{
			$this->load->view('html/login');
		}
		
	}
	 public function editpost(){
	 
		if($this->session->userdata('userdetails'))
		{
			$loginuser_id=$this->session->userdata('userdetails');
			$data['userdetails']=$this->User_model->get_user_all_details($loginuser_id['u_id']);
			
			$post=$this->input->post();
			$this->load->helper('file');
			$this->form_validation->set_rules('custname', 'Name', 'required');
			if($post['email']== $data['userdetails']['u_email']){
				$this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim|xss_clean');
			}else{
				$this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim|xss_clean|callback_check_email_unique');
			}
			if($data['userdetails']['u_mobile'] == $this->input->post('mobile')){
			$this->form_validation->set_rules('mobile', 'Mobile',  'required|min_length[10]|xss_clean');
			}else{
			$this->form_validation->set_rules('mobile', 'Mobile',  'required|min_length[10]|xss_clean|callback_check_mobile_unique');
			}
			$this->form_validation->set_rules('gender', 'Gender',  'required|trim|xss_clean');
			if($_FILES['file']['name']!=''){
				$this->form_validation->set_rules('file', '', 'callback_file_check');
			}
			if ($this->form_validation->run() == FALSE) {
				$data['validationerrors'] = validation_errors();
				echo '<pre>';print_r($data);exit;
				$this->load->view('html/header',$data);
				$this->load->view('html/sidebar',$data);
				$this->load->view('html/editprofile',$data);
				$this->load->view('html/footer');
			}else{
				
				$username = $this->security->sanitize_filename($this->input->post('custname'), TRUE);
				$useremail = $this->security->sanitize_filename($this->input->post('email'), TRUE);
				$usermobile =$this->security->sanitize_filename($this->input->post('mobile'), TRUE);
				$dob =$post['dob'];
				if($_FILES['file']['name']!=''){
					$pic=$_FILES['file']['name'];
					move_uploaded_file($_FILES['file']['tmp_name'], "assets/users/" . $pic);

				}else{
					$pic=$data['userdetails']['u_profilepic'];
				}
				$updateuserdata=array(
				'u_name'=>$username,
				'u_email'=>$useremail,
				'u_mobile'=>$usermobile,
				'u_dob'=>$dob,				
				'u_profilepic'=>$pic,				
				'u_update_time'=>date('Y-m-d H:i:s'),
				);
				
				//echo '<pre>';print_r($updateuserdata);exit;
				$upddateuser = $this->User_model->update_user_data($loginuser_id['u_id'],$updateuserdata);
				if(count($upddateuser)>0){
					$this->session->set_flashdata('success',"Profile successfully updated");
					redirect('profile');
				}else{
					$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
					redirect('profile/edit');
				}
			}
		}else{
			 $this->session->set_flashdata('error','Please login to continue');
			 redirect('');
		} 
	 
	}
	public function changepassword()
	{
		if($this->session->userdata('userdetails'))
		{
			$loginuser_id=$this->session->userdata('userdetails');
			$data['userdetails']=$this->User_model->get_user_all_details($loginuser_id['u_id']);
			$this->load->view('html/header',$data);
			$this->load->view('html/sidebar',$data);
			$this->load->view('html/changepassword',$data);
			$this->load->view('html/footer');
		}else{
			redirect('');
		}
		
	}public function changepasswordpost(){
	 
		if($this->session->userdata('userdetails'))
		{
			$loginuser_id=$this->session->userdata('userdetails');
			$data['userdetails']=$this->User_model->get_user_all_details($loginuser_id['u_id']);
			$post=$this->input->post();
			$this->form_validation->set_rules('oldpassword', 'Old password',  'required|min_length[6]|xss_clean|callback_check_oldpassword');
			$this->form_validation->set_rules('password', 'Password',  'required|min_length[6]|xss_clean');
			$this->form_validation->set_rules('confirmpassword', 'Confirm Password',  'required|min_length[6]|xss_clean');
			
			if ($this->form_validation->run() == FALSE) {
				$data['validationerrors'] = validation_errors();
				$this->load->view('html/header',$data);
				$this->load->view('html/sidebar',$data);
				$this->load->view('html/changepassword',$data);
				$this->load->view('html/footer');
			}else{
				if(md5($post['password'])==md5($post['confirmpassword'])){
						$updateuserdata=array(
						'u_password'=>md5($post['confirmpassword']),
						'u_orginalpassword'=>$post['confirmpassword'],
						'u_update_time'=>date('Y-m-d H:i:s'),
						);
						//echo '<pre>';print_r($updateuserdata);exit;
						$upddateuser = $this->User_model->update_user_data($loginuser_id['u_id'],$updateuserdata);
						if(count($upddateuser)>0){
							$this->session->set_flashdata('success',"password successfully updated");
							redirect('profile/changepassword');
						}else{
							$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
							redirect('profile/changepassword');
						}
					
				}else{
					$this->session->set_flashdata('error',"Password and Confirm password are not matched");
					redirect('profile/changepassword');
				}
				
			}
		}else{
			 $this->session->set_flashdata('error','Please login to continue');
			 redirect('');
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
	}function check_oldpassword(){
	$loginuser_id=$this->session->userdata('userdetails');	
     $oldpwd = $this->input->post('oldpassword');
	 $check=$this->User_model->check_oldpassword_exits($loginuser_id['u_id'],md5($oldpwd));
		 if(count($check)>0){
			 return true;
		 }else{
			 $this->form_validation->set_message('check_oldpassword', 'Your Old password is wrong. Please try again');
			 return false;
		 } 
	}
	function file_check(){
        $allowed_mime_type_arr = array('image/gif','image/jpeg','image/pjpeg','image/png','image/x-png');
        $mime = get_mime_by_extension($_FILES['file']['name']);
        if(isset($_FILES['file']['name']) && $_FILES['file']['name']!=""){
            if(in_array($mime, $allowed_mime_type_arr)){
                return true;
            }else{
                $this->form_validation->set_message('file_check', 'Please select only gif/jpg/png file.');
                return false;
            }
        }else{
            $this->form_validation->set_message('file_check', 'Please choose a file to upload.');
            return false;
        }
    }
	
	
	
	
	
	
}
