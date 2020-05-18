<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('id'))
		{
			redirect('login');
		}
		$this->load->library('form_validation');
		$this->load->library('encryption');
		$this->load->model('product_model');
		$this->load->model('cart_model');
		$this->load->model('cart_item_model');
		$this->load->library('upload');
	}

	function add_to_cart() {
		$product_id = $this->uri->segment(3);
		$cart_id = $this->session->get_userdata()['cart_id'];

		$data = array(
			'cart_id'  => $cart_id,
			'product_id'  => $product_id,
			'quantity' => 1,
		);

		$this->cart_item_model->insert($data);

		$cart_items = $this->cart_item_model->getByCart($cart_id);
		$data = array('items' => $cart_items);
		$this->load->view('cart', $data);
	}

	function update() {
		if($this->input->post('items'))
		{
			$items = $this->input->post('items');
			foreach ($items as $key => $item) {
				if ($item['is_deleted'] === "true") {
					$this->cart_item_model->delete($item['id']);
				} else {
					unset($item['is_deleted']);
					$this->cart_item_model->update($item);
				}
			}
		}
	}

	function checkout() {
		var_dump("haha");
		exit();
		$id = $this->uri->segment(3);

		//Set variables for paypal form
		$returnURL = base_url().'paypal/success'; //payment success url
		$failURL = base_url().'paypal/fail'; //payment fail url
		$notifyURL = base_url().'paypal/ipn'; //ipn url
		//get particular product data
		$product = $this->product_model->getProducts($id);
		$userID = 1; //current user id
		$logo = base_url().'Your_logo_url';

		$this->paypal_lib->add_field('return', $returnURL);
		$this->paypal_lib->add_field('fail_return', $failURL);
		$this->paypal_lib->add_field('notify_url', $notifyURL);
		$this->paypal_lib->add_field('custom', $userID);
		$this->paypal_lib->add_field('item_number_1',  $product['id']);
		$this->paypal_lib->add_field('item_name_1', $product['name']);
		$this->paypal_lib->add_field('quantity_1', 3);
		$this->paypal_lib->add_field('amount_1',  '15');

		$this->paypal_lib->add_field('item_number_2',  50);
		$this->paypal_lib->add_field('item_name_2', 'dmm');
		$this->paypal_lib->add_field('quantity_2', 5);
		$this->paypal_lib->add_field('amount_2',  '20');

		$this->paypal_lib->image($logo);

		$this->paypal_lib->paypal_auto_form();
	}
}

