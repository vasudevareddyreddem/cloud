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
		$this->load->library('make_bread');

		}
	public function index()
	{
		if($this->session->userdata('userdetails'))
		{
			$loginuser_id=$this->session->userdata('userdetails');
			$data['page_id']='';
			$data['floder_id']='';
			$data['userdetails']=$this->User_model->get_user_all_details($loginuser_id['u_id']);
			//$filedata['recen_file_data']=$this->Dashboard_model->recen_get_pagewisefileupload_data($loginuser_id['u_id']);
			$filedata['recen_floder_data']=$this->Dashboard_model->recen_get_floder_data($loginuser_id['u_id']);
			
			$filedata['file_data']=$this->Dashboard_model->get_fileupload_data($loginuser_id['u_id']);
			$filedata['floder_data']=$this->Dashboard_model->get_flodername_data($loginuser_id['u_id']);
			//echo '<pre>';print_r($filedata);exit;
			$this->load->view('html/header',$data);
			$this->load->view('html/sidebar',$data);
			$this->load->view('html/index',$filedata);
			$this->load->view('html/footer');
		}else{
			redirect('');
		}
		
	}
	public function page()
	{
		if($this->session->userdata('userdetails'))
		{
			$pid=base64_decode($this->uri->segment(3));
			$fid=base64_decode($this->uri->segment(4));
			$loginuser_id=$this->session->userdata('userdetails');
			$rencently=array(
			'u_id'=>$loginuser_id['u_id'],
			'f_id'=>$fid,
			'r_f_status'=>1,
			'r_f_create_at'=>date('Y-m-d H:i:s'),
			'r_f_updated_at'=>date('Y-m-d H:i:s')
			);
			if($fid!=0){
				$this->Dashboard_model->recently_view_data($rencently);
			}
			$userfloder_list=$this->Dashboard_model->get_customer_floder_list($loginuser_id['u_id']);
			foreach($userfloder_list as $list){
				if($list['floder_id']!='' && $list['floder_id']!=0){
				$lids[]=$list['floder_id'];
				}
			}
			if(isset($lids) && count($lids)>0){
				$this->make_bread->add('Dashboard','dashboard');
			foreach($lids as $li){
				if($li < $fid){
					$name=$this->Dashboard_model->get_customer_floder_name($li);
					$this->make_bread->add($name['f_name'], 'dashboard/page/'.base64_encode($name["page_id"]).'/'.base64_encode($name["floder_id"]));
				}
				
			}
			$filedata['breadcoums'] = $this->make_bread->output();
			}
			$data['userdetails']=$this->User_model->get_user_all_details($loginuser_id['u_id']);
			$filedata['flodername']=$this->Dashboard_model->get_flodername($fid);
			$data['page_id']=isset($pid)?$pid:'';
			$data['floder_id']=isset($fid)?$fid:'';
			$filedata['file_data']=$this->Dashboard_model->get_pagewisefileupload_data($loginuser_id['u_id'],$pid,$fid);
			$filedata['floder_data']=$this->Dashboard_model->get_pagewiseflodername_data($loginuser_id['u_id'],$pid,$fid);	
			//echo '<pre>';print_r($filedata);exit;
			$this->load->view('html/header',$data);
			$this->load->view('html/sidebar',$data);
			$this->load->view('html/page',$filedata);
			$this->load->view('html/footer');
		}else{
			redirect('');
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
				$filedata['recen_floder_data']=$this->Dashboard_model->recen_get_floder_data($loginuser_id['u_id']);
				$filedata['file_data']=$this->Dashboard_model->get_fileupload_data($loginuser_id['u_id']);
				$filedata['floder_data']=$this->Dashboard_model->get_flodername_data($loginuser_id['u_id']);

				$this->load->view('html/header',$data);
				$this->load->view('html/sidebar',$data);
				$this->load->view('html/index',$filedata);
				$this->load->view('html/footer');
			}else{
				
				if($_FILES['file']['name']!=''){
						if(isset($post['pageid']) && $post['pageid']!=''){
						$p=$post['pageid'];
						}else{
						$p=0;
						}if(isset($post['floderid']) && $post['floderid']!=''){
						$f=$post['floderid'];
						}else{
						$f=0;
						}
					$pic=$_FILES['file']['name'];
					$picname = str_replace(" ", "", $pic);
					$imagename=microtime().basename($picname);
					$imgname = str_replace(" ", "", $imagename);
					move_uploaded_file($_FILES['file']['tmp_name'], "assets/files/" . $imgname);
					$filedata=array(
						'u_id'=>$loginuser_id['u_id'],
						'img_name'=>$imgname,
						'imag_org_name'=>$picname,
						'page_id'=>$p,
						'floder_id'=>$f,
						'img_create_at'=>date('Y-m-d H:i:s'),				
						'img_status'=>1,				
						'img_undo'=>0,
						);
					//echo '<pre>';print_r($updateuserdata);exit;
					$addfile = $this->Dashboard_model->save_userfile($filedata);
					if(count($addfile)>0){
						$this->session->set_flashdata('success',"File successfully Uploaded");
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
					redirect('dashboard');
				}
			}
		}else{
			 $this->session->set_flashdata('error','Please login to continue');
			 redirect('');
		} 
		
	}
	public function multifilepost()
	{
		if($this->session->userdata('userdetails'))
		{
			$loginuser_id=$this->session->userdata('userdetails');
			$data['userdetails']=$this->User_model->get_user_all_details($loginuser_id['u_id']);
			
			$post=$this->input->post();
			if($_FILES['file']['name']!=''){
						if(isset($post['pageid']) && $post['pageid']!=''){
						$p=$post['pageid'];
						}else{
						$p=0;
						}if(isset($post['floderid']) && $post['floderid']!=''){
						$f=$post['floderid'];
						}else{
						$f=0;
						}
					
					$count = 0;
					foreach ($_FILES['file']['name'] as $i => $name) {
						if (strlen($_FILES['file']['name'][$i]) > 1) {
							$pic=$_FILES['file']['name'][$i];
							$picname = str_replace(" ", "", $pic);
							$imagename=microtime().basename($picname);
							$imgname = str_replace(" ", "", $imagename);
								move_uploaded_file($_FILES['file']['tmp_name'][$i], 'assets/files/'.$imgname);
								$count++;
								$filedata=array(
								'u_id'=>$loginuser_id['u_id'],
								'img_name'=>$imgname,
								'imag_org_name'=>$picname,
								'page_id'=>$p,
								'floder_id'=>$f,
								'img_create_at'=>date('Y-m-d H:i:s'),				
								'img_status'=>1,				
								'img_undo'=>0,
								);
							//echo '<pre>';print_r($updateuserdata);exit;
							$addfile = $this->Dashboard_model->save_userfile($filedata);
						}
					}
					
					
					if(count($addfile)>0){
						$this->session->set_flashdata('success',"File successfully Uploaded");
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
					redirect('dashboard');
				}
		
		}else{
			 $this->session->set_flashdata('error','Please login to continue');
			 redirect('');
		} 
		
	}
	public function flodername()
	{
		if($this->session->userdata('userdetails'))
		{
			$loginuser_id=$this->session->userdata('userdetails');
			$data['userdetails']=$this->User_model->get_user_all_details($loginuser_id['u_id']);
			
			$post=$this->input->post();
			//echo '<pre>';print_r($post);
			$this->load->helper('file');
			$this->form_validation->set_rules('flodername', 'Floder Name', 'required');
			if($this->form_validation->run() == FALSE) {
				redirech('dashboard');
			}else{
				if(isset($post['pageid']) && $post['pageid']!=''){
					$p=$post['pageid'];
				}else{
					$p=0;
				}if(isset($post['floderid']) && $post['floderid']!=''){
					$f=$post['floderid'];
				}else{
					$f=0;
				}
				$fname = $this->security->sanitize_filename($this->input->post('flodername'), TRUE);
				$floderdata=array(
						'u_id'=>$loginuser_id['u_id'],
						'f_name'=>$fname,
						'page_id'=>$p,
						'floder_id'=>$f,
						'f_status'=>1,
						'f_create_at'=>date('Y-m-d H:i:s'),				
						'f_updated_at'=>date('Y-m-d H:i:s'),				
						'f_undo'=>0,
						);
					//echo '<pre>';print_r($floderdata);exit;
					$addfloder = $this->Dashboard_model->save_floders($floderdata);
					if(count($addfloder)>0){
						$this->session->set_flashdata('success',"Floder successfully Created");
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
				
				}
		
		}else{
			 $this->session->set_flashdata('error','Please login to continue');
			 redirect('');
		} 
		
	}
	function files_check(){
        $allowed_mime_type_arr = array('application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/zip', 'application/msword', 'application/x-zip','application/x-download','application/pdf','image/gif','image/jpeg','image/pjpeg','image/png','image/x-png');
		
		$count = 0;
				foreach ($_FILES['file']['name'] as $i => $name) {
					if (strlen($_FILES['file']['name'][$i]) > 1) {
						
					$mime = get_mime_by_extension($_FILES['file']['name'][$i]);
					if(isset($_FILES['file']['name'][$i]) && $_FILES['file']['name'][$i]!=""){
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
                $count++;
					
				}
						
				}
		
    }
	
	function file_check(){
        $allowed_mime_type_arr = array('application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/zip', 'application/msword', 'application/x-zip','application/x-download','application/pdf','application/doc','application/docx','text/html','text/plain','image/jpeg','image/gif','image/bmp','image/vnd.microsoft.icon','image/tiff','image/tiff','image/svg+xml','image/svg+xml','application/vnd.ms-cab-compressed','application/x-msdownload','application/x-msdownload','application/x-rar-compressed','audio/mpeg','video/quicktime','video/quicktime','image/vnd.adobe.photoshop','application/postscript', 'application/postscript','application/postscript','application/vnd.ms-powerpoint','application/vnd.ms-excel','application/rtf','application/msword','text/html','text/css','image/php','image/gif','image/jpeg','image/pjpeg','image/png','image/x-png');
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
