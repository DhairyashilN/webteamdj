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
		$this->load->view('settings',$page_data);
	}
} 
?>