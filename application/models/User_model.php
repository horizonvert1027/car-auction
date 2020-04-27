<?php
class User_model extends CI_Model
{
	function get($id)
	{
		$this->db->where('id', $id);
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

	function verify_email($key)
	{
		$this->db->where('verification_key', $key);
		$this->db->where('is_email_verified', false);
		$query = $this->db->get('user');
		if($query->num_rows() > 0)
		{
			$data = array(
				'is_email_verified'  => true
			);
			$this->db->where('verification_key', $key);
			$this->db->update('user', $data);
			return true;
		}
		else
		{
			return false;
		}
	}
}
