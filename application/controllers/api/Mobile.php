<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . 'libraries/REST_Controller.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Mobile extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
		$this->load->library('email');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('security');
		$this->load->model('Mobile_model');
		$this->load->library('zend');
		$this->load->library('zip');
    }

  

    public function user_create_post()
    {
        
		$name=$this->post('name');
        $email=$this->post('email');
        $mobile=$this->post('mobile');
        $password=$this->post('password');
		if($name ==''){
		$message = array('status'=>0,'message'=>'Nameis required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}if($email ==''){
		$message = array('status'=>0,'message'=>'Email is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}if($mobile ==''){
		$message = array('status'=>0,'message'=>'Mobile Number is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}if($password ==''){
		$message = array('status'=>0,'message'=>'Password is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		$emailcheking =$this->Mobile_model->mobile_checking($email);
		if(count($emailcheking)>0){
			$message = array('status'=>0,'message'=>'Email id already exist. Please use  another Email id');
			$this->response($message, REST_Controller::HTTP_OK);
		}			
		$mobilecheking =$this->Mobile_model->mobile_checking($mobile);
		if(count($mobilecheking)>0){
			$message = array('status'=>0,'message'=>'Mobile number already exist. Please use  another Mobile Number');
			$this->response($message, REST_Controller::HTTP_OK);	
		}
		$username = $this->security->sanitize_filename($this->post('name'), TRUE);
		$useremail = $this->security->sanitize_filename($this->post('email'), TRUE);
		$usermobile = $this->security->sanitize_filename($this->post('mobile'), TRUE);
		$userdata=array(
				'u_name'=>$username,
				'u_email'=>$useremail,
				'u_mobile'=>$usermobile,
				'u_password'=>md5($password),
				'u_orginalpassword'=>$password,
				'u_status'=>1,
				'role'=>1,
				'u_create_at'=>date('Y-m-d H:i:s'),
				);
				$saveduser = $this->Mobile_model->save_user($userdata);
				if(count($saveduser)>0){
					$this->zend->load('Zend/Barcode');
					$file = Zend_Barcode::draw('code128', 'image', array('text' => $saveduser), array());
					$code = time().$saveduser;
					$store_image1 = imagepng($file, $this->config->item('documentroot')."assets/userbarcodes/{$code}.png");
					$this->Mobile_model->update_user_barcode($saveduser,$code.'.png');
					$userdetals=$this->Mobile_model->get_user_details($saveduser);
					$this->session->set_userdata('userdetails',$userdetals);
					$message = array('status'=>1,'userid'=>$saveduser,'message'=>'User successfully register');
					$this->response($message, REST_Controller::HTTP_OK);
				}else{
					$message = array('status'=>0,'message'=>'technical problem will occurred. Please try again.');
					$this->response($message, REST_Controller::HTTP_OK);
				}
		
    }
	 public function user_login_post()
    {
        
        $email=$this->post('email');
        $password=$this->post('password');
		if($email ==''){
		$message = array('status'=>0,'message'=>'Email is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}if($password ==''){
		$message = array('status'=>0,'message'=>'Password is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		$useremail = $this->security->sanitize_filename($this->post('email'), TRUE);
		$check_login=$this->Mobile_model->check_login_details($useremail,md5($password));
		if(count($check_login)>0){
					$this->session->set_userdata('userdetails',$check_login);
					$message = array('status'=>1,'userdetails'=>$check_login,'message'=>'User successfully Login');
					$this->response($message, REST_Controller::HTTP_OK);
				}else{
					$message = array('status'=>0,'message'=>'Login Details are wrong. Plase try again.');
					$this->response($message, REST_Controller::HTTP_OK);
				}

	}
	public function user_changepassword_post()
    {
        
        $userid=$this->post('userid');
        $oldpwd=$this->post('oldpwd');
        $newpwd=$this->post('newpwd');
		if($userid ==''){
		$message = array('status'=>0,'message'=>'User Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}if($oldpwd ==''){
		$message = array('status'=>0,'message'=>'Old Password is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}if($newpwd ==''){
		$message = array('status'=>0,'message'=>'New Password is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		$checkoldpassword = $this->Mobile_model->oldpassword($userid,$oldpwd);
			if(count($checkoldpassword)>0){
					$changepassword = $this->Mobile_model->set_user_password($userid,$newpwd);
					//echo $this->db->last_query();exit;
					if(count($changepassword)>0){
						$message = array('status'=>1,'userid'=>$userid,'message'=>'password successfully Updated');
					$this->response($message, REST_Controller::HTTP_OK);	
					}else{
						$message = array('status'=>0,'userid'=>$userid,'message'=>'Technical problem will occurred .Please try again');
					$this->response($message, REST_Controller::HTTP_OK);
					}
			}else{
				$message = array('status'=>0,'userid'=>$userid,'message'=>'Old password is wrong .please try again');
				$this->response($message, REST_Controller::HTTP_OK);
			}

	}
	public function user_forgotpassword_post()
    {
        
        $email=$this->post('email');
		if($email ==''){
		$message = array('status'=>0,'message'=>'Email Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		$emailcheking =$this->Mobile_model->mobile_checking($email);
		if(count($emailcheking)>0){
				$data['usedetails']=$emailcheking;
				$this->load->library('email');
				$this->email->set_newline("\r\n");
				$this->email->set_mailtype("html");
				$this->email->from('Cloud.com');
				$this->email->to($email);
				$this->email->subject('shofus - Forgot Password');
				$html = $this->load->view('email/forgetpassword', $data, true); 
				$this->email->message($html);
				$this->email->send();
			echo '<pre>';print_r($html);exit;
			$message = array('status'=>0,'message'=>'Email id already exist. Please use  another Email id');
			$this->response($message, REST_Controller::HTTP_OK);
		}else{
				$message = array('status'=>0,'userid'=>$userid,'message'=>'Email id not Registered. Please use another Email Address');
				$this->response($message, REST_Controller::HTTP_OK);
		}

	}
	public function user_profile_post()
    {
		$userid=$this->post('userid');
		if($userid ==''){
		$message = array('status'=>0,'message'=>'User Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		$user_details=$this->Mobile_model->get_all_user_details($userid);
		if(count($user_details)>0){
					$this->session->set_userdata('userdetails',$user_details);
					$message = array('status'=>1,'userdetails'=>$user_details,'profilepath'=>base_url('assets/users/'),'barcodepath'=>base_url('assets/userbarcodes/'),'message'=>'User details are found');
					$this->response($message, REST_Controller::HTTP_OK);
				}else{
					$message = array('status'=>0,'message'=>'User id is wrong. Please  try again once');
					$this->response($message, REST_Controller::HTTP_OK);
				}
	}
	public function user_updateprofile_post()
    {
		$userid = $this->post('userid');
		$name = $this->post('name');
		$email = $this->post('email');
		$mobile = $this->post('mobile');
		$dob = $this->post('dob');
		$gender = $this->post('gender');
		$profilepic = $this->post('profilepic');
		if($userid ==''){
		$message = array('status'=>0,'message'=>'User Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}if($name ==''){
		$message = array('status'=>0,'message'=>'Name is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}if($email ==''){
		$message = array('status'=>0,'message'=>'Email is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}if($mobile ==''){
		$message = array('status'=>0,'message'=>'Mobile is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}if($dob ==''){
		$message = array('status'=>0,'message'=>'Dob is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}if($gender ==''){
		$message = array('status'=>0,'message'=>'Gender is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		$user_details=$this->Mobile_model->get_all_user_details($userid);
		if($user_details['u_email']!=$email){
			$emailcheking =$this->Mobile_model->mobile_checking($email);
			if(count($emailcheking)>0){
				$message = array('status'=>0,'message'=>'Email id already exist. Please use  another Email id');
				$this->response($message, REST_Controller::HTTP_OK);
			}
		}
		if($user_details['u_email']!=$mobile){
			$mobilecheking =$this->Mobile_model->mobile_checking($mobile);
			if(count($mobilecheking)>0){
				$message = array('status'=>0,'message'=>'Mobile number already exist. Please use  another Mobile Number');
				$this->response($message, REST_Controller::HTTP_OK);	
			}
		}
		

	if(isset($profilepic)&& $profilepic!=''){
		$path='F:/xampp/htdocs/cloud/assets/users/';
		//$path=base_url('assets/users/');
		$image_link1 = $profilepic;
			$split_image1 = pathinfo($image_link1);
			$pic = round(microtime(true)).".".$split_image1['extension'];
			copy($profilepic, $path.$pic);
		}else{
			$pic=$user_details['u_profilepic'];
		}
		$update=array(
		'u_name'=>$name,
		'u_email'=>$email,
		'u_mobile'=>$mobile,
		'u_dob'=>$dob,
		'u_gender'=>$gender,
		'u_profilepic'=>$pic,
		'u_update_time'=>date('Y-m-d H:i:s')
		);
		//echo '<pre>';print_r($update);exit;
		$user_details =$this->Mobile_model->update_user_details($userid,$update);
		if(count($user_details)>0){
					$message = array('status'=>1,'userid'=>$userid,'message'=>'User profile successfully updated');
					$this->response($message, REST_Controller::HTTP_OK);
				}else{
					$message = array('status'=>0,'message'=>'Technical problem will occurred .Please try again');
					$this->response($message, REST_Controller::HTTP_OK);
				}
	}
	public function createfolder_post()
    {
		$userid=$this->post('userid');
		$f_name=$this->post('f_name');
		$floder_id=$this->post('floder_id');
		if($userid ==''){
		$message = array('status'=>0,'message'=>'User Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}if($f_name ==''){
		$message = array('status'=>0,'message'=>'Folder Name is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		$folderdata=array(
		'u_id'=>$userid,
		'page_id'=>1,
		'floder_id'=>$floder_id,
		'f_name'=>$f_name,
		'f_status'=>1,
		'f_create_at'=>date('Y-m-d H:i:s'),
		'f_updated_at'=>date('Y-m-d H:i:s'),
		'f_undo'=>0
		);
		//echo '<pre>';print_r($folderdat);exit;
		$folder_details=$this->Mobile_model->save_floders($folderdata);
		if(count($folder_details)>0){
					$message = array('status'=>1,'folder_id'=>$folder_details,'message'=>'Successfully folder created');
					$this->response($message, REST_Controller::HTTP_OK);
				}else{
					$message = array('status'=>0,'message'=>'Technical problem will occurred .Please try again');
					$this->response($message, REST_Controller::HTTP_OK);
				}
	}
	public function folderrename_post(){
		$folder_id=$this->post('folder_id');
		$foldername=$this->post('foldername');
		if($folder_id ==''){
		$message = array('status'=>0,'message'=>'Folder Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		if($foldername ==''){
		$message = array('status'=>0,'message'=>'Folder Name is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		$folderdata=array(
		'f_name'=>$foldername,
		'f_updated_at'=>date('Y-m-d H:i:s')
		);
		$details=$this->Mobile_model->get_folder_details($folder_id);
		if(count($details)>0){
			$folder_rename=$this->Mobile_model->folder_details_update($folder_id,$folderdata);
			if(count($folder_rename)>0){
						$message = array('status'=>1,'folder_id'=>$folder_id,'message'=>'Successfully folder Renamed');
						$this->response($message, REST_Controller::HTTP_OK);
					}else{
						$message = array('status'=>0,'message'=>'Technical problem will occurred .Please try again');
						$this->response($message, REST_Controller::HTTP_OK);
					}
		}else{
			$message = array('status'=>0,'message'=>'Folder Id not available .Please try again');
			$this->response($message, REST_Controller::HTTP_OK);
		}
	}
	
	public function folderfavourite_post(){
		$user_id=$this->post('user_id');
		$folder_id=$this->post('folder_id');
		if($user_id ==''){
		$message = array('status'=>0,'message'=>'User Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}if($folder_id ==''){
		$message = array('status'=>0,'message'=>'Folder Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		
		$folderdata=array(
		'u_id'=>$user_id,
		'f_id'=>$folder_id,
		'yes'=>1,
		'status'=>1,
		'create_at'=>date('Y-m-d H:i:s')
		);
		$check=$this->Mobile_model->check_folderfavorites($user_id,$folder_id);
		if(count($check)>0){
			$details=$this->Mobile_model->remove_folderfavorites($check['id']);
				if(count($details)>0){
							$message = array('status'=>1,'folder_id'=>$folder_id,'message'=>'Folder Successfully removed to Favourite ');
							$this->response($message, REST_Controller::HTTP_OK);
						}else{
							$message = array('status'=>0,'message'=>'Technical problem will occurred .Please try again');
							$this->response($message, REST_Controller::HTTP_OK);
						}
		}else{
			$details=$this->Mobile_model->add_folderfavorites($folderdata);
				if(count($details)>0){
							$message = array('status'=>1,'folder_id'=>$folder_id,'message'=>'Folder Successfully added to Favourite ');
							$this->response($message, REST_Controller::HTTP_OK);
						}else{
							$message = array('status'=>0,'message'=>'Technical problem will occurred .Please try again');
							$this->response($message, REST_Controller::HTTP_OK);
						}
		}
		
	}
	public function folderdelete_post(){
		$folder_id=$this->post('folder_id');
		$type=$this->post('type');
		if($folder_id ==''){
		$message = array('status'=>0,'message'=>'Folder Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}if($type ==''){
		$message = array('status'=>0,'message'=>'Folder Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		$details=$this->Mobile_model->get_folder_details($folder_id);
			if(count($details)>0){
					if($type==1){
						$folder_delete=$this->Mobile_model->delete_folder($folder_id);
							if(count($folder_delete)>0){
										$message = array('status'=>1,'folder_id'=>$folder_id,'message'=>'Folder Successfully removed');
										$this->response($message, REST_Controller::HTTP_OK);
									}else{
										$message = array('status'=>0,'message'=>'Technical problem will occurred .Please try again');
										$this->response($message, REST_Controller::HTTP_OK);
									}
					}else{
						$folderdata=array(
						'f_undo'=>1,
						'f_updated_at'=>date('Y-m-d H:i:s')
						);
						$folder_delete=$this->Mobile_model->folder_details_update($folder_id,$folderdata);
							if(count($folder_delete)>0){
										$message = array('status'=>1,'folder_id'=>$folder_id,'message'=>'Folder moved to trash');
										$this->response($message, REST_Controller::HTTP_OK);
									}else{
										$message = array('status'=>0,'message'=>'Technical problem will occurred .Please try again');
										$this->response($message, REST_Controller::HTTP_OK);
									}
					}
			}else{
				$message = array('status'=>0,'message'=>'Folder Id not available .Please try again');
				$this->response($message, REST_Controller::HTTP_OK);
			}
		
	}
	public function folderrestore_post(){
		$folder_id=$this->post('folder_id');
		$type=$this->post('type');
		if($folder_id ==''){
		$message = array('status'=>0,'message'=>'Folder Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		$details=$this->Mobile_model->get_folder_details($folder_id);
			if(count($details)>0){
					$folderdata=array(
						'f_undo'=>0,
						'f_updated_at'=>date('Y-m-d H:i:s')
						);
						$folder_delete=$this->Mobile_model->folder_details_update($folder_id,$folderdata);
							if(count($folder_delete)>0){
								$message = array('status'=>1,'folder_id'=>$folder_id,'message'=>'Folder is restored');
								$this->response($message, REST_Controller::HTTP_OK);
							}else{
								$message = array('status'=>0,'message'=>'Technical problem will occurred .Please try again');
								$this->response($message, REST_Controller::HTTP_OK);
							}
			}else{
				$message = array('status'=>0,'message'=>'Folder Id not available .Please try again');
				$this->response($message, REST_Controller::HTTP_OK);
			}
		
	}
	public function folderdownload_post(){
		$folder_id=$this->post('folder_id');
		$type=$this->post('type');
		if($folder_id ==''){
		$message = array('status'=>0,'message'=>'Folder Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		$folder_data=$this->Mobile_model->get_folder_data($folder_id);
		$newValues = array();
		foreach($folder_data as $value) 
		{
			$folder_images=$this->Mobile_model->get_all_datainto_zip($value['f_id']);
			if(count($folder_images)>0){
				$this->zip->clear_data();
			foreach($folder_images as $list){
				$zipdata=$this->zip->read_file('assets/files/'.$list->img_name);
			}
			$this->zip->read_file($zipdata, TRUE);
			$this->zip->archive('assets/zip/'.$value['f_id'].'.zip');
			$this->zip->get_zip();
			}
		}
		exit;
		
		foreach($folder_data as $list){
				$zipdata=$this->zip->read_file('assets/files/'.$list->img_name);
			}
			$this->zip->read_file($zipdata, TRUE);
			//$this->zip->download($f_id.'.zip');
			//$this->zip->read_file($zipdata, TRUE);
			$this->zip->archive('assets/zip/'.$folder_id.'.zip');
			$this->zip->get_zip();
			
			/*if(count($details)>0){
					$folderdata=array(
						'f_undo'=>0,
						'f_updated_at'=>date('Y-m-d H:i:s')
						);
						$folder_delete=$this->Mobile_model->folder_details_update($folder_id,$folderdata);
							if(count($folder_delete)>0){
								$message = array('status'=>1,'folder_id'=>$folder_id,'message'=>'Folder is restored');
								$this->response($message, REST_Controller::HTTP_OK);
							}else{
								$message = array('status'=>0,'message'=>'Technical problem will occurred .Please try again');
								$this->response($message, REST_Controller::HTTP_OK);
							}
			}else{
				$message = array('status'=>0,'message'=>'Folder Id not available .Please try again');
				$this->response($message, REST_Controller::HTTP_OK);
			}*/
		
	}

    

}
