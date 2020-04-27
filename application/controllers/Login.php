<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('id'))
		{
			redirect('private_area');
		}
		$this->load->library('form_validation');
		$this->load->library('encryption');
		$this->load->model('login_model');
	}

	function index()
	{
		$this->load->view('login');
	}

	function validation()
	{
		$this->form_validation->set_rules('user_email', 'Email Address', 'required|trim|valid_email');
		$this->form_validation->set_rules('user_password', 'Password', 'required');
		if($this->form_validation->run())
		{
			$result = $this->login_model->can_login($this->input->post('user_email'), $this->input->post('user_password'));
			if($result == '')
			{
				redirect('private_area');
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
		$this->form_validation->set_rules('user_email', 'Email Address', 'required|trim|valid_email');
		if($this->form_validation->run())
		{
			$result = $this->login_model->can_reset_password($this->input->post('user_email'));
			if($result === '')
			{
				$reset_token = md5(rand());
				$data = array(
					'reset_token'  => $reset_token
				);
				$this->login_model->update($this->input->post('user_email'), $data);
				$subject = "Please verify email for login";
				$message = "
<p>Hi " . $this->input->post('user_name') . "</p>
<p>This is email reset password from car auction system. For reset your password, please click this  <a href='" . base_url() . "login/set_password/" . $reset_token . "'>link</a>.</p>
<p>Once you click this link, you are able to reset your password</p>
<p>Thanks,</p>
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
				$this->email->to($this->input->post('user_email'));
				$this->email->subject($subject);
				$this->email->message($message);
				if ($this->email->send()) {
					$this->session->set_flashdata('message', 'A link to reset your password has been setn to '
						. $this->input->post('user_email')
						.'. If you do not see it, be sure to check your span folders too');
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
		$data['password'] = $this->encryption->encrypt($this->input->post('user_password'));
		$this->login_model->update($this->input->post('user_email'), $data);
		$this->load->view('login');
	}
}

