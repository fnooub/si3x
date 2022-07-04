<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('users_model');
	}

	public function index()
	{
		redirect('users/login');
	}

	public function dashboard()
	{
		echo "string";
	}

	public function login()
	{
		// kiểm tra đăng nhập
		if ($this->session->userdata('logged_in')) redirect('users/dashboard');

		$data['title'] = 'Đăng nhập';
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if ($this->form_validation->run() == FALSE) {
			//form empty or validation failed
			$this->load->view('templates/header', $data);
			$this->load->view('users/login');
			$this->load->view('templates/footer');
		} else {
			$database = array(
				'username' => $this->input->post('username'),
				'password' => md5($this->input->post('password'))
			);
			$user_id = $this->users_model->login($database);
			if ($user_id) {
				// Tao session
				$user_data = array(
					'user_id' => $user_id,
					'logged_in' => true
				);
				$this->session->set_userdata($user_data);
				// Set message
				$this->session->set_flashdata('success', 'Bạn đã đăng nhập');
				redirect('users/dashboard');
			} else {
				$this->session->set_flashdata('warning', 'Username hoac mat khau khong dung!');
				redirect('users/login');
			}
		}
	}


	// Log user out
	public function logout(){
		if (!$this->session->userdata('logged_in')) redirect();
		// Unset user data
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('user_id');
		// Set message
		$this->session->set_flashdata('success', 'Bạn đã đăng xuat');
		redirect('users/login');
	}

}

/* End of file Users.php */
/* Location: ./application/controllers/admin/Users.php */