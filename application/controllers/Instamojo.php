<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Instamojo extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->library('cart');
		$this->load->model('Productmodel');
	}

	public function index()
	{
    include 'src/instamojo.php';

    $api = new Instamojo\Instamojo('test_9d5390efa5f237fd7b0b8d294d9', 'test_f0cde5c67c48d9ed959519720d5', 'https://test.instamojo.com/api/1.1/');

    try {
      $response = $api->paymentRequestCreate(array(
        "purpose" => $_SESSION['checkoutdata']['product_name'],
        "amount" => $_SESSION['checkoutdata']['pricetopay'],
        "buyer_name" => $_SESSION['checkoutdata']['name'],
        "phone" => $_SESSION['checkoutdata']['phone'],
        "send_email" => true,
        "send_sms" => true,
        "email" => $_SESSION['checkoutdata']['email'],
        "mobile" => $_SESSION['checkoutdata']['phone'],
        "shipping_city" => $_SESSION['checkoutdata']['address'],
        'allow_repeated_payments' => false,
        "redirect_url" => base_url('instamojo/thankyou'),
        "webhook" => base_url('instamojo/webhook')
      ));

      $pay_ulr = $response['longurl'];

      header("Location: $pay_ulr");
    } catch (Exception $e) {
      print('Error: ' . $e->getMessage());
    }

    $this->cart->destroy();
  }

  public function thankyou()
	{
		$this->load->view('thankyou');
	}

	public function webhook()
	{
		$this->load->view('webhook');
	}

}