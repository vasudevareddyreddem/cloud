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
					$activity=array(
							'u_id'=>$saveduser,
							'file'=>'',
							'folder'=>'',
							'link'=>'',
							'action'=>'Register',
							'create_at'=>date('Y-m-d H:i:s')
							);
					$this->Mobile_model->activity_login($activity);
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
					$activity=array(
							'u_id'=>$check_login['u_id'],
							'file'=>'',
							'folder'=>'',
							'link'=>'',
							'action'=>'Login',
							'create_at'=>date('Y-m-d H:i:s')
							);
					$this->Mobile_model->activity_login($activity);
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
						$activity=array(
							'u_id'=>$userid,
							'file'=>'',
							'folder'=>'',
							'link'=>'',
							'action'=>'Change Password',
							'create_at'=>date('Y-m-d H:i:s')
							);
						$this->Mobile_model->activity_login($activity);
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
			$activity=array(
							'u_id'=>$emailcheking['u_id'],
							'file'=>'',
							'folder'=>'',
							'link'=>'',
							'action'=>'Forgot Password',
							'create_at'=>date('Y-m-d H:i:s')
							);
					$this->Mobile_model->activity_login($activity);
				$data['usedetails']=$emailcheking;
				$this->load->library('email');
				$this->email->set_newline("\r\n");
				$this->email->set_mailtype("html");
				$this->email->from('Cloud.com');
				$this->email->to($email);
				$this->email->subject('shofus - Forgot Password');
				$html = $this->load->view('email/forgetpassword', $data, true); 
				$this->email->message($html);
				if($this->email->send()){
					$message = array('status'=>1,'userid'=>$emailcheking['u_id'],'message'=>'Password sent to your Registered Email Address.');
					$this->response($message, REST_Controller::HTTP_OK);
				}else{
						$message = array('status'=>1,'userid'=>$emailcheking['u_id'],'message'=>'Technical problem will occurred .Please try again');
					$this->response($message, REST_Controller::HTTP_OK);
				}
		}else{
				$message = array('status'=>0,'message'=>'Email id not Registered. Please use another Email Address');
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
					$activity=array(
							'u_id'=>$userid,
							'file'=>'',
							'folder'=>'',
							'link'=>'',
							'action'=>'Update Profile',
							'create_at'=>date('Y-m-d H:i:s')
							);
						$this->Mobile_model->activity_login($activity);
					$message = array('status'=>1,'userid'=>$userid,'message'=>'User profile successfully updated');
					$this->response($message, REST_Controller::HTTP_OK);
				}else{
					$message = array('status'=>0,'message'=>'Technical problem will occurred .Please try again');
					$this->response($message, REST_Controller::HTTP_OK);
				}
	}
	
	/* folder*/
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
					$activity=array(
							'u_id'=>$userid,
							'file'=>'',
							'folder'=>$folder_details,
							'link'=>'',
							'action'=>'Create',
							'create_at'=>date('Y-m-d H:i:s')
							);
							$this->Mobile_model->activity_login($activity);
					$message = array('status'=>1,'folder_id'=>$folder_details,'message'=>'Successfully folder created');
					$this->response($message, REST_Controller::HTTP_OK);
				}else{
					$message = array('status'=>0,'message'=>'Technical problem will occurred .Please try again');
					$this->response($message, REST_Controller::HTTP_OK);
				}
	}
	public function folderrename_post(){
		$user_id=$this->post('user_id');
		$folder_id=$this->post('folder_id');
		$foldername=$this->post('foldername');
		if($user_id ==''){
			$message = array('status'=>0,'message'=>'User Id is required');
			$this->response($message, REST_Controller::HTTP_OK);			
		}
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
							$activity=array(
									'u_id'=>$user_id,
									'file'=>'',
									'folder'=>$folder_id,
									'link'=>'',
									'action'=>'Rename',
									'create_at'=>date('Y-m-d H:i:s')
									);
									$this->Mobile_model->activity_login($activity);
									$open_folder=array(
										'u_id'=>$user_id,
										'f_id'=>$folder_id,
										'r_f_status'=>1,
										'r_f_create_at'=>date('Y-m-d H:i:s'),
										'r_f_updated_at'=>date('Y-m-d H:i:s'),
										);
									$this->Mobile_model->recently_view_data($open_folder);
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
								$activity=array(
									'u_id'=>$user_id,
									'file'=>'',
									'folder'=>$folder_id,
									'link'=>'',
									'action'=>'Favourite',
									'create_at'=>date('Y-m-d H:i:s')
									);
									$this->Mobile_model->activity_login($activity);
									$open_folder=array(
										'u_id'=>$user_id,
										'f_id'=>$folder_id,
										'r_f_status'=>1,
										'r_f_create_at'=>date('Y-m-d H:i:s'),
										'r_f_updated_at'=>date('Y-m-d H:i:s'),
										);
									$this->Mobile_model->recently_view_data($open_folder);
							$message = array('status'=>1,'folder_id'=>$folder_id,'message'=>'Folder Successfully removed to Favourite ');
							$this->response($message, REST_Controller::HTTP_OK);
						}else{
							$message = array('status'=>0,'message'=>'Technical problem will occurred .Please try again');
							$this->response($message, REST_Controller::HTTP_OK);
						}
		}else{
			$details=$this->Mobile_model->add_folderfavorites($folderdata);
				if(count($details)>0){
						$activity=array(
									'u_id'=>$user_id,
									'file'=>'',
									'folder'=>$folder_id,
									'link'=>'',
									'action'=>'Favourite',
									'create_at'=>date('Y-m-d H:i:s')
									);
									$this->Mobile_model->activity_login($activity);
									$open_folder=array(
										'u_id'=>$user_id,
										'f_id'=>$folder_id,
										'r_f_status'=>1,
										'r_f_create_at'=>date('Y-m-d H:i:s'),
										'r_f_updated_at'=>date('Y-m-d H:i:s'),
										);
									$this->Mobile_model->recently_view_data($open_folder);
							$message = array('status'=>1,'folder_id'=>$folder_id,'message'=>'Folder Successfully added to Favourite ');
							$this->response($message, REST_Controller::HTTP_OK);
						}else{
							$message = array('status'=>0,'message'=>'Technical problem will occurred .Please try again');
							$this->response($message, REST_Controller::HTTP_OK);
						}
		}
		
	}
	public function folderdelete_post(){
		$user_id=$this->post('user_id');
		$folder_id=$this->post('folder_id');
		$type=$this->post('type');
		if($user_id ==''){
		$message = array('status'=>0,'message'=>'User Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}if($folder_id ==''){
		$message = array('status'=>0,'message'=>'Folder Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}if($type ==''){
		$message = array('status'=>0,'message'=>'Type is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		$details=$this->Mobile_model->get_folder_details($folder_id);
			if(count($details)>0){
					if($type==1){
								$folder_details = $this->Mobile_model->perment_delete_for_all_data($folder_id);
								if(count($folder_details)>0){
									foreach($folder_details as $m_links){
										$delete_folder_imgs = $this->Mobile_model->permedelte_folder_images_list($m_links['f_id']);
										$this->Mobile_model->permenent_shared_delte_folder($m_links['f_id']);
										foreach($delete_folder_imgs as $list){
											$this->Mobile_model->permenentdelte_image($list['img_id']);
											unlink("assets/files/".$list['img_name']);
										}
										$delete_folder = $this->Mobile_model->permenentdelte_folder($m_links['f_id']);
										$this->Mobile_model->permenent_shared_delte_folder($m_links['f_id']);

									}
								}
								$folder = $this->Mobile_model->permedelte_folder_images_list($folder_id);
								$this->Mobile_model->permenent_shared_delte_folder($folder_id);
								foreach($folder as $list){
											$this->Mobile_model->permenentdelte_image($list['img_id']);
											unlink("assets/files/".$list['img_name']);
										}
								$delete_folder = $this->Mobile_model->permenentdelte_folder($folder_id);
								$this->Mobile_model->permenent_shared_delte_folder($folder_id);
									if(count($delete_folder)>0){
												$activity=array(
												'u_id'=>$user_id,
												'file'=>'',
												'folder'=>$folder_id,
												'link'=>'',
												'action'=>'Delete',
												'create_at'=>date('Y-m-d H:i:s')
												);
												$this->Mobile_model->activity_login($activity);
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
								$activity=array(
									'u_id'=>$user_id,
									'file'=>'',
									'folder'=>$folder_id,
									'link'=>'',
									'action'=>'Delete',
									'create_at'=>date('Y-m-d H:i:s')
									);
									$this->Mobile_model->activity_login($activity);
									$open_folder=array(
										'u_id'=>$user_id,
										'f_id'=>$folder_id,
										'r_f_status'=>1,
										'r_f_create_at'=>date('Y-m-d H:i:s'),
										'r_f_updated_at'=>date('Y-m-d H:i:s'),
										);
									$this->Mobile_model->recently_view_data($open_folder);
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
		$user_id=$this->post('user_id');
		$folder_id=$this->post('folder_id');
		$type=$this->post('type');
		if($user_id ==''){
		$message = array('status'=>0,'message'=>'User Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}if($folder_id ==''){
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
								$activity=array(
									'u_id'=>$user_id,
									'file'=>'',
									'folder'=>$folder_id,
									'link'=>'',
									'action'=>'Restore',
									'create_at'=>date('Y-m-d H:i:s')
									);
									$this->Mobile_model->activity_login($activity);
									$open_folder=array(
										'u_id'=>$user_id,
										'f_id'=>$folder_id,
										'r_f_status'=>1,
										'r_f_create_at'=>date('Y-m-d H:i:s'),
										'r_f_updated_at'=>date('Y-m-d H:i:s'),
										);
									$this->Mobile_model->recently_view_data($open_folder);
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
	public function foldermovig_list_post(){
		$userid=$this->post('userid');
		$folder_id=$this->post('folderid');
		if($userid ==''){
		$message = array('status'=>0,'message'=>'User Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}if($folder_id ==''){
		$message = array('status'=>0,'message'=>'Folder Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		$details=$this->Mobile_model->get_folder_details($folder_id);
			if(count($details)>0){
				$folder_list=$this->Mobile_model->get_floder_movingname_list($userid,$folder_id);
							if(count($folder_list)>0){
								$message = array('status'=>1,'folderlist'=>$folder_list,'message'=>'Folder list are found');
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
	public function foldermove_post(){
		$user_id=$this->post('userid');
		$folder_id=$this->post('folderid');
		$movefolderid=$this->post('movefolderid');
		if($user_id ==''){
		$message = array('status'=>0,'message'=>'User Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		if($folder_id ==''){
		$message = array('status'=>0,'message'=>'Folder Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		if($movefolderid ==''){
		$message = array('status'=>0,'message'=>'Moving Folder Id ');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		$details=$this->Mobile_model->get_folder_details($folder_id);
			if(count($details)>0){
				$check_shared=$this->Mobile_model->get_user_folder_details($user_id,$folder_id);
					if(count($check_shared)>=0){
							$folderdata=array(
								'floder_id'=>$movefolderid,
								'f_updated_at'=>date('Y-m-d H:i:s')
								);
							$folder_moving=$this->Mobile_model->folder_details_update($folder_id,$folderdata);
							if(count($folder_moving)>0){
									$activity=array(
									'u_id'=>$user_id,
									'file'=>'',
									'folder'=>$folder_id,
									'link'=>'',
									'action'=>'Move',
									'create_at'=>date('Y-m-d H:i:s')
									);
									$this->Mobile_model->activity_login($activity);
									$open_folder=array(
										'u_id'=>$user_id,
										'f_id'=>$folder_id,
										'r_f_status'=>1,
										'r_f_create_at'=>date('Y-m-d H:i:s'),
										'r_f_updated_at'=>date('Y-m-d H:i:s'),
										);
									$this->Mobile_model->recently_view_data($open_folder);
										$message = array('status'=>1,'folder_id'=>$folder_id,'message'=>'Folder is successfully moved');
										$this->response($message, REST_Controller::HTTP_OK);
									}else{
										$message = array('status'=>0,'message'=>'Technical problem will occurred .Please try again');
										$this->response($message, REST_Controller::HTTP_OK);
									}

					}else{
						$message = array('status'=>0,'message'=>'Folder already shared. Please try another folder');
						$this->response($message, REST_Controller::HTTP_OK);
					}								
			}else{
				$message = array('status'=>0,'message'=>'Folder Id not available .Please try again');
				$this->response($message, REST_Controller::HTTP_OK);
			}			
		
	}
	public function foldershare_post(){
		$folder_id=$this->post('folder_id');
		$user_id=$this->post('user_id');
		$shareduser_id=$this->post('shareduser_id');
		$permission=$this->post('permission');
		$email=$this->post('shared_email');
		if($folder_id ==''){
		$message = array('status'=>0,'message'=>'Folder Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}if($user_id ==''){
		$message = array('status'=>0,'message'=>'User Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		if($shareduser_id =='' && $email ==''){
		$message = array('status'=>0,'message'=>'Shared user Id  or Email Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		if($permission ==''){
		$message = array('status'=>0,'message'=>'permissions Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		$details=$this->Mobile_model->get_folder_details($folder_id);
			if(count($details)>0){
				if($shareduser_id!=''){
					$already_shared=$this->Mobile_model->get_shared_folder_details($shareduser_id,$folder_id);
				}else{
					$already_shared=$this->Mobile_model->get_shared_folder_details($shareduser_id,$email);
				}
					if(count($already_shared)==0){
						$folderdata=array(
							'u_id'=>isset($shareduser_id)?$shareduser_id:'',
							'u_email'=>isset($email)?$email:'',
							'f_id'=>$folder_id,
							's_permission'=>$permission,
							's_status'=>1,
							's_created'=>date('Y-m-d H:i:s'),
							'file_created_id'=>$user_id
							);
							$shared_data=$this->Mobile_model->folder_share($folderdata);
								if(count($shared_data)>0){
									$activity=array(
									'u_id'=>$user_id,
									'file'=>'',
									'folder'=>$folder_id,
									'link'=>'',
									'action'=>'Share',
									'create_at'=>date('Y-m-d H:i:s')
									);
									$this->Mobile_model->activity_login($activity);
									$open_folder=array(
										'u_id'=>$user_id,
										'f_id'=>$folder_id,
										'r_f_status'=>1,
										'r_f_create_at'=>date('Y-m-d H:i:s'),
										'r_f_updated_at'=>date('Y-m-d H:i:s'),
										);
									$this->Mobile_model->recently_view_data($open_folder);
									$message = array('status'=>1,'folder_id'=>$folder_id,'message'=>'Folder is successfully shared');
									$this->response($message, REST_Controller::HTTP_OK);
								}else{
									$message = array('status'=>0,'message'=>'Technical problem will occurred .Please try again');
									$this->response($message, REST_Controller::HTTP_OK);
								}

					}else{
						$message = array('status'=>0,'message'=>'Folder already shared. Please try another folder');
						$this->response($message, REST_Controller::HTTP_OK);
					}								
			}else{
				$message = array('status'=>0,'message'=>'Folder Id not available .Please try again');
				$this->response($message, REST_Controller::HTTP_OK);
			}			
		
	}
	public function users_list_post(){
		$search_value=$this->post('search_value');
		//echo strlen($search_value);exit;
		if(strlen($search_value)<3){
		$message = array('status'=>0,'message'=>'Search key length is greater than 3 letters');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		$user_list=$this->Mobile_model->get_user_list($search_value);
			if(count($user_list)>0){
				$message = array('status'=>1,'users_list'=>$user_list,'message'=>'Users list are found');
				$this->response($message, REST_Controller::HTTP_OK);
			}else{
				$message = array('status'=>0,'message'=>'Technical problem will occurred .Please try again');
				$this->response($message, REST_Controller::HTTP_OK);
			}
	}	
	public function folderdata_post(){
		$folderid=$this->post('folderid');
		if($folderid==''){
		$message = array('status'=>0,'message'=>'Folder Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		$details=$this->Mobile_model->get_folder_details($folderid);
			if(count($details)>0){
					$folder_details=$this->Mobile_model->get_all_folder_details($folderid);
					if(count($folder_details)>0){
							$file_details=$this->Mobile_model->get_all_file_details($folderid);
							$message = array('status'=>1,'folder_details'=>$folder_details,'file_details'=>$file_details,'filepath'=>base_url('assets/files/'),'message'=>'Folder Details are found');
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
	
	/*folder*/
	
	/* file download*/
	public function filerename_post(){
		$user_id=$this->post('user_id');
		$file_id=$this->post('file_id');
		$filename=$this->post('filename');
		if($user_id ==''){
		$message = array('status'=>0,'message'=>'User Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}if($file_id ==''){
		$message = array('status'=>0,'message'=>'File Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		if($filename ==''){
		$message = array('status'=>0,'message'=>'File Name is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		$filedata=array(
		'imag_org_name'=>$filename,
		'f_update_at'=>date('Y-m-d H:i:s')
		);
		$details=$this->Mobile_model->get_file_details($file_id);
		if(count($details)>0){
			$folder_rename=$this->Mobile_model->file_details_update($file_id,$filedata);
			if(count($folder_rename)>0){
							$activity=array(
									'u_id'=>$user_id,
									'file'=>$file_id,
									'folder'=>'',
									'link'=>'',
									'action'=>'Rename',
									'create_at'=>date('Y-m-d H:i:s')
									);
									$this->Mobile_model->activity_login($activity);
									
						$message = array('status'=>1,'file_id'=>$file_id,'message'=>'Successfully file Renamed');
						$this->response($message, REST_Controller::HTTP_OK);
					}else{
						$message = array('status'=>0,'message'=>'Technical problem will occurred .Please try again');
						$this->response($message, REST_Controller::HTTP_OK);
					}
		}else{
			$message = array('status'=>0,'message'=>'File not available .Please try again');
			$this->response($message, REST_Controller::HTTP_OK);
		}
	}
	public function filefavourite_post(){
		$user_id=$this->post('user_id');
		$file_id=$this->post('file_id');
		if($user_id ==''){
		$message = array('status'=>0,'message'=>'User Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}if($file_id ==''){
		$message = array('status'=>0,'message'=>'File Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		
		$filedata=array(
		'u_id'=>$user_id,
		'file_id'=>$file_id,
		'yes'=>1,
		'status'=>1,
		'create_at'=>date('Y-m-d H:i:s')
		);
		$check=$this->Mobile_model->check_filefavorites($user_id,$file_id);
		if(count($check)>0){
			$details=$this->Mobile_model->remove_filefavorites($check['id']);
				if(count($details)>0){
								$activity=array(
									'u_id'=>$user_id,
									'file'=>$file_id,
									'folder'=>'',
									'link'=>'',
									'action'=>'Favourite',
									'create_at'=>date('Y-m-d H:i:s')
									);
									$this->Mobile_model->activity_login($activity);
									$recentlyopen=array(
									'u_id'=>$user_id,
									'file_id'=>$file_id,
									'r_file_status'=>1,
									'r_file_create_at'=>date('Y-m-d H:i:s'),
									'r_file_updated_at'=>date('Y-m-d H:i:s'),
									);
									$this->Mobile_model->save_recently_file_open($recentlyopen);
							$message = array('status'=>1,'file_id'=>$file_id,'message'=>'File Successfully removed to Favourite ');
							$this->response($message, REST_Controller::HTTP_OK);
						}else{
							$message = array('status'=>0,'message'=>'Technical problem will occurred .Please try again');
							$this->response($message, REST_Controller::HTTP_OK);
						}
		}else{
			$details=$this->Mobile_model->add_filefavorites($filedata);
				if(count($details)>0){
						$activity=array(
									'u_id'=>$user_id,
									'file'=>$file_id,
									'folder'=>'',
									'link'=>'',
									'action'=>'Favourite',
									'create_at'=>date('Y-m-d H:i:s')
									);
									$this->Mobile_model->activity_login($activity);
									$recentlyopen=array(
									'u_id'=>$user_id,
									'file_id'=>$file_id,
									'r_file_status'=>1,
									'r_file_create_at'=>date('Y-m-d H:i:s'),
									'r_file_updated_at'=>date('Y-m-d H:i:s'),
									);
									$this->Mobile_model->save_recently_file_open($recentlyopen);
							$message = array('status'=>1,'file_id'=>$file_id,'message'=>'File Successfully added to Favourite ');
							$this->response($message, REST_Controller::HTTP_OK);
						}else{
							$message = array('status'=>0,'message'=>'Technical problem will occurred .Please try again');
							$this->response($message, REST_Controller::HTTP_OK);
						}
		}
		
	}
	public function filedelete_post(){
		$user_id=$this->post('user_id');
		$file_id=$this->post('file_id');
		$type=$this->post('type');
		if($user_id ==''){
		$message = array('status'=>0,'message'=>'User Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}if($file_id ==''){
		$message = array('status'=>0,'message'=>'File Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}if($type ==''){
		$message = array('status'=>0,'message'=>'Type is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		$details=$this->Mobile_model->get_file_details($file_id);
		//echo '<pre>';print_r($details);exit;
			if(count($details)>0){
					if($type==1){
						unlink("assets/files/".$details['img_name']);
						$file_delete=$this->Mobile_model->delete_file($file_id);
							if(count($file_delete)>0){
								$activity=array(
									'u_id'=>$user_id,
									'file'=>$file_id,
									'folder'=>'',
									'link'=>'',
									'action'=>'Delete',
									'create_at'=>date('Y-m-d H:i:s')
									);
									$this->Mobile_model->activity_login($activity);
										$message = array('status'=>1,'file_id'=>$file_id,'message'=>'File Successfully removed');
										$this->response($message, REST_Controller::HTTP_OK);
									}else{
										$message = array('status'=>0,'message'=>'Technical problem will occurred .Please try again');
										$this->response($message, REST_Controller::HTTP_OK);
									}
					}else{
						$filedata=array(
						'img_undo'=>1,
						'f_update_at'=>date('Y-m-d H:i:s')
						);
						$file_delete=$this->Mobile_model->file_details_update($file_id,$filedata);
							if(count($file_delete)>0){
								$activity=array(
									'u_id'=>$user_id,
									'file'=>$file_id,
									'folder'=>'',
									'link'=>'',
									'action'=>'Delete',
									'create_at'=>date('Y-m-d H:i:s')
									);
									$this->Mobile_model->activity_login($activity);
									$recentlyopen=array(
									'u_id'=>$user_id,
									'file_id'=>$file_id,
									'r_file_status'=>1,
									'r_file_create_at'=>date('Y-m-d H:i:s'),
									'r_file_updated_at'=>date('Y-m-d H:i:s'),
									);
									$this->Mobile_model->save_recently_file_open($recentlyopen);
										$message = array('status'=>1,'file_id'=>$file_id,'message'=>'File moved to trash');
										$this->response($message, REST_Controller::HTTP_OK);
									}else{
										$message = array('status'=>0,'message'=>'Technical problem will occurred .Please try again');
										$this->response($message, REST_Controller::HTTP_OK);
									}
					}
			}else{
				$message = array('status'=>0,'message'=>'File  not available .Please try again');
				$this->response($message, REST_Controller::HTTP_OK);
			}
		
	}
	public function filerestore_post(){
		$user_id=$this->post('user_id');
		$file_id=$this->post('file_id');
		if($user_id ==''){
		$message = array('status'=>0,'message'=>'User Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}if($file_id ==''){
		$message = array('status'=>0,'message'=>'File Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		$details=$this->Mobile_model->get_file_details($file_id);
		//echo '<pre>';print_r($details);exit;
			if(count($details)>0){
					$filedata=array(
						'img_undo'=>0,
						'f_update_at'=>date('Y-m-d H:i:s')
						);
						$file_delete=$this->Mobile_model->file_details_update($file_id,$filedata);
							if(count($file_delete)>0){
							$activity=array(
							'u_id'=>$user_id,
							'file'=>$file_id,
							'folder'=>'',
							'link'=>'',
							'action'=>'Restore',
							'create_at'=>date('Y-m-d H:i:s')
							);
					$this->Mobile_model->activity_login($activity);
					$recentlyopen=array(
									'u_id'=>$user_id,
									'file_id'=>$file_id,
									'r_file_status'=>1,
									'r_file_create_at'=>date('Y-m-d H:i:s'),
									'r_file_updated_at'=>date('Y-m-d H:i:s'),
									);
									$this->Mobile_model->save_recently_file_open($recentlyopen);
										$message = array('status'=>1,'file_id'=>$file_id,'message'=>'File restored');
										$this->response($message, REST_Controller::HTTP_OK);
									}else{
										$message = array('status'=>0,'message'=>'Technical problem will occurred .Please try again');
										$this->response($message, REST_Controller::HTTP_OK);
									}
					
			}else{
				$message = array('status'=>0,'message'=>'File  not available .Please try again');
				$this->response($message, REST_Controller::HTTP_OK);
			}
		
	}
	public function filedownload_post(){
		$user_id=$this->post('user_id');
		$file_id=$this->post('file_id');
		if($user_id ==''){
		$message = array('status'=>0,'message'=>'User Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}if($file_id ==''){
		$message = array('status'=>0,'message'=>'File Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		$details=$this->Mobile_model->get_file_details($file_id);
		//echo '<pre>';print_r($details);exit;
			if(count($details)>0){
					$activity=array(
						'u_id'=>$user_id,
						'file'=>$file_id,
						'folder'=>'',
						'link'=>'',
						'action'=>'Download',
						'create_at'=>date('Y-m-d H:i:s')
						);
					$this->Mobile_model->activity_login($activity);
					$recentlyopen=array(
									'u_id'=>$user_id,
									'file_id'=>$file_id,
									'r_file_status'=>1,
									'r_file_create_at'=>date('Y-m-d H:i:s'),
									'r_file_updated_at'=>date('Y-m-d H:i:s'),
									);
									$this->Mobile_model->save_recently_file_open($recentlyopen);
				$message = array('status'=>1,'file'=>base_url('assets/files/'.$details['img_name']),'message'=>'File successfully download');
				$this->response($message, REST_Controller::HTTP_OK);
			}else{
				$message = array('status'=>0,'message'=>'File  not available .Please try again');
				$this->response($message, REST_Controller::HTTP_OK);
			}
		
	}
	public function fileshare_post(){
		$file_id=$this->post('file_id');
		$user_id=$this->post('user_id');
		$shareduser_id=$this->post('shareduser_id');
		$permission=$this->post('permission');
		$email=$this->post('shared_email');
		if($file_id ==''){
		$message = array('status'=>0,'message'=>'File Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}if($user_id ==''){
		$message = array('status'=>0,'message'=>'User Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		if($shareduser_id =='' && $email ==''){
		$message = array('status'=>0,'message'=>'Shared user Id  or Email Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		if($permission ==''){
		$message = array('status'=>0,'message'=>'permissions Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		$details=$this->Mobile_model->get_file_details($file_id);
			if(count($details)>0){
				if($shareduser_id!=''){
					$already_shared=$this->Mobile_model->get_shared_file_details($shareduser_id,$file_id);
				}else{
					$already_shared=$this->Mobile_model->get_shared_file_details($shareduser_id,$email);
				}
					if(count($already_shared)==0){
						$filedata=array(
							'u_id'=>isset($shareduser_id)?$shareduser_id:'',
							'u_email'=>isset($email)?$email:'',
							'img_id'=>$file_id,
							's_permission'=>$permission,
							's_status'=>1,
							's_created'=>date('Y-m-d H:i:s'),
							'file_created_id'=>$user_id
							);
							$shared_data=$this->Mobile_model->file_share($filedata);
								if(count($shared_data)>0){
									$activity=array(
										'u_id'=>$user_id,
										'file'=>$file_id,
										'folder'=>'',
										'link'=>'',
										'action'=>'Share',
										'create_at'=>date('Y-m-d H:i:s')
										);
									$this->Mobile_model->activity_login($activity);
									$recentlyopen=array(
									'u_id'=>$user_id,
									'file_id'=>$file_id,
									'r_file_status'=>1,
									'r_file_create_at'=>date('Y-m-d H:i:s'),
									'r_file_updated_at'=>date('Y-m-d H:i:s'),
									);
									$this->Mobile_model->save_recently_file_open($recentlyopen);
									$message = array('status'=>1,'file_id'=>$file_id,'message'=>'File is successfully shared');
									$this->response($message, REST_Controller::HTTP_OK);
								}else{
									$message = array('status'=>0,'message'=>'Technical problem will occurred .Please try again');
									$this->response($message, REST_Controller::HTTP_OK);
								}

					}else{
						$message = array('status'=>0,'message'=>'File already shared. Please try another file');
						$this->response($message, REST_Controller::HTTP_OK);
					}								
			}else{
				$message = array('status'=>0,'message'=>'File not available .Please try again');
				$this->response($message, REST_Controller::HTTP_OK);
			}
	}
	public function folder_list_post(){
		$user_id=$this->post('user_id');
		if($user_id==''){
		$message = array('status'=>0,'message'=>'User Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		$check_user=$this->Mobile_model->get_user_details($user_id);
		if(count($check_user)>0){
		$folder_list=$this->Mobile_model->get_folder_list($user_id);
			if(count($folder_list)>0){
				$message = array('status'=>1,'folder_list'=>$folder_list,'message'=>'Folder list are found');
				$this->response($message, REST_Controller::HTTP_OK);
			}else{
				$message = array('status'=>0,'message'=>'Technical problem will occurred .Please try again');
				$this->response($message, REST_Controller::HTTP_OK);
			}
		}else{
				$message = array('status'=>0,'message'=>'User not available .Please try again');
				$this->response($message, REST_Controller::HTTP_OK);
			}
	}
	public function file_move_post(){
		$user_id=$this->post('user_id');
		$page_id=$this->post('page_id');
		$floder_id=$this->post('floder_id');
		$file_id=$this->post('file_id');
		if($user_id==''){
		$message = array('status'=>0,'message'=>'User Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		if($page_id ==''){
		$message = array('status'=>0,'message'=>'Page Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		if($floder_id ==''){
		$message = array('status'=>0,'message'=>'Folder is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		if($file_id ==''){
		$message = array('status'=>0,'message'=>'File is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		$details=$this->Mobile_model->get_folder_details($floder_id);
			if($details['u_id']== $user_id){
				$movedata=array(
								'u_id'=>$user_id,
								'page_id'=>$page_id,
								'floder_id'=>$floder_id,
								'f_update_at'=>date('Y-m-d H:i:s'),				
								);
							$file_moveing=$this->Mobile_model->file_details_update($file_id,$movedata);
								if(count($file_moveing)>0){
									$activity=array(
										'u_id'=>$user_id,
										'file'=>$file_id,
										'folder'=>'',
										'link'=>'',
										'action'=>'Move',
										'create_at'=>date('Y-m-d H:i:s')
										);
									$this->Mobile_model->activity_login($activity);
									$recentlyopen=array(
									'u_id'=>$user_id,
									'file_id'=>$file_id,
									'r_file_status'=>1,
									'r_file_create_at'=>date('Y-m-d H:i:s'),
									'r_file_updated_at'=>date('Y-m-d H:i:s'),
									);
									$this->Mobile_model->save_recently_file_open($recentlyopen);
									$message = array('status'=>1,'file_id'=>$file_id,'message'=>'File is successfully Moved');
									$this->response($message, REST_Controller::HTTP_OK);
								}else{
									$message = array('status'=>0,'message'=>'Technical problem will occurred .Please try again');
									$this->response($message, REST_Controller::HTTP_OK);
								}
							
			}else{
				$message = array('status'=>0,'message'=>'You have no permissions to access this folder .Please try again');
				$this->response($message, REST_Controller::HTTP_OK);
			}
	}
	/* file download*/
	/* link**/
	public function createlink_post()
    {
		$user_id=$this->post('user_id');
		$linkname=$this->post('linkname');
		if($user_id ==''){
			$message = array('status'=>0,'message'=>'User Id is required');
			$this->response($message, REST_Controller::HTTP_OK);			
		}if($linkname ==''){
			$message = array('status'=>0,'message'=>'Link Name is required');
			$this->response($message, REST_Controller::HTTP_OK);			
		}
		$linkdata=array(
		'u_id'=>$user_id,
		'l_name'=>$linkname,
		'l_status'=>1,
		'l_created_at'=>date('Y-m-d H:i:s'),
		'l_updated_at'=>date('Y-m-d H:i:s'),
		'l_undo'=>0
		);
		//echo '<pre>';print_r($folderdat);exit;
		$link_details=$this->Mobile_model->save_links($linkdata);
		if(count($link_details)>0){
						$activity=array(
							'u_id'=>$user_id,
							'file'=>'',
							'folder'=>'',
							'link'=>$link_details,
							'action'=>'Create',
							'create_at'=>date('Y-m-d H:i:s')
							);
						$this->Mobile_model->activity_login($activity);
					$message = array('status'=>1,'link_id'=>$link_details,'message'=>'Successfully link created');
					$this->response($message, REST_Controller::HTTP_OK);
				}else{
					$message = array('status'=>0,'message'=>'Technical problem will occurred .Please try again');
					$this->response($message, REST_Controller::HTTP_OK);
				}
	}
	public function linkfavourite_post(){
		$user_id=$this->post('user_id');
		$linkid=$this->post('linkid');
		if($user_id ==''){
		$message = array('status'=>0,'message'=>'User Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}if($linkid ==''){
		$message = array('status'=>0,'message'=>'Link Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		
		$filedata=array(
		'u_id'=>$user_id,
		'file_id'=>$linkid,
		'yes'=>1,
		'status'=>1,
		'create_at'=>date('Y-m-d H:i:s')
		);
		$check=$this->Mobile_model->check_linkfavorites($user_id,$linkid);
		if(count($check)>0){
			$details=$this->Mobile_model->remove_linkfavorites($check['id']);
				if(count($details)>0){
					$activity=array(
							'u_id'=>$user_id,
							'file'=>'',
							'folder'=>'',
							'link'=>$linkid,
							'action'=>'Favourite',
							'create_at'=>date('Y-m-d H:i:s')
							);
						$this->Mobile_model->activity_login($activity);
							$message = array('status'=>1,'linkid'=>$linkid,'message'=>'Link Successfully removed to Favourite ');
							$this->response($message, REST_Controller::HTTP_OK);
						}else{
							$message = array('status'=>0,'message'=>'Technical problem will occurred .Please try again');
							$this->response($message, REST_Controller::HTTP_OK);
						}
		}else{
			$details=$this->Mobile_model->add_linkfavorites($filedata);
				if(count($details)>0){
							$activity=array(
								'u_id'=>$user_id,
								'file'=>'',
								'folder'=>'',
								'link'=>$linkid,
								'action'=>'Favourite',
								'create_at'=>date('Y-m-d H:i:s')
								);
							$this->Mobile_model->activity_login($activity);
							$message = array('status'=>1,'linkid'=>$linkid,'message'=>'Link Successfully added to Favourite ');
							$this->response($message, REST_Controller::HTTP_OK);
						}else{
							$message = array('status'=>0,'message'=>'Technical problem will occurred .Please try again');
							$this->response($message, REST_Controller::HTTP_OK);
						}
		}
		
	}
	public function linkrename_post(){
		$user_id=$this->post('user_id');
		$linkid=$this->post('linkid');
		$linkename=$this->post('linkename');
		if($user_id ==''){
		$message = array('status'=>0,'message'=>'user Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}if($linkid ==''){
		$message = array('status'=>0,'message'=>'Link Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		if($linkename ==''){
		$message = array('status'=>0,'message'=>'Link Name is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		$linkdata=array(
		'l_name'=>$linkename,
		'l_updated_at'=>date('Y-m-d H:i:s')
		);
		$details=$this->Mobile_model->get_link_details($linkid);
		if(count($details)>0){
			$link_rename=$this->Mobile_model->link_details_update($linkid,$linkdata);
			if(count($link_rename)>0){
						$activity=array(
							'u_id'=>$user_id,
							'file'=>'',
							'folder'=>'',
							'link'=>$linkid,
							'action'=>'Rename',
							'create_at'=>date('Y-m-d H:i:s')
							);
						$this->Mobile_model->activity_login($activity);
						$message = array('status'=>1,'linkid'=>$linkid,'message'=>'Successfully link Renamed');
						$this->response($message, REST_Controller::HTTP_OK);
					}else{
						$message = array('status'=>0,'message'=>'Technical problem will occurred .Please try again');
						$this->response($message, REST_Controller::HTTP_OK);
					}
		}else{
			$message = array('status'=>0,'message'=>'Link not available .Please try again');
			$this->response($message, REST_Controller::HTTP_OK);
		}
	}
	public function linkdelete_post(){
		$user_id=$this->post('user_id');
		$linkid=$this->post('linkid');
		$type=$this->post('type');
		if($user_id ==''){
		$message = array('status'=>0,'message'=>'User Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}if($linkid ==''){
		$message = array('status'=>0,'message'=>'Link Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}if($type ==''){
		$message = array('status'=>0,'message'=>'Type is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		$details=$this->Mobile_model->get_link_details($linkid);
		//echo '<pre>';print_r($details);exit;
			if(count($details)>0){
					if($type==1){
						$link_delete=$this->Mobile_model->delete_link($linkid);
							if(count($link_delete)>0){
										$message = array('status'=>1,'linkid'=>$linkid,'message'=>'Link Successfully removed');
										$this->response($message, REST_Controller::HTTP_OK);
									}else{
										$message = array('status'=>0,'message'=>'Technical problem will occurred .Please try again');
										$this->response($message, REST_Controller::HTTP_OK);
									}
					}else{
						$linkdata=array(
							'l_undo'=>1,
							'l_updated_at'=>date('Y-m-d H:i:s')
							);
						$link_rename=$this->Mobile_model->link_details_update($linkid,$linkdata);
							if(count($link_rename)>0){
								$activity=array(
											'u_id'=>$user_id,
											'file'=>'',
											'folder'=>'',
											'link'=>$linkid,
											'action'=>'Delete',
											'create_at'=>date('Y-m-d H:i:s')
											);
										$this->Mobile_model->activity_login($activity);
										$message = array('status'=>1,'linkid'=>$linkid,'message'=>'Link moved to trash');
										$this->response($message, REST_Controller::HTTP_OK);
									}else{
										$message = array('status'=>0,'message'=>'Technical problem will occurred .Please try again');
										$this->response($message, REST_Controller::HTTP_OK);
									}
					}
			}else{
				$message = array('status'=>0,'message'=>'Link not available .Please try again');
				$this->response($message, REST_Controller::HTTP_OK);
			}
		
	}
	public function linkshare_post(){
		$linkid=$this->post('linkid');
		$user_id=$this->post('user_id');
		$shareduser_id=$this->post('shareduser_id');
		$permission=$this->post('permission');
		$email=$this->post('shared_email');
		if($linkid ==''){
		$message = array('status'=>0,'message'=>'Link Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}if($user_id ==''){
		$message = array('status'=>0,'message'=>'User Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		if($shareduser_id =='' && $email ==''){
		$message = array('status'=>0,'message'=>'Shared user Id  or Email Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		if($permission ==''){
		$message = array('status'=>0,'message'=>'permissions Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
			$details=$this->Mobile_model->get_link_details($linkid);
			if(count($details)>0){
				if($shareduser_id!=''){
					$already_shared=$this->Mobile_model->get_shared_link_details($shareduser_id,$linkid);
				}else{
					$already_shared=$this->Mobile_model->get_shared_link_details($shareduser_id,$email);
				}
					if(count($already_shared)==0){
						$linkdata=array(
							'u_id'=>isset($shareduser_id)?$shareduser_id:'',
							'u_email'=>isset($email)?$email:'',
							'link_id'=>$linkid,
							's_permission'=>$permission,
							's_status'=>1,
							's_created'=>date('Y-m-d H:i:s'),
							'file_created_id'=>$user_id
							);
							$shared_data=$this->Mobile_model->link_share($linkdata);
								if(count($shared_data)>0){
									$activity=array(
											'u_id'=>$user_id,
											'file'=>'',
											'folder'=>'',
											'link'=>$linkid,
											'action'=>'Share',
											'create_at'=>date('Y-m-d H:i:s')
											);
										$this->Mobile_model->activity_login($activity);
									$message = array('status'=>1,'linkid'=>$linkid,'message'=>'Link is successfully shared');
									$this->response($message, REST_Controller::HTTP_OK);
								}else{
									$message = array('status'=>0,'message'=>'Technical problem will occurred .Please try again');
									$this->response($message, REST_Controller::HTTP_OK);
								}

					}else{
						$message = array('status'=>0,'message'=>'Link already shared. Please try another Link');
						$this->response($message, REST_Controller::HTTP_OK);
					}								
			}else{
				$message = array('status'=>0,'message'=>'Link not available .Please try again');
				$this->response($message, REST_Controller::HTTP_OK);
			}
	}
	public function linkrestore_post(){
		$user_id=$this->post('user_id');
		$linkid=$this->post('linkid');
		if($user_id ==''){
		$message = array('status'=>0,'message'=>'User Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}if($linkid ==''){
		$message = array('status'=>0,'message'=>'Link Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		$details=$this->Mobile_model->get_link_details($linkid);
		//echo '<pre>';print_r($details);exit;
			if(count($details)>0){
					$linkdata=array(
							'l_undo'=>0,
							'l_updated_at'=>date('Y-m-d H:i:s')
							);
						$link_rename=$this->Mobile_model->link_details_update($linkid,$linkdata);
							if(count($link_rename)>0){
								$activity=array(
											'u_id'=>$user_id,
											'file'=>'',
											'folder'=>'',
											'link'=>$linkid,
											'action'=>'Restore',
											'create_at'=>date('Y-m-d H:i:s')
											);
										$this->Mobile_model->activity_login($activity);
										$message = array('status'=>1,'linkid'=>$linkid,'message'=>'Link Restored');
										$this->response($message, REST_Controller::HTTP_OK);
									}else{
										$message = array('status'=>0,'message'=>'Technical problem will occurred .Please try again');
										$this->response($message, REST_Controller::HTTP_OK);
									}
				
			}else{
				$message = array('status'=>0,'message'=>'Link not available .Please try again');
				$this->response($message, REST_Controller::HTTP_OK);
			}
		
	}
	
	/* link**/
	/*linktab*/
	public function linkstab_post(){
		$userid=$this->post('userid');
		if($userid==''){
		$message = array('status'=>0,'message'=>'User Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		$check_user=$this->Mobile_model->get_user_details($userid);
		if(count($check_user)>0){
			$link_list=$this->Mobile_model->get_link_list($userid);
			if(count($link_list)>0){
				$message = array('status'=>1,'link_list'=>$link_list,'message'=>'links list are found');
				$this->response($message, REST_Controller::HTTP_OK);
			}else{
				$message = array('status'=>0,'message'=>'links list are not found');
				$this->response($message, REST_Controller::HTTP_OK);
			}
		}else{
				$message = array('status'=>0,'message'=>'User not available .Please try again');
				$this->response($message, REST_Controller::HTTP_OK);
			}
	}
	/*linktab*/
	/*recyclebintab*/
		public function recyclebintab_post(){
		$userid=$this->post('userid');
		if($userid==''){
		$message = array('status'=>0,'message'=>'User Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		$check_user=$this->Mobile_model->get_user_details($userid);
		if(count($check_user)>0){
			$folder_list=$this->Mobile_model->get_undofolder_list($userid);
			$file_list=$this->Mobile_model->get_undofile_list($userid);
			$link_list=$this->Mobile_model->get_undolink_list($userid);
			if(count($folder_list)>0 || count($file_list)>0 || count($link_list)>0){
				$message = array('status'=>1,'folder_list'=>$folder_list,'file_list'=>$file_list,'link_list'=>$link_list,'filepath'=>base_url('assets/files/'),'message'=>'Recycle bin data are found');
				$this->response($message, REST_Controller::HTTP_OK);
			}else{
				$message = array('status'=>0,'message'=>'Recycle bin data are not found');
				$this->response($message, REST_Controller::HTTP_OK);
			}
		}else{
				$message = array('status'=>0,'message'=>'User not available .Please try again');
				$this->response($message, REST_Controller::HTTP_OK);
			}
	}
	/*recyclebintab*/
	/*sharedtab*/
		public function sharedtab_post(){
		$userid=$this->post('userid');
		if($userid==''){
		$message = array('status'=>0,'message'=>'User Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		$check_user=$this->Mobile_model->get_user_details($userid);
		if(count($check_user)>0){
			$folder_list=$this->Mobile_model->get_sharedfolder_list($userid);
			$file_list=$this->Mobile_model->get_shredfile_list($userid);
			$link_list=$this->Mobile_model->get_sharedlink_list($userid);
			if(count($folder_list)>0 || count($file_list)>0 || count($link_list)>0){
				$message = array('status'=>1,'folder_list'=>$folder_list,'file_list'=>$file_list,'link_list'=>$link_list,'filepath'=>base_url('assets/files/'),'message'=>'Shared data are found');
				$this->response($message, REST_Controller::HTTP_OK);
			}else{
				$message = array('status'=>0,'message'=>'Shared data are not found');
				$this->response($message, REST_Controller::HTTP_OK);
			}
		}else{
				$message = array('status'=>0,'message'=>'User not available .Please try again');
				$this->response($message, REST_Controller::HTTP_OK);
			}
	}
	/*sharedtab*/
	/*recenttab*/
		public function recenttab_post(){
		$userid=$this->post('userid');
		if($userid==''){
		$message = array('status'=>0,'message'=>'User Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		$check_user=$this->Mobile_model->get_user_details($userid);
		if(count($check_user)>0){
			$folder_list=$this->Mobile_model->get_recentfolder_list($userid);
			$file_list=$this->Mobile_model->get_recentfile_list($userid);
			$link_list=$this->Mobile_model->get_recentlink_list($userid);
			if(count($folder_list)>0 || count($file_list)>0 || count($link_list)>0){
				$message = array('status'=>1,'folder_list'=>$folder_list,'file_list'=>$file_list,'link_list'=>$link_list,'filepath'=>base_url('assets/files/'),'message'=>'Shared data are found');
				$this->response($message, REST_Controller::HTTP_OK);
			}else{
				$message = array('status'=>0,'message'=>'Shared data are not found');
				$this->response($message, REST_Controller::HTTP_OK);
			}
		}else{
				$message = array('status'=>0,'message'=>'User not available .Please try again');
				$this->response($message, REST_Controller::HTTP_OK);
			}
	}
	/*recenttab*/
	/*myfile*/
	
	public function myfilestab_post(){
		$userid=$this->post('userid');
		if($userid==''){
		$message = array('status'=>0,'message'=>'User Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		$check_user=$this->Mobile_model->get_user_details($userid);
		if(count($check_user)>0){
			$folder_list=$this->Mobile_model->get_flodername_data($userid);
			$file_list=$this->Mobile_model->get_files_list($userid);
			$link_list=$this->Mobile_model->get_link_list($userid);
			if(count($folder_list)>0 || count($file_list)>0 || count($link_list)>0){
				$message = array('status'=>1,'folder_list'=>$folder_list,'file_list'=>$file_list,'link_list'=>$link_list,'filepath'=>base_url('assets/files/'),'message'=>'Shared data are found');
				$this->response($message, REST_Controller::HTTP_OK);
			}else{
				$message = array('status'=>0,'message'=>'Shared data are not found');
				$this->response($message, REST_Controller::HTTP_OK);
			}
		}else{
				$message = array('status'=>0,'message'=>'User not available .Please try again');
				$this->response($message, REST_Controller::HTTP_OK);
			}
	}
	/*myfile*/
	/*dashboardtab*/
		public function dashboard_post(){
		$userid=$this->post('userid');
		if($userid==''){
		$message = array('status'=>0,'message'=>'User Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		$check_user=$this->Mobile_model->get_user_details($userid);
		if(count($check_user)>0){
			$folder_list=$this->Mobile_model->get_flodername_data($userid);
			$file_list=$this->Mobile_model->get_fileupload_data($userid);
			if(count($folder_list)>0 || count($file_list)>0){
				$message = array('status'=>1,'folder_list'=>$folder_list,'file_list'=>$file_list,'filepath'=>base_url('assets/files/'),'message'=>'Dashboard data are found');
				$this->response($message, REST_Controller::HTTP_OK);
			}else{
				$message = array('status'=>0,'message'=>'Dashboard data are not found');
				$this->response($message, REST_Controller::HTTP_OK);
			}
		}else{
				$message = array('status'=>0,'message'=>'User not available .Please try again');
				$this->response($message, REST_Controller::HTTP_OK);
			}
	}
	/*dashboardtab*/
	/*filecall*/
	public function filecall_post(){
		$calling_name=$this->post('calling_name');
		$user_id=$this->post('user_id');
		$shareduser_id=$this->post('shareduser_id');
		$email=$this->post('shared_email');
		if($user_id ==''){
		$message = array('status'=>0,'message'=>'User Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		if($calling_name ==''){
		$message = array('status'=>0,'message'=>'Calling Name is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		if($shareduser_id =='' && $email ==''){
		$message = array('status'=>0,'message'=>'Shared user Id  or Email Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		$check_user=$this->Mobile_model->get_user_details($user_id);
			if(count($check_user)>0){
						$filecalldata=array(
							'u_id'=>$user_id,
							'f_c_calling'=>$calling_name,
							'f_c_u_id'=>isset($shareduser_id)?$shareduser_id:'',
							'f_c_email_id'=>isset($email)?$email:'',
							'f_c_status'=>1,
							'f_c_created_at'=>date('Y-m-d H:i:s'),
							'f_c_updated_at'=>date('Y-m-d H:i:s'),
							'f_c_request'=>0
							);
							$filecall=$this->Mobile_model->save_filecall($filecalldata);
							if(count($filecall)>0){
									/*notification */
										$notificationdata=array(
										'sent_u_id'=>$user_id,
										'filecall_id'=>$filecall,
										'u_id'=>$shareduser_id,
										'filecall_status'=>1,
										'filecall_created_at'=>date('Y-m-d H:i:s'),
										'filecall_updated_at'=>date('Y-m-d H:i:s'),
										);
									$this->Mobile_model->save_filecall_notification($notificationdata);
									/*notification */
										$activity=array(
											'u_id'=>$user_id,
											'file'=>'',
											'folder'=>'',
											'link'=>'',
											'action'=>'FileCall',
											'create_at'=>date('Y-m-d H:i:s')
											);
										$this->Mobile_model->activity_login($activity);
									$message = array('status'=>1,'filecall_id'=>$filecall,'message'=>'File call request is successfully sent');
									$this->response($message, REST_Controller::HTTP_OK);
								}else{
									$message = array('status'=>0,'message'=>'Technical problem will occurred .Please try again');
									$this->response($message, REST_Controller::HTTP_OK);
								}

													
			}else{
				$message = array('status'=>0,'message'=>'User not available .Please try again');
				$this->response($message, REST_Controller::HTTP_OK);
			}			
		
	}
	public function filecalldecline_post(){
		$user_id=$this->post('user_id');
		$filecall_id=$this->post('filecall_id');
		$filecall_status=$this->post('filecall_status');
		if($user_id ==''){
		$message = array('status'=>0,'message'=>'User Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		if($filecall_id ==''){
		$message = array('status'=>0,'message'=>'File call Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		if($filecall_status ==''){
		$message = array('status'=>0,'message'=>'FIle call status is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		$check_user=$this->Mobile_model->get_user_details($user_id);
		if(count($check_user)>0){
					$check_filecall=$this->Mobile_model->get_filecall_detais($user_id,$filecall_id);
					if(count($check_filecall)>0){
						$statusdata=array(
						'f_c_request'=>$filecall_status,
						'f_c_updated_at'=>date('Y-m-d H:i:s'),				
						);
						$filecall_details = $this->Mobile_model->update_filecall_details($filecall_id,$statusdata);
						if(count($filecall_details)>0){
								$activity=array(
									'u_id'=>$user_id,
									'file'=>'',
									'folder'=>'',
									'link'=>'',
									'action'=>'Request',
									'create_at'=>date('Y-m-d H:i:s')
									);
								$this->Mobile_model->activity_login($activity);

								$message = array('status'=>1,'filecall_id'=>$filecall_id,'message'=>'File call Request declined');
									$this->response($message, REST_Controller::HTTP_OK);
								}else{
									$message = array('status'=>0,'message'=>'Technical problem will occurred .Please try again');
									$this->response($message, REST_Controller::HTTP_OK);
								}
					}else{
							$message = array('status'=>0,'message'=>'Request not available .Please try again');
							$this->response($message, REST_Controller::HTTP_OK);
					}
			
		}else{
				$message = array('status'=>0,'message'=>'User not available .Please try again');
				$this->response($message, REST_Controller::HTTP_OK);
			}	
	}
	
	public function filecallaccept_post(){
		$filecall_id=$this->post('filecall_id');
		$folder_id=$this->post('folder_id');
		$user_id=$this->post('user_id');
		$shareduser_id=$this->post('shareduser_id');
		$permission=$this->post('permission');
		$email=$this->post('shared_email');
		$type=$this->post('type');
		if($filecall_id ==''){
		$message = array('status'=>0,'message'=>'File call Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		if($folder_id ==''){
		$message = array('status'=>0,'message'=>'Folder Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}if($user_id ==''){
		$message = array('status'=>0,'message'=>'User Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		if($shareduser_id =='' && $email ==''){
		$message = array('status'=>0,'message'=>'Shared user Id  or Email Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		if($permission ==''){
		$message = array('status'=>0,'message'=>'permissions Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}if($type ==''){
		$message = array('status'=>0,'message'=>'Type is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		$details=$this->Mobile_model->get_folder_details($folder_id);
			if(count($details)>0){
				if($type==1){
						if($shareduser_id!=''){
							$already_shared=$this->Mobile_model->get_shared_folder_details($shareduser_id,$folder_id);
						}else{
							$already_shared=$this->Mobile_model->get_shared_folder_details($shareduser_id,$email);
						}
							if(count($already_shared)==0){
								$folderdata=array(
									'u_id'=>isset($shareduser_id)?$shareduser_id:'',
									'u_email'=>isset($email)?$email:'',
									'f_id'=>$folder_id,
									's_permission'=>$permission,
									's_status'=>1,
									's_created'=>date('Y-m-d H:i:s'),
									'file_created_id'=>$user_id
									);
									$shared_data=$this->Mobile_model->folder_share($folderdata);
										if(count($shared_data)>0){
												$statusdata=array(
												'f_c_request'=>1,
												'f_c_updated_at'=>date('Y-m-d H:i:s'),				
												);
											$this->Mobile_model->update_filecall_details($filecall_id,$statusdata);
											$activity=array(
																	'u_id'=>$user_id,
																	'file'=>'',
																	'folder'=>$folder_id,
																	'link'=>'',
																	'action'=>'Request',
																	'create_at'=>date('Y-m-d H:i:s')
																	);
																$this->Mobile_model->activity_login($activity);
											$message = array('status'=>1,'folder_id'=>$folder_id,'message'=>'File call request successfully accepted');
											$this->response($message, REST_Controller::HTTP_OK);
										}else{
											$message = array('status'=>0,'message'=>'Technical problem will occurred .Please try again');
											$this->response($message, REST_Controller::HTTP_OK);
										}

							}else{
								$message = array('status'=>0,'message'=>'Folder already shared. Please try another folder');
								$this->response($message, REST_Controller::HTTP_OK);
							}	

				}else{
					if($shareduser_id!=''){
						$already_shared=$this->Mobile_model->get_shared_file_details($shareduser_id,$file_id);
					}else{
						$already_shared=$this->Mobile_model->get_shared_file_details($shareduser_id,$email);
					}
						if(count($already_shared)==0){
							$filedata=array(
								'u_id'=>isset($shareduser_id)?$shareduser_id:'',
								'u_email'=>isset($email)?$email:'',
								'img_id'=>$file_id,
								's_permission'=>$permission,
								's_status'=>1,
								's_created'=>date('Y-m-d H:i:s'),
								'file_created_id'=>$user_id
								);
								$shared_data=$this->Mobile_model->file_share($filedata);
									if(count($shared_data)>0){
											$statusdata=array(
												'f_c_request'=>1,
												'f_c_updated_at'=>date('Y-m-d H:i:s'),				
												);
											$this->Mobile_model->update_filecall_details($filecall_id,$statusdata);
												$activity=array(
														'u_id'=>$user_id,
														'file'=>$file_id,
														'folder'=>'',
														'link'=>'',
														'action'=>'Request',
														'create_at'=>date('Y-m-d H:i:s')
														);
													$this->Mobile_model->activity_login($activity);
								
										$message = array('status'=>1,'file_id'=>$file_id,'message'=>'File is successfully shared');
										$this->response($message, REST_Controller::HTTP_OK);
									}else{
										$message = array('status'=>0,'message'=>'Technical problem will occurred .Please try again');
										$this->response($message, REST_Controller::HTTP_OK);
									}

						}else{
							$message = array('status'=>0,'message'=>'File already shared. Please try another file');
							$this->response($message, REST_Controller::HTTP_OK);
						}

				}				
			}else{
				$message = array('status'=>0,'message'=>'Folder Id not available .Please try again');
				$this->response($message, REST_Controller::HTTP_OK);
			}	
	}
	/*filecall*/
	/*logs*/
	public function activity_logs_post(){
		$user_id=$this->post('user_id');
		if($user_id ==''){
		$message = array('status'=>0,'message'=>'User Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		$activity_logs=$this->Mobile_model->get_activity_logs_list($user_id);
			if(count($activity_logs)>0){
				$message = array('status'=>1,'activity_logs'=>$activity_logs,'message'=>'Activity logs are found');
				$this->response($message, REST_Controller::HTTP_OK);
			}else{
				$message = array('status'=>0,'message'=>'Activity logs are not found');
				$this->response($message, REST_Controller::HTTP_OK);
			}
	}
	public function activity_logs_clear_post(){
		$user_id=$this->post('user_id');
		if($user_id ==''){
		$message = array('status'=>0,'message'=>'User Id is required');
		$this->response($message, REST_Controller::HTTP_OK);			
		}
		$activity_logs=$this->Mobile_model->get_activity_logs_list($user_id);
		foreach($activity_logs as $list){
				$delete_logs=$this->Mobile_model->delete_all_activity_logs($list['id']);
				//echo $this->db->last_query();exit;
			}
			if(count($delete_logs)>0){
					$activity=array(
						'u_id'=>$user_id,
						'file'=>'',
						'folder'=>'',
						'link'=>'',
						'action'=>'Clear Logs',
						'create_at'=>date('Y-m-d H:i:s')
						);
					$this->Mobile_model->activity_login($activity);
				$message = array('status'=>1,'user_id'=>$user_id,'message'=>'Activity logs are cleared');
				$this->response($message, REST_Controller::HTTP_OK);
			}else{
				$message = array('status'=>0,'message'=>'Technical problem will occurred .Please try again');
				$this->response($message, REST_Controller::HTTP_OK);
			}
	}
	/*logs*/
    

}
