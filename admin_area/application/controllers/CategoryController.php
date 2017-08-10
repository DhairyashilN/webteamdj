<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoryController extends CI_Controller {

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

	public function index()	{
		$page_data['title']			= 'Category Type';
		$page_data['menu_active'] 	= 'cattype';
		$this->db->where('isdelete', 0);
		$page_data['ArrCatTypes'] 	=	$this->db->get('cat_types_tbl')->result_array();
		$this->load->view('category_type',$page_data);
	}

	public function create()
	{
		$page_data['title'] 		= 'Add Category Type';
		$page_data['menu_active'] 	= 'cattype';
		$this->load->view('add_category_type',$page_data);
	}

	public function store_cat_type() {
		$this->form_validation->set_rules('cat_type_name', 'Category Type Name', 'required');
		if ($this->form_validation->run() == FALSE) {
			echo validation_errors();
		} else {
			$this->load->model('Category_model');
			if (!empty($this->input->post('type_id'))) {
				$result = $this->Category_model->store_cat_type();
				if ($result) {
					echo json_encode(['update_success'=>1]);
				}
			} else {
				$result = $this->Category_model->store_cat_type();
				if ($result) {
					echo json_encode(['success'=>1]);
				}
			}
		}
	}

	public function edit($id='') {
		$this->db->where('id', $id);
		$page_data['ArrcatType'] 	= $this->db->get('cat_types_tbl')->result_array();
		$page_data['title'] 		= 'Add Category Type';
		$page_data['menu_active'] 	= 'cattype';
		$this->load->view('add_category_type',$page_data);

	}

	public function delete($id='') {
		$isdelete = array('isdelete' => 1);
		$this->db->where('id', $id);
		$this->db->update('cat_types_tbl', $isdelete);
		$this->session->set_flashdata('msg', 'Category Type Deleted');
		redirect('backend/category_type');
	}

	public function category_index() {
		$page_data['title']			= 'Category Type';
		$page_data['menu_active'] 	= 'cattype';
		$this->db->where('isdelete', 0);
		$page_data['ArrCategory'] 	=	$this->db->get('category_tbl')->result_array();
		$page_data['ArrCategoryType'] 	= $this->db->get('cat_types_tbl')->result_array();
		$this->load->view('category',$page_data);
	}

	public function create_category()
	{
		$page_data['title'] 		= 'Add Category';
		$page_data['menu_active'] 	= 'cattype';
		$page_data['ArrCategoryType'] 	= $this->db->get('cat_types_tbl')->result_array();
		$this->load->view('add_category',$page_data);
	}

	public function edit_category($id='') {
		$this->db->where('id', $id);
		$page_data['ArrCategory'] 		= $this->db->get('category_tbl')->result_array();
		$page_data['title'] 			= 'Add Category';
		$page_data['menu_active'] 		= 'cattype';
		$page_data['ArrCategoryType'] 	= $this->db->get('cat_types_tbl')->result_array();
		$this->load->view('add_category',$page_data);
	}

	public function store_category() {
		//print_r($this->input->post());die;
		$this->form_validation->set_rules('cat_name', 'Category Name', 'required');
		$this->form_validation->set_rules('cat_type', 'Category Type ', 'required');
		if ($this->form_validation->run() == FALSE) {
			echo validation_errors();
		} else {
			$this->load->model('Category_model');
			if (!empty($this->input->post('cat_id'))) {
				$result = $this->Category_model->store_category();
				if ($result) {
					echo json_encode(['update_success'=>1]);
				}
			} else {
				$result = $this->Category_model->store_category();
				if ($result) {
					echo json_encode(['success'=>1]);
				}
			}
		}
	}

	public function delete_cat($id='') {
		$isdelete = array('isdelete' => 1);
		$this->db->where('id', $id);
		$this->db->update('category_tbl', $isdelete);
		$this->session->set_flashdata('msg', 'Category Deleted');
		redirect('backend/category');
	}
}
