<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ProfileController extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		if ($this->session->userdata('alogin')!=1){
			redirect(base_url());
		}  
	}
	
	public function index()
	{
		$page_data['menu_active'] 	= 'Dashboard';
		$page_data['title']			= 'Profile Settings';
		$username = lookup_value('users_tbl', 'name',array('id'=>$this->session->userdata('id')));
		$page_data['username']	= $username;
		$this->load->view('profile',$page_data);
	}

	public function update_profile()
	{
		$this->load->library('PasswordHash');
		$password 	  = $this->input->post('password');
		$cpassword	  = $this->input->post('cpassword');
		$data['name'] = $this->input->post('username');
		$old_pass = lookup_value('users_tbl','password',array('id'=>$this->session->userdata('id')));
		if($password == ""){
			echo json_encode(['error'=>1]);
		} else if($password != $cpassword){
			echo json_encode(['error'=>1]);
		} else {
			$data['password'] = $this->passwordhash->HashPassword($password);
			$this->db->where('id',$this->session->userdata('id'));
			$this->db->update('users_tbl',$data);
			echo json_encode(['success'=>1]);
		}
	}
}
/* End of file Payout.php */
/* Location: ./application/controllers/Payout.php */
