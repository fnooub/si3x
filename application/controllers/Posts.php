<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('posts_model');
		$this->load->helper(array('site', 'form'));
		$this->load->library(array('paginator', 'form_validation'));
	}

	public function index()
	{
		$data['title'] = 'Trang chu';
		$current_page = (int) $this->input->get('trang', TRUE);
		$config['current_page'] = isset($current_page) ? $current_page : 1;
		$config['total_rows'] = $this->posts_model->get_total();
		$config['base_url'] = base_url('posts?trang=(:num)');
		$config['per_page'] = 1;
		$config['num_links'] = 12;
		$config['next_link'] = 'Sau';
		$config['prev_link'] = 'Trước';
		$this->paginator->initialize($config);

		$start_row = $this->paginator->get_start_row();
		$data['posts'] = $this->posts_model->get_posts(1, $start_row);
		$data['pagination'] = $this->paginator->create_links();

		$this->load->view('templates/header', $data);
		$this->load->view('posts/index');
		$this->load->view('templates/footer');

	}

	public function detail()
	{
		$id = $this->uri->rsegment(3);
		$post = $this->posts_model->get_post_by_id($id);
		if (!$post) show_404();

		$nd = file_get_contents($post['noidung']);

		$data = explode("[nextpage]", $nd);
		array_shift($data);

		foreach ($data as $key => $value) {
			preg_match('/\[chuong\](.*?)\[\/chuong\]/', $value, $chuong);
			$tds[] = $chuong[1];
		}

		$data['title'] = $post['tieude'];
		$data['posts'] = $tds;
		$data['id'] = $id;
		$this->load->view('templates/header', $data);
		$this->load->view('posts/detail');
		$this->load->view('templates/footer');
	}

	public function chap()
	{
		$id = $this->uri->rsegment(3);
		$post = $this->posts_model->get_post_by_id($id);
		if (!$post) show_404();

		$nd = file_get_contents($post['noidung']);

		$data = explode("[nextpage]", $nd);
		array_shift($data);
		$total = count($data);

		$current_page = isset($_GET['c']) ? $_GET['c'] : 1;

		$dulieu = array_slice( $data, ($current_page - 1) * 1, 1 );


		preg_match('/\[chuong\](.*?)\[\/chuong\]/', $dulieu[0], $chuong);
		preg_match('#\[nd\](.*?)\[\/nd\]#is', $dulieu[0], $nd2);
		$nds = array('td' => $chuong[1], 'nd' => nl2p($nd2[1]));
		// nếu page > 1 và total > 1 mới hiển thị nút prev
		if ($current_page > 1 && $total > 1)
		{
			$data['tt'] = '<a href="' . base_url() . 'posts/chap/' . $id . '?c=' . ($current_page - 1) . '">Trang trước</a>';
		}
		// nếu page < $total và total > 1 mới hiển thị nút prev
		if ($current_page < $total && $total > 1)
		{
			$data['ts'] = '<a href="' . base_url() . 'posts/chap/' . $id . '?c=' . ($current_page + 1) . '">Trang sau</a>';
		}
		$data['title'] = $post['tieude'];
		$data['post'] = $nds;
		$data['id'] = $id;
		$this->load->view('templates/header', $data);
		$this->load->view('posts/chap');
		$this->load->view('templates/footer');

	}

	public function search()
	{
		if ($tukhoa = $this->input->get('tukhoa', TRUE)) {
			$data['posts'] = $this->posts_model->search(slug($tukhoa));

			$data['title'] = 'Tim kiem';
			$this->load->view('templates/header', $data);
			$this->load->view('posts/search');
			$this->load->view('templates/footer');
		} else {
			show_404();
		}

	}

	public function add()
	{
		if (!$this->session->userdata('logged_in')) redirect();

		//$this->form_validation->set_rules('tieude', 'Tieu de', 'required');
		$this->form_validation->set_rules('noidung', 'Noi dung', 'required');
		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Them';
			$this->load->view('templates/header', $data);
			$this->load->view('posts/add');
			$this->load->view('templates/footer');
		} else {
			//$tieude = trim($this->input->post('tieude'));
			$noidung = trim($this->input->post('noidung'));
			preg_match('/\[td\]\s*(.*?)\s*\[\/td\]/', file_get_contents($noidung), $td);
			$slug = slug($td[1]);

			// them bai viet
			$database = array(
				'tieude' => $td[1],
				'slug' => $slug,
				'noidung' => $noidung,
				'ngaysua' => time()
			);
			$post_id = $this->posts_model->create($database);

			// gui thong bao thanh cong
			$this->session->set_flashdata('success', 'Them thanh cong!');
			redirect(current_url());
		}

	}

	public function edit()
	{
		if (!$this->session->userdata('logged_in')) redirect();
		$id = $this->uri->rsegment(3);
		$this->form_validation->set_rules('tieude', 'Tieu de', 'required');
		$this->form_validation->set_rules('noidung', 'Noi dung', 'required');
		if ($this->form_validation->run() == FALSE) {
			$data['post'] = $this->posts_model->get_post_by_id($id);
			if (!$data['post']) show_404();
			$data['title'] = 'Sua';
			$this->load->view('templates/header', $data);
			$this->load->view('posts/edit');
			$this->load->view('templates/footer');
		} else {
			$tieude = trim($this->input->post('tieude'));
			$noidung = trim($this->input->post('noidung'));
			$slug = slug($tieude);

			// them bai viet
			$database = array(
				'tieude' => $tieude,
				'slug' => $slug,
				'noidung' => $noidung,
				'ngaysua' => time()
			);
			$this->posts_model->update($id, $database);

			// gui thong bao thanh cong
			$this->session->set_flashdata('success', 'Them thanh cong!');
			redirect(current_url());
		}

	}

	public function delete()
	{
		if (!$this->session->userdata('logged_in')) redirect();
		$id = $this->uri->rsegment(3);
		if (!empty($id)) {
			// xoa
			$this->posts_model->delete($id);
			// gui thong bao thanh cong
			$this->session->set_flashdata('success', 'Xoa thanh cong!');
			redirect();
		} else {
			$this->session->set_flashdata('warning', 'Id không hợp lệ');
			redirect();
		}
	}

}

/* End of file Posts.php */
/* Location: ./application/controllers/Posts.php */