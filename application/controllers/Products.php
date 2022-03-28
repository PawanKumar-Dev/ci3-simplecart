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

			$checkoutArray = [
				'name' => $name,
				'email' => $email,
				'phone' => $phone,
				'address' => $address,
				'pricetopay' => $pricetopay,
				'product_name' => $product_name
			];

			$this->session->set_userdata('checkoutdata', $checkoutArray);
			return redirect('products/payment');

		} else {
			$this->load->view('checkout');
		}
	}


	public function payment()
	{
		$this->load->view('payment');
	}
}
