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
		$query = $this->db->select("product.id as product_id, cart_item.id, product.name, product.image, product.bid_price, product.description, cart_item.quantity")
			->from("cart_item")
			->where("cart_item.cart_id", $cart_id)
			->join('product', 'cart_item.product_id = product.id')
			->get();
		return $query->result_array();
	}

	function insert($data)
	{
		$cart_item = $this->db->from('cart_item')
			->where('cart_id', $data['cart_id'])
			->where('product_id', $data['product_id'])
			->get();
		if ($cart_item->num_rows() > 0)
			return;
		$this->db->insert('cart_item', $data);
		return $this->db->insert_id();
	}

	function update($data) {
		$this->db->update('cart_item', $data, array('id' => $data["id"]));
	}

	function delete($id) {
		$this->db->delete('cart_item', array('id' => $id));
	}
}
