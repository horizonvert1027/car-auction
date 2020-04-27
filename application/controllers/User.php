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

	public function upload_profile()
	{
		$config['upload_path']   = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']      = 1024;

		$this->load->library('upload', $config);
		$this->upload->do_upload('file');


		print_r('Image Uploaded Successfully.');
		exit;
	}
}

