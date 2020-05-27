<?php
class Cart_model extends CI_Model
{
	function get()
	{
		$query = $this->db->get('cart');
		$carts = $query->result_array();
		return $carts;
	}

	// Get cart of current user
	function getByUser() {
		$query = $this->db->where("user_id", $this->session->get_userdata()['id'])->where("status", "in_progress")->get('cart');
		return $query->result_array()[0];
	}

	function insert($data)
	{
		$this->db->insert('cart', $data);
		return $this->db->insert_id();
	}
}
