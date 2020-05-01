<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// This is a page created to test the connection between view and controller
class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('encryption');

	}

	function index()
	{
		$this->load->view('location');
	}
}

