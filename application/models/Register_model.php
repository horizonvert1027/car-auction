<?php
class Register_model extends CI_Model
{
	function insert($data)
	{
		$this->db->insert('user', $data);
		return $this->db->insert_id();
	}

	function verify_email($key)
	{
		$this->db->where('verify_key', $key);
		$this->db->where('is_email_verified', false);
		$query = $this->db->get('user');
		if($query->num_rows() > 0)
		{
			$data = array(
				'is_email_verified'  => true
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
