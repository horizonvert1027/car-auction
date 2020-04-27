<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('encryption');
		$this->load->model('product_model');

		$this->load->library('upload');
		$this->load->helper(array('form', 'url'));
	}

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

	public function sell_post()
	{
		$config = array(
			'upload_path' => "./assets/images/products",
			'allowed_types' => "gif|jpg|png|jpeg|pdf",
			'overwrite' => TRUE,
			'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
			'max_height' => "768",
			'max_width' => "1024"
		);
		$this->upload->initialize($config);

		if($this->upload->do_upload()) {
			$uploadData = $this->upload->data();
			$data["image"] = $uploadData['file_name'];

			$data = array(
				'name' => $this->input->post('name'),
				'description' => $this->input->post('description'),
				'image' => $uploadData['file_name'],
				'starting_price' => $this->input->post('starting_price'),
				'bid_price' => $this->input->post('bid_price'),
			);
			$id = $this->product_model->insert($data);
			if ($id > 0) {
				redirect('dashboard');
			}
		}
	}
}

