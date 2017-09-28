<?php 
class Product_model extends CI_Model {
        public function store_product() {
                $extension  = array("jpeg","jpg","png","gif","JPG","JPEG");
                $data['name']           = $this->input->post('product_name');
                $data['url']            = $this->input->post('product_url');
                $data['category']       = $this->input->post('product_category');
                $data['description']    = $this->input->post('product_desc');
                $data['quantity']       = $this->input->post('product_quant');
                $data['isvisible']      = $this->input->post('product_visible');
                $data['out_of_stock']   = $this->input->post('product_ofs');
                if (!empty($this->input->post('p_id'))) {
                        $this->db->trans_start();
                        if($_FILES['product_thumb_image']["error"] == 4){
                                $poster = lookup_value('products_tbl', 'thubnail_image',array('id'=>$this->input->post('p_id')));
                                $data['thubnail_image'] = $poster;
                                $this->db->where('id',$this->input->post('p_id'));
                                $this->db->update('products_tbl', $data);        
                        }else{
                                $target_dir = '../assets/images/spares/';
                                $file_name  = 'propo_'.date('His').$_FILES["product_thumb_image"]["name"];
                                $ext = pathinfo($file_name,PATHINFO_EXTENSION);
                                if(in_array($ext,$extension)){
                                        move_uploaded_file($_FILES["product_thumb_image"]["tmp_name"],$target_dir.$file_name);
                                        $data['thubnail_image'] = $target_dir.$file_name;
                                        $this->db->where('id',$this->input->post('p_id'));
                                        $this->db->update('products_tbl',$data);
                                }else{ echo 'not image';}    
                        }
                        for($i=0;$i<count($_FILES['product_image']['name']);$i++){
                                if($_FILES['product_image']["error"][$i] == 4){
                                        /*$poster = lookup_value('productimages_tbl', 'image',array('product_id'=>$this->input->post('p_id')));
                                        foreach ($poster as $key=>$value){
                                                $idata['image'] = $value; 
                                                $this->db->update_batch('productimages_tbl',$idata['image'],$this->input->post('p_id'));
                                        }*/
                                }else{
                                        $target_dir = '../assets/images/spares/';
                                        $file_name  = 'proimg_'.date('His').$_FILES["product_image"]["name"][$i];
                                        $ext = pathinfo($file_name,PATHINFO_EXTENSION);
                                        if($_FILES['product_image']['name'][$i]!=''){
                                                if(in_array($ext,$extension)){
                                                        if(move_uploaded_file($_FILES['product_image']['tmp_name'][$i],$target_dir.$file_name)){ 
                                                                $idata['product_id'] = $this->input->post('p_id');
                                                                $idata['image'] = $target_dir.$file_name;
                                                                $idata['image_name'] = $file_name;
                                                                $this->db->insert('productimages_tbl',$idata);   
                                                        }
                                                }
                                        }     
                                }
                        }
                }else{
                        if(isset($_FILES['product_thumb_image'])){
                                $target_dir = '../assets/images/spares/';
                                $extension  = array("jpeg","jpg","png","gif");
                                $file_name  = date('His').$_FILES["product_thumb_image"]["name"];
                                $file_tmp   = $_FILES["product_thumb_image"]["tmp_name"];
                                $ext = pathinfo($file_name,PATHINFO_EXTENSION);
                                if(in_array($ext,$extension)){
                                        move_uploaded_file($_FILES["product_thumb_image"]["tmp_name"],$target_dir.$file_name);
                                }else{ echo 'not image'; }
                        }
                        $this->db->trans_start();
                        $data['thubnail_image'] = $target_dir.$file_name;
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
                                                $idata['image_name'] = $file_name;
                                                $this->db->insert('productimages_tbl',$idata);
                                        }else{
                                                echo 'not image';
                                        }
                                }
                        }
                }if($this->db->trans_status() === FALSE){
                        return $this->db->trans_rollback();
                }else{
                        return $this->db->trans_complete();
                }
        }
}
?>