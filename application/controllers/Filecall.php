<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Filecall extends CI_Controller {

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
		$this->load->model('Filecall_model');
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
			$data['all_users_list']=$this->Dashboard_model->get_all_users_list($loginuser_id['u_id']);	
			$data['notofication_list']=$this->Dashboard_model->get_user_notification_list($loginuser_id['u_id']);	
			$data['notofication_uread_count']=$this->Dashboard_model->get_user_notification_unreadcount($loginuser_id['u_id']);	
			//echo '<pre>';print_r($data);exit;
			$this->load->view('html/header',$data);
			$this->load->view('html/sidebar',$data);
			$this->load->view('html/filecall',$data);
			$this->load->view('html/footer');
		}else{
			$this->load->view('html/login');
		}
		
		
	}
	public function addrequest()
	{
		if($this->session->userdata('userdetails'))
		{
			$loginuser_id=$this->session->userdata('userdetails');
			$post=$this->input->post();
			//echo '<pre>';print_r($post);exit;
			if(isset($post['filecalling']) && $post['filecalling']!=''){
						foreach($post['filecalling'] as $list){
							$filecalldata=array(
							'u_id'=>$loginuser_id['u_id'],
							'f_c_calling'=>$post['calling'],
							'f_c_u_id'=>$list,
							'f_c_status'=>1,
							'f_c_created_at'=>date('Y-m-d H:i:s'),
							'f_c_updated_at'=>date('Y-m-d H:i:s'),
							'f_c_request'=>0
							);
							$sharedfile=$this->Filecall_model->save_filecall($filecalldata);
							if(count($sharedfile)>0){
									/*notification */
										$notificationdata=array(
										'sent_u_id'=>$loginuser_id['u_id'],
										'filecall_id'=>$sharedfile,
										'u_id'=>$list,
										'filecall_status'=>1,
										'filecall_created_at'=>date('Y-m-d H:i:s'),
										'filecall_updated_at'=>date('Y-m-d H:i:s'),
										);
								$this->Filecall_model->save_filecall_notification($notificationdata);
									/*notification */
							}
							
							
						}
						//exit;
					}
					if(isset($post['calling_email_id']) && $post['calling_email_id']!=''){
						$filecalldata=array(
							'u_id'=>$loginuser_id['u_id'],
							'f_c_calling'=>$post['calling'],
							'f_c_email_id'=>$post['calling_email_id'],
							'f_c_status'=>1,
							'f_c_created_at'=>date('Y-m-d H:i:s'),
							'f_c_updated_at'=>date('Y-m-d H:i:s'),
							'f_c_request'=>0
							);
							$sharedfile=$this->Filecall_model->save_filecall($filecalldata);
								if(count($sharedfile)>0){
									/*notification */
										$notificationdata=array(
										'sent_u_id'=>$loginuser_id['u_id'],
										'filecall_id'=>$sharedfile,
										'u_id'=>$list,
										'filecall_status'=>1,
										'filecall_created_at'=>date('Y-m-d H:i:s'),
										'filecall_updated_at'=>date('Y-m-d H:i:s'),
										);
								$this->Filecall_model->save_filecall_notification($notificationdata);
									/*notification */
							}
					}
					if(count($sharedfile)>0){
						$this->session->set_flashdata('success',"File call request successfully submitted");
						redirect('filecall');
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('filecall');
					}
			
		}else{
			$this->load->view('html/login');
		}
		
		
	}
	public function requestaccept(){
		if($this->session->userdata('userdetails'))
		{
				$filecall_id=base64_decode($this->uri->segment(3));
			    $filecall_status=base64_decode($this->uri->segment(4));
				$statusdata=array(
						'f_c_request'=>$filecall_status,
						'f_c_updated_at'=>date('Y-m-d H:i:s'),				
						);
					//echo '<pre>';print_r($renamedata);exit;
					$filecall_details = $this->Filecall_model->update_filecall_details($filecall_id,$statusdata);
					//echo $this->db->last_query();exit;
					if(count($filecall_details)>0){
						if($filecall_status==1){
							$this->session->set_flashdata('success',"Request accepted");
						}else{
							$this->session->set_flashdata('error',"Request declined");
						}
						redirect('filecall');
						
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('filecall');
					}
		}else{
			$this->load->view('html/login');
		}
	}
	
	
	
	
	
	
}
