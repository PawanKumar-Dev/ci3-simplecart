<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->library('cart');
		$this->load->model('productModel');
	}

	public function index()
	{
		$data['products'] = $this->productModel->getAllProducts();

		$this->load->view('products', $data);
	}

	public function addtocart($proid)
	{
		$result = $this->productModel->getSingleProduct($proid);

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
		if($this->cart->remove($rowid)) {
			return redirect('products/cart');
		}
	}


	public function checkout()
	{
		if ($this->cart->total_items() > 0) {

			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
			
			if($this->form_validation->run('checkout')) {

				$data = [
							'name' => $this->input->post('name'),
							'email' => $this->input->post('email'),
							'phone' => $this->input->post('phone'),
							'address' => $this->input->post('address'),
							'created' => date("d-m-Y h:i:s"),
							'modified' => date("d-m-Y h:i:s"),
							'status'=> 1
						];

				if($customer_id = $this->productModel->insertCustomerData($data)) {
					
					$orderdata = [
                            'customer_id' => $customer_id,
                            'grand_total' => $this->cart->total(),
                            'created' => date("d-m-Y h:i:s"),
                            'modified' => date("d-m-Y h:i:s"),
                            'status'=> 1
                        ];

                    if($order_id = $this->productModel->insertOrdersData($orderdata)) {

                       foreach ($this->cart->contents() as $cart) {
		                    $product_id = $cart['id'];
		                    $qty = $cart['qty'];
		                    $subtotal = $cart['subtotal'];

		                    $orderitems = [
	                    		'order_id' => $order_id,
	                    		'product_id' => $product_id,
	                    		'quantity' => $qty,
	                    		'sub_total' => $subtotal
	                    	];

	                    	$final = $this->productModel->insertOrderItems($orderitems);
		               }

                    	
                    	if($final) {
                    		$this->cart->destroy();
                    		return redirect('products/orderdetail');
                    	}
                    }

				} else {
					echo "checkout failed";
				}

			} else {
				$this->load->view('checkout');
			}

		} else {
			return redirect('products/cart');
		}
		
	}



	public function orderdetail()
	{
		$this->load->view('orderdetail');
	}
}
