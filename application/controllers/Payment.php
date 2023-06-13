<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH."libraries/razorpay/razorpay-php/Razorpay.php");

use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

class Payment extends CI_Controller {
	public function index() {
		$this->load->view('Payment');
	}

	/**
	 * This function creates order and loads the payment methods
	 */
	public function pay() {
		$api = new Api(RAZOR_KEY, RAZOR_SECRET_KEY);
		/**
		 * You can calculate payment amount as per your logic
		 * Always set the amount from backend for security reasons
		 */
		$_SESSION['payable_amount'] = 10;

		$razorpayOrder = $api->order->create(array(
			'receipt'         => rand(),
			'amount'          => $_SESSION['payable_amount'] * 100, // 2000 rupees in paise
			'currency'        => 'INR',
			'payment_capture' => 1 // auto capture
		));


		$amount = $razorpayOrder['amount'];

		$razorpayOrderId = $razorpayOrder['id'];

		$_SESSION['razorpay_order_id'] = $razorpayOrderId;

		$data = $this->prepareData($amount,$razorpayOrderId);

		$this->load->view('payment',array('data' => $data));
	}

	/**
	 * This function verifies the payment,after successful payment
	 */
	public function verify() {
		$success = true;
		$error = "payment_failed";
		if (empty($_POST['razorpay_payment_id']) === false) {
			$api = new Api(RAZOR_KEY, RAZOR_SECRET_KEY);
		try {
				$attributes = array(
					'razorpay_order_id' => $_SESSION['razorpay_order_id'],
					'razorpay_payment_id' => $_POST['razorpay_payment_id'],
					'razorpay_signature' => $_POST['razorpay_signature']
				);
				$api->utility->verifyPaymentSignature($attributes);
			} catch(SignatureVerificationError $e) {
				$success = false;
				$error = 'Razorpay_Error : ' . $e->getMessage();
			}
		}
		if ($success === true) {
			/**
			 * Call this function from where ever you want
			 * to save save data before of after the payment
			 */
			$this->setRegistrationData();

			redirect(base_url().'payment-success');
		}
		else {
			redirect(base_url().'payment-failed');
		}
	}

	/**
	 * This function preprares payment parameters
	 * @param $amount
	 * @param $razorpayOrderId
	 * @return array
	 */
	public function prepareData($amount,$razorpayOrderId) {
		$data = array(
			"key" => RAZOR_KEY,
			"amount" => $amount,
			"name" => "Binay Shaw",
			"description" => "Razorpay Payment Gateway in CodeIgniter",
			"image" => base_url()."assets/img/logo.png",
			"prefill" => array(
				"name"  => ucwords(strtolower($this->input->post('name'))),
				"email"  => strtolower($this->input->post('email')),
				"contact" => $this->input->post('contact'),
			),
			"notes"  => array(
				"address"  => "India",
				"merchant_order_id" => rand(),
			),
			"theme"  => array(
				"color"  => "#FF7200"
			),
			"order_id" => $razorpayOrderId,
		);
		return $data;
	}

	/**
	 * This function saves your form data to session,
	 * After successfull payment you can save it to database
	 */
	public function setRegistrationData() {

		$registrationData = array(
			'order_id' => $_SESSION['razorpay_order_id'],
			'name' => ucwords(strtolower($this->input->post('name'))),
			'email' => strtolower($this->input->post('email')),
			'contact' => $this->input->post('contact'),
			'amount' => $_SESSION['payable_amount'],
		);
		// save this to database

	}	
	
}
