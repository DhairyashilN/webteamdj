<?php 
class Category_model extends CI_Model {
        public $type;
        public $category;
        public $category_type;

        public function store_cat_type() {
                if ($this->input->post('type_id')) {
                        $this->type = $this->input->post('cat_type_name');
                        $this->db->where('id', $this->input->post('type_id'));
                        return $this->db->update('cat_types_tbl', $this);
                } else {
                        $this->type = $this->input->post('cat_type_name');
                        return $this->db->insert('cat_types_tbl', $this);
                }
        }

        public function store_category() {
                if ($this->input->post('cat_id')) {
                        $data['category']         = $this->input->post('cat_name');
                        $data['category_type']    = $this->input->post('cat_type');
                        $this->db->where('id', $this->input->post('cat_id'));
                        return $this->db->update('category_tbl', $data);
                } else {
                        $data['category']         = $this->input->post('cat_name');
                        $data['category_type']    = $this->input->post('cat_type');
                        return $this->db->insert('category_tbl', $data);
                }
        }
}
?>