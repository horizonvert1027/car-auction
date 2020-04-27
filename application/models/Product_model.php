<?php
class Product_model extends CI_Model
{
	function get()
	{
		$query = $this->db->get('product');
		$products = $query->result_array();
		return $products;
	}
}
