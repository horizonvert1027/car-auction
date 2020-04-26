<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('id')) {
			redirect('private_area');
		}
		$this->load->library('form_validation');
		$this->load->library('encryption');
		$this->load->model('register_model');
		$this->load->helper('url');
	}

	function index()
	{
		$this->load->view('register');
	}
}
