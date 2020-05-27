<?php
class Register_model extends CI_Model
{
	function insert($data)
	{
		$this->db->insert('user', $data);
		return $this->db->insert_id();
	}

	// Verify email
	function verify_email($key)
	{
		$this->db->where('verify_key', $key);
		$this->db->where('verification', false);
		$query = $this->db->get('user');
		if($query->num_rows() > 0)
		{
			$data = array(
				'verification'  => true
			);
			$this->db->where('verify_key', $key);
			$this->db->update('user', $data);
			return true;
		}
		else
		{
			return false;
		}
	}
}
