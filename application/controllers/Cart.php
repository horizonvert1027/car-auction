<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';
use Dompdf\Dompdf;

class Cart extends CI_Controller {

	// Initial function
	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('id'))
		{
			redirect('login');
		}
		$this->load->library('form_validation');
		$this->load->library('encryption');
		$this->load->model('user_model');
		$this->load->model('product_model');
		$this->load->model('cart_model');
		$this->load->model('cart_item_model');
		$this->load->library('upload');
		$this->load->library('paypal_lib');
	}

	// Add a product to cart, default quantity is 1
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

	// Update cart to database
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

	// Auto form from Paypal service
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

		// Add products information
		foreach ($cart_items as $index => $cart_item) {
			$this->paypal_lib->add_field('item_number_' . ($index + 1),  $cart_item['product_id']);
			$this->paypal_lib->add_field('item_name_' . ($index + 1), $cart_item['name']);
			$this->paypal_lib->add_field('quantity_' . ($index + 1), $cart_item['quantity']);
			$this->paypal_lib->add_field('amount_' . ($index + 1),  $cart_item['bid_price']);
		}

		$this->paypal_lib->paypal_auto_form();
	}

	// Generate invoice
	public function invoice()
	{
		$user = $this->user_model->get($this->session->get_userdata()['id']);
		$cart_id = $this->session->get_userdata()['cart_id'];
		$cart_items = $this->cart_item_model->getByCart($cart_id);

		$html_output = "<h1>The invoice of ". $user->username ."</h1>";
		$html_output .= "<table><tr><th>#</th><th>Product name</th><th>Price</th><th>Quantity</th></tr>";
		$total = 0;

		foreach ($cart_items as $index => $cart_item) {
			$html_output .=
				"<tr>" .
					"<td>" . ($index + 1) . "</td>" .
					"<td>" . $cart_item['name'] . "</td>" .
					"<td>" . $cart_item['bid_price'] . "</td>" .
					"<td>" . $cart_item['quantity'] . "</td>" .
				"</tr>";
			$total += $cart_item['bid_price'] * $cart_item['quantity'];
		}

		$html_output .=	"</table>";
		$html_output .=	"<h3>Total: $" . $total . "</h3>";

		// instantiate and use the dompdf class
		$dompdf = new Dompdf();
		$dompdf->loadHtml($html_output);

		// setup pdf format
		$dompdf->setPaper('A4', 'landscape');

		$dompdf->render();
		$dompdf->stream();
	}

	// Continue shop after payment
	public function continue_shop() {
		// Create new cart
		$data = array(
			'user_id'  => $this->session->get_userdata()['id'],
			'status'  => "in_progress",
			'created_at' => date('Y-m-d H:i:s'),
		);
		$cart_id = $this->cart_model->insert($data);
		$this->session->set_userdata('cart_id', $cart_id);
		redirect('dashboard');
	}
}

