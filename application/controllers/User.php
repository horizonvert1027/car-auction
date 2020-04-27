<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('encryption');
		$this->load->model('user_model');

		$this->load->library('upload');
		$this->load->helper(array('form', 'url'));
	}

	function profile()
	{
		$user = $this->user_model->get($this->session->userdata('id'));
		$data = array('user' => $user);
		$this->load->view('user/profile', $data);
	}

	public function upload()
	{
		$config = array(
			'upload_path' => "./assets/images/users",
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
			$this->user_model->update($this->session->userdata('id'), $data);
			redirect('user/profile');
		}
	}

	public function update()
	{
		$data = array(
			'username' => $this->input->post('username'),
			'email' => $this->input->post('email'),
		);
		$this->user_model->update($this->session->userdata('id'), $data);
		redirect('user/profile');
	}
}

