<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class EventController extends CI_Controller{
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
		$page_data['title']	= 'Events';
		$page_data['menu_active'] = 'pages';
		$this->db->where('isdelete', 0);
		$page_data['ArrEvents'] = $this->db->get('events_tbl')->result_array();
		$this->db->select('id,category');
		$this->db->from('category_tbl');
		$this->db->where('isdelete',0);
		$page_data['ArrCategory'] =	$this->db->get()->result_array();
		$this->load->view('events',$page_data);
	}

	public function create(){
		$page_data['title'] = 'Add Event';
		$page_data['menu_active'] = 'pages';
		$this->db->where('category_type', '2');
		$page_data['ArrCategory'] =	$this->db->get('category_tbl')->result_array();
		$this->load->view('add_event',$page_data);
	}

	public function store_event(){
		$this->form_validation->set_rules('event_name','Event Name','required');
		$this->form_validation->set_rules('event_category','Event Category','required');
		$this->form_validation->set_rules('event_desc','Event Category','required');
		if ($this->form_validation->run() == FALSE) {
			$page_data['title'] = 'Add Event';
			$page_data['menu_active'] = 'pages';
			$this->db->where('category_type', '2');
			$page_data['ArrCategory'] =	$this->db->get('category_tbl')->result_array();
			$this->load->view('add_event',$page_data);
		} else {
			$this->load->model('Event_model');
			if (!empty($this->input->post('event_id'))) {
				$result = $this->Event_model->store_event();
				if ($result) {
					$this->session->set_flashdata('msg', 'Event Updated');
					redirect('backend/events');
				}
			} else {
				$result = $this->Event_model->store_event();
				if ($result) {
					$this->session->set_flashdata('msg', 'Event Added');
					redirect('backend/events');
				}
			}
		}
	}

	public function edit($id){
		$page_data['title'] = 'Edit Event';
		$page_data['menu_active'] = 'pages';
		$this->db->where('id', $id);
		$page_data['ObjEvent'] = $this->db->get('events_tbl')->result();
		$this->db->where('category_type', '2');
		$page_data['ArrCategory'] =	$this->db->get('category_tbl')->result_array();
		$this->db->where('event_id', $id);
		$page_data['ArrEventImage'] =	$this->db->get('eventimages_tbl')->result_array();
		$this->load->view('add_event',$page_data);	
	}

	public function delete($id){
		$this->db->where('id',$id);
		$this->db->trans_start();
		$this->db->update('events_tbl',['isdelete'=>1]);
		$this->db->where('event_id',$id);
		$this->db->update('eventimages_tbl',['isdelete'=>1]);
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
		}else{
			$this->db->trans_complete();
			$this->session->set_flashdata('msg', 'Event Deleted');
			redirect('backend/events');
		}
	}

	public function remove_event_image(){
		$this->db->where('id',$this->input->post('image'));
		$this->db->where('event_id',$this->input->post('event'));
		$this->db->trans_start();
		$this->db->delete('eventimages_tbl');
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
		}else{
			$this->db->trans_complete();
			echo json_encode(['success'=>1]);
		}
	}


} 
?>