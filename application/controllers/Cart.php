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
		$cart = $this->cart_model->getByUser();

		$data = array(
			'cart_id'  => $cart['id'],
			'product_id'  => $product_id,
			'quantity' => 1,
		);
		$this->cart_item_model->insert($data);

		$cart_items = $this->cart_item_model->getByCart($cart['id']);
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
}

