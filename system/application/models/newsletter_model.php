<?php
class Newsletter_model extends Model {

    function Newsletter_model()
    {
        parent::Model();
    }
    
    function getAll(){
    	return $this->db->get('VW_LIST_ALL_NEWSLETTER');
    }
    
    function get($so_id){
    	$query = $this->db->get_where('VW_LIST_ALL_NEWSLETTER', array('so_id' => $so_id));
    	if($query->num_rows() > 0){
			return $query->row();
		}else{
			return false;
		}
    }
    
    function insert($post){
		$newsletter = $this->SystemObject->insert($post,'newsletter');
		$data = array(
			'nld_name' => $post['name'],
			'nld_sender' => $post['sender'],
			'nld_email' => $post['email'],
			'nld_code' => $post['code'],
			'MLD_MAILINGDATA_mld_id' => $post['mailing'],
			'TPD_TEMPLATEDATA_tpd_id' => $post['template'],
			'SO_SYSTEMOBJECT_so_id' => $newsletter->so_id
        );
		$this->db->insert('NLD_NEWSLETTERDATA', $data);
		$nld_id = $this->db->insert_id();
		return $this->get($newsletter->so_id);
    }
    
	function update($post){
		$newsletter = $this->SystemObject->update($post);
		$data = array(
			'nld_name' => $post['name'],
			'MLD_MAILINGDATA_mld_id' => $post['mailing'],
			'TPD_TEMPLATEDATA_tpd_id' => $post['template']
        );
		if(!empty($post['code'])){
			$data['nld_code'] = $post['code'];
		}
		$this->db->where('SO_SYSTEMOBJECT_so_id', $post['so_id']);
		$this->db->update('NLD_NEWSLETTERDATA', $data);
		return $this->get($post['so_id']);
	}
	
    function delete($so_id){
    	$this->db->delete('NLD_NEWSLETTERDATA', array('SO_SYSTEMOBJECT_so_id' => $so_id));
    	$this->SystemObject->delete($so_id);
    }
    
    function send($start,$newsletter,$template,$mailing,$subscribers){
    	$total = $subscribers->num_rows();
    	$this->db->where('mld_id',$mailing->mld_id);
    	$this->db->where('mld_id',$mailing->mld_id);
    	$this->db->order_by('scd_id');
    	$query = $this->db->get('VW_LIST_ALL_SUBSCRIBER',5,$start);
		if($query->num_rows() > 0){
			foreach($query->result() as $row){
				$this->load->library('email');
				$config['mailtype'] = 'html';
				$this->email->initialize($config);
				
				$this->email->from($newsletter->nld_email, $newsletter->nld_sender);
				$this->email->to($row->scd_email);
				
				if(empty($row->scd_encrypted)){
					$encrypted = $this->Subscriber->createEncrypted($row);
				}else{
					$encrypted = $row->scd_encrypted;
				}
				
				$this->email->subject($newsletter->nld_name);
				$html = str_replace('[nome]',$row->scd_name,$template->tpd_html);
				$html = str_replace($this->config->config['base_path'],site_url(),$html);
				$html = str_replace('http://[linkRemover]',site_url('subscriber/remove/'.$encrypted),$html);
				$html = str_replace('http://[linkAlterar]',site_url('subscriber/edit/'.$encrypted),$html);
				$html = str_replace('http://[linkNovo]',site_url('subscriber/edit'),$html);
				$html = $html.'<br clear="all" /><br clear="all" /><a href="'.site_url('view/'.$newsletter->so_id.'/'.$row->so_id).'">Caso não congisa visualizar clique aqui.</a>';
				$this->email->message($html);
				
				$this->email->send();
			}
		}
    	sleep(5);
    	return $total;
    }
}

/* End of file newsletter_model.php */
/* Location: ./system/application/controllers/newsletter_model.php */
?>