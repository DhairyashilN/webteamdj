<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductController extends CI_Controller {

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

	public function index(){
		$page_data['title']			= 'Products';
		$page_data['menu_active'] 	= 'cattype';
		$this->db->where('isdelete', 0);
		$page_data['ArrProducts'] 	= $this->db->get('products_tbl')->result_array();
		$page_data['ArrProductsImages'] = $this->db->get('productimages_tbl')->result_array();
		$this->load->view('products',$page_data);
	}

	public function create(){
		$page_data['title'] 		= 'Add Product';
		$page_data['menu_active'] 	= 'cattype';
		$this->db->where('category_type', '1');
		$page_data['ArrCategory'] 	=	$this->db->get('category_tbl')->result_array();
		$this->load->view('add_product',$page_data);
	}

	public function store_product(){
		$this->form_validation->set_rules('product_name', 'Product Name', 'required');
		$this->form_validation->set_rules('product_category', 'Product Category', 'required');
		$this->form_validation->set_rules('product_desc', 'Product Description', 'required');
		$this->form_validation->set_rules('product_quant', 'Product Quantity', 'required');
		$this->form_validation->set_rules('product_visible', 'Is Visible', 'required');
		$this->form_validation->set_rules('product_ofs', 'Product Out of Stock', 'required');
		if ($this->form_validation->run() == FALSE) {
			$page_data['title'] 		= 'Add Product';
			$page_data['menu_active'] 	= 'cattype';
			$this->db->where('category_type', '1');
			$page_data['ArrCategory'] 	=	$this->db->get('category_tbl')->result_array();
			$this->load->view('add_product',$page_data);
		} else {
			$this->load->model('Product_model');
			if (!empty($this->input->post('p_id'))) {
				$result = $this->Product_model->store_product();
				if ($result) {
					$this->session->set_flashdata('msg', 'Product Added');
					redirect('backend/products');
				}
			} else {
				$result = $this->Product_model->store_product();
				if ($result) {
					$this->session->set_flashdata('msg', 'Product Added');
					redirect('backend/products');
				}
			}
		}
	}

	public function edit($id='') {
		$page_data['title'] = 'Edit Product';
		$page_data['menu_active'] = 'cattype';
		$this->db->where('category_type','1');
		$page_data['ArrCategory'] =	$this->db->get('category_tbl')->result_array();
		$this->db->where('id',$id);
		$page_data['ObjProduct'] = $this->db->get('products_tbl')->result();
		$this->db->where('product_id',$id);
		$page_data['ArrProductImage'] =	$this->db->get('productimages_tbl')->result_array();
		$this->load->view('add_product',$page_data);
	}

	public function delete($id='') {
		$isdelete = array('isdelete'=>1);
		$this->db->where('id',$id);
		$this->db->update('products_tbl',$isdelete);
		$this->db->where('product_id',$id);
		$this->db->update('productimages_tbl',$isdelete);
		$this->session->set_flashdata('msg','Product Deleted');
		redirect('backend/products');
	}
}
