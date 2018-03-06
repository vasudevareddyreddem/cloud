<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once ('razorpay-php/Razorpay.php');
use Razorpay\Api\Api as RazorpayApi;
class Payment extends CI_Controller {

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
		//$api = new RazorpayApi('your_api_key_here', 'your_api_secret_here');
		$api_id= $this->config->item('keyId');
		$api_Secret= $this->config->item('API_keySecret');
		$api = new RazorpayApi($api_id,$api_Secret);
		//$api = new RazorpayApi($this->config->load('keyId'), $this->config->load('API_keySecret'));
		$orderData = [
				'receipt'         => 3456,
				'amount'          => 20 * 100, // 2000 rupees in paise
				'currency'        => 'INR',
				'payment_capture' => 1 // auto capture
		];

	$razorpayOrder = $api->order->create($orderData);
	$razorpayOrderId = $razorpayOrder['id'];
	$displayAmount = $amount = $orderData['amount'];
	$displayCurrency=$orderData['currency'];
	$data['details'] = [
						"key"               => $api_id,
						"amount"            => $amount,
						"name"              => "vasudevareddy",
						"description"       => "Activate for cloud account",
						"image"             => "",
						"prefill"           => [
						"name"              => "vasudevareddy reddem",
						"email"             => "vasudevareddy@prachatech.com",
						"contact"           => "8500050944",
						],
						"notes"             => [
						"address"           => "kukatpalli",
						"merchant_order_id" => "12312321",
						],
						"theme"             => [
						"color"             => "#F37254"
						],
						"order_id"          => $razorpayOrderId,
						"display_currency"          => $orderData['currency'],
		];
		
			$this->load->view('payment/pay',$data);
	}
	
	public  function success(){
		echo '<pre>';print_r($_POST);exit;
		
	}
	
	
	
	
	
	
}
