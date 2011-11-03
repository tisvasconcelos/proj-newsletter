<?php
require_once 'CompoundDocument.inc.php'; 
require_once 'BiffWorkbook.inc.php';

class Mailing_model extends Model {

    function Mailing_model()
    {
        parent::Model();
    }
    
    function getAll(){
    	return $this->db->get('VW_LIST_ALL_MAILING');
    }
    
    function getSubscribers($mld_id){
    	$this->db->order_by('scd_id');
    	$query = $this->db->get_where('VW_LIST_ALL_SUBSCRIBER', array('mld_id' => $mld_id));
    	return $query;
    }
    
    function get($mld_id){
    	$query = $this->db->get_where('VW_LIST_ALL_MAILING', array('mld_id' => $mld_id));
    	if($query->num_rows() > 0){
			return $query->row();
		}else{
			return false;
		}
    }
    
    function getBySoId($so_id){
        $query = $this->db->get_where('VW_LIST_ALL_MAILING', array('so_id' => $so_id));
    	if($query->num_rows() > 0){
			return $query->row();
		}else{
			return false;
		}
    }
    
    function getByName($name){
    	$query = $this->db->get_where('VW_LIST_ALL_MAILING', array('mld_name' => $name));
    	if($query->num_rows() > 0){
    		return $query->row();
    	}else{
    		return false;
    	}    	
    }
    
    function insert($post){
    	set_time_limit(1000);
    	
		$config['upload_path'] = './system/application/views/excel/';
		$config['allowed_types'] = 'xls';
		$config['max_size']	= '6000';
		$this->load->library('upload', $config);
		if(!$this->upload->do_upload()){
			//$error = array('error' => $this->upload->display_errors());
			return false;
		}else{
			$data = array('upload_data' => $this->upload->data());
			$fileName = "system/application/views/excel/".$data['upload_data']['file_name'];
			
			$mailing = $this->SystemObject->insert($post,'mailing');
			$data = array(
				'mld_name' => $post['name'],
				'mld_excel' => $data['upload_data']['file_name'],
				'SO_SYSTEMOBJECT_so_id' => $mailing->so_id
            );
			$this->db->insert('MLD_MAILINGDATA', $data);
			$mld_id = $this->db->insert_id();
			
			if(!is_readable($fileName)) die ('Cannot read '.$fileName); 
			$doc = new CompoundDocument('utf-8');
			$doc->parse(file_get_contents($fileName));
			$wb = new BiffWorkbook($doc); 
			$wb->parse();
			foreach($wb->sheets as $sheetName => $sheet){
				for ($row = 0; $row < $sheet->rows(); $row ++){
					$subscribers = array();
					$contCell = 0;
        			for ($col = 0; $col < $sheet->cols(); $col ++){
            			if(!isset($sheet->cells[$row][$col])) continue;
            			$cell = $sheet->cells[$row][$col];
            			if(!is_null($cell->value)){
            				$subscribers[0][$contCell] = $cell->value;
            				$contCell++;
            			}
        			}
        			if(sizeof($subscribers)>0){
						if($subscribers[0][0]!="" && $subscribers[0][1]!=""){
	        				$post['name'] = $subscribers[0][0];
	        				$subscriber = $this->SystemObject->insert($post,'subscriber');
							$data = array(
								'scd_name' => $subscribers[0][0],
								'scd_email' => $subscribers[0][1],
								'SO_SYSTEMOBJECT_so_id' => $subscriber->so_id,
								'MLD_MAILINGDATA_mld_id' => $mld_id
				            );
							$this->db->insert('SCD_SUBSCRIBERDATA', $data);
						}
        			}
				}
			}
			
			return $mailing;
    	}
    }
    
    function delete($so_id,$mld_id){
    	$this->db->delete('MLD_MAILINGDATA', array('mld_id' => $mld_id));
    	$this->SystemObject->delete($so_id);
    }
    
    function deleteFile($file){
    	$file = './system/application/views/excel/'.$file;
		if(is_file($file)){
			unlink($file);
		}
    }
}

/* End of file mailing_model.php */
/* Location: ./system/application/controllers/mailing_model.php */
?>