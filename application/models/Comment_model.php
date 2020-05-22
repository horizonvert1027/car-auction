<?php
class Comment_model extends CI_Model
{
	function get($product_id)
	{
		$query = $this->db->select("*")
			->from('comment')
			->where('product_id', $product_id)
			->join('user', 'user.id = comment.user_id')
			->get();
		$comments = $query->result_array();
		return $comments;
	}

	function insert($data)
	{
		$this->db->insert('comment', $data);
		return $this->db->insert_id();
	}
}
