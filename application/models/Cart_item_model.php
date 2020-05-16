<?php
class Cart_item_model extends CI_Model
{
	function get()
	{
		$query = $this->db->get('cart_item');
		$carts = $query->result_array();
		return $carts;
	}

	function getByCart($cart_id) {
		$query = $this->db->where("cart_id", $cart_id)->get('cart_item');
		return $query->result_array();
	}

	function insert($data)
	{
		$this->db->insert('cart_item', $data);
		return $this->db->insert_id();
	}
}
