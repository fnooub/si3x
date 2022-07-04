<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function get_total()
	{
		return $this->db->count_all('posts');
	}

	public function get_post_by_id($id)
	{
		$this->db->select('*');
		$this->db->from('posts');
		$this->db->where('id', $id);
		return $this->db->get()->row_array();
	}
	public function get_post_by_slug($slug)
	{
		$this->db->select('*');
		$this->db->from('posts');
		$this->db->where('slug', $slug);
		return $this->db->get()->row_array();
	}

	public function get_posts($limit = null, $offset = 0, $order_by = array('ngaysua', 'DESC'))
	{
		$this->db->select('*');
		$this->db->from('posts');
		$this->db->order_by($order_by[0], $order_by[1]);
		$this->db->limit($limit, $offset);

		return $this->db->get()->result_array();
	}

	public function search($tukhoa)
	{
		$this->db->select('*');
		$this->db->from('posts');
		$this->db->like('slug', $tukhoa);
		$this->db->order_by('ngaysua', 'desc');
		return $this->db->get()->result_array();
	}

	public function create($data)
	{
		$this->db->insert('posts', $data);
		return $this->db->insert_id();
	}

	public function update($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('posts', $data);
	}

	public function delete($id)
	{
		$this->db->delete('posts', array('id' => $id));
	}
}

/* End of file Posts_model.php */
/* Location: ./application/models/Posts_model.php */