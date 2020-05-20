<?php
class Product_model extends CI_Model
{
	function get()
	{
		$query = $this->db->get('product');
		$products = $query->result_array();
		return $products;
	}

	function getByName($name, $limit) {
		$query = $this->db->like("name", $name)->limit($limit)->get('product');
		return $query;
	}

	function insert($data)
	{
		$this->db->insert('product', $data);
		return $this->db->insert_id();
	}

	//get and return product rows
	public function getProducts($id = ''){
		$this->db->select('id,name,image,bid_price');
		$this->db->from('product');
		if($id){
			$this->db->where('id',$id);
			$query = $this->db->get();
			$result = $query->row_array();
		}else{
			$this->db->order_by('name','asc');
			$query = $this->db->get();
			$result = $query->result_array();
		}
		return !empty($result)?$result:false;
	}

	//insert transaction data
	public function storeTransaction($data = array()){
		$insert = $this->db->insert('payment',$data);
		return $insert?true:false;
	}
}
