<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CommController extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		date_default_timezone_set("Asia/Kolkata"); 
		if ($this->session->userdata('alogin')!=1){
			redirect(base_url());
		}
	}

	public function contact_index()	{
		$page_data['title']			= 'Contacts';
		$page_data['menu_active'] 	= 'contacts';
		$this->db->where('isdelete', 0);
		$page_data['ArrContacts'] 	= $this->db->get('contactus_tbl')->result_array();
		$this->load->view('contacts',$page_data);
	}

	public function enquiry_index()	{
		$page_data['title']			= 'Enquiries';
		$page_data['menu_active'] 	= 'enquiries';
		$this->db->where('isdelete', 0);
		$page_data['ArrContacts'] 	= $this->db->get('contactus_tbl')->result_array();
		$this->load->view('enquiries',$page_data);
	}
	
	/*public function delete_cat($id='') {
		$isdelete = array('isdelete' => 1);
		$this->db->where('id', $id);
		$this->db->update('category_tbl', $isdelete);
		$this->session->set_flashdata('msg', 'Category Deleted');
		redirect('backend/category');
	}*/
}
