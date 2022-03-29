<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payumoney extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->library('cart');
		$this->load->model('Productmodel');
	}

	public function index()
	{
		// print_r($_SESSION['checkoutdata']);
		// die();

		$data['txnid'] = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
		$data['email'] = $_SESSION['checkoutdata']['email'];
		$data['mobile'] = $_SESSION['checkoutdata']['phone'];
		$data['firstName'] = $_SESSION['checkoutdata']['name'];
		$data['lastName'] = $_SESSION['checkoutdata']['name'];
		$data['totalCost'] = $_SESSION['checkoutdata']['pricetopay'];
		$data['hash'] = '';

		//Below is the required format need to hash it and send it across payumoney page. UDF means User Define Fields.
		//$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
		$hash_string = MERCHANT_KEY . "|" . $data['txnid'] . "|" . $data['totalCost'] . "|" . "productinfo|" . $data['firstName'] . "|" . $data['email'] . "|||||||||||" . SALT;
		$data['hash'] = strtolower(hash('sha512', $hash_string));
		$data['action'] = PAYU_BASE_URL . '/_payment';
		$this->load->view('pum_index', $data);
	}


	public function order_success()
	{
		$status = $this->input->post("status");
		$firstname = $this->input->post("firstname");
		$amount = $this->input->post("amount");
		$txnid = $this->input->post("txnid");
		$posted_hash = $this->input->post("hash");
		$key = $this->input->post("key");
		$productinfo = $this->input->post("productinfo");
		$email = $this->input->post("email");
		$salt = "DlQ7UywBQs";

		if ($this->input->post("additionalCharges")) {
			$additionalCharges = $this->input->post("additionalCharges");
			$retHashSeq = $additionalCharges . '|' . $salt . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
		} else {

			$retHashSeq = $salt . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
		}
		$hash = hash("sha512", $retHashSeq);

		if ($hash != $posted_hash) {
			$data['msg'] = "Invalid Transaction. Please try again";
		} else {
			$data['msg'] = "<h3>Thank You. Your order status is " . $status . ".</h3>";
			$data['msg'] .= "<h4>Your Transaction ID for this transaction is " . $txnid . ".</h4>";
			$data['msg'] .= "<h4>We have received a payment of Rs. " . $amount . ". Your order will soon be shipped.</h4>";
		}

		$this->load->view('pum_common', $data);
	}


	public function order_fail()
	{
		$status = $this->input->post("status");
		$firstname = $this->input->post("firstname");
		$amount = $this->input->post("amount");
		$txnid = $this->input->post("txnid");
		$posted_hash = $this->input->post("hash");
		$key = $this->input->post("key");
		$productinfo = $this->input->post("productinfo");
		$email = $this->input->post("email");
		$salt = "eCwWELxi";
		if ($this->input->post("additionalCharges")) {
			$additionalCharges = $this->input->post("additionalCharges");
			$retHashSeq = $additionalCharges . '|' . $salt . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
		} else {
			$retHashSeq = $salt . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
		}
		$hash = hash("sha512", $retHashSeq);
		if ($hash != $posted_hash) {
			$data['msg'] = "Invalid Transaction. Please try again";
		} else {
			$data['msg'] = "<h3>Your order status is " . $status . ".</h3>";
			$data['msg'] .= "<h4>Your transaction id for this transaction is " . $txnid . ". You may try making the payment by clicking the link below.</h4>";
		}
		$data['msg'] .= '<p>Try Again</p>';
		$this->load->view('pum_common', $data);
	}
}
