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
		$this->load->library('paypal_lib');
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
		$user_id = $this->session->get_userdata()['id'];
		$cart_id = $this->session->get_userdata()['cart_id'];
		$cart_items = $this->cart_item_model->getByCart($cart_id);

		//Set variables for paypal form
		$returnURL = base_url().'paypal/success'; //payment success url
		$failURL = base_url().'paypal/fail'; //payment fail url
		$notifyURL = base_url().'paypal/ipn'; //ipn url

		//get particular product data
		$this->paypal_lib->add_field('return', $returnURL);
		$this->paypal_lib->add_field('fail_return', $failURL);
		$this->paypal_lib->add_field('notify_url', $notifyURL);
		$this->paypal_lib->add_field('custom', $user_id);

		foreach ($cart_items as $index => $cart_item) {
			$this->paypal_lib->add_field('item_number_' . $index,  $cart_item['product_id']);
			$this->paypal_lib->add_field('item_name_' . $index, $cart_item['name']);
			$this->paypal_lib->add_field('quantity_' . $index, $cart_item['quantity']);
			$this->paypal_lib->add_field('amount_' . $index,  $cart_item['bid_price']);
		}

		$this->paypal_lib->paypal_auto_form();
	}
}

