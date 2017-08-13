<?php 
class Portfolio_model extends CI_Model{
    public function store_portfolio(){
        $extension  = array("jpeg","jpg","png","gif");
        $data['ptitle'] = $this->input->post('pof_name');
        $data['purl'] = $this->input->post('pof_url');
        $data['pcategory'] = $this->input->post('pof_category');
        $data['pdescription'] = $this->input->post('pof_desc');
        $data['pcust_name'] = $this->input->post('pof_cname');
        $data['pcust_review'] = $this->input->post('pof_creview');
        if (!empty($this->input->post('pof_id'))){
            $this->db->trans_start();
            if($_FILES['pof_poster']["error"] == 4){
                $poster = lookup_value('portfolio_tbl', 'pimage',array('id'=>$this->input->post('pof_id')));
                $data['pimage'] = $poster;
                $this->db->where('id',$this->input->post('pof_id'));
                $this->db->update('portfolio_tbl', $data);        
            }else{
                $target_dir = '../assets/images/portfolio/';
                $file_name  = 'pofpo_'.date('His').$_FILES["pof_poster"]["name"];
                $ext = pathinfo($file_name,PATHINFO_EXTENSION);
                if(in_array($ext,$extension)){
                    move_uploaded_file($_FILES["pof_poster"]["tmp_name"],$target_dir.$file_name);
                    $data['pimage'] = $target_dir.$file_name;
                    $this->db->where('id',$this->input->post('pof_id'));
                    $this->db->update('portfolio_tbl',$data);
                }else{ echo 'not image';}    
            }
            for($i=0;$i<count($_FILES['pof_image']['name']);$i++){
                if($_FILES['pof_image']["error"][$i] == 4){
                    $poster = lookup_value('portfolioimages_tbl', 'image',array('portfolio_id'=>$this->input->post('pof_id')));
                    foreach ($poster as $key=>$value){
                        $idata['image'] = $value; 
                        $this->db->update_batch('portfolioimages_tbl',$idata['image'],$this->input->post('pof_id'));
                    }
                }else{
                 $target_dir = '../assets/images/portfolio/';
                 $file_name  = 'portfimg_'.date('His').$_FILES["pof_image"]["name"][$i];
                 $ext = pathinfo($file_name,PATHINFO_EXTENSION);
                 if($_FILES['pof_image']['name'][$i]!=''){
                    if(in_array($ext,$extension)){
                        if(move_uploaded_file($_FILES['pof_image']['tmp_name'][$i],$target_dir.$file_name)){ 
                            $idata['portfolio_id'] = $this->input->post('pof_id');
                            $idata['image'] = $target_dir.$file_name;
                            $this->db->insert('portfolioimages_tbl',$idata);   
                        }
                    }
                }     
            }
        }
    }else{
        $this->db->trans_start();
        if(isset($_FILES['pof_poster'])){
            $target_dir = '../assets/images/portfolio/';
            $file_name  = 'pofpo_'.date('His').$_FILES["pof_poster"]["name"];
            $ext = pathinfo($file_name,PATHINFO_EXTENSION);
            if(in_array($ext,$extension)){
                move_uploaded_file($_FILES["pof_poster"]["tmp_name"],$target_dir.$file_name);
                $data['pimage'] = $target_dir.$file_name;
                $this->db->insert('portfolio_tbl', $data);
                $insert_id = $this->db->insert_id();
            }else{ echo 'not image';}
        }for($i=0;$i<count($_FILES['pof_image']['name']);$i++){
            $target_dir = '../assets/images/portfolio/';
            $file_name  = 'portfimg_'.date('His').$_FILES["pof_image"]["name"][$i];
            $ext = pathinfo($file_name,PATHINFO_EXTENSION);
            if($_FILES['pof_image']['name'][$i]!=''){
                if(in_array($ext,$extension)){
                    if(move_uploaded_file($_FILES['pof_image']['tmp_name'][$i],$target_dir.$file_name)){ 
                        $idata['portfolio_id'] = $insert_id;
                        $idata['image'] = $target_dir.$file_name;
                        $this->db->insert('portfolioimages_tbl',$idata);   
                    }
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