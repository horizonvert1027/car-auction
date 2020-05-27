<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

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
		$this->load->model('product_model');
		$this->load->model('cart_model');
		$this->load->model('cart_item_model');
		$this->load->model('comment_model');
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

	// Add new product for selling
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
		}

		$data = array(
			'name' => $this->input->post('name'),
			'description' => $this->input->post('description'),
			'image' => $uploadData['file_name'],
			'starting_price' => $this->input->post('starting_price'),
			'bid_price' => $this->input->post('bid_price')
		);

		// Check if insert data successfully
		$id = $this->product_model->insert($data);
		if ($id > 0) {
			redirect('dashboard');
		}
	}

	// Search feature
	function search()
	{
		$output = '';
		$product_name = '';
		$limit = 0;

		// get query
		if($this->input->post('query'))
		{
			$product_name = $this->input->post('query');
		}

		// get limit
		if($this->input->post('limit'))
		{
			$limit = $this->input->post('limit');
		}

		// get product filter by name and limit
		$data = $this->product_model->getByName($product_name, $limit);
		$max_data = $this->product_model->count();

		// generate output to render in html
		if($data->num_rows() > 0)
		{
			$status = $max_data > $limit ? "inactive" : "active";
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
						<a href="'. base_url('product/detail/' . $row->id) .'" class="btn btn-primary">Find Out More!</a>
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

		// return as json format
		header('Content-Type: application/json');
		echo json_encode(array(
			'data' => $output,
			'status' => $status
		));
	}

	// Success view
	function paymentSuccess(){
		$this->load->view('paymentSuccess');
	}

	// Fail View
	function paymentFail(){
		$this->load->view('paymentFail');
	}

	function search_auto_completion() {
		// Find product with name contains term value
		$term = $this->input->get('term');
		$this->db->like('name', $term);
		$data = $this->db->get("product")->result();

		echo json_encode( $data);
	}

	// Product detail view
	function detail() {
		$id = $this->uri->segment(3);
		$product = $this->product_model->getProducts($id);
		$comments = $this->comment_model->get($id);
		$data = array('product' => $product, 'comments' => $comments);
		$this->load->view('detailproduct', $data);
	}

	// Send comment feature
	function send_comment() {
		$content = $this->input->post('content');

		// Insert new comment
		$data = array(
			'user_id' => $this->session->get_userdata()['id'],
			'product_id' => $this->uri->segment(3),
			'content' => $content
		);
		$this->comment_model->insert($data);

		// Generate output to render in HTML
		$output =
			"<div class='row'>
				<p><strong>" . $this->session->get_userdata()['username'] . "</strong>:" . $content . "</p>
			</div>";
		echo $output;
	}
}

