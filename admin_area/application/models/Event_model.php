<?php 
class Event_model extends CI_Model {
        public function store_event() {
                $extension  = array("jpeg","jpg","png","gif","JPG","JPEG");
                $data['title'] = $this->input->post('event_name');
                $data['url']   = $this->input->post('event_url');
                $data['category'] = $this->input->post('event_category');
                $data['description'] = $this->input->post('event_desc');
                if (!empty($this->input->post('event_id'))){
                        $this->db->trans_start();
                        if($_FILES['event_poster']["error"] == 4){
                                $event_poster = lookup_value('events_tbl', 'poster_image',array('id'=>$this->input->post('event_id')));
                                $data['poster_image'] = $event_poster;
                                $this->db->where('id',$this->input->post('event_id'));
                                $this->db->update('events_tbl', $data);        
                        }else{
                                $target_dir = '../assets/images/events/';
                                $file_name  = 'eventpo_'.date('His').$_FILES["event_poster"]["name"];
                                $ext = pathinfo($file_name,PATHINFO_EXTENSION);
                                if(in_array($ext,$extension)){
                                        move_uploaded_file($_FILES["event_poster"]["tmp_name"],$target_dir.$file_name);
                                        $data['poster_image'] = $target_dir.$file_name;
                                        $this->db->where('id',$this->input->post('event_id'));
                                        $this->db->update('events_tbl', $data);
                                }else{ echo 'not image';}    
                        }
                        for($i=0;$i<count($_FILES['event_image']['name']);$i++){
                                if($_FILES['event_image']["error"][$i] == 4){
                                        $event_poster = lookup_value('eventimages_tbl', 'image',array('event_id'=>$this->input->post('event_id')));
                                        foreach ($event_poster as $key=>$value){
                                                $idata['image'] = $value; 
                                                $this->db->update_batch('eventimages_tbl',$idata['image'],$this->input->post('event_id'));
                                        }
                                }else{
                                   $target_dir = '../assets/images/events/';
                                   $file_name  = 'eventimg_'.date('His').$_FILES["event_image"]["name"][$i];
                                   $ext = pathinfo($file_name,PATHINFO_EXTENSION);
                                   if($_FILES['event_image']['name'][$i]!=''){
                                        if(in_array($ext,$extension)){
                                                if(move_uploaded_file($_FILES['event_image']['tmp_name'][$i],$target_dir.$file_name)){ 
                                                        $idata['event_id'] = $this->input->post('event_id');
                                                        $idata['image'] = $target_dir.$file_name;
                                                        $this->db->insert('eventimages_tbl',$idata);   
                                                }
                                        }
                                }     
                        }
                        }//die;
                }else{
                        $this->db->trans_start();
                        if(isset($_FILES['event_poster'])){
                                $target_dir = '../assets/images/events/';
                                $file_name  = 'eventpo_'.date('His').$_FILES["event_poster"]["name"];
                                $ext = pathinfo($file_name,PATHINFO_EXTENSION);
                                if(in_array($ext,$extension)){
                                        move_uploaded_file($_FILES["event_poster"]["tmp_name"],$target_dir.$file_name);
                                        $data['poster_image'] = $target_dir.$file_name;
                                        $this->db->insert('events_tbl', $data);
                                        $insert_id = $this->db->insert_id();
                                }else{ echo 'not image';}
                        }for($i=0;$i<count($_FILES['event_image']['name']);$i++){
                                $target_dir = '../assets/images/events/';
                                $file_name  = 'eventimg_'.date('His').$_FILES["event_image"]["name"][$i];
                                $ext = pathinfo($file_name,PATHINFO_EXTENSION);
                                if($_FILES['event_image']['name'][$i]!=''){
                                        if(in_array($ext,$extension)){
                                                if(move_uploaded_file($_FILES['event_image']['tmp_name'][$i],$target_dir.$file_name)){ 
                                                        $idata['event_id'] = $insert_id;
                                                        $idata['image'] = $target_dir.$file_name;
                                                        $this->db->insert('eventimages_tbl',$idata);   
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