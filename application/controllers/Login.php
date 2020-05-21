<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('id'))
		{
			redirect('dashboard');
		}
		$this->load->library('form_validation');
		$this->load->library('encryption');
		$this->load->model('login_model');
		$this->load->model('cart_model');
		$this->load->helper('cookie');
	}

	function index()
	{
		$this->load->view('login');
	}

	function validation()
	{
		$this->form_validation->set_rules('email', 'Email Address', 'required|trim|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if($this->form_validation->run())
		{
			$result = $this->login_model->can_login($this->input->post('email'), $this->input->post('password'));
			if($result == '')
			{
				if ($this->input->post("remember_me"))
				{
					$this->input->set_cookie('email', $this->input->post('email'), 86500); /* Create cookie for store email */
					$this->input->set_cookie('password', $this->input->post('password'), 86500); /* Create cookie for password */
				}
				else
				{
					delete_cookie('email'); /* Delete email cookie */
					delete_cookie('password'); /* Delete password cookie */
				}

				$data = array(
					'user_id'  => $this->session->get_userdata()['id'],
					'status'  => "in_progress",
					'created_at' => date('Y-m-d H:i:s'),
				);
				$cart_id = $this->cart_model->insert($data);
				$this->session->set_userdata('cart_id', $cart_id);
				redirect('dashboard');
			}
			else
			{
				$this->session->set_flashdata('message',$result);
				redirect('login');
			}
		}
		else
		{
			$this->index();
		}
	}

	function reset_password()
	{
		$this->load->view('reset_password');
	}

	function reset_password_validation()
	{
		$this->form_validation->set_rules('email', 'Email Address', 'required|trim|valid_email');
		if($this->form_validation->run())
		{
			$result = $this->login_model->can_reset_password($this->input->post('email'));
			if($result === '')
			{
				$reset_token = md5(rand());
				$data = array(
					'reset_token'  => $reset_token
				);
				$this->login_model->update($this->input->post('email'), $data);
				$subject = "Verify email for login";
				$message = "
<p>Hi " . $this->input->post('name') . "</p>
<p>To reset your password, click this  <a href='" . base_url() . "login/set_password/" . $reset_token . "'>link</a>.</p>

";
				$config = array(
					'protocol' => 'smtp',
					'smtp_host' => 'smtp.gmail.com',
					'smtp_port' => 465,
					'smtp_crypto' => 'ssl',
					'smtp_user' => 'wisuq2020@gmail.com',
					'smtp_pass' => 'UQgrad2020',
					'mailtype' => 'html',
					'charset' => 'iso-8859-1',
					'wordwrap' => TRUE
				);
				$this->load->library('email', $config);
				$this->email->set_newline("\r\n");
				$this->email->from('car_auction_company');
				$this->email->to($this->input->post('email'));
				$this->email->subject($subject);
				$this->email->message($message);
				if ($this->email->send()) {
					$this->session->set_flashdata('message', 'Reset your password '
						. $this->input->post('email')
						.'. Check your span folders as well');
					redirect('login/reset_password');
				}
				echo $this->email->print_debugger();
			}
			else
			{
				$this->session->set_flashdata('message',$result);
				redirect('login/reset_password');
			}
		}
		else
		{
			$this->reset_password();
		}
	}

	function set_password()
	{
		if($this->uri->segment(3))
		{
			$reset_token = $this->uri->segment(3);
			$data['email'] = $this->login_model->verify_email($reset_token);
			if($data['email'])
			{
				$data['message'] = '<h1 align="center">Your password has been successfully reset, now you can set new password';
			}
			else
			{
				$data['message'] = '<h1 align="center">Invalid Link</h1>';
			}
			$this->load->view('set_password', $data);
		}
	}

	function update_password()
	{
		$data['password'] = $this->encryption->encrypt($this->input->post('password'));
		$this->login_model->update($this->input->post('email'), $data);
		$this->load->view('login');
	}

}


