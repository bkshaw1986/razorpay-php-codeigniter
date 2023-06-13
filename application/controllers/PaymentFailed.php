<?php defined('BASEPATH') OR exit('No direct script access allowed');

class PaymentFailed extends CI_Controller {
	public function index() {
		$this->load->view('PaymentFailed');
	}
}
