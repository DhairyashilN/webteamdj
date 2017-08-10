<?php 
class Product_model extends CI_Model {
        public function store_product() {
                $data['name']           = $this->input->post('product_name');
                $data['url']            = $this->input->post('product_url');
                $data['category']       = $this->input->post('product_category');
                $data['description']    = $this->input->post('product_desc');
                $data['quantity']       = $this->input->post('product_quant');
                $data['isvisible']      = $this->input->post('product_visible');
                $data['out_of_stock']   = $this->input->post('product_ofs');
                if ($this->input->post('p_id')) {
                        $this->db->trans_start();
                        $this->db->where('id',$this->input->post('p_id'));
                        $this->db->update('products_tbl', $data);
                        /*echo('<pre>');print_r($_FILES['product_image']['name']);
                        if($_FILES['product_image']['name'][0] == ''){ echo 'emprty';} else{ echo 'not empty';}die;*/
                        if(!empty($_FILES['product_image']['name'][0])){
                                // echo 'set';die;
                                $target_dir = '../assets/images/spares/';
                                $extension=array("jpeg","jpg","png","gif");
                                foreach($_FILES["product_image"]["tmp_name"] as $key=>$tmp_name){
                                        $file_name = date('His').$_FILES["product_image"]["name"][$key];
                                        $file_tmp  = $_FILES["product_image"]["tmp_name"][$key];
                                        $ext = pathinfo($file_name,PATHINFO_EXTENSION);
                                        if(in_array($ext,$extension))
                                        {
                                                move_uploaded_file($_FILES["product_image"]["tmp_name"][$key],$target_dir.$file_name);
                                                $idata['product_id'] = $this->input->post('p_id');
                                                $idata['image'] = $target_dir.$file_name;
                                                $this->db->where('product_id',$this->input->post('p_id'));
                                                $this->db->update('productimages_tbl',$idata);
                                        }else{
                                                echo 'not image';
                                        }
                                }
                        }else{
                                $this->db->where('product_id',$this->input->post('p_id'));
                                $pimages = $this->db->get('productimages_tbl')->result_array();
                                foreach ($pimages as $value) {
                                        $image['image'] = $value['image'];
                                        $this->db->update('productimages_tbl',$image);
                                }
                        }if($this->db->trans_status() === FALSE){
                                return $this->db->trans_rollback();
                        }else{
                                return $this->db->trans_complete();
                        }
                } else {
                        $this->db->trans_start();
                        $this->db->insert('products_tbl', $data);
                        $insert_id = $this->db->insert_id();
                        if(isset($_FILES['product_image'])){
                                $target_dir = '../assets/images/spares/';
                                $extension=array("jpeg","jpg","png","gif");
                                foreach($_FILES["product_image"]["tmp_name"] as $key=>$tmp_name){
                                        $file_name = date('His').$_FILES["product_image"]["name"][$key];
                                        $file_tmp  = $_FILES["product_image"]["tmp_name"][$key];
                                        $ext = pathinfo($file_name,PATHINFO_EXTENSION);
                                        if(in_array($ext,$extension))
                                        {
                                                move_uploaded_file($_FILES["product_image"]["tmp_name"][$key],$target_dir.$file_name);
                                                $idata['product_id'] = $insert_id;
                                                $idata['image'] = $target_dir.$file_name;
                                                $this->db->insert('productimages_tbl',$idata);
                                        }else{
                                                echo 'not image';
                                        }
                                }
                        }if($this->db->trans_status() === FALSE){
                                return $this->db->trans_rollback();
                        }else{
                                return $this->db->trans_complete();
                        }
                }
        }
}
?>