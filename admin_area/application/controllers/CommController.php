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
		$this->db->select('id,name');
		$this->db->from('products_tbl');
		$this->db->where('isdelete','0');
		$page_data['ArrProduct'] = $this->db->get()->result_array();
		$this->db->where('isdelete', 0);
		$page_data['ArrEnquiries'] 	= $this->db->get('enquiries_tbl')->result_array();
		$this->load->view('enquiries',$page_data);
	}
	
	public function view_enquiry($id){
		$page_data['title']			= 'View Enquiry';
		$page_data['menu_active'] 	= 'enquiries';
		$this->db->where('id', $id);
		$page_data['ObjEnquiry'] 	= $this->db->get('enquiries_tbl')->result();
		$this->load->view('view_enquiry',$page_data);
	}
	
	public function add_order(){
		$enquiry_id = $this->input->post('enquiry_id');
		$order_date = $this->input->post('order_date');
		$order_quantity = $this->input->post('order_quant');
		$this->db->trans_start();
		$this->db->where('id', $enquiry_id);
		$result = $this->db->update('enquiries_tbl', array('order_delivery_date'=>$order_date,'order_quantity'=>$order_quantity,'is_order_placed'=>1));
		$product_quantity = lookup_value('products_tbl', 'quantity',array('id'=>$this->input->post('product_id')));
		if($product_quantity == 0){
			echo json_encode(['out_of_stock'=>1]);
		}else{ 
			$updated_quantity = $product_quantity - $order_quantity;
			$this->db->where('id',$this->input->post('product_id'));
			$result = $this->db->update('products_tbl', array('quantity'=>$updated_quantity));
			if($this->db->trans_status() === FALSE){
				$this->db->trans_rollback();
				echo json_encode(['error'=>1]);
			}else{
				$this->db->trans_complete();
				echo json_encode(['success'=>1]);
			}
		}
		
		/*if ($result) {
			
		}else{
		}*/
	}
}
