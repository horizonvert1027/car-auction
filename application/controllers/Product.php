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
}

