<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	// Log user in
	public function login($data){
		$this->db->select('id');
		$query = $this->db->get_where('users', $data);
		if($query->num_rows() == 1){
			return $query->row()->id;
		} else {
			return false;
		}
	}

}

/* End of file Users_model.php */
/* Location: ./application/models/Users_model.php */