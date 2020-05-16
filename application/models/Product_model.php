<?php
class Product_model extends CI_Model
{
	function get()
	{
		$query = $this->db->get('product');
		$products = $query->result_array();
		return $products;
	}

	function getByName($name) {
		$query = $this->db->like("name", $name)->get('product');
//		$products = $query->result_array();
		return $query;
	}

	function insert($data)
	{
		$this->db->insert('product', $data);
		return $this->db->insert_id();
	}
}
