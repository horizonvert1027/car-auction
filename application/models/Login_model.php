<?php
class Login_model extends CI_Model
{
	function update($user_email, $data)
	{
		$this->db->where('email', $user_email);
		$this->db->update('user', $data);
	}


	function can_login($email, $password)
	{
		$this->db->where('email', $email);
		$query = $this->db->get('user');
		if($query->num_rows() > 0)
		{
			foreach($query->result() as $row)
			{
				if($row->is_email_verified == true)
				{
					$store_password = $this->encryption->decrypt($row->password);
					if($password == $store_password)
					{
						$this->session->set_userdata('id', $row->id);
					}
					else
					{
						return 'Wrong Password';
					}
				}
				else
				{
					return 'First verified your email address';
				}
			}
		}
		else
		{
			return 'Wrong Email Address';
		}
	}

	function can_reset_password($email)
	{
		$this->db->where('email', $email);
		$query = $this->db->get('user');
		if($query->num_rows() > 0)
		{
			return '';
		}
		else
		{
			return "The email does not exist";
		}
	}

	function verify_email($key)
	{
		$this->db->where('reset_token', $key);
		$query = $this->db->get('user');
		if($query->num_rows() > 0)
		{
			return $query->row()->email;
		}
		else
		{
			return null;
		}
	}
}
