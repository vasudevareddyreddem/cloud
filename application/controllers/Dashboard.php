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
		$this->load->model('Dashboard_model');
		$this->load->library('zend');
		}
	public function index()
	{
		if($this->session->userdata('userdetails'))
		{
			$loginuser_id=$this->session->userdata('userdetails');
			$data['userdetails']=$this->User_model->get_user_all_details($loginuser_id['u_id']);
			$filedata['file_data']=$this->Dashboard_model->get_fileupload_data($loginuser_id['u_id']);
			//echo '<pre>';print_r($filedata);exit;
			$this->load->view('html/header',$data);
			$this->load->view('html/sidebar',$data);
			$this->load->view('html/index',$filedata);
			$this->load->view('html/footer');
		}else{
			$this->load->view('html/login');
		}
		
	}
	public function filepost()
	{
		if($this->session->userdata('userdetails'))
		{
			$loginuser_id=$this->session->userdata('userdetails');
			$data['userdetails']=$this->User_model->get_user_all_details($loginuser_id['u_id']);
			
			$post=$this->input->post();
			//echo '<pre>';print_r($_FILES);exit;
			$this->load->helper('file');
			$this->form_validation->set_rules('file', '', 'callback_file_check');
			if($this->form_validation->run() == FALSE) {
				$data['validationerrors'] = validation_errors();
				//echo '<pre>';print_r($data);exit;
				$this->load->view('html/header',$data);
				$this->load->view('html/sidebar',$data);
				$this->load->view('html/index');
				$this->load->view('html/footer');
			}else{
				
				if($_FILES['file']['name']!=''){
					$pic=$_FILES['file']['name'];
					$picname = str_replace(" ", "", $pic);
					$imagename=microtime().basename($picname);
					$imgname = str_replace(" ", "", $imagename);
					move_uploaded_file($_FILES['file']['tmp_name'], "assets/files/" . $imgname);
					$filedata=array(
						'u_id'=>$loginuser_id['u_id'],
						'img_name'=>$imgname,
						'imag_org_name'=>$picname,
						'img_create_at'=>date('Y-m-d H:i:s'),				
						'img_status'=>1,				
						'img_undo'=>0,
						);
					//echo '<pre>';print_r($updateuserdata);exit;
					$addfile = $this->Dashboard_model->save_userfile($filedata);
					if(count($addfile)>0){
						$this->session->set_flashdata('success',"File successfully Uploaded");
						redirect('dashboard');
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('dashboard');
					}
				
				}else{
					redirect('dashboard');
				}
			}
		}else{
			 $this->session->set_flashdata('error','Please login to continue');
			 redirect('');
		} 
		
	}
	function file_check(){
        $allowed_mime_type_arr = array('application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/zip', 'application/msword', 'application/x-zip','application/x-download','application/pdf','image/gif','image/jpeg','image/pjpeg','image/png','image/x-png');
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
