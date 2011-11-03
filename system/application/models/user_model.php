<?php 
class User_model extends Model {

    function User_model()
    {
        parent::Model();
    }
	
    function getAll(){
    	return $this->db->get('VW_LIST_ALL_USERS');
    }
    
    function get($so_id){
		$this->db->where('so_id', $so_id);
		$query = $this->db->get('VW_LIST_ALL_USERS');
		if ($query->num_rows() > 0){
			$row = $query->row();
			return $row;
		}else{
			return false;
		}
    }
	
    function insert($post){
		$user = $this->SystemObject->insert($post,'user');
		$data = array(
			'usd_name' => $post['name'],
			'usd_lastname' => $post['lastname'],
			'usd_username' => $post['username'],
			'usd_email' => $post['email'],
			'usd_level' => $post['level'],
			'SO_SYSTEMOBJECT_so_id' => $user->so_id
        );
		if(isset($post['password']) && $post['password']!=""){
			$data['usd_password'] = substr(md5($post['password']),0,15);
		}
		$this->db->insert('USD_USERDATA', $data);
		$usd_id = $this->db->insert_id();
		return $this->get($user->so_id);
    }
    
	function update($post){
		$user = $this->SystemObject->update($post);
		$data = array(
			'usd_name' => $post['name'],
			'usd_lastname' => $post['lastname'],
			'usd_username' => $post['username'],
			'usd_email' => $post['email'],
			'usd_level' => $post['level']
        );
		if(isset($post['password']) && $post['password']!=""){
			$data['usd_password'] = substr(md5($post['password']),0,15);
		}
		$this->db->where('SO_SYSTEMOBJECT_so_id', $post['so_id']);
		$this->db->update('USD_USERDATA', $data);
		return $this->get($post['so_id']); 
	}
	
    function delete($so_id){
    	$this->db->delete('USD_USERDATA', array('SO_SYSTEMOBJECT_so_id' => $so_id));
    	$this->SystemObject->delete($so_id);
    }
    
    function myprofileUpdate($post){
		$data = array(
			'usd_name' => $post['name'],
			'usd_lastname' => $post['lastname'],
			'usd_username' => $post['username'],
			'usd_password' => substr(md5($post['password']),0,15),		
			'usd_email' => $post['email']
		);

		$this->db->where('SO_SYSTEMOBJECT_so_id', $post['so_id']);
		$this->db->update('USD_USERDATA', $data); 
    }
}

/* End of file user_model.php */
/* Location: ./system/application/controllers/user_model.php */
?>