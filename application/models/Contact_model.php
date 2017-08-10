<?php 
class Contact_model extends CI_Model {
        public function add_contact() {
                $data['contact_name']     = $this->input->post('name');
                $data['contact_email']    = $this->input->post('email');
                $data['contact_no']       = $this->input->post('phone');
                $data['contact_message']  = $this->input->post('message');
                return $this->db->insert('contactus_tbl', $data);
        }

        public function add_enquiry() {
                print_r($_POST[]);die;
                $data['name'] = $this->input->post('name');
                $data['email'] = $this->input->post('email');
                $data['contact_no'] = $this->input->post('phone');
                $data['message'] = $this->input->post('message');
                $data['product_id'] = $this->input->post('pid');
                return $this->db->insert('enquiries_tbl', $data);
        }
}
?>