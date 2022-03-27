<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->library('cart');
		$this->load->model('Productmodel');
	}

	public function index()
	{
		$data['products'] = $this->Productmodel->getAllProducts();

		$this->load->view('products', $data);
	}

	public function addtocart($proid)
	{
		$result = $this->Productmodel->getSingleProduct($proid);

		$data = [
			'id'      => $result->id,
			'qty'     => 1,
			'price'   => $result->price,
			'name'    => $result->name,
			'image'		=> $result->image
		];

		$this->cart->insert($data);

		return redirect('products/index');
	}

	public function cart()
	{
		$this->load->view('cart');
	}

	public function updateCartItm()
	{
		$qty = $this->input->get('qty');
		$rowid = $this->input->get('rowid');

		if (!empty($qty) && !empty($rowid)) {

			$data = [
				'rowid'      => $rowid,
				'qty'     => $qty
			];

			$updateResult = $this->cart->update($data);
		}

		if ($updateResult) {
			echo "ok";
		} else {
			echo "err";
		}
	}



	public function removecart($rowid)
	{
		if ($this->cart->remove($rowid)) {
			return redirect('products/cart');
		}
	}


	public function checkout()
	{

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

		if ($this->form_validation->run('checkout')) {

			$name = $this->input->post('name');
			$email = $this->input->post('email');
			$phone = $this->input->post('phone');
			$address = $this->input->post('address');
			$pricetopay = $this->input->post('pricetopay');
			$product_name = $this->input->post('product_name');

			include 'src/instamojo.php';

			$api = new Instamojo\Instamojo('test_9d5390efa5f237fd7b0b8d294d9', 'test_f0cde5c67c48d9ed959519720d5', 'https://test.instamojo.com/api/1.1/');

			try {
				$response = $api->paymentRequestCreate(array(
					"purpose" => $product_name,
					"amount" => $pricetopay,
					"buyer_name" => $name,
					"phone" => $phone,
					"send_email" => true,
					"send_sms" => true,
					"email" => $email,
					"mobile" => $phone,
					"shipping_city" => $address,
					'allow_repeated_payments' => false,
					"redirect_url" => base_url('products/thankyou'),
					"webhook" => base_url('products/webhook')
				));

				$pay_ulr = $response['longurl'];

				header("Location: $pay_ulr");
			} catch (Exception $e) {
				print('Error: ' . $e->getMessage());
			}

			$this->cart->destroy();

		} else {
			$this->load->view('checkout');
		}
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
