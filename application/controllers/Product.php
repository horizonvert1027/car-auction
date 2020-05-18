<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

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
// list dashboard with the data imported from sell product
	function index()
	{
		$products = $this->product_model->get();
		$data = array('products' => $products);
		$this->load->view('dashboard', $data);
	}

	function sell()
	{
		$this->load->view('sellproduct');
	}
//https://codeigniter.com/userguide3/libraries/file_uploading.html file uploading
	public function sell_post()
	{
		$config = array(
			'upload_path' => "./assets/images/products",
			'allowed_types' => "gif|jpg|png|jpeg|pdf",
			'overwrite' => TRUE,
			'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
			'max_height' => "7680",
			'max_width' => "10240"
		);
		$this->upload->initialize($config);

		if($this->upload->do_upload()) {
			$uploadData = $this->upload->data();
			$data["image"] = $uploadData['file_name'];

// Other information that needed to be stored
			$data = array(
				'name' => $this->input->post('name'),
				'description' => $this->input->post('description'),
				'image' => $uploadData['file_name'],
				'starting_price' => $this->input->post('starting_price'),
				'bid_price' => $this->input->post('bid_price')

			);
			$id = $this->product_model->insert($data);
			if ($id > 0) {
				redirect('dashboard');
			}
		}
	}

	function search()
	{
		$output = '';
		$product_name = '';
		if($this->input->post('query'))
		{
			$product_name = $this->input->post('query');
		}
		$data = $this->product_model->getByName($product_name);

		if($data->num_rows() > 0)
		{
			foreach($data->result() as $row)
			{
				$output .= '
			<div class="col-lg-3 col-md-6 mb-4">
				<div class="card h-100">
					<img class="card-img-top" src='.base_url().'assets/images/products/'.$row->image.' alt="product_image">
					<div class="card-body">
						<h4 class="card-title">'.$row->name.'</h4>
						<p class="card-text">'.$row->description.'</p>



					</div>
					<div class="card-footer">
						<a href="#" class="btn btn-primary">Find Out More!</a>
					</div>
					<div class="card-footer">
						<a href="'. base_url('product/add_to_cart/' . $row->id) .'" class="btn btn-success">Add to cart</a>
					</div>
					<div class="card-footer">
						<a href="'. base_url('product/buy/' . $row->id) .'" class="btn btn-success">Buy</a>
					</div>
				</div>
			</div>
    ';
			}
		}
		else
		{
			$output .= '<tr>
       	<td colspan="5">No Data Found</td>
      	</tr>';
		}
		echo $output;
	}

	function buyProduct(){
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

	function paymentSuccess(){
		$this->load->view('paymentSuccess');
	}

	function paymentFail(){
		$this->load->view('paymentFail');
	}

	function ipn(){
		//paypal return transaction details array
		$paypalInfo    = $this->input->post();

		$data['user_id'] = $paypalInfo['custom'];
		$data['product_id']    = $paypalInfo["item_number"];
		$data['txn_id']    = $paypalInfo["txn_id"];
		$data['payment_gross'] = $paypalInfo["mc_gross"];
		$data['currency_code'] = $paypalInfo["mc_currency"];
		$data['payer_email'] = $paypalInfo["payer_email"];
		$data['payment_status']    = $paypalInfo["payment_status"];

		$paypalURL = $this->paypal_lib->paypal_url;
		$result    = $this->paypal_lib->curlPost($paypalURL,$paypalInfo);

		//check whether the payment is verified
		if(preg_match("/VERIFIED/i",$result)){
			//insert the transaction data into the database
			$this->product_model->storeTransaction($data);
		}
	}
}

