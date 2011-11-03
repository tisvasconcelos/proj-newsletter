<?php 
class SystemObject extends Model {

    function SystemObject()
    {
        parent::Model();
    }
    
	function getObjectTypeId($object){
		$query = $this->db->get_where('SOT_SYSTEMOBJECTTYPE', array('sot_type' => $object), 1);
		
		if($query->num_rows() > 0){
			$row = $query->row();
			return $row->sot_id;
		}else{
			return false;
		}
	}
	
	function get($so_id){
		$query = $this->db->get_where('SO_SYSTEMOBJECT', array('so_id' => $so_id), 1);
		if($query->num_rows() > 0){
			return $query->row();
		}else{
			return false;
		}
	}
    
    function insert($post,$object){
    	$data = array(
			'so_name' => $post['name'],
			'so_date' => date('Y-m-d H:i:s'),
			'SOT_SYSTEMOBJECTTYPE_sot_id' => $this->getObjectTypeId($object)
		);
		$this->db->insert('SO_SYSTEMOBJECT',$data);
		
		return $this->get($this->db->insert_id());
    }
	
	function update($post){
    	$data = array(
			'so_name' => $post['name']
		);
		$this->db->where('so_id', $post['so_id']);
		$this->db->update('SO_SYSTEMOBJECT', $data);
	}
    
	function delete($so_id){
		$this->db->delete('SO_SYSTEMOBJECT', array('so_id' => $so_id));
	}
}

/* End of file systemobject.php */
/* Location: ./system/application/controllers/systemobject.php */
?>