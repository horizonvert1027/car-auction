<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('id')) {
			redirect('home');
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

	function validation()
	{
		$this->form_validation->set_rules('user_name', 'Name', 'required|trim');
		$this->form_validation->set_rules('user_email', 'Email Address', 'required|trim|valid_email|is_unique[user.email]');
		$this->form_validation->set_rules('user_password', 'Password', 'required');
		if($this->form_validation->run())
		{
			$verification_key = md5(rand());
			$encrypted_password = $this->encryption->encrypt($this->input->post('user_password'));
			$data = array(
				'username'  => $this->input->post('user_name'),
				'email'  => $this->input->post('user_email'),
				'password' => $encrypted_password,
				'verification_key' => $verification_key
			);
			$id = $this->register_model->insert($data);
			if ($id > 0)
			{
				$subject = "Please verify email for login";
				$message = "
    <p>Hi ".$this->input->post('user_name')."</p>
    <p>This is email verification mail from Codeigniter Login Register system. For complete registration process and login into system. First you want to verify you email by click this <a href='".base_url()."register/verify_email/".$verification_key."'>link</a>.</p>
    <p>Once you click this link your email will be verified and you can login into system.</p>
    <p>Thanks,</p>
    ";
				$config = array(
					'protocol'  => 'smtp',
					'smtp_host' => 'smtp.gmail.com',
					'smtp_port' => 465,
					'smtp_crypto' => 'ssl',
					'smtp_user'  => 'wisuq2020@gmail.com',
					'smtp_pass'  => 'UQgrad2020',
					'mailtype'  => 'html',
					'charset'    => 'iso-8859-1',
					'wordwrap'   => TRUE
				);
				$this->load->library('email', $config);
				$this->email->set_newline("\r\n");
				$this->email->from('car_auction_company');
				$this->email->to($this->input->post('user_email'));
				$this->email->subject($subject);
				$this->email->message($message);
				if($this->email->send())
				{
					$this->session->set_flashdata('message', 'Check in your email for email verification mail');
					redirect('register');
				}
				echo $this->email->print_debugger();
			}
		}
		else
		{
			$this->index();
		}
	}

	function verify_email()
	{
		if($this->uri->segment(3))
		{
			$verification_key = $this->uri->segment(3);
			if($this->register_model->verify_email($verification_key))
			{
				$data['message'] = '<h1 align="center">Your Email has been successfully verified, now you can login from <a href="'.base_url().'login">here</a></h1>';
			}
			else
			{
				$data['message'] = '<h1 align="center">Invalid Link</h1>';
			}
			$this->load->view('email_verification', $data);
		}
	}
}
