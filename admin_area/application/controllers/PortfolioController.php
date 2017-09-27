<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class PortfolioController extends CI_Controller{
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
		$page_data['title']	= 'Portfolio';
		$page_data['menu_active'] = 'pages';
		$this->db->where('isdelete', 0);
		$page_data['ArrPortfolio'] = $this->db->get('portfolio_tbl')->result_array();
		$this->db->select('id,category');
		$this->db->from('category_tbl');
		$this->db->where('category_type',3);
		$this->db->where('isdelete',0);
		$page_data['ArrCategory'] =	$this->db->get()->result_array();
		$this->load->view('portfolios',$page_data);
	}

	public function create(){
		$page_data['title'] = 'Add Portfolio';
		$page_data['menu_active'] = 'pages';
		$this->db->where('category_type',3);
		$page_data['ArrCategory'] =	$this->db->get('category_tbl')->result_array();
		$this->load->view('add_portfolio',$page_data);
	}

	public function store_portfolio(){
		$this->form_validation->set_rules('pof_name','Name','required');
		$this->form_validation->set_rules('pof_url','URL','required');
		$this->form_validation->set_rules('pof_category','Category','required');
		$this->form_validation->set_rules('pof_desc','Description','required');
		$this->form_validation->set_rules('pof_cname','Customer Name','required');
		$this->form_validation->set_rules('pof_creview','Customers Review','required');
		if ($this->form_validation->run() == FALSE) {
			echo validation_errors();die;
			$page_data['title'] = 'Add Portfolio';
			$page_data['menu_active'] = 'pages';
			$this->db->where('category_type',3);
			$page_data['ArrCategory'] =	$this->db->get('category_tbl')->result_array();
			$this->load->view('add_portfolio',$page_data);
		} else {
			$this->load->model('Portfolio_model');
			if (!empty($this->input->post('pof_id'))){
				$result = $this->Portfolio_model->store_portfolio();
				if ($result){
					$this->session->set_flashdata('msg', 'Portfolio Updated');
					redirect('backend/portfolio');
				}
			}else{
				$result = $this->Portfolio_model->store_portfolio();
				if ($result){
					$this->session->set_flashdata('msg', 'Portfolio Added');
					redirect('backend/portfolio');
				}
			}
		}
	}

	public function edit($id){
		$page_data['title'] = 'Edit Portfolio';
		$page_data['menu_active'] = 'pages';
		$this->db->where('id',$id);
		$page_data['ObjPortfolio'] = $this->db->get('portfolio_tbl')->result();
		$this->db->where('category_type',3);
		$page_data['ArrCategory'] =	$this->db->get('category_tbl')->result_array();
		$this->db->where('portfolio_id',$id);
		$page_data['ArrPortfolioImage'] = $this->db->get('portfolioimages_tbl')->result_array();
		$this->load->view('add_portfolio',$page_data);	
	}

	public function delete($id){
		$this->db->where('id',$id);
		$this->db->trans_start();
		$this->db->update('portfolio_tbl',['isdelete'=>1]);
		$this->db->where('portfolio_id',$id);
		$this->db->update('portfolioimages_tbl',['isdelete'=>1]);
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
		}else{
			$this->db->trans_complete();
			$this->session->set_flashdata('msg', 'Portfolio Deleted');
			redirect('backend/portfolio');
		}
	}

	public function remove_portfolio_image(){
		$this->db->where('id',$this->input->post('image'));
		$this->db->where('portfolio_id',$this->input->post('portfolio'));
		$this->db->trans_start();
		$this->db->delete('portfolioimages_tbl');
		if (file_exists("../assets/images/portfolio/".$this->input->post('image_name'))) {
			unlink("../assets/images/portfolio/".$this->input->post('image_name'));
		}
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
		}else{
			$this->db->trans_complete();
			echo json_encode(['success'=>1]);
		}
	}
} 
?>