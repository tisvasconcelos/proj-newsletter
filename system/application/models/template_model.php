<?php
class Template_model extends Model {

    function Template_model()
    {
        parent::Model();
    }
    
    function getAll(){
    	return $this->db->get('VW_LIST_ALL_TEMPLATE');
    }
    
    function get($so_id){
    	$query = $this->db->get_where('VW_LIST_ALL_TEMPLATE', array('so_id' => $so_id));
    	if($query->num_rows() > 0){
			return $query->row();
		}else{
			return false;
		}
    }
    
    function insert($post){
		$template = $this->SystemObject->insert($post,'template');
		$html = read_file($_FILES['userfile']['tmp_name']);
		$data = array(
			'tpd_name' => $post['name'],
			'tpd_html' => $html,
			'SO_SYSTEMOBJECT_so_id' => $template->so_id
        );
		$this->db->insert('TPD_TEMPLATEDATA', $data);
		$tpd_id = $this->db->insert_id();
		return $this->get($template->so_id);
    }
    
	function update($post){
		$template = $this->SystemObject->update($post);
		$data = array(
			'tpd_name' => $post['name'],
			'tpd_html' => $post['html']
        );
		$this->db->where('SO_SYSTEMOBJECT_so_id', $post['so_id']);
		$this->db->update('TPD_TEMPLATEDATA', $data);
		return $this->get($post['so_id']); 
	}
	
    function delete($so_id){
    	$this->db->delete('TPD_TEMPLATEDATA', array('SO_SYSTEMOBJECT_so_id' => $so_id));
    	$this->SystemObject->delete($so_id);
    }
}

/* End of file template_model.php */
/* Location: ./system/application/controllers/template_model.php */
?>