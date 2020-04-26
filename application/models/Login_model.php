<?php
class Login_model extends CI_Model
{
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
			return $query->row();
		}
		else
		{
			return null;
		}
	}
}
