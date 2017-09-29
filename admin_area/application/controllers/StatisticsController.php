<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class StatisticsController extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		date_default_timezone_set("Asia/Kolkata"); 
		if ($this->session->userdata('alogin')!=1){
			redirect(base_url());
		}
	}

	public function index(){
		$page_data['title']	= 'Statistcs';
		$page_data['menu_active'] = 'stats';
		$this->db->select('name,view_count');
		$this->db->from('products_tbl');
		$this->db->where('isdelete',0);
		$page_data['ArrProducts'] =	$this->db->get()->result_array();
		$this->load->view('statistics',$page_data);
	}

	public function site_settings(){
		$page_data['title']	= 'Settings';
		$page_data['menu_active'] = 'stats';
		$page_data['site_data'] 	= $this->db->get('site_settings_tbl')->result_array();
		$this->load->view('settings',$page_data);
	}

	public function save_settings()
	{
		$this->form_validation->set_rules('site_title', 'Site Title', 'required');
		$this->form_validation->set_rules('site_meta', 'Site Meta Description', 'required');
		$this->form_validation->set_rules('site_keywords', 'Site Meta Keywords', 'required');
		if ($this->form_validation->run() == FALSE) {
			$page_data['title'] 		= 'Settings';
			$page_data['menu_active'] 	= 'stats';
			$this->load->view('settings',$page_data);
		} else {
			$data['site_title'] 		= $this->input->post('site_title');
			$data['site_meta_desc'] 	= $this->input->post('site_meta');
			$data['site_meta_keywords'] = $this->input->post('site_keywords');
			$this->db->where('id','1');
			$result = $this->db->update('site_settings_tbl',$data);
			if ($result){
				$this->session->set_flashdata('msg', 'Settings Saved');
				redirect('backend/settings');
			}
		}
	}
} 
?>