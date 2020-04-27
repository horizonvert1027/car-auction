<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('encryption');
		$this->load->model('product_model');
	}

	function index()
	{
		$products = $this->product_model->get();
		$data = array('products' => $products);
		$this->load->view('dashboard', $data);
	}
}

