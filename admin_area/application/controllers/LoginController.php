<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		date_default_timezone_set("Asia/Kolkata"); 

	}

	public function index()
	{
		$data = array('title' =>'Login');
		$this->load->view('login',$data);
	}

	public function doLogin()
	{
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if ($this->form_validation->run() == FALSE) {
			$data = array('title' =>'Login');
			$this->load->view('login',$data);
		} else {
			$this->load->library('PasswordHash');
			$username 	 = $this->input->post('username');
			$password 	 = $this->input->post('password');
			$credentials = array('name' => $username);
			$query = $this->db->get_where('users_tbl', $credentials);
			if ($query->num_rows() > 0) {
				$row = $query->row();
				if ($this->passwordhash->CheckPassword($password, $row->password)) {
					$this->session->set_userdata('alogin', '1');
					$this->session->set_userdata('id', $row->id);
					$this->session->set_userdata('name', $row->username);
					redirect('dashboard');
				} else {
					$this->session->set_flashdata('loginfail','Incorrect username & Password');
					redirect(base_url());
				}
			}
			else{
				$this->session->set_flashdata('loginfail','Incorrect username & Password');
				redirect(base_url());	
			}
		}
	}

	public function dashboard()
	{
		if ($this->session->userdata('alogin')!=1){
			redirect(base_url());
		}
		$page_data['title'] = 'Dashboard';
		$page_data['menu_active'] 	= 'Dashboard';
		$this->load->view('dashboard',$page_data);
	}

	public function logout()
	{
		$this->session->unset_userdata();
		$this->session->sess_destroy();
		$this->session->set_flashdata('logout_notification', 'logged_out');
		redirect(base_url());
	}
}
