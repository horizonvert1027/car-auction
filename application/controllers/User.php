<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('encryption');
		$this->load->model('user_model');
	}

	function profile()
	{
		$user = $this->user_model->get($this->session->userdata('id'));
		$data = array('user' => $user);
		$this->load->view('user/profile', $data);
	}


}

