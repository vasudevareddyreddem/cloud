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
			unset($_SESSION['make_bread']);
			$loginuser_id=$this->session->userdata('userdetails');
			$data['page_id']='';
			$data['floder_id']='';
			$data['userdetails']=$this->User_model->get_user_all_details($loginuser_id['u_id']);
			$filedata['recen_file_data']=$this->Dashboard_model->recen_get_pagewisefileupload_data($loginuser_id['u_id']);
			//$filedata['recen_floder_data']=$this->Dashboard_model->recen_get_floder_data($loginuser_id['u_id']);
			$filedata['recen_floder_data']=array();
			$filedata['file_data']=$this->Dashboard_model->get_fileupload_data($loginuser_id['u_id']);
			$filedata['floder_data']=$this->Dashboard_model->get_flodername_data($loginuser_id['u_id']);
			$filedata['floder_name_list']=$this->Dashboard_model->get_flodername_list($loginuser_id['u_id']);	
			$data['all_users_list']=$this->Dashboard_model->get_all_users_list($loginuser_id['u_id']);
			$data['notofication_list']=$this->Dashboard_model->get_user_notification_list($loginuser_id['u_id']);	
			$data['notofication_uread_count']=$this->Dashboard_model->get_user_notification_unreadcount($loginuser_id['u_id']);				
			//echo $this->db->last_query();
			//echo '<pre>';print_r($data);exit;
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
			if(is_numeric($fid)){
			$_SESSION['make_bread'][] = $fid;
			foreach($_SESSION['make_bread'] as $list){
				if(is_numeric($list)){
					$li[]=$list;
				}
			}
			$bread=implode(',',array_unique($li));
			$len =  strpos($bread,$fid);
			$idds=substr($bread,0,$len);
				$this->make_bread->add('Dashboard','dashboard');
				foreach(explode(",",$idds) as $li){
					if($li!=0){
					$name=$this->Dashboard_model->get_customer_floder_name($li);
					$this->make_bread->add($name['f_name'], 'dashboard/page/'.base64_encode($name["page_id"]).'/'.base64_encode($name["floder_id"]));
					}
				}
				$filedata['breadcoums'] = $this->make_bread->output();
			}
			//echo '<pre>';print_r($filedata);exit;			
			$data['userdetails']=$this->User_model->get_user_all_details($loginuser_id['u_id']);
			$filedata['flodername']=$this->Dashboard_model->get_flodername($fid);
			$data['page_id']=isset($pid)?$pid:'';
			$data['floder_id']=isset($fid)?$fid:'';
			$filedata['file_data']=$this->Dashboard_model->get_pagewisefileupload_data($loginuser_id['u_id'],$pid,$fid);
			$filedata['floder_data']=$this->Dashboard_model->get_pagewiseflodername_data($loginuser_id['u_id'],$pid,$fid);	
			$filedata['floder_name_list']=$this->Dashboard_model->get_flodername_list($loginuser_id['u_id']);	
			$filedata['floder_moving_list']=$this->Dashboard_model->get_floder_movingname_list($loginuser_id['u_id'],$fid);	
			$data['all_users_list']=$this->Dashboard_model->get_all_users_list($loginuser_id['u_id']);		
			$data['notofication_list']=$this->Dashboard_model->get_user_notification_list($loginuser_id['u_id']);	
			$data['notofication_uread_count']=$this->Dashboard_model->get_user_notification_unreadcount($loginuser_id['u_id']);	
			//$filedata['users_list']=$this->Dashboard_model->get_all_users_list();	
			//echo '<pre>';print_r($data);exit;
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
			//echo '<pre>';print_r($_FILES);
			$this->load->helper('file');
			$this->form_validation->set_rules('file', '', 'callback_file_check');

			if($this->form_validation->run() == FALSE) {
				$data['validationerrors'] = validation_errors();
				$filedata['recen_floder_data']=$this->Dashboard_model->recen_get_floder_data($loginuser_id['u_id']);
				$filedata['file_data']=$this->Dashboard_model->get_fileupload_data($loginuser_id['u_id']);
				$filedata['floder_data']=$this->Dashboard_model->get_flodername_data($loginuser_id['u_id']);
				$data['all_users_list']=$this->Dashboard_model->get_all_users_list($loginuser_id['u_id']);
				$filedata['recen_file_data']=$this->Dashboard_model->recen_get_pagewisefileupload_data($loginuser_id['u_id']);
				$filedata['recen_floder_data']=$this->Dashboard_model->recen_get_floder_data($loginuser_id['u_id']);
				$filedata['floder_name_list']=$this->Dashboard_model->get_flodername_list($loginuser_id['u_id']);	
				$data['notofication_list']=$this->Dashboard_model->get_user_notification_list($loginuser_id['u_id']);	
				$data['notofication_uread_count']=$this->Dashboard_model->get_user_notification_unreadcount($loginuser_id['u_id']);	
				$data['page_id']='';
				$data['floder_id']='';
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
					if(move_uploaded_file($_FILES['file']['tmp_name'], "assets/files/" . $imgname)){
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
						$this->session->set_flashdata('error',"Upload file too Large. please decrease file size");
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
			//echo '<pre>';print_r($post);exit;
			$this->load->helper('file');
			$this->form_validation->set_rules('flodername', 'Floder Name', 'required');
			if($this->form_validation->run() == FALSE) {
				redirech('dashboard');
			}else{
				if(isset($post['pageid']) && $post['pageid']!=''){
					$p=$post['pageid'];
				}else{
					$p=1;
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
	public function filerename()
	{
		if($this->session->userdata('userdetails'))
		{
			$loginuser_id=$this->session->userdata('userdetails');
			$data['userdetails']=$this->User_model->get_user_all_details($loginuser_id['u_id']);
			
			$post=$this->input->post();
			$fname = $this->security->sanitize_filename($this->input->post('filerename'), TRUE);
				$renamedata=array(
						'u_id'=>$loginuser_id['u_id'],
						'imag_org_name'=>$fname,
						'f_update_at'=>date('Y-m-d H:i:s'),				
						);
					//echo '<pre>';print_r($floderdata);exit;
					$renamechanges = $this->Dashboard_model->update_filename_changes($post['imagid'],$renamedata);
					if(count($renamechanges)>0){
						$recentlyopen_file=array(
						'u_id'=>$loginuser_id['u_id'],
						'file_id'=>$post['imagid'],
						'r_file_status'=>1,
						'r_file_create_at'=>date('Y-m-d H:i:s'),
						'r_file_updated_at'=>date('Y-m-d H:i:s'),
						);
						$this->Dashboard_model->save_recently_file_open($recentlyopen_file);
						$this->session->set_flashdata('success',"Rename successfully changed");
						if(isset($post['recent']) && $post['recent']==1){
							redirect('recent');
						}else if(isset($post['pageid']) && $post['pageid']!=''){
							redirect('dashboard/page/'.base64_encode($post['pageid']).'/'.base64_encode($post['floderid']));
						}else{
							redirect('dashboard');
						}
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						if(isset($post['recent']) && $post['recent']==1){
							redirect('recent');
						}else if(isset($post['pageid']) && $post['pageid']!=''){
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
	public function folderrename()
	{
		if($this->session->userdata('userdetails'))
		{
			$loginuser_id=$this->session->userdata('userdetails');
			$data['userdetails']=$this->User_model->get_user_all_details($loginuser_id['u_id']);
			
			$post=$this->input->post();
			//echo '<pre>';print_r($post);exit;
			$fname = $this->security->sanitize_filename($this->input->post('folderrename'), TRUE);
				$renamedata=array(
						'u_id'=>$loginuser_id['u_id'],
						'f_name'=>$fname,
						'f_updated_at'=>date('Y-m-d H:i:s'),				
						);
					//echo '<pre>';print_r($floderdata);exit;
					$renamechanges = $this->Dashboard_model->update_flodername_changes($post['renamefloderid'],$renamedata);
					if(count($renamechanges)>0){
						$recentlyopen_folder=array(
						'u_id'=>$loginuser_id['u_id'],
						'f_id'=>$post['renamefloderid'],
						'r_f_status'=>1,
						'r_f_create_at'=>date('Y-m-d H:i:s'),
						'r_f_updated_at'=>date('Y-m-d H:i:s'),
						);
						$this->Dashboard_model->recently_view_data($recentlyopen_folder);
						$this->session->set_flashdata('success',"Rename successfully changed");
						
						if(isset($post['recent']) && $post['recent']=1){
						redirect('recent');	
						}else if(isset($post['pageid']) && $post['pageid']!=''){
							redirect('dashboard/page/'.base64_encode($post['pageid']).'/'.base64_encode($post['floderid']));
						}else{
							redirect('dashboard');
						}
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						if(isset($post['recent']) && $post['recent']=1){
						redirect('recent');	
						}else if(isset($post['pageid']) && $post['pageid']!=''){
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
	public function imgdelte()
	{
		if($this->session->userdata('userdetails'))
		{
			$loginuser_id=$this->session->userdata('userdetails');
			$data['userdetails']=$this->User_model->get_user_all_details($loginuser_id['u_id']);
			
			$post=$this->input->post();
			$image_id=base64_decode($this->uri->segment(3));
			$pid=base64_decode($this->uri->segment(4));
			$fid=base64_decode($this->uri->segment(5));
				$deletedata=array(
						//'u_id'=>$loginuser_id['u_id'],
						'img_undo'=>1,
						'f_update_at'=>date('Y-m-d H:i:s'),				
						);
					//echo '<pre>';print_r($deletedata);
					$delete_image = $this->Dashboard_model->update_filename_changes($image_id,$deletedata);
					//echo $this->db->last_query();exit;
					if(count($delete_image)>0){
						
						$this->session->set_flashdata('success',"FIle successfully Deleted");
						if(isset($pid) && $pid =='recent'){
							redirect('recent');
						}else if(isset($pid) && $pid!=''){
							redirect('dashboard/page/'.base64_encode($pid).'/'.base64_encode($fid));
						}else{
							redirect('dashboard');
						}
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						if(isset($pid) && $pid =='recent'){
							redirect('recent');
						}else if(isset($pid) && $pid!=''){
							redirect('dashboard/page/'.base64_encode($pid).'/'.base64_encode($fid));
						}else{
							redirect('dashboard');
						}
					}
				
			
		
		}else{
			 $this->session->set_flashdata('error','Please login to continue');
			 redirect('');
		} 
		
	}
	public function deletefloder()
	{
		if($this->session->userdata('userdetails'))
		{
			$loginuser_id=$this->session->userdata('userdetails');
			$data['userdetails']=$this->User_model->get_user_all_details($loginuser_id['u_id']);
			
			$post=$this->input->post();
			$floder_id=base64_decode($this->uri->segment(3));
			$pid=base64_decode($this->uri->segment(4));
			$fid=base64_decode($this->uri->segment(5));
			/*$folder_details = $this->Dashboard_model->delete_for_all_data($floder_id,$loginuser_id['u_id']);
				if(count($folder_details)>0){
					foreach($folder_details as $m_links){
						$this->Dashboard_model->update_folder_todelte($m_links['f_id'],array('f_undo'=>1));
					}
				}*/
			$del=$this->Dashboard_model->update_folder_todelte($floder_id,array('f_undo'=>1));
			if(count($del)>0){
				$this->session->set_flashdata('success',"Folder successfully Deleted");

				if(isset($pid) && $pid =='recent'){
					redirect('recent');
				}else if(isset($pid) && $pid!=''){
					redirect('dashboard/page/'.base64_encode($pid).'/'.base64_encode($fid));
				}else{
					redirect('dashboard');
				}
			}else{
					$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
					if(isset($pid) && $pid =='recent'){
						redirect('recent');
					}else if(isset($pid) && $pid!=''){
						redirect('dashboard/page/'.base64_encode($pid).'/'.base64_encode($fid));
					}else{
						redirect('dashboard');
					}
				}
		}else{
			 $this->session->set_flashdata('error','Please login to continue');
			 redirect('');
		} 
		
	}
	function files_check(){
		$allowed_mime_type_arr =array('csv','exe','mp4','mp3','3gpp','gif','png','jpeg','pjpeg','bmp','pptx','mpeg','tiff','rtf','quicktime','msword','svg+xml','jpg','php','pdf','x-rar-compressed','css','zip','msword','x-zip','doc','docx','html');
		
		$count = 0;
				foreach ($_FILES['file']['name'] as $i => $name) {
					if (strlen($_FILES['file']['name'][$i]) > 1) {
					$mime = get_mime_by_extension($_FILES['file']['name'][$i]);
					if(isset($_FILES['file']['name'][$i]) && $_FILES['file']['name'][$i]!=""){
						$ext = pathinfo($_FILES['file']['name'][$i], PATHINFO_EXTENSION);
						if(in_array($ext,$allowed_mime_type_arr) ) {
							return true;
						}else{
							$this->form_validation->set_message('file_check', 'Please select only gif/png/jpeg/pjpeg/bmp/pptx/mpeg/tiff/rtf/quicktime/msword/svg+xml/jpg/php/pdf/x-rar-compressed/css/zip/msword/x-zip/doc/docx/html file.');
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
		$allowed_mime_type_arr =array('csv','exe','mp4','mp3','3gpp','gif','png','jpeg','pjpeg','bmp','pptx','mpeg','tiff','rtf','quicktime','msword','svg+xml','jpg','php','pdf','x-rar-compressed','css','zip','msword','x-zip','doc','docx','html');
        $mime = get_mime_by_extension($_FILES['file']['name']);
		if(isset($_FILES['file']['name']) && $_FILES['file']['name']!=""){
			$filename = $_FILES['file']['name'];
			$ext = pathinfo($filename, PATHINFO_EXTENSION);
			if(in_array($ext,$allowed_mime_type_arr) ) {
                return true;
            }else{
                $this->form_validation->set_message('file_check', 'Please select only gif/png/jpeg/pjpeg/bmp/pptx/mpeg/tiff/rtf/quicktime/msword/svg+xml/jpg/php/pdf/x-rar-compressed/css/zip/msword/x-zip/doc/docx/html file.');
                return false;
            }
        }else{
            $this->form_validation->set_message('file_check', 'Please choose a file to upload.');
            return false;
        }
    }
	 public function addfavourite(){
	 
	if($this->session->userdata('userdetails'))
	 {
		$loginuser_id=$this->session->userdata('userdetails');
		$post=$this->input->post();
		$detailsa=array(
		'u_id'=>$loginuser_id['u_id'],
		'file_id'=>$post['item_id'],
		'create_at'=>date('Y-m-d H:i:s'),
		'yes'=>1,
		'status'=>1,
		);
		$favourite = $this->Dashboard_model->get_favourite_list($loginuser_id['u_id']);
		if(count($favourite)>0){
				foreach($favourite as $lists) { 
							
								$itemsids[]=$lists['file_id'];
				}
			if(in_array($post['item_id'],$itemsids)){
				$removefavourite=$this->Dashboard_model->remove_favourite($loginuser_id['u_id'],$post['item_id']);
				if(count($removefavourite)>0){
				$data['msg']=2;	
				echo json_encode($data);
				}
			
			}else{
				$addfavourite = $this->Dashboard_model->add_favourite($detailsa);
				if(count($addfavourite)>0){
					$recentlyopen_file=array(
						'u_id'=>$loginuser_id['u_id'],
						'file_id'=>$post['item_id'],
						'r_file_status'=>1,
						'r_file_create_at'=>date('Y-m-d H:i:s'),
						'r_file_updated_at'=>date('Y-m-d H:i:s'),
						);
						$this->Dashboard_model->save_recently_file_open($recentlyopen_file);
						
				$data['msg']=1;	
				echo json_encode($data);
				}
			}
			
		}else{
			$addfavourite = $this->Dashboard_model->add_favourite($detailsa);
			//echo $this->db->last_query();
				if(count($addfavourite)>0){
					$recentlyopen_file=array(
						'u_id'=>$loginuser_id['u_id'],
						'file_id'=>$post['item_id'],
						'r_file_status'=>1,
						'r_file_create_at'=>date('Y-m-d H:i:s'),
						'r_file_updated_at'=>date('Y-m-d H:i:s'),
						);
						$this->Dashboard_model->save_recently_file_open($recentlyopen_file);
						//echo $this->db->last_query();exit;
						
				$data['msg']=1;	
				echo json_encode($data);
				}
			
		}
		
	
		
	}else{
		$data['msg']=0;	
		echo json_encode($data); 
		$this->session->set_flashdata('loginerror','Please login to continue');
		 //redirect('customer');
	}
	 
 } 
 public function addfolderfavourite(){
	 
	if($this->session->userdata('userdetails'))
	 {
		$loginuser_id=$this->session->userdata('userdetails');
		$post=$this->input->post();
		$detailsa=array(
		'u_id'=>$loginuser_id['u_id'],
		'f_id'=>$post['item_id'],
		'create_at'=>date('Y-m-d H:i:s'),
		'yes'=>1,
		'status'=>1,
		);
		$favourite = $this->Dashboard_model->get_floderfavourite_list($loginuser_id['u_id']);
		if(count($favourite)>0){
				foreach($favourite as $lists) { 
							
								$itemsids[]=$lists['f_id'];
				}
			if(in_array($post['item_id'],$itemsids)){
				$removefavourite=$this->Dashboard_model->remove_folder_favourite($loginuser_id['u_id'],$post['item_id']);
				if(count($removefavourite)>0){
				$data['msg']=2;	
				echo json_encode($data);
				}
			
			}else{
				$addfavourite = $this->Dashboard_model->add_folder_favourite($detailsa);
				if(count($addfavourite)>0){
					$recentlyopen_folder=array(
						'u_id'=>$loginuser_id['u_id'],
						'f_id'=>$post['item_id'],
						'r_f_status'=>1,
						'r_f_create_at'=>date('Y-m-d H:i:s'),
						'r_f_updated_at'=>date('Y-m-d H:i:s'),
						);
						$this->Dashboard_model->recently_view_data($recentlyopen_folder);
						
				$data['msg']=1;	
				echo json_encode($data);
				}
			}
			
		}else{
			$addfavourite = $this->Dashboard_model->add_folder_favourite($detailsa);
			//echo $this->db->last_query();
				if(count($addfavourite)>0){
					$recentlyopen_folder=array(
						'u_id'=>$loginuser_id['u_id'],
						'f_id'=>$post['item_id'],
						'r_f_status'=>1,
						'r_f_create_at'=>date('Y-m-d H:i:s'),
						'r_f_updated_at'=>date('Y-m-d H:i:s'),
						);
						$this->Dashboard_model->recently_view_data($recentlyopen_folder);
						
				$data['msg']=1;	
				echo json_encode($data);
				}
			
		}
		
	
		
	}else{
		$data['msg']=0;	
		echo json_encode($data); 
		$this->session->set_flashdata('loginerror','Please login to continue');
		 //redirect('customer');
	}
	 
 }
 public function cloud(){
	 
	 			$folder_details = $this->Dashboard_model->delete_for_all_data(3,5492214);
				foreach($folder_details as $list){
					
					//echo '<pre>';print_r($list);
				$this->Dashboard_model->update_folder_todelte($list['f_id'],array('f_undo'=>1));

					
				}
				
				echo '<pre>';print_r($folder_details);exit;

	 
 }
	
	
	
	
	
}
