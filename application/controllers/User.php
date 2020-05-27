<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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
		$this->load->library('upload');
		$this->load->helper('cookie');
	}

	// Profile view
	function profile()
	{
		$user = $this->user_model->get($this->session->userdata('id'));
		$data = array('user' => $user);
		$this->load->view('user/profile', $data);
	}

	// Upload profile picture
	public function upload()
	{
		// Config uploaded picture
		$config = array(
			'upload_path' => "./assets/images/users",
			'allowed_types' => "gif|jpg|png|jpeg|pdf",
			'overwrite' => TRUE,
			'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
			'max_height' => "7680",
			'max_width' => "10240"
		);
		$this->upload->initialize($config);

		// Upload process
		if($this->upload->do_upload()) {
			$uploadData = $this->upload->data();
			$data["image"] = $uploadData['file_name'];
			$this->user_model->update($this->session->userdata('id'), $data);
			redirect('user/profile');
		}
	}

	// Update user information
	public function update()
	{
		$data = array(
			'username' => $this->input->post('username'),
			'email' => $this->input->post('email'),
		);
		$this->user_model->update($this->session->userdata('id'), $data);
		redirect('user/profile');
	}

	// destroy session and cookie
	public function logout()
	{
		delete_cookie('email'); /* Delete email cookie */
		delete_cookie('password'); /* Delete password cookie */
		$this->session->unset_userdata('id');
		$this->session->unset_userdata('username');
		$this->session->sess_destroy();
		redirect('login');
	}
}

