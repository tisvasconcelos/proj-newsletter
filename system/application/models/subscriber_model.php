<?php
class Subscriber_model extends Model {

	function Subscriber_model()
	{
		parent::Model();
		$this->load->model('Mailing_model','Mailing');
	}

	function get($so_id){
		$query = $this->db->get_where('VW_LIST_ALL_SUBSCRIBER', array('so_id' => $so_id));
		if($query->num_rows() > 0){
			return $query->row();
		}else{
			return false;
		}
	}

	function getByEncrypted($encrypted){
		$query = $this->db->get_where('SCD_SUBSCRIBERDATA', array('scd_encrypted' => $encrypted));
		if($query->num_rows() > 0){
			return $query->row();
		}else{
			return false;
		}
	}
	
	function getByEmail($email){
		$query = $this->db->get_where('VW_LIST_ALL_SUBSCRIBER', array('scd_email' => $email));
		if($query->num_rows() > 0){
			return $query->row();
		}else{
			return false;
		}		
	}

	function delete($so_id,$scd_id){
		$this->db->delete('SCD_SUBSCRIBERDATA', array('scd_id' => $scd_id));
		$this->SystemObject->delete($so_id);
	}

	function createEncrypted($subscriber){
		$encrypted = substr(md5($subscriber->so_id . '-' . $subscriber->scd_email),0,45);
		$data = array(
			'scd_encrypted' => $encrypted
		);
		$this->db->where('scd_id', $subscriber->scd_id);
		$this->db->update('SCD_SUBSCRIBERDATA', $data);
		return $encrypted;
	}

	function changeStatus($encrypted){
		if($subscriber = $this->getByEncrypted($encrypted)){
			$data = array(
				'so_status' => 0
			);
			$this->db->where('so_id', $subscriber->SO_SYSTEMOBJECT_so_id);
			$this->db->update('SO_SYSTEMOBJECT', $data);
		}
	}

	function updateByEncrypted($post,$subscriber){
		$post['so_id'] = $subscriber->SO_SYSTEMOBJECT_so_id;
		$this->SystemObject->update($post);
		$data = array(
    		'scd_name' => $post['name'],
    		'scd_email' => $post['email']
		);
		$this->db->where('SO_SYSTEMOBJECT_so_id', $post['so_id']);
		$this->db->update('SCD_SUBSCRIBERDATA', $data);
	}
	
	function insert($post){
		if(!$subscriber = $this->getByEmail($post['email'])){
			if(!$mailing = $this->Mailing->getByName("Assinantes")){
				$new['name'] = "Assinantes";
				$mailing = $this->SystemObject->insert($new,'mailing');
				$data = array(
					'mld_name' => $new['name'],
					'SO_SYSTEMOBJECT_so_id' => $mailing->so_id
	            );
				$this->db->insert('MLD_MAILINGDATA', $data);
				$mld_id = $this->db->insert_id();
			}else{
				$mld_id = $mailing->mld_id;
			}
			$systemobject = $this->SystemObject->insert($post,'subscriber');
			$data = array(
	    		'scd_name' => $post['name'],
	    		'scd_email' => $post['email'],
				'SO_SYSTEMOBJECT_so_id' => $systemobject->so_id,
				'MLD_MAILINGDATA_mld_id' => $mld_id
			);
			$this->db->insert('SCD_SUBSCRIBERDATA', $data);
			return $this->get($systemobject->so_id);
		}else{
			return $subscriber;
		}
	}
}

/* End of file subscriber_model.php */
/* Location: ./system/application/controllers/subscriber_model.php */
?>